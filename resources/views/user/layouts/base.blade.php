<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="colorlib">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700|Roboto:400,500" rel="stylesheet">
    <!--
   CSS
   ============================================= -->
    <link rel="stylesheet" href="{{ URL::to('/arclabs') }}/css/linearicons.css">
    {{-- <link rel="stylesheet" href="{{ URL::to('/arclabs') }}/css/font-awesome.min.css"> --}}
    <link href="{{ URL::to('/admin') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ URL::to('/arclabs') }}/css/bootstrap.css">
    <link rel="stylesheet" href="{{ URL::to('/arclabs') }}/css/owl.carousel.css">
    <link rel="stylesheet" href="{{ URL::to('/arclabs') }}/css/magnific-popup.css">
    {{-- <link rel="stylesheet" href="{{ URL::to('/arclabs') }}/css/nice-select.css"> --}}
    <link rel="stylesheet" href="{{ URL::to('/arclabs') }}/css/main.css">



</head>

<body>

    <!-- Start Header Area -->
    @include('user.layouts.header')
    <!-- End Header Area -->
    @include('sweetalert::alert')

    @yield('content')

    <!-- start footer Area -->
    @include('user.layouts.footer')
    <!-- End footer Area -->

    <script src="{{ URL::to('/arclabs') }}/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src="{{ URL::to('/arclabs') }}/js/vendor/bootstrap.min.js"></script>
    <script src="{{ URL::to('/arclabs') }}/js/jquery.ajaxchimp.min.js"></script>
    <script src="{{ URL::to('/arclabs') }}/js/parallax.min.js"></script>
    <script src="{{ URL::to('/arclabs') }}/js/owl.carousel.min.js"></script>
    <script src="{{ URL::to('/arclabs') }}/js/isotope.pkgd.min.js"></script>
    {{-- <script src="{{ URL::to('/arclabs') }}/js/jquery.nice-select.min.js"></script> --}}
    <script src="{{ URL::to('/arclabs') }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ URL::to('/arclabs') }}/js/jquery.sticky.js"></script>
    <script src="{{ URL::to('/arclabs') }}/js/main.js"></script>

    <script src="{{ URL::to('/admin') }}/vendor/chart.js/Chart.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="{{ URL::to('/admin') }}/js/sb-admin-2.min.js"></script>


    @yield('customScript')

</body>

</html>
