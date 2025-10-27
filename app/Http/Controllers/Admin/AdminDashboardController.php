<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\CycleInfo;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
//                $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.dashboard');
    }
}
