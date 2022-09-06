@extends('layouts.authentication.master')
@section('title', 'Register')

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
                    <div><a class="logo" href="{{ route('home') }}">
                            <img class="img-fluid" style="max-width: 200px;" src="{{asset('assets/images/logo.png')}}"
                                alt="signuppage"></a>
                    </div>
                    <div class="login-main">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <h4>Create your account</h4>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label class="col-form-label">Name</label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text"
                                            id="name" name="name" value="{{ old('name') }}" required=""
                                            autocomplete="off">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Username</label>
                                        <input class="form-control @error('username') is-invalid @enderror" type="text"
                                            id="username" name="username" value="{{ old('username') }}" required=""
                                            autocomplete="off">
                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Email Address</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Password</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Repeat Password</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                    <div class="form-group text-center">
                                        <label class="col-form-label"></label>
                                        {!! htmlFormSnippet() !!}
                                    </div>
                                    <div class="form-group mb-0 mt-4">
                                        <button class="btn btn-primary btn-block w-100" type="submit">Create
                                            Account</button>
                                    </div>
                                    <p class="mt-4 mb-0">Already have an account?<a class="ms-2"
                                            href="{{ route('login') }}">Login here</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection
