<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CycleInfo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (session('user_type') == 1)
        {
            $check_active_cycle = CycleInfo::where('owner_id',auth()->id())
                ->where('cycle_status_id',0)
                ->get()->pluck('id','sku')->toArray();
            dd($check_active_cycle);
            return view('user.welcome_user')->with(['user_type' => session('user_type'),'check_active_cycle' => $check_active_cycle]);
        }

        if (session('user_type') == 0)
        {
            $cycles = CycleInfo::with('cycle_images')->get()->toArray();
            return view('user.welcome_user')->with(['user_type' => session('user_type'),'cycle_infos' => $cycles]);
        }
    }
}
