<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CycleAvailability;
use App\Models\CycleInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        if (session('user_type') == 1)
        {

            $check_active_cycle = CycleInfo::where('owner_id',auth()->id());
            $info = 0;
            $cycle_avialable = 0;
            if ($check_active_cycle->exists())
            {   $info = 1;
                $check_active_cycle = $check_active_cycle->where('cycle_status_id',1); // available
                if ($check_active_cycle)
                {
                    $check_active_cycle = $check_active_cycle->get()->pluck('id','sku')->toArray();
                    $cycle_avialable = 1;
                }
            }

            return view('user.welcome_user')
                ->with(['user_type' => session('user_type'),
                    'check_active_cycle' => $check_active_cycle,
                    'cycle_available' => $cycle_avialable,'user_info'=>$info]);
        }

        if (session('user_type') == 0) {

            $cycles_infos = CycleInfo::join('cycle_availabilities as ca','cycle_infos.id','ca.cycle_id')
                ->where('cycle_infos.cycle_status_id','!=',3) // unavailable
                ->where('ca.cycle_availability_status_id','!=',2) // reserved
                ->select('ca.available_date')
                ->groupBy('ca.available_date')
                ->get();

            return view('user.welcome_user')
                ->with(['user_type' => session('user_type'),
                    'cycle_infos' => $cycles_infos, 'cycle_available' =>null]);
        }
    }

    public function about()
    {
        return view('user.about');
    }
}
