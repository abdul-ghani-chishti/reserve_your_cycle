<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CycleAvailability;
use App\Models\CycleInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CycleBookingController extends Controller
{
    public function user_reservation()
    {
        $list = CycleInfo::join('cycle_availabilities as ca','ca.cycle_id','cycle_infos.id')
            ->where('ca.user_id',auth()->id())
            ->get();
        return view('user.cycle.booking_cycle_reservations');
    }

    public function user_reservation_list()
    {
        $list = CycleInfo::join('cycle_availabilities as ca','ca.cycle_id','cycle_infos.id')
            ->where('ca.user_id',auth()->id())
            ->select('ca.id as cycle_availability_id','cycle_infos.brand as brand','cycle_infos.type as type','cycle_infos.model as model',
                'cycle_infos.cycle_sku as sku','cycle_infos.cycle_status_id as cycle_info_status',
                'ca.cycle_availability_status_id as cycle_availability_status','ca.available_date as available_date',
                'ca.available_hours as available_hours')
            ->get();

        return Datatables::of($list)
            ->editColumn('cycle_availability_status', function ($status) {
                return ($status->cycle_availability_status == 2) ? 'Reserved' : 'Active';
            })
            ->addColumn("action", function ($result) {
                    $dropdown = '
                      <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                        <div class="dropdown-menu dropdown-menu-sm">
                    ';
                    $dropdown .= '<button type="button" class="dropdown-item cancel_booking" data-target-id=' . $result->cycle_availability_id . ' rel="assignlocation" ><div class="row no-gutters align-items-center"><div class="col-2"><i class="ft-plus-circle"></i></div><div class="col-9 offset-1">Cancle Booking</div></button>';

                    $dropdown .= '<button type="button" class="dropdown-item feature" data-target-id=' . $result->cycle_availability_id . ' rel="assignlocation" ><div class="row no-gutters align-items-center"><div class="col-2"><i class="ft-plus-circle"></i></div><div class="col-9 offset-1">Feature Button</div></button>';

                    $dropdown .= '
                        </div>
                      </div>
                    ';
                    return $dropdown;
            })
            ->make(true);

        dd('list',$list);
        // now have to show reservation of cycle according to each user , by using datatable
    }

    public function cancel_booking(Request $request)
    {
        $id = $request->cycle_availability_id;
        $current_date = Carbon::today()->toDateString();
        $booking_date = CycleAvailability::where('id',$id)->first();

        if($booking_date->available_date == $current_date)
        {
            return ['status' => 0, 'error' => 'You cannot cancel this booking because it is late now !!!'];
        }
        else
        {
            $current_date = Carbon::parse($current_date);
            $is_date =  $current_date->lessThan($booking_date->available_date);

            if ($is_date)
            {
                // update here
                $booking_date->cycle_availability_status_id = 1;
                $booking_date->user_id = null;
                $booking_date->save();
                return ['status' => 1, 'success' => 'Successfully Cancel Booking !!!'];
            }
            else
            {
                return ['status' => 0, 'error' => 'You cannot cancel this booking because it is now late !!!'];
            }
        }
    }
}
