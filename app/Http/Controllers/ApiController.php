<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use App\Models\User;
use App\Models\Criteria_category;
use App\Models\Criteria;
use App\Models\Follow_up;
use App\Models\Observation;
use App\Models\Schedule;
use App\Models\Role;
use App\Models\User_role;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;

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
                        if (!empty($request->get('study_program'))) {
                            $instance->where('study_program', $request->get('study_program'));
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
                    ->addColumn('link', function($x){
                        return Crypt::encrypt($x['id']);
                      })
                    ->rawColumns(['link'])
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
                    ->addColumn('link', function($x){
                        return Crypt::encrypt($x['id']);
                      })
                    ->rawColumns(['link'])
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
                    ->addColumn('link', function($x){
                        return Crypt::encrypt($x['id']);
                      })
                    ->rawColumns(['link'])
                    ->make(true);
    }

    public function observations_by_schedule_id(Request $request)
    {
        $data = Observation::with('auditor')->where('schedule_id', $request->get('schedule_id'))->select('*');
            return Datatables::of($data)
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                    $w->orWhere('remark', 'LIKE', "%$search%");
                            });
                        }
                    })
                    ->addColumn('link', function($x){
                        return Crypt::encrypt($x['id']);
                      })
                    ->rawColumns(['link'])
                    ->make(true);
    }

    public function observations_by_auditor_id(Request $request)
    {
        $data = Observation::with('schedule')->with('schedule.lecturer')->where('auditor_id', Auth::user()->id)->select('*');
            return Datatables::of($data)
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('lecturer_id'))) {
                            $instance->whereHas('schedule', function($q) use($request){
                                $q->where('lecturer_id', $request->get('lecturer_id'));
                            });
                        }
                        if (!empty($request->get('attendance'))) {
                            $instance->where('attendance', $request->get('attendance'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                    $w->orWhere('remark', 'LIKE', "%$search%");
                            });
                        }
                    })
                    ->addColumn('link', function($x){
                        return Crypt::encrypt($x['id']);
                      })
                    ->rawColumns(['link'])
                    ->make(true);
    }

    public function notifications(Request $request)
    {
        if(Auth::user()->hasRole('AD')){
            $data['schedules'] = Schedule::where("status_id", "S03")
                ->select('status_id',DB::raw('COUNT(status_id) as notif'))
                ->groupBy('status_id')
                ->first();
        }
        if(Auth::user()->hasRole('AU')){
            $data['observations'] = Observation::where("auditor_id", Auth::user()->id)->where("attendance", false)
            ->select('attendance',DB::raw('COUNT(attendance) as notif'))
            ->groupBy('attendance')
            ->first();
        }
        if(Auth::user()->hasRole('DE')){
            $data['follow_ups'] = Follow_up::where("dean_id", Auth::user()->id)->where("remark", null)
            ->select(DB::raw('COUNT(dean_id) as notif'))
            ->groupBy('dean_id')
            ->first();
        }
        return response()->json($data);
    }








    public function tes(Request $request)
    {
        // $data = User::select('id','email','name')->whereHas('roles', function($q){
        //     $q->where('role_id', "AU");
        // })->get();
        $data =  DB::connection('mysql2')
        ->table('new_employee as e')
        // ->leftJoin('employee_type as t', 'e.emp_type', '=', 't.id')
        ->leftJoin('lookup_gender as g', 'e.gender', '=', 'g.id')
        ->select('e.empid as id', 'e.name', 'e.unit_id', 'e.sub_unit_id', 'e.sub_unit_id',
        'e.email','e.mobile', "emp_type AS job",
        'g.short_code AS gender', "e.dept_id")->get();
        return Datatables::of($data)->make(true);
    }

}
