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
                            id="sidebar-menu"><a class="navbar-brand p-0" href="{{ route('home') }}"><img
                                    class="img-fluid" src="{{ asset('assets/images/logo-white.png') }}" alt="JGU"></a>
                            <button class="navbar-toggler navabr_btn-set custom_nav" type="button"
                                data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault"
                                aria-expanded="false"
                                aria-label="Toggle navigation"><span></span><span></span><span></span></button>
                            <div class="navbar-collapse justify-content-end collapse hidenav" id="navbarDefault">
                                <ul class="navbar-nav navbar_nav_modify" id="scroll-spy">
                                    <li class="nav-item"><a class="nav-link px-3" href="#"
                                            style="text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;">
                                            <i class="icofont icofont-ui-home"></i> Home</a></li>
                                    <li class="nav-item">
                                        <div class=" dropup dropdown-basic">
                                            <div class="dropup dropdown">
                                                <a class="nav-link px-3" href="#"
                                                    style="text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;">
                                                    <i class="icofont icofont-ui-user"></i> Tentang</a>
                                                <div class="dropup-content dropdown-content">
                                                    <a href="#about-us">Tentang</a>
                                                    <a href="#vision-and-mission">Visi & Misi</a>
                                                    <a href="#org-structure">Struktur Org.</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <div class=" dropup dropdown-basic">
                                            <div class="dropup dropdown">
                                                <a class="nav-link px-3" href="#"
                                                    style="text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;">
                                                    <i class="icofont icofont-trophy"></i>
                                                    Akreditasi</a>
                                                <div class="dropup-content dropdown-content">
                                                    <a href="#instruments">SPMI</a>
                                                    <a href="#results">Hasil</a>
                                                    <a href="{{ route('target-renstra') }}#results">Target Renstra</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item"><a class="nav-link px-3" href="#publication"
                                            style="text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;">
                                            <i class="icofont icofont-newspaper"></i> Publikasi</a></li>
                                    <li class="nav-item"><a class="nav-link px-3" href="#contact"
                                            style="text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;">
                                            <i class="icofont icofont-ui-head-phone"></i> Kontak</a></li>
                                    <li class="nav-item">
                                        <div class="dropup dropdown-basic">
                                            <div class="dropup dropdown">
                                                <a class="nav-link dropbtn btn-primary px-3" href="#"><i
                                                        class="fa fa-th"></i> Aplikasi</a>
                                                <div class="dropup-content dropdown-content">
                                                    @if (Route::has('login'))
                                                    @auth
                                                    <a href="{{ url('/dashboard') }}"
                                                        class="text-sm text-gray-700 dark:text-gray-500 underline">Peer
                                                        Observation</a>
                                                    @else
                                                    <a href="{{ route('login') }}"
                                                        class="text-sm text-gray-700 dark:text-gray-500 underline">Peer
                                                        Observation</a>
                                                    @endauth
                                                    @endif
                                                    <a href="https://siap.jgu.ac.id/" target="_blank">Smart Integrated
                                                        Academic Portal</a>
                                                    <a href="https://edlink.id/login" target="_blank">Edlink</a>
                                                    <a href="https://cbt.jgu.ac.id/" target="_blank">Computer Based
                                                        Test</a>
                                                    <a href="https://apps.jgu.ac.id/" target="_blank">JGU APPS</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </header>
                </div>

                <!-- EDIT HOME MULAI DARI SINI -->

                <div class="row">
                    <div class="col-xl-5 col-lg-6">
                        <div class="content ">
                            <div class="container">
                                <h1 class="wow fadeIn">Lembaga </h1>
                                <h1 class="wow fadeIn">Penjaminan Mutu (LPM)</h1>
                                <h2 class="txt-secondary wow fadeIn">Quality Assurance & Control</h2>
                                <p class="mt-3 wow fadeIn">Jakarta Global University
                                </p>
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
        <!-- ABOUT US -->
        <section class="section-space cuba-demo-section layout" id="about-us">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 wow pulse">
                        <div class="cuba-demo-content">
                            <div class="couting">
                                <h2>Tentang</h2>
                                <div class="media-body mt-3 mb-3"><i>
                                        LPM adalah singkatan dari Lembaga Penjaminan Mutu, sebuah unit kerja di JGU yang
                                        bertugas untuk memastikan dan meningkatkan kualitas pendidikan.
                                        LPM bekerja dengan merencanakan, melaksanakan, memonitor, mengevaluasi, dan
                                        mengembangkan sistem penjaminan mutu internal (SPMI) dan eksternal (SPME) di
                                        kampus,
                                        serta melakukan audit mutu untuk mencapai standar pendidikan tinggi yang
                                        ditetapkan.
                                    </i>
                                </div>
                            </div>
                            <div class="media-body text-center">
                                <p>Tujuan</p>
                                <div class="media">
                                    <div class="activity-dot-primary mx-2 d-none d-lg-block"></div>
                                    Terwujudnya sistem penjaminan mutu internal di lingkungan JGU yang meliputi
                                    penetapan standar, pelaksanaan, evaluasi, peningkatan, dan pengendalian standar.
                                </div>
                                </br>
                                <div class="media">
                                    <div class="activity-dot-primary mx-2 d-none d-lg-block"></div>
                                    Menjamin terlaksananya pelayanan dan pelatihan penjaminan mutu internal dan
                                    eksternal pada semua unit di lingkungan JGU.
                                </div>
                                </br>
                                <div class="media">
                                    <div class="activity-dot-primary mx-2 d-none d-lg-block"></div>
                                    Terbentuknya budaya mutu bagi civitas akademika dan tenaga kependidikan di
                                    lingkungan JGU.
                                </div>
                                </br>
                                <div class="media">
                                    <div class="activity-dot-primary mx-2 d-none d-lg-block"></div>
                                    Mempermudah akses data perguruan tinggi yang terintegrasi bagi semua unit di
                                    lingkungan JGU.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-space bg-Widget pb-0 bg-primary pb-5" id="vision-and-mission">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 wow pulse">
                        <div class="cuba-demo-content mt50">
                            <div class="couting text-secondary">
                                <h2>Visi & Misi</h2>
                            </div>
                        </div>
                        <div class="media-body"></div>
                        <h3>Visi</h3>
                        <div class="card-body new-update pt-0">
                            <div class="activity-timeline">
                                <div class="media">
                                    <div class="media-body"><i>Menjadikan Lembaga Penjaminan Mutu JGU sebagai pelopor
                                            dalam menerapkan sistem dan budaya mutu tridharma perguruan tinggi yang
                                            dapat mengantarkan JGU menjadi institusi unggul dalam bidang teknologi dan
                                            Kesehatan.
                                        </i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-left">
                        <h3>Misi</h3>
                        <div class="media">
                            <div class="activity-dot-dark mx-2 d-none d-lg-block"></div>
                            <div class="media"><span>Menyusun, menerapkan, dan melakukan perbaikan secara
                                    berkelanjutan terhadap Sistem Penjaminan Mutu Internal (SPMI).</span>
                            </div>
                        </div>
                        <div class="media">
                            <div class="activity-dot-dark mx-2 d-none d-lg-block"></div>
                            <div class="media"><span>Membangun dan mengembangkan pelayanan dan pelatihan sistem
                                    penjaminan mutu internal dan eksternal pada semua unit di lingkungan JGU.
                                </span>
                            </div>
                        </div>
                        <div class="media">
                            <div class="activity-dot-dark mx-2 d-none d-lg-block"></div>
                            <div class="media"><span>Mendorong terbentuknya budaya mutu tridharma perguruan tinggi
                                    bagi civitas akademika dan tenaga kependidikan di lingkungan JGU.</span>
                            </div>
                        </div>
                        <div class="media">
                            <div class="activity-dot-dark mx-2 d-none d-lg-block"></div>
                            <div class="media"><span>Membangun pangkalan data perguruan tinggi JGU yang
                                    terintegrasi untuk semua unit di lingkungan JGU.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-space cuba-demo-section email_bg" id="org-structure">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 wow pulse">
                        <div class="cuba-demo-content email-txt text-start">
                            <div class="couting">
                                <h2>Struktur</h2>
                                <p>Organisasi LPM</p>
                                <ul class="landing-ul">
                                    <li>Rektor</li>
                                    <li>Kepala Lembaga</li>
                                    <li>Ketua Bidang Penjamin Mutu Internal</li>
                                    <li>Ketua Bidang Pengembangan Dan Dokumentasi Mutu</li>
                                    <li>Ketua Bidang Penjamin Mutu Eksternal</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 wow pulse text-center">
                        <a href="{{ asset('assets/images/dashboard/struktur.png') }}" target="_blank">
                            <img class="img-fluid" src="{{ asset('assets/images/dashboard/struktur.png') }}">
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="footer-bg" id="instruments">
            <div class="container">
                <div class="landing-center ptb50">
                    <div class="title">
                        <h2>Sistem Penjaminan Mutu Internal</h2>
                        <h3>(SPMI)</h3>
                    </div>
                    <div class="footer-content">
                        <h6>Bagi Perguruan Tinggi/Ketua Program Studi yang ingin mengunduh<br>Sistem Penjaminan Mutu
                            Internal (SPMI)<br>Jakarta Global University</h6>
                        <h6>silahkan klik tautan berikut :</h6>
                        @if($LINKINSTRUMENT != null || $LINKINSTRUMENT != "")
                        <a class="btn mrl5 btn-lg btn-secondary default-view" target="_blank"
                            href="{{ $LINKINSTRUMENT->content }}">{{ $LINKINSTRUMENT->title }}</a>
                        @endif
                        @if($LINKINSTRUMENT2 != null || $LINKINSTRUMENT2 != "")
                        <a class="btn mrl5 btn-lg btn-secondary default-view" target="_blank"
                            href="{{ $LINKINSTRUMENT2->content }}">{{ $LINKINSTRUMENT2->title }}</a>
                        @endif
                        @if($LINKINSTRUMENT3 != null || $LINKINSTRUMENT3 != "")
                        <a class="btn mrl5 btn-lg btn-secondary default-view" target="_blank"
                            href="{{ $LINKINSTRUMENT3->content }}">{{ $LINKINSTRUMENT3->title }}</a>
                        @endif
                        @if($LINKINSTRUMENT4 != null || $LINKINSTRUMENT4 != "")
                        <a class="btn mrl5 btn-lg btn-secondary default-view" target="_blank"
                            href="{{ $LINKINSTRUMENT4->content }}">{{ $LINKINSTRUMENT4->title }}</a>
                        @endif
                        @if($LINKINSTRUMENT5 != null || $LINKINSTRUMENT5 != "")
                        <a class="btn mrl5 btn-lg btn-secondary default-view" target="_blank"
                            href="{{ $LINKINSTRUMENT5->content }}">{{ $LINKINSTRUMENT5->title }}</a>
                        @endif
                        @if($LINKINSTRUMENT6 != null || $LINKINSTRUMENT6 != "")
                        <a class="btn mrl5 btn-lg btn-secondary default-view" target="_blank"
                            href="{{ $LINKINSTRUMENT6->content }}">{{ $LINKINSTRUMENT6->title }}</a>
                        @endif
                        @if($LINKINSTRUMENT7 != null || $LINKINSTRUMENT7 != "")
                        <a class="btn mrl5 btn-lg btn-secondary default-view" target="_blank"
                            href="{{ $LINKINSTRUMENT7->content }}">{{ $LINKINSTRUMENT7->title }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <section class="section-space cuba-demo-section components-section" id="results">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 wow pulse">
                        <div class="cuba-demo-content mt50">
                            <div class="couting">
                                <h2>Hasil</h2>
                            </div>
                            <p>Akreditasi Program Studi</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container container-modify">
                <div class="row component_responsive justify-content-md-center">
                    @foreach($study_program as $index => $sp)
                    <div class="col-xl-2 col-md-4 col-6 component-col-set">
                        <a href="{{$sp->certificate}}" title="Klik untuk melihat sertifikat" target="_blank">
                            <div class="component-hover-effect">
                                @for($i = 1; $i <= $sp->acreditation->star_point; $i++)
                                    <i class="fa fa-spin fa-star h2 text-warning"></i>
                                    @endfor
                                    @for($i = 1; $i <= (3-$sp->acreditation->star_point); $i++)
                                        <i class="fa fa-spin fa-star-o  h2 text-warning"></i>
                                        @endfor
                                        <h6 class="m-0">{{$sp->acreditation->name}}</h6>
                                        <p>{{$sp->degree_level}} {{$sp->name}}</p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    <a target="_blank" class="text-warning" href="{{ route('akreditasi') }}#results">Klik disini untuk
                        download Sertifikat Akreditasi</a>
                </div>
            </div>
        </section>

        <section class="section-space email_bg" id="publication">
            <div class="container container-modify">
                <div class="row">
                    <div class="col-lg-5 wow pulse">
                        <div class="cuba-demo-content email-txt text-start">
                            <div class="couting">
                                <h2>Dokumen Publikasi</h2>
                                <i>Lembaga Penjaminan Mutu (LPM) Jakarta Global University berkomitmen menghadirkan
                                    transparansi dan peningkatan mutu berkelanjutan. Melalui laman ini, kami menyediakan
                                    hasil survei kepuasan, laporan Audit Mutu Internal (AMI), serta dokumen mutu dan
                                    pedoman lainnya yang menjadi acuan seluruh unit kerja.<br><br>
                                    Publikasi ini diharapkan dapat menjadi sumber informasi yang akurat bagi sivitas
                                    akademika sekaligus mendorong terciptanya budaya mutu di lingkungan universitas.</i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                            <table class="table table-hover table-sm" id="datatablex" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col" width="20px">No</th>
                                        <th scope="col">Publikasi</th>
                                        <th scope="col" width="150px">Tahun Terbit</th>
                                        <th scope="col" width="150px">Dokumen</th>
                                    </tr>
                                </thead>
                            </table>
                    </div>
                </div>
            </div>
        </section>

        <footer class="section-space cuba-demo-section  pb-0 bg-secondary" id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 wow pulse">
                        <div class="cuba-demo-content mt50">
                            <div class="couting">
                                <h2>Kontak</h2>
                            </div>
                            <div class="footer_bottom-item footer_social-media penci-col-3">
                                <div class="block-title mb-4"><br><span>Butuh bantuan? silahkan hubungi
                                        LPM<br>{{ $CONTACT->title }} : {{ $CONTACT->content }}</span></div>
                                <a class="social-media-item socail_media_facebook mx-3" target="_blank"
                                    href="https://www.facebook.com/jakartaglobaluniversity" title="Facebook"
                                    rel="noopener"><span class="socail-media-itemcontent"><i
                                            class="fa fa-facebook"></i><span class="social_title screen-reader-text">
                                            Facebook</span></span></a>
                                <a class="social-media-item socail_mediainstagram mx-3" target="_blank"
                                    href="https://www.instagram.com/jg_university/" title="Instagram"
                                    rel="noopener"><span class="socail-media-itemcontent"><i
                                            class="fa fa-instagram"></i><span class="social_title screen-reader-text">
                                            Instagram</span></span>
                                </a>
                                <a class="social-media-item socail_mediayoutube mx-3" target="_blank"
                                    href="https://www.youtube.com/channel/UCoU56BRZyVCaDJiSI2TpR0g" title="Youtube"
                                    rel="noopener"><span class="socail-media-itemcontent"><i
                                            class="fa fa-youtube-play"></i><span
                                            class="social_title screen-reader-text"> Youtube</span></span>
                                </a>
                                <a class="social-media-item socail_mediatwitter mx-3" target="_blank"
                                    href="https://twitter.com/jg_university" title="Twitter" rel="noopener"><span
                                        class="socail-media-itemcontent"><i class="fa fa-twitter"></i><span
                                            class="social_title screen-reader-text"> Twitter</span></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-lg-6 wow pulse footer-inner" style="text-align: justify;">
                        <h3><i><b>Mengubah Hidup,</b><br>
                                <b>Memperkaya Masa Depan!</b><br><br></i></h3>
                        <img class="img-fluid" src="{{ asset('assets/images/logo-white.png') }}" alt="JGU"
                            width="230px"><br><br>
                        <b>Kampus Jakarta Global University</b>
                        <br>
                        Grand Depok City, Jl. Boulevard Raya No.2 Kota Depok<br>
                        16412, Jawa Barat Indonesia
                        <br>Telp. (+62) 21-7781-7710
                        <br>
                        <br>
                        <br>
                        <br>
                    </div>
                    <div class="col-sm-12 col-lg-6 mb-3">
                        <iframe
                            src="https://maps.google.com/maps?q=Jakarta%20Global%20University%2C%20Jalan%20Boulevard%20Grand%20Depok%20City%2C%20Tirtajaya%2C%20Depok%20City%2C%20West%20Java%2C%20Indonesia&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
                            width="100%" height="350px" frameborder="0">
                        </iframe>
                    </div>
                </div>
            </div>
        </footer>
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

    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var table = $('#datatablex').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ordering: false,
                language: {
                    searchPlaceholder: 'Cari dokumen...',
                    sSearch: '_INPUT_ &nbsp;',
                    lengthMenu: '<span>Show:</span> _MENU_',
                },
                lengthMenu: [
                    [5, 10, 100],
                    [5, 10, 100],
                ],
                ajax: {
                    url: "{{ route('api.publication') }}",
                    data: function (d) {
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
                            var x = row.title;
                            return x;
                        },
                        className: "dt-left"
                    },

                    {
                        render: function (data, type, row, meta) {
                            if (row.year != null) {
                                var x = '<code title="diterbitkan pada ' + row.year +
                                    '">' + row.year + '</code>';
                            } else {
                                var x = "";
                            }
                            return x;
                        },
                        className: "text-center"
                    },
                    {
                        render: function (data, type, row, meta) {
                            if (row.doc_link != null) {
                                var x = '<a href="' + row.doc_link +
                                    '" target="_blank"><span class="badge rounded-pill badge-success">Lihat</span></a>';
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
        });

    </script>
</body>

</html>
