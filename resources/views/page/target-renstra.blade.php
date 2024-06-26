<!DOCTYPE html>
<html lang="id">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Lembaga Penjaminan Mutu Universitas Global Jakarta">
    <meta name="keywords" content="LPM JGU">
    <meta name="author" content="itic">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <title>{{ config('app.name') }} - Lembaga Penjaminan Mutu Jakarta Global University</title>
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

        .dropdown-basic .dropdown .dropdown-content a {
            padding: 16px 16px;
        }

        .landing-home .content {
            text-align: left;
            margin-left: 20px;
        }
        .table-sm th, .table-sm td {
            padding: 0px;
        }

    </style>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body class="landing-page">
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
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <div class="page-wrapper landing-page">
        <div class="landing-home">
            <ul class="decoration">
                <li class="one"><img class="img-fluid" src="{{ asset('assets/images/landing/decore/1.png') }}" alt="">
                </li>
                <li class="two"><img class="img-fluid" src="{{ asset('assets/images/landing/decore/2.png') }}" alt="">
                </li>
                <li class="three"><img class="img-fluid" src="{{ asset('assets/images/landing/decore/4.png') }}" alt="">
                </li>
                <li class="four"><img class="img-fluid" src="{{ asset('assets/images/landing/decore/3.png') }}" alt="">
                </li>
                <li class="five"><img class="img-fluid" src="{{ asset('assets/images/landing/2.png') }}" alt=""></li>
                <li class="six"><img class="img-fluid" src="{{ asset('assets/images/landing/decore/cloud.png') }}"
                        alt=""></li>
                <li class="seven"><img class="img-fluid" src="{{ asset('assets/images/landing/2.png') }}" alt="">
                </li>
            </ul>
            <div class="container-fluid">
                <div class="sticky-header">
                    <header>
                        <nav class="navbar navbar-b navbar-trans navbar-expand-xl fixed-top nav-padding"
                            id="sidebar-menu"><a class="navbar-brand p-0" href="{{ route('index') }}"><img
                                    class="img-fluid" src="{{ asset('assets/images/logo-white.png') }}" alt="JGU"></a>
                            <button class="navbar-toggler navabr_btn-set custom_nav" type="button"
                                data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault"
                                aria-expanded="false"
                                aria-label="Toggle navigation"><span></span><span></span><span></span></button>
                            <div class="navbar-collapse justify-content-end collapse hidenav" id="navbarDefault">

                            </div>
                        </nav>
                    </header>
                </div>

                <!-- EDIT HOME MULAI DARI SINI -->

                <div class="row">
                    <div class="col-xl-5 col-lg-6">
                        <div class="content ">
                            <div class="container">
                                <h1 class="wow fadeIn"> Target Renstra</h1>
                                <h2 class="txt-secondary wow fadeIn">Jakarta Global University</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-7 col-lg-6">
                        <div class="wow fadeIn"><img class="screen2" style="margin-top: 10vh;"
                                src="{{ asset('assets/images/landing/screen2.jpg') }}" alt=""></div>
                    </div>
                </div>
                <!-- BATAS AKHIR HALAMAN HOME PALING ATAS -->
            </div>
        </div>


        <section class="section-space cuba-demo-section components-section" id="results">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 wow pulse">
                        <div class="cuba-demo-content mt50">
                            <div class="couting">
                                <h2>Dashboard</h2>
                            </div>
                            <p>Target Renstra Universitas Global Jakarta</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row component_responsive">
                <div class="col-sm-12">
                    <div class=" height-equal">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2 col-xs-12 mb-3">
                                    <div class="nav flex-column nav-pills nav-success" id="ver-pills-tab" role="tablist"
                                        aria-orientation="vertical">
                                        <a class="nav-link {{ ((isset($_GET['year']) && $_GET['year'] =='2020') ? "active":"") }}
                                            {{ (!isset($_GET['year']) ? 'active':'') }}
                                            " href="?year=2020#results">2020/2021
                                        </a>
                                        <a class="nav-link {{ (isset($_GET['year']) && $_GET['year'] =='2021'? "active":"") }}"
                                            href="?year=2021#results" role="tab">2021/2022
                                        </a>
                                        <a class="nav-link {{ (isset($_GET['year']) && $_GET['year'] =='2022'? "active":"") }}"
                                            href="?year=2022#results" role="tab">2022/2023
                                        </a>
                                        <a class="nav-link {{ (isset($_GET['year']) && $_GET['year'] =='2023'? "active":"") }}"
                                            href="?year=2023#results" role="tab">2023/2024
                                        </a>
                                        <a class="nav-link {{ (isset($_GET['year']) && $_GET['year'] =='2024'? "active":"") }}"
                                            href="?year=2024#results" role="tab">2024/2025
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-10 col-xs-12">
                                    <div class="tab-content" id="ver-pills-tabContent">
                                        <div class="tab-pane fade show active" id="ver-pills-2020" role="tabpanel"
                                            aria-labelledby="ver-pills-2020-tab">
                                            {{-- chart --}}
                                            <div class="row center">
                                                <div class="col-md-6">
                                                    <script type="text/javascript">
                                                        google.charts.load('current', {
                                                            'packages': ['corechart']
                                                        });
                                                        google.charts.setOnLoadCallback(drawChart);

                                                        function drawChart() {
                                                            @if((isset($_GET['year']) && $_GET['year'] == '2021'))
                                                            var data = google.visualization.arrayToDataTable([
                                                                ['Prodi', 'Target'],
                                                                ['MEE: 20', 20],
                                                                ['BIE: 40', 40],
                                                                ['DAC: 20', 20],
                                                                ['BDB: 70', 70],
                                                                ['BPH: 50', 50],
                                                                ['BCV: 210', 210],
                                                                ['BME: 210', 210],
                                                                ['BEE: 210', 210],
                                                                ['BIT: 210', 210],
                                                                ['BMG: 210', 210]
                                                            ]);
                                                            @elseif((isset($_GET['year']) && $_GET['year'] == '2022'))
                                                            var data = google.visualization.arrayToDataTable([
                                                                ['Prodi', 'Target'],
                                                                ['MEE: 40', 40],
                                                                ['BIE: 60', 60],
                                                                ['DAC: 30', 30],
                                                                ['BDB: 90', 90],
                                                                ['BPH: 80', 80],
                                                                ['BCV: 240', 240],
                                                                ['BME: 240', 240],
                                                                ['BEE: 240', 240],
                                                                ['BIT: 240', 240],
                                                                ['BMG: 240', 240]
                                                            ]);
                                                            @elseif((isset($_GET['year']) && $_GET['year'] == '2023'))
                                                            var data = google.visualization.arrayToDataTable([
                                                                ['Prodi', 'Target'],
                                                                ['MEE: 60', 60],
                                                                ['BIE: 80', 80],
                                                                ['DAC: 40', 40],
                                                                ['BDB: 120', 120],
                                                                ['BPH: 100', 100],
                                                                ['BCV: 270', 270],
                                                                ['BME: 270', 270],
                                                                ['BEE: 270', 270],
                                                                ['BIT: 270', 270],
                                                                ['BMG: 270', 270]

                                                            ]);
                                                            @elseif((isset($_GET['year']) && $_GET['year'] == '2024'))
                                                            var data = google.visualization.arrayToDataTable([
                                                                ['Prodi', 'Target'],
                                                                ['MEE: 80', 80],
                                                                ['BIE: 100', 100],
                                                                ['DAC: 50', 50],
                                                                ['BDB: 150', 150],
                                                                ['BPH: 120', 120],
                                                                ['BCV: 300', 300],
                                                                ['BME: 300', 300],
                                                                ['BEE: 300', 300],
                                                                ['BIT: 300', 300],
                                                                ['BMG: 300', 300]
                                                            ]);
                                                            @else
                                                            var data = google.visualization.arrayToDataTable([
                                                                ['Prodi', 'Target'],
                                                                ['MEE: 10', 10],
                                                                ['BIE: 20', 20],
                                                                ['DAC: 10', 10],
                                                                ['BDB: 40', 40],
                                                                ['BPH: 20', 20],
                                                                ['BCV: 180', 180],
                                                                ['BME: 180', 180],
                                                                ['BEE: 180', 180],
                                                                ['BIT: 180', 180],
                                                                ['BMG: 180', 180]
                                                            ]);
                                                            @endif
                                                            var chart = new google.visualization.PieChart(document
                                                                .getElementById('piechart'));
                                                            chart.draw(data);
                                                        }

                                                    </script>
                                                    <h5>TARGET JUMLAH MAHASISWA</h5>
                                                    <div id="piechart" style="min-height: 350px"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <script type="text/javascript">
                                                        google.charts.load("current", {
                                                            packages: ["corechart"]
                                                        });
                                                        google.charts.setOnLoadCallback(drawChart);

                                                        function drawChart() {
                                                            @if((isset($_GET['year']) && $_GET['year'] == '2021'))
                                                            var data = google.visualization.arrayToDataTable([
                                                                ['Prodi', 'Target'],
                                                                ['BPH: 2', 2],
                                                                ['BCV: 1', 1],
                                                                ['BME: 1', 1],
                                                                ['BEE: 1', 1],
                                                                ['BIT:  2', 2],
                                                                ['BIE:  1', 1],
                                                                ['MEE: 1', 1],
                                                                ['DAC: 1', 1],
                                                                ['BMG: 1', 1],
                                                                ['BDB: 1', 1]
                                                            ]);
                                                            @elseif((isset($_GET['year']) && $_GET['year'] == '2022'))
                                                            var data = google.visualization.arrayToDataTable([
                                                                ['Prodi', 'Target'],
                                                                ['BPH: 2', 2],
                                                                ['BCV: 2', 2],
                                                                ['BME: 2', 2],
                                                                ['BEE: 2', 2],
                                                                ['BIT: 2', 2],
                                                                ['BIE: 2', 2],
                                                                ['MEE: 1', 1],
                                                                ['DAC: 1', 1],
                                                                ['BMG: 2', 2],
                                                                ['BDB: 2', 2]
                                                            ]);
                                                            @elseif((isset($_GET['year']) && $_GET['year'] == '2023'))
                                                            var data = google.visualization.arrayToDataTable([
                                                                ['Prodi', 'Target'],
                                                                ['BPH: 2', 2],
                                                                ['BCV: 2', 2],
                                                                ['BME: 2', 2],
                                                                ['BEE: 2', 2],
                                                                ['BIT: 2', 2],
                                                                ['BIE: 2', 2],
                                                                ['MEE: 2', 2],
                                                                ['DAC: 2', 2],
                                                                ['BMG: 2', 2],
                                                                ['BDB: 2', 2]
                                                            ]);
                                                            @elseif((isset($_GET['year']) && $_GET['year'] == '2024'))
                                                            var data = google.visualization.arrayToDataTable([
                                                                ['Prodi', 'Target'],
                                                                ['BPH: 3', 3],
                                                                ['BCV: 2', 2],
                                                                ['BME: 3', 3],
                                                                ['BEE: 3', 3],
                                                                ['BIT: 2', 2],
                                                                ['BIE: 2', 2],
                                                                ['MEE: 2', 2],
                                                                ['DAC: 2', 2],
                                                                ['BMG: 3', 3],
                                                                ['BDB: 2', 2]
                                                            ]);
                                                            @else
                                                            var data = google.visualization.arrayToDataTable([
                                                                ['Prodi', 'Target'],
                                                                ['BPH: 1', 1],
                                                                ['BCV: 1', 1],
                                                                ['BME: 1', 1],
                                                                ['BEE: 1', 1],
                                                                ['BIT: 1', 1],
                                                                ['BIE: 1', 1],
                                                                ['MEE: 1', 1],
                                                                ['DAC: 1', 1],
                                                                ['BMG: 1', 1],
                                                                ['BDB: 1', 1]
                                                            ]);
                                                            @endif
                                                            var options = {
                                                                is3D: true,
                                                                sliceVisibilityThreshold: 0
                                                            };
                                                            var chart = new google.visualization.PieChart(document
                                                                .getElementById('piechart_3d'));
                                                            chart.draw(data, options);
                                                        }

                                                    </script>
                                                    <h5>TARGET KEGIATAN TRI DHARMA DENGAN INDUSTRI</h5>
                                                    <div id="piechart_3d" style="min-height: 350px"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <script type="text/javascript">
                                                        google.charts.load("current", {
                                                            packages: ["corechart"]
                                                        });
                                                        google.charts.setOnLoadCallback(drawChart);

                                                        function drawChart() {

                                                            @if((isset($_GET['year']) && $_GET['year'] == '2021'))
                                                            var data = google.visualization.arrayToDataTable([
                                                                ['Prodi', 'Target'],
                                                                ['BIE: 0', 0],
                                                                ['MEE: 0', 0],
                                                                ['BDB: 0', 0],
                                                                ['BCV: 1', 1],
                                                                ['BME: 1', 1],
                                                                ['BEE: 1', 1],
                                                                ['BIT: 1', 1],
                                                                ['BPH: 0', 0],
                                                                ['BMG: 0', 0],
                                                                ['DAC: 0', 0]
                                                            ]);
                                                            @elseif((isset($_GET['year']) && $_GET['year'] == '2022'))
                                                            var data = google.visualization.arrayToDataTable([
                                                                ['Prodi', 'Target'],
                                                                ['BIE: 0', 0],
                                                                ['MEE: 0', 0],
                                                                ['BDB, 0', 0],
                                                                ['BCV: 1', 1],
                                                                ['BME: 1', 1],
                                                                ['BEE: 1', 1],
                                                                ['BIT: 2', 2],
                                                                ['BPH: 0', 0],
                                                                ['BMG: 0', 0],
                                                                ['DAC: 0', 0]

                                                            ]);
                                                            @elseif((isset($_GET['year']) && $_GET['year'] == '2023'))
                                                            var data = google.visualization.arrayToDataTable([
                                                                ['Prodi', 'Target'],
                                                                ['BIE: 0', 0],
                                                                ['MEE: 0', 0],
                                                                ['BDB: 0', 0],
                                                                ['BCV: 2', 2],
                                                                ['BME: 2', 2],
                                                                ['BEE: 1', 1],
                                                                ['BIT: 2', 2],
                                                                ['BPH: 0', 0],
                                                                ['BMG: 1', 1],
                                                                ['DAC: 0', 0]
                                                            ]);
                                                            @elseif((isset($_GET['year']) && $_GET['year'] == '2024'))
                                                            var data = google.visualization.arrayToDataTable([
                                                                ['Prodi', 'Target'],
                                                                ['BIE: 1', 1],
                                                                ['MEE: 0', 0],
                                                                ['BDB: 0', 0],
                                                                ['BCV: 2', 2],
                                                                ['BME: 2', 2],
                                                                ['BEE: 1', 1],
                                                                ['BIT: 2', 2],
                                                                ['BPH: 0', 0],
                                                                ['BMG: 1', 1],
                                                                ['DAC: 1', 1]
                                                            ]);
                                                            @else
                                                            var data = google.visualization.arrayToDataTable([
                                                                ['Prodi', 'Target'],
                                                                ['BIE: 0', 0],
                                                                ['MEE: 0', 0],
                                                                ['BDB: 0', 0],
                                                                ['BCV: 1', 1],
                                                                ['BME: 1', 1],
                                                                ['BEE: 1', 1],
                                                                ['BIT: 1', 1],
                                                                ['BPH: 0', 0],
                                                                ['BMG: 0', 0],
                                                                ['DAC: 0', 0]
                                                            ]);
                                                            @endif
                                                            var options = {
                                                                pieHole: 0.4,
                                                                sliceVisibilityThreshold: 0
                                                            };
                                                            var chart = new google.visualization.PieChart(document
                                                                .getElementById('donutchart'));
                                                            chart.draw(data, options);
                                                        }

                                                    </script>
                                                    <h5>TARGET KEGIATAN KEWIRAUSAHAAN BERSAMA ALUMNI DAN INDUSTRI</h5>
                                                    <div id="donutchart" style="min-height: 350px"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <h5>TARGET KEGIATAN TRI DHARMA BERTARAF INTERNASIONAL</h5>
                                                    <div id="chartContainer" style="min-height: 200px; width: 100%;">
                                                    </div>
                                                    <script>
                                                        //Better to construct options first and then pass it as a parameter
                                                        @if((isset($_GET['year']) && $_GET['year'] == '2021'))
                                                        var options = {
                                                            animationEnabled: true,
                                                            theme: "light2",
                                                            axisY2: {
                                                                prefix: "",
                                                                lineThickness: 0
                                                            },
                                                            toolTip: {
                                                                shared: true
                                                            },
                                                            legend: {
                                                                verticalAlign: "top",
                                                                horizontalAlign: "center"
                                                            },
                                                            data: [{
                                                                type: "stackedBar",
                                                                showInLegend: true,
                                                                name: "Jumlah Kegiatan",
                                                                color: "#102C57",
                                                                axisYType: "secondary",
                                                                dataPoints: [{
                                                                        y: 1,
                                                                        label: "BCV"
                                                                    },
                                                                    {
                                                                        y: 1,
                                                                        label: "BME"
                                                                    },
                                                                    {
                                                                        y: 1,
                                                                        label: "BEE"
                                                                    },
                                                                    {
                                                                        y: 1,
                                                                        label: "BIT"
                                                                    },
                                                                    {
                                                                        y: 0,
                                                                        label: "BIE"
                                                                    },
                                                                    {
                                                                        y: 0,
                                                                        label: "MEE"
                                                                    },
                                                                    {
                                                                        y: 0,
                                                                        label: "DAC"
                                                                    },
                                                                    {
                                                                        y: 1,
                                                                        label: "BMG"
                                                                    },
                                                                    {
                                                                        y: 0,
                                                                        label: "BDB"
                                                                    },
                                                                    {
                                                                        y: 1,
                                                                        label: "BPH"
                                                                    },
                                                                ]
                                                            }, ]
                                                        };
                                                        @elseif((isset($_GET['year']) && $_GET['year'] == '2022'))
                                                        var options = {
                                                            animationEnabled: true,
                                                            theme: "light2",
                                                            axisY2: {
                                                                prefix: "",
                                                                lineThickness: 0
                                                            },
                                                            toolTip: {
                                                                shared: true
                                                            },
                                                            legend: {
                                                                verticalAlign: "top",
                                                                horizontalAlign: "center"
                                                            },
                                                            data: [{
                                                                type: "stackedBar",
                                                                showInLegend: true,
                                                                name: "Jumlah Kegiatan",
                                                                color: "#102C57",
                                                                axisYType: "secondary",
                                                                dataPoints: [{
                                                                        y: 1,
                                                                        label: "BCV"
                                                                    },
                                                                    {
                                                                        y: 1,
                                                                        label: "BME"
                                                                    },
                                                                    {
                                                                        y: 1,
                                                                        label: "BEE"
                                                                    },
                                                                    {
                                                                        y: 1,
                                                                        label: "BIT"
                                                                    },
                                                                    {
                                                                        y: 1,
                                                                        label: "BIE"
                                                                    },
                                                                    {
                                                                        y: 1,
                                                                        label: "MEE"
                                                                    },
                                                                    {
                                                                        y: 1,
                                                                        label: "DAC"
                                                                    },
                                                                    {
                                                                        y: 1,
                                                                        label: "BMG"
                                                                    },
                                                                    {
                                                                        y: 1,
                                                                        label: "BDB"
                                                                    },
                                                                    {
                                                                        y: 1,
                                                                        label: "BPH"
                                                                    },
                                                                ]
                                                            }, ]
                                                        };
                                                        @elseif((isset($_GET['year']) && $_GET['year'] == '2023'))
                                                        var options = {
                                                            animationEnabled: true,
                                                            theme: "light2",
                                                            axisY2: {
                                                                prefix: "",
                                                                lineThickness: 0
                                                            },
                                                            toolTip: {
                                                                shared: true
                                                            },
                                                            legend: {
                                                                verticalAlign: "top",
                                                                horizontalAlign: "center"
                                                            },
                                                            data: [{
                                                                type: "stackedBar",
                                                                showInLegend: true,
                                                                name: "Jumlah Kegiatan",
                                                                color: "#102C57",
                                                                axisYType: "secondary",
                                                                dataPoints: [{
                                                                        y: 1,
                                                                        label: "BCV"
                                                                    },
                                                                    {
                                                                        y: 2,
                                                                        label: "BME"
                                                                    },
                                                                    {
                                                                        y: 2,
                                                                        label: "BEE"
                                                                    },
                                                                    {
                                                                        y: 1,
                                                                        label: "BIT"
                                                                    },
                                                                    {
                                                                        y: 1,
                                                                        label: "BIE"
                                                                    },
                                                                    {
                                                                        y: 1,
                                                                        label: "MEE"
                                                                    },
                                                                    {
                                                                        y: 1,
                                                                        label: "DAC"
                                                                    },
                                                                    {
                                                                        y: 1,
                                                                        label: "BMG"
                                                                    },
                                                                    {
                                                                        y: 2,
                                                                        label: "BDB"
                                                                    },
                                                                    {
                                                                        y: 2,
                                                                        label: "BPH"
                                                                    },
                                                                ]
                                                            }, ]
                                                        };
                                                        @elseif((isset($_GET['year']) && $_GET['year'] == '2024'))
                                                        var options = {
                                                            animationEnabled: true,
                                                            theme: "light2",
                                                            axisY2: {
                                                                prefix: "",
                                                                lineThickness: 0
                                                            },
                                                            toolTip: {
                                                                shared: true
                                                            },
                                                            legend: {
                                                                verticalAlign: "top",
                                                                horizontalAlign: "center"
                                                            },
                                                            data: [{
                                                                type: "stackedBar",
                                                                showInLegend: true,
                                                                name: "Jumlah Kegiatan",
                                                                color: "#102C57",
                                                                axisYType: "secondary",
                                                                dataPoints: [{
                                                                        y: 2,
                                                                        label: "BCV"
                                                                    },
                                                                    {
                                                                        y: 2,
                                                                        label: "BME"
                                                                    },
                                                                    {
                                                                        y: 2,
                                                                        label: "BEE"
                                                                    },
                                                                    {
                                                                        y: 2,
                                                                        label: "BIT"
                                                                    },
                                                                    {
                                                                        y: 1,
                                                                        label: "BIE"
                                                                    },
                                                                    {
                                                                        y: 2,
                                                                        label: "MEE"
                                                                    },
                                                                    {
                                                                        y: 1,
                                                                        label: "DAC"
                                                                    },
                                                                    {
                                                                        y: 2,
                                                                        label: "BMG"
                                                                    },
                                                                    {
                                                                        y: 2,
                                                                        label: "BDB"
                                                                    },
                                                                    {
                                                                        y: 2,
                                                                        label: "BPH"
                                                                    },
                                                                ]
                                                            }, ]
                                                        };
                                                        @else
                                                        var options = {
                                                            animationEnabled: true,
                                                            theme: "light2",
                                                            axisY2: {
                                                                prefix: "",
                                                                lineThickness: 0
                                                            },
                                                            toolTip: {
                                                                shared: true
                                                            },
                                                            legend: {
                                                                verticalAlign: "top",
                                                                horizontalAlign: "center"
                                                            },
                                                            data: [{
                                                                type: "stackedBar",
                                                                showInLegend: true,
                                                                name: "Jumlah Kegiatan",
                                                                color: "#102C57",
                                                                axisYType: "secondary",
                                                                dataPoints: [{
                                                                        y: 0,
                                                                        label: "BCV"
                                                                    },
                                                                    {
                                                                        y: 1,
                                                                        label: "BME"
                                                                    },
                                                                    {
                                                                        y: 1,
                                                                        label: "BEE"
                                                                    },
                                                                    {
                                                                        y: 0,
                                                                        label: "BIT"
                                                                    },
                                                                    {
                                                                        y: 0,
                                                                        label: "BIE"
                                                                    },
                                                                    {
                                                                        y: 0,
                                                                        label: "MEE"
                                                                    },
                                                                    {
                                                                        y: 0,
                                                                        label: "DAC"
                                                                    },
                                                                    {
                                                                        y: 1,
                                                                        label: "BMG"
                                                                    },
                                                                    {
                                                                        y: 0,
                                                                        label: "BDB"
                                                                    },
                                                                    {
                                                                        y: 0,
                                                                        label: "BPH"
                                                                    },
                                                                ]
                                                            }, ]
                                                        };
                                                        @endif
                                                        $("#chartContainer").CanvasJSChart(options);

                                                    </script>
                                                    <div class="p-4">
                                                        <table class="table table-sm p-1" cellspacing="0" width="100%"
                                                            cellpadding="7px" style="text-align: center;">
                                                            <tr>
                                                                <td>Kegiatan</td>
                                                                <td>BCV</td>
                                                                <td>BME</td>
                                                                <td>BEE</td>
                                                                <td>BIT</td>
                                                                <td>BIE</td>
                                                                <td>MEE</td>
                                                                <td>DAC</td>
                                                                <td>BMG</td>
                                                                <td>BDB</td>
                                                                <td>BPH</td>
                                                            </tr>
                                                            @if ((isset($_GET['year']) && $_GET['year'] == '2021'))
                                                            <tr>
                                                                <td>Jumlah</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>0</td>
                                                                <td>0</td>
                                                                <td>0</td>
                                                                <td>1</td>
                                                                <td>0</td>
                                                                <td>1</td>
                                                            </tr>
                                                            @elseif ((isset($_GET['year']) && $_GET['year'] == '2022'))
                                                            <tr>
                                                                <td>Jumlah</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                            </tr>
                                                            @elseif ((isset($_GET['year']) && $_GET['year'] == '2023'))
                                                            <tr>
                                                                <td>Jumlah</td>
                                                                <td>1</td>
                                                                <td>2</td>
                                                                <td>2</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>2</td>
                                                                <td>2</td>
                                                            </tr>
                                                            @elseif ((isset($_GET['year']) && $_GET['year'] == '2024'))
                                                            <tr>
                                                                <td>Jumlah</td>
                                                                <td>2</td>
                                                                <td>2</td>
                                                                <td>2</td>
                                                                <td>2</td>
                                                                <td>1</td>
                                                                <td>2</td>
                                                                <td>1</td>
                                                                <td>2</td>
                                                                <td>2</td>
                                                                <td>2</td>
                                                            </tr>
                                                            @else
                                                            <tr>
                                                                <td>Jumlah</td>
                                                                <td>0</td>
                                                                <td>1</td>
                                                                <td>1</td>
                                                                <td>0</td>
                                                                <td>0</td>
                                                                <td>0</td>
                                                                <td>0</td>
                                                                <td>1</td>
                                                                <td>0</td>
                                                                <td>0</td>
                                                            </tr>
                                                            @endif
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- end chart --}}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="section-space bg-secondary py-1">
            <hr>
            Copyright © {{ (date('Y')=="2022"?date('Y'):"2022-".date('Y')) }} made with ❤️ by <a
                href="https://itic.jgu.ac.id">ITIC JGU</a>.<br><small
                class="ml-4 text-center text-sm text-light sm:text-right sm:ml-0">
                v{{ Illuminate\Foundation\Application::VERSION }}p{{ PHP_VERSION }} - All rights reserved.</small>
        </footer>
    </div>
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- scrollbar js-->
    <!-- Sidebar jquery-->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <!-- Plugins JS start-->
    @yield('script')

    @if (Route::current()->getName() != 'popover')
    <script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
    @endif

    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('assets/js/chart/apex-chart/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/script2.js') }}"></script>
</body>

</html>
