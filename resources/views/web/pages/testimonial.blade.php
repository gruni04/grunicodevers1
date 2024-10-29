@extends('web.layout.default')
@section('pageTitle', $page_title)

@section('content')

	<div class="page-banner-area bg-2">
      <div class="container">
         <div class="page-banner-content">
            <h1>Testimonials </h1>
            <ul>
               <li><a href="https://www.gruni.co.in/">Home</a></li>
               <li>Testimonials</li>
            </ul>
         </div>
      </div>
   </div>
   @php
      $testimonial = DB::table('tbl_testimonial')->where('is_active', 1)->limit(10)->get();
   @endphp
	<div class="health-care-details pt-100 pb-70">
         <div class="container">
            <div class="row">
               <div class="col-lg-8">
                  <div class="academics-left-content">
				      	<div class="row justify-content-center">
				      		<div class="col-lg-12 col-md-12">
				      			<h2>Testimonial</h2>
				      		</div>
					         @foreach($testimonial as $k=>$v)
			               <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200" data-aos-once="true">
			                  <div class="single-stories-card style2">
			                     {{-- <iframe src="{{ $v->link }}" title="{{ $v->title }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> --}}
			                     <lite-youtube videoid="{{ $v->link }}" title="{{ $v->title }}"></lite-youtube>
                                 <div class="stories-content">
			                        <h3>{{ $v->title }}</h3>
			                     </div>
			                  </div>
			               </div>
			               @endforeach
							</div>
				   	</div>
               </div>
               <div class="col-lg-4">
                  <div class="tranding categories announcement">
                  	@php
				            $announcement = DB::table('tbl_announcement')->where('is_active', 1)->get();
				        	@endphp
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
               </div>
            </div>
         </div>
      </div>


@endsection

@section('scripts')

@endsection
