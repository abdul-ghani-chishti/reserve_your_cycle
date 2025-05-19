<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CycleInfo;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CycleBookingController extends Controller
{
    public function user_reservation()
    {
        $list = CycleInfo::join('cycle_availabilities as ca','ca.cycle_id','cycle_infos.id')
            ->where('ca.user_id',auth()->id())
            ->get();
        return view('user.cycle.booking_cycle_reservations');
    }

    public function user_reservation_list()
    {
        $list = CycleInfo::join('cycle_availabilities as ca','ca.cycle_id','cycle_infos.id')
            ->where('ca.user_id',auth()->id())
            ->get();

        return Datatables::of($list)
            ->editColumn('status', function ($routes) {
                return ($routes->status == 0) ? 'Inactive' : 'Active';
            })
            ->filterColumn('status', function ($query, $keyword) {
                $keyword = strtolower($keyword);

                if (strpos('active', $keyword) !== false) {
                    $query->where('routes.status', '=', 1);
                } else if (strpos('inactive', $keyword) !== false) {
                    $query->where('routes.status', '=', 0);
                } else {
                    $query->whereRaw('false');
                }
            })
            ->addColumn("action", function ($result) {
                if (session('role_id') == 1 || count(array_intersect([94, 95], session('permissions'))) !== 0) {
                    $dropdown = '
                      <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                        <div class="dropdown-menu dropdown-menu-sm">
                    ';

                    if (session('role_id') == 1 || in_array(94, session('permissions'))) {
                        $dropdown .= '<button type="button" class="dropdown-item update_route" data-target-id=' . $result->id . ' rel="#" data-toggle="modal" data-target="#"><div class="row no-gutters align-items-center"><div class="col-2"><i class="ft-plus-circle"></i></div><div class="col-9 offset-1">Update Route</div></button>';
                    }

                    if (session('role_id') == 1 || in_array(95, session('permissions'))) {
                        if ($result->status == 1) {
                            $dropdown .= '<button type="button" class="dropdown-item deactivate" data-target-id=' . $result->id . ' rel="routeInactive"><div class="row no-gutters align-items-center"><div class="col-2"><i class="ft-plus-circle"></i></div><div class="col-9 offset-1">Deactivate Route</div></button>';
                        } else {
                            $dropdown .= '<button type="button" class="dropdown-item deactivate" data-target-id=' . $result->id . ' rel="routeActive"><div class="row no-gutters align-items-center"><div class="col-2"><i class="ft-plus-circle"></i></div><div class="col-9 offset-1">Activate Route</div></button>';
                        }
                    }
                    $dropdown .= '<button type="button" class="dropdown-item assign_location" data-target-id=' . $result->id . ' rel="assignlocation" ><div class="row no-gutters align-items-center"><div class="col-2"><i class="ft-plus-circle"></i></div><div class="col-9 offset-1">Assign Shipper</div></button>';

                    $dropdown .= '<button type="button" class="dropdown-item view_location" data-target-id=' . $result->id . ' rel="assignlocation" ><div class="row no-gutters align-items-center"><div class="col-2"><i class="ft-plus-circle"></i></div><div class="col-9 offset-1">View Pickup Addresses </div></button>';

                    $dropdown .= '
                        </div>
                      </div>
                    ';

                    return $dropdown;
                } else {
                    return '';
                }
            })
            ->make(true);

        dd('list',$list);
        // now have to show reservation of cycle according to each user , by using datatable
    }
}
