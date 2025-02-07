<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CycleInfoController extends Controller
{
    public function cycle_info(Request $request)
    {
        dd($request->all());
    }
}
