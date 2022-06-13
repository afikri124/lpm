<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Observation;
use App\Models\Status;
use App\Models\Schedule_history;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

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
                    'description' => "<b>".$auditor->name."</b> has been canceled as an auditor on this schedule by ".Auth::user()->name.".",
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
                    'description' => Auth::user()->name." has added <b>".$auditor->name."</b> as an auditor.",
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
        return $data = Crypt::decrypt($id);
    }


}
