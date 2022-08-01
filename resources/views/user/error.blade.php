@extends('layouts.authentication.master')
@section('title', 'Alert!')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-card row">
                <div class="col-lg-6 col-md-12">
                    <div><a class="logo" href="{{ route('login') }}">
                            <img class="img-fluid" style="max-width: 200px;" src="{{asset('assets/images/logo.png')}}"
                                alt="signuppage"></a>
                    </div>
                    <div class="login-main text-danger text-center">
                        @if(isset($msg))
                        {!! $msg !!}
                        @else
                        <h1>ERROR!</h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('script')
@endsection
