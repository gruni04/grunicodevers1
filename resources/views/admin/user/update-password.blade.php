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
	        <a href="{{ route('home') }}" class="btn btn-gradient-success" style="float: right;">Home</a>
	    </div>
	    <div class="card-body">
	        <div class="row">
	            <div class="col-sm-3"></div>
	            <div class="col-sm-6">
	            	<form action="{{ route('user.update-user-password') }}" method="POST" class="m-t-15" id="form">
                        <div class="form-row">
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Old Password</label>
                                	<input type="password" class="form-control" name="old_password" placeholder="Enter Old Password"  required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">New Password</label>
                                	<input type="password" class="form-control" name="password" placeholder="Enter New Password" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Confirm Password</label>
                                	<input type="password" class="form-control" name="confirm_password" placeholder="Enter Confirm Password" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row text-right">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="text-sm-right">
                                        <button class="btn btn-default" type="reset">Reset</button>
                                        <button class="btn btn-gradient-success" type="submit">Submit</button>
                                    </div>
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
		$("#form").validate({
			submitHandler: function(form){
			    $.ajaxSetup({
			        headers: {
			              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			    });
			    event.preventDefault();
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
		                    	window.location.reload();
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
		    }
		});
	</script>
@endsection