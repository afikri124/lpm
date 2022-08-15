@extends('layouts.master')
@section('title', 'Observation Results')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<!-- <h3></h3> -->
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Schedules</li>
<li class="breadcrumb-item">Results</li>
<li class="breadcrumb-item active">{{ $data->lecturer->name }} </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5>Observation Results</h5>
                </div>
                <div class="card-body">
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-light alert-dismissible fade show text-danger" role="alert">
                        <strong><i class="fa fa-exclamation-triangle"></i></strong> {{ $error }}
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endforeach
                    <div class="row">
                        <div class="col">
                            <div class="mb-3 row">
                                <label class="col-sm-3">Schedule</label>
                                <div class="col-sm-9">
                                    <strong>
                                        {{ date('d M Y H:i', strtotime($data->date_start)) }} -
                                        {{ date('d M Y H:i', strtotime($data->date_end)) }}
                                    </strong>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3">Lecturer</label>
                                <div class="col-sm-9">
                                    <strong>{{ $data->lecturer->name }}</strong>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3">Auditor</label>
                                <div class="col-sm-9">
                                    @foreach($data->observations as $no => $o)
                                    <strong>{{ $no + 1 }}) {{ $o->auditor->name }}</strong><br>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3">Status</label>
                                <div class="col-sm-9">
                                    <i class="badge rounded-pill badge-{{ $data->status->color }}">
                                        <strong>{{ $data->status->title }}</strong>
                                    </i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col mb-3">
                            <table class="table table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>Observation Data</th>
                                        @foreach($data->observations as $no => $o)
                                        <th>Auditor {{ $no + 1 }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Attendance Date</td>
                                        @foreach($data->observations as $no => $o)
                                        <td>{{ date('l, d M Y H:i', strtotime($o->updated_at)) }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Class Type</td>
                                        @foreach($data->observations as $no => $o)
                                        <td>{{ $o->class_type }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Location</td>
                                        @foreach($data->observations as $no => $o)
                                        <td>{{ $o->location }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Total Students</td>
                                        @foreach($data->observations as $no => $o)
                                        <td>{{ $o->total_students }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Subject Course</td>
                                        @foreach($data->observations as $no => $o)
                                        <td>{{ $o->subject_course }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Topic</td>
                                        @foreach($data->observations as $no => $o)
                                        <td>{{ $o->topic }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Remark</td>
                                        @foreach($data->observations as $no => $o)
                                        <td>{{ $o->remark }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Photo / Documentation</td>
                                        @foreach($data->observations as $no => $o)
                                        <td>
                                            <a target="_blank" href="{{ asset($o->image_path) }}">
                                                <img class="chat-user-img img-50" src="{{ asset($o->image_path) }}">
                                            </a>
                                        </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-12 d-flex justify-content-center">
                            <table class="table table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Criteria</th>
                                        @foreach($data->observations as $no => $o)
                                        <th>Auditor {{ $no + 1 }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $total = 0;
                                    $total_w = 0;
                                    @endphp
                                    @foreach($survey as $key => $category)
                                    @php
                                    $title = "";
                                    $jumlah_auditor = count($category);
                                    @endphp
                                    <tr valign="top">
                                        <td><strong>{{ $key }}</strong></td>
                                        @foreach($category as $cat)
                                            @php
                                            $title = $cat->criteria_category->title." <u>".$cat->criteria_category->description."</u>";
                                            @endphp
                                        @endforeach
                                        <td >{!! $title !!}</td>
                                        <td colspan="{{$jumlah_auditor}}"></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card project-list">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <a href="{{ route('schedules.edit', ['id'=> $id]) }}">
                            <span class="btn btn-secondary">Back</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
