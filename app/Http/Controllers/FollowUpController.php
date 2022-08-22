<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\User;
use App\Models\Schedule;
use App\Models\Setting;
use App\Models\Observation_category;
use App\Models\Follow_up;
use App\Models\Schedule_history;
use DB;
use Illuminate\Support\Facades\File;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class FollowUpController extends Controller
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
        return view('follow_ups.index', compact('status','lecturer'));
    }

    public function view($id, Request $request){
        try {
            $f_id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->route('follow_up');
        }
        $follow_up = Follow_up::with('schedule')->with('dean')->findOrFail($f_id);
        if ($request->isMethod('POST')) {
            $this->validate($request, [ 
                'image_path' => ['required','image'],
                'remark'=> ['required', 'string', 'min:500'],
            ]);
            $imageName = Carbon::now()->format('Ym').'_'.md5($f_id).'.'.$request->image_path->extension(); 
            $folderName =  "images/follow_up";
            $path = public_path()."/".$folderName;
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true); //create folder
            }
            $request->image_path->move($path, $imageName); //upload image to folder
            DB::beginTransaction();
            try {
                $updateFU = DB::table('follow_ups')->where('id',$f_id)
                    ->update([
                        'remark'=> $request->remark,
                        'image_path'=> $folderName."/".$imageName,
                        'updated_at'=> Carbon::now()
                ]);
                if($updateFU){
                    if($follow_up->schedule->status_id == 'S04'){
                        DB::table('schedules')->where('id',$follow_up->schedule_id)
                            ->update([
                            'status_id'=> 'S05'
                        ]);
                    }
                    $x = Schedule_history::insert([
                        'schedule_id' => $follow_up->schedule_id,
                        'description' => "<b>".Auth::user()->name."</b> has <u>followed up</u>.",
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now(),
                    ]);
                    
                    //TODO : SEND EMAIL notif TO LECTURER
                }

                DB::commit();
                // all good
                return redirect()->route('follow_up.view',['id' => $id]);
            } catch (\Exception $e) {
                DB::rollback();
                echo "An error occurred, please notify the system developer!<br><br>";
                echo $e;
            }
        } else {
            $data = Schedule::with('lecturer')->with('status')->with('observations')
                    ->with('observations.auditor')
                    ->findOrFail($follow_up->schedule_id);
            $oids = array();
            foreach($data->observations as $idx)
            {
                array_push($oids, $idx->id);
            }
            $survey = Observation_category::with('criteria_category')->with('observation_criterias')
                    ->with('observation_criterias.criteria')
                    ->whereIn('observation_id',$oids)->orderBy('criteria_category_id')
                    ->get()->groupBy('criteria_category_id');
            $dean = User::select('id','email','name','department')->whereHas('roles', function($q){
                $q->where('role_id', "DE");
            })->where('username','!=', 'admin')->where('id','!=', $data->lecturer_id)->get();
            $MINSCORE = Setting::findOrFail('MINSCORE');
            return view('follow_ups.view', compact('id', 'follow_up', 'data', 'survey', 'dean', 'MINSCORE'));
        }
    }
}
