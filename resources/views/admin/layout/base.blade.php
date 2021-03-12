<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
        type="text/css">
    <link href="{{ URL::to('/admin') }}/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('/admin') }}/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('/admin') }}/assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('/admin') }}/assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('/admin') }}/assets/css/colors.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->


    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/plugins/visualization/d3/d3.min.js">
    </script>
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/plugins/visualization/d3/d3_tooltip.js">
    </script>
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/plugins/forms/styling/switchery.min.js">
    </script>
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/plugins/forms/styling/uniform.min.js">
    </script>
    <script type="text/javascript"
        src="{{ URL::to('/admin') }}/assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/plugins/ui/moment/moment.min.js"></script>
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/plugins/pickers/daterangepicker.js">
    </script>
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/plugins/ui/headroom/headroom.min.js">
    </script>
    <script type="text/javascript"
        src="{{ URL::to('/admin') }}/assets/js/plugins/ui/headroom/headroom_jquery.min.js"></script>
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/plugins/ui/nicescroll.min.js"></script>

    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/core/app.js"></script>
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/pages/dashboard.js"></script>
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/pages/layout_fixed_custom.js"></script>
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/pages/layout_navbar_hideable_sidebar.js">
    </script>
    <!-- /theme JS files -->

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript"
        src="{{ URL::to('/admin') }}/assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/plugins/forms/selects/select2.min.js">
    </script>
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/plugins/forms/styling/uniform.min.js">
    </script>


    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/core/app.js"></script>
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/pages/datatables_basic.js"></script>
    <script type="text/javascript" src="{{ URL::to('/admin') }}/assets/js/pages/form_layouts.js"></script>
    <!-- /theme JS files -->





</head>

<body class="navbar-top">

    <!-- Main navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
        @include('admin.layout.navbar')
    </div>
    <!-- /main navbar -->


    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main sidebar -->
            <div class="sidebar sidebar-main sidebar-fixed">
                <div class="sidebar-content">

                    <!-- User menu -->
                    @include('admin.layout.userMenu')
                    <!-- /user menu -->


                    <!-- Main navigation -->
                    <div class="sidebar-category sidebar-category-visible">
                        <div class="category-content no-padding">
                            @include('admin.layout.sidebar')
                        </div>
                    </div>
                    <!-- /main navigation -->

                </div>
            </div>
            <!-- /main sidebar -->


            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Page header -->
                @yield('content_header')
                <!-- /page header -->
                @include('sweetalert::alert')


                <!-- Content area -->
                <div class="content">
                    @yield('content')
                </div>
                <!-- /dashboard content -->

                <!-- Footer -->
                <div class="footer text-muted">&copy; 2015. <a href="#">Limitless Web App Kit</a> by <a
                        href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
                </div>
                <!-- /footer -->


            </div>
            <!-- /content area -->


        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

    </div>
    <!-- /page container -->

    @yield('custom_script')
</body>

</html>
