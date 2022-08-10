@extends('layouts.master')
@section('title', 'Observation : '.$lecturer->name)

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<!-- <h3></h3> -->
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Observations</li>
<li class="breadcrumb-item active">{{ $lecturer->name }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5>Observation {{ ($data->attendance ? "results" : "") }}</h5>
                </div>
                <div class="card-body">
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-light alert-dismissible fade show text-danger" role="alert">
                        <strong><i class="fa fa-exclamation-triangle"></i></strong> {{ $error }}
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endforeach
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Lecturer</label>
                                <br><strong>{{ $lecturer->name }}</strong>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Observation Date</label>
                                <br><strong>
                                    @if($data->attendance)
                                    {{ date('l, d M Y H:i', strtotime($data->updated_at)) }}
                                    @else
                                    {{ date('d M Y H:i', strtotime($data->schedule->date_start)) }} -
                                    {{ date('d M Y H:i', strtotime($data->schedule->date_end)) }}
                                    @endif
                                </strong>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Auditor</label>
                                <br><strong>{{ $data->auditor->name }}</strong>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Total Students</label>
                                <br><strong>{{ $data->total_students }}</strong>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Class Type</label>
                                <br><strong>{{ $data->class_type }}</strong>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Location</label>
                                <br><strong>{{ $data->location }}</strong>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Subject Course</label>
                                <br><strong>{{ $data->subject_course }}</strong>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Topic</label>
                                <br><strong>{{ $data->topic }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($data->attendance)
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-12 d-flex justify-content-center">
                            <table class="table table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Criteria</th>
                                        <th class="text-center d-none d-lg-table-cell">Score</th>
                                        <th class="text-center d-none d-lg-table-cell">Weight</th>
                                        <th class="text-center">Point</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $total = 0;
                                    $total_w = 0;
                                    @endphp
                                    @foreach($survey as $key => $q)
                                    <tr valign="top">
                                        <th><strong>{{ $q->criteria_category_id }}</strong></th>
                                        <th colspan="4">{{ $q->criteria_category->title }}
                                            <u>{{ $q->criteria_category->description }}</u></th>
                                    </tr>
                                    @php
                                    $point = 0;
                                    @endphp
                                    @foreach($q->observation_criterias as $no => $c)
                                    <tr valign="top">
                                        <td>{{ $q->criteria_category_id }}.{{ $no + 1 }}</td>
                                        <td>{{ $c->criteria->title }}</td>
                                        <td class="text-center d-none d-lg-table-cell">{{ $c->score }}</td>
                                        <td class="text-center d-none d-lg-table-cell">{{ $c->weight }}</td>
                                        <td class="text-center">{{ $c->score*$c->weight }}</td>
                                    </tr>
                                    @php
                                    $point += ($c->score*$c->weight);
                                    $total_w += $c->weight;
                                    @endphp
                                    @endforeach
                                    @php
                                    $total += $point;
                                    @endphp
                                    @if(count($q->observation_criterias) > 0)
                                    <tr valign="top">
                                        <td colspan="2">Total Rating {{ $q->criteria_category_id }}</td>
                                        <td colspan="3" class="text-center">{{ $point }} points</td>
                                    </tr>
                                    @endif
                                    <tr valign="top">
                                        <td></td>
                                        <td colspan="4" class="text-danger"><i>{{ $q->remark }}</i></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mt-4">
                            <div class="form-group mb-2">
                                <table class="table table-hover" width="100%">
                                    <thead valign="top">
                                        <tr>
                                            <th>Overall rating</th>
                                            <th class="text-right">{{ $total }} points</th>
                                        </tr>
                                        <tr>
                                            <th>Percentage</th>
                                            <th class="text-right">
                                                {{ number_format($total/($total_w*5)*100, 1); }}%
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="2">Remark<br><br>
                                                <textarea class="form-control mb-4 disabled"
                                                    rows="7">{{ $data->remark }}</textarea>
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <a target="_blank" href="{{ asset($data->image_path) }}">
                                <img class="img-fluid b-r-10" src="{{ asset($data->image_path) }}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="card project-list">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <a href="{{ route('observations') }}">
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
