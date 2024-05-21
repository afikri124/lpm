@extends('layouts.master')
@section('title', 'Submit RPS')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<!-- <h3></h3> -->
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Observations</li>
<li class="breadcrumb-item">Submit RPS</li>
<li class="breadcrumb-item active">{{ $data->lecturer->name }} </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5>Submit RPS</h5>
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
                                    @php
                                    $jumlah_auditor = 0;
                                    @endphp
                                    @foreach($data->observations as $no => $o)
                                    @if(!$o->attendance)
                                    <i class="text-danger">{{ $no + 1 }}) {{ $o->auditor->name }}</i><br>
                                    @else
                                    @php
                                    $jumlah_auditor++;
                                    @endphp
                                    <strong>{{ $no + 1 }}) {{ $o->auditor->name }}</strong><br>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-4">Status</label>
                                <div class="col-sm-8">
                                    <i class="badge rounded-pill badge-{{ $data->status->color }}">
                                        <strong style="color: #000">{{ $data->status->title }}</strong>
                                    </i>
                                </div>
                            </div>
                            @if ($data->status_id == "S08")
                            <div class="mb-3 row">
                                <label class="col-sm-4">Validation Remark</label>
                                <div class="col-sm-8">
                                    <i>{{ $data->validation_remark }}</i>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <form method="POST" action=""  enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <div class="mb-3 col-lg-12 col-md-12">
                                    <label>Upload RPS (Pdf)<i class="text-danger">*</i></label>
                                    <input class="form-control" name="rps_path" type="file" accept="application/pdf"
                                        title="Accept pdf file only" data-bs-original-title=""
                                        title="only accept pdf file">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-info" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
