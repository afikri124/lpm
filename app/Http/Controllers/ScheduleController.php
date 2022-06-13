<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Status;
use App\Models\Schedule;
use App\Models\Schedule_history;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

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
                    })->where('username','!=', 'admin')->get();
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
            return redirect()->route('schedules.edit', $schedule);
        } 
        $lecturer = User::select('id','email','name')->whereHas('roles', function($q){
                        $q->where('role_id', "LE");
                    })->where('username','!=', 'admin')->get();
        return view('schedules.add', compact('lecturer'));
    }

    public function edit($id, Request $request) {
        $id = Crypt::decrypt($id);
          if ($request->isMethod('post')) {
            $this->validate($request, [ 
                'date_start' => ['required', 'date'],
                'date_end' => ['required', 'date'],
                'reschedule_reason' => ['required'],
            ]);
            $data = Schedule::find($id)
            ->update([ 
                'date_start'=> $request->date_start,
                'date_end'=> $request->date_end
            ]);
            if($data){
                $x = Schedule_history::insert([
                    'schedule_id' => $id,
                    'description' => "The observation schedule has been rescheduled by <b>".Auth::user()->name."</b>.",
                    'remark' => $request->reschedule_reason,
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                ]);
            
            //TODO : SEND EMAIL RESCHEDULE TO AUDITOR

            }
            return redirect()->route('schedules.edit', $id);
        }
        $data = Schedule::with('lecturer')->with('status')->with('created_user')->with('histories')->findOrFail($id);
        $auditors = User::select('id','email','name')->whereHas('roles', function($q){
                        $q->where('role_id', "AU");
                    })->where('username','!=', 'admin')->where('id','!=', $data->lecturer_id)->get();
        return view('schedules.edit', compact('data','auditors'));
    }
}
