<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="pixelstrap">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">
    @include('layouts.css')
    @yield('style')
    <style>
        .page-wrapper.compact-wrapper .nav-right .nav-menus {
            margin-right: 0px;
        }

    </style>
</head>

<body>
    <div class="loader-wrapper">
        <div class="loader-index"><span></span></div>
        <svg>
            <defs></defs>
            <filter id="goo">
                <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo">
                </fecolormatrix>
            </filter>
        </svg>
    </div>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        @include('layouts.header')
        <!-- Page Header Ends  -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            @include('layouts.sidebar')
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                @yield('breadcrumb-title')
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"> <i
                                                data-feather="home"></i></a></li>
                                    @yield('breadcrumb-items')
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid starts-->
                @yield('content')
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            @include('layouts.footer')

        </div>
    </div>
    <!-- latest jquery-->
    @include('layouts.script')
    <!-- Plugin used-->
    <script type="text/javascript">
        $(".mode").on("click", function () {
            $('.mode i').toggleClass("fa-moon-o").toggleClass("fa-lightbulb-o");
            var color = $(this).attr("data-attr");
            if (typeof (Storage) !== "undefined") {
                var y = document.getElementById("darkmodeicon").className;
                if (y == "fa fa-moon-o") {
                    $('body').toggleClass(localStorage.getItem("body"));
                    localStorage.removeItem('body');
                } else {
                    localStorage.setItem('body', 'dark-only');
                    $('body').toggleClass(localStorage.getItem("body"));
                }
            }
        });

        // Check browser support
        $(document).ready(function () {
            if (typeof (Storage) !== "undefined") {
                if (localStorage.getItem("body") == 'dark-only') {
                    $('body').toggleClass(localStorage.getItem("body"));
                    var y = document.getElementById("darkmodeicon").className;
                    if (y == "fa fa-moon-o") {
                        console.log("Dark mode on");
                        $('.mode i').toggleClass("fa-moon-o").toggleClass("fa-lightbulb-o");
                    }
                }
                if (window.innerWidth >= 991) {
                    // load desktop script
                    if (localStorage.getItem("sidebar_mode") != null) {
                        console.log(localStorage.getItem("sidebar_mode"));
                        $nav = $('.sidebar-wrapper');
                        $header = $('.page-header');
                        $nav.toggleClass('close_icon');
                        $header.toggleClass('close_icon');
                        $(window).trigger('overlay');
                    }
                }

                if (localStorage.getItem("full_screen") != null) {
                    console.log(localStorage.getItem("full_screen"));
                    toggleFullScreen();
                }
            } else {
                console.log("Sorry, your browser does not support Web Storage...");
            }
        });

        $(".maximize").on("click", function () {
            toggleFullScreen();
            if (typeof (Storage) !== "undefined") {
                if (localStorage.getItem("full_screen") != null) {
                    localStorage.removeItem('full_screen');
                } else {
                    localStorage.setItem('full_screen', "Fullscreen mode on");
                }
            }
        });

        function notifications(i) {
            $.ajax({
                type: "GET",
                url: "{{ route('api.notifications') }}",
                success: function (data) {
                    // console.log(data);
                    if (data['schedules'] != null) {
                        if (data['schedules'].notif != 0) document.getElementById("notif_schedules")
                            .innerHTML = data['schedules'].notif;
                    } else {
                        var x = document.getElementById("notif_schedules");
                        if (x) x.innerHTML = "";
                    }

                    if (data['observations'] != null) {
                        if (data['observations'].notif != 0) document.getElementById(
                            "notif_observations").innerHTML = data['observations'].notif;
                    } else {
                        var x = document.getElementById("notif_observations");
                        if (x) x.innerHTML = "";
                    }

                    if (data['follow_ups'] != null) {
                        if (data['follow_ups'] != 0) document.getElementById(
                            "notif_follow_ups").innerHTML = data['follow_ups'].notif;
                    } else {
                        var x = document.getElementById("notif_follow_ups");
                        if (x) x.innerHTML = "";
                    }

                    if (data['mypo'] != null) {
                        if (data['mypo'] != 0) document.getElementById(
                            "notif_mypo").innerHTML = data['mypo'].notif;
                    } else {
                        var x = document.getElementById("notif_mypo");
                        if (x) x.innerHTML = "";
                    }
                }
            });
            var t = setTimeout(notifications, 30 * 1000);
        }
        notifications();

    </script>

</body>

</html>
