<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Status;
use App\Models\Schedule;
use App\Models\Schedule_history;
use App\Models\Observation;
use App\Models\Observation_category;
use App\Models\Follow_up;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class ScheduleController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request) {
        $status = Status::get();
        $lecturer = User::select('id','name')->whereHas('roles', function($q){
                        $q->where('role_id', "LE");
                    })->where('username','!=', 'admin')->orderBy('name')->get();
        return view('schedules.index', compact('status','lecturer'));
    }

    public function delete(Request $request) {
        $data = Schedule::find($request->id);
        if($data){
            $data->delete();
            return response()->json([
                'success' => true,
                'message' => 'Record deleted successfully!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete!'
            ]);
        }
    }

    public function add(Request $request) {
        if ($request->isMethod('post')) {
            $this->validate($request, [ 
                'lecturer_id'=> ['required'],
                'date_start' => ['required', 'date'],
                'date_end' => ['required', 'date'],
            ]);
           
            $schedule = Schedule::create([
                'lecturer_id' => $request->lecturer_id,
                'date_start' => date('Y-m-d H:i', strtotime($request->date_start)),
                'date_end' => date('Y-m-d H:i', strtotime($request->date_end)),
                'status_id' => "S00",
                'created_by' => Auth::user()->id
            ]);
            
            //TODO : SEND EMAIL TO LECTURER
            return redirect()->route('schedules.edit', Crypt::encrypt($schedule->id));
        } else {
            $lecturer = User::select('id','email','name')->whereHas('roles', function($q){
                            $q->where('role_id', "LE");
                        })->where('username','!=', 'admin')->orderBy('name')->get();
            return view('schedules.add', compact('lecturer'));
        }
    }

    public function edit($idd, Request $request) {
        $id = Crypt::decrypt($idd);
          if ($request->isMethod('post')) {
            $this->validate($request, [ 
                'date_start' => ['required', 'date'],
                'date_end' => ['required', 'date'],
                'reschedule_reason' => ['required'],
            ]);
            $data = Schedule::find($id)
            ->update([ 
                'status_id'=> 'S01',
                'date_start'=> $request->date_start,
                'date_end'=> $request->date_end
            ]);
            if($data){
                $x = Schedule_history::insert([
                    'schedule_id' => $id,
                    'description' => "The observation schedule has been <u>rescheduled</u> by <b>".Auth::user()->name."</b>.",
                    'remark' => $request->reschedule_reason,
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                ]);
            
            //TODO : SEND EMAIL RESCHEDULE TO AUDITOR

            }
            return redirect()->route('schedules.edit', Crypt::encrypt($id));
        }
        $data = Schedule::with('lecturer')->with('status')->with('created_user')->with('histories')->findOrFail($id);
        $auditors = User::select('id','email','name')->whereHas('roles', function($q){
                        $q->where('role_id', "AU");
                    })->where('username','!=', 'admin')->where('id','!=', $data->lecturer_id)->get();
        return view('schedules.edit', compact('data','auditors'));
    }

    public function review_observations($id, Request $request){
        try {
            $s_id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->route('schedules');
        }
        if ($request->isMethod('POST')) {
            if($request->action == "followup"){
                $data = Schedule::findOrFail($s_id)
                ->update([ 
                    'status_id'=> 'S04',
                    'remark'=> $request->remark,
                ]);
                if($data){
                    $followup = Follow_up::create([
                        'schedule_id' => $s_id,
                        'dean_id' => $request->dean_id,
                        'date_start' => date('Y-m-d H:i', strtotime($request->date_start)),
                        'date_end' => date('Y-m-d H:i', strtotime($request->date_end)),
                        'created_by' => Auth::user()->id
                    ]);
                    $x = Schedule_history::insert([
                        'schedule_id' => $s_id,
                        'description' => "<b>".Auth::user()->name."</b> changed the observation status to <u>follow-up</u> dean.",
                        'remark' => $request->remark,
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now(),
                    ]);
                    //TODO : SEND EMAIL TO DEAN folow up
                    return redirect()->route('schedules.review_observations', $id);
                }

            } else if($request->action == "result"){
                $data = Schedule::findOrFail($s_id)
                ->update([ 
                    'status_id'=> 'S05',
                    'remark'=> $request->remark,
                ]);
                if($data){
                    $x = Schedule_history::insert([
                        'schedule_id' => $s_id,
                        'description' => "<b>".Auth::user()->name."</b> has upgraded observation status to <u>Result and Recommendation</u>.",
                        'remark' => $request->remark,
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now(),
                    ]);
                    //TODO : SEND EMAIL TO LECTURER (result)
                    return redirect()->route('schedules.edit', $id);
                }
            }
        } else {
            $data = Schedule::with('lecturer')->with('status')->with('observations')->with('observations.auditor')->findOrFail($s_id);
            $oids = array();
            foreach($data->observations as $idx)
            {
                array_push($oids, $idx->id);
            }
            $survey = Observation_category::with('criteria_category')->with('observation_criterias')->with('observation_criterias.criteria')
            ->whereIn('observation_id',$oids)->orderBy('criteria_category_id')->get()->groupBy('criteria_category_id');
            $dean = User::select('id','email','name','department')->whereHas('roles', function($q){
                $q->where('role_id', "DE");
            })->where('username','!=', 'admin')->where('id','!=', $data->lecturer_id)->get();
            return view('schedules.review_observations', compact('id','data', 'survey', 'dean'));
        }
    }
}
