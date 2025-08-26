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
use App\Models\Schedule_history;
use App\Models\Role;
use App\Models\User_role;
use App\Models\Setting;
use App\Models\StudyProgram;
use App\Models\Publication;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use File;
use Jenssegers\Date\Date;
use App\Jobs\JobNotificationWA;

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
        $data = Criteria_category::select('*')->orderByDesc('status')->orderBy('id');
            return Datatables::of($data)
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('status'))) {
                            $bools = $request->get('status') === 'true'? true: false;
                            $instance->where('status', $bools);
                        }
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
        $data = Criteria::with('category')->select('*')->orderByDesc('status')->orderBy('id');
            return Datatables::of($data)
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('category'))) {
                            $instance->where('criteria_category_id', $request->get('category'));
                        }
                        if (!empty($request->get('status'))) {
                            $bools = $request->get('status') === 'true'? true: false;
                            $instance->where('status', $bools);
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

    public function study_program(Request $request)
    {
        $data = StudyProgram::with('acreditation')->select('*')->orderBy('name')->orderBy('id');
            return Datatables::of($data)
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('acreditation'))) {
                            $instance->where('acreditation_id', $request->get('acreditation'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                    $w->orWhere('name', 'LIKE', "%$search%");
                            });
                        }
                    })
                    ->addColumn('link', function($x){
                        return Crypt::encrypt($x['id']);
                      })
                    ->rawColumns(['link'])
                    ->make(true);
    }

    public function publication(Request $request)
    {
        $data = Publication::with('user')->select('*')->orderByDesc('id');
            return Datatables::of($data)
                    ->filter(function ($instance) use ($request) {
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
                ->with('lecturer')->with('status')
                ->with('observations.auditor')
                ->select('*')->orderBy("status_id")->orderBy("date_start");
            return Datatables::of($data)
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('lecturer_id'))) {
                            $instance->where('lecturer_id', $request->get('lecturer_id'));
                        }

                        if (!empty($request->get('auditor_id'))) {
                            $instance->whereHas('observations', function($q) use($request){
                                $q->where('auditor_id', $request->get('auditor_id'));
                            });
                        }

                        if (!empty($request->get('status_id'))) {
                            $instance->where('status_id', $request->get('status_id'));
                        }
                        
                        if (!empty($request->get('range'))) {
                            if($request->get('range') != "" && $request->get('range') != null && $request->get('range') != "Invalid date - Invalid date"){
                                $x = explode(" - ",$request->get('range'));
                                $instance->whereDate('date_start', '<=', date('Y-m-d 23:59',strtotime($x[1])));
                                $instance->whereDate('date_end', '>=', date('Y-m-d 00:00',strtotime($x[0])));
                            }
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
                ->select('*')->orderByDesc("id");
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
        $data = Observation::with('schedule')
                ->with('schedule.lecturer')
                ->with('schedule.status')
                ->where('auditor_id', Auth::user()->id)
                ->select('*')->orderBy('attendance')->orderByDesc('updated_at');
            return Datatables::of($data)
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('lecturer_id'))) {
                            $instance->whereHas('schedule', function($q) use($request){
                                $q->where('lecturer_id', $request->get('lecturer_id'));
                            });
                        }

                        if (!empty($request->get('attendance')) && $request->get('attendance') != null && $request->get('attendance') != "") {
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
        if(Auth::user()->hasRole('AD')){
            $data = Follow_up::with('schedule')->with('dean')
                ->with('schedule.lecturer')
                ->select('*')->orderBy('remark');
        } else if(Auth::user()->hasRole('DE')){
            $data = Follow_up::with('schedule')->with('dean')
            ->with('schedule.lecturer')
            ->where('dean_id', Auth::user()->id)
            ->select('*')->orderBy('remark');
        }
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
                        if (!empty($request->get('range'))) {
                            if($request->get('range') != "" && $request->get('range') != null && $request->get('range') != "Invalid date - Invalid date"){
                                $x = explode(" - ",$request->get('range'));
                                $instance->whereDate('date_start', '<=', date('Y-m-d 23:59',strtotime($x[1])));
                                $instance->whereDate('date_end', '>=', date('Y-m-d 00:00',strtotime($x[0])));
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
            $data['schedules'] = Schedule::where(function ($query) {
                    $query->where('status_id', '=', 'S07')
                        ->orWhere('status_id', '=', 'S08');
                })
                ->whereDate('date_start', '>', Carbon::now()->startOfMonth()->subMonth(5))
                ->select(DB::raw('COUNT(*) as notif'))
                ->first();
        }
        if(Auth::user()->hasRole('AU')){
            $data['observations'] = Observation::join('schedules as s', 's.id', '=', 'observations.schedule_id')
                ->where("auditor_id", Auth::user()->id)
                ->where("attendance", false)
                ->where(function ($query) {
                    $query->where('s.status_id', '=', 'S00')
                        ->orWhere('s.status_id', '=', 'S01')
                        ->orWhere('s.status_id', '=', 'S02');
                })
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
        } else {
            $data['notifications'] = null;
        }
        return response()->json($data);
    }

    public function recap(Request $request)
    {
        $data = Schedule::
                // ->query()
                // leftJoin(
                //     DB::raw("
                //     (
                //         select o.schedule_id, sum(tabel1.hasil) as hasil_final from observations o
                //         LEFT JOIN (
                //             select observation_id, sum(score * weight) as hasil from observation_criterias
                //             GROUP BY observation_id
                //         ) tabel1 on o.id = tabel1.observation_id
                //         GROUP BY o.schedule_id
                //     ) tabel2
                //     "), 'id', '=', 'tabel2.schedule_id'
                // )
                leftJoin(
                    DB::raw("
                    (
                        select o.schedule_id, sum(tabel1.hasil) as hasil_final, sum(max_weight) as max_weight from observations o
                        LEFT JOIN (
                            select observation_id, sum(score * weight) as hasil, sum(weight) as max_weight from observation_criterias
                            GROUP BY observation_id
                        ) tabel1 on o.id = tabel1.observation_id
                        GROUP BY o.schedule_id
                    ) tabel2
                    "), 'id', '=', 'tabel2.schedule_id'
                )
                ->with('status')
                ->with(['lecturer' => function ($query) {
                    $query->select('id','name');
                }])
                ->with('observations')
                ->with('observations.auditor')
                // ->with('observations.observation_criterias')
                ->select(DB::raw('tabel2.hasil_final * 100 / (tabel2.max_weight * schedules.max_score) as final'),'schedules.*')
                ->orderByDesc("final")->orderByDesc("status_id")->orderBy("date_start");
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
                            if($request->get('range') != "" && $request->get('range') != null && $request->get('range') != "Invalid date - Invalid date"){
                                $x = explode(" - ",$request->get('range'));
                                $instance->whereDate('date_start', '<=', date('Y-m-d 23:59',strtotime($x[1])));
                                $instance->whereDate('date_end', '>=', date('Y-m-d 00:00',strtotime($x[0])));
                            }
                        }
                    })
                    ->addColumn('link', function($x){
                        return Crypt::encrypt($x['id']);
                      })
                    ->rawColumns(['link'])
                    ->make(true);
    }

    public function update_dosen(Request $request)
    {
        $json = File::get(database_path() . "/data/dosen.json");
        $loc = json_decode($json);
  
        foreach ($loc as $key => $v) {
            $user = User::where('username', $v->id)->first();
            if($user != null){
                $f = (isset($v->front) ? $v->front: null);
                $b = (isset($v->back) ? $v->back: null);
                $h = (isset($v->hp) ? $v->hp: null);
                $e = (isset($v->email) ? $v->email: null);
                $user->update([
                'front_title' => $f,
                'back_title' => $b,
                'email' => ($user->email == null ? $e:$user->email),
                'phone' => ($h != null ? $h:$user->phone),
                'updated_at' => Carbon::now()
                ]);
                
                echo $user->name."<br>";
            }
        }
    }

    public function histories(Request $request)
    {
        $data = Schedule_history::with('schedule')->with('schedule.lecturer')->select('id','description','created_at', 'schedule_id')->orderByDesc("created_at");
            return Datatables::of($data)
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('search'))) {
                            $instance->where(function($w) use($request){
                               $search = $request->get('search');
                                   $w->orWhere('description', 'LIKE', "%$search%");
                           });
                       }
                    })
                    ->make(true);
    }




    public function tes(Request $request)
    {
        $d = array();
        $d['wa_text'] = 'tess api WA haha
        
        Approve
        https://s.jgu.ac.id
        
        Reject
        jgu.ac.id/apa-gitu';
        $d['wa_to'] = '081233933313';
        dispatch(new JobNotificationWA($d));
        // $data = Follow_up::with('dean')
        // ->whereNull('remark')
        // ->whereDate('date_start', '<=', Carbon::now()->endOfDay())
        // ->whereDate('date_end', '>=', Carbon::today())
        // ->groupBy("dean_id")
        // ->select("dean_id")->get();
        // // Observation::join('schedules as s', 's.id', '=', 'observations.schedule_id')->with('auditor')
        // // ->where('attendance', false)
        // // ->where(function ($query) {
        // //     $query->where('s.status_id', '=', 'S00')
        // //           ->orWhere('s.status_id', '=', 'S01')
        // //           ->orWhere('s.status_id', '=', 'S02');
        // // })
        // // ->whereDate('s.date_start', '<=', Carbon::now()->endOfDay())
        // // // ->whereDate('s.date_end', '>=', Carbon::today())
        // // ->groupBy("auditor_id")
        // // ->select("auditor_id")->get();


        // return response()->json( $data );

        // // return Datatables::of($data)->make(true);
    }

}
