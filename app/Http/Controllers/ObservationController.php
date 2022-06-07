<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Observation;
use Auth;
use Carbon\Carbon;

class ObservationController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function delete(Request $request) {
        $data = Observation::find($request->id);
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
                'auditor_id'=> ['required'],
                'schedule_id' => ['required'],
            ]);
            $data = Observation::insert([
                'schedule_id' => $request->schedule_id,
                'auditor_id' => $request->auditor_id,
                'created_at' => Carbon::now(),
            ]);
            if($data){
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
}
