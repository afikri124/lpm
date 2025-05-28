@extends('layouts.authentication.master')
@section('title', 'SSO SIAP')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-card row">
                <div class="col-lg-6 col-md-12">
                    <div class="login-main">
                        <a class="logo" href="{{ route('home') }}">
                            <img class="img-fluid" style="max-width: 175px;"
                                src="{{asset('assets/images/logo/siakadcloud2018.png')}}"></a>
                        <h4 class="mb-2 text-center text-bold">Masuk ke SSO</h4>
                        <div class="text-center my-2">
                            <small class="divider-text mb-2">Single Sign On</small>
                        </div>
                        @error('msg')
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            {!! $message !!}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @enderror
                        <form id="formAuthentication" class="mb-3 theme-form" action="" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="col-form-label">{{ __('Email') }}</label>
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" autofocus
                                    placeholder="Masukkan email yang terdaftar di SIAP">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Password</label>
                                <div class="form-input position-relative">
                                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                                        name="password" placeholder="Masukkan password SIAP"
                                        value="{{ old('password') }}">

                                    <div class="show-hide"><span class="show"> </span></div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <input type="hidden" name="urlintended"
                                    value="{{ (isset($_GET['redirect_to']) ? $_GET['redirect_to'] : null) }}">
                            </div>
                            <div class="mb-3">
                                <div class=" d-flex justify-content-between">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember me') }} </label>
                                    </div>
                                    <a href="https://sso.sevima.com/users/password-reset">
                                        <small>Forgot Password?</small>
                                    </a>
                                </div>
                            </div>
                            <div class="mb-3 text-center">
                                <button class="btn btn-primary  w-100" type="submit" name="login"><i
                                        class="bx bx-log-in-circle me-2"></i>Sign in</button>
                            </div>

                        </form>
                        <small>
                            <center><i>Jika terdapat kendala masuk atau belum memiliki akun silakan menghubungi tim <a
                                        target="_blank" href="https://s.jgu.ac.id/m/itic">ITIC</a></i></center>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection
