@extends('web.layout.default')
{{-- @section('pageTitle', $page_title) --}}

@section('content')

    @php
      $home_slider = DB::table('tbl_home_banner')->where('is_active', 1)->get();
      $latest_news = DB::table('tbl_latest_news')->where('is_active', 1)->limit(10)->get();
      $discover_gruni = DB::table('tbl_discover_gruni')->where('is_active', 1)->get();
      $our_podcast = DB::table('tbl_our_podcast')->where('is_active', 1)->get();
      $announcement = DB::table('tbl_announcement')->where('is_active', 1)->get();
      $school_of_medicine_course = DB::table('tbl_school_of_medicine_course')->where('is_active', 1)->get();
      $gruni_information = DB::table('tbl_gruni_information')->where('id', 1)->first();
      $testimonial = DB::table('tbl_testimonial')->where('is_active', 1)->limit(10)->get();
      $success_story = DB::table('tbl_success_story')->where('is_active', 1)->limit(10)->get();
    @endphp



      {{-- <div class="banner-area">
         <div class="hero-slider2 style2 owl-carousel owl-theme">
            @foreach($home_slider as $k=>$v)
            <div class="slider-item" style="background-image: url({{ url('uploads/home_banner/'.$v->image) }})">
               <div class="container-fluid">
                  <div class="slider-content style2">
                     <h1><a href="{{ $v->link }}" class="">{{ $v->title }}</a></h1>
                     <!--<p>{{ $v->description }}</p>-->
                     <!--<a href="{{ $v->link }}" class="default-btn btn">Start a Journey <i class="flaticon-next"></i></a>-->
                  </div>
               </div>
            </div>
            @endforeach

         </div>
      </div> --}}

      <div class="banner-area">
        <div class="hero-slider2 style2 owl-carousel owl-theme">
           @foreach($home_slider as $k=>$v)
           <div class="slider-item" style="background-image: url({{ url('uploads/home_banner/'.$v->image) }})"
                @if($loop->first) loading="eager" @else loading="lazy" @endif>
              <div class="container-fluid">
                 <div class="slider-content style2">
                    <h1><a href="{{ $v->link }}" class="">{{ $v->title }}</a></h1>
                    <!--<p>{{ $v->description }}</p>-->
                    <!--<a href="{{ $v->link }}" class="default-btn btn">Start a Journey <i class="flaticon-next"></i></a>-->
                 </div>
              </div>
           </div>
           @endforeach
        </div>
     </div>




      {{-- <div class="row video-row">
        <div class="col-md-6">
            <video controls width="300" height="600">
                <source src="your-video1.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="col-md-6">
            <video controls width="300" height="600" class="mt-6">
                <source src="your-video2.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div> --}}


      <div class="courses-area ptb-50 bg-f4f6f9">
         <div class="container">
            <div class="section-title">
               <h2>School of Medicine</h2>
               <!--<p>The main strategy of the School is to prepare doctors with progressive knowledge and practical skills who will be able to master easily the technologies developed in dentistry with the fastest speed, retain the competitiveness permanently, and consequently, assert themselves firmly in the market.</p>-->
            </div>
            <div class="courses-slider style-2 owl-carousel owl-theme">
               @foreach($school_of_medicine_course as $k=>$v)
               <div class="single-courses-card style3">
                  <div class="courses-img">
                     <a href="{{ route('web.school-of-medicine', ['id'=>$v->slug]) }}"><img src="{{ url('uploads/school-of-medicine-course/'.$v->image) }}" alt="Image" loading="lazy"></a>
                  </div>
                  <div class="courses-content">
                     <a href="{{ route('web.school-of-medicine', ['id'=>$v->slug]) }}">
                        <h3>{{ $v->course_name }}</h3>
                     </a>
                  </div>
               </div>
               @endforeach

            </div>
         </div>
      </div>
      <div class="campus-information-area ptb-50">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-lg-6 admission-content">
                  <div class="admission-image">
                  <img src="{{ asset('assets/web/images/campus-information/gruni-uni.webp')}}" alt="gruni-uni" loading="lazy">
                  <div class="icon">
                     <a class="popup-youtube play-btn" href="{{ $gruni_information->link }}"><i class="ri-play-fill"></i></a>
                  </div>
               </div>
               </div>
               <div class="col-lg-6">
                  <div class="campus-content style-2">
                     <div class="campus-title">
                        <h2>GRUNI Information</h2>
                        {{-- <p>{!! $gruni_information->description !!}</p> --}}
                        <p>
                            We establish a sophisticated academic culture and create intellectual wealth: By implementing educational programmes based on scientific achievements and orienting our activities towards the student, we will prepare generations of competent specialists for Humanitarian, Social, Administrative, Medical and other spheres of high demand</p>
                     </div>

                     <div class="counter">
                        <div class="row">
                           <div class="col-lg-4 col-4">
                              <div class="counter-card">
                                 <h1>
                                    <span class="odometer" data-count="{{ $gruni_information->y_of_experience }}">00</span>
                                    <span class="target">+</span>
                                 </h1>
                                 <p>Years Of Experience</p>
                              </div>
                           </div>
                           <div class="col-lg-4 col-4">
                              <div class="counter-card">
                                 <h1>
                                    <span class="odometer" data-count="{{ $gruni_information->global_students }}">00</span>
                                    {{-- <span class="target heading-color">k</span> --}}<span class="target">+</span>
                                 </h1>
                                 <p>Global Students</p>
                              </div>
                           </div>
                           <div class="col-lg-4 col-4">
                              <div class="counter-card">
                                 <h1>
                                    <span class="odometer" data-count="{{ $gruni_information->students_nationalities }}">00</span>
                                    <span class="target">+</span>
                                 </h1>
                                 <p>Student Nationalities</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <a href="#enquiry-form" id="enquire-btn" data-toggle="model-form" class="default-btn btn">Enquire Now<i class="flaticon-next"></i></a>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="lates-news-area ptb-50 bg-f4f6f9">
         <div class="container">
            <div class="section-title">
               <h2>Latest News</h2>
               <!--<p>Lorem ipsum dolor sit amet consectetur adipiscing elit ut elit tellus luctus nec ullamcorper mattis</p>-->
            </div>
            <div class="news-slider owl-carousel owl-theme">
               @foreach($latest_news as $k=>$v)
               <div class="single-news-card style2">
                  <div class="news-img">
                     <a href="{{ route('web.latest-news', ['id'=> $v->slug]) }}"><img src="{{ url('uploads/latest-news/'.$v->image) }}" alt="Image" loading="lazy"></a>
                  </div>
                  <div class="news-content">
                     <!--<div class="list">
                        <ul>
                           <li><i class="flaticon-user"></i>By <a href="{{ route('web.latest-news', ['id'=> $v->slug]) }}">Admin</a></li>
                        </ul>
                     </div>-->
                     <a href="{{ route('web.latest-news', ['id'=> $v->slug]) }}">
                        <h3>{{ $v->title }}</h3>
                     </a>
                     <a href="{{ route('web.latest-news', ['id'=> $v->slug]) }}" class="read-more-btn">read More<i class="flaticon-next"></i></a>
                  </div>
               </div>
               @endforeach

            </div>
         </div>
      </div>

      <div class="campus-life-area ptb-50">
         <div class="container">
            <div class="section-title">
               <h2>Discover GRUNI</h2>
               <!--<p>Lorem ipsum dolor sit amet consectetur adipiscing elit ut elit tellus luctus nec ullamcorper mattis </p>-->
            </div>
            <div class="row justify-content-center">
               @foreach($discover_gruni as $k=>$v)
               <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200" data-aos-once="true">
                  <div class="single-campus-card">
                     <div class="img">
                         @if(!empty($v->link))
                        <a href="{{ $v->link }}">
                        @else
                        <a href="{{ route('web.discover-gruni', ['id'=> $v->slug]) }}">
                        @endif
                        <img src="{{ url('uploads/discover-gruni/'.$v->image) }}" alt="Image" loading="lazy"></a>
                     </div>
                     <div class="campus-content">
                        <a href="{{ route('web.discover-gruni', ['id'=> $v->slug]) }}"><h3>{{ $v->title }}<i class="flaticon-next"></i></h3></a>
                     </div>
                  </div>
               </div>
               @endforeach

            </div>

         </div>
      </div>


      <div class="podcasts-area ptb-50 bg-f4f6f9">
         <div class="container">
            <div class="row">
               <div class="col-lg-8">
                  <div class="section-title style2">
                     <h2>Our Podcasts</h2>
                     <!--<p>Grigol Robakidze University 30 years in education service. Join us</p>-->
                  </div>
                  <div class="row">
                     @foreach($our_podcast as $k=>$v)
                     <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200" data-aos-once="true">
                        <div class="single-podcasts-card style3">
                           <div class="podcasts-image">
                              {{-- <img src="{{ url('uploads/our-podcast/'.$v->image) }}" alt="Image"> --}}
                              {{-- <a class="popup-youtube play-btn" href="{{ $v->link }}"><i class="ri-play-fill"></i></a> --}}

                              {{-- <iframe src="{{ $v->link }}" loading="lazy"  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}

                              <lite-youtube videoid="{{ $v->link }}"></lite-youtube>
                              <div class="episodes">
                                 <p>Episodes:{{ $v->episode_no }}</p>
                              </div>
                           </div>
                           <div class="podcast-content">
                              <h3>{{ $v->title }}</h3>
                              <div class="date">
                                 <p>{{ date("M d, Y", strtotime($v->created_at)) }}</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     @endforeach

                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="categories announcement style-2">
                     <h3>Announcements</h3>
                     <ul>
                        @foreach($announcement as $k=>$v)
                        <li>
                            <div class="date">
                                 <span>{{ date("d", strtotime($v->date)) }}</span>
                                 <p>{{ date("M", strtotime($v->date)) }}</p>
                            </div>
                            <div class="headlines">
                                <a href="{{ route('web.announcement', ['id'=> $v->slug]) }}">{{ $v->title }}</a>
                            </div>
                        </li>
                        @endforeach

                     </ul>
                  </div>
                  <div class="subscribe-area">
                     <div class="top-content">
                        <i class="flaticon-email"></i>
                        <h3>Subscribe To Newsletter</h3>
                        <p>Get updates to news & events</p>
                     </div>
                     <form class="newsletter-form" data-toggle="validator">
                        <input type="email" class="form-control" placeholder="Your Email" name="EMAIL"  required autocomplete="off">
                        <button class="default-btn" type="submit">
                        Subscribe
                        </button>
                        <div id="validator-newsletter" class="form-result"></div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="students-stories-area ptb-50">
         <div class="container">
            <div class="section-title">
               <h2>Student Testimonial</h2>
               <!--<p>We are a University community with high sense of social responsibility: We guarantee an educational service of high standard for training specialists and professional development in Adjara region; we will utilize the experience of academic and scientific-research activities for realizing the services oriented towards the country’s population. </p>-->
            </div>
            <div class="row justify-content-center">
               @foreach($testimonial as $k=>$v)
               <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200" data-aos-once="true">
                  <div class="single-stories-card style2">
                    {{-- <iframe src="{{ $v->link }}" title="{{ $v->title }}" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
                    <lite-youtube videoid="{{ $v->link }}" title="{{ $v->title }}"></lite-youtube>
                    <div class="stories-content">
                        <h3>{{ $v->title }}</h3>
                     </div>
                  </div>
               </div>
               @endforeach

               {{-- <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="400" data-aos-once="true">
                  <div class="single-stories-card style2">
                     <iframe src="https://www.youtube.com/embed/SRu7UiL2W7E" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                     <div class="stories-content">
                        <h3>Why I choose University And Teachers</h3>
                     </div>
                  </div>
               </div>
               <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="600" data-aos-once="true">
                  <div class="single-stories-card style2">
                     <iframe src="https://www.youtube.com/embed/yeZpJ6lJC54" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                     <div class="stories-content">
                        <h3>Why I choose Gruni Campus And Environment</h3>
                     </div>
                  </div>
               </div>
               <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="400" data-aos-once="true">
                  <div class="single-stories-card style2">
                     <iframe src="https://www.youtube.com/embed/TM9gjl-8X-E" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                     <div class="stories-content">
                        <h3>Why I choose University And Teachers</h3>
                     </div>
                  </div>
               </div> --}}
            </div>
         </div>
      </div>

      <div class="lates-news-area ptb-50 bg-f4f6f9">
         <div class="container">
            <div class="section-title">
               <h2>Success Story</h2>
               <!--<p>This success story demonstrates how We can lead by example and make a positive impact on the world. By setting a goal and taking action, GRUNI was able to achieve their vision and inspire others to do the same.</p>-->
            </div>
            <div class="news-slider owl-carousel owl-theme">
               @foreach($success_story as $k=>$v)
               <div class="single-news-card style2">
                  <div class="news-img">
                     <a href="{{ url('uploads/success-story/'.$v->image) }}"><img src="{{ url('uploads/success-story/'.$v->image) }}" alt="Image" loading="lazy"></a>
                  </div>
                  <div class="news-content">
                     <a href="{{ url('uploads/success-story/'.$v->image) }}">
                        <h3>{{ $v->name }}</h3>
                     </a>
                     <a href="{{ url('uploads/success-story/'.$v->image) }}" class="read-more-btn"><b>Score: {{ $v->score }}</b></a>
                  </div>
               </div>
               @endforeach

            </div>
         </div>
      </div>

      <div class="student-life-area ptb-50">
         <div class="container">
            <div class="section-title">
               <h2>For Indian Student</h2>
               <!--<p>Lorem ipsum dolor sit amet consectetur adipiscing elit ut elit tellus luctus nec ullamcorper mattis </p>-->
            </div>
            <div class="row">
               <div class="col-lg-6">
                  <div class="student-life-card">
                      <a href="{{ route('web.student', ['id1'=>'accommodation']) }}">
                     <img src="{{ asset('assets/web/images/stundent-life/student-life-1.webp')}}" alt="Image" loading="lazy">
                     <div class="tags">
                        <p>Accommodation</p>
                     </div>
                     </a>
                  </div>
               </div>
               <div class="col-lg-6">
                   <a href="{{ route('web.india-Food', ['id2'=>'india-food']) }}">
                  <div class="student-life-card">
                     <img src="{{ asset('assets/web/images/stundent-life/student-life-2.webp')}}" alt="Image" loading="lazy">
                     <div class="tags">
                        <p>India Food</p>
                     </div>
                  </div>
                  </a>
                  <a href="{{ route('web.health', ['id3'=>'health-wellness']) }}">
                  <div class="student-life-card">
                     <img src="{{ asset('assets/web/images/stundent-life/student-life-3.webp')}}" alt="Image" loading="lazy">
                     <div class="tags">
                        <p>Health and Wellness</p>
                     </div>
                  </div>
                  </a>
               </div>
            </div>
         </div>
      </div>


    {{-- <style>
     .enquiry-form-container {
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
}

.enquiry-form-video {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
}

.video-left {
    left: 130px;
}

.video-right {
    right: 130px;
}

.enquiry-form-fields {
    padding: 10px;
}

.modal-header {
    padding: 3px 20px !important;
}

@media (min-width: 576px) {
    .modal {
        --bs-modal-margin: -5.25rem;
    }
}

.enquiry-form-video {
        display: none;
    }

    @media (min-width: 1024px) {
        .enquiry-form-video {
            display: block;
        }
    }



.video-ad video {
    position: fixed;
    top: 167px;
    right: 20px;
    width: 40px;
    height: 260px;
    z-index: 1000;
    border: 2px solid #fff;
    border-radius: 10px;
    overflow: hidden;
    background-color: rgba(0, 0, 0, 0.8);
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
    display: none;
}

.close-btn {
    position: absolute;
    top: 144px;
    right: 14px;
    background-color: grey;
    color: white;
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    font-size: 28px;
    cursor: pointer;
    z-index: 1001;
}

@media only screen and (max-width: 768px) {
    .video-ad video {
        width: 200px;
        height: 350px;
        right: 40px;
        bottom: 10px;
        display: block;
    }
}

@media only screen and (max-width: 480px) {
    .video-ad video {
        width: 150px;
        height: 260px;
        right: 35px;
        bottom: 5px;
        display: block;
    }
}


</style>  --}}


{{-- <div class="modal fade" id="enquiry-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 50px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="padding-top: 85px;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enquiry Form</h5>
        <button type="button" class="close modal-close btn btn-primary" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> --}}

        {{-- <form class="model-form row" action="{{route('web.save-enquiry')}}" method="post" enctype="multipart/form-data" id="enquiry-form">
            @csrf
            <div class="form-group col-12 form-group enquiry-form-fields">
                <img src="https://edugaaydsoverseas.com/web-assets/images/enquiry-form-img.jpg" alt="Image" style="border-radius: 5px;">
            </div>
            <div class="form-group col-6 form-group enquiry-form-fields">
                <input type="text" placeholder="Full Name *" class="form-control" name="name" id="name1" value="{{ old('name') }}" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" required maxlength="255">
                @error('name')
                    <div>{{$message}}</div>
                @enderror
            </div>
            <div class="form-group col-6 form-group enquiry-form-fields">
                <input type="email" placeholder="Email Address*" class="form-control" name="email" id="email" value="{{ old('email') }}" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                @error('email')
                    <div>{{$message}}</div>
                @enderror
            </div>
            <div class="form-group col-6 form-group enquiry-form-fields">
                <input type="tel" placeholder="Phone No. *" class="form-control" name="mobile" id="mobile" value="{{ old('mobile') }}" required>
                @error('mobile')
                    <div>{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-6 form-group enquiry-form-fields">
                <input type="number" placeholder="2023 Marks" class="form-control" name="admission_city" id="admission" required>
            </div>
            <div class="form-group col-12 enquiry-form-fields">
                <textarea placeholder="Message *" class="form-control message" name="message" id="message1"></textarea>
            </div>
        </form> --}}

        {{-- <div id="video-ad" class="video-ad">
            <button class="close-btn" onclick="closeAd()">×</button>
            <a href="https://gruni.edu.ge/">
            <video width="100%" height="auto" autoplay loop muted>
                <source src="{{ asset('videos/videotry.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </a>
        </div>


        <div class="modal fade" id="enquiry-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 50px;">
            <div class="enquiry-form-container">
                <!-- Left Video -->
                <div class="enquiry-form-video video-left">
                    <a href="https://gruni.edu.ge/">
                    <video id="videoLeft" autoplay loop muted playsinline width="300" height="600">
                        <source src="{{ asset('videos/videotry.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </a>
                </div>

                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="padding-top: 85px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Enquiry Form</h5>
                            <button type="button" class="close modal-close btn btn-primary" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="model-form row" action="{{route('web.save-enquiry')}}" method="post" enctype="multipart/form-data" id="enquiry-form">
                                @csrf
                                <!-- Form Fields -->
                                <div class="form-group col-12 form-group enquiry-form-fields">
                                    <img src="https://edugaaydsoverseas.com/web-assets/images/enquiry-form-img.jpg" alt="Image" style="border-radius: 5px;" loading="lazy">
                                </div>
                                <div class="form-group col-6 form-group enquiry-form-fields">
                                    <input type="text" placeholder="Full Name *" class="form-control" name="name" id="name1" value="{{ old('name') }}" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" required maxlength="255">
                                    @error('name')
                                        <div>{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-6 form-group enquiry-form-fields">
                                    <input type="email" placeholder="Email Address*" class="form-control" name="email" id="email" value="{{ old('email') }}" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                                    @error('email')
                                        <div>{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-6 form-group enquiry-form-fields">
                                    <input type="tel" placeholder="Phone No. *" class="form-control" name="mobile" id="mobile" value="{{ old('mobile') }}" required>
                                    @error('mobile')
                                        <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-6 form-group enquiry-form-fields">
                                    <input type="number" placeholder="2023 Marks" class="form-control" name="admission_city" id="admission" required>
                                </div>
                                <div class="form-group col-12 enquiry-form-fields">
                                    <textarea placeholder="Message *" class="form-control message" name="message" id="message1"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary modal-close" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" form="enquiry-form">Send Enquiry</button>
                        </div>
                    </div>
                </div>

                <!-- Right Video -->
                <div class="enquiry-form-video video-right">
                    <a href="https://gruni.edu.ge/">
                    <video id="videoRight" autoplay loop muted playsinline width="300" height="600">
                        <source src="{{ asset('videos/videotry.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </a>
                </div>
            </div>
        </div>


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

        <script>function closeAd() {
            document.getElementById('video-ad').style.display = 'none';
        }
        </script>
        <script>
            const mobileInput = document.querySelector("#mobile");

            const iti = window.intlTelInput(mobileInput, {
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
            });

            document.getElementById('enquiry-form').addEventListener('submit', function(event) {
                if (!iti.isValidNumber()) {
                    alert('Please enter a valid phone number.');
                    event.preventDefault(); // Prevent form submission
                    mobileInput.focus();
                } else {
                    alert('Your enquiry has been submitted successfully!');
                }
            });
        </script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var videoLeft = document.getElementById('videoLeft');
        var videoRight = document.getElementById('videoRight');


        videoLeft.play().catch(function(error) {
            console.log("Video on the left couldn't autoplay, muting and trying again.");
            videoLeft.muted = true;
            videoLeft.play();
        });

        videoRight.play().catch(function(error) {
            console.log("Video on the right couldn't autoplay, muting and trying again.");
            videoRight.muted = true;
            videoRight.play();
        });
    });
</script>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

{{-- <script>
    $(document).on('click', '.modal-close', function() {
        $("#enquiry-Modal").modal('hide');
    });

    $(document).ready(function(){
        // Delay the modal by 10 seconds (10000 milliseconds)
        setTimeout(function(){
            $("#enquiry-Modal").modal('show');
        }, 10000);

        // Additional check to ensure videos are loaded and displayed
        $('#enquiry-Modal').on('shown.bs.modal', function () {
            // This will trigger when the modal is fully shown
            console.log('Modal is shown, adjusting videos');

            // Adjusting video layout if necessary
            $('.enquiry-form-video').each(function() {
                $(this).css('visibility', 'visible'); // Make sure videos are visible
            });
        });

        $("#enquire-btn, #enquiry-link").click(function(){
            $("#enquiry-Modal").modal('show');
        });
    });
</script> --}}


@endsection

@section('scripts')

@endsection
