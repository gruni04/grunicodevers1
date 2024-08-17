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
    	.nav-link.disabled {
            color: #6c757d;
            background-color: #e9e7e7;
        }
        .nav-link.completed-tab {
            background: green;
            color: white;
        }
    </style>
@endsection


@section('content')
	<div class="card">
		<div class="card-header border bottom">
	        <h4 class="card-title">{{ $sub_title }}</h4>
	        <a href="{{ route('admin.student.index') }}" class="btn btn-gradient-success" style="float: right;">Back</a>
	    </div>
        <div class="card-body">
            <div class="pill-success">
                @php
                    $application_letter_tab = '';
                    $admission_letter_tab = 'disabled';
                    $tution_fee_tab = 'disabled';
                    $interview_tab = 'disabled';
                    $univrsity_tab = 'disabled';
                    $indian_office_tab = 'disabled';
                    $hostel_tab = 'disabled';
                    
                    
                    $application_letter_completed = '';
                    $admission_letter_completed = '';
                    $tution_fee_completed = '';
                    $interview_completed = '';
                    $univrsity_completed = '';
                    $indian_office_completed = '';
                    $hostel_completed = '';
                    
                    
                    if(Auth::user()->hasAnyRole(['Admin', 'Manager'])){
                        $application_letter_tab = '';
                        $admission_letter_tab = '';
                        $tution_fee_tab = '';
                        $interview_tab = '';
                        $univrsity_tab = '';
                        $indian_office_tab = '';
                        $hostel_tab = '';
                    }else{
                        if(!empty($edit_data) && !empty($edit_data->id)){
                            $approved_docs = DB::table('tbl_student_document')
                                                    ->where('approved_status', 2)
                                                    ->where('doc_for', 1)
                                                    ->where('student_id', $edit_data->id)
                                                    ->get();
                            if(count($approved_docs)<=0){
                                $application_letter_completed = 'completed-tab';
                                
                                $application_letter_tab = '';
                                $admission_letter_tab = '';
                                if(!empty($edit_data->admission_letter_doc)){
                                    $admission_letter_completed = 'completed-tab';
                                    
                                    $tution_fee_tab = '';

                                    $student_all_fee = DB::table('tbl_student_fee_history')
                                                                ->where('student_id', $edit_data->id)
                                                                ->get();
                                    $student_verified_fee = DB::table('tbl_student_fee_history')
                                                                ->where('approval_status', 3)
                                                                ->where('fee_for', 1)
                                                                ->where('student_id', $edit_data->id)
                                                                ->get();
                                    if(!empty($edit_data->admission_letter_doc) && count($student_all_fee)>0 && count($student_verified_fee)<=0){
                                        $tution_fee_completed = 'completed-tab';
                                        
                                        $interview_tab = '';
                                        $student_all_interview = DB::table('tbl_student_interview_history')
                                                                ->where('student_id', $edit_data->id)
                                                                ->get();
                                        $student_interview = DB::table('tbl_student_interview_history')
                                                                ->where('status', 1)
                                                                ->where('student_id', $edit_data->id)
                                                                ->get();
                                        if(count($student_all_interview)>0 && count($student_interview)<=0){
                                            $interview_completed = 'completed-tab';
                                            
                                            $univrsity_tab = '';
                                            $student_all_univrsity = DB::table('tbl_student_document')
                                                                ->where('doc_for', 2)
                                                                ->where('student_id', $edit_data->id)
                                                                ->get();
                                            $student_univrsity = DB::table('tbl_student_document')
                                                                ->where('approved_status', 2)
                                                                ->where('doc_for', 2)
                                                                ->where('student_id', $edit_data->id)
                                                                ->get();
                                            //!empty($edit_data->university_payment_type) && !empty($edit_data->university_payment_doc) &&
                                            if( count($student_all_univrsity)>0 && count($student_univrsity)<=0 ){
                                                $univrsity_completed = 'completed-tab';
                                                
                                                $indian_office_tab = '';
                                                // if(!empty($edit_data->visa_details) && !empty($edit_data->visa_details_doc) ){
                                                if($edit_data->visa_details_status==1){
                                                    $indian_office_completed = 'completed-tab';
                                                    $hostel_completed = 'completed-tab';
                                                    
                                                    $hostel_tab = '';
                                                }
                                            }

                                        }
                                    }
                                }
                            }
                        }

                    }
                @endphp
                <ul class="nav nav-pills border bottom" role="tablist" style="padding-bottom: 10px;">
                    <li class="nav-item">
                        <a href="#pills-success-application" class="nav-link active show {{ $application_letter_completed }}  {{ $application_letter_tab }}" id="application-tab" role="tab" data-toggle="tab" aria-selected="true">APPLICATIONS</a>
                    </li>
                    <li class="nav-item">
                        <a href="#pills-success-admission-letter" id="admission-tab" class="nav-link {{ $admission_letter_completed }} {{ $admission_letter_tab }}" role="tab" data-toggle="tab" aria-selected="false"> ADMISSION LETTER </a>
                    </li>
                    <li class="nav-item">
                        <a href="#pills-success-tution-fee" class="nav-link {{ $tution_fee_completed }} {{ $tution_fee_tab }}" id="tution-fee-tab" role="tab" data-toggle="tab" aria-selected="false">TUITION FEE</a>
                    </li>
                    <li class="nav-item">
                        <a href="#pills-success-interview-scheduled" class="nav-link {{ $interview_completed }} {{ $interview_tab }}" id="interview-tab" role="tab" data-toggle="tab" aria-selected="false">INTERVIEW SCHEDULED</a>
                    </li>
                    <li class="nav-item">
                        <a href="#pills-success-university" class="nav-link {{ $univrsity_completed }} {{ $univrsity_tab }}" id="university-tab" role="tab" data-toggle="tab" aria-selected="false">UNIVERSITY</a>
                    </li>
                    <li class="nav-item">
                        <a href="#pills-success-indian-office-work" class="nav-link {{ $indian_office_completed }} {{ $indian_office_tab }}" id="indian-office-tab" role="tab" data-toggle="tab" aria-selected="false">INDIAN OFFICE WORK</a>
                    </li>
                    <li class="nav-item">
                        <a href="#pills-success-accommodation-hostel" class="nav-link {{ $hostel_completed }} {{ $hostel_tab }}" id="hostel-tab" role="tab" data-toggle="tab" aria-selected="false">ACCOMMODATION/HOSTEL</a>
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
                    <input type="hidden" value="{{ Auth::user()->user_type }}" id="user_type" id="user_type">
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