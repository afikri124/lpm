<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Role;
use App\Models\User;
use App\Models\Setting;
use App\Models\StudyProgram;
use App\Models\Acreditation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth'); //access home tidak perlu login
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(env('ALIFIKRI')){
            $CONTACT = Setting::findOrFail('CONTACT');
            $LINKINSTRUMENT = Setting::findOrFail('LINKINSTRUMENT');
            $LINKINSTRUMENT2 = Setting::findOrFail('LINKINSTRUMENT2');
            $LINKINSTRUMENT3 = Setting::findOrFail('LINKINSTRUMENT3');
            $LINKINSTRUMENT4 = Setting::findOrFail('LINKINSTRUMENT4');
            $LINKINSTRUMENT4 = Setting::findOrFail('LINKINSTRUMENT4');
            $study_program = StudyProgram::with('acreditation')
                                ->orderBy(
                                    Acreditation::select('star_point')
                                        ->whereColumn('acreditations.id', 'study_programs.acreditation_id'),
                                    'desc'
                                )
                                ->orderBy('name', 'asc')
                                ->get();
            return view('welcome', compact('CONTACT','LINKINSTRUMENT','LINKINSTRUMENT2','LINKINSTRUMENT3','LINKINSTRUMENT4','study_program'));
        } else {
            $img = "<img style='max-width: 100px;border-radius: 50%;' src='https://img.freepik.com/premium-vector/alert-error-massage-notification-concept-error-digital-report-system-hacking-by-hacker_257312-129.jpg?w=2000'>";
            $msg = "$img<br><br>Sorry, You can't access to restricted page!<br>Please contact <b>afikri124@gmail.com</b>";
            return view('user.error', compact('msg'));
        }
    }

    public function akreditasi()
    {
        $data = Acreditation::orderBy('id')->get();
        return view('page.akreditasi-jgu', compact('data'));
    }

     public function sso_siap(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, 
                [ 
                    'email'=> ['required', 'email'],
                    'password' => ['required'],
                ]
            );
            try {
                $url = env('SevimaAPI_url').'/siakadcloud/v1/user/login';
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'X-App-Key' => env('SevimaAPI_key'),
                    'X-Secret-Key' => env('SevimaAPI_secret'),
                ])->post($url, [
                    'email' => $request->email,
                    'password' => $request->password,
                ]);

                if ($response->successful()) {
                    $data = json_decode(json_encode($response->json())); // atau redirect/simpan token
                    if(is_object($data) && isset($data->attributes) && $data->attributes->status_aktif){ //mengecek akun apakah masih aktif
                        // dd($data->attributes);//test
                        $username = null;
                        $jobName = null;

                        foreach ($data->attributes->role as $role) {
                            if (is_object($role) && isset($role->nama_role)) {
                                $jobName = $role->nama_role;
                            }

                            if (is_object($role) && isset($role->nip)) {
                                $username = $role->nip;
                                break; // Ambil hanya nip yang pertama
                            } else if (is_object($role) && isset($role->nim)) {
                                $username = $role->nim;
                                break; // Ambil hanya nim yang pertama
                            }
                        }
                        $roles = collect($data->attributes->role); // Ambil bagian role saja
                        $hasMhs = $roles->contains(function ($role) {
                            return is_object($role) && $role->id_role === 'mhs';
                        });
                        $hasPeg = $roles->contains(function ($role) {
                            return is_object($role) && $role->id_role === 'peg';
                        });
                        $hasDosen = $roles->contains(function ($role) {
                            return is_object($role) && $role->id_role === 'dosen';
                        });

                        if ($username != null){ // nim/nip tidak null
                            $user = User::where('username', $username)->first(); //cari user by username
                            if ($user != null) { //login
                                if($data->attributes->email != $user->email){
                                    $email = explode("@",$data->attributes->email);
                                    if($email[1] == "jgu.ac.id"){
                                        $emailcheck = User::where('email',$data->attributes->email)->first();
                                        if($emailcheck != null){ //update username base on email
                                            User::where('id',$user->id)->update([
                                                'username' => $username."x", //jika bentrok username diganti
                                            ]);
                                            User::where('email',$data->attributes->emai)->update([
                                                'username' => $username,
                                            ]);
                                        } else { //update email
                                            User::where('id',$user->id)->update([
                                                'email' => $data->attributes->email,
                                            ]);
                                        }
                                    }
                                }
                                Auth::loginUsingId($user->id);
                            } else { //register jika username blm terdaftar
                                $user = User::where('email',$data->attributes->email)->first(); //cari user by email
                                if($user == null){ //jika user tdk ada
                                    if($hasDosen || $hasPeg){
                                        $new_user = User::insert([
                                                'name' => $data->attributes->nama,
                                                'email' => $data->attributes->email,
                                                'username' => $username,
                                                'password'=> Hash::make($username),
                                                'job'=> $jobName,
                                                'email_verified_at' => Carbon::now(),
                                                'created_at' => Carbon::now()
                                        ]);
                                        
                                        if($new_user){
                                            $user = User::where('username', $username)->first();
                                            if($hasPeg){
                                                $user->roles()->attach(Role::where('id', 'ST')->first());
                                            }
                                            if($hasDosen){
                                                $user->roles()->attach(Role::where('id', 'LE')->first());
                                            }
                                        } 
                                    } else {
                                        // echo "User bukan dosen/staf";
                                        $msg = "Sorry, $data->attributes->nama<br>($data->attributes->email)<br>is don't have permission.<br>Please contact the administrator!";
                                        return view('user.error', compact('msg'));
                                    }
                                } else { //jika user ada
                                    $old_user = $user->update([
                                        'name' => $data->attributes->nama,
                                        'username' => $username,
                                        'updated_at' => Carbon::now()
                                    ]);
                                    
                                    if($old_user){
                                        $user = User::where('username', $username)->first();
                                        if(($hasPeg) && !$user->hasRole('ST')){
                                            $user->roles()->attach(Role::where('id', 'ST')->first());
                                        }
                                        if(($hasDosen) && !$user->hasRole('LE')){
                                            $user->roles()->attach(Role::where('id', 'LE')->first());
                                        } 
                                    }  
                                }
                                Auth::loginUsingId($user->id);
                            }
                            if(Auth::user()->password == null || Auth::user()->email == null){
                                return redirect()->route('update_account');
                            } else {
                                return redirect()->route('dashboard');
                            }
                        } else {
                            $msg = "Akun anda tidak memiliki NIP/NIM, tidak diizinkan!";
                            return redirect()->route('sso_siap')->withErrors(['msg' => $msg]);
                        }
                    } else {
                        $msg = "Akun anda sudah tidak aktif !";
                        return redirect()->route('sso_siap')->withErrors(['msg' => $msg]);
                    }
                } else {
                    $responseBody = $response->json();
                    if($responseBody['errors']['code'] == 500){
                        $msg = "<b>".$responseBody['errors']['detail']." (".$responseBody['errors']['code'].")</b><br>Koneksi API ke Sevima gagal, coba beberapa saat lagi..";
                    } else {
                        $msg = "<b>Login gagal (".$responseBody['errors']['code'].")</b><br>".$responseBody['errors']['detail'];
                    }
                    return redirect()->route('sso_siap')->withErrors(['msg' => $msg]);
                }
            } catch (\Exception $e) {
                Log::warning($e);
                return redirect()->route('sso_siap')->withErrors(['msg' => $e->getMessage()]);
            }
        } else {
            return view('auth.login-siap');
        }
    }

    public function sso_klas2(Request $request)
    {
        try {
            if(Session::get('klas2_api_key') != $request->api_key){
                return redirect()->route('login')->withErrors(['msg' => 'API key expired, please try again!']);
            }
            Session::put('klas2_api_key', null);
            if($request->token == md5($request->api_key.$request->id) && env('APP_KEY').gmdate('Y/m/d') == Crypt::decrypt($request->api_key)){
                $user = User::where('username', $request->id)->first();
                if ($user != null) { //login
                    Auth::loginUsingId($user->id);
                    if(Auth::user()->password == null || Auth::user()->email == null){
                        return redirect()->route('update_account');
                    } else {
                        return redirect()->route('dashboard');
                    }
                } else { //register
                    $prodi = null;
                    if($request->dept_id == "ACAD"){
                        $prodi = $request->sub_unit;
                    }
                    $user = User::where('email',$request->email)->first();
                    if($request->email == null){
                        $user = User::where('username',$request->id)->first();
                    }
                    if($user == null){
                        $new_user = false;
                        if($request->email == null || $request->email == ""){
                            $request->email = null;
                        }
                        $new_user=User::insert([
                                'name' => $request->name,
                                'email' => $request->email,
                                'username' => $request->id,
                                // 'nidn' => $request->nidn,
                                'department' => $request->unit,
                                'study_program' => $prodi,
                                'phone' => preg_replace("/[^0-9]/", "", $request->mobile ),
                                'job' => $request->job,
                                'gender' => $request->gender,
                                'password'=> null,
                                'email_verified_at' => Carbon::now(),
                                'created_at' => Carbon::now()
                        ]);
                        
                        if($new_user){
                            $user = User::where('username', $request->id)->first();
                            if($request->dept_id == "ACAD"){
                                $user->roles()->attach(Role::where('id', 'LE')->first());
                            } else if($request->dept_id == "NACAD"){
                                $user->roles()->attach(Role::where('id', 'ST')->first());
                            }
                        }  
                    } else {
                        $old_user = $user->update([
                            'name' => $request->name,
                            'username' => $request->id,
                            // 'nidn' => $request->nidn,
                            'department' => $request->unit,
                            'study_program' => $prodi,
                            'phone' => preg_replace("/[^0-9]/", "", $request->mobile ),
                            'job' => $request->job,
                            'gender' => $request->gender,
                            'updated_at' => Carbon::now()
                        ]);
                        
                        if($old_user){
                            $user = User::where('username', $request->id)->first();
                            if($request->dept_id == "ACAD" && !$user->hasRole('LE')){
                                $user->roles()->attach(Role::where('id', 'LE')->first());
                            } else if($request->dept_id == "NACAD" && !$user->hasRole('ST')){
                                $user->roles()->attach(Role::where('id', 'ST')->first());
                            }
                        }  
                    }
                    Auth::loginUsingId($user->id);
                    if(Auth::user()->password == null || Auth::user()->email == null){
                        return redirect()->route('update_account');
                    } else {
                        return redirect()->route('my_profile');
                    }
                }
            } else {
                abort(403, "Cannot access to restricted page!");
            }
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            return redirect()->route('login')->withErrors(['msg' => $msg]);
        }
    }
}
