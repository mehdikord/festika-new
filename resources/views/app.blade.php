<!doctype html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('template/css/bootstrap.rtl.min.css') }}">

    <link rel="stylesheet" href="{{ asset('template/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('template/css/magnific-popup.min.css') }}">

    <link rel="stylesheet" href="{{ asset('template/css/meanmenu.min.css') }}">

    <link rel="stylesheet" href="{{ asset('template/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('template/css/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('template/css/rtl.css') }}">

    <link rel="stylesheet" href="{{ asset('fonts/css/font.css') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <title>فستیکا - ایجاد جشنواره آنلاین</title>

    <link rel="icon" type="image/png" href="{{ asset('template/images/favicon.png') }}">
</head>

<body>

{{--<div class="preloader">--}}
{{--    <div class="spinner">--}}
{{--        <div class="dot1"></div>--}}
{{--        <div class="dot2"></div>--}}
{{--    </div>--}}
{{--</div>--}}

<div id="app">
    <div class="navbar-area">
        <div class="mobile-responsive-nav">
            <div class="container-fluid">
                <div class="mobile-responsive-menu">
                    <div class="logo">
                        <a href="index.html">
                            <img src="template/images/logo-2.png" alt="logo">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="desktop-nav desktop-nav-one nav-area">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-md navbar-light ">
                    <router-link :to="{name : 'front_index'}" class="navbar-brand">
                        <img src="{{ asset('festika.svg') }}" width="80" >
                    </router-link>
                    <div class="nav-widget-form">
                        <form class="search-form">
                            <input type="search" class="form-control" placeholder="جستجو جشنواره ... ">
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav m-auto">
                            <li class="nav-item">
                                <router-link :to="{name:'front_index'}"class="nav-link" :class="{'active' : this.$route.name === 'front_index'}">
                                    صفحه اصلی
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link ">
                                    جشنواره ها
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="auction.html" class="nav-link">
                                            Live Auction
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    فروشگاه هدایا
                                </a>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{name:'front_contact'}"class="nav-link" :class="{'active' : this.$route.name === 'front_contact'}">
                                    ارتباط با ما
                                </router-link>

                            </li>
                            <li class="nav-item">

                                <a href="#" class="nav-link">
                                    راهنما فستیکا

                                </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="collection.html" class="nav-link">
                                            Collection
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="create-collection.html" class="nav-link">
                                            Create Collection
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="authors.html" class="nav-link">
                                            Authors
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="author-profile.html" class="nav-link">
                                            Author Profile
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="team.html" class="nav-link">
                                            Team
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="testimonials.html" class="nav-link">
                                            Testimonials
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            User
                                            <i class="ri-arrow-down-s-line"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class="nav-item">
                                                <a href="login.html" class="nav-link">
                                                    Log In
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="register.html" class="nav-link">
                                                    Register
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="forgot-password.html" class="nav-link">
                                                    Forgot Password
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a href="terms-condition.html" class="nav-link">
                                            Terms & Conditions
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="privacy-policy.html" class="nav-link">
                                            Privacy Policy
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="404.html" class="nav-link">
                                            404 Page
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="coming-soon.html" class="nav-link">
                                            Coming Soon
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    بلاگ
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="about.html" class="nav-link">
                                            About Us
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="add-wallet.html" class="nav-link">
                                            Add Wallet
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            Blog
                                            <i class="ri-arrow-down-s-line"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class="nav-item">
                                                <a href="blog-1.html" class="nav-link">
                                                    Blog Grid
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="blog-2.html" class="nav-link">
                                                    Blog Left Sidebar
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="blog-3.html" class="nav-link">
                                                    Blog Right Sidebar
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="blog-details.html" class="nav-link">
                                                    Blog Details
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="categories.html" class="nav-link">
                                                    Categories
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="tags.html" class="nav-link">
                                                    Tags
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a href="help-center.html" class="nav-link">
                                            Help Center
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="others-options">
                            <ul class="optional-item-list">
                                <li v-if="!this.UserAuthCheck()">
                                <router-link :to="{name:'front_login'}"  :class="{'active' : this.$route.name === 'front_login'}">
                                    <i class="fas fa-sign-in-alt"></i> ورود به حساب
                                </router-link>
                                </li>
                                <li v-else>
                                <router-link :to="{name:'front_index'}" :class="{'active' : this.$route.name === 'front_login'}" >
                                    <i class="fas fa-user"></i> پنل کاربری
                                </router-link>
                                </li>
                                <li v-if="!this.UserAuthCheck()">
                                <router-link :to="{name : 'front_register'}"  :class="{'active' : this.$route.name === 'front_register'}">
                                    <i class="fas fa-user-plus"></i> ثبت نام
                                </router-link>
                                </li>
                                <li v-else-if="this.UserAuthGet().role && this.UserAuthGet().role < 4">
                                    <a  href="/manage/dashboard"><i class="fas fa-cog"></i> پنل مدیریت </a>
                                </li>
                                <li v-else>
                                <router-link :to="{name : 'front_register'}" >
                                     خروج از حساب
                                </router-link>
                                </li>

                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="mobile-nav">
            <div class="search-btn">
                <a class="#" href="#searchmodal" data-bs-toggle="modal" data-bs-target="#searchmodal">
                    <i class="fas fa-search"></i>
                </a>
            </div>
        </div>
        <div class="side-nav-responsive">
            <div class="container-max">
                <div class="dot-menu dot-menu-mt">
                    <div class="circle-inner">
                        <div class="circle circle-one"></div>
                        <div class="circle circle-two"></div>
                        <div class="circle circle-three"></div>
                    </div>
                </div>
                <div class="container container-mt">
                    <div class="side-nav-inner">
                        <div class="side-nav justify-content-center align-items-center">
                            <div class="side-nav-item">
                                <ul class="optional-item-list">
                                    <li><a>ورود به حساب</a></li>
                                    <li><a class="active">ثبت نام</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade fade-scale searchmodal" id="searchmodal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="modal-search-form">
                        <input type="search" class="search-field" placeholder="جستجو جشنواره...">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <router-view></router-view>

    <footer class="footer-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-8">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="index.html">
                                <img src="{{ asset('festika.svg') }}" width="100" alt="Footer Logo">
                            </a>
                        </div>
                        <p>عضویت در خبرنامه فستیکا</p>
                        <div class="newsletter-area">
                            <form class="newsletter-form" data-toggle="validator" method="POST">
                                <input type="email" class="form-control" placeholder="Enter Your Email" name="EMAIL"
                                       required autocomplete="off">
                                <button class="subscribe-btn" type="submit">
                                    ثبت عضویت
                                </button>
                                <div id="validator-newsletter" class="form-result"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-4">
                    <div class="footer-widget ps-5">
                        <h6>مجوزهای فستیکا</h6>
                        <ul class="footer-list">
                            <li>
                                <a href="discover-1.html" target="_blank">
                                    Art
                                </a>
                            </li>
                            <li>
                                <a href="discover-1.html" target="_blank">
                                    All NFTs
                                </a>
                            </li>
                            <li>
                                <a href="discover-1.html" target="_blank">
                                    Music
                                </a>
                            </li>
                            <li>
                                <a href="discover-1.html" target="_blank">
                                    Trending Cards
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-4">
                    <div class="footer-widget ps-5">
                        <h6>لینک های مفید</h6>
                        <ul class="footer-list">
                            <li>
                                <a href="authors.html" target="_blank">
                                    Authors
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-4">
                    <div class="footer-widget ps-5">
                        <h6>راه های ارتباطی</h6>
                        <ul class="footer-list">
                            <li>
                                <a href="about.html" target="_blank">
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a href="contact.html" target="_blank">
                                    Contact Us
                                </a>
                            </li>
                            <li>
                                <a href="blog-1.html" target="_blank">
                                    Our Blog
                                </a>
                            </li>
                            <li>
                                <a href="discover-1.html" target="_blank">
                                    Discover
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-shape">
            <div class="footer-shape1">
                <img src="template/images/shape/shape-bg.png" alt="Images">
            </div>
            <div class="footer-shape2">
                <img src="template/images/shape/shape1.png" alt="Images">
            </div>
            <div class="footer-shape3">
                <img src="template/images/shape/shape2.png" alt="Images">
            </div>
        </div>
    </footer>
</div>

<div class="copyright-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="copy-right-text">
                    <p>
                        © تمامی منابع برای فستیکا محفوظ است . طراحی و توسعه توسظ
                        <a href="https://mehdikord.ir/" target="_blank">Mehdi Kord</a>
                    </p>
                    <ul class="copy-right-list">
                        <li>
                            <a href="terms-condition.html" target="_blank">
                               قوانین و مقررات
                            </a>
                        </li>
                        <li>
                            <a href="privacy-policy.html" target="_blank">
                                حفظ حریم خصوصی
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="copy-right-social">
                    <ul class="social-link">
                        <li>
                            <a href="https://www.facebook.com/" target="_blank">
                                <i class="ri-facebook-fill"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/" target="_blank">
                                <i class="ri-instagram-fill"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/" target="_blank">
                                <i class="ri-twitter-fill"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/" target="_blank">
                                <i class="ri-linkedin-fill"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('template/js/jquery.min.js') }}"></script>

<script src="{{ asset('template/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('template/js/magnific-popup.min.js') }}"></script>

<script src="{{ asset('template/js/meanmenu.min.js') }}"></script>

<script src="{{ asset('template/js/owl.carousel.min.js') }}"></script>

<script src="{{ asset('template/js/countdown.min.js') }}"></script>

<script src="{{ asset('template/js/ajaxchimp.min.js') }}"></script>

<script src="{{ asset('template/js/form-validator.min.js') }}"></script>

<script src="{{ asset('template/js/contact-form-script.js') }}"></script>

<script src="{{ asset('template/js/custom.js') }}"></script>

<script src="https://kit.fontawesome.com/bead5d45e7.js" crossorigin="anonymous"></script>

<script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
