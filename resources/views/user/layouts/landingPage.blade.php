@extends('user.layouts.base')

@section('title', 'Welcome To SIPEGAWAI')

@section('content')
    <!-- start banner Area -->
    <section class="home-banner-area relative" id="home" data-parallax="scroll"
        data-image-src="{{ URL::to('/arclabs') }}/img/bg.gif">
        <div class="overlay-bg overlay"></div>
        <h1 class="template-name">WELCOME</h1>
        <div class="container">
            <div class="row fullscreen">
                <div class="banner-content col-lg-12">
                    <p>Monitoring Pegawai</p>
                    <h1>
                        Aplikasi <br>
                        SIPEGAWAI
                    </h1>
                </div>
            </div>
        </div>
        <div class="head-bottom-meta">
            <div class="d-flex meta-left no-padding">
                <a href="#"><span class="fa fa-facebook-f"></span></a>
                <a href="#"><span class="fa fa-twitter"></span></a>
                <a href="#"><span class="fa fa-instagram"></span></a>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

@endsection
