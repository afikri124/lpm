<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use App\Models\User;
use App\Models\Criteria_category;
use App\Models\Criteria;
use App\Models\Schedule;
use App\Models\Role;
use App\Models\User_role;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Yajra\DataTables\DataTables;

class ApiController extends Controller
{
    public function users(Request $request)
    {
        $data = User::select('*');
            return Datatables::of($data)
                    ->addColumn('roles',function(User $admin){
                        return $admin->roles->pluck('title')->toArray();
                    })
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('role'))) {
                            $instance->whereHas('roles', function($q) use($request){
                                $q->where('role_id', $request->get('role'));
                            });
                        }
                        if (!empty($request->get('department'))) {
                            $instance->where('department', $request->get('department'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                    $w->orWhere('username', 'LIKE', "%$search%")
                                    ->orWhere('name', 'LIKE', "%$search%")
                                    ->orWhere('nidn', 'LIKE', "%$search%")
                                    ->orWhere('email', 'LIKE', "%$search%")
                                    ->orWhere('phone', 'LIKE', "%$search%")
                                    ->orWhere('job', 'LIKE', "%$search%");
                            });
                        }
                    })
                    ->make(true);
    }

    public function categories(Request $request)
    {
        $data = Criteria_category::all();
            return Datatables::of($data)
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                    $w->orWhere('id', 'LIKE', "%$search%")
                                    ->orWhere('title', 'LIKE', "%$search%")
                                    ->orWhere('description', 'LIKE', "%$search%");
                            });
                        }
                    })
                    ->make(true);
    }

    public function criterias(Request $request)
    {
        $data = Criteria::with('category')->select('*');
            return Datatables::of($data)
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('category'))) {
                            $instance->where('criteria_category_id', $request->get('category'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                    $w->orWhere('title', 'LIKE', "%$search%");
                            });
                        }
                    })
                    ->make(true);
    }

    public function schedules(Request $request)
    {
        $data = Schedule::with('observations')
        ->with('status')->with('lecturer')->with('observations.auditor')->select('*');
            return Datatables::of($data)
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('lecturer_id'))) {
                            $instance->where('lecturer_id', $request->get('lecturer_id'));
                        }
                        if (!empty($request->get('status_id'))) {
                            $instance->where('status_id', $request->get('status_id'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                    $w->orWhere('remark', 'LIKE', "%$search%");
                            });
                        }
                    })
                    ->make(true);
    }







    public function tes(Request $request)
    {
        $data = User::select('id','name')->whereHas('roles', function($q){
                    $q->where('role_id', "LE");
                })->get();
        return Datatables::of($data)->make(true);
    }

}
