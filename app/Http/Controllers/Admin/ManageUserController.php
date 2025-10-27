<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CycleInfo;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ManageUserController extends Controller
{
    public function pending_account()
    {
        return view('admin.manage_user.pending_accounts');
    }
    public function pending_account_list()
    {
//        dd('list');
        $list = CycleInfo::join('users as u','u.id','cycle_infos.owner_id')
            ->where('u.user_status_id',1)
            ->select('u.name as user_name','u.email as user_email','u.created_at as request_date','cycle_infos.brand as brand',
                'cycle_infos.type as type','cycle_infos.model as model', 'cycle_infos.cycle_sku as sku',
                'cycle_infos.cycle_status_id as cycle_info_status','cycle_infos.description')
            ->get();

        $datatable = Datatables::of($list)
            ->editColumn('cycle_availability_status', function ($data) {
                return ($data->cycle_availability_status == 2) ? 'Reserved' : 'Active';
            })
            ->addColumn('matriculation', function ($data) {
                return '<button class="btn btn-sm btn-outline-info align-middle">' . 1 . '</button>';
            })
            ->addColumn("action", function ($result) {
                $dropdown = '
                      <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                        <div class="dropdown-menu dropdown-menu-sm">
                    ';
                $dropdown .= '<button type="button" class="dropdown-item reject" data-target-id=' . $result->cycle_availability_id . ' rel="assignlocation" ><div class="row no-gutters align-items-center"><div class="col-2"><i class="ft-plus-circle"></i></div><div class="col-9 offset-1">Reject</div></button>';
                $dropdown .= '<button type="button" class="dropdown-item approved" data-target-id=' . $result->cycle_availability_id . ' rel="assignlocation" ><div class="row no-gutters align-items-center"><div class="col-2"><i class="ft-plus-circle"></i></div><div class="col-9 offset-1">Approved</div></button>';
                $dropdown .= '<button type="button" class="dropdown-item blocked" data-target-id=' . $result->cycle_availability_id . ' rel="assignlocation" ><div class="row no-gutters align-items-center"><div class="col-2"><i class="ft-plus-circle"></i></div><div class="col-9 offset-1">Blocked</div></button>';

                $dropdown .= '
                        </div>
                      </div>
                    ';
                return $dropdown;
            });
        return $datatable->make(true);
    }
}
