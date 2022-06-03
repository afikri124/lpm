@extends('layouts.authentication.master')
@section('title', 'Verify')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-card">
                <div>
                    <div><a class="logo" href="{{ route('home') }}">
                            <img class="img-fluid" style="max-width: 50%;" src="{{asset('assets/images/logo.png')}}"
                                alt="looginpage"></a>
                    </div>
                    <div class="login-main">
                        <h4>{{ __('Verify Your Email Address') }}</h4>
                        <div class="form-group">

                            <p>Registered email: {{ Auth::user()->email }}</p>
                            @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                            @endif
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                            {{ __('If you did not receive the email') }},
                        </div>

                        <div class="form-group mb-4 mt-4">
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit"
                                    class="btn btn-link p-0 m-0 align-baseline">{{ __('Click here to request another') }}</button>.
                            </form>
                        </div>
                        <a  class="btn btn-secondary" href="{{ route('logout') }}" onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();"></i><span>Log out</span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
