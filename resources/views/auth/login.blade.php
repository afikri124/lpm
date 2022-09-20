@extends('layouts.authentication.master')
@section('title', 'Login Peer Observation')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-xl-7">
            <img class="bg-img-cover bg-center" src="{{asset('assets/images/landing/screen2.jpg')}}" alt="looginpage">
        </div>
        <div class="col-xl-5 p-0">
            <div class="login-card">
                <div>
                    <div class="">
                        <a class="logo" href="{{ route('home') }}">
                            <img class="img-fluid" style="max-height: 50px;" src="{{asset('assets/images/logo.png')}}"
                                alt="looginpage">
                        </a>
                    </div>
                    <div class="login-main">
                        <form class="theme-form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <h4>Login to Peer Observation</h4>
                            @error('msg')
                            <b class="text-danger m-0">{{ $message }}</b>
                            @enderror
                            <div class="form-group">
                                <label class="col-form-label">{{ __('Username or email') }}</label>
                                <input id="username" type="text"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username') }}" required autofocus autocomplete="off">

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Password</label>
                                <div class="form-input position-relative">
                                    <input class="form-control" type="password" name="password" required="">
                                    <div class="show-hide"><span class="show"> </span></div>
                                </div>
                            </div>

                            <div class="form-group mb-3 mt-4">
                                <div class="checkbox p-0">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="text-muted" for="remember">{{ __('Remember Me') }}</label>
                                </div>
                                @if (Route::has('password.request'))
                                <a class="link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Password?') }}
                                </a>
                                @endif
                            </div>
                            <div class="text-end mt-3">
                                <button class="btn btn-primary btn-block w-100" type="submit">Login</button>
                            </div>
                        </form>
                        <h6 class="text-muted my-4 or">Or sign in with</h6>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 mb-4">
                                <div class="btn-showcase">
                                    <button class="btn btn-light btn-block w-100" onclick="Klas2Login()">
                                        <img style="max-height: 20px;"
                                            src="{{asset('assets/images/logo/logo-icon.png')}}">
                                        <span>SSO Klas2</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mb-4">
                                <div class="btn-showcase">
                                    <a class="btn btn-light btn-block w-100" href="{{ url('login/google') }}">
                                        <img style="max-height: 20px;"
                                            src="https://avatars.githubusercontent.com/u/19180220?s=200&v=4">
                                        <span>Google</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- <p class="mt-4 mb-0 text-center">Don't have account?<a class="ms-2"
                                    href="{{ route('register') }}">Create Account</a></p> -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@php
$login_name = "Peer%20Observation";
$api_key = Crypt::encrypt("PO".gmdate('Y/m/d'));
Session::put('klas2_api_key', $api_key);
$callback_url = route('sso_klas2');
$token = md5($api_key.$callback_url);
$url = "http://klas2.jgu.ac.id/sso/";
//$url = "http://localhost/JGU/sso/test.php"; //for test only
$link =
$url."?login_to=".route('login')."&login_name=$login_name&api_key=$api_key&callback_url=$callback_url&token=$token&ip=".$_SERVER['REMOTE_ADDR'];
@endphp
@section('script')
<script>
    function Klas2Login() {
        // alert("SSO");
        window.open("{!!$link!!}", "LOGIN SSO JGU",
            "location=no, titlebar=no, toolbar=no, fullscreen='yes', resizable=no, scrollbars=yes");
    }

</script>
@endsection
