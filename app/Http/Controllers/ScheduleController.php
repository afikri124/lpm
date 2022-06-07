<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Status;
use App\Models\Schedule;
use Auth;

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
                    })->get();
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
            return redirect()->route('schedules.edit', $schedule);
        } 
        $lecturer = User::select('id','email','name')->whereHas('roles', function($q){
                        $q->where('role_id', "LE");
                    })->get();
        return view('schedules.add', compact('lecturer'));
    }

    public function edit($id, Request $request) {
        if ($request->isMethod('post')) {
            // $this->validate($request, [ 
            //     'criteria_category_id'=> ['required'],
            //     'title'=> ['required', 'string', 'max:255'],
            //     'weight'=> ['required', 'numeric'],
            // ]);
            // $data = Schedule::find($id)->update(request()->all());
            // return redirect()->route('settings.criterias');
        }
        $data = Schedule::with('lecturer')->with('status')->find($id);
        if($data == null){
            abort(403, "Cannot access to restricted page");
        }
        $auditors = User::select('id','email','name')->whereHas('roles', function($q){
                        $q->where('role_id', "AU");
                    })->get();
        return view('schedules.edit', compact('data','auditors'));
    }
}
