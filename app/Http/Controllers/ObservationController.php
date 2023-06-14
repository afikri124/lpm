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
use App\Models\Setting;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use DB;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Encryption\DecryptException;
use phpDocumentor\Reflection\Location;
use Jenssegers\Date\Date;
use App\Jobs\JobNotification;
use App\Jobs\JobNotificationWA;

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

    public function me(Request $request) {
        $status = Status::get();
        return view('observations.me', compact('status'));
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
                $schedule = Schedule::with('lecturer')->find($data->schedule_id);
                    if($auditor->email != null || $auditor->email != ""){
                        $d['email'] = $auditor->email;
                        $d['subject'] = "Pembatalan Auditor";
                        $d['name'] = $auditor->name_with_title;
                        $d['messages'] = "Anda telah <b>dibatalkan sebagai Auditor</b> pada jadwal berikut:";
                        $d['study_program'] = $schedule->study_program;
                        $d['auditee'] = $schedule->lecturer->name_with_title;
                        $d['auditee_hp'] = $schedule->lecturer->phone;
                        $d['auditee_email'] = $schedule->lecturer->email;
                        $d['start'] = Date::createFromDate($schedule->date_start)->format('l, j F Y (H:i)');
                        $d['end'] = Date::createFromDate($schedule->date_end)->format('l, j F Y (H:i)');
            
                        dispatch(new JobNotification($d)); //send Email using queue job
                    }
                    //--------------------end email--------------

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
            $count_auditor = Observation::where('schedule_id', $request->schedule_id)->count();
            $check_auditor = Observation::where('schedule_id', $request->schedule_id)->where('auditor_id', $request->auditor_id)->count();
            $TOTALAUDITOR = Setting::findOrFail('TOTALAUDITOR');
            if($count_auditor >= $TOTALAUDITOR->content ){
                return response()->json([
                    'success' => false,
                    'message' => 'Not allowed! maximum of '.$TOTALAUDITOR->content.' auditors.'
                ]);
            } else if($check_auditor > 0){
                return response()->json([
                    'success' => false,
                    'message' => 'Not allowed! auditors must be different.'
                ]);
            }else {
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
                    $schedule = Schedule::with('lecturer')->find($request->schedule_id);
                    if($auditor->email != null || $auditor->email != ""){
                        $d['email'] = $auditor->email;
                        $d['subject'] = "Auditor Peer-Observation";
                        $d['name'] = $auditor->name_with_title;
                        $d['messages'] = "Anda mendapatkan tugas sebagai Auditor <i><a href='".url('/dashboard')."'>Peer-Observation</a> </i>yang dilaksanakan oleh LPM JGU dan mendapatkan jadwal sebagaimana yang tertera dalam tabel berikut:";
                        $d['study_program'] = $schedule->study_program;
                        $d['auditee'] = $schedule->lecturer->name_with_title;
                        $d['auditee_hp'] = $schedule->lecturer->phone;
                        $d['auditee_email'] = $schedule->lecturer->email;
                        $d['start'] = Date::createFromDate($schedule->date_start)->format('l, j F Y (H:i)');
                        $d['end'] = Date::createFromDate($schedule->date_end)->format('l, j F Y (H:i)');
            
                        dispatch(new JobNotification($d)); //send Email using queue job
                    }
                    //--------------------end email--------------
                    //----------------WA-------------------------------
                    $wa_to = $auditor->phone;
                    if($wa_to != null){
                        $WA_DATA = array();
                        $WA_DATA['wa_to'] = $wa_to;
                        $WA_DATA['wa_text'] = "Bpk/Ibu ".$auditor->name_with_title.",
Anda ditugaskan untuk mengaudit ".$schedule->lecturer->name_with_title.", pada 
".Date::createFromDate($schedule->date_start)->format('l, j F Y (H:i)').". 
Info selengkapnya silakan akses sistem PO LPM JGU.";
                        dispatch(new JobNotificationWA($WA_DATA));
                    }
                    // ------------------end send to WA-----------------
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

    public function view($id, Request $request){
        try {
            $o_id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->route('observations');
        }
        if ($request->isMethod('POST') && isset($request->submit)) {
            $this->validate($request, [ 
                'questions'=> ['required'],
                'image_path' => ['required','image'],
                'remark'=> ['required','string', 'min:350'],
            ]);

            $imageName = Carbon::now()->format('Ym').'_'.md5($o_id).'.'.$request->image_path->extension(); 
            $folderName =  "storage/images/observations";
            $path = public_path()."/".$folderName;
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true); //create folder
            }
            $request->image_path->move($path, $imageName); //upload image to folder
            DB::beginTransaction();
            try {
                $updatePO = DB::table('observations')->where('id',$o_id)
                    ->update([
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
                $o = Observation::with('schedule')->findOrFail($o_id);
                if($updatePO){
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

                        //TODO : SEND EMAIL TO LECTURER (result)
                        $schedule = Schedule::with('lecturer')->find($o->schedule_id);
                        if($schedule->lecturer->email != null || $schedule->lecturer->email != ""){
                            $d['email'] = $schedule->lecturer->email;
                            $d['subject'] = "Hasil Peer-Observation";
                            $d['name'] = $schedule->lecturer->name_with_title;
                            $d['messages'] = "Menginformasikan bahwa, hasil audit <i>Peer-Observation</i> anda sudah dapat dilihat melalui tautan <a href='".url('/pdf/report/'.Crypt::encrypt($o->schedule_id))."'>lpm.jgu.ac.id/observations/me</a>
                            <br><br>Selanjutnya, silahkan lakukan Validasi PO dengan langkah berikut ini:<br>
                            1. Akses <a href='".url('/observations/me')."'>Sistem Peer-Observation</a><br>
                            2. Tekan menu <b>My PO</b><br>
                            3. Klik tombol <b>PO Validation</b> (ikon palu berwarna kuning)<br>
                            4. Lakukan validasi atau tolak hasil PO Anda.";
                            dispatch(new JobNotification($d)); //send Email using queue job
                        }
                        //--------------------end email--------------
                        //----------------WA-------------------------------
                        $wa_to = $schedule->lecturer->phone;
                        if($wa_to != null){
                            $WA_DATA = array();
                            $WA_DATA['wa_to'] = $wa_to;
                            $WA_DATA['wa_text'] = "Bpk/Ibu ".$schedule->lecturer->name_with_title.",
Hasil sementara Peer-Observation Anda sudah dapat dilihat, 
segera lakukan Validasi hasil PO Anda melalui sistem PO LPM JGU.";
                            dispatch(new JobNotificationWA($WA_DATA));
                        }
                        // ------------------end send to WA-----------------
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
                if($criteria_categories){
                    $x = Schedule_history::insert([
                        'schedule_id' => $o->schedule_id,
                        'description' => "<b>".Auth::user()->name."</b> has <u>made</u> observations.",
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now(),
                    ]);
                }
                DB::commit();
                // all good
                return redirect()->route('observations');
            } catch (\Exception $e) {
                DB::rollback();
                echo "An error occurred, please notify the system developer!<br><br>";
                echo $e;
            }
        } else {
            $data = Observation::with('auditor')->with('schedule')->findOrFail($o_id);
            $auditor = Observation::with('auditor')->where('schedule_id', $data->schedule_id)->get();
            $lecturer = User::find($data->schedule->lecturer_id);
            $CONTACT = Setting::findOrFail('CONTACT');
            if($data->attendance == false){                             //belum hadir/belum dinilai
                if(Carbon::now() < $data->schedule->date_start){        //Belum waktunya audit
                    return view('observations.view', compact('data', 'lecturer','auditor'))
                    ->withErrors(['msg' => 'Sorry, it\'s not time to make observations, please contact admin for schedule changes. '.$CONTACT->title.": ".$CONTACT->content ]);
                } else if(Carbon::now() > $data->schedule->date_end){   //Sudah kelewat waktunya
                    return view('observations.view', compact('data', 'lecturer','auditor'))
                    ->withErrors(['msg' => 'Sorry, you have missed the specified schedule, please contact admin for rescheduling. '.$CONTACT->title.": ".$CONTACT->content]);
                } else {
                    $locations = Locations::orderBy('title')->get();
                    $survey = Criteria_category::
                    with(["criterias" => function($q){
                        $q->where('criterias.status', '=', true);
                    }])
                    ->where('status', true)->get();
                    return view('observations.make', compact('data', 'lecturer', 'survey', 'locations','auditor'));
                }
            } else {
                $survey = Observation_category::with('criteria_category')
                        ->with('observation_criterias')
                        ->with('observation_criterias.criteria')
                        ->where('observation_id', $o_id)
                        ->orderBy('criteria_category_id')->get();
                return view('observations.view', compact('data', 'lecturer', 'survey','auditor'));
            }
        }
    }

    public function results($id, Request $request){
        try {
            $o_id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->route('observations');
        }
            $data = Observation::with('auditor')->with('schedule')->findOrFail($o_id);
            $lecturer = User::find($data->schedule->lecturer_id);
            $survey = Observation_category::with('criteria_category')
                        ->with('observation_criterias')
                        ->with('observation_criterias.criteria')
                        ->where('observation_id', $o_id)
                        ->orderBy('criteria_category_id')->get();
            return view('observations.view', compact('data', 'lecturer', 'survey'));
    }

    public function validations($id, Request $request){
        try {
            $s_id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->route('schedules');
        }
        if ($request->isMethod('POST')) {
            if($request->action == "reject"){
                $data = Schedule::findOrFail($s_id)
                ->update([ 
                    'status_id'=> 'S08',
                    'validation_remark'=> $request->validation_remark,
                ]);
                if($data){
                    $x = Schedule_history::insert([
                        'schedule_id' => $s_id,
                        'description' => "<b>".Auth::user()->name."</b> <u>rejected the results</u> of peer observation.",
                        'remark' => $request->validation_remark,
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now(),
                    ]);
                    //TODO : SEND EMAIL TO LECTURER (Reject Info)
                    $schedule = Schedule::with('lecturer')->find($s_id);
                    if($schedule->lecturer->email != null || $schedule->lecturer->email != ""){
                        $d['email'] = $schedule->lecturer->email;
                        $d['subject'] = "Hasil Peer-Observation Berhasil Ditolak!";
                        $d['name'] = $schedule->lecturer->name_with_title;
                        $d['messages'] = "Menginformasikan bahwa, Anda baru saja menolak hasil audit <i>Peer-Observation</i>, tindaklanjut akan segera dijadwalkan oleh Tim LPM untuk membahas hasil PO Anda.";
                        dispatch(new JobNotification($d)); //send Email using queue job
                    }
                    //--------------------end email--------------

                    return redirect()->route('observations.validations', $id);
                }

            } else if($request->action == "validate"){
                $data = Schedule::findOrFail($s_id)
                ->update([ 
                    'status_id'=> 'S07'
                ]);
                if($data){
                    $x = Schedule_history::insert([
                        'schedule_id' => $s_id,
                        'description' => "<b>".Auth::user()->name."</b> has <u>validated the observation</u>.",
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now(),
                    ]);
                    return redirect()->route('observations.validations', $id);
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
            ->whereIn('observation_id',$oids)->orderBy('criteria_category_id')->orderBy('observation_id')->get()->groupBy('criteria_category_id');
            $dean = User::select('id','email','name','department')->whereHas('roles', function($q){
                $q->where('role_id', "DE");
            })->where('username','!=', 'admin')->where('id','!=', $data->lecturer_id)->get();
            $MINSCORE = Setting::findOrFail('MINSCORE');
            $hod = Setting::findOrFail('HODLPM');
            return view('observations.validations', compact('id','data', 'survey', 'dean', 'MINSCORE','hod'));
        }
    }

}
