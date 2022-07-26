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
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <title>{{ config('app.name') }} - Lembaga Penjamin Mutu</title>
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
                <li class="one"><img class="img-fluid" src="{{ asset('assets/images/landing/decore/1.png') }}"
                        alt="">
                </li>
                <li class="two"><img class="img-fluid" src="{{ asset('assets/images/landing/decore/2.png') }}"
                        alt="">
                </li>
                <li class="three"><img class="img-fluid" src="{{ asset('assets/images/landing/decore/4.png') }}"
                        alt="">
                </li>
                <li class="four"><img class="img-fluid" src="{{ asset('assets/images/landing/decore/3.png') }}"
                        alt="">
                </li>
                <li class="five"><img class="img-fluid" src="{{ asset('assets/images/landing/2.png') }}"
                        alt=""></li>
                <li class="six"><img class="img-fluid" src="{{ asset('assets/images/landing/decore/cloud.png') }}"
                        alt=""></li>
                <li class="seven"><img class="img-fluid" src="{{ asset('assets/images/landing/2.png') }}"
                        alt="">
                </li>
            </ul>
            <div class="container-fluid">
                <div class="sticky-header">
                    <header>
                        <nav class="navbar navbar-b navbar-trans navbar-expand-xl fixed-top nav-padding"
                            id="sidebar-menu"><a class="navbar-brand p-0" href="{{ route('home') }}"><img
                                    class="img-fluid" src="{{ asset('assets/images/logo.png') }}" alt=""></a>
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
                                                    <a href="#instruments">Instrumen</a>
                                                    <a href="#results">Hasil</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
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
                                                    <!-- <a href="https://lpm.jgu.ac.id/old">PO-Old</a>
                                                    <a href="#">Coming soon..</a> -->
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
                        <div class="content">
                            <div>
                                <h1 class="wow fadeIn">Lembaga </h1>
                                <h1 class="wow fadeIn">Penjamin Mutu (LPM)</h1>
                                <h2 class="txt-secondary wow fadeIn">Quality Assurance & Control</h2>
                                <p class="mt-3 wow fadeIn">Jakarta Global University
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-7 col-lg-6">
                        <div class="wow fadeIn"><img class="screen2"
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
                            </div>
                            <div class="media-body text-center">
                                <p>Tujuan</p>
                                <div class="media">
                                    <div class="activity-dot-primary mx-2"></div>
                                    Terwujudnya sistem penjaminan mutu internal di lingkungan JGU yang meliputi
                                    penetapan standar, pelaksanaan, evaluasi, peningkatan, dan pengendalian standar.
                                </div>
                                </br>
                                <div class="media">
                                    <div class="activity-dot-primary mx-2"></div>
                                    Menjamin terlaksananya pelayanan dan pelatihan penjaminan mutu internal dan
                                    eksternal pada semua unit di lingkungan JGU.
                                </div>
                                </br>
                                <div class="media">
                                    <div class="activity-dot-primary mx-2"></div>
                                    Terbentuknya budaya mutu bagi civitas akademika dan tenaga kependidikan di
                                    lingkungan JGU.
                                </div>
                                </br>
                                <div class="media">
                                    <div class="activity-dot-primary mx-2"></div>
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
                            <div class="activity-dot-dark mx-2"></div>
                            <div class="media"><span>Menyusun, menerapkan, dan melakukan perbaikan secara
                                    berkelanjutan terhadap Sistem Penjaminan Mutu Internal (SPMI)..</span>
                            </div>
                        </div>
                        <div class="media">
                            <div class="activity-dot-dark mx-2"></div>
                            <div class="media"><span>Membangun dan mengembangkan pelayanan dan pelatihan sistem
                                    penjaminan mutu internal dan eksternal pada semua unit di lingkungan JGU.
                                </span>
                            </div>
                        </div>
                        <div class="media">
                            <div class="activity-dot-dark mx-2"></div>
                            <div class="media"><span>Mendorong terbentuknya budaya mutu tridharma perguruan tinggi
                                    bagi civitas akademika dan tenaga kependidikan di lingkungan JGU.</span>
                            </div>
                        </div>
                        <div class="media">
                            <div class="activity-dot-dark mx-2"></div>
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
                                    <li>Ketua Bidang Penjamin Mutu Ekstrnal</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 wow pulse"><a href=""><img class="img-fluid"
                                src="{{ asset('assets/images/dashboard/struktur.png') }}"
                                alt=""></a></div>
                </div>
            </div>
        </section>

        <section class="footer-bg" id="instruments">
            <div class="container">
                <div class="landing-center ptb50">
                    <div class="title">
                        <h2>Instrumen</h2>
                        <p>Instrumen Akreditasi </p>
                    </div>
                    <div class="footer-content">
                        <h1>Bagi Perguruan Tinggi/Ketua Program Studi Yang Ingin Download Instrumen Akreditasi,</h1>
                        <h1>silahkan klik link berikut :</h1>
                        <a class="btn mrl5 btn-lg btn-secondary default-view" target="_blank"
                            href="https://www.banpt.or.id/wp-content/uploads/2019/10/Lampiran-5-PerBAN-PT-5-2019-tentang-IAPS-Pedoman-Penilaian.pdf">Klik Disini</a>
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
                <div class="row component_responsive">

                
                    <div class="col-xl-2 col-md-4 col-6 component-col-set">
                        <div class="component-hover-effect">
                            <i class="fa fa-spin fa-star h2 text-warning"></i>
                            <i class="fa fa-spin fa-star h2 text-warning"></i>
                            <i class="fa fa-spin fa-star-o  h2 text-warning"></i>
                            <h6 class="m-0">B</h6>
                            <p>S1 Manajemen</p>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6 component-col-set">
                        <div class="component-hover-effect">
                            <i class="fa fa-spin fa-star h2 text-warning"></i>
                            <i class="fa fa-spin fa-star h2 text-warning"></i>
                            <i class="fa fa-spin fa-star-o  h2 text-warning"></i>
                            <h6 class="m-0">B</h6>
                            <p>S1 Teknik Elektro</p>
                        </div>
                    </div>

                    <div class="col-xl-2 col-md-4 col-6 component-col-set">
                        <div class="component-hover-effect">
                            <i class="fa fa-spin fa-star h2 text-warning"></i>
                            <i class="fa fa-spin fa-star h2 text-warning"></i>
                            <i class="fa fa-spin fa-star-o  h2 text-warning"></i>
                            <h6 class="m-0">B</h6>
                            <p>S1 Teknik Mesin</p>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6 component-col-set">
                        <div class="component-hover-effect">
                            <i class="fa fa-spin fa-star h2 text-warning"></i>
                            <i class="fa fa-spin fa-star h2 text-warning"></i>
                            <i class="fa fa-spin fa-star-o  h2 text-warning"></i>
                            <h6 class="m-0">B</h6>
                            <p>S1 Teknik Sipil</p>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6 component-col-set">
                        <div class="component-hover-effect">
                            <i class="fa fa-spin fa-star h2 text-warning"></i>
                            <i class="fa fa-spin fa-star-o  h2 text-warning"></i>
                            <i class="fa fa-spin fa-star-o  h2 text-warning"></i>
                            <h6 class="m-0">Baik</h6>
                            <p>S1 Bisnis Digital</p>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6 component-col-set">
                        <div class="component-hover-effect">
                            <i class="fa fa-spin fa-star h2 text-warning"></i>
                            <i class="fa fa-spin fa-star-o  h2 text-warning"></i>
                            <i class="fa fa-spin fa-star-o  h2 text-warning"></i>
                            <h6 class="m-0">Baik</h6>
                            <p>S1 Farmasi</p>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6 component-col-set">
                        <div class="component-hover-effect">
                            <i class="fa fa-spin fa-star h2 text-warning"></i>
                            <i class="fa fa-spin fa-star-o  h2 text-warning"></i>
                            <i class="fa fa-spin fa-star-o  h2 text-warning"></i>
                            <h6 class="m-0">Baik</h6>
                            <p>S1 Teknik Industri</p>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6 component-col-set">
                        <div class="component-hover-effect">
                            <i class="fa fa-spin fa-star h2 text-warning"></i>
                            <i class="fa fa-spin fa-star-o  h2 text-warning"></i>
                            <i class="fa fa-spin fa-star-o  h2 text-warning"></i>
                            <h6 class="m-0">Baik</h6>
                            <p>S1 Teknik Informatika</p>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6 component-col-set">
                        <div class="component-hover-effect">
                            <i class="fa fa-spin fa-star h2 text-warning"></i>
                            <i class="fa fa-spin fa-star-o  h2 text-warning"></i>
                            <i class="fa fa-spin fa-star-o  h2 text-warning"></i>
                            <h6 class="m-0">Baik</h6>
                            <p>S2 Teknik Elektro</p>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6 component-col-set">
                        <div class="component-hover-effect">
                            <i class="fa fa-spin fa-star h2 text-warning"></i>
                            <i class="fa fa-spin fa-star-o  h2 text-warning"></i>
                            <i class="fa fa-spin fa-star-o  h2 text-warning"></i>
                            <h6 class="m-0">C</h6>
                            <p>D3 Akuntansi</p>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6 component-col-set">
                        <div class="component-hover-effect">
                            <i class="fa fa-spin fa-star h2 text-warning"></i>
                            <i class="fa fa-spin fa-star-o  h2 text-warning"></i>
                            <i class="fa fa-spin fa-star-o  h2 text-warning"></i>
                            <h6 class="m-0">C</h6>
                            <p>D3 Mnj. Pemasaran</p>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6 component-col-set" title="Program ditupup sementara">
                        <div class="component-hover-effect">
                            <i class="fa fa-spin fa-star-o  h2 text-warning"></i>
                            <i class="fa fa-spin fa-star-o  h2 text-warning"></i>
                            <i class="fa fa-spin fa-star-o  h2 text-warning"></i>
                            <h6 class="m-0">-</h6>
                            <p>S1 Sistem Infomasi<i class="text-danger">*</i></p>
                        </div>
                    </div>

                    <a target="_blank" class="text-warning"
                        href="https://pddikti.kemdikbud.go.id/data_pt/QUEzRUM1NjktQjI0NS00ODA3LTlGMkYtOERDRkNGMUI2MkNC">Klik
                        disini untuk Informasi Lebih Lanjut</a>

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
                                <div class="block-title mb-4"><span>Ikuti Sosial Media</span></div>
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
                        <i><b>Mengubah Hidup,</b><br>
                            <b>Memperkaya Masa Depan!</b><br><br></i>
                        <b>Kampus Utama</b>
                        <br>
                        Grand Depok City, Jl. Boulevard Raya No.2 Kota Depok<br>
                        16412, Jawa Barat Indonesia
                        <br>
                        <br>
                        <b>Kampus A</b>
                        <br>
                        Jl. Jatiwaringin Raya No. 278 Pondok Gede 17411, Jakarta
                        <br>
                        Telp: 021-846-1155 <br> Fax: 021-846-3692
                        <br>
                        <br>
                        <b>Kampus B</b>
                        <br>
                        Jl. Inspeksi Kalimalang No.204-205, Cibuntu, Kec. Cibitung,
                        Bekasi,<br>Jawa Barat 17520
                        <br>
                        Telp : 021-8837-5585
                        <br>
                        Fax : 021-8837-5587
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
            Copyright ©2022 ITIC JGU. All rights reserved.
        </footer>
    </div>
    <!-- @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                                                                                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
@else
    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                                                                                        @if (Route::has('register'))
    <a href="{{ route('register') }}"
                                                                                            class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
    @endif
            @endauth
        </div>
        @endif -->
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
