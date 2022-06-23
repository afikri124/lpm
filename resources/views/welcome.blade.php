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
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <div class="page-wrapper landing-page">
        <div class="landing-home">
            <ul class="decoration">
                <li class="one"><img class="img-fluid" src="../assets/images/landing/decore/1.png" alt="">
                </li>
                <li class="two"><img class="img-fluid" src="../assets/images/landing/decore/2.png" alt="">
                </li>
                <li class="three"><img class="img-fluid" src="../assets/images/landing/decore/4.png" alt="">
                </li>
                <li class="four"><img class="img-fluid" src="../assets/images/landing/decore/3.png" alt="">
                </li>
                <li class="five"><img class="img-fluid" src="../assets/images/landing/2.png" alt=""></li>
                <li class="six"><img class="img-fluid" src="../assets/images/landing/decore/cloud.png" alt=""></li>
                <li class="seven"><img class="img-fluid" src="../assets/images/landing/2.png" alt=""></li>
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
                                    <li class="nav-item"><a class="nav-link px-3" href="#"><i
                                                class="icofont icofont-ui-home"></i> Home</a></li>
                                    <li class="nav-item">
                                        <div class=" dropup dropdown-basic">
                                            <div class="dropup dropdown">
                                                <a class="nav-link px-3" href="#"><i
                                                        class="icofont icofont-ui-user"></i> About</a>
                                                <div class="dropup-content dropdown-content">
                                                    <a href="#about-us">About Us</a>
                                                    <a href="#vision-and-mission">Vision & Mission</a>
                                                    <a href="#org-structure">Org. Structure</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <div class=" dropup dropdown-basic">
                                            <div class="dropup dropdown">
                                                <a class="nav-link px-3" href="#"><i class="icofont icofont-trophy"></i>
                                                    Accreditation</a>
                                                <div class="dropup-content dropdown-content">
                                                    <a href="#instruments">Instruments</a>
                                                    <a href="#results">Results</a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item"><a class="nav-link px-3" href="#contact"><i
                                                class="icofont icofont-ui-head-phone"></i> Contact</a></li>
                                    <li class="nav-item">
                                        <div class="dropup dropdown-basic">
                                            <div class="dropup dropdown">
                                                <a class="nav-link dropbtn btn-primary px-3" href="#"><i
                                                        class="fa fa-th"></i> Application</a>
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
                                                    <a href="#">Coming soon system..</a>
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
                        <div class="wow fadeIn"><img class="screen1" src="{{ asset('assets/images/landing/jgu.jpg') }}"
                                alt=""></div>
                        <div class="wow fadeIn"><img class="screen2" src="{{ asset('assets/images/landing/jgu.jpg') }}"
                                alt="" height="480" width="800"></div>
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
                                <h2>About Us</h2>
                            </div>
                            <div class="media-body">
                                <h2>PURPOSE</h2>
                                <div class="media">
                                    <div class="activity-dot-primary" style="position: absolute; left: 0; top:125px">
                                    </div>
                                    <div class="media" style="padding-top:18px"><strong><span> The realization of an
                                                internal quality assurance
                                                system within JGU which includes standard setting, implementation,
                                                evaluation, improvement, and standard control.
                                            </span></strong>
                                    </div>
                                </div>
                                </br>
                                <div class="media">
                                    <div class="activity-dot-primary"></div>
                                    <div class="media"><Strong><span> Ensure the implementation of internal and external
                                                quality assurance services and training in all units within the JGU.
                                        </strong></span>
                                    </div>
                                </div>
                                </br>
                                <div class="media">
                                    <div class="activity-dot-primary"></div>
                                    <div class="media"><Strong><span> The establishment of a quality culture for the
                                                academic community and education staff in the JGU
                                                environment.</strong></span>
                                    </div>
                                </div>
                                </br>
                                <div class="media">
                                    <div class="activity-dot-primary"></div>
                                    <div class="media"><Strong><span> Facilitate access to integrated higher education
                                                data for all units within the JGU environment.</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row demo-imgs">
                    <!-- CONTENT ABOUT US -->
                </div>
        </section>

        <section class="section-space bg-Widget pb-0 bg-primary pb-5" id="vision-and-mission">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 wow pulse">
                        <div class="cuba-demo-content mt50">
                            <div class="couting text-secondary">
                                <h2>Vission & Mission</h2>
                            </div>
                        </div>
                        <div class="media-body"></div>
                        <h3>Vission</h3>
                        <div class="card-body new-update pt-0">
                            <div class="activity-timeline">
                                <div class="media">
                                    <div class="media-body"><span>Making the JGU Quality Assurance Institute a pioneer
                                            in implementing the tridharma quality system and culture of higher education
                                            that can lead JGU to become a superior institution in the fields of
                                            technology and health.
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-left">
                        <h3>Mission</h3>
                        <div class="media">
                            <div class="activity-dot-primary"></div>
                            <div class="media"><span>Develop, implement, and make continuous improvements to the
                                    Internal Quality Assurance System (SPMI).</span>
                            </div>
                        </div>
                        <div class="media">
                            <div class="activity-dot-primary"></div>
                            <div class="media"><span>Build and develop services and training of internal and external
                                    quality assurance systems in all units within JGU
                                </span>
                            </div>
                        </div>
                        <div class="media">
                            <div class="activity-dot-primary"></div>
                            <div class="media"><span>Encouraging the formation of a quality culture of higher education
                                    tridharma for the academic community and education staff in the JGU
                                    environment.</span>
                            </div>
                        </div>
                        <div class="media">
                            <div class="activity-dot-primary"></div>
                            <div class="media"><span>Build an integrated JGU university database for all units within
                                    the JGU environment.</span>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
            <div class="container-fluid o-hidden">
                <div class="row landing-cards">
                    <!-- CONTENT VISI MISI -->
                </div>
            </div>
        </section>

        <section class="section-space cuba-demo-section email_bg" id="org-structure">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 wow pulse">
                        <div class="cuba-demo-content email-txt text-start">
                            <div class="couting">
                                <h2>Structure</h2>
                                <p>Organizational structure</p>
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
                    <div class="col-lg-8 wow pulse"><a href=""><img class="img-fluid email-img"
                                src="../assets/images/dashboard/structure-removebg.png" alt=""></a></div>
                </div>
            </div>
        </section>

        <section class="footer-bg" id="instruments">
            <div class="container">
                <div class="landing-center ptb50">
                    <div class="title">
                        <h2>Instruments</h2>
                        <p>Accreditation Instruments</p>
                    </div>
                    <div class="footer-content">
                        <h1>For Universities/Study Programs Who Want to Download Accreditation Instruments,</h1>
                        <h1> please click the following link: </h1>
                        <a class="btn mrl5 btn-lg btn-secondary default-view" target="_blank"
                            href=" https://bit.ly/instrumenakreditasi9"> https://bit.ly/instrumenakreditasi9</a>
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
                                <h2>Results</h2>
                            </div>
                            <p>Accreditation Results</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container container-modify">
                <div class="row component_responsive">
                    <div class="col-xl-2 col-md-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/1.png" alt="">
                            <h6 class="m-0 Pt-4">SweetAlert2</h6>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/2.png" alt="">
                            <h6 class="m-0">Avatar</h6>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/3.png" alt="">
                            <h6 class="m-0">Scrollable</h6>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/4.png" alt="">
                            <h6 class="m-0">Tree view</h6>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/5.png" alt="">
                            <h6 class="m-0">Bootstrap notify</h6>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/6.png" alt="">
                            <h6 class="m-0">Rating </h6>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/7.png" alt="">
                            <h6 class="m-0">Dropzone</h6>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/8.png" alt="">
                            <h6 class="m-0">Tour</h6>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/9.png" alt="">
                            <h6 class="m-0">Animated modal</h6>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/10.png" alt="">
                            <h6 class="m-0">Owl Carousel</h6>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/11.png" alt="">
                            <h6 class="m-0">Ribbons </h6>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6 component-col-set">
                        <div class="component-hover-effect"><img src="../assets/images/landing/icon/12.png" alt="">
                            <h6 class="m-0">Pagination </h6>
                        </div>
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
                                <h2>Contact</h2>
                            </div>
                            <div class="footer_bottom-item footer_social-media penci-col-3">
                                <div class="block-title"><span>Follow us</span></div>
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
                            <div class="footer-inner">
                                <p style="font-size: 14px; text-align: justify; color:white">
                                    <b>Mengubah Hidup,</b>
                                    <br>
                                    <b>Memperkaya Masa Depan</b>
                                </p>
                                <br>
                                <p style="font-size: 10px; text-align: justify; color:white">
                                    <b>Kampus C (Utama)</b>
                                    <br>
                                    Grand Depok City, Jl. Boulevard Raya No.2 Kota Depok
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
                                    Bekasi, Jawa Barat 17520
                                    <br>
                                    Telp : 021-8837-5585
                                    <br>
                                    Fax : 021-8837-5587
                                    <br>
                                    <br>
                                    <iframe
                                        src="https://maps.google.com/maps?q=Jakarta%20Global%20University%2C%20Jalan%20Boulevard%20Grand%20Depok%20City%2C%20Tirtajaya%2C%20Depok%20City%2C%20West%20Java%2C%20Indonesia&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
                                        width="50%" height="280" frameborder="0"
                                        style="border:0;  position: absolute; right: 0; top: 145px" allowfullscreen="">
                                    </iframe>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid o-hidden">
                <div class="row landing-cards">
                    <!-- CONTENT Contact -->
                </div>
            </div>
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
    @include('layouts.script')
</body>

</html>
