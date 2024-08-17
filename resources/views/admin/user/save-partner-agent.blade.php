@extends('layouts.app')


@section('page-style')
    <link href="{{ url('assets/admin/vendor/selectize/dist/css/selectize.default.css')}}" rel="stylesheet">
    <link href="{{ url('assets/admin/vendor/summernote/dist/summernote-bs4.css')}}" rel="stylesheet">
    <style type="text/css">
    	
    </style>
@endsection


@section('content')
	
	<div class="card">
	    <div class="card-header border bottom">
	        <h4 class="card-title">{{ $sub_title }}</h4>
	        <a href="{{ route('partner-user.list.index') }}" class="btn btn-gradient-success" style="float: right;">Back</a>
	    </div>
	    <div class="card-body">
	        <div class="row">
	            <div class="col-sm-12">
	            	
	            	<form action="{{ route('admin.partner-user.store') }}" method="POST" class="m-t-15" id="form">
                        <input type="hidden" name="edit_id" value="{{ $edit_data && $edit_data->id ? $edit_data->id : '0' }}">
                        <div class="form-row">
                        	<div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">User Type</label>
                                	<select name="user_type" class="form-control user-type" required>
                                        @if(Auth::user()->user_type==1)
                                        <option value="2" {{ !empty($edit_data) && $edit_data->user_type==2 ? "selected":''}}>Partner</option>
                                        @endif
                                        <option value="3" {{ !empty($edit_data) && $edit_data->user_type==3 ? "selected":''}}>Agent</option>
                                    </select>
                                </div>  
                            </div>
                            <div class="col-md-6 partner-user-section d-none">
                                <div class="form-group">
                                    <label class="control-label">Select Partner</label>
                                    <select name="partner_id" class="form-control ">
                                        @foreach($partner_list as $k=>$v)
                                        <option value="{{ $v->id }}" {{ !empty($edit_data) && !empty($edit_data->partner_id) && $edit_data->partner_id==$v->id ? "selected":''}}>{{ $v->name.' ('.$v->email.")" }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        	<div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Country</label>
                                	<select name="country" class="form-control" required>
                                        <option value="1" selected>India</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ $edit_data && $edit_data->name ?$edit_data->name : '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                	<input type="email" class="form-control" {{ $edit_data && $edit_data->email ? "readonly" : '' }} name="email" value="{{ $edit_data && $edit_data->email ?$edit_data->email : '' }}" placeholder="Enter Email" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Contact Number </label>
                                	<input type="number" class="form-control" name="contact" value="{{ $edit_data && $edit_data->contact ?$edit_data->contact : '' }}" placeholder="Enter Contact Number " required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Whatsapp Contact Number </label>
                                	<input type="number" class="form-control" value="{{ $edit_data && $edit_data->whatsapp_contact ?$edit_data->whatsapp_contact : '' }}" name="whatsapp_contact" placeholder="Enter Whatsapp Contact Number " required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Password</label>
                                	<input type="password" class="form-control" name="password" placeholder="Enter Password" autocomplete="off" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Confirm Password</label>
                                	<input type="password" class="form-control" name="confirm-password" placeholder="Enter Confirm Password" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Commision Type</label>
                                    <select name="commision_type" class="form-control" required>
                                        <option value="1" {{ !empty($edit_data) && $edit_data->commision_type==1 ? "selected":''}}>Fix</option>
                                        <option value="2" {{ !empty($edit_data) && $edit_data->commision_type==2 ? "selected":''}}>Percentage</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Commision Value </label>
                                    <input type="number" class="form-control" name="commision_value" value="{{ $edit_data && $edit_data->commision_value ?$edit_data->commision_value : '0' }}" placeholder="Enter Commision Value " required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Currency</label>
                                    <select name="currency" class="form-control" required>
                                        <option value="1" {{ !empty($edit_data) && $edit_data->currency==1 ? "selected":''}}>INR(₹)</option>
                                        <option value="2" {{ !empty($edit_data) && $edit_data->currency==2 ? "selected":''}}>Dollar($)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Address </label>
                                    <textarea class="form-control" name="address" placeholder="Enter Address">{{ $edit_data && $edit_data->address ?$edit_data->address : '' }}</textarea>
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
	        </div>
	    </div>
	</div>
@endsection


@section('page-script')
	    
    <script type="text/javascript">
    	$(document).on("change", ".user-type", function(){
            if($(this).val()==3){
                $(".partner-user-section").removeClass("d-none");
            }else{
                $(".partner-user-section").addClass("d-none");
            }
        });
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
		                    	window.location.href='{{ route('partner-user.list.index') }}';
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