@extends('layouts.master')
@section('title', 'Follow Up : '.$data->lecturer->name )

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/dropzone.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<!-- <h3></h3> -->
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Follow Up</li>
<li class="breadcrumb-item active">{{ $data->lecturer->name }} </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5>Follow Up</h5>
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
                                <label class="col-sm-4">Follow-Up by</label>
                                <div class="col-sm-8">
                                    <strong>{{ $follow_up->dean->name }}</strong>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-4">Follow-Up Schedule</label>
                                <div class="col-sm-8">
                                    <strong>
                                        {{ date('l, d M Y H:i', strtotime($follow_up->date_start)) }} -
                                        {{ date('l, d M Y H:i', strtotime($follow_up->date_end)) }}
                                    </strong>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-4">Study Program</label>
                                <div class="col-sm-8">
                                    <strong>{{ ($follow_up->schedule->study_program==null ? $data->lecturer->study_program : $follow_up->schedule->study_program) }}</strong>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-4">Lecturer / Auditee</label>
                                <div class="col-sm-8">
                                    <strong>{{ $data->lecturer->name }}</strong><br>
                                    <i>
                                        <a target="_blank"
                                            href="https://wa.me/{{ $data->lecturer->phone }}">{{ $data->lecturer->phone }}</a>
                                        @if($data->lecturer->email != null && $data->lecturer->phone != null)
                                        /
                                        @endif
                                        <a target="_blank"
                                            href="mailto:{{ $data->lecturer->email }}">{{ $data->lecturer->email }}</a>
                                    </i>
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
                            <div class="mb-3 row">
                                <label class="col-sm-4">Remark by LPM</label>
                                <div class="col-sm-8">
                                    <i>{{ $follow_up->schedule->remark }}</i>
                                </div>
                            </div>
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
                                        <th>Accessment Category</th>
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
                                        $title = ($cat->criteria_category == null ? "" : $cat->criteria_category->title)."
                                        <u>".($cat->criteria_category == null ? "" : $cat->criteria_category->description)."</u>";
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
                                        <td colspan="2"></td>
                                        @foreach($data->observations as $no => $o)
                                        <td class='text-center'>
                                            <a target="_blank" class="text-info"
                                                href="{{ route('observations.results',  ['id' => Crypt::encrypt($o->id)]) }}">
                                                view details
                                            </a>
                                        </td>
                                        @endforeach
                                    </tr>
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

            @if($follow_up->remark != null)
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <table class="table table-hover" width="100%">
                                    <thead valign="top">
                                        <tr>
                                            <th colspan="2">Remark Follow-Up<br><br>
                                                <textarea class="form-control mb-4 disabled"
                                                    rows="7">{{ $follow_up->remark }}</textarea>
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <a target="_blank" href="{{ asset($follow_up->image_path) }}">
                                <img class="img-fluid b-r-10" src="{{ asset($follow_up->image_path) }}">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="card project-list">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        @if($data->status_id == "S04")
                        <a type="button" data-bs-toggle="modal" data-bs-target="#modalSendResult">
                            <span class="btn btn-primary">Follow-Up</span>
                        </a>
                        @endif
                        <a href="{{ route('pdf.report', ['id' => Crypt::encrypt($data->id)]) }}" target="_blank">
                            <span class="btn btn-success btn-block" title="Print Pdf">Report</span>
                        </a>
                        <a href="{{ route('follow_up') }}">
                            <span class="btn btn-secondary">Back</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if($data->status_id == "S04")
<div class="modal fade" id="modalSendResult" tabindex="-1" role="dialog" aria-labelledby="modalSendResult"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Follow-Up Result</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Lecturer / Auditee</label>
                                <input class="form-control digits" autocomplete="off" type="text" name="lecturer"
                                    value="{{ $data->lecturer->name }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Photo documentation<i class="text-danger">*</i>
                                </label>
                                <input class="form-control" name="image_path" type="file" accept="image/*"
                                    title="Photo documentation" data-bs-original-title="" title="only accept image"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label class="col-form-label">Remark or Recommendation<i class="text-danger">*</i>
                                    <i id="count" class="text-danger">(0/500)</i>
                                </label>
                                <textarea class="form-control" rows="5" id="remark" name="remark" minlength="500"
                                    required>{{ old('remark') }}</textarea>
                            </div>
                        </div>
                        <span class="invalid-feedback d-block" role="alert">
                            <i>Note: <br>- Give messages to increase the score.<br>- The remark must be at least 500 characters.</i>
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
@endif
@endsection

@section('script')
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/dropzone/dropzone.js')}}"></script>
<script src="{{asset('assets/js/dropzone/dropzone-script.js')}}"></script>
<script>
    $("#remark").keyup(function(){
        $("#count").text("(" + $(this).val().length + "/500)");
        if($(this).val().length >= 500){
            $("#count").removeClass('text-danger');
        } else {
            $("#count").addClass('text-danger');
        }
    });
</script>
@endsection
