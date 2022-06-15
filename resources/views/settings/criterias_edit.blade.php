@extends('layouts.master')
@section('title', "Edit Criteria")

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Settings</li>
<li class="breadcrumb-item">Criteria</li>
<li class="breadcrumb-item active">#{{ $data->id }} </li>
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
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Criteria Title<i class="text-danger">*</i></label>
                                <textarea class="form-control" rows="2"
                                    name="title">{{ $data->title }}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Category<i class="text-danger">*</i></label>
                                <!-- <input class="form-control" type="text" name="id" value="{{ $data->id }}"> -->

                                <select
                                    class="form-select digits select2 @error('criteria_category_id') is-invalid @enderror"
                                    name="criteria_category_id" id="criteria_category_id" data-placeholder="Select">
                                    <option value="" selected disabled>Select</option>
                                    @foreach($categories as $p)
                                    <option value="{{ $p->id }}"
                                        {{ ($p->id==$data->criteria_category_id ? "selected": "") }}>
                                        {{ $p->id }} - {{ $p->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Weight<i class="text-danger">*</i></label>
                                <input class="form-control" type=number min=0 step=0.10 name="weight" value="{{ $data->weight }}">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-success" type="submit">Update</button>
                    <a href="{{ route('settings.criterias') }}">
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
