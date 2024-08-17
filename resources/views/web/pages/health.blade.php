@extends('web.layout.default')
@section('pageTitle', $page_title)

@section('content')
    {{-- @include('swweb.layout.breadcrumb') --}}

	<div class="page-banner-area bg-2">
	   <div class="container">
	      <div class="page-banner-content">
	         <h1>Health and Wellness</h1>
	         <ul>
	            <li><a href="{{ url('/') }}">Home</a></li>
	            <li>Health and Wellness</li>
	         </ul>
	      </div>
	   </div>
	</div>
	<div class="events-details-area pt-100 pb-70">
	   <div class="container">
	      <div class="row">
	         <div class="col-lg-8">
	            <div class="events-details-left-content pr-20">

	               <div class="meetings">
	                  <h2>Health and Wellness</h2>
	                  <img src="{{ asset('assets/web/images/stundent-life/student-life-3.jpg')}}" alt="Image">
	                  <p><br>We establish a sophisticated academic culture and create intellectual wealth: By implementing educational programmes based on scientific achievements and orienting our activities towards the student, we will prepare generations of competent specialists for Humanitarian, Social, Administrative, Medical and other spheres of high demand, who will be able to integrate into the international educational and labour markets and will take their share of responsibility for the future of the country; together with undergraduate programmes, we will develop Master’s and PhD programmes as a highly effective system for creating employees with deep/wide competences for flourishing of the social culture and economics.



We institute a strong scientific-research culture: We will protect and expand general knowledge, create and share new knowledge for further development of science, for which we will invite renowned scientists and guarantee the internationalization of scientific research.



We are a University community with high sense of social responsibility: We guarantee an educational service of high standard for training specialists and professional development in Adjara region; we will utilize the experience of academic and scientific-research activities for realizing the services oriented towards the country’s population.



Vision

The University will become a scientific-educational centre of international renown, primarily, in the directions of Law and Medicine.</p>
	               </div>
	            </div>
	         </div>
	         <div class="col-lg-4">

                  <div class="tranding categories announcement">
                     <h3>Announcements</h3>
                     <ul>
                         	@php
                         	$announcement = DB::table('tbl_announcement')->where('is_active', 1)->get();

                         	 @endphp
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
                   	<div class="related-post-area">
				    <h3>Related News</h3>
				    @php
		            $news = DB::table('tbl_latest_news')->where('is_active', 1)->get();
		         @endphp
		         @foreach($news as $k=>$v)
				   <div class="related-post-box">
				      <div class="related-post-content">
			            <a href="{{ route('web.latest-news', ['id'=> $v->slug]) }}">
			            	<img src="{{ url('uploads/latest-news/'.$v->image) }}" alt="Image">
			            </a>
			            <h4>
			               <a href="{{ route('web.latest-news', ['id'=> $v->slug]) }}">{{ $v->title }}</a>
			            </h4>
				      </div>
				   </div>
				   @endforeach

				    <div class="subscribe-area">
                     <div class="top-content">
                        <i class="flaticon-email"></i>
                        <h3>Subscribe To Newsletter</h3>
                        <p>Get updates to news & events</p>
                     </div>
                     <form id="form" action="{{ route('web.subscribe') }}" method="POST" class="newsletter-form" data-toggle="validator">
                        <input type="email" class="form-control" placeholder="Your Email" name="EMAIL" required autocomplete="off">
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
	</div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript">

		// Wait for the DOM to be ready
		$("#form").on('submit',function(){
		    alert('hello');

				var form_data = new FormData(document.getElementById("form"));
				$.ajax({
		              type: "POST",
		              url:$("#form").attr('action'),
		              dataType:'json',
		              data: form_data,
		              contentType: false,
		              cache: false,
		              processData:false,
		              beforeSend:function()
		              {},
		              success:function(responce)
		              {
		                 if(responce.status==1)
		                {
		                    _success(responce.message);
		                    window.setTimeout(function() {
		                    	window.location.href='{{ route('users.list.index') }}';
		                    }, 1500);
		                }else{
		                   _error(responce.message);
		                }
		              },
		              error:function()
		              {
		                 _error('Something Went Wrong..');
		              },
		              complete:function()
		              {
		              }
		        });
		});
	</script>
@section('scripts')

@endsection
