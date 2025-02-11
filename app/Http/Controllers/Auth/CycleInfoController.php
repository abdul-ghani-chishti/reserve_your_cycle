<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CycleInfo;
use Illuminate\Http\Request;

class CycleInfoController extends Controller
{
    public function cycle_info(Request $request)
    {
        $cycle_info = new CycleInfo();
        $cycle_info->owner_id = auth()->id();
        $cycle_info->brand = $request->cycle_brand_name;
        $cycle_info->type = $request->cycle_type;
        $cycle_info->model = $request->cycle_model;
        $cycle_info->quality = $request->cycle_quality;
        $cycle_info->description = $request->cycle_description;
        $cycle_info->cycle_status_id = 21;
        $cycle_info->save();
//dd($cycle_info);
        return redirect()->back()->with('success', 'Your cycle has been registered');
    }
}
