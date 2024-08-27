<?php
   $websetting = DB::table('websettings')->where('id',1)->first();
   $jewelery_sub_cats = DB::table('sub_categories')->where('category_id', 18)->get();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Fastkart">
    <link rel="icon" href="{{ asset('assets/web/images/favicon/1.png')}}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @if(!empty($websetting->site_name))
    <title>{{ $websetting->site_name }}</title>
    @else
    <title>@yield('pageTitle','Deals Vogue | The Best Of Ceramics At Your Doorstep')</title>
    @endif
    @if(!empty($websetting->site_description))
    <meta name="description" content="{{ $websetting->site_description }}">
    @else
    <meta name="description" content="Online Shop">
    @endif
    @if(!empty($websetting->site_keywords))
    <meta name="keywords" content="{{ $websetting->site_keywords }}">
    @else
    <meta name="keywords" content="Online Shop">
    @endif

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">

    <!-- bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/vendors/bootstrap.css')}}">

    <!-- wow css -->
    <link rel="stylesheet" href="{{ asset('assets/web/css/animate.min.css')}}" />

    <!-- font-awesome css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/vendors/font-awesome.css')}}">

    <!-- feather icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/vendors/feather-icon.css')}}">

    <!-- Plugin CSS file with desired skin css -->
    <link rel="stylesheet" href="{{ asset('assets/web/css/vendors/ion.rangeSlider.min.css')}}">

    <!-- slick css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/vendors/slick/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/vendors/slick/slick-theme.css')}}">

    <!-- animation css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/font-style.css')}}">

    <!-- Template css -->
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('assets/web/css/style.css')}}">

    <!-- latest jquery-->
    <script src="{{ asset('assets/web/js/jquery-3.6.0.min.js')}}"></script>

    <!-- jquery ui-->
    <script src="{{ asset('assets/web/js/jquery-ui.min.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-16676531392">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-16676531392');
</script>
</head>

<body class="theme-color-3">

    <!-- Loader Start -->
    <div class="fullpage-loader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <!-- Loader End -->

    <!-- Header Start -->
    <header class="header-3">
        <div class="top-nav sticky-header sticky-header-2">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="navbar-top">
                            <button class="navbar-toggler d-xl-none d-block p-0 me-3" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
                                <span class="navbar-toggler-icon">
                                    <i class="iconly-Category icli"></i>
                                </span>
                            </button>
                            <a href="{{ url('/') }}" class="web-logo nav-logo">
                                <img src="{{ asset('websettings/'.$websetting->header_logo)}}" class="img-fluid blur-up lazyload" alt="">
                            </a>

                            <div class="search-full">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i data-feather="search" class="font-light"></i>
                                    </span>
                                    <input type="text" class="form-control search-type" placeholder="Search here..">
                                    <span class="input-group-text close-search">
                                        <i data-feather="x" class="font-light"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="middle-box">
                                <div class="center-box">
                                    <div class="location-box-2">
                                        <button class="btn location-button" data-bs-toggle="modal"
                                            data-bs-target="#locationModal">
                                            <i class="iconly-Location icli"></i>
                                            <span>Location</span>
                                            <i class="fa-solid fa-angle-down down-arrow"></i>
                                        </button>
                                    </div>

                                        <form method="get" action="{{ url('products-lists') }}">
                                    <div class="searchbar-box-2 input-group d-xl-flex d-none">

                                            <button class="btn search-icon" type="button">
                                                <i class="iconly-Search icli"></i>
                                            </button>
                                            <input type="text" class="form-control" name="keyword"
                                                placeholder="Search for products, styles,brands...">
                                            <button class="btn search-button" type="submit">Search</button>
                                    </div>
                                        </form>
                                </div>
                            </div>

                            <div class="rightside-menu support-sidemenu">
                                <div class="support-box">
                                    <div class="support-image">
                                        <img src="{{ asset('assets/web/images/icon/support.png')}}" class="img-fluid blur-up lazyload"
                                            alt="">
                                    </div>
                                    <div class="support-number">
                                        <h2>(123) 456 7890</h2>
                                        <h4>24/7 Support Center</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12 position-relative">
                    <div class="main-nav nav-left-align">
                        <div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky p-0">
                            <div class="offcanvas offcanvas-collapse order-xl-2" id="primaryMenu">
                                <div class="offcanvas-header navbar-shadow">
                                    <h5>Menu</h5>
                                    <button class="btn-close lead" type="button" data-bs-dismiss="offcanvas"
                                        aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <ul class="navbar-nav">
                                        <li class="nav-item dropdown dropdown-mega">
                                            <a class="nav-link dropdown-toggle ps-0" href="{{ url('products-lists') }}" >LIGHTING</a></li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="{{ url('products-lists') }}">DECOR</a>

                                        </li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                                data-bs-toggle="dropdown">Sculpture</a>


                                        </li>

                                        <li class="nav-item dropdown dropdown-mega">
                                            <a class="nav-link dropdown-toggle ps-xl-2 ps-0" href="javascript:void(0)"
                                                data-bs-toggle="dropdown">Diya</a>


                                        </li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                                data-bs-toggle="dropdown">Wall Decor</a>

                                        </li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                                data-bs-toggle="dropdown">TABLEWARE</a>

                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link nav-link-2" href="#">COLLECTIONS</a>
                                        </li>
										<li class="nav-item">
                                            <a class="nav-link nav-link-2" href="#">HOTELS & CAFE</a>
                                        </li>
										<li class="nav-item">
                                            <a class="nav-link nav-link-2" href="#">RESELLERS</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="rightside-menu">
                            <ul class="option-list-2">


                                <li class="onhover-dropdown">
                                    <a href="javascript:void(0)" class="header-icon swap-icon">
                                        <i class="iconly-Heart icli"></i>
                                    </a>

                                    <div class="onhover-div">
                                        <ul class="cart-list">
                                            <li>
                                                <div class="drop-cart">
                                                    <a href="product-left.html" class="drop-image">
                                                        <img src="{{ asset('assets/web/images/vegetable/product/1.png')}}"
                                                            class="blur-up lazyload" alt="">
                                                    </a>

                                                    <div class="drop-contain">
                                                        <a href="product-left.html">
                                                            <h5>Fantasy Crunchy Choco Chip Cookies</h5>
                                                        </a>
                                                        <h6><span>1 x</span> $80.58</h6>
                                                        <button class="close-button">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="drop-cart">
                                                    <a href="product-left.html" class="drop-image">
                                                        <img src="{{ asset('assets/web/images/vegetable/product/2.png')}}"
                                                            class="blur-up lazyload" alt="">
                                                    </a>

                                                    <div class="drop-contain">
                                                        <a href="product-left.html">
                                                            <h5>Peanut Butter Bite Premium Butter Cookies 600 g</h5>
                                                        </a>
                                                        <h6><span>1 x</span> $25.68</h6>
                                                        <button class="close-button">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>

                                        <div class="price-box">
                                            <h5>Price :</h5>
                                            <h4 class="theme-color fw-bold">$106.58</h4>
                                        </div>

                                        <div class="button-group">
                                            <a href="cart.html" class="btn btn-sm cart-button">View Cart</a>
                                            <a href="checkout.html" class="btn btn-sm cart-button theme-bg-color
                                                    text-white">Checkout</a>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <a href="{{ url('cart') }}" class="header-icon bag-icon">
                                        <small class="badge-number badge-light">{{ count((array) session('cart')) ?? 0 }}</small>
                                        <i class="iconly-Bag-2 icli"></i>
                                    </a>
                                </li>
                            </ul>
                            @if(Auth::id())

                            <a href="{{ url('mydashboard') }}" class="user-box">
                                <span class="header-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                </span>
                                {{-- <div class="user-name">
                                    <h6 class="text-content">Dashboard</h6>
                                    <h4 class="mt-1">Dashboard</h4>
                                </div> --}}
                            </a>
                            {{-- <a href="{{ url('mydashboard') }}" class="user-box">
                                Logout
                            </a> --}}
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();" class="logout-btn user-box"><i class="fa fa-sign-out" aria-hidden="true"></i> </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                               @csrf
                            </form>
                            @else
                            <a href="{{ url('userslogin') }}" class="user-box">
                                <span class="header-icon">
                                    <i class="iconly-Profile icli"></i>
                                </span>
                            </a>
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->

    <!-- mobile fix menu start -->
    <div class="mobile-menu d-md-none d-block mobile-cart">
        <ul>
            <li class="active">
                <a href="{{ url('/') }}">
                    <i class="iconly-Home icli"></i>
                    <span>Home</span>
                </a>
            </li>

            <li class="mobile-category">
                <a href="javascript:void(0)">
                    <i class="iconly-Category icli js-link"></i>
                    <span>Category</span>
                </a>
            </li>

            <li>
                <a href="search.html" class="search-box">
                    <i class="iconly-Search icli"></i>
                    <span>Search</span>
                </a>
            </li>

            <li>
                <a href="wishlist.html" class="notifi-wishlist">
                    <i class="iconly-Heart icli"></i>
                    <span>My Wish</span>
                </a>
            </li>

            <li>
                <a href="cart.html">
                    <i class="iconly-Bag-2 icli fly-cate"></i>
                    <span>Cart</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- mobile fix menu end -->


    @yield('content')



    <!-- Service Section Start -->
    <section class="service-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-3 row-cols-xxl-5 row-cols-lg-3 row-cols-md-2">
                <div>
                    <div class="service-contain-2">
                        <svg class="icon-width">
                            <use xlink:href="assets/svg/svg/service-icon-4.svg#shipping"></use>
                        </svg>
                        <div class="service-detail">
                            <h3>Free Shipping</h3>
                            <h6 class="text-content">Free Shipping world wide</h6>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="service-contain-2">
                        <svg class="icon-width">
                            <use xlink:href="assets/svg/svg/service-icon-4.svg#service"></use>
                        </svg>
                        <div class="service-detail">
                            <h3>24 x 7 Service</h3>
                            <h6 class="text-content">Online Service For 24 x 7</h6>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="service-contain-2">
                        <svg class="icon-width">
                            <use xlink:href="assets/svg/svg/service-icon-4.svg#pay"></use>
                        </svg>
                        <div class="service-detail">
                            <h3>Online Pay</h3>
                            <h6 class="text-content">Online Payment Avaible</h6>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="service-contain-2">
                        <svg class="icon-width">
                            <use xlink:href="assets/svg/svg/service-icon-4.svg#offer"></use>
                        </svg>
                        <div class="service-detail">
                            <h3>Festival Offer</h3>
                            <h6 class="text-content">Super Sale Upto 50% off</h6>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="service-contain-2">
                        <svg class="icon-width">
                            <use xlink:href="assets/svg/svg/service-icon-4.svg#return"></use>
                        </svg>
                        <div class="service-detail">
                            <h3>100% Original</h3>
                            <h6 class="text-content">100% Money Back</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Service Section End -->

    <!-- Footer Start -->
    <footer class="section-t-space footer-section-2 footer-color-2">
        <div class="container-fluid-lg">
            <div class="main-footer">
                <div class="row g-md-4 gy-sm-5">
                    <div class="col-xxl-3 col-xl-4 col-sm-6">
                        <a href="{{ url('/') }}" class="foot-logo theme-logo">
                            <img src="{{ asset('assets/web/images/logo.png')}}" class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <p class="information-text information-text-2">it is a long established fact that a reader will
                            be distracted by the readable content.</p>
                        <ul class="social-icon">
                            <li class="light-bg">
                                <a href="https://www.facebook.com/" class="footer-link-color">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li class="light-bg">
                                <a href="#"
                                    class="footer-link-color">
                                    <i class="fab fa-google"></i>
                                </a>
                            </li>
                            <li class="light-bg">
                                <a href="#" class="footer-link-color">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li class="light-bg">
                                <a href="https://www.instagram.com/" class="footer-link-color">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                            <li class="light-bg">
                                <a href="https://in.pinterest.com/" class="footer-link-color">
                                    <i class="fab fa-pinterest-p"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-xxl-2 col-xl-4 col-sm-6">
                        <div class="footer-title">
                            <h4 class="text-white">About Fastkart</h4>
                        </div>
                        <ul class="footer-list footer-contact footer-list-light">
                            <li>
                                <a href="about-us.html" class="light-text">About Us</a>
                            </li>
                            <li>
                                <a href="contact-us.html" class="light-text">Contact Us</a>
                            </li>
                            <li>
                                <a href="term_condition.html" class="light-text">Terms & Coditions</a>
                            </li>
                            <li>
                                <a href="careers.html" class="light-text">Careers</a>
                            </li>
                            <li>
                                <a href="blog-list.html" class="light-text">Latest Blog</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-xxl-2 col-xl-4 col-sm-6">
                        <div class="footer-title">
                            <h4 class="text-white">Useful Link</h4>
                        </div>
                        <ul class="footer-list footer-list-light footer-contact">
                            <li>
                                <a href="order-success.html" class="light-text">Your Order</a>
                            </li>
                            <li>
                                <a href="user-dashboard.html" class="light-text">Your Account</a>
                            </li>
                            <li>
                                <a href="order-tracking.html" class="light-text">Track Orders</a>
                            </li>
                            <li>
                                <a href="wishlist.html" class="light-text">Your Wishlist</a>
                            </li>
                            <li>
                                <a href="faq.html" class="light-text">FAQs</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-xxl-2 col-xl-4 col-sm-6">
                        <div class="footer-title">
                            <h4 class="text-white">Categories</h4>
                        </div>
                        <ul class="footer-list footer-list-light footer-contact">
                            <li>
                                <a href="vegetables-demo.html" class="light-text">Fresh Vegetables</a>
                            </li>
                            <li>
                                <a href="spice-demo.html" class="light-text">Hot Spice</a>
                            </li>
                            <li>
                                <a href="bags-demo.html" class="light-text">Brand New Bags</a>
                            </li>
                            <li>
                                <a href="bakery-demo.html" class="light-text">New Bakery</a>
                            </li>
                            <li>
                                <a href="grocery-demo.html" class="light-text">New Grocery</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-xxl-3 col-xl-4 col-sm-6">
                        <div class="footer-title">
                            <h4 class="text-white">Store infomation</h4>
                        </div>
                        <ul class="footer-address footer-contact">
                            <li>
                                <a href="javascript:void(0)" class="light-text">
                                    <div class="inform-box flex-start-box">
                                        <i data-feather="map-pin"></i>
                                        <p>Fastkart Demo Store, Demo store india 345 - 659</p>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)" class="light-text">
                                    <div class="inform-box">
                                        <i data-feather="phone"></i>
                                        <p>Call us: 123-456-7890</p>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)" class="light-text">
                                    <div class="inform-box">
                                        <i data-feather="mail"></i>
                                        <p>Email Us: Support@ukhandmadepottery.com</p>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)" class="light-text">
                                    <div class="inform-box">
                                        <i data-feather="printer"></i>
                                        <p>Fax: 123456</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="sub-footer sub-footer-lite section-b-space section-t-space">
                <div class="left-footer">
                    <p class="light-text">2022 Copyright By ukhandmadepottery.com</p>
                </div>

                <ul class="payment-box">
                    <li>
                        <img src="{{ asset('assets/web/images/icon/paymant/visa.png')}}" class="blur-up lazyload" alt="">
                    </li>
                    <li>
                        <img src="{{ asset('assets/web/images/icon/paymant/discover.png')}}" alt="" class="blur-up lazyload">
                    </li>
                    <li>
                        <img src="{{ asset('assets/web/images/icon/paymant/american.png')}}" alt="" class="blur-up lazyload">
                    </li>
                    <li>
                        <img src="{{ asset('assets/web/images/icon/paymant/master-card')}}.png" alt="" class="blur-up lazyload">
                    </li>
                    <li>
                        <img src="{{ asset('assets/web/images/icon/paymant/giro-pay')}}.png" alt="" class="blur-up lazyload">
                    </li>
                </ul>
            </div>
        </div>
    </footer>
    <!-- Footer End -->

    <!-- Quick View Modal Box Start -->
    <div class="modal fade theme-modal view-modal" id="view" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-sm-4 g-2">
                        <div class="col-lg-6">
                            <div class="slider-image">
                                <img src="{{ asset('assets/web/images/product/category/1.jpg')}}" class="img-fluid blur-up lazyload"
                                    alt="">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="right-sidebar-modal">
                                <h4 class="title-name">Peanut Butter Bite Premium Butter Cookies 600 g</h4>
                                <h4 class="price">$36.99</h4>
                                <div class="product-rating">
                                    <ul class="rating">
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star"></i>
                                        </li>
                                    </ul>
                                    <span class="ms-2">8 Reviews</span>
                                    <span class="ms-2 text-danger">6 sold in last 16 hours</span>
                                </div>

                                <div class="product-detail">
                                    <h4>Product Details :</h4>
                                    <p>Candy canes sugar plum tart cotton candy chupa chups sugar plum chocolate I love.
                                        Caramels marshmallow icing dessert candy canes I love soufflé I love toffee.
                                        Marshmallow pie sweet sweet roll sesame snaps tiramisu jelly bear claw. Bonbon
                                        muffin I love carrot cake sugar plum dessert bonbon.</p>
                                </div>

                                <ul class="brand-list">
                                    <li>
                                        <div class="brand-box">
                                            <h5>Brand Name:</h5>
                                            <h6>Black Forest</h6>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="brand-box">
                                            <h5>Product Code:</h5>
                                            <h6>W0690034</h6>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="brand-box">
                                            <h5>Product Type:</h5>
                                            <h6>White Cream Cake</h6>
                                        </div>
                                    </li>
                                </ul>

                                <div class="select-size">
                                    <h4>Cake Size :</h4>
                                    <select class="form-select select-form-size">
                                        <option selected>Select Size</option>
                                        <option value="1.2">1/2 KG</option>
                                        <option value="0">1 KG</option>
                                        <option value="1.5">1/5 KG</option>
                                        <option value="red">Red Roses</option>
                                        <option value="pink">With Pink Roses</option>
                                    </select>
                                </div>

                                <div class="modal-button">
                                    <button onclick="location.href = 'cart.html';"
                                        class="btn btn-md add-cart-button icon">Add
                                        To Cart</button>
                                    <button onclick="location.href = 'product-left.html';"
                                        class="btn theme-bg-color view-button icon text-white fw-bold btn-md">
                                        View More Details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick View Modal Box End -->

    <!-- Cookie Bar Box Start -->
    {{-- <div class="cookie-bar-box">
        <div class="cookie-box">
            <div class="cookie-image">
                <img src="{{ asset('assets/web/images/cookie-bar.png')}}" class="blur-up lazyload" alt="">
                <h2>Cookies!</h2>
            </div>

            <div class="cookie-contain">
                <h5 class="text-content">We use cookies to make your experience better</h5>
            </div>
        </div>

        <div class="button-group">
            <button class="btn privacy-button">Privacy Policy</button>
            <button class="btn ok-button">OK</button>
        </div>
    </div> --}}
    <!-- Cookie Bar Box End -->

    <!-- Location Modal Start -->
    <div class="modal location-modal fade theme-modal" id="locationModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Choose your Delivery Location</h5>
                    <p class="mt-1 text-content">Enter your address and we will specify the offer for your area.</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="location-list">
                        <div class="search-input">
                            <input type="search" class="form-control" placeholder="Search Your Area">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>

                        <div class="disabled-box">
                            <h6>Select a Location</h6>
                        </div>

                        <ul class="location-select custom-height">
                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Alabama</h6>
                                    <span>Min: $130</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Arizona</h6>
                                    <span>Min: $150</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>California</h6>
                                    <span>Min: $110</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Colorado</h6>
                                    <span>Min: $140</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Florida</h6>
                                    <span>Min: $160</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Georgia</h6>
                                    <span>Min: $120</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Kansas</h6>
                                    <span>Min: $170</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Minnesota</h6>
                                    <span>Min: $120</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>New York</h6>
                                    <span>Min: $110</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Washington</h6>
                                    <span>Min: $130</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Location Modal End -->

    <!-- Tap to top start -->
    <div class="theme-option">
        <div class="setting-box">
            {{-- <button class="btn setting-button">
                <i class="fa-solid fa-gear"></i>
            </button> --}}

            <div class="theme-setting-2">
                <div class="theme-box">
                    <ul>
                        <li>
                            <div class="setting-name">
                                <h4>Color</h4>
                            </div>
                            <div class="theme-setting-button color-picker">
                                <form class="form-control">
                                    <label for="colorPick" class="form-label mb-0">Theme Color</label>
                                    <input type="color" class="form-control form-control-color" id="colorPick"
                                        value="#239698" title="Choose your color">
                                </form>
                            </div>
                        </li>

                        <li>
                            <div class="setting-name">
                                <h4>Dark</h4>
                            </div>
                            <div class="theme-setting-button">
                                <button class="btn btn-2 outline" id="darkButton">Dark</button>
                                <button class="btn btn-2 unline" id="lightButton">Light</button>
                            </div>
                        </li>

                        <li>
                            <div class="setting-name">
                                <h4>RTL</h4>
                            </div>
                            <div class="theme-setting-button rtl">
                                <button class="btn btn-2 rtl-unline">LTR</button>
                                <button class="btn btn-2 rtl-outline">RTL</button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="back-to-top">
            <a id="back-to-top" href="#">
                <i class="fas fa-chevron-up"></i>
            </a>
        </div>
    </div>
    <!-- Tap to top end -->

    <!-- Bg overlay Start -->
    <div class="bg-overlay"></div>
    <!-- Bg overlay End -->



    <!-- Bootstrap js-->
    <script src="{{ asset('assets/web/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/web/js/bootstrap/bootstrap-notify.min.js')}}"></script>
    <script src="{{ asset('assets/web/js/bootstrap/popper.min.js')}}"></script>

    <!-- feather icon js-->
    <script src="{{ asset('assets/web/js/feather/feather.min.js')}}"></script>
    <script src="{{ asset('assets/web/js/feather/feather-icon.js')}}"></script>

    <!-- Lazyload Js -->
    <script src="{{ asset('assets/web/js/lazysizes.min.js')}}"></script>

    <!-- Slick js-->
    <script src="{{ asset('assets/web/js/slick/slick.js')}}"></script>
    <script src="{{ asset('assets/web/js/slick/slick-animation.min.js')}}"></script>
    <script src="{{ asset('assets/web/js/custom-slick-animated.js')}}"></script>
    <script src="{{ asset('assets/web/js/slick/custom_slick.js')}}"></script>

    <!-- Range slider js -->
    <script src="{{ asset('assets/web/js/ion.rangeSlider.min.js')}}"></script>

    <!-- Auto Height Js -->
    <script src="{{ asset('assets/web/js/auto-height.js')}}"></script>

    <!-- Lazyload Js -->
    <script src="{{ asset('assets/web/js/lazysizes.min.js')}}"></script>

    <!-- Quantity js -->
    <script src="{{ asset('assets/web/js/quantity-2.js')}}"></script>

    <!-- Fly Cart Js -->
    <script src="{{ asset('assets/web/js/fly-cart.js')}}"></script>

    <!-- Timer Js -->
    <script src="{{ asset('assets/web/js/timer.js')}}"></script>
    <script src="{{ asset('assets/web/js/timer1.js')}}"></script>

    <!-- Copy clipboard Js -->
    <script src="{{ asset('assets/web/js/clipboard.min.js')}}"></script>
    <script src="{{ asset('assets/web/js/copy-clipboard.js')}}"></script>

    <!-- WOW js -->
    <script src="{{ asset('assets/web/js/wow.min.js')}}"></script>
    <script src="{{ asset('assets/web/js/custom-wow.js')}}"></script>

    <!-- script js -->
    <script src="{{ asset('assets/web/js/script.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
           toastr.options = {
               "closeButton": true,
               "debug": false,
               "newestOnTop": false,
               "progressBar": false,
               "positionClass": "toast-bottom-right",
               "preventDuplicates": false,
               "onclick": null,
               "showDuration": "300",
               "hideDuration": "1000",
               "timeOut": "10000",
               "extendedTimeOut": "10000",
               "showEasing": "swing",
               "hideEasing": "linear",
               "showMethod": "fadeIn",
               "hideMethod": "fadeOut"
            };
            // $.notify({
            //     icon: "fa fa-check",
            //     title: "Success!",
            //     message: "Item Successfully added in wishlist",
            // });
             @if (Session::has('error'))
                 toastr.error('{{ Session::get('error') }}');
             @elseif(Session::has('success'))
                 toastr.success('{{ Session::get('success') }}');
             @endif
        });
    </script>
    <script>
        $(document).on("click", '.hide-nav-bar', function(){
            $(".canvas-close").click();
        });
        function  quickview(product_id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                  type: "POST",
                  url:"{{ route('getproductdetails')}}",
                  data: {product_id:product_id}, // serializes the form's elements.
                  beforeSend:function()
                  {},
                  success:function(responce)
                  {
                   $('#quick_view').html('');
                   $('#quick_view').html(responce);
                   },
                  error:function()
                  {
                   alert('Error');
                  },
                  complete:function()
                  {}
             });
         }
    </script>
    <script type="text/javascript">
        // Wait for the DOM to be ready
        $("#sign-up-form").validate({
            submitHandler: function(form){
                $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });
                 event.preventDefault();
                 var form_data = new FormData(document.getElementById("sign-up-form"));
                 $.ajax({
                         type: "POST",
                         url:"{{ route('saveuser') }}",
                         dataType:'json',
                         data: form_data,
                         contentType: false,
                         cache: false,
                         processData:false,
                         beforeSend:function()
                         { },
                         success:function(responce)
                         {
                            if(responce.status==1)
                           {
                               toastr.success(responce.message);
                               window.setTimeout(function() {
                                  window.location.reload();
                              }, 300);
                           }else{
                              toastr.error(responce.message);
                           }
                         },
                         error:function()
                         {
                            toastr.error('Something Went Wrong..');
                         },
                         complete:function()
                         { }
                     });
            }
       });
        $("#guest-sign-up-form").validate({
            submitHandler: function(form){
                $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });
                 event.preventDefault();
                 var form_data = new FormData(document.getElementById("guest-sign-up-form"));
                 $.ajax({
                         type: "POST",
                         url:"{{ route('saveuser') }}",
                         dataType:'json',
                         data: form_data,
                         contentType: false,
                         cache: false,
                         processData:false,
                         beforeSend:function()
                         { },
                         success:function(responce)
                         {
                            if(responce.status==1)
                           {
                               // toastr.success(responce.message);
                               $("#login-email").val($("#guest-email").val());
                               $("#login-password").val("123456");
                               $("#user-login-form").submit();
                            //   window.setTimeout(function() {
                            //       window.location.reload();
                            //   }, 300);
                           }else{
                              toastr.error(responce.message);
                           }
                         },
                         error:function()
                         {
                            toastr.error('Something Went Wrong..');
                         },
                         complete:function()
                         { }
                     });
            }
       });
    </script>
    @include('swweb.cart.cart-js');

    @yield('scripts')
</body>

</html>
