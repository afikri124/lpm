@extends('layouts.master')
@section('title', ucfirst($data->name))

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
<li class="breadcrumb-item active">{{ $data->username }} </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row edit-profile">
        <div class="col-xl-12">
            <form class="card" method="POST" action="">
                @csrf
                <div class="card-header">
                    <h4 class="card-title mb-0"><img class="img-70 rounded-circle" src="{{$data->user_avatar}}"> Edit Profile</h4>
                    <div class="card-options"><a class="card-options-collapse" href="#"
                            data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                            class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                class="fe fe-x"></i></a></div>
                </div>
                <div class="card-body">
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-light alert-dismissible fade show text-danger" role="alert">
                        <p><i class="fa fa-exclamation-triangle"></i> {{ $error }}</p>
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endforeach
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Name<i class="text-danger">*</i></label>
                                <input class="form-control" type="text" name="name" value="{{ $data->name }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Username<i class="text-danger">*</i></label>
                                <input class="form-control" type="text" name="username" value="{{ $data->username }}">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Front title</label>
                                <input class="form-control" type="text" name="front_title" value="{{ $data->front_title }}">
                            </div>
                        </div>
                        
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Back title</label>
                                <input class="form-control" type="text" name="back_title" value="{{ $data->back_title }}">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">NIDN</label>
                                <input class="form-control" type="number" name="nidn" value="{{ $data->nidn }}">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email<i class="text-danger">*</i></label>
                                <input class="form-control" type="email" name="email" value="{{ $data->email }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Department</label>
                                <input class="form-control" type="text" name="department"
                                    value="{{ $data->department }}">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Program Study</label>
                                <input class="form-control" type="text" name="study_program"
                                    value="{{ $data->study_program }}">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Job Title</label>
                                <input class="form-control" type="text" name="job" value="{{ $data->job }}">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input class="form-control" type="number" name="phone" value="{{ $data->phone }}">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Gender<i class="text-danger">*</i></label>
                                <select class="select2 col-sm-12" name="gender" id="gender" >
                                    <option value="" {{ $data->gender == null ? 'selected' : '' }} disabled>Select Gender</option>
                                    <option value="M" {{ $data->gender == "M" ? 'selected' : '' }} >Male</option>
                                    <option value="F" {{ $data->gender == "F" ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Roles<i class="text-danger">*</i></label>
                                <select class="js-example-placeholder-multiple col-sm-12" multiple="multiple"
                                    name="roles[]" id="roles" >
                                    @foreach($roles as $role)
                                    <option value="{{$role->id}}" {{ $data->hasRole($role->id) ? 'selected' : '' }}>
                                        {{$role->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if($data->email_verified_at == null)
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status email verification</label>
                                <select class="form-control btn-square select2" name="email_verified_at">
                                    <option value="">Not verified</option>
                                    <option value="yes">Verified now by admin</option>
                                </select>
                                <br><small class="text-danger">* make sure the email is correct and active before
                                    verifying!</small>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-success" type="submit">Update User</button>
                    <a href="{{ route('settings.users') }}">
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