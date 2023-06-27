@extends('layouts.authentication.master')
@section('title', 'Update Account')

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
                        <form method="POST" action="" autocomplete="off">
                            @csrf
                            <h4 class="text-center">Update Account</h4>
                            <p class="text-center">Please complete the following data before using this system</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-form-label">Name</label>
                                        <input class="form-control" type="text" value="{{ Auth::user()->name }}"
                                            disabled>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Username</label>
                                        <input class="form-control" type="text" value="{{ Auth::user()->username }}"
                                            disabled>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Email</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ Auth::user()->email }}" required autocomplete="off"
                                            placeholder="xxxxx@jgu.ac.id">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Phone</label>
                                        <input id="phone" type="number"
                                            class="form-control @error('phone') is-invalid @enderror" name="phone"
                                            value="{{ (old('phone') == null ? Auth::user()->phone : old('phone')) }}"
                                            placeholder="62xxxxxxxxxxx" id="phone" autocomplete="off" onkeyup="remove_zero()">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">New Password
                                            <i class="fa fa-info-circle"
                                                title="Create new password for this system"></i>
                                        </label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="off" placeholder="at least 8 characters">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Confirm Password</label>
                                        <input id="password-confirm" type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation" required autocomplete="off">
                                        @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-0 mt-4">
                                        <button class="btn btn-primary btn-block w-100" type="submit">Submit</button>
                                    </div>
                    </form>
                                    <div class="form-group mb-0 mt-2">
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                        <a class="btn btn-light btn-block w-100" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cancel</a>
                                    </div>
                                </div>
                            </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('script')
<script>
    function remove_zero(){
        var x = document.getElementById("phone").value;
        let number = Number(x);
        if(number == 0){
            document.getElementById("phone").value = null;
        } else {
            document.getElementById("phone").value = number;
        }
    }
    </script>
@endsection
