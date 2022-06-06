@extends('layouts.master')
@section('title', 'Edit Schedule')

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
<li class="breadcrumb-item">Edit</li>
<li class="breadcrumb-item active">#{{ $data->id }} </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Lecturer</label>
                                <input class="form-control" type="text" value="{{ $data->lecturer->name }}" disabled>

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Status</label>
                                <input class="form-control" type="text" value="{{ $data->status->title }}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Start</label>
                                <input class="form-control" type="text" value="{{ date('d M Y ( H:i )', strtotime($data->date_start)) }}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">End</label>
                                <input class="form-control" type="text" value="{{ date('d M Y ( H:i )', strtotime($data->date_end)) }}" disabled>
                            </div>
                        </div>

                        <!-- <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label class="col-form-label">Start<i class="text-danger">*</i></label>
                                <input class="form-control digits" autocomplete="off" type="datetime-local"
                                    id="date_start" name="date_start"
                                    value="{{ date('Y-m-d\TH:i', strtotime($data->date_start)) }}">
                                @error('date_start')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group">
                                <label class="col-form-label">End<i class="text-danger">*</i></label>
                                <input class="form-control digits" autocomplete="off" type="datetime-local"
                                    id="date_end" name="date_end"
                                    value="{{ date('Y-m-d\TH:i', strtotime($data->date_end)) }}">
                                @error('date_end')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-success">Add Auditor</button>
                    <button class="btn btn-success">Send to Follow-Up</button>
                    <button class="btn btn-warning">Reschedule</button>
                    <a href="{{ route('schedules') }}">
                        <span class="btn btn-secondary">Back</span>
                    </a>
                </div>
            </div>
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
