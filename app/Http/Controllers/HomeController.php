<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Role;
use App\Models\User;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

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
            return view('welcome', compact('CONTACT','LINKINSTRUMENT','LINKINSTRUMENT2','LINKINSTRUMENT3','LINKINSTRUMENT4'));
        } else {
            $img = "<img style='max-width: 100px;border-radius: 50%;' src='https://img.freepik.com/premium-vector/alert-error-massage-notification-concept-error-digital-report-system-hacking-by-hacker_257312-129.jpg?w=2000'>";
            $msg = "$img<br><br>Sorry, You can't access to restricted page!<br>Please contact <b>afikri124@gmail.com</b>";
            return view('user.error', compact('msg'));
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
