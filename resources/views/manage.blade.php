<!doctype html>
<html lang="en" style="direction: rtl;">

<head>

    <meta charset="utf-8" />
    <title>مدیریت فستیکا</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('management/images/favicon.ico') }}">

    <!-- plugin css -->
    <link href="{{ asset('management/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">

    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset('management/css/preloader.min.css') }}" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('management/css/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    {{--    <link href="{{ asset('management/css/icons.min.css') }}" rel="stylesheet" type="text/css" />--}}
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css">


    <!-- App Css-->
    <link href="{{ asset('management/css/app-rtl.min.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('fonts/css/font.css') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


</head>

<body data-layout-mode="light" data-topbar="light" data-sidebar="light">

<!-- <body data-layout="horizontal"> -->

<!-- Begin page -->

<div id="app">

    <div id="layout-wrapper">

        <header id="page-topbar">
            <manage_header></manage_header>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <manage_menu></manage_menu>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <router-view></router-view>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            Festika
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Mehdi Kord
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>

</div>
<!-- END layout-wrapper -->


<!-- JAVASCRIPT -->
<script src="{{ asset('management/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('management/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('management/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('management/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('management/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('management/libs/feather-icons/feather.min.js') }}"></script>

<!-- pace js -->
<script src="{{ asset('management/libs/pace-js/pace.min.js') }}"></script>
{{--<script src="https://cdn.tiny.cloud/1/pt855e3h7yxtda2zr97ldurjwwrotxv1gmy7afdhxegvcpu9/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>--}}


<script src="https://kit.fontawesome.com/bead5d45e7.js" crossorigin="anonymous"></script>

<script src="{{ asset('management/js/app.js') }}"></script>
<script src="{{ asset('js/manage.js') }}" defer></script>

</body>

</html>
