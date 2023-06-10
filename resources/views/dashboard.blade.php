@extends('layouts.master')
@section('title', 'Dashboard')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
@endsection

@section('style')
<style>

</style>
@endsection

@section('breadcrumb-title')
<h3>Dashboard</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">@yield('title')</li>
@endsection

@section('content')
<div class="container-fluid">
    @if($INFO->title == "Y")
    <div class="row">
        <div class="col-12">
            <div class="alert alert-warning inverse alert-dismissible fade show" role="alert" style="font-size: 10pt;">
                <strong><i class="fa fa-info-circle"></i></strong>{{ $INFO->content }}
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif
    <!-- Modal-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Ingin Mendapatkan Notifikasi ke Aplikasi WhatsApp <i
                        class="icofont icofont-brand-whatsapp"></i> ? <small class="text-danger">*</small></h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <i>Pastikan nomor Anda yang terdaftar di sistem ini <b>{{ Auth::user()->phone }}</b> sama dengan nomor
                        WhatsApp Anda, jika tidak sama silahkan perbarui melaui menu <a
                            href="{{ route('my_profile') }}"><b>My Profile</b></a></i><br><br>

                    <u>Pilih salah satu cara berikut ini:</u>
                    <ol>
                        <li>
                            Chat <i class="icofont icofont-brand-whatsapp"></i> ke nomor <b>+1 415 523 8886</b> dangan mengirim pesan
                            <blockquote><b>join wide-common</b></blockquote>
                        </li>
                        <li>
                            Klik tautan berikut, lalu kirim chat. <a class="" target="_blank" href="http://wa.me/+14155238886?text=join%20wide-common" type="button"
                                >Buka WhatsApp <i class="fa fa-external-link"></i></a>
                        </li>
                        <li>
                            Pindai KodeQR ini: <br>
                        </li>
                    </ol>
                    <div class="text-center">
                        <a class="" target="_blank" href="http://wa.me/+14155238886?text=join%20wide-common" type="button" >
                            <div data-paste-element="BOX" class="css-kbfmxe"><img alt="http://wa.me/+14155238886?text=join%20wide-common" src="data:image/svg+xml;utf8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2033%2033%22%20shape-rendering%3D%22crispEdges%22%3E%3Cpath%20fill%3D%22%23ffffff%22%20d%3D%22M0%200h33v33H0z%22%2F%3E%3Cpath%20stroke%3D%22%23000000%22%20d%3D%22M0%200.5h7m3%200h3m2%200h1m4%200h1m1%200h1m1%200h1m1%200h7M0%201.5h1m5%200h1m1%200h2m3%200h3m1%200h1m3%200h2m3%200h1m5%200h1M0%202.5h1m1%200h3m1%200h1m1%200h2m3%200h1m1%200h4m4%200h1m2%200h1m1%200h3m1%200h1M0%203.5h1m1%200h3m1%200h1m1%200h2m9%200h1m3%200h1m2%200h1m1%200h3m1%200h1M0%204.5h1m1%200h3m1%200h1m3%200h1m2%200h1m1%200h1m2%200h1m3%200h1m3%200h1m1%200h3m1%200h1M0%205.5h1m5%200h1m3%200h5m1%200h1m1%200h1m1%200h2m1%200h2m1%200h1m5%200h1M0%206.5h7m1%200h1m1%200h1m1%200h1m1%200h1m1%200h1m1%200h1m1%200h1m1%200h1m1%200h1m1%200h7M8%207.5h3m1%200h2m4%200h1m3%200h3M0%208.5h1m5%200h1m1%200h2m1%200h2m1%200h4m3%200h1m1%200h4m2%200h3M1%209.5h2m2%200h1m1%200h1m2%200h2m9%200h1m1%200h3m1%200h4M1%2010.5h1m1%200h2m1%200h2m1%200h1m2%200h1m5%200h2m1%200h2m3%200h1m1%200h1m1%200h2M1%2011.5h3m1%200h1m1%200h1m1%200h1m1%200h2m1%200h2m3%200h1m6%200h5m1%200h1M0%2012.5h2m1%200h1m1%200h5m1%200h4m1%200h3m1%200h4m2%200h3m2%200h1M0%2013.5h1m2%200h1m1%200h1m3%200h1m1%200h1m1%200h2m1%200h2m2%200h1m4%200h1m1%200h6M0%2014.5h2m2%200h1m1%200h1m1%200h1m2%200h3m3%200h1m1%200h1m1%200h1m1%200h3m1%200h1m2%200h2M0%2015.5h1m1%200h2m5%200h1m2%200h4m1%200h3m2%200h4m3%200h2m1%200h1M2%2016.5h1m1%200h1m1%200h2m2%200h1m2%200h2m1%200h2m1%200h1m3%200h3m1%200h2m3%200h1M0%2017.5h1m2%200h1m1%200h1m1%200h2m6%200h4m1%200h2m1%200h1m2%200h1m2%200h2M4%2018.5h3m1%200h2m1%200h2m2%200h2m2%200h2m2%200h1m1%200h1m3%200h2m1%200h1M0%2019.5h1m1%200h1m4%200h1m1%200h2m1%200h3m2%200h2m2%200h1m4%200h5M0%2020.5h2m1%200h4m3%200h4m2%200h1m2%200h5m1%200h3m1%200h1m1%200h2M0%2021.5h2m1%200h3m2%200h1m3%200h2m2%200h3m1%200h3m3%200h2m2%200h1M0%2022.5h1m1%200h3m1%200h1m2%200h1m3%200h4m1%200h1m1%200h5m2%200h2m1%200h2M0%2023.5h1m2%200h2m6%200h1m1%200h2m2%200h2m2%200h1m1%200h1m1%200h1m3%200h1m2%200h1M0%2024.5h2m4%200h2m4%200h6m1%200h1m1%200h2m1%200h6M8%2025.5h1m1%200h2m2%200h3m1%200h1m5%200h1m3%200h1m1%200h2M0%2026.5h7m2%200h1m4%200h1m3%200h1m2%200h1m1%200h2m1%200h1m1%200h1m1%200h3M0%2027.5h1m5%200h1m2%200h4m3%200h1m2%200h2m2%200h2m3%200h1m1%200h1M0%2028.5h1m1%200h3m1%200h1m2%200h1m1%200h5m2%200h2m1%200h1m2%200h6M0%2029.5h1m1%200h3m1%200h1m2%200h3m1%200h1m2%200h2m2%200h3m5%200h2M0%2030.5h1m1%200h3m1%200h1m5%200h3m1%200h1m1%200h1m1%200h2m3%200h1m1%200h3m1%200h2M0%2031.5h1m5%200h1m3%200h4m1%200h11m2%200h2M0%2032.5h7m1%200h1m1%200h2m4%200h2m1%200h1m1%200h1m1%200h1m2%200h6%22%2F%3E%3C%2Fsvg%3E" style="height: 200px; object-fit: contain;"></div>
                        </a>
                    </div>
                </div>
                <div class="modal-footer text-danger">
                    <small>* This WhatsApp notification only use free trial :)</small>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-lg-12 xl-50 morning-sec box-col-12">
            <div class="card profile-greeting">
                <div class="card-body pb-0">
                    <div class="media">
                        <div class="media-body">
                            <div class="greeting-user m-0">
                                <h4 class="f-w-600 font-light m-0" id="greeting">Good Morning</h4>
                                <h3>{{ Auth::user()->name }}</h3>
                                @if(Auth::user()->roles->count() == 0)
                                <p class="p-0 mb-0 text-danger">You don't have access rights, please contact the
                                    administrator!</p>
                                @else
                                <p class="p-0 mb-0 font-light">You have access rights as:</p>
                                @foreach(Auth::user()->roles as $x)
                                <i class="badge badge-secondary m-0">{{ $x->title }}</i>
                                @endforeach
                                @endif
                            </div>
                        </div>
                        <h4>
                            <div class="badge f-10 rounded-pill badge-primary"><i class="fa fa-clock-o"></i> <span
                                    id="txt"></span>
                            </div>
                        </h4>
                    </div>
                    <div class="cartoon"><img class="img-fluid" src="{{asset('/assets/images/cartoon.png')}}"
                            style="max-width: 90%;" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12 xl-50 calendar-sec box-col-6">
            <div class="card gradient-primary o-hidden">
                <div class="card-body">
                    <div class="default-datepicker">
                        <div class="datepicker-here" data-language="en"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(window).on('load', function () {
        $('#myModal').modal('show');
    });

</script>
<!-- <script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script> -->
<script>
    // greeting
    var today = new Date()
    var curHr = today.getHours()

    if (curHr >= 0 && curHr < 4) {
        document.getElementById("greeting").innerHTML = 'Good Night!';
    } else if (curHr >= 4 && curHr < 12) {
        document.getElementById("greeting").innerHTML = 'Good Morning!';
    } else if (curHr >= 12 && curHr < 16) {
        document.getElementById("greeting").innerHTML = 'Good Afternoon!';
    } else {
        document.getElementById("greeting").innerHTML = 'Good Evening!';
    }
    // time 
    function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        // var s = today.getSeconds();
        var ampm = h >= 12 ? 'PM' : 'AM';
        h = h % 12;
        h = h ? h : 12;
        m = checkTime(m);
        // s = checkTime(s);
        document.getElementById('txt').innerHTML =
            h + ":" + m + ' ' + ampm;
        var t = setTimeout(startTime, 500);
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i
        }; // add zero in front of numbers < 10
        return i;
    }

    startTime();

</script>
<!-- <script src="{{asset('assets/js/notify/index.js')}}"></script> -->
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
@endsection
