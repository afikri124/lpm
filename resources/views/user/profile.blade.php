@extends('layouts.master')
@section('title', 'Profile')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<!-- <h3>User Profile</h3> -->
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
                    <h4 class="card-title mb-0"><img class="img-70 rounded-circle" alt=""
                                    src="{{Auth::user()->user_avatar}}"> My Profile</h4>
                    <div class="card-options"><a class="card-options-collapse" href="#"
                            data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                            class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                class="fe fe-x"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-1 row">
                        <label class="col-sm-6">
                            <h6 class="form-label">Name</h6>
                        </label>
                        <div class="col-sm-6">
                            <span>{{ $data->name }}</span>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label class="col-sm-6">
                            <h6 class="form-label">Username</h6>
                        </label>
                        <div class="col-sm-6">
                            <span>{{ $data->username }}</span>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label class="col-sm-6">
                            <h6 class="form-label">Email</h6>
                        </label>
                        <div class="col-sm-6">
                            <span>{{ $data->email }}</span>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label class="col-sm-6">
                            <h6 class="form-label">NIDN</h6>
                        </label>
                        <div class="col-sm-6">
                            <span>{{ $data->nidn }}</span>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label class="col-sm-6">
                            <h6 class="form-label">Phone</h6>
                        </label>
                        <div class="col-sm-6">
                            <span>{{ $data->phone }}</span>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label class="col-sm-6">
                            <h6 class="form-label">Department</h6>
                        </label>
                        <div class="col-sm-6">
                            <span>{{ $data->department }}</span>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label class="col-sm-6">
                            <h6 class="form-label">Study Program</h6>
                        </label>
                        <div class="col-sm-6">
                            <span>{{ $data->study_program }}</span>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label class="col-sm-6">
                            <h6 class="form-label">Job</h6>
                        </label>
                        <div class="col-sm-6">
                            <span>{{ $data->job }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <form class="card" method="POST" action="{{ route('update_profile') }}">
                @csrf
                <div class="card-header">
                    <h4 class="card-title mb-0">Update Profile</h4>
                    <div class="card-options"><a class="card-options-collapse" href="#"
                            data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                            class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                                class="fe fe-x"></i></a></div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input class="form-control" type="text" name="name" value="{{ $data->name }}" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input class="form-control" type="text" name="username" value="{{ $data->username }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="form-label">Email address</label>
                                <input class="form-control" type="email" name="email" value="{{ $data->email }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="form-label">NIDN</label>
                                <input class="form-control" type="text" name="nidn" value="{{ $data->nidn }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input class="form-control" type="number" name="phone" value="{{ $data->phone }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="form-label">Job</label>
                                <input class="form-control" type="text" name="job" value="{{ $data->job }}"
                                    required>
                            </div>
                        </div>
                        @foreach ($errors->all() as $error)
                        <p class="text-danger m-0">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
