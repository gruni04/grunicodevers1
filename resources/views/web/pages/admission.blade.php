@extends('web.layout.default')
@section('pageTitle', $page_title)

@section('content')
    {{-- @include('swweb.layout.breadcrumb') --}}

	<div class="page-banner-area bg-2">
	   <div class="container">
	      <div class="page-banner-content">
	         <h1>Admission</h1>
	         <ul>
	            <li><a href="{{ url('/') }}">Home</a></li>
	            <li>Admission</li>
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
			            $admission_details = DB::table('tbl_admission')->where('is_active', 1)->where('slug', $data_id2)->first();
			         @endphp
	               <div class="meetings">
	                  <h2>{{ $admission_details->title }}</h2>
	                  {!! $admission_details->description !!}
	               </div>
	            </div>
	         </div>
	         <div class="col-lg-4">
					<div class="academics-list">
                  <h3>Admission Category</h3>
						<div class="accordion" id="accordionExample">
							@php
				            $admission_cateogry = DB::table('tbl_admission_cateogry')->where('is_active', 1)->get();
				            $announcement = DB::table('tbl_announcement')->where('is_active', 1)->get();
				         @endphp
				         @foreach($admission_cateogry as $k=>$v)
                        @php
					            $admission = DB::table('tbl_admission')->where('is_active', 1)->where('category', $v->slug)->get();
					         @endphp
                              
						      <div class="accordion-item">
                           <h2 class="accordion-header" id="heading1">
                              <button class="accordion-button {{ $admission_details->category==$v->slug ? "show" : "collapsed" }} " type="button" data-bs-toggle="collapse" data-bs-target="#collapseabout-university-{{ $v->slug }}" aria-expanded=" {{ $admission_details->category==$v->slug ? "true" : "false" }} " aria-controls="collapseabout-university-{{ $v->slug }}">{{ $v->category }}</button>
                           </h2>
                           <div id="collapseabout-university-{{ $v->slug }}" class="accordion-collapse collapse {{ $admission_details->category==$v->slug ? "show" : "" }}" aria-labelledby="headingabout-university" data-bs-parent="#accordionExample">
                              <div class="accordion-body">
		                           <ul>
			                           @foreach($admission as $k1=>$v1)
											   <li>
												  <a href="{{ route('web.admission', ['id'=> $v->slug, 'id2'=> $v1->slug ]) }}">{{ $v1->title }}<i class="ri-arrow-drop-right-fill"></i></a>
											   </li>
											    @endforeach
										   </ul>
                              </div>
                           </div>
                        </div>
                        @endforeach

						</div>
                     
               </div>
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