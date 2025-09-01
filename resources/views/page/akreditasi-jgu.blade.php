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
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatable-extension.css')}}">
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

        .table-sm th,
        .table-sm td {
            padding: 0px;
        }

    </style>
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
                                <h1 class="wow fadeIn"> Akreditasi JGU</h1>
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
                                <h2>Hasil Akreditasi</h2>
                            </div>
                            <p>Universitas Global Jakarta</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row component_responsive">
                <div class="col-sm-12">
                    <div class="col-md-12 project-list">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-9">
                                    
                                </div>
                                <div class="col-md-3 d-flex justify-content-center justify-content-md-end">
                                    <select id="Select_1" class="form-control input-sm select2"
                                        data-placeholder="Filter Akreditasi">
                                        <option value="">Filter Akreditasi</option>
                                        @foreach($data as $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="">
                                    <table class="table table-hover table-sm" id="datatable" width="100%">
                                        <thead>
                                            <tr>
                                                <th scope="col" width="20px">No</th>
                                                <th scope="col" width="150px">Jenjang</th>
                                                <th scope="col">Nama Program Studi</th>
                                                <th scope="col" width="150px">Akreditasi</th>
                                                <th scope="col" width="150px">Sertifikat</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <a target="_blank" class="text-warning"
                                href="https://pddikti.kemdiktisaintek.go.id/detail-pt/rmH47ZZz3naFFC_pmQtUsNWpLmr-JDm672pSadjCG8eZJFhKVWVHtsf3ZE9EwsHSjWPBKA==">Klik
                                disini untuk informasi akreditasi di halaman PDDIKTI</a>
                            <br>
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
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
    <script>
        "use strict";
        setTimeout(function () {
            (function ($) {
                "use strict";
                $(".select2").select2({
                    allowClear: true,
                    minimumResultsForSearch: 7
                });
            })(jQuery);
        }, 350);

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            var table = $('#datatable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ordering: false,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '_INPUT_ &nbsp;',
                    lengthMenu: '<span>Show:</span> _MENU_',
                },
                ajax: {
                    url: "{{ route('api.study_program') }}",
                    data: function (d) {
                        d.acreditation = $('#Select_1').val(),
                            d.search = $('input[type="search"]').val()
                    },
                },
                columns: [{
                        render: function (data, type, row, meta) {
                            var no = (meta.row + meta.settings._iDisplayStart + 1);
                            return no;
                        },
                        orderable: false,
                        className: "text-center"
                    },

                    {
                        render: function (data, type, row, meta) {
                            var x = row.degree_level;
                            return x;
                        },
                        className: "text-center"
                    },
                    {
                        render: function (data, type, row, meta) {
                            var x = row.name;
                            return x;
                        },
                        className: "dt-left"
                    },

                    {
                        render: function (data, type, row, meta) {
                            if (row.acreditation_id != null) {
                                var x = '<code title="' + row.acreditation['star_point'] +
                                    '">' + row.acreditation['name'] + '</code>';
                            } else {
                                var x = "";
                            }
                            return x;
                        },
                        className: "text-center"
                    },
                    {
                        render: function (data, type, row, meta) {
                            if (row.certificate != null) {
                                var x = '<a href="' + row.certificate +
                                    '" target="_blank"><span class="badge rounded-pill badge-success">Download</span></a>';
                            } else {
                                var x =
                                    '<span class="badge rounded-pill badge-light">not found</span>';
                            }
                            return x;
                        },
                        className: "text-center"
                    }
                ]
            });
            $('#Select_1').change(function () {
                table.draw();
            });
        });

    </script>
</body>

</html>
