<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }

    public function sso_klas2(Request $request)
    {
        if($request->token == md5(route('sso_klas2').gmdate('Y/m/d/H')) && md5(route('sso_klas2').gmdate('Y/m/d/H').$request->id) == $request->token_pass){
            $user = User::where('username', $request->id)->first();
            if ($user != null) { //login
                Auth::loginUsingId($user->id);
                return redirect()->route('dashboard');
            } else { //register
                $prodi = null;
                if($request->dept_id == "ACAD"){
                    $prodi = $request->sub_unit_id;
                }
                $user = User::where('email',$request->email)->first();
                if($user == null){
                    $new_user=User::insert([
                        'name' => $request->name,
                        'email' => $request->email,
                        'username' => $request->id,
                        // 'nidn' => $request->nidn,
                        'department' => $request->unit_id,
                        'study_program' => $prodi,
                        'phone' => $request->mobile,
                        'job' => $request->job,
                        'gender' => $request->gender,
                        'password'=> Hash::make("itkj2022"),
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
                    $old_user = User::where('email',$request->email)->update([
                        'name' => $request->name,
                        'username' => $request->id,
                        // 'nidn' => $request->nidn,
                        'department' => $request->unit_id,
                        'study_program' => $prodi,
                        'phone' => $request->mobile,
                        'job' => $request->job,
                        'gender' => $request->gender,
                        'updated_at' => Carbon::now()
                    ]);
                    
                    if($old_user){
                        $user = User::where('username', $request->id)->first();
                        if($request->dept_id == "ACAD"){
                            $user->roles()->attach(Role::where('id', 'LE')->first());
                        } else if($request->dept_id == "NACAD"){
                            $user->roles()->attach(Role::where('id', 'ST')->first());
                        }
                    }  
                }
                Auth::loginUsingId($user->id);
                return redirect()->route('my_profile');
            }
        } else {
            abort(403, "Cannot access to restricted page!");
        }
    }
}
