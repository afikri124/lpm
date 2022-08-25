@extends('layouts.master')
@section('title', 'Observation Review')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<!-- <h3></h3> -->
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Schedules</li>
<li class="breadcrumb-item">Review</li>
<li class="breadcrumb-item active">{{ $data->lecturer->name }} </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5>Observation Review</h5>
                </div>
                <div class="card-body">
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-light alert-dismissible fade show text-danger" role="alert">
                        <strong><i class="fa fa-exclamation-triangle"></i></strong> {{ $error }}
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endforeach
                    <div class="row">
                        <div class="col px-4">
                            <div class="mb-3 row">
                                <label class="col-sm-4">Schedule</label>
                                <div class="col-sm-8">
                                    <strong>
                                        {{ date('d M Y H:i', strtotime($data->date_start)) }} -
                                        {{ date('d M Y H:i', strtotime($data->date_end)) }}
                                    </strong>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-4">Study Program</label>
                                <div class="col-sm-8">
                                    <strong>{{ ($data->study_program==null ? $data->lecturer->study_program : $data->study_program) }}</strong>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-4">Lecturer</label>
                                <div class="col-sm-8">
                                    <strong>{{ $data->lecturer->name }}</strong>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-4">Auditor</label>
                                <div class="col-sm-8">
                                    @foreach($data->observations as $no => $o)
                                    <strong>{{ $no + 1 }}) {{ $o->auditor->name }}</strong><br>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-4">Status</label>
                                <div class="col-sm-8">
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
                                        <th width="40%"></th>
                                        @foreach($data->observations as $no => $o)
                                        <th width="30%">Auditor {{ $no + 1 }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Attendance Date</th>
                                        @foreach($data->observations as $no => $o)
                                        <td>{{ date('l, d M Y H:i', strtotime($o->updated_at)) }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>Class Type</th>
                                        @foreach($data->observations as $no => $o)
                                        <td>{{ $o->class_type }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>Location</th>
                                        @foreach($data->observations as $no => $o)
                                        <td>{{ $o->location }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>Total Students</th>
                                        @foreach($data->observations as $no => $o)
                                        <td>{{ $o->total_students }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>Subject Course</th>
                                        @foreach($data->observations as $no => $o)
                                        <td>{{ $o->subject_course }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>Topic</th>
                                        @foreach($data->observations as $no => $o)
                                        <td>{{ $o->topic }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>Photo / Documentation</th>
                                        @foreach($data->observations as $no => $o)
                                        <td>
                                            <a target="_blank" href="{{ asset($o->image_path) }}">
                                                <img class="chat-user-img img-100" src="{{ asset($o->image_path) }}">
                                            </a>
                                        </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th></th>
                                        @foreach($data->observations as $no => $o)
                                        <td>
                                            <a target="_blank"
                                                href="{{ route('observations.results',  ['id' => Crypt::encrypt($o->id)]) }}">
                                                <span>view details</span>
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
                        <div class="col mb-3">
                            <table class="table table-hover" width="100%">
                                
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Remark / Overall Comments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->observations as $no => $o)
                                    <tr>
                                        <th>Auditor {{ $no + 1 }}</th>
                                        <td><i>{{ $o->remark }}</i></td>
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
                        <div class="mb-3 col-md-12 d-flex justify-content-center">
                            <table class="table table-hover" width="100%">
                                @php
                                $total_w = 0;
                                $jumlah_auditor = count($data->observations);
                                $total = array();
                                @endphp
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Criteria Category</th>
                                        @foreach($data->observations as $no => $o)
                                        <th class='text-center'>Auditor {{ $no + 1 }}</th>
                                        @php
                                        array_push($total, 0);
                                        @endphp
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($survey as $key => $category)
                                    @php
                                    $title = "";
                                    $point = array();
                                    @endphp
                                    <tr valign="top">
                                        <td class='text-center'><strong>{{ $key }}</strong></td>
                                        @php
                                        foreach($category as $cat){
                                        $title = $cat->criteria_category->title."
                                        <u>".$cat->criteria_category->description."</u>";
                                        $p_temp = 0;
                                        $w_temp = 0;
                                        foreach($cat->observation_criterias as $criterias ){
                                        $p_temp += ($criterias->score*$criterias->weight);
                                        $w_temp += $criterias->weight;
                                        }
                                        array_push($point, $p_temp);
                                        $total_w += $w_temp;
                                        }
                                        @endphp
                                        <td>{!! $title !!}</td>
                                        @php
                                        foreach($point as $k => $p){
                                        echo "<td class='text-center'>$p</td>";
                                        $total[$k] += $p;
                                        }
                                        @endphp
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">Rating</td>
                                        @foreach($total as $k => $p )
                                        <td class='text-center'>{{ $p }} points</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td colspan="2">Percentage</td>
                                        @foreach($total as $k => $p )
                                        <td
                                            class='text-center @if(($p/($total_w/$jumlah_auditor*5)*100) < $MINSCORE->content) text-danger @endif'>
                                            {{ number_format($p/($total_w/$jumlah_auditor*5)*100,1); }}%
                                        </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td colspan="2">Final Results</td>
                                        @php
                                        $total_point = 0;
                                        foreach($total as $k => $p ){
                                        $total_point += $p;
                                        }
                                        $final = $total_point/($total_w*5)*100;
                                        @endphp
                                        <td class='text-center @if($final < $MINSCORE->content) text-danger @endif'
                                            colspan="2">
                                            {{ number_format($final, 1); }}%
                                            @if($final < $MINSCORE->content)
                                                <br><i class="fa fa-exclamation-circle"></i> Score below the
                                                {{ $MINSCORE->title }}
                                                @endif
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card project-list">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        @if($data->status_id == "S03")
                        <a type="button" data-bs-toggle="modal" data-bs-target="#modalFolowUp">
                            <span class="btn btn-primary">Follow-Up</span>
                        </a>
                        <a type="button" data-bs-toggle="modal" data-bs-target="#modalSendResult">
                            <span class="btn btn-success">Send Result</span>
                        </a>
                        @endif
                        <a href="{{ route('schedules.edit', ['id'=> $id]) }}">
                            <span class="btn btn-secondary">Back</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if($data->status_id == "S03")
<div class="modal fade" id="modalFolowUp" tabindex="-1" role="dialog" aria-labelledby="modalFolowUp" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Folow Up to Dean</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Select Dean<i class="text-danger">*</i></label>
                                <select class="form-select digits select2 @error('dean_id') is-invalid @enderror"
                                    name="dean_id" id="dean_id" data-placeholder="Select" required>
                                    <option value="" selected disabled>Select Dean</option>
                                    @foreach($dean as $p)
                                    <option value="{{ $p->id }}" {{ ($p->id==old('dean_id') ? "selected": "") }}>
                                        {{ $p->name }} ({{ $p->department }})
                                    </option>
                                    @endforeach
                                </select>
                                @error('dean_id')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Start<i class="text-danger">*</i></label>
                                <input class="form-control digits" autocomplete="off" type="datetime-local"
                                    id="date_start" name="date_start" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">End<i class="text-danger">*</i></label>
                                <input class="form-control digits" autocomplete="off" type="datetime-local"
                                    id="date_end" name="date_end" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Remark<i class="text-danger">*</i></label>
                                <textarea class="form-control" rows="2" name="remark" required></textarea>
                                <input type="hidden" name="action" value="followup" required>
                            </div>
                        </div>
                        <span class="invalid-feedback d-block" role="alert">
                            <i>Note: explain why the dean should follow up.</i>
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalSendResult" tabindex="-1" role="dialog" aria-labelledby="modalSendResult"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Send Result and Recommendation</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Lecturer</label>
                                <input type="hidden" name="action" value="result" required>
                                <input class="form-control digits" autocomplete="off" type="text" name="lecturer"
                                    value="{{ $data->lecturer->name }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Remark or Recommendation<i
                                        class="text-danger">*</i></label>
                                <textarea class="form-control" rows="2" name="remark" required></textarea>
                            </div>
                        </div>
                        <span class="invalid-feedback d-block" role="alert">
                            <i>Note: give a message of appreciation for the score result or score increase.</i>
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection

@section('script')
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $("#dean_id").select2({
            dropdownParent: $("#modalFolowUp")
        });
    });

</script>
@endsection
