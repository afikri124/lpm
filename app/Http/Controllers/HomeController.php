<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        // echo $request->token;
        if($request->token == md5(route('sso_klas2').date('Y/m/d')) && md5($request->id.date('Y/m/d')) == $request->token_pass){
            echo $request->token;
            echo "<br>".$request->token_pass;
            echo "<br>".$request->id;
        } else {
            echo "ERROR!";
        }
    }
}
