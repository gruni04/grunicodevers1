@extends('layouts.app')


@section('page-style')
    <link href="{{ url('assets/admin/vendor/selectize/dist/css/selectize.default.css')}}" rel="stylesheet">
    <link href="{{ url('assets/admin/vendor/summernote/dist/summernote-bs4.css')}}"  rel="stylesheet">
    <style type="text/css">
    	.reporting-to-section, .reporting-section{
    		display: none;
    	}
    </style>
@endsection


@section('content')
	
	<div class="card">
	    <div class="card-header border bottom">
	        <h4 class="card-title">{{ $sub_title }}</h4>
	        <a href="{{ route('users.list.index') }}" class="btn btn-gradient-success" style="float: right;">Back</a>
	    </div>
	    <div class="card-body">
	        <div class="row">
	            <div class="col-sm-12">
	            	
	            	<form action="{{ route('user.update') }}" method="POST" class="m-t-15" id="form">
	            		<input type="hidden" name="id" value="{{ $user && $user->id ? $user->id : '0' }}">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $user && $user->name ? $user->name : '' }}" placeholder="Enter Name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                	<input type="email" class="form-control" readonly name="email" value="{{ $user && $user->email ? $user->email : '' }}" placeholder="Enter Email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Contact Number </label>
                                	<input type="number" class="form-control" name="contact" value="{{ $user && $user->contact ? $user->contact : '' }}" placeholder="Enter Contact Number " required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Password</label>
                                	<input type="password" class="form-control" name="password" placeholder="Enter Password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Confirm Password</label>
                                	<input type="password" class="form-control" name="confirm-password" placeholder="Enter Confirm Password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Role</label>
                                	<select id="selectize-tags-1" name="roles[]" multiple class="tag-info" required>
                                        <option value="" disabled selected>Select a role...</option>
                                        @foreach($roles as $k=>$v)
                                        <option value="{{ $v }}" {{ !empty($userRole) && in_array($v, $userRole) ? "selected":''}} >{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row text-right">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="text-sm-right">
                                        
                                        <button class="btn btn-gradient-success">Submit</button>
                                    </div>
                                </div>
                            </div>        
                        </div>
                    </form>
	            </div>
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
		              type: $("#form").attr('method'),
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
		    }
		});
	</script>
@endsection