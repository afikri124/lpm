@extends('layouts.master')

@section('title', 'Rubric')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Rubric Guidance</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Rubric</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header">
               <h5>Rubric Guidance</h5>
            </div>
            <div class="d-none d-md-block">
                <iframe src="{{asset('assets/rubric_new.pdf')}}" style="width:100%; height:650px;" frameborder="0"></iframe>
            </div>
            <div class="text-center pb-4">
                <a href="{{asset('assets/rubric_new.pdf')}}" class="btn btn-primary" target="_blank">Download</a>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
@endsection