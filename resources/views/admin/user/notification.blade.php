@extends('layouts.app')


@section('page-style')
    <link rel="stylesheet" href="{{ url('assets/admin/vendor/datatables/media/css/dataTables.bootstrap4.min.css')}}" />
    <link href="{{ url('assets/admin/vendor/selectize/dist/css/selectize.default.css')}}" rel="stylesheet">
    <link href="{{ url('assets/admin/vendor/summernote/dist/summernote-bs4.css')}}"  rel="stylesheet">
    <script src="//cdn.ckeditor.com/4.19.1/full/ckeditor.js"></script>
    <style type="text/css">
    	.custom-border-top{
    		border-top: 1px solid #e2e2e9;
    	}
    </style>
@endsection


@section('content')
	<div class="card">
		<div class="card-header border bottom">
	        <h4 class="card-title">{{ $sub_title }}</h4>
	        <a href="{{ route('web-setting.admission') }}" class="btn btn-gradient-success" style="float: right;">Back</a>
	    </div>
        <div class="card-body">
            <div class="pill-success">
                <ul class="nav nav-pills border bottom" role="tablist" style="padding-bottom: 10px;">
                    <li class="nav-item">
                        <a href="#pills-success-application" class="nav-link active show" role="tab" data-toggle="tab" aria-selected="true">APPLICATIONS</a>
                    </li>
                    <li class="nav-item">
                        <a href="#pills-success-admission-letter" class="nav-link" role="tab" data-toggle="tab" aria-selected="false"> ADMISSION LETTER </a>
                    </li>
                    <li class="nav-item">
                        <a href="#pills-success-tution-fee" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">TUITION FEE</a>
                    </li>
                    <li class="nav-item">
                        <a href="#pills-success-interview-scheduled" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">INTERVIEW SCHEDULED</a>
                    </li>
                    <li class="nav-item">
                        <a href="#pills-success-university" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">UNIVERSITY</a>
                    </li>
                    <li class="nav-item">
                        <a href="#pills-success-indian-office-work" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">INDIAN OFFICE WORK</a>
                    </li>
                    <li class="nav-item">
                        <a href="#pills-success-accommodation-hostel" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">ACCOMMODATION/HOSTEL</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active show" id="pills-success-application">
                        <div class="p-h-15 p-v-5">
                            <div class="row">
					            <div class="col-sm-12">
					            	
					            	@include("admin.student.tab-application")
					            </div>
					        </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="pills-success-admission-letter">
                        <div class="p-h-15 p-v-5">
                        	<div class="row">
					            <div class="col-sm-12">
					            	@include("admin.student.tab-admission-letter")
					            </div>
					        </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="pills-success-tution-fee">
                        <div class="p-h-15 p-v-5">
                            <div class="row">
					            <div class="col-sm-12">
					            	@include("admin.student.tab-tution-fee")
					            </div>
					        </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="pills-success-interview-scheduled">
                        <div class="p-h-15 p-v-5">
                            <div class="row">
					            <div class="col-sm-12">
					            	@include("admin.student.tab-interview-scheduled")
					            </div>
					        </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="pills-success-university">
                        <div class="p-h-15 p-v-5">
                            <div class="row">
					            <div class="col-sm-12">
					            	@include("admin.student.tab-university")
					            </div>
					        </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="pills-success-indian-office-work">
                        <div class="p-h-15 p-v-5">
                            <div class="row">
					            <div class="col-sm-12">
					            	@include("admin.student.tab-indian-office")
					            </div>
					        </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="pills-success-accommodation-hostel">
                        <div class="p-h-15 p-v-5">
                            <div class="row">
					            <div class="col-sm-12">
					            	@include("admin.student.tab-accomondation-hostel")
					            </div>
					        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('page-script')
	<script src="{{ url('assets/admin/vendor/datatables/media/js/jquery.dataTables.js')}}"></script>
    <script src="{{ url('assets/admin/vendor/datatables/media/js/dataTables.bootstrap4.min.js')}}"></script>
    
    <script type="text/javascript">
		
	</script>
	@include("admin.student.student-js")
@endsection