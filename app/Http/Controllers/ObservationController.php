<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Observation;
use App\Models\Status;
use App\Models\Schedule_history;
use App\Models\Criteria_category;
use App\Models\Observation_category;
use App\Models\Schedule;
use App\Models\Locations;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use DB;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Encryption\DecryptException;
use phpDocumentor\Reflection\Location;

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
            File::delete(public_path()."/".$data->image_path);
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
        try {
            $o_id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->route('observations');
        }
        if ($request->isMethod('POST') && isset($request->submit)) {
            $this->validate($request, [ 
                'questions'=> ['required'],
                'study_program'=> ['required'],
                'image_path' => ['required','image'],
                'remark'=> ['required'],
            ]);

            $imageName = Carbon::now()->format('Ym').'_'.md5($o_id).'.'.$request->image_path->extension(); 
            $folderName =  "images/observations";
            $path = public_path()."/".$folderName;
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true); //create folder
            }
            $request->image_path->move($path, $imageName); //upload image to folder
            DB::beginTransaction();
            try {
                $updatePO = DB::table('observations')->where('id',$o_id)
                    ->update([
                        'study_program'=> $request->study_program,
                        'total_students'=> $request->total_students,
                        'class_type'=> $request->class_type,
                        'location'=> $request->location,
                        'subject_course'=> $request->subject_course,
                        'topic'=> $request->topic,
                        'remark'=> $request->remark,
                        'image_path'=> $folderName."/".$imageName,
                        'updated_at'=> Carbon::now(),
                        'attendance'=> true
                ]);

                if($updatePO){
                    $o = Observation::with('schedule')->findOrFail($o_id);
                    if($o->schedule->status_id == 'S00' || $o->schedule->status_id == 'S01'){
                        DB::table('schedules')->where('id',$o->schedule_id)
                            ->update([
                            'status_id'=> 'S02'
                        ]);
                    } else if ($o->schedule->status_id == 'S02'){
                        DB::table('schedules')->where('id',$o->schedule_id)
                            ->update([
                            'status_id'=> 'S03'
                        ]);
                    }
                }

                foreach($request->categories as $key => $remark) {
                    if(!Observation_category::where('observation_id', $o_id)->where('criteria_category_id', $key)->first()){
                        DB::table('observation_categories')->insert([
                            'observation_id' => $o_id,
                            'criteria_category_id' => $key,
                            'remark' => $remark,
                        ]);
                    }
                }
                $criteria_categories = Observation_category::where('observation_id', $o_id)->get();
                foreach($criteria_categories as $cc) {
                    foreach($request->questions as $key => $q) {
                        if($cc->criteria_category_id == $q['c']){
                            DB::table('observation_criterias')->insert([
                                'observation_id' => $o_id,
                                'criteria_id' => $key,
                                'score' => $q['s'],
                                'weight' => $q['w'],
                                'observation_category_id' => $cc->id,
                            ]);
                        }
                    }
                }
                DB::commit();
                // all good
                return redirect()->route('observations');
            } catch (\Exception $e) {
                DB::rollback();
                // something went wrong
                echo $e;
            }
        } else {
            $data = Observation::with('auditor')->with('schedule')->findOrFail($o_id);
            $lecturer = User::find($data->schedule->lecturer_id);
            if($data->attendance == false){ //belum hadir/belum dinilai
                if(Carbon::now() < $data->schedule->date_start){ //Belum waktunya audit
                    return view('observations.view', compact('data', 'lecturer'))
                    ->withErrors(['msg' => 'Sorry, it\'s not time to make observations, please contact admin for schedule changes.']);
                } else if(Carbon::now() > $data->schedule->date_end){ //Sudah kelewat waktunya
                    return view('observations.view', compact('data', 'lecturer'))
                    ->withErrors(['msg' => 'Sorry, you have missed the specified schedule, please contact admin for rescheduling.']);
                } else {
                    $study_program = User::select('study_program')->groupBy('study_program')->get();
                    $locations = Locations::orderBy('title')->get();
                    $survey = Criteria_category::with('criterias')->get();
                    return view('observations.make', compact('data', 'lecturer', 'study_program', 'survey', 'locations'));
                }
            } else {
                $survey = Observation_category::with('criteria_category')->with('observation_criterias')->with('observation_criterias.criteria')
                        ->where('observation_id', $o_id)->orderBy('criteria_category_id')->get();
                return view('observations.view', compact('data', 'lecturer', 'survey'));
            }
        }
    }


}
