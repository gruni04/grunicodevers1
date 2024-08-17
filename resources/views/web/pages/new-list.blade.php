@extends('web.layout.default')
@section('pageTitle', $page_title)

@section('content')
    {{-- @include('swweb.layout.breadcrumb') --}}

	<div class="page-banner-area bg-2">
	   <div class="container">
	      <div class="page-banner-content">
	         <h1>Latest News & Events</h1>
	         <ul>
	            <li><a href="{{ url('/') }}">Home</a></li>
	            <li>Latest News & Events</li>
	         </ul>
	      </div>
	   </div>
	</div>
	<div class="events-details-area pt-100 pb-70">
	   <div class="container">
	      <div class="row">
	         <div class="col-lg-8">
	            <div class="events-details-left-content pr-20">
	            	<div class="row">
		               @php
				            $latest_news = DB::table('tbl_latest_news')->where('is_active', 1)->get();
				         @endphp
		               @foreach($latest_news as $k=>$v)
		               <div class="col-4 single-news-card style2">
		                  <div class="news-img">
		                     <a href="{{ route('web.latest-news', ['id'=> $v->slug]) }}"><img src="{{ url('uploads/latest-news/'.$v->image) }}" alt="Image"></a>
		                  </div>
		                  <div class="news-content">
		                     <div class="list">
		                        <ul>
		                           <li><i class="flaticon-user"></i>By <a href="{{ route('web.latest-news', ['id'=> $v->slug]) }}">Admin</a></li>
		                        </ul>
		                     </div>
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
	         <div class="col-lg-4">
						@php
			            $announcement = DB::table('tbl_announcement')->where('is_active', 1)->get();
			         @endphp
                  <div class="tranding categories announcement">
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