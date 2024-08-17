@extends('web.layout.default')
@section('pageTitle', $page_title)

@section('content')
    {{-- @include('swweb.layout.breadcrumb') --}}

	<div class="page-banner-area bg-2">
	   <div class="container">
	      <div class="page-banner-content">
	         <h1>{{ $announcement_data->title }}</h1>
	         <ul>
	            <li><a href="{{ url('/') }}">Home</a></li>
	            <li>Announcement</li>
	            <li>{{ $announcement_data->title }}</li>
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
	               	<h2>{{ $announcement_data->title }}</h2>
	                  {!! $announcement_data->description !!}
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