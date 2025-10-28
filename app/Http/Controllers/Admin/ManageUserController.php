<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CycleInfo;
use App\Models\User;
use App\Models\UserDocuments;
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
        $list = User::join('user_documents as ud','ud.user_id','users.id')
            ->select('users.id as id','users.name as user_name', 'users.email as user_email', 'users.is_cycle as have_cycle',
                'users.user_status_id as status', 'users.created_at as request_date',
                \DB::raw('COUNT(ud.id) as document_count'))
            ->groupBy('users.id')
            ->get();

        $datatable = Datatables::of($list)
            ->editColumn('status', function ($data) {
                if($data->status == 3)
                    $st = 'Pending';
                else
                    $st = '--';
                return $st;
            })
            ->addColumn('documents', function ($data) {
                return '<button class="btn btn-sm btn-outline-info align-middle">' . $data->document_count . '</button>';
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
            })
            ->rawColumns(['documents', 'action']);
        return $datatable->make(true);
    }

    public function pending_account_show_docs(Request $request)
    {
        $id = $request->user_id;
        $documents = UserDocuments::where('user_id',$id)->pluck('user_docs_img_path');
//        dd($documents);
        return response()->json(['imgs' => $documents]);
    }
}
