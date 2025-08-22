@extends('layouts.master')
@section('title', 'New Study Program')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2-bootstrap.css')}}">
@endsection

@section('style')
<style>
    .input-validation-error~.select2 .select2-selection {
        border: 1px solid red;
    }

</style>
@endsection

@section('breadcrumb-title')
<!-- <h3>User Profile</h3> -->
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Settings</li>
<li class="breadcrumb-item">Criteria</li>
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
                                <label class="col-form-label">Acreditation<i class="text-danger">*</i></label>
                                <select
                                    class="form-select digits select2 @error('acreditation_id') is-invalid @enderror"
                                    name="acreditation_id" id="acreditation_id" data-placeholder="Select">
                                    <option value="" selected disabled>Select</option>
                                    @foreach($data as $p)
                                    <option value="{{ $p->id }}"
                                        {{ ($p->id==old('acreditation_id') ? "selected": "") }}>
                                        {{ $p->id }} - {{ $p->name }}</option>
                                    @endforeach
                                </select>
                                @error('criteria_category_id')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label class="col-form-label">Certificate Link</label>
                                <input class="form-control @error('certificate') is-invalid @enderror" id="certificate"
                                    name="certificate" value="{{ old('certificate') }}" type=text >
                                @error('certificate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label class="col-form-label">Study Program Name<i class="text-danger">*</i></label>
                                <input class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ old('name') }}" type=text >
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label class="col-form-label">Degree Level<i class="text-danger">*</i></label>
                                <input class="form-control @error('degree_level') is-invalid @enderror" id="degree_level"
                                    name="degree_level" value="{{ old('degree_level') }}" type=text>
                                @error('degree_level')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-primary" type="submit">Create</button>
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
<script>
    "use strict";
    setTimeout(function () {
        (function ($) {
            "use strict";
            $(".select2").select2({
                allowClear: true,
                minimumResultsForSearch: 7,
            });
        })(jQuery);
    }, 350);

</script>
@endsection
