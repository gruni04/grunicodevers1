<!DOCTYPE html>
<html lang="zxx">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
	   <title>@yield('pageTitle','GRUNI INDIA') | GRUNI INDIA - gruni.co.in</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="{{ asset('assets/web/css/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/web/css/meanmenu.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/web/css/owl.carousel.min.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/web/css/owl.theme.default.min.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/web/css/magnific-popup.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/web/css/flaticon.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/web/css/remixicon.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/web/css/odometer.min.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/web/css/aos.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/web/css/style.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/web/css/dark.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/web/css/responsive.css')}}">
      <link rel="icon" type="image/png" href="{{ asset('assets/web/images/favicon.png')}}">

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
   <body>

      <div class="top-header-area">
         <div class="container-fluid">
            <div class="row align-items-center">
               <div class="col-lg-6 col-md-6">
                  <div class="header-left-content">
                     <p>Get the latest updates and GRUNI's response to COVID-19</p>
                  </div>
               </div>
               <div class="col-lg-6 col-md-6">
                  <div class="header-right-content">
                     <div class="list">
                        <ul>
                           <!--<li><a href="graduate-admission.html">Students</a></li>-->
                           <!--<li><a href="campus-life.html">Faculty & Staff</a></li>-->
                           <!--<li><a href="admission.html">Visitors</a></li>-->
                           <!--<li><a href="academics.html">Academics</a></li>-->
                           <!--<li><a href="alumni.html">Alumni</a></li>-->
                           <li><a href="{{ url('login') }}">Login</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="navbar-area nav-bg-2">
         <div class="mobile-responsive-nav">
            <div class="container">
               <div class="mobile-responsive-menu">
                  <div class="logo">
                     <a href="index-3.html">
                     <img src="{{ asset('assets/web/images/logo.png')}}" class="main-logo" lt="logo">
                     <img src="{{ asset('assets/web/images/white-logo.png')}}" class="white-logo" alt="logo">
                     </a>
                  </div>
               </div>
            </div>
         </div>
         @php
            $university_cateogry = DB::table('tbl_university_cateogry')->where('is_active', 1)->get();
            $admission_cateogry = DB::table('tbl_admission_cateogry')->where('is_active', 1)->get();
            $teaching_cateogry = DB::table('tbl_teaching_cateogry')->where('is_active', 1)->get();
         @endphp
         <div class="desktop-nav">
            <div class="container-fluid">
               <nav class="navbar navbar-expand-md navbar-light">
                  <a class="navbar-brand" href="{{ url('/') }}">
                  <img src="{{ asset('assets/web/images/logo.png')}}" class="main-logo" alt="logo">
                  <img src="{{ asset('assets/web/images/white-logo.png')}}" class="white-logo" alt="logo">
                  </a>
                  <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent" >
                     <ul class="navbar-nav ms-auto" style="display:none;">
                        {{-- <li class="nav-item"><a href="#" class="nav-link dropdown-toggle">University</a></li> --}}
                        <li class="nav-item"><a href="#" class="nav-link dropdown-toggle">University</a>
                           <ul class="dropdown-menu">
                              @foreach($university_cateogry as $k=>$v)
                              <li class="nav-item"><a href="{{ route('web.university', ['id'=>$v->slug]) }}" class="nav-link">{{ $v->category }}</a></li>
                              @endforeach
                           </ul>
                        </li>
                        <li class="nav-item"><a href="#" class="nav-link dropdown-toggle">Learning-Teaching</a>
                           <ul class="dropdown-menu">
                              @foreach($teaching_cateogry as $k=>$v)
                              <li class="nav-item"><a href="{{ route('web.learning-teaching', ['id'=>$v->slug]) }}" class="nav-link">{{ $v->category }}</a></li>
                              @endforeach
                           </ul>
                        </li>
                        <li class="nav-item"><a href="#" class="nav-link dropdown-toggle">Admission</a>
                           <ul class="dropdown-menu">
                              @foreach($admission_cateogry as $k=>$v)
                              <li class="nav-item"><a href="{{ route('web.admission', ['id'=>$v->slug]) }}" class="nav-link">{{ $v->category }}</a></li>
                              @endforeach
                           </ul>
                        </li>
                        <li class="nav-item"><a href="{{ route('web.latest-news-list') }}" class="nav-link">News &amp; Event</a></li>
                        <li class="nav-item"><a href="#" class="nav-link dropdown-toggle">Success Story</a>
                           <ul class="dropdown-menu">
                              <li class="nav-item"><a href="{{ route('web.testimonial') }}" class="nav-link">Testimonial</a></li>
                              <li class="nav-item"><a href="{{ route('web.success-story') }}" class="nav-link">Result</a></li>

                           </ul>
                        </li>
                     </ul>

                  </div>
               </nav>
            </div>
         </div>
         <div class="others-option-for-responsive">
            <div class="container">
               <div class="dot-menu">
                  <div class="inner">
                     <div class="icon">
                        <i class="ri-menu-3-fill" data-bs-toggle="modal" data-bs-target="#sidebarModal"></i>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      @yield('content')



      <div class="footer-area pt-100 pb-70">
         <div class="container">
            <div class="row">
               <div class="col-lg-4 col-sm-6">
                  <div class="footer-logo-area">
                     <a href="index.html"><img src="{{ asset('assets/web/images/white-logo.png')}}" alt="Image"></a>
                     <p>GRUNI University was established by J.H Merthon in 1810 for the public benefit. Afterwards, it is recognized globally</p>
                     <div class="contact-list">
                        <ul>
                           <li><a href="tel:+01987655567685">+01-9876-5556-7685
                              </a>
                           </li>
                           <li><a href="#"><span class="__cf_email__" data-cfemail="f8999c959196b88b99968dd69d9c8d">[email&#160;protected]</span></a></li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="col-lg-3 col-sm-6">
                  <div class="footer-widjet">
                     <h3>Campus Life</h3>
                     <div class="list">
                        <ul>
                           <li><a href="campus-life.html">Accessibility</a></li>
                           <li><a href="campus-life.html">Financial Aid</a></li>
                           <li><a href="campus-life.html">Food Services</a></li>
                           <li><a href="campus-life.html">Housing</a></li>
                           <li><a href="campus-life.html">Information Technologies</a></li>
                           <li><a href="campus-life.html">Student Life</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="col-lg-3 col-sm-6">
                  <div class="footer-widjet">
                     <h3>Our Campus</h3>
                     <div class="list">
                        <ul>
                           <li><a href="campus-life.html">Acedemic</a></li>
                           <li><a href="campus-life.html">Planning & Administration</a></li>
                           <li><a href="campus-life.html">Campus Safety</a></li>
                           <li><a href="campus-life.html">Office of the Chancellor</a></li>
                           <li><a href="campus-life.html">Facility Services</a></li>
                           <li><a href="campus-life.html">Human Resources</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="col-lg-2 col-sm-6">
                  <div class="footer-widjet">
                     <h3>Academics</h3>
                     <div class="list">
                        <ul>
                           <li><a href="academics.html">Canvas</a></li>
                           <li><a href="academics.html">Catalyst</a></li>
                           <li><a href="academics.html">Library</a></li>
                           <li><a href="academics.html">Time Schedule</a></li>
                           <li><a href="academics.html">Apply For Admissions</a></li>
                           <li><a href="academics.html">Pay My Tuition</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="shape">
               <img src="{{ asset('assets/web/images/shape-1.png')}}" alt="Image">
            </div>
         </div>
      </div>
      <div class="copyright-area">
         <div class="container">
            <div class="copyright">
               <div class="row">
                  <div class="col-lg-6 col-md-4">
                     <div class="social-content">
                        <ul>
                           <li><span>Follow Us On</span></li>
                           <li>
                              <a href="https://www.facebook.com/" target="_blank"><i class="ri-facebook-fill"></i></a>
                           </li>
                           <li>
                              <a href="https://www.twitter.com/" target="_blank"><i class="ri-twitter-fill"></i></a>
                           </li>
                           <li>
                              <a href="https://instagram.com/?lang=en" target="_blank"><i class="ri-instagram-line"></i></a>
                           </li>
                           <li>
                              <a href="https://linkedin.com/?lang=en" target="_blank"><i class="ri-linkedin-fill"></i></a>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-lg-6 col-md-8">
                     <div class="copy">
                        <p>© Copyright 2023 by GRUNI & Website developed by <a href="https://mutagen.in" target="_blank">Mutagen</a></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="go-top">
         <i class="ri-arrow-up-s-line"></i>
         <i class="ri-arrow-up-s-line"></i>
      </div>

      <script src="{{ asset('assets/web/js/jquery.min.js')}}"></script>
      <script src="{{ asset('assets/web/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{ asset('assets/web/js/jquery.meanmenu.js')}}"></script>
      <script src="{{ asset('assets/web/js/owl.carousel.min.js')}}"></script>
      <script src="{{ asset('assets/web/js/carousel-thumbs.min.js')}}"></script>
      <script src="{{ asset('assets/web/js/jquery.magnific-popup.js')}}"></script>
      <script src="{{ asset('assets/web/js/aos.js')}}"></script>
      <script src="{{ asset('assets/web/js/odometer.min.js')}}"></script>
      <script src="{{ asset('assets/web/js/appear.min.js')}}"></script>
      <script src="{{ asset('assets/web/js/form-validator.min.js')}}"></script>
      <script src="{{ asset('assets/web/js/contact-form-script.js')}}"></script>
      <script src="{{ asset('assets/web/js/ajaxchimp.min.js')}}"></script>
      <script src="{{ asset('assets/web/js/custom.js')}}"></script>
   </body>
</html>
