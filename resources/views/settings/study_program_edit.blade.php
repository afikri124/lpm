@extends('layouts.master')
@section('title', "Edit Study Program")

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Settings</li>
<li class="breadcrumb-item">Study Program</li>
<li class="breadcrumb-item active">#{{ $data->name }} </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <form class="card" method="POST" action="">
                @csrf
                <div class="card-header">
                    <h4 class="card-title mb-0">@yield('title')</h4>
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
                        <div class="col-sm-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Acreditation<i class="text-danger">*</i></label>
                                <select
                                    class="form-select digits select2 @error('acreditation_id') is-invalid @enderror"
                                    name="acreditation_id" id="acreditation_id" data-placeholder="Select">
                                    <option value="" selected disabled>Select</option>
                                    @foreach($acreditation as $p)
                                    <option value="{{ $p->id }}"
                                        {{ ($p->id==$data->acreditation_id ? "selected": "") }}>
                                        {{ $p->id }} - {{ $p->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Certificate Link<i class="text-danger">*</i></label>
                                <input class="form-control" type=text name="certificate" value="{{ $data->certificate }}">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Name<i class="text-danger">*</i></label>
                                <input class="form-control" type=text name="name" value="{{ $data->name }}">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Degree level<i class="text-danger">*</i></label>
                                <input class="form-control" type=text name="degree_level" value="{{ $data->degree_level }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-success" type="submit">Update</button>
                    <a href="{{ route('settings.study_program') }}">
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
</script>
@endsection
