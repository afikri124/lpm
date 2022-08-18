@extends('layouts.master')
@section('title', ucfirst($data->id))

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<!-- <h3>User Profile</h3> -->
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Settings</li>
<li class="breadcrumb-item">Category</li>
<li class="breadcrumb-item active">{{ $data->id }} </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <form class="card" method="POST" action="">
                @csrf
                <div class="card-header">
                    <h4 class="card-title mb-0">Edit Category</h4>
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
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Code ID<i class="text-danger">*</i></label>
                                <input class="form-control" type="text" name="id" value="{{ $data->id }}">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Title<i class="text-danger">*</i></label>
                                <input class="form-control" type="text" name="title" value="{{ $data->title }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" rows="2"
                                    name="description">{{ $data->description }}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <div class="form-check checkbox checkbox-default mb-0">
                                    @if($data->is_required)
                                    <input class="form-check-input" id="is_required" type="checkbox" value="1" checked
                                        name="is_required">
                                    @else
                                    <input class="form-check-input" id="is_required" type="checkbox" value="0" name="is_required">
                                    @endif
                                    <label class="form-check-label" for="is_required">Comments are required for this
                                        category.</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-success" type="submit">Update</button>
                    <a href="{{ route('settings.categories') }}">
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
<script>
    $(document).ready(function () {
        const selectElement = document.querySelector('#is_required');
        selectElement.addEventListener('change', (event) => {
            selectElement.value = selectElement.checked ? 1 : 0;
            // alert(selectElement.value);
        });
    });
</script>
@endsection
