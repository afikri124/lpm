@extends('layouts.master')
@section('title', 'Change Password')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<!-- <h3>@yield('title')</h3> -->
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row edit-profile">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0"><a target="_blank" href="https://id.gravatar.com/"><img class="img-70 rounded-circle" alt="" title="Click to change gravatar"
                            src="{{Auth::user()->image()}}"></a> My Profile</h4>
                    <div class="card-options"><a class="card-options-collapse" href="#"
                            data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                            class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                class="fe fe-x"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="profile-title">
                            <div class="media">
                                <div class="media-body">
                                    <h3 class="mb-1">{{ ucfirst(Auth::user()->name) }}
                                        {{ ucfirst(Auth::user()->last_name) }}</h3>
                                    <p>{{ ucfirst(Auth::user()->level) }}</p>
                                    <p class="text-danger"><i>Disclaimer!</i><br>
                                        Password changes on this form only apply to this system, will not affect users
                                        who log in using the Single Sign-On (SSO) or Google.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <form class="card" method="POST" action="{{ route('update_password') }}">
                @csrf
                <div class="card-header">
                    <h4 class="card-title mb-0">Change Password</h4>
                    <div class="card-options"><a class="card-options-collapse" href="#"
                            data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                            class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                class="fe fe-x"></i></a></div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Current Password <i class="fa fa-info-circle" title="If you forget, please contact the administrator or press forgot password on the login page"></i></label>
                                <input id="password" type="password" class="form-control" name="current_password"
                                    autocomplete="current-password" required>
                                    
                                @if (Route::has('password.request'))
                                <a class="link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Password?') }}
                                </a>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input id="new_password" type="password" class="form-control" name="new_password"
                                    autocomplete="current-password" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Confirm New Password</label>
                                <input id="new_confirm_password" type="password" class="form-control"
                                    name="new_confirm_password" autocomplete="current-password" required>
                            </div>
                        </div>

                        @foreach ($errors->all() as $error)
                        <p class="text-danger m-0">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
