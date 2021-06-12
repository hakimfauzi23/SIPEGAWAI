<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="shortcut icon" href="{{ URL::to('/img') }}/favicon.ico" type="image/x-icon">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ URL::to('/login_template') }}/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ URL::to('/login_template') }}/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ URL::to('/login_template') }}/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('/login_template') }}/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ URL::to('/login_template') }}/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ URL::to('/login_template') }}/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('/login_template') }}/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ URL::to('/login_template') }}/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('/login_template') }}/css/util.css">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('/login_template') }}/css/main.css">
    <!--===============================================================================================-->
</head>

<body>

    @include('sweetalert::alert')

    <div class="container-login100"
        style="background-image: url('{{ URL::to('/login_template') }}/images/bg-02.gif');">
        @yield('content')
    </div>



    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="{{ URL::to('/login_template') }}/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ URL::to('/login_template') }}/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ URL::to('/login_template') }}/vendor/bootstrap/js/popper.js"></script>
    <script src="{{ URL::to('/login_template') }}/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ URL::to('/login_template') }}/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="{{ URL::to('/login_template') }}/vendor/daterangepicker/moment.min.js"></script>
    <script src="{{ URL::to('/login_template') }}/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="{{ URL::to('/login_template') }}/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="{{ URL::to('/login_template') }}/js/main.js"></script>

</body>

</html>
