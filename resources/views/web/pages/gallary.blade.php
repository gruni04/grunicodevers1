@extends('web.layout.default')
@section('pageTitle', 'Gallery')
@section('content')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
<!-- Include Swiper CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

<style>
    .gruni-gallery-section {
        padding: 5px 0;
    }

    .gruni-gallery-section h3 {
        padding-left: 50px;
        color: #2c3e50; /* Enhances the heading's look */
        font-weight: bold;
    }

    /* Other Slider Styles */
    #other-slider {
        margin-top: 50px; /* Adjust as needed */
        position: relative; /* Position for buttons */
    }

    #other-slider .swiper-slide {
        background-color: #1b285ed2; /* Customize as needed */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 300px; /* Adjust as needed */
        border-radius: 60px; /* Smooth corners for images */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.056); /* Soft shadow */
    }

    /* Navigation Buttons */
    .swiper-button-next,
    .swiper-button-prev {
        color: white;
        font-weight: 1000; /* Custom color for buttons */
    }

    /* Adjust button visibility and size for better UX */
    @media (min-width: 992px) { /* Only visible on laptops */
        .swiper-button-next,
        .swiper-button-prev {
            display: block;
            width: 40px;
            height: 0px;
            background: rgba(255, 255, 255, 0.8); /* Subtle background for buttons */
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: background 0.3s;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: rgba(255, 255, 255, 1);
        }
    }

    /* Hide buttons on mobile devices */
    @media (max-width: 991px) {
        .swiper-button-next,
        .swiper-button-prev {
            display: none;
        }
    }

    #other-slider .swiper-slide img {
    width: 400px;          /* Set width to 80% of the container */
    height: 250px;         /* Set height to 80% of the container */
    border-radius: 60px; /* Set border radius */
    object-fit: cover;   /* Ensures the image fits within its container without stretching */
    transition: transform 0.3s ease;
}

    #other-slider .swiper-slide:hover img {
        transform: scale(1.22); /* Zoom effect on hover */
    }
</style>

<div class="page-banner-area bg-2">
    <div class="container">
        <div class="page-banner-content">
            <h1>GRUNI Gallery</h1>
            <ul>
                <li><a href="https://www.gruni.co.in/">Home</a></li>
                <li>Gallery</li>
            </ul>
        </div>
    </div>
</div>

<!-- Start of Gallery Section -->
<h2 class="text-center mb-4"><br>Explore Our Campus Through the Gallery</h2>

<!-- Other Slider -->
<div class="gruni-gallery-section mb-5">
    <h3>GRUNI-Campus</h3>
    <div id="other-slider" class="swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/campus/1.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/campus/1.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/campus/2.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/campus/2.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/campus/3.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/campus/3.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/campus/4.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/campus/4.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a  href="{{ asset('assets/web/images/gallery/campus/5.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/campus/5.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a  href="{{ asset('assets/web/images/gallery/campus/6.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/campus/6.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
        </div>
        <!-- Navigation Buttons -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

<div class="gruni-gallery-section mb-5">
    <h3>GRUNI-Classroom & Academics</h3>
    <div id="other-slider" class="swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/classroom/1.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/classroom/1.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/classroom/2.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/classroom/2.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/classroom/3.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/classroom/3.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/classroom/4.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/classroom/4.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
        </div>
        <!-- Navigation Buttons -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

<div class="gruni-gallery-section mb-5">
    <h3>GRUNI-Hospital</h3>
    <div id="other-slider" class="swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/hospital/1.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/hospital/1.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/hospital/2.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/hospital/2.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/hospital/3.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/hospital/3.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/hospital/4.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/hospital/4.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/hospital/5.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/hospital/5.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/hospital/5.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/hospital/5.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/hospital/6.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/hospital/6.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/hospital/7.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/hospital/7.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/hospital/8.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/hospital/8.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/hospital/9.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/hospital/9.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/hospital/10.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/hospital/10.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
        </div>
        <!-- Navigation Buttons -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

<div class="gruni-gallery-section mb-5">
    <h3>GRUNI-Hostel Facility</h3>
    <div id="other-slider" class="swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/hostel/2.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/hostel/2.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/hostel/3.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/hostel/3.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/hostel/4.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/hostel/4.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/hostel/1.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/hostel/1.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/hostel/5.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/hostel/5.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
        </div>
        <!-- Navigation Buttons -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

<div class="gruni-gallery-section mb-5">
    <h3>GRUNI-Success Stories</h3>
    <div id="other-slider" class="swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/success/1.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/success/1.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/success/2.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/success/2.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/success/3.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/success/3.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/success/4.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/success/4.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/success/5.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/success/5.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/success/6.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/success/6.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/success/7.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/success/7.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/success/8.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/success/8.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/success/9.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/success/9.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/success/10.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/success/10.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>

        </div>
        <!-- Navigation Buttons -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

<div class="gruni-gallery-section mb-5">
    <h3>GRUNI-Simulation Center</h3>
    <div id="other-slider" class="swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/simulation center/1.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/simulation center/1.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/simulation center/2.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/simulation center/2.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/simulation center/3.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/simulation center/3.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/simulation center/4.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/simulation center/4.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/simulation center/5.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/simulation center/5.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/simulation center/6.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/simulation center/6.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/simulation center/7.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/simulation center/7.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/simulation center/8.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/simulation center/8.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/simulation center/9.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/simulation center/9.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/simulation center/10.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/simulation center/10.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
        </div>
        <!-- Navigation Buttons -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

<div class="gruni-gallery-section mb-5">
    <h3>GRUNI-Dental Clinic</h3>
    <div id="other-slider" class="swiper">
        <div class="swiper-wrapper">
            <!-- images -->
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/dental/8.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/dental/8.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/dental/2.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/dental/2.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/dental/3.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/dental/3.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/dental/4.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/dental/4.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/dental/5.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/dental/5.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/dental/6.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/dental/6.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/dental/7.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/dental/7.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
            <div class="swiper-slide">
                <a href="{{ asset('assets/web/images/gallery/dental/1.webp') }}" data-fancybox="gallery">
                    <img src="{{ asset('assets/web/images/gallery/dental/1.webp') }}" class="img-fluid shadow-sm" alt="Campus Image 1" loading="lazy">
                </a>
            </div>
        </div>
        <!-- Navigation Buttons -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>


<!-- Fancybox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<!-- Include Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    // Other Slider Initialization
    var otherSlider = new Swiper('#other-slider', {
        slidesPerView: 3,
        spaceBetween: 80,
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '#other-slider .swiper-pagination', // Use specific selector
            clickable: true,
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
            },
            375: {
                slidesPerView: 1,
            },
            425: {
                slidesPerView: 1,
            },

            768: { // Adjust the number of slides per view for different screen sizes
                slidesPerView: 2,
            },
            992: {
                slidesPerView: 3,
            },
            1200: {
                slidesPerView: 3,
            }
        }
    });

    // Initialize Fancybox to work in carousel mode
document.addEventListener("DOMContentLoaded", function () {
    // Bind Fancybox to the gallery images
    Fancybox.bind('[data-fancybox="gallery"]', {
        Toolbar: {
            display: {
                left: ["infobar"],
                middle: ["zoomIn", "zoomOut", "toggle1to1", "rotateCCW", "rotateCW", "flipX", "flipY"],
                right: ["close"],
            },
        },
        Thumbs: {
            autoStart: true, // Show thumbnails
        },
        Carousel: {
            infinite: true, // Make carousel infinite
        },
        on: {
            done: (fancybox) => {
                // Continue Swiper after closing the lightbox
                otherSlider.slideTo(fancybox.currIndex);
            }
        }
    });
});
</script>
@endsection
