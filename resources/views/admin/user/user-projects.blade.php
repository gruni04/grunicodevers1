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
	            	
	            	<form action="{{ route('users.project.save') }}" method="POST" class="m-t-15" id="form">
	            	    <input type="hidden" name="uid" value="{{ Crypt::encrypt($user->id) }}" />
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" readonly class="form-control" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Running Projects</label>
                                    <div>
                                        @foreach($projects as $k=>$v)
                                            @if(in_array($v->id, $user_projects ))
                                                <span class="badge badge-pill badge-gradient-success remove-project" data-id="{{ Crypt::encrypt($v->id) }}">{{ $v->location_name }} <span style="color:red">X</span> </span>
                                            @endif
                                        @endforeach
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Add More Projects</label>
                                	<select id="selectize-tags-1" name="projects[]" multiple class="tag-info">
                                        <option value="" disabled selected>Select a projects...</option>
                                        @foreach($projects as $k=>$v)
                                            @if(!in_array($v->id, $user_projects ))
                                            <option value="{{ $v->id }}" {{ !empty($user_projects) && in_array($v->id, $user_projects ) ? "selected":''}} >{{ $v->location_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
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
    	$(document).on("click", ".remove-project", function() {
            if(!confirm("Are You Sure want to Remove Project?")){
                return false;
            }
            $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
            $.ajax({
                  type: "POST",
                  url:'{{ route('users.project.remove') }}',
                  dataType:'json',
                  data: {pid: $(this).data('id'), uid:'{{ Crypt::encrypt($user->id) }}'},
                  beforeSend:function() {},
                  success:function(responce)
                  {
                    if(responce.status==1) {
                        _success(responce.message);
	                    window.setTimeout(function() {
	                    	window.location.reload();
	                    }, 1500);
                    }else {
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