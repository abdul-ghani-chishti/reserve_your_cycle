<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CycleAvailability;
use App\Models\CycleImage;
use App\Models\CycleInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Label84\HoursHelper\Facades\HoursHelper;


class CycleInfoController extends Controller
{
    public function add_cycle_info(Request $request)
    {

        $from_hour = $request->cycle_available_from;
        $to_hour = $request->cycle_available_to;
        $uploadedImages = [];

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

        //registering a cycle
        $available_date = Carbon::createFromFormat('d F, Y', $request->cycle_available_date)->format('Y-m-d H:i:s');

        $cycle_info = new CycleInfo();
        $cycle_info->owner_id = auth()->id();
        $cycle_info->brand = $request->cycle_brand_name;
        $cycle_info->type = $request->cycle_type;
        $cycle_info->model = $request->cycle_model;
        $cycle_info->sku = $request->cycle_sku;
        $cycle_info->description = $request->cycle_description;
        $cycle_info->available_date = $available_date;
        $cycle_info->save();

        foreach ($uploadedImages as $imagePath) {
            $cycleImage = new CycleImage();
            $cycleImage->cycle_id = $cycle_info->id;
            $cycleImage->cycle_image_path = $imagePath;
            $cycleImage->save();
        }

        $hours_range = HoursHelper::create($from_hour, $to_hour, 60);

        $from_hour = Carbon::createFromFormat('H:i', $from_hour)->hour;
        $to_hour = Carbon::createFromFormat('H:i', $to_hour)->hour;
        $total_hour = abs($from_hour - $to_hour);

        //registering hours
        foreach ($hours_range as $hour)
        {
            $cycle_availabilities = new CycleAvailability();
            $cycle_availabilities->cycle_id = $cycle_info->id;
            $cycle_availabilities->owner_id = auth()->id();
            $cycle_availabilities->available_hours = $hour;
            $cycle_availabilities->save();
        }

        return redirect()->back()->with('success', 'Your cycle has been registered');
    }

    public function show_cycle_details($id)
    {
        $cycle_id = $id;
        $cycles = CycleInfo::with('cycle_images')->findOrFail($id)->toArray();
        $cycle_images = $cycles['cycle_images'];
        $cycles_availabilities = CycleAvailability::where('cycle_id',$id)->get(['id','available_hours','cycle_availability_status_id']);

        //        dd($cycles_availabilities->pluck('id'),$cycles_availabilities->pluck('available_hours'));
        return view('user.cycle.show_cycle_details')
            ->with(['cycle_id'=> $id,'cycles' => $cycles, 'cycle_images' => $cycle_images,'cycles_availabilities' => $cycles_availabilities]);
    }
}
