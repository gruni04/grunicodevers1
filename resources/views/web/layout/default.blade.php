<!DOCTYPE html>

<html lang="zxx">

   <head>

      <meta charset="UTF-8">

      <meta http-equiv="X-UA-Compatible" content="IE=edge">

	   {{-- <title>@yield('pageTitle','GRUNI INDIA') | GRUNI INDIA - gruni.co.in</title> --}}
       <title>Advance Your Medical Career with GRUNI | MBBS, MD, & Research Opportunities</title>

      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <meta name="description" content="GRUNI is a leader in medical education, offering MBBS and MD programs with a focus on clinical training and cutting-edge technology. Discover a career in healthcare and contribute to global medical research.">

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

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>

      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lite-youtube-embed/src/lite-yt-embed.css">

      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


<script src="https://cdn.jsdelivr.net/npm/lite-youtube-embed/src/lite-yt-embed.js" defer></script>


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

   <style>
    .custom-navbar {
   /* Ensure it stays above other content */
    transition: top 0.3s; /* Smooth transition */
}

.navbar-hidden {
    top: -70px; /* Adjust this value based on your navbar height */
}

/* .video-row {
    margin-top: 2rem;
    margin-bottom: 2rem;
    margin-left: 2rem;
    margin-right: 2rem;
} */

.btn-whatsapp-pulse {
	background: #25d366;
	color: white;
	position: fixed;
	bottom: 20px;
	left: 20px;
	font-size: 40px;
	display: flex;
	justify-content: center;
	align-items: center;
	width: 0;
	height: 0;
	padding: 30px;
	text-decoration: none;
	border-radius: 50%;
	animation-name: pulse;
	animation-duration: 1.5s;
	animation-timing-function: ease-out;
	animation-iteration-count: infinite;
    z-index: 10;
}

@keyframes pulse {
	0% {
		box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.5);
	}
	80% {
		box-shadow: 0 0 0 14px rgba(37, 211, 102, 0);
	}
}

        #myBtn {
  position: fixed; /* Fixed/sticky position */
  bottom: 19px; /* Place the button at the bottom of the page */
  right: 28px; /* Place the button 30px from the right */
  z-index: 99; /* Make sure it does not overlap */
  border: none; /* Remove borders */
  outline: none; /* Remove outline */
  background-color: #c31313;
  color: white; /* Text color */
  cursor: pointer; /* Add a mouse pointer on hover */
  padding: 13px; /* Some padding */
  border-radius: 74px; /* Rounded corners */
  font-size: 18px; /* Increase font size */
}

#myBtn:hover {
  background-color: #dca7a7; /* Add a dark-grey background on hover */
}

.alert-button {
    display: inline-block;
    padding: 8px 16px;
    background-color: #ff4d4d;
    color: rgb(57, 48, 48);
    font-weight: bold;
    font-size: 12px;
    text-decoration: none;
    border-radius: 20px;
    animation: flash 1.5s infinite;
    transition: background-color 0.5s ease;
}

.alert-button:hover {
    background-color: #fdfdfd;
    color:rgb(0, 0, 0)
}

@keyframes flash {
    0% { background-color: #ff4d4d; }
    50% { background-color: #f1950c; }
    100% { background-color: #f9f103; }
}

/* Chatbot Icon */
/* Chatbot Button */
.chatbot {
    position: fixed;
    bottom: 100px;
    right: 20px;
    background-color: #1B285E;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    z-index: 99;
}

.chatbot-icon img {
    width: 30px;
    height: 30px;
}

/* Chatbot Container (hidden by default) */
.chatbot-container {
    position: fixed;
    bottom: 100px;
    right: 30px;
    width: 350px;
    height: 500px;
    border-radius: 20px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    display: flex;
    flex-direction: column;
    background-color: #ffffff;
    font-family: 'Roboto', sans-serif;
    overflow: hidden;
    z-index: 99;
}

/* Chatbot Header */
.chatbot-header {
    background-color: #1B285E; /* Medical blue */
    color: #ffffff;
    padding: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
}

.chatbot-avatar img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
}

.chatbot-header h2 {
    margin: 0;
    font-size: 1.2em;
    font-size: 2.1em;
    font-weight: 700;
    color: beige;
    padding-top: 2px;
}

.close-chat {
    background: none;
    border: none;
    font-size: 24px;
    color: #ffffff;
    cursor: pointer;
}

/* Chat Window */
.chat-window {
    flex-grow: 1;
    padding: 15px;
    background: #F5F5F5;
    overflow-y: auto;
    background: url('{{ asset('assets/web/images/chatbot-background.webp')}}') no-repeat center center; /* Add your medical background image here */
    background-size: cover; /* Make sure the image covers the window */
    position: relative; /* Needed for the semi-transparent background */
    z-index: 1;
}

/* Semi-transparent background to improve text readability */
.message-container {
    background: rgba(255, 255, 255, 0.85); /* A semi-transparent white background for better text readability */
    padding: 15px;
    border-radius: 10px;
}

/* Chat Footer */
.chat-footer {
    display: flex;
    align-items: center;
    padding: 10px;
    background-color: #ffffff;
    border-top: 1px solid #E5E5E5;
}

#chat-input {
    flex-grow: 1;
    border: none;
    padding: 10px;
    border-radius: 20px;
    background-color: #F5F5F5;
    outline: none;
}

#send-btn, #mic-btn {
    background: none;
    border: none;
    margin-left: 10px;
    font-size: 24px;
    color: #1B285E;
    cursor: pointer;
}

#send-btn:hover, #mic-btn:hover {
    color: #0d132f;
}


        </style>

   <body>

      {{-- <div class="btn-whatsapp-pulse"><a href="https://wa.link/d1cndg" target="_blank">
        <div class="contact_icon">
            <i class="fab fa-whatsapp"></i>
        </div>

        </a></div> --}}

       <div> <a href="https://wa.me/916239311536" class="btn-whatsapp-pulse">
            <i class="fab fa-whatsapp"></i>
        </a>
       </div>

      <div class="top-header-area">

         <div class="container-fluid">

            <div class="row align-items-center">

               <div class="col-lg-6 col-md-6">

                  <div class="header-left-content">

                    <p>
                        MBBS Admission Open For 2024-25 - "Winter/Fall Intake"
                        <a href="#" id="enquiry-link" class="alert-button">CLICK NOW</a>
                    </p>

                  </div>

               </div>

               <div class="col-lg-6 col-md-6">

                  <div class="header-right-content">

                     <div class="list">



                        <ul>

                            <li><a href="{{ url('associate-parter') }}"> <p style="color:#ffffff;">Associate Partner</p></a></li>

                           <li><a href="tel:+916239311536"><i class="fas fa-thin fa-phone" style="margin-right: 0.5rem;"></i>+91 6239311536</a></li>

                           <li><a href="tel:+919266215076"><i class="fas fa-thin fa-phone" style="margin-right: 0.5rem;"></i>+91 9266215076</a></li>

                         <!--   <li><a href="tel:+919019963183">+91 9019 9631 83</a></li>
                           <li><a href="tel:+918762963210">+91 8762 9632 10</a></li> -->

                           <!--<li><a href="campus-life.html">Faculty & Staff</a></li>-->

                           <!--<li><a href="admission.html">Visitors</a></li>-->

                           <!--<li><a href="academics.html">Academics</a></li>-->

                           <!--<li><a href="alumni.html">Alumni</a></li>-->

                           <li><a href="{{ url('login') }}">Login</a></li>
                           <li><a href="#" id="enquiry-link">Enquire Now</a></li>

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

                  <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">

                     <ul class="navbar-nav ms-auto">

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

                        <li class="nav-item"><a href="{{ route('web.gallery') }}" class="nav-link">Gallery</a></li>

                     </ul>



                  </div>

               </nav>

            </div>

         </div>

         <div class="others-option-for-responsive">

            <div class="container">

               <div class="dot-menu">

                  <div class="inner">

                     {{-- <div class="icon">

                        <i class="ri-menu-3-fill" data-bs-toggle="modal" data-bs-target="#sidebarModal"></i>

                     </div> --}}

                  </div>

               </div>

            </div>

         </div>

      </div>
      <style>
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
        left: 130px; /* Adjust this value based on your layout */
    }

    .video-right {
        right: 130px; /* Adjust this value based on your layout */
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



    .video-ad video{
        position: fixed;
        top: 167px; /* Changed from bottom to top */
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
        position: fixed;
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

    @media only screen and (min-width: 769px) {
    .close-btn {
        display: none;
    }
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


    </style>

<div id="video-ad" class="video-ad" style="display: none;">
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
                            <img src="{{ asset('assets\web\images\enquiry-form\images.jpg')}}" alt="Image" style="border-radius: 5px; width: 100%" loading="lazy">
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
                            <input type="tel" placeholder="Phone No. *" class="form-control" name="mobile" id="mobile" value="{{ old('mobile') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="15" minlength="8" required>
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

{{-- CHATBOT --}}

<!-- Chatbot Button -->
<div class="chatbot" onclick="toggleChat()">
    <div class="chatbot-icon">
        <img src="{{ asset('assets/web/images/chatbot.webp')}}" alt="Chatbot Icon" />
    </div>
</div>

<!-- Chatbot Window -->
<div class="chatbot-container" id="chatWindow" style="display: none;">
    <!-- Chatbot Header -->
    <div class="chatbot-header">
        <div class="chatbot-avatar">
            <img src="{{ asset('assets/web/images/favicon.png')}}" alt="Gruni Health Assistant Logo">
        </div>
        <h2>Gruni Assistant</h2>
        <button class="close-chat" onclick="toggleChat()">×</button>
    </div>

    <!-- Chat Window -->
    <div class="chat-window">
        <div class="message-container">
            <!-- Chatbot message -->
            <div class="chat-message chatbot-message">
                <div class="message-content">Hello! How can I assist you today?</div>
            </div>
        </div>
    </div>

    <!-- Footer with input -->
    <div class="chat-footer">
        <input type="text" id="chat-input" placeholder="Type your message here...">
        <button id="send-btn">
            <i class="material-icons">send</i>
        </button>
         <button id="mic-btn">
            <i class="material-icons">mic</i>
        </button>
    </div>
</div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

        <script>
            setTimeout(function() {
                    document.getElementById('video-ad').style.display = 'block';
                        }, 10000);
        function closeAd() {
            document.getElementById('video-ad').style.display = 'none';
        }
        </script>
        <script>
            const mobileInput = document.querySelector("#mobile");

            const iti = window.intlTelInput(mobileInput, {
                initialCountry: "in",
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

        // Attempt to play the videos
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

      </div>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary modal-close" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="enquiry-form">Send Enquiry</button>
      </div> --}}
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script>
    // $(document).ready(function(){

    //        $("#enquiry-Modal").modal('show');

    // });

    $(document).on('click', '.modal-close', function(){

        $("#enquiry-Modal").modal('hide');
    });

    $(document).ready(function(){
        // Delay the modal by 10 seconds (10000 milliseconds)
        setTimeout(function(){
            $("#enquiry-Modal").modal('show');
        }, 10000);
        $("#enquire-btn").click(function(){
            $("#enquiry-Modal").modal('show');
        })
        $("#enquiry-link").click(function(){
            $("#enquiry-Modal").modal('show');
        })
    });


</script> --}}

<script>
    $(document).on('click', '.modal-close', function() {
        $("#enquiry-Modal").modal('hide');
    });

    $(document).ready(function(){
        // Delay the modal by 10 seconds (10000 milliseconds)
        setTimeout(function(){
            $("#enquiry-Modal").modal('show');
        }, 30000);

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
</script>



      @yield('content')







      <div class="footer-area pt-100 pb-70">

         <div class="container">

            <div class="row">

               <div class="col-lg-4 col-sm-6">

                  <div class="footer-logo-area">

                     <a href="index.html"><img src="{{ asset('assets/web/images/white-logo.png')}}" alt="Image"></a>

                     {{-- <p>GRUNI University was established by J.H Merthon in 1810 for the public benefit. Afterwards, it is recognized globally</p> --}}

                     <div class="contact-list">

                        <ul>
                           <li><a href="tel:+916239311536"><i class="fas fa-thin fa-phone" style="margin-right: 0.5rem;"></i>+91 6239311536</a></li>

                           <li><a href="tel:+919266215076"><i class="fas fa-thin fa-phone" style="margin-right: 0.5rem;"></i>+91 9266215076</a></li>

                           <!-- <li><a href="tel:+919310134887">+91 9310 1348 87</a></li>

                           <li><a href="tel:+916239311536">+91 6239 3115 36</a></li>

                           <li><a href="tel:+919019963183">+91 9019 9631 83</a></li>
                           <li><a href="tel:+918762963210">+91 8762 9632 10</a></li> -->

                           <li><a href="mailto:info@gruni.co.in"><i class="fas fa-envelope" style="margin-right: 0.5rem;"></i>info@gruni.co.in</a></li>
                           <li><a href="mailto:gruniindia@gmail.com"><i class="fas fa-envelope" style="margin-right: 0.5rem;"></i>gruniindia@gmail.com</a></li>

                        </ul>

                     </div>

                  </div>

               </div>

               <div class="col-lg-3 col-sm-6">

                  <div class="footer-widjet">

                     <h3><a href="{{ route('web.campus_life') }}" style="color: white">Campus Life</a></h3>

                     <div class="list">

                        <ul>

                            <li><a href="{{ route('web.campus_life') }}#accessibility">Accessibility</a></li>
                            <li><a href="{{ route('web.campus_life') }}#financial">Financial Aid</a></li>
                            <li><a href="{{ route('web.campus_life') }}#food">Food Services</a></li>
                            <li><a href="{{ route('web.campus_life') }}#housing">Housing</a></li>
                            <li><a href="{{ route('web.campus_life') }}#information">Information Technologies</a></li>
                            <li><a href="{{ route('web.campus_life') }}#student">Student Life</a></li>


                        </ul>

                     </div>

                  </div>

               </div>

               <div class="col-lg-3 col-sm-6">

                  <div class="footer-widjet">

                     <h3><a href="{{ route('web.our_campus') }}" style="color: white">Our Campus</a></h3>

                     <div class="list">

                        <ul>

                           <li><a href="{{ route('web.our_campus') }}#academic">Acedemic</a></li>

                           <li><a href="{{ route('web.our_campus') }}#planning" >Planning & Administration</a></li>

                           <li><a href="{{ route('web.our_campus') }}#safety">Campus Safety</a></li>

                           <li><a href="{{ route('web.our_campus') }}#office">Office of the Chancellor</a></li>

                           <li><a href="{{ route('web.our_campus') }}#facility">Facility Services</a></li>

                           <li><a href="{{ route('web.our_campus') }}#hr">Human Resources</a></li>

                        </ul>

                     </div>

                  </div>

               </div>

               <div class="col-lg-2 col-sm-6">

                  <div class="footer-widjet">

                     <h3><a href="{{ route('web.academics') }}" style="color: white">Academics</a></h3>

                     <div class="list">

                        <ul>

                            <li><a href="{{ route('web.academics') }}#canvas">Canvas</a></li>
                            <li><a href="{{ route('web.academics') }}#catalyst">Catalyst</a></li>
                            <li><a href="{{ route('web.academics') }}#library">Library</a></li>
                            <li><a href="{{ route('web.academics') }}#time">Time Schedule</a></li>
                            <li><a href="{{ route('web.academics') }}#apply">Apply For Admissions</a></li>
                            <li><a href="{{ route('web.academics') }}#pay">Pay My Tuition</a></li>

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

                              <a href="https://www.facebook.com/share/njnugrTWFvCa4aUV/?mibextid=LQQJ4d" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>

                           </li>

                           {{-- <li>

                              <a href="https://www.twitter.com/" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>

                           </li> --}}

                           <li>

                              <a href="https://www.instagram.com/gruni.co.in?igsh=MTRyMmIyZHR2bDB5dQ%3D%3D&utm_source=qr" target="_blank"><i class="fa-brands fa-instagram"></i></a>

                           </li>

                           <li>

                              <a href="https://linkedin.com/?lang=en" target="_blank"><i class="fa-brands fa-linkedin"></i></a>

                           </li>

                        </ul>

                     </div>

                  </div>

                  <div class="col-lg-6 col-md-8">

                     <div class="copy">

                        <p>© Copyright <span id="currentYear"></span> by GRUNI & Website developed by <a href="https://mutagen.in" target="_blank">Mutagen</a></p>

                     </div>

                  </div>

               </div>

            </div>

         </div>

      </div>

      {{-- <div class="go-top">

         <i class="ri-arrow-up-s-line"></i>

         <i class="ri-arrow-up-s-line"></i>

      </div> --}}

      <button onclick="topFunction()" id="myBtn" title="Go to top"> <i class="ri-arrow-up-s-line"></i</button>

      <script>let mybutton = document.getElementById("myBtn");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
          if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
          } else {
            mybutton.style.display = "none";
          }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
          document.body.scrollTop = 0; // For Safari
          document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        }</script>



      <script>
        document.getElementById("currentYear").textContent = new Date().getFullYear();
      </script>

      <script>
      // Show/hide chatbot window
     function toggleChat() {
    const chatWindow = document.getElementById('chatWindow');
    if (chatWindow.style.display === 'none' || chatWindow.style.display === '') {
        chatWindow.style.display = 'flex';
    } else {
        chatWindow.style.display = 'none';
    }
}

const chatInput = document.getElementById('chat-input');
const sendBtn = document.getElementById('send-btn');
const messageContainer = document.querySelector('.message-container');

// Function to add user message
function addUserMessage(content) {
    const messageElement = document.createElement('div');
    messageElement.classList.add('chat-message', 'user-message');
    messageElement.innerHTML = `<div class="message-content">${content}</div>`;
    messageContainer.appendChild(messageElement);
    scrollToBottom();
}

// Function to add chatbot response
function addChatbotMessage(content) {
    const messageElement = document.createElement('div');
    messageElement.classList.add('chat-message', 'chatbot-message');
    messageElement.innerHTML = `<div class="message-content">${content}</div>`;
    messageContainer.appendChild(messageElement);
    scrollToBottom();
}

// Function to handle sending message
sendBtn.addEventListener('click', () => {
    const message = chatInput.value;
    if (message.trim()) {
        addUserMessage(message);
        chatInput.value = '';
        setTimeout(() => {
            addChatbotMessage('I will check that information for you!');
        }, 1000);
    }
});

// Scroll chat window to bottom
function scrollToBottom() {
    const chatWindow = document.querySelector('.chat-window');
    chatWindow.scrollTop = chatWindow.scrollHeight;
}



        </script>



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
