<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FirebaseNotificationController;
use App\Models\CycleInfo;
use App\Models\User;
use App\Models\UserDocuments;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Messaging;
use Yajra\DataTables\DataTables;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class ManageUserController extends Controller
{
    public function pending_account()
    {
        return view('admin.manage_user.pending_accounts');
    }
    public function pending_account_list()
    {
        $list = User::join('user_documents as ud','ud.user_id','users.id')
            ->where('user_status_id',3)
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
                $dropdown .= '<button type="button" class="dropdown-item action" data-target-id='. 5 .'><div class="row no-gutters align-items-center"><div class="col-2"><i class="ft-plus-circle"></i></div><div class="col-9 offset-1">Reject</div></button>';
                $dropdown .= '<button type="button" class="dropdown-item action" data-target-id=' . 4 . '><div class="row no-gutters align-items-center"><div class="col-2"><i class="ft-plus-circle"></i></div><div class="col-9 offset-1">Not Verified</div></button>';
                $dropdown .= '<button type="button" class="dropdown-item action" data-target-id=' . 1 . '><div class="row no-gutters align-items-center"><div class="col-2"><i class="ft-plus-circle"></i></div><div class="col-9 offset-1">Approved</div></button>';
                $dropdown .= '<button type="button" class="dropdown-item action" data-target-id=' . 2 . '><div class="row no-gutters align-items-center"><div class="col-2"><i class="ft-plus-circle"></i></div><div class="col-9 offset-1">Blocked</div></button>';

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
        return response()->json(['imgs' => $documents]);
    }

    public function reject_user_request(Request $request)
    {
        $user_id = $request->user_id;
        $status_id = $request->status_id;

        if ($status_id == 5)
            User::where('id',$user_id)->update(['user_status_id'=> 5]);
        elseif ($status_id == 4)
            User::where('id',$user_id)->update(['user_status_id'=> 4]);
        elseif ($status_id == 1)
            User::where('id',$user_id)->update(['user_status_id'=> 1]);
        elseif ($status_id == 2)
            User::where('id',$user_id)->update(['user_status_id'=> 2]);
        else
            return response()->json(['status' => 0, 'error' => 'Something Went Wrong !!!']);

        $user = User::find($user_id);

        if ($user->fcm_token)
        {
            $request = Request::create('/send-test-push', 'POST', [
                'token' => $user->fcm_token,
                'title' => 'Cycle Reservation',
                'body' => 'Your account is rejected !, Contact to support !'
            ]);

            app(FirebaseNotificationController::class)->sendTest($request);
        }
            return response()->json(['status' => 1, 'success' => 'Status Updated Successfully !!!']);
    }
}
