@extends('layouts.master')
@section('title', 'New User')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<!-- <h3>User Profile</h3> -->
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Settings</li>
<li class="breadcrumb-item">Users</li>
<li class="breadcrumb-item active">New</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <form class="card" method="POST" action="">
                @csrf
                <div class="card-header">
                    <h4 class="card-title mb-0">Add @yield('title')</h4>
                    <div class="card-options"><a class="card-options-collapse" href="#"
                            data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                            class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                class="fe fe-x"></i></a></div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label class="col-form-label">Full Name<i class="text-danger">*</i></label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Front title</label>
                                <input class="form-control @error('front_title') is-invalid @enderror" type="text" id="front_title"
                                    name="front_title" value="{{ old('front_title') }}">
                                @error('front_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Back title</label>
                                <input class="form-control @error('back_title') is-invalid @enderror" type="text" id="back_title"
                                    name="back_title" value="{{ old('back_title') }}">
                                @error('back_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Department</label>
                                <input class="form-control" type="text" name="department"
                                    value="{{ old('department') }}">
                            </div>

                            <div class="form-group">
                                <label class="col-form-label">Program Study</label>
                                <input class="form-control" type="text" name="study_program"
                                    value="{{ old('study_program') }}">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Job Title</label>
                                <input class="form-control" type="text" name="job" value="{{ old('job') }}">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Phone</label>
                                <input class="form-control" type="number" name="phone" value="{{ old('phone') }}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">

                            <div class="form-group">
                                <label class="col-form-label">Username<i class="text-danger">*</i></label>
                                <input class="form-control @error('username') is-invalid @enderror" type="text"
                                    id="username" name="username" value="{{ old('username') }}">
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">NIDN</label>
                                <input class="form-control @error('nidn') is-invalid @enderror" type="number" id="nidn"
                                    name="nidn" value="{{ old('nidn') }}">
                                @error('nidn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Email<i class="text-danger">*</i></label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Password<i class="text-danger">*</i></label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Confirm Password<i class="text-danger">*</i></label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" autocomplete="new-password">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Gender<i class="text-danger">*</i></label>
                                <select class="select2 col-sm-12" name="gender" id="gender" placeholder="Select Gender">
                                    <option value="" selected disabled>Select Gender</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                                @error('gender')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Roles<i class="text-danger">*</i></label>
                                <select class="js-example-placeholder-multiple col-sm-12" multiple="multiple"
                                    name="roles[]" id="roles">
                                    @foreach($roles as $role)
                                    <option value="{{$role['id']}}">{{$role['title']}}</option>
                                    @endforeach
                                </select>
                                @error('roles')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-primary" type="submit">Create User</button>
                    <a href="{{ url()->previous() }}">
                        <span class="btn btn-secondary">Back</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script type="text/javascript">
    $('.select2').select2({});
    "use strict";
    setTimeout(function () {
        (function ($) {
            "use strict";
            // With Placeholder
            $(".js-example-placeholder-multiple").select2({
                placeholder: " Select Roles"
            });
        })(jQuery);
    }, 350);

</script>
@endsection
