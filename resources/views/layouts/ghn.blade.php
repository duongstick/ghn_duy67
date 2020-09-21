<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GHN - Giao hàng nhanh toàn quốc</title>
    <link href="https://fonts.googleapis.com/css?family=DM+Sans:300,400,700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend')}}/fonts/icomoon/style.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('frontend')}}/fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="{{asset('frontend')}}/css/aos.css">

    <link rel="stylesheet" href="{{asset('frontend')}}/css/style.css">
    @yield('css')
</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
<div class="site-wrap" id="home-section">
    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>
    <header class="site-navbar site-navbar-target" role="banner">
        <div class="container">
            <div class="row align-items-center position-relative">
                <div class="col-3 ">
                    <div class="site-logo">
                        <a href="{{route('index')}}">GHN</a>
                    </div>
                </div>
                <div class="col-9  text-right">
                    <span class="d-inline-block d-lg-none"><a href="#"
                                                              class="text-white site-menu-toggle js-menu-toggle py-5 text-white"><span
                                class="icon-menu h3 text-white"></span></a></span>
                    <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
                        <ul class="site-menu main-menu js-clone-nav ml-auto ">
                            <li><a href="{{route('index')}}" class="nav-link">Trang chủ</a></li>
                            <li><a href="{{route('createBill')}}" class="nav-link">Tạo đơn</a></li>
                            <li><a href="{{route('search')}}" class="nav-link">Tra cứu vận đơn</a></li>
                            @if(auth()->user())
                                <li><a href="{{route('listBill')}}" class="nav-link">Đơn hàng</a></li>
                                <li><a href="{{route('admin.user.profile',auth()->id())}}" class="nav-link">{{auth()->user()->name}}</a></li>
                                <li>
                                    <a href="{{route('register')}}" class="nav-link" onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">Đăng xuất</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>


                            @else
                                <li><a href="{{route('login')}}" class="nav-link">Đăng nhập</a></li>
                                <li><a href="{{route('register')}}" class="nav-link">Đăng ký</a></li>
                            @endif


                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <div class="ftco-blocks-cover-1">
        <div class="ftco-cover-1 innerpage" style="background-image: url('{{asset('frontend/images/slide_2.png')}}')">

        </div>
    </div>
    <div class="site-section">
        <div class="container-fluid">
            @include('layouts.components.flash_message')
            @yield('content')
        </div>
    </div>

    <div class="row">
        <img src="//theme.hstatic.net/1000376681/1000508169/14/banner-footer.jpg?v=2539" alt="Giao hàng nhanh" width="100%">
    </div>
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h2 class="footer-heading mb-4">CÔNG TY CPDV GIAO HÀNG NHANH</h2>
                    <p>
                        Công ty giao nhận đầu tiên tại Việt Nam được thành lập với sứ mệnh phục vụ nhu cầu vận chuyển chuyên nghiệp của các đối tác Thương mại điện tử trên toàn quốc.
                    </p>
{{--                    <P>Giấy CNĐKDN: 0311 907 295 do Sở Kế Hoạch và Đầu Tư TP HCM cấp lần đầu ngày 02/08/2012, cấp thay đổi lần thứ 16 ngày 10/5/2019.</P>--}}
                </div>
                <div class="col-lg-8 ml-auto">
                    <div class="row">
                        <div class="col-lg-6">
                            <h2 class="footer-heading mb-4">INFO</h2>
                            <p>Lương Ngọc Duy</p>
                            <P>Trụ sở chính: Hải Minh, Hải Hậu, Nam Định</P>
                        </div>
                        <div class="col-lg-3">
                            <h2 class="footer-heading mb-4">EMAIL</h2>
                            <P>Email: cskh@ghn.vn</P>
                        </div>
                        <div class="col-lg-3">
                            <h2 class="footer-heading mb-4">ĐIỆN THOẠI</h2>
                            <P>Hotline: 1800 6328</P>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="{{asset('frontend')}}/js/jquery-3.3.1.min.js" ></script>
<script src="{{asset('frontend')}}/js/popper.min.js" ></script>
<script src="{{asset('frontend')}}/js/bootstrap.min.js" ></script>
<script src="{{asset('frontend')}}/js/owl.carousel.min.js" ></script>
<script src="{{asset('frontend')}}/js/jquery.sticky.js" ></script>
<script src="{{asset('frontend')}}/js/jquery.waypoints.min.js" ></script>
<script src="{{asset('frontend')}}/js/jquery.animateNumber.min.js" ></script>
<script src="{{asset('frontend')}}/js/jquery.fancybox.min.js" ></script>
<script src="{{asset('frontend')}}/js/jquery.easing.1.3.js" ></script>
<script src="{{asset('frontend')}}/js/bootstrap-datepicker.min.js" ></script>
<script src="{{asset('frontend')}}/js/aos.js" ></script>
<script src="{{asset('frontend')}}/js/main.js" ></script>

@yield('js')
</body>
