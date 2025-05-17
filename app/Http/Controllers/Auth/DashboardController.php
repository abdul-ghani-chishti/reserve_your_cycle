<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CycleInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        if (session('user_type') == 1)
        {
            $check_active_cycle = CycleInfo::where('owner_id',auth()->id())->where('cycle_status_id',1);

            if ($check_active_cycle->exists())
            {
                $check_active_cycle = $check_active_cycle->get()->pluck('id','sku')->toArray();
                $cycle_avialable = 1;
            }else
            {
                $cycle_avialable = 0;
            }

            return view('user.welcome_user')
                ->with(['user_type' => session('user_type'),
                    'check_active_cycle' => $check_active_cycle,
                    'cycle_available' => $cycle_avialable]);
        }

        if (session('user_type') == 0) {

            $cycles_info = CycleInfo::join('cycle_availabilities as ca','cycle_infos.id','ca.cycle_id')
                ->select('ca.available_date')
                ->groupBy('ca.available_date')
                ->get();
//                dd($cycles_info->toArray());
            return view('user.welcome_user')
                ->with(['user_type' => session('user_type'),
                    'cycle_infos' => $cycles_info, 'cycle_available' =>null]);
        }
    }
}
