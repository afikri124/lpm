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
use App\Models\Observation_category;
use App\Models\Observation_criteria;
use App\Models\Schedule;
use App\Models\Role;
use App\Models\User_role;
use App\Models\Setting;
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
        $data = Criteria_category::select('*');
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
        ->with('status')->with('lecturer')
        ->with('observations.auditor')
        ->select('*')->orderBy("status_id");
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

    public function schedules_by_lectrurer_id(Request $request)
    {
        $data = Schedule::with('observations')
        ->with('status')
        ->with('observations.auditor')
        ->where('lecturer_id', Auth::user()->id)
        ->select('*')->orderBy("status_id");
            return Datatables::of($data)
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('status_id'))) {
                            $instance->where('status_id', $request->get('status_id'));
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
        $data = Observation::with('auditor')
        ->where('schedule_id', $request->get('schedule_id'))
        ->select('*');
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
        $data = Observation::with('schedule')->with('schedule.lecturer')->where('auditor_id', Auth::user()->id)->select('*')->orderBy('attendance');
            return Datatables::of($data)
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('lecturer_id'))) {
                            $instance->whereHas('schedule', function($q) use($request){
                                $q->where('lecturer_id', $request->get('lecturer_id'));
                            });
                        }

                        if (!empty($request->get('attendance'))) {
                            if($request->get('attendance') == "1"){
                                $instance->where('attendance', $request->get('attendance'));
                            } elseif($request->get('attendance') == "2") {
                                $instance->where('attendance', false);
                            }
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

    public function follow_up_by_dean_id(Request $request)
    {
        $data = Follow_up::with('schedule')->with('schedule.lecturer')
        ->where('dean_id', Auth::user()->id)->select('*')->orderBy('remark');
            return Datatables::of($data)
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('lecturer_id'))) {
                            $instance->whereHas('schedule', function($q) use($request){
                                $q->where('lecturer_id', $request->get('lecturer_id'));
                            });
                        }
                        if (!empty($request->get('attendance'))) {
                            if($request->get('attendance') == "1"){
                                $instance->where('image_path','!=', null);
                            } elseif($request->get('attendance') == "2") {
                                $instance->whereNull('image_path');
                            }
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
        if(Auth::user()->hasRole('LE')){
            $data['mypo'] = Schedule::where("lecturer_id", Auth::user()->id)->where("status_id","!=", "S06")
                ->select('status_id',DB::raw('COUNT(status_id) as notif'))
                ->groupBy('status_id')
                ->first();
        }
        return response()->json($data);
    }

    public function recap(Request $request)
    {
        $data = Schedule::query()
        ->with('status')
        ->with(['lecturer' => function ($query) {
            $query->select('id','name');
        }])
        ->with('observations')
        ->with('observations.auditor')
        ->with('observations.observation_criterias')
        ->select('*')->orderBy("status_id");
            return Datatables::of($data)
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('lecturer_id'))) {
                            $instance->where('lecturer_id', $request->get('lecturer_id'));
                        }
                        if (!empty($request->get('status_id'))) {
                            $instance->where('status_id', $request->get('status_id'));
                        }
                        if (!empty($request->get('study_program'))) {
                            $instance->where('study_program', $request->get('study_program'));
                        }
                        if (!empty($request->get('range'))) {
                            if($request->get('range') != "" || $request->get('range') != null){
                                $x = explode(" - ",$request->get('range'));
                                $instance->whereDate('date_start', '<=', date('Y-m-d 23:59',strtotime($x[1])));
                                $instance->whereDate('date_end', '>=', date('Y-m-d H:i',strtotime($x[0])));
                            }
                        }
                    })
                    ->addColumn('link', function($x){
                        return Crypt::encrypt($x['id']);
                      })
                    ->rawColumns(['link'])
                    ->make(true);
    }







    public function tes(Request $request)
    {

        $data = Schedule::query()
        ->with('status')
        ->with(['lecturer' => function ($query) {
            $query->select('id','name');
        }])
        ->with('observations')
        ->with('observations.auditor')
        ->with('observations.observation_criterias')
        ->select('*')->orderBy("status_id");

        // return response()->json( $data );

        return Datatables::of($data)->make(true);
    }

}
