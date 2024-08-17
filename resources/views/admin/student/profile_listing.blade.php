@extends('layouts.app')


@section('page-style')
    <link href="{{ url('assets/admin/vendor/selectize/dist/css/selectize.default.css')}}" rel="stylesheet">
    <link href="{{ url('assets/admin/vendor/summernote/dist/summernote-bs4.css')}}"  rel="stylesheet">
    <style type="text/css">
    	
    </style>
@endsection


@section('content')
	
	<div class="card">
	    <div class="card-header border bottom">
	        <h4 class="card-title">{{ $sub_title }}</h4>
	        
	    </div>
	    <div class="card-body">
	        <div class="row">
	            <div class="col-sm-3"></div>
	            <div class="col-sm-6">
	            	<form action="{{ route('user.update-user-password') }}" method="POST" class="m-t-15" id="form">
                        <div class="form-row">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                	
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" id="name_view"></label>
                                
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" id="email_view"></label>
                                
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Mobile Number</label>
                                
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" id="mobile_view"></label>
                                
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Whatsapp Number</label>
                                
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" id="whatsapp_view"></label>
                                
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Student Enroll</label>
                                
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" id="student_view"></label>
                                
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Currency</label>
                                
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" id="currency_view"></label>
                                
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Commision value</label>
                                
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" id="total_view"></label>
                                
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Total Commision value</label>
                                
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" id="total_comission"></label>
                                
                                </div>
                            </div>
                        </div>
                       
                    </form>
	            </div>
	            <div class="col-sm-3"></div>
	        </div>
	    </div>
	</div>
@endsection


@section('page-script')
	    
    <script type="text/javascript">
    	
		// Wait for the DOM to be ready
	
		$(window).on('load',function(){
				$.ajax({
		              type: "GET",
		              url:"{{ route('admin.student.get_detais_of_admin') }}",
		               headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
		              contentType: false,
		              cache: false,
		              processData:false,
		              beforeSend:function()
		              {},
		              success:function(responce)
		              {
		                  var commison = responce.iTotalRecords *responce.details.commision_value;
		                  if(responce.details.currency == 1){
		                      var cur = "INR";
		                  }else{
		                      var cur = "DOLLAR";
		                  }
		                  $('#name_view').html(responce.details.name);
		                  $('#email_view').html(responce.details.email);
		                   $('#mobile_view').html(responce.details.contact);
		                   $('#whatsapp_view').html(responce.details.whatsapp_contact);
		                   $('#student_view').html(responce.iTotalRecords);
		                   $('#total_view').html(responce.details.commision_value);
		                   $('#currency_view').html(cur);
		                   $('#total_comission').html(commison);
		                   console.log(commison);
		                 if(responce.status==1)
		                {
		                  
		                }else{
		                   _error(responce.message); 
		                }
		              }
		             
		        });    
		   
		});
	</script>
@endsection