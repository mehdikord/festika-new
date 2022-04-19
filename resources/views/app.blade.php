<!doctype html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="samandehi" content="273164751"/>
    <meta name="enamad" content="385973"/>

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

    <link rel="icon" type="image/png" href="{{ asset('festika.svg') }}">
</head>

<body>

{{--<div class="preloader">--}}
{{--    <div class="spinner">--}}
{{--        <div class="dot1"></div>--}}
{{--        <div class="dot2"></div>--}}
{{--    </div>--}}
{{--</div>--}}

<div id="app">

    <front-include-menu></front-include-menu>
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
                <div class="col-md-4">
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
                <div class="col-md-3">
                    <div class="footer-widget ps-5">
                        <h6>مجوزهای فستیکا</h6>
                        <ul class="footer-list">
                            <li class="mt-3">
                                <a referrerpolicy="origin" target="_blank" href="https://trustseal.enamad.ir/?id=213932&amp;Code=PfvXbOiopMALyd92QYe2"><img referrerpolicy="origin" src="https://Trustseal.eNamad.ir/logo.aspx?id=213932&amp;Code=PfvXbOiopMALyd92QYe2" alt="" style="cursor:pointer" id="PfvXbOiopMALyd92QYe2"></a>
                            </li>
                            <li class="mt-3">
                                <img id = 'nbqejxlzrgvjjxlzsizpoeuk' style = 'cursor:pointer' onclick = 'window.open("https://logo.samandehi.ir/Verify.aspx?id=213198&p=uiwkrfthxlaorfthpfvlmcsi", "Popup","toolbar=no, scrollbars=no, location=no, statusbar=no, menubar=no, resizable=0, width=450, height=630, top=30")' alt = 'logo-samandehi' src = 'https://logo.samandehi.ir/logo.aspx?id=213198&p=odrfnbpdqftinbpdbsiyaqgw' />
                            </li>
                            <li class="mt-3">
                                <img width="150" src="{{asset('template/images/svg/t-park-festika.png')}}" />
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="footer-widget ps-5">
                        <h6>لینک های مفید</h6>
                        <ul class="footer-list">
                            <li>
                                <router-link :to="{name : 'front_festivals'}">
                                    همه جشنواره ها
                                </router-link>
                            </li>
                            <li>
                                <router-link to="">
                                    راهنما فستیکا
                                </router-link>
                            </li>
                            <li>
                                <router-link to="">
                                   قوانین و مقررات
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-widget ps-5">
                        <h6>راه های ارتباطی</h6>
                        <ul class="footer-list">
                            <li class="mt-3">
                                <i class="fas fa-clock"></i> <span>شنبه - چهارشنبه (16 - 9)</span>
                            </li>
                            <li class="mt-3">
                                <i class="fas fa-phone"></i> <a href="tel:09215842947">0921-968-9695</a>
                            </li>
                            <li class="mt-3">
                                <i class="fas fa-comment"></i> <a href="mailto:Festika@chmail.ir">festikahelp@gmail.com</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-shape">
            <div class="footer-shape1">
                <img src="{{ asset('template/images/shape/shape-bg.png') }}" alt="Images">
            </div>
            <div class="footer-shape2">
                <img src="{{ asset('template/images/shape/shape1.png') }}" alt="Images">
            </div>
            <div class="footer-shape3">
                <img src="{{ asset('template/images/shape/shape2.png') }}" alt="Images">
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
                        © تمامی منابع برای فستیکا محفوظ است . طراحی و توسعه توسط :
                        <a href="" target="_blank">فناوران هوشمند ایده پرداز هیرکان</a>
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
