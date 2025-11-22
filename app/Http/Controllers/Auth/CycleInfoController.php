<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FirebaseNotificationController;
use App\Models\CycleAvailability;
use App\Models\CycleImage;
use App\Models\CycleInfo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Label84\HoursHelper\Facades\HoursHelper;


class CycleInfoController extends Controller
{
    public function add_cycle_modal_form(Request $request)
    {
        $message_bit = null;
        $from_hour = $request->cycle_available_from;
        $to_hour = $request->cycle_available_to;
        $uploadedImages = [];
        $cycle_owner_id = auth()->id();
        $available_date = Carbon::createFromFormat('d F, Y', $request->cycle_available_date)
            ->format('Y-m-d H:i:s');

        $hours_range = HoursHelper::create($from_hour, $to_hour, 60);

        $from_hour = Carbon::createFromFormat('H:i', $from_hour)->hour;
        $to_hour = Carbon::createFromFormat('H:i', $to_hour)->hour;
        $total_hour = abs($from_hour - $to_hour);

        //check for previous available cycle history
        $check_history = CycleAvailability::where('owner_id', $cycle_owner_id);
        //check for previous available cycle history end

        if ($check_history->exists()) {

            $message_bit = 1;
            $existing_date = $check_history->select('available_date')->groupBy('available_date');
            $existing_date = $existing_date->pluck('available_date')->toArray();

            $modifiedArray = array_map(function ($dateTimeString) {
                $date = Carbon::parse($dateTimeString)->toDateString();
                return $date;
            }, $existing_date);

            $available_date_altered = Carbon::parse($available_date)->toDateString();
            if (in_array($available_date_altered, $modifiedArray)) {
                return redirect()->back()->with('error', 'Selected date is already exist !!!');
            }

            //registering hours
            foreach ($hours_range as $hour) {
                $cycle_info = CycleInfo::where('owner_id', $cycle_owner_id)->where('cycle_status_id', 1)->first();
                $cycle_availabilities = new CycleAvailability();
                $cycle_availabilities->cycle_id = $cycle_info->id;
                $cycle_availabilities->owner_id = auth()->id();
                $cycle_availabilities->available_hours = $hour;
                $cycle_availabilities->available_date = $available_date;
                $cycle_availabilities->save();
            }
        } else {
            $message_bit = 0;
            //upload images
            if ($request->hasFile('cycle_images')) {
                foreach ($request->file('cycle_images') as $image) {
                    // Generate unique file name
                    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                    // Store image in "public/uploads"
                    $image->move(public_path('uploads'), $imageName);

                    // Store file path
                    $uploadedImages[] = 'uploads/' . $imageName;
                }
            }

            $cycle_info = new CycleInfo();
            $cycle_info->owner_id = auth()->id();
            $cycle_info->brand = $request->cycle_brand_name;
            $cycle_info->type = $request->cycle_type;
            $cycle_info->model = $request->cycle_model;
            $cycle_info->cycle_sku = $request->cycle_sku;
            $cycle_info->description = $request->cycle_description;
            $cycle_info->save();

            foreach ($uploadedImages as $imagePath) {
                $cycleImage = new CycleImage();
                $cycleImage->cycle_id = $cycle_info->id;
                $cycleImage->cycle_image_path = $imagePath;
                $cycleImage->save();
            }

            //registering hours
            foreach ($hours_range as $hour) {
//                $cycle_info = CycleInfo::where('owner_id',$cycle_owner_id)->where('cycle_status_id',1)->first();
                $cycle_availabilities = new CycleAvailability();
                $cycle_availabilities->cycle_id = $cycle_info->id;
                $cycle_availabilities->owner_id = auth()->id();
                $cycle_availabilities->available_hours = $hour;
                $cycle_availabilities->available_date = $available_date;
                $cycle_availabilities->save();
            }
        }

        if ($message_bit)
            return redirect()->back()->with('success', 'Cycle Hours Updated !!!');
        else
            return redirect()->back()->with('success', 'Your Cycle Has Been Registered !!!');
    }

    public function deactivate_cycle(Request $request)
    {
        CycleInfo::where('owner_id',auth()->id())->update(['cycle_status_id'=>3]);
        return redirect()->back()->with('success', 'You deactivated your cycle !!!');
    }

    public function activate_cycle(Request $request)
    {
        CycleInfo::where('owner_id',auth()->id())->update(['cycle_status_id'=>1]);
        return redirect()->back()->with('success', 'You activated your cycle !!!');
    }

    public function show_cycle_details($id)
    {
        $cycle_available_date = $id;

        $cycle_availabilities = CycleAvailability::where('available_date', $cycle_available_date)
            ->whereNotIn('cycle_availability_status_id',[2,3])
            ->get();
        $result = [];

        foreach ($cycle_availabilities as $availability) {
            $cycleId = $availability->cycle_id;

            // If this cycle_id doesn't exist in the result array yet, create it
            if (!isset($result[$cycleId])) {
                $cycle_info_new = CycleAvailability::join('cycle_infos as ci', 'ci.id', 'cycle_availabilities.cycle_id')
                    ->join('cycle_images as cis', 'cycle_availabilities.cycle_id', 'cis.id')
                    ->where('cycle_availabilities.available_date', $cycle_available_date)
                    ->where('cycle_availabilities.cycle_id', $cycleId)
                    ->where('ci.cycle_status_id', '!=', 3) // deactivated
                    ->where('cycle_availabilities.cycle_availability_status_id', '!=', 2) // reserved
                    ->groupBy(['cycle_availabilities.cycle_id', 'cycle_availabilities.available_date'])
                    ->select('ci.*', 'cycle_availabilities.available_date', 'cis.*')
                    ->get()
                    ->toArray();

                if (!empty($cycle_info_new)) {
                    $result[$cycleId] = [
                        'cycle_id' => $cycleId,
                        'cycle_details' => $cycle_info_new,
                        'available_hours' => [],
                    ];
                }
            }
            if (!empty($cycle_info_new)) {
                $result[$cycleId]['available_hours'][$availability->id] = $availability->available_hours;
            }
        }
        $cycle_info['hours'] = $result;

        return view('user.cycle.show_cycle_details')
            ->with(['available_date'=>$cycle_available_date,'cycle_infos' => $cycle_info,'available_hours'=>$result]);
    }

    public function show_cycle_details_hours($cycle_id,$available_date)
    {
        $available_hours = CycleAvailability::where('cycle_id',$cycle_id)
            ->where('available_date',$available_date)
            ->where('cycle_availability_status_id',1)
            ->get()->toArray();
        return view('user.cycle.show_cycle_hours')
            ->with(['available_hours'=>$available_hours,'available_date'=>$available_date]);
    }

    public function reserve_available_hours_form(Request $request)
    {
        if(empty($request->reserve_available_hours_ids))
        {
            return redirect()->back()->with('error', 'Please select available Hours !!!');
        }
        $available_date = $request->available_date;
        $reserve_available_hours_ids = $request->reserve_available_hours_ids;

        foreach ($reserve_available_hours_ids as $reserve_available_hours_id) {
            $cycle_availablity = CycleAvailability::find($reserve_available_hours_id);
            if ($cycle_availablity) {
                // check if all the available hours are reserved then cycle_info status should update also.
                $cycle_availablity->cycle_availability_status_id = 2;
                $cycle_availablity->user_id = auth()->id();
                $cycle_availablity->save();
            }
        }

        $owner_id = User::find($cycle_availablity->owner_id);

        if ($owner_id)
        {
            $request = Request::create('/send-test-push', 'POST', [
                'token' => $owner_id->fcm_token,
                'title' => 'Cycle Reservation Portal',
                'body' => 'A user booked some slots of your cycle !'
            ]);

            app(FirebaseNotificationController::class)->sendTest($request);
        }

        return redirect()->back()->with('success', 'You Reserved Your Hours !!!');
    }
}
