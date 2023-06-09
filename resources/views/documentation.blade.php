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
            <div class="card-body">
               <ul class="nav nav-tabs" id="icon-tab" role="tablist">
                   <li class="nav-item"><a class="nav-link active" id="icon-home-tab" data-bs-toggle="tab" href="#icon-home" role="tab" aria-controls="icon-home" aria-selected="true" data-bs-original-title="" title="">New</a></li>
                   <li class="nav-item"><a class="nav-link" id="profile-icon-tab" data-bs-toggle="tab" href="#profile-icon" role="tab" aria-controls="profile-icon" aria-selected="false" data-bs-original-title="" title="">Old</a></li>
               </ul>
               <div class="tab-content" id="icon-tabContent">
                   <div class="tab-pane fade active show text-center pt-0" id="icon-home" role="tabpanel" aria-labelledby="icon-home-tab">
                     <a href="{{asset('assets/dg-po2.png')}}" target="_blank">
                        <img class="img-fluid" style="max-height: 450px;" src="{{asset('assets/dg-po2.png')}}">
                    </a>
                   </div>
                   <div class="tab-pane fade text-center pt-0" id="profile-icon" role="tabpanel" aria-labelledby="profile-icon-tab">
                     <a href="{{asset('assets/dg-po.png')}}" target="_blank">
                        <img class="img-fluid" style="max-height: 450px;" src="{{asset('assets/dg-po.png')}}">
                    </a>
                   </div>
               </div>
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