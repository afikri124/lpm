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
                <li class="one"><img class="img-fluid" src="../assets/images/landing/decore/1.png" alt=""></li>
                <li class="two"><img class="img-fluid" src="../assets/images/landing/decore/2.png" alt=""></li>
                <li class="three"><img class="img-fluid" src="../assets/images/landing/decore/4.png" alt=""></li>
                <li class="four"><img class="img-fluid" src="../assets/images/landing/decore/3.png" alt=""></li>
                <li class="five"><img class="img-fluid" src="../assets/images/landing/2.png" alt=""></li>
                <li class="six"><img class="img-fluid" src="../assets/images/landing/decore/cloud.png" alt=""></li>
                <li class="seven"><img class="img-fluid" src="../assets/images/landing/2.png" alt=""></li>
            </ul>
            <div class="container-fluid">
                <div class="sticky-header">
                    <header>
                        <nav class="navbar navbar-b navbar-trans navbar-expand-xl fixed-top nav-padding"
                            id="sidebar-menu"><a class="navbar-brand p-0" href="{{ route('home') }}"><img
                                    class="img-fluid" src="{{asset('assets/images/logo.png')}}" alt=""></a>
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
                                <h2 class="txt-secondary wow fadeIn">Quality Assurance Agency</h2>
                                <p class="mt-3 wow fadeIn">Jakarta Global University
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6">
                        <div class="wow fadeIn"><img class="screen1"
                                src="{{asset('assets/images/landing/screen1.jpg')}}" alt=""></div>
                        <div class="wow fadeIn"><img class="screen2"
                                src="{{asset('assets/images/landing/screen2.jpg')}}" alt=""></div>
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
                                <p>Admin unique layouts</p>
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

        <section class="section-space cuba-demo-section bg-Widget pb-0 bg-primary" id="vision-and-mission">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 wow pulse">
                        <div class="cuba-demo-content mt50">
                            <div class="couting">
                                <h2>Vision & Mission</h2>
                            </div>
                            <p>So many unique cards</p>
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
                                    <li>Basic template</li>
                                    <li>Basic With Header template</li>
                                    <li>Ecommerce template</li>
                                    <li>Ecommerce-2 template</li>
                                    <li>Ecommerce-3 template</li>
                                    <li>Order Success template</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 wow pulse"><a href=""><img class="img-fluid email-img"
                                src="../assets/images/landing/email_section_img.png" alt=""></a></div>
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
                        <h1>The Cuba Bootstrap Admin Theme Trusted By Many Developers World Wide.</h1>
                        <p>If You like Our Theme So Please Rate Us.</p><a
                            class="btn mrl5 btn-lg btn-primary default-view" target="_blank" href="index.html">Check
                            Now</a><a class="btn mrl5 btn-lg btn-secondary btn-md-res" target="_blank"
                            href="https://1.envato.market/3GVzd">Buy Now </a>
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
                            <p>So many unique cards</p>
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
