@extends('web.layout.default')
@section('pageTitle', $page_title)

@section('content')

	<div class="page-banner-area bg-2">
	     <div class="container">
	        <div class="page-banner-content">
	           <h1>Success Story </h1>
	           <ul>
	              <li><a href="{{ url('/') }}">Home</a></li>
	              <li>Success Story</li>
	           </ul>
	        </div>
	     </div>
	</div>
	@php
      $success_story = DB::table('tbl_success_story')->where('is_active', 1)->orderBy('score', 'DESC')->get();//limit(10)->
   @endphp
	<div class="health-care-details pt-100 pb-70">
         <div class="container">
            <div class="row">
               	<div class="col-lg-8">
	                <div class="academics-left-content">
				      	<div class="row justify-content-center">
				      		<div class="col-lg-12 col-md-12">
				      			<h2>Success Story</h2>
				      		</div>
				      		@foreach($success_story as $k=>$v)
					         <div class="col-lg-4 col-sm-6">
					            <div class="single-academics-card">
					               <div class="icon">
								        <a href="{{ url('uploads/success-story/'.$v->image) }}"><img src="{{ url('uploads/success-story/'.$v->image) }}" style="height:220px;" alt="Image" loading="lazy">
                                        </a>
                                    </div>
					               <!--<a href="https://www.gruni.co.in/student-details/dr-dhruvi-sanjay-joshi">-->
					               <a href="{{ url('uploads/success-story/'.$v->image) }}">
					                  <h6>{{ $v->name }}</h6>
					                  <p><b>Score: {{ $v->score }}</b></p>
					               </a>
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
