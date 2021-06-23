<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIPEGAWAI</title>
    <link rel="shortcut icon" href="{{ URL::to('/img') }}/favicon.ico" type="image/x-icon">
    <!-- Bootstrap , fonts & icons  -->
    <link rel="stylesheet" href="{{ URL::to('/landing') }}/css/bootstrap.css">
    <link rel="stylesheet" href="{{ URL::to('/landing') }}/fonts/icon-font/css/style.css">
    <link rel="stylesheet" href="{{ URL::to('/landing') }}/fonts/typography-font/typo.css">
    <link rel="stylesheet" href="{{ URL::to('/landing') }}/fonts/typography-font/lucida-grande/typo.css">
    <link rel="stylesheet" href="{{ URL::to('/landing') }}/fonts/fontawesome-5/css/all.css">
    <!-- Plugin'stylesheets  -->
    <link rel="stylesheet" href="{{ URL::to('/landing') }}/plugins/aos/aos.min.css">
    <link rel="stylesheet" href="{{ URL::to('/landing') }}/plugins/fancybox/jquery.fancybox.min.css">
    <link rel="stylesheet" href="{{ URL::to('/landing') }}/plugins/nice-select/nice-select.min.css">
    <link rel="stylesheet" href="{{ URL::to('/landing') }}/plugins/slick/slick.min.css">
    <!-- Vendor stylesheets  -->
    <link rel="stylesheet" href="{{ URL::to('/landing') }}/./plugins/theme-mode-switcher/switcher-panel.css">
    <link rel="stylesheet" href="{{ URL::to('/landing') }}/css/main.css">
    <!-- Custom stylesheet -->
</head>

<body data-theme="light">
    <div class="site-wrapper overflow-hidden">
        <!-- Header start  -->
        <!-- Header Area -->
        <header
            class="site-header l8-site-header site-header--menu-center dynamic-sticky-bg dark-mode-texts px-9 site-header--absolute site-header--sticky">
            <div class="container-fluid-fluid">
                <nav class="navbar site-navbar offcanvas-active navbar-expand-lg px-0">
                    <!-- Brand Logo-->
                    <div class="brand-logo d-inline-block">
                        <a href="#">
                            <!-- light version logo (logo must be black)-->
                            <img src="{{ URL::to('/admin') }}/assets/images/logo_sipegawai.png" alt="">
                            <!-- Dark version logo (logo must be White)-->
                        </a>
                    </div>
                    <div class="collapse navbar-collapse" id="mobile-menu">
                        <button class="d-block d-lg-none offcanvas-btn-close" type="button" data-toggle="collapse"
                            data-target="#mobile-menu" aria-controls="mobile-menu" aria-expanded="true"
                            aria-label="Toggle navigation">
                            <i class="gr-cross-icon"></i>
                        </button>
                    </div>
                    <div class="header-btns ml-auto pr-2 ml-lg-9 d-none d-xs-flex">
                        <a class="btn btn-2 btn-turquoise border border-turquoise font-size-5 text-firefly"
                            href="/login">
                            Login </a>
                    </div>
                    <!-- Mobile Menu Hamburger-->
                    <button class="navbar-toggler btn-close-off-canvas  hamburger-icon border-0" type="button"
                        data-toggle="collapse" data-target="#mobile-menu" aria-controls="mobile-menu"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <!-- <i class="icon icon-simple-remove icon-close"></i> -->
                        <span class="hamburger hamburger--squeeze js-hamburger">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </span>
                    </button>
                    <!--/.Mobile Menu Hamburger Ends-->
                </nav>
            </div>
        </header>
        <!-- navbar- -->
        <!-- Header start end -->
        <!-- hero area -->
        <div
            class="gradient-bg-1 pt-23 pt-sm-25 pt-md-25 pt-lg-31 pb-lg-12 pb-md-15 pb-11 position-relative z-index-1 font-family-5">
            <div class="section-bg-img-2 pos-abs-tl w-100 h-100 z-index-n1"></div>
            <div class="container">
                <div class="row position-relative justify-content-center">
                    <!-- hero area content start -->
                    <div class="col-xl-6 col-lg-7 col-md-10 pb-lg-20 pb-10 pr-0" data-aos="fade-right"
                        data-aos-duration="800" data-aos-once="true">
                        <div class="hero-content text-center">
                            <!-- hero area section title start -->
                            <h1 class="font-size-22 font-family-5 text-white letter-spacing-np3 mb-6 ">Sistem Informasi
                                Pemantauan Pegawai</h1>
                            <p
                                class="font-size-8 text-periwinkle-gray letter-spacing-np4 font-family-5 pr-xl-15 pr-lg-0 pr-md-15 pr-0 mb-11">
                                Mempermudah mengelola data yang berhubungan dengan kinerja pegawai anda seperti data presensi hingga data cuti.</p>
                            <!-- hero area section title end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer section -->
        <footer class="gradient-bg-6  position-relative l8-footer " >
            <div class="shape l8-footer-shape-top-left">
                <img src="{{ URL::to('/landing') }}/image/l8/svg/footer-shape.svg" alt=""
                    class="w-100 light-shape default-shape z-index-n2">
            </div>
            <!-- footer-bottom start -->
            <div class="pt-0 pb-0">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 px-0">
                            <div class="navbar site-navbar d-md-flex d-block text-center px-0">
                                <!-- DO NOT DELETE THIS CREDIT. TO DELETE, PLEASE BUY PRO LICENSE -->
                                <div class="copyright">
                                    <p
                                        class="font-size-1 font-family-5 text-periwinkle-gray line-height-1p5 mb-0 font-family-inter">
                                        &copy; SIPEGAWAI 2020 All right reserved. </p>
                                </div>
                                <!-- copyright end-->
                                <!-- footer-menu start-->
                                <div class="footer-menu">
                                    <!-- navbar-nav-wrapper start-->
                                    <div class="navbar-nav-wrapper">
                                        <!-- main-menu start-->
                                        <ul class="mb-0 list-unstyled d-flex flex-row justify-content-center">
                                            <li class="mx-0">
                                                <a class="text-periwinkle-gray font-size-1 font-weight-normal font-family-inter"
                                                    href="#features">D3 Teknik Informatika Sekolah Vokasi UNS</a>
                                            </li>
                                        </ul>
                                        <!-- main-menu end-->
                                    </div>
                                    <!-- navbar-nav-wrapper end-->
                                </div>
                                <!-- footer-menu end-->
                                <div class="ml-auto pr-2 ml-lg-12 ml-md-0">
                                    <!-- widget social icon start -->
                                    <div class="social-icons">
                                        <!-- widget social icon list start -->
                                        <ul class="pl-0 list-unstyled mb-lg-0 mb-0">
                                            <li class="d-inline-block px-3 ml-3"><a
                                                    href="https://github.com/hakimfauzi23"
                                                    class="hover-color-primary text-white"><i
                                                        class="fab fa-github font-size-3 pt-2"></i></a></li>
                                            <li class="d-inline-block px-3 ml-3"><a
                                                    href="https://www.linkedin.com/in/hanif-fauzi-hakim-521b05193/"
                                                    class="hover-color-primary text-white"><i
                                                        class="fab fa-linkedin-in font-size-3 pt-2"></i></a></li>
                                        </ul>
                                        <!-- widget social icon list end -->
                                    </div>
                                    <!-- widget social icon end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- cta section -->
    </div>
    <!-- Vendor Scripts -->
    <script src="{{ URL::to('/landing') }}/js/vendor.min.js"></script>
    <!-- Plugin's Scripts -->
    <script src="{{ URL::to('/landing') }}/plugins/fancybox/jquery.fancybox.min.js"></script>
    <script src="{{ URL::to('/landing') }}/plugins/nice-select/jquery.nice-select.min.js"></script>
    <script src="{{ URL::to('/landing') }}/plugins/aos/aos.min.js"></script>
    <script src="{{ URL::to('/landing') }}/plugins/slick/slick.min.js"></script>
    <script src="{{ URL::to('/landing') }}/./plugins/counter-up/jquery.waypoints.js"></script>
    <script src="{{ URL::to('/landing') }}/./plugins/counter-up/jquery.counterup.js"></script>
    <script src="{{ URL::to('/landing') }}/plugins/theme-mode-switcher/gr-theme-mode-switcher.js"></script>
    <!-- Activation Script -->
    <script src="{{ URL::to('/landing') }}/js/custom.js"></script>
</body>

</html>
