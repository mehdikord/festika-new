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

    <link rel="stylesheet" href="{{ asset('fonts/css/font.css') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="@@dashboard">

<div id="preloader"><i>.</i><i>.</i><i>.</i></div>

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


                                <div class="nav-item dropdown notification dropdown">
                                    <div data-bs-toggle="dropdown" aria-haspopup="true" class="" aria-expanded="false">
                                        <div class="notify-bell icon-menu"><span>
                                            <i class="fas fa-bell"></i>
                                        </span>
                                        </div>
                                    </div>
                                    <div tabindex="-1" role="menu" aria-hidden="true"
                                         class="dropdown-menu notification-list dropdown-menu dropdown-menu-right">
                                        <h4>Recent Notification</h4>
                                        <div class="lists">
                                            <a class="" href="dashboard/#">
                                                <div class="d-flex align-items-center">
                                                <span class="me-3 icon success">
                                                    <i class="fas fa-check"></i>
                                                </span>
                                                    <div>
                                                        <p>Account created successfully</p><span>2020-11-04 12:00:23</span>
                                                    </div>
                                                </div>
                                            </a>

                                            <a href="#">More<i class="ri-arrow-right-s-line"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown profile_log dropdown">
                                    <div data-bs-toggle="dropdown" aria-haspopup="true" class="" aria-expanded="false">
                                        <div class="user icon-menu active">
                                        <span>
                                            <i class="fas fa-user"></i>
                                        </span>
                                        </div>
                                    </div>
                                    <div tabindex="-1" role="menu" aria-hidden="true"
                                         class="dropdown-menu dropdown-menu-right">
                                        <div class="user-email">
                                            <div class="user">
                                                <span class="thumb">
                                                    <img src="dashboard/images/profile/3.png" alt="">
                                                </span>
                                                <div class="user-info">
                                                    <h5>Jannatul Maowa</h5>
                                                    <span>imsaifun@gmail.com</span>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="dropdown-item" href="dashboard/profile.html">
                                            <span><i class="ri-user-line"></i></span>Profile
                                        </a>
                                        <a class="dropdown-item" href="dashboard/wallet.html">
                                            <span><i class="ri-wallet-line"></i></span>Wallet
                                        </a>
                                        <a class="dropdown-item" href="dashboard/settings-profile.html">
                                            <span><i class="ri-settings-3-line"></i></span>Settings
                                        </a>
                                        <a class="dropdown-item" href="dashboard/settings-activity.html">
                                            <span><i class="ri-time-line"></i></span>Activity
                                        </a>
                                        <a class="dropdown-item" href="dashboard/lock.html">
                                            <span><i class="ri-lock-line"></i></span>Lock
                                        </a>
                                        <a class="dropdown-item logout" href="dashboard/signin.html">
                                            <i class="ri-logout-circle-line"></i>Logout
                                        </a>
                                    </div>
                                </div>
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
