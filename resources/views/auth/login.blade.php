@extends('layouts.authentication.master')
@section('title', 'Login Peer Observation')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-card">
                <div>
                    <div><a class="logo" href="{{ route('home') }}">
                            <img class="img-fluid" style="max-width: 50%;" src="{{asset('assets/images/logo.png')}}"
                                alt="looginpage"></a>
                    </div>
                    <div class="login-main">
                        <form class="theme-form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <h4>Login to your account</h4>
                            <div class="form-group">
                                <label class="col-form-label">{{ __('Email or username') }}</label>
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
                        <h6 class="text-muted mt-4 or">Or login with</h6>
                        <div class="social mt-4">
                            <div class="btn-showcase">
                                <button class="btn btn-light btn-block w-100" onclick="Klas2Login()">
                                    <img style="max-width: 20px;" src="{{asset('assets/images/logo/logo-icon.png')}}">
                                    Klas2 Account </button></div>
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
    $callback_url = route('sso_klas2');
    $token = md5($callback_url.date('Y/m/d'));
    $url = "http://klas2.jgu.ac.id/sso/";
    $link = $url."?login_to=".route('login')."&login_name=Peer Observation";
@endphp
@section('script')
<script>
    function Klas2Login() {
        let windowName = 'w_' + Date.now() + Math.floor(Math.random() * 100000).toString();
        var form = document.createElement("form");
        form.setAttribute("method", "post");
        form.setAttribute("action", "{!!$link!!}");
        form.setAttribute("target", windowName);

        var token = document.createElement("input"); 
        token.setAttribute("type", "hidden");
        token.setAttribute("name", "token");
        token.setAttribute("value", "{{$token}}");
        form.appendChild(token);

        var callback_url = document.createElement("input"); 
        callback_url.setAttribute("type", "hidden");
        callback_url.setAttribute("name", "callback_url");
        callback_url.setAttribute("value", "{{$callback_url}}");
        form.appendChild(callback_url);

        document.body.appendChild(form);

        window.open('', windowName,"location=no, titlebar=no, toolbar=no, fullscreen=yes, resizable=no, scrollbars=yes");

        form.submit();
    }
</script>
@endsection
