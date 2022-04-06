<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!---- Website Information ---->
    <title>پنل کاربری فستیکا</title>


    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('festika.svg') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/style.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">


    <link rel="stylesheet" href="{{ asset('fonts/css/font.css') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="@@dashboard">

{{--<div id="preloader"><i>.</i><i>.</i><i>.</i></div>--}}

<div id="main-wrapper">
    <div id="app">
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="header-content">
                            <div class="header-left">
                                <div class="brand-logo"><a class="mini-logo" href="dashboard/">
                                        <img src="{{ asset('festika.svg') }}" alt="" width="40"></a></div>
                                <div class="search">
                                    <form action="#">
                                        <span><i class="fas fa-search"></i></span>
                                        <input type="text" placeholder="جستجو در پنل کاربری">
                                    </form>
                                </div>
                            </div>
                            <div class="header-right">
                                <!-- <div class="theme-switch"><i class="ri-sun-line"></i></div> -->

                                <div class="dark-light-toggle theme-switch" onclick="themeToggle()">
                                    <span class="dark"><i class="fas fa-moon"></i></span>
                                    <span class="light"><i class="fas fa-sun"></i></span>
                                </div>


                                <panel-menu-notif></panel-menu-notif>
                                <panel-menu-profile></panel-menu-profile>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar">
            <div class="brand-logo">
                <a class="full-logo" href="">
                    <img src="{{ asset('festika.svg') }}" alt="" width="60">
                </a>
            </div>
            <panel-menu></panel-menu>
        </div>

        <div class="content-body">
            <div class="container">
                <router-view></router-view>
            </div>
        </div>
    </div>



</div>



<script src="{{ asset('dashboard/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://kit.fontawesome.com/bead5d45e7.js" crossorigin="anonymous"></script>

<script src="{{ asset('dashboard/js/scripts.js') }}"></script>

<script src="{{ asset('js/dashboard.js') }}"></script>

</body>

</html>
