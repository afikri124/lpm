<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;
use App\Models\User_role;
use App\Models\Criteria_category;
use App\Models\Criteria;
use App\Models\Setting;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\DataTables;
use DB;
use Illuminate\Database\QueryException;

class SettingController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function users(Request $request) {
        $roles = Role::get();
        $study_program = User::select('study_program')->groupBy('study_program')->get();
        return view('settings.users', ['roles'=> $roles, 'study_program' => $study_program]);
    }

    public function general(Request $request) {
        if ($request->isMethod('post')) {
            $this->validate($request, [ 
                'id'=> ['required'],
                'title'=> ['required'],
                'content'=> ['required'],
            ]);
            $up = Setting::find($request->id)->update(request()->all());
        }
        $data = Setting::get();
        return view('settings.general', ['data'=> $data]);
    }

    public function syncKlas2(Request $request)
    {
        $data =  DB::connection('mysql2')
        ->table('new_employee as e')
        ->leftJoin('dept_unit as du', 'e.unit_id', '=', 'du.id')
        ->leftJoin('dept_sub_unit as dsu', 'e.sub_unit_id', '=', 'dsu.id')
        ->leftJoin('employee_type as t', 'e.emp_type', '=', 't.id')
        ->leftJoin('lookup_gender as g', 'e.gender', '=', 'g.id')
        ->select('e.empid as id', 'e.name', 'du.description as unit_id', 'dsu.desc_malay as sub_unit_id', 
        'e.email','e.mobile', "t.title AS job", 'e.emp_type',
        'g.short_code AS gender', "e.dept_id")
        ->orderBy('name')->orderBy('last_modified_date', 'DESC')->get();
        $i = 0;
        $NewUser = array();
        $UpdatedUser = array();
        $FailedUser = array();
        foreach ($data as $u) {
            $prodi = null;
            if($u->dept_id == "ACAD"){
                $prodi = $u->sub_unit_id;
            }
            $email = $u->email;
            if($u->email == null || $u->email == ""){
                $email = null;
            }
            $user = User::where('username', $u->id)->first();
            // if($u->email == null){
            //     $user = User::where('username',$u->id)->first();
            // }
            $cek = User::where('email', $email)->first();
            if($cek != null && $email != null){
                $email = "DUPLICATE_".$email;
            }
            if($user == null){
                $new_user = false;
               
                $new_user=User::insert([
                        'name' => $u->name,
                        'email' => $email,
                        'username' => $u->id,
                        // 'nidn' => $u->nidn,
                        'department' => $u->unit_id,
                        'study_program' => $prodi,
                        'phone' => preg_replace("/[^0-9]/", "", $u->mobile ),
                        'job' => $u->job,
                        'gender' => $u->gender,
                        'password'=> null, //Hash::make("itkj2022") before
                        'email_verified_at' => Carbon::now(),
                        'created_at' => Carbon::now()
                ]);
                if($new_user){
                    $user = User::where('username', $u->id)->first();
                    if($u->dept_id == "ACAD"){
                        $user->roles()->attach(Role::where('id', 'LE')->first());
                    } else if($u->dept_id == "NACAD"){
                        $user->roles()->attach(Role::where('id', 'ST')->first());
                    }
                    array_push($NewUser,$user->name);
                    $i++;
                } else {
                    array_push($FailedUser,$u->name);
                }  
            } else {
                $old_user = $user->update([
                    'name' => $u->name,
                    'email' => (($user->email == null) || str_contains($user->email, 'NO_EMAIL_') || str_contains($user->email, 'DUPLICATE_') ? $email : $user->email),
                    // 'nidn' => $u->nidn,
                    'department' => $u->unit_id,
                    'study_program' => $prodi,
                    'phone' => (($user->phone == null) ? preg_replace("/[^0-9]/", "", $u->mobile ) : $user->phone),
                    'job' => $u->job,
                    'gender' => $u->gender,
                    'updated_at' => Carbon::now()
                ]);
                
                if($old_user){
                    $user = User::where('username', $u->id)->first();
                    if($u->dept_id == "ACAD" && !$user->hasRole('LE')){
                        $user->roles()->attach(Role::where('id', 'LE')->first());
                    } else if($u->dept_id == "NACAD" && !$user->hasRole('ST')){
                        $user->roles()->attach(Role::where('id', 'ST')->first());
                    }
                    array_push($UpdatedUser,$user->name);
                    $i++;
                } else {
                    array_push($FailedUser,$u->name);
                }  
            }
        }
        return response()->json([
            'total' => $i,
            'new' => $NewUser,
            'updated' => $UpdatedUser,
            'failed' => $FailedUser
        ]);
    }

    public function user_add(Request $request) {
        if ($request->isMethod('post')) {
            $this->validate($request, [ 'name'=> ['required', 'string', 'max:255'],
            'email'=> ['required', 'string', 'email', 'max:255', Rule::unique('users')],
            'username'=> ['required', 'string', 'max:255', Rule::unique('users')],
            'nidn'=> ['nullable', 'max:255', Rule::unique('users')],
            'password' => ['required', 'string', 'min:8','same:password_confirmation'],
            'gender'=> ['required'],
            'roles'=> ['required'],
            ]);
            if(isset($request->nidn))
            {
                $this->validate($request,
                    [
                        'nidn' => [ 'max:100', Rule::unique('users')],
                    ]);
            }
            $data=User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'nidn' => $request->nidn,
                'front_title' => $request->front_title,
                'back_title' => $request->back_title,
                'department' => $request->department,
                'study_program' => $request->study_program,
                'phone' => $request->phone,
                'job' => $request->job,
                'gender' => $request->gender,
                'password'=> Hash::make($request->password),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now()
            ]);

            $attachvalidator = Validator::make($request->all(),User_role::$role_attach_roles);
            if ($attachvalidator->fails()){
                return redirect()->back()->withErrors($attachvalidator)->withInput();
            }
            $attach = User::where('email',$request->email)->first()->roles()->attach($request->roles);
            return redirect()->route('settings.users');
        }
        $roles=Role::all();
        return view('settings.users_add', compact('roles'));
    }

    public function user_edit($id, Request $request) {
        $id = Crypt::decrypt($id);
        if ($request->isMethod('post')) {
            $this->validate($request, [ 'name'=> ['required', 'string', 'max:255'],
            'email'=> ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id, 'id')],
            'username'=> ['required', 'string', 'max:255', Rule::unique('users')->ignore($id, 'id')],
            'nidn'=> ['nullable', 'max:255', Rule::unique('users')->ignore($id, 'id')],
            'roles'=> ['required'],
            'gender'=> ['required'],
            ]);
            if(isset($request->nidn))
            {
                $this->validate($request,
                    [
                        'nidn' => [ 'max:100', Rule::unique('users')->ignore($id, 'id')],
                    ]);
            }
            $user = User::find($id)->update(request()->all());
            if(isset($request->email_verified_at))
            {
                $user2 = User::where('id', $id)->update([ 'email_verified_at' => Carbon::now(),
                'updated_at'=> Carbon::now() ]);
            } 
            $detach = User::find($id)->roles()->detach();
            $attach = User::find($id)->roles()->attach($request->roles);
            return redirect()->route('settings.users');
        }
        
        $data = User::find($id);
        if($id == 1 || $data == null){
            abort(403, "Cannot access to restricted page");
        }
        $roles = Role::all();
        return view('settings.users_edit', compact('data','roles'));
    }

    public function user_delete(Request $request) {
        $user = User::find($request->id);
        if($user){
            $user->delete();
            return response()->json([
                'success' => true,
                'message' => 'Record deleted successfully!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User failed to delete!'
            ]);
        }
    }

    public function categories(Request $request) {
        return view('settings.categories');
    }

    public function category_add(Request $request) {
        if ($request->isMethod('post')) {
            $this->validate($request, [ 
                'id'=> ['required', 'string', 'max:255', Rule::unique('criteria_categories')],
                'title'=> ['required', 'string', 'max:255'],
            ]);
            Criteria_category::insert(request()->except(['_token']));
            return redirect()->route('settings.categories');
        }
        return view('settings.categories_add');
    }

    public function category_edit($id, Request $request) {
        if ($request->isMethod('post')) {
            $this->validate($request, [ 
                'id'=> ['required', 'string', 'max:255', Rule::unique('criteria_categories')->ignore($id, 'id')],
                'title'=> ['required', 'string', 'max:255'],
            ]);
            $data = Criteria_category::find($id)->update([
                'id' => $request->id,
                'title' => $request->title,
                'description' => $request->description,
                'is_required' => ($request->is_required == null ? 0:$request->is_required ),
            ]);
            return redirect()->route('settings.categories');

        }
        $data = Criteria_category::find($id);
        if($data == null){
            abort(403, "Cannot access to restricted page");
        }
        return view('settings.categories_edit', compact('data'));
    }

    public function category_delete(Request $request) {
        $data = Criteria_category::find($request->id);
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

    public function criterias(Request $request) {
        $categories = Criteria_category::get();
        return view('settings.criterias', compact('categories'));
    }

    public function criteria_add(Request $request) {
        if ($request->isMethod('post')) {
            $this->validate($request, [ 
                'criteria_category_id'=> ['required'],
                'title'=> ['required', 'string', 'max:255'],
                'weight'=> ['required', 'numeric'],
            ]);
            Criteria::insert(request()->except(['_token']));
            return redirect()->route('settings.criterias');
        } 
        $categories = Criteria_category::get();
        return view('settings.criterias_add', compact('categories'));
    }

    public function criteria_edit($id, Request $request) {
        $id = Crypt::decrypt($id);
        if ($request->isMethod('post')) {
            $this->validate($request, [ 
                'criteria_category_id'=> ['required'],
                'title'=> ['required', 'string', 'max:255'],
                'weight'=> ['required', 'numeric'],
            ]);
            $data = Criteria::find($id)->update(request()->all());
            return redirect()->route('settings.criterias');
        }
        $data = Criteria::find($id);
        if($data == null){
            abort(403, "Cannot access to restricted page");
        }
        $categories = Criteria_category::get();
        return view('settings.criterias_edit', compact('data','categories'));
    }


    public function criteria_delete(Request $request) {
        $data = Criteria::find($request->id);
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
}
