@extends('layouts.master')
@section('title', 'New Schedule')

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
<li class="breadcrumb-item">Schedules</li>
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
                            <div class="form-group mb-2">
                                <label class="col-form-label">Maximum Point (Star Score)<i class="text-danger">*</i></label>
                                <select
                                    class="form-select digits select2 @error('max_score') is-invalid @enderror"
                                    name="max_score" id="max_score" data-placeholder="Select">
                                    <option value="4" >4 Stars</option>
                                    <option value="5" >5 Stars</option>
                                </select>
                                @error('max_score')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Is this a practitioner class?</label>
                                <div class="form-check checkbox checkbox-default mb-0">
                                    <input class="form-check-input" id="is_practitioner_class" type="checkbox" value="0"
                                        name="is_practitioner_class">
                                    <label class="form-check-label" for="is_practitioner_class">Checklist if this is a practitioner class</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Select the lecturer to be observed<i class="text-danger">*</i></label>
                                <select
                                    class="form-select digits select2 @error('lecturer_id') is-invalid @enderror"
                                    name="lecturer_id" id="lecturer_id" data-placeholder="Select">
                                    <option value="" selected disabled>Select Lecturer</option>
                                    @foreach($lecturer as $p)
                                    <option value="{{ $p->id }}"
                                        {{ ($p->id==old('lecturer_id') ? "selected": "") }}>
                                        {{ $p->name }} {{ ($p->email==null ? '' : '- '.$p->email) }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('lecturer_id')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Select Study Program<i class="text-danger">*</i></label>
                                <select
                                    class="form-select digits select2 @error('study_program') is-invalid @enderror"
                                    name="study_program" id="study_program" data-placeholder="Select">
                                    <option value="" selected disabled>Select</option>
                                    @foreach($study_program as $p)
                                    <option value="{{ $p->study_program }}">
                                        {{ $p->study_program }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('study_program')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label class="col-form-label">Schedule start<i class="text-danger">*</i></label>
                                <input class="form-control digits" autocomplete="off" type="datetime-local"
                                    id="date_start" name="date_start" >
                                @error('date_start')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label class="col-form-label">Schedule end<i class="text-danger">*</i></label>
                                <input class="form-control digits" autocomplete="off" type="datetime-local"
                                    id="date_end" name="date_end" >
                                @error('date_end')
                                <span class="invalid-feedback d-block" role="alert">
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
<script>
    $(document).ready(function () {
        const selectElement = document.querySelector('#is_practitioner_class');
        selectElement.addEventListener('change', (event) => {
            selectElement.value = selectElement.checked ? 1 : 0;
            // alert(selectElement.value);
        });
    });
</script>
@endsection
