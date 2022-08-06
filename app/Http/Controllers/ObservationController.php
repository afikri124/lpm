<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Observation;
use App\Models\Status;
use App\Models\Schedule_history;
use App\Models\Criteria_category;
use App\Models\Criteria;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;

class ObservationController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {
           $lecturer = User::select('id','name')->whereHas('roles', function($q){
                        $q->where('role_id', "LE");
                    })->where('username','!=', 'admin')->get();
        return view('observations.index', compact('lecturer'));
    }
    
    public function delete(Request $request) {
        $data = Observation::find($request->id);
        if($data){
            $data->delete();
            $auditor = User::find($data->auditor_id);
                $x = Schedule_history::insert([
                    'schedule_id' => $data->schedule_id,
                    'description' => "<b>".$auditor->name."</b> has been <u>canceled</u> as an auditor on this schedule by ".Auth::user()->name.".",
                    'remark' => null,
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                ]);
            //TODO : SEND EMAIL cancelled TO AUDITOR
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
                'auditor_id'=> ['required'],
                'schedule_id' => ['required'],
            ]);
            $data = Observation::insert([
                'schedule_id' => $request->schedule_id,
                'auditor_id' => $request->auditor_id,
                'created_at' => Carbon::now(),
            ]);
            if($data){
                $auditor = User::find($request->auditor_id);
                $x = Schedule_history::insert([
                    'schedule_id' => $request->schedule_id,
                    'description' => Auth::user()->name." has <u>added</u> <b>".$auditor->name."</b> as an auditor.",
                    'remark' => null,
                    'created_by' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                ]);
                //TODO : SEND EMAIL notif TO AUDITOR

                return response()->json([
                    'success' => true,
                    'message' => 'Observer added successfully!'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to add!'
                ]);
            }
        }
    }

    public function view($id, Request $request){
        if ($request->isMethod('POST') && isset($request->submit)) {
            $this->validate($request, [ 
                'questions[*]'=> ['required'],
                'study_program'=> ['required'],
                'remark'=> ['required'],
                'image_path' => ['required','image'],
            ]);
            // var_dump($request->questions);
            // var_dump($request->categories);
            return Datatables::of($request->questions)->make(true);
            // var_dump($request->weigth);
            // var_dump($request->category);
        } else {
            $o_id = Crypt::decrypt($id);
            $data = Observation::with('auditor')->with('schedule')->findOrFail($o_id);
            $lecturer = User::find($data->schedule->lecturer_id);
            $study_program = User::select('study_program')->groupBy('study_program')->get();
            $survey = Criteria_category::with('criterias')->get();
            return view('observations.view', compact('data', 'lecturer', 'study_program', 'survey'));
        }
    }


}
