<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        //        $this->middleware('auth:admin');
    }

    public function index()
    {
        //        dd(1,session()->all(),Admin::find(auth()->id()),auth()->user());
        return view('admin.dashboard');
    }
}
