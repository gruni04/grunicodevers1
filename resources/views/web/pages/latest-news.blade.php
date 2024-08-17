@extends('web.layout.default')
@section('pageTitle', $page_title)

@section('content')
    {{-- @include('swweb.layout.breadcrumb') --}}
    <style type="text/css">
    	.related-post-box {
		    padding: 10px;
		}
    </style>
	<div class="page-banner-area bg-2">
	   <div class="container">
	      <div class="page-banner-content">
	         <h1>Latest News</h1>
	         <ul>
	            <li><a href="{{ url('/') }}">Home</a></li>
	            <li>Latest News</li>
	         </ul>
	      </div>
	   </div>
	</div>
	<div class="events-details-area pt-100 pb-70">
	   <div class="container">
	      <div class="row">
	         <div class="col-lg-8">
	            <div class="events-details-left-content pr-20">
	               @php
			            $news_details = DB::table('tbl_latest_news')->where('is_active', 1)->where('slug', $data_id)->first();
			         @endphp
	               <div class="meetings">
	                  <h2>{{ $news_details->title }}</h2>
	                  <img src="{{ url('uploads/latest-news/'.$news_details->image) }}" alt="Image">
	                  {!! $news_details->description !!}
	               </div>
	            </div>
	         </div>
             <br>
             <br>
             <br>
             <br>
	         <div class="col-lg-4">
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
				</div>
            </div>
	      </div>
	   </div>
	</div>

@endsection

@section('scripts')

@endsection
