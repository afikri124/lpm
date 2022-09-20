@extends('layouts.master')

@section('title', 'Documentation')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Documentation</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Documentation</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header">
               <h5>Flow System</h5>
            </div>
            <div class="card-body text-center pt-0">
                <a href="{{asset('assets/dg-po.png')}}" target="_blank">
                    <img class="img-fluid" style="max-height: 450px;" src="{{asset('assets/dg-po.png')}}">
                </a>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header">
               <h5>User Guidance</h5>
            </div>
            <div class="d-none d-md-block">
                <iframe src="{{asset('assets/doc.pdf')}}" style="width:100%; height:650px;" frameborder="0"></iframe>
            </div>
            <div class="text-center pb-4">
                <a href="{{asset('assets/doc.pdf')}}" class="btn btn-primary" target="_blank">Download</a>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
@endsection