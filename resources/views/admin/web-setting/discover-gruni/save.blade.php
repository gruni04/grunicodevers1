@extends('layouts.app')


@section('page-style')
    <link href="{{ url('assets/admin/vendor/selectize/dist/css/selectize.default.css')}}" rel="stylesheet">
    <link href="{{ url('assets/admin/vendor/summernote/dist/summernote-bs4.css')}}"  rel="stylesheet">
    <script src="//cdn.ckeditor.com/4.19.1/full/ckeditor.js"></script>
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
	        <a href="{{ route('web-setting.discover-gruni') }}" class="btn btn-gradient-success" style="float: right;">Back</a>
	    </div>
	    <div class="card-body">
	        <div class="row">
	            <div class="col-sm-12">
	            	
	            	<form action="{{ route('web-setting.store-discover-gruni') }}" method="POST" class="m-t-15" id="form">

	            		<input type="hidden" name="edit_id" value="{{ $edit_data && $edit_data->id ? $edit_data->id : ''  }}" >
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ $edit_data && $edit_data->title ? $edit_data->title : ''  }}" class="form-control" name="title" placeholder="Enter Title" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Image <span class="text-danger">*</span></label>
                                	<input id="image" name="image" type="file" class="form-control" {{ $edit_data && $edit_data->image ? '' : 'required'  }}>
                                	@if($edit_data && $edit_data->image)
                                	<img src="{{ $edit_data && $edit_data->image ? url('uploads/discover-gruni/'.$edit_data->image) : ''  }}" class="img img-fluid" style="width: 25%;">
                                	@endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Link <!--<span class="text-danger">*</span>--></label>
                                    <input type="text" value="{{ $edit_data && $edit_data->link ? $edit_data->link : ''  }}" class="form-control" name="link" placeholder="Enter Link">
                                </div>
                            </div>
                            <div class="col-md-12">
			                    <div class="form-group">
			                        <label class="control-label">Description <!--<span class="text-danger">*</span>--></label>
			                        <textarea class="form-control ckeditor" name="description" placeholder="Enter Description" >{{ $edit_data && $edit_data->description ? $edit_data->description : ''  }}</textarea>
			                    </div>
			                </div>
			                
                            <div class="col-md-6">
                                <h5>Status <span class="text-danger">*</span></label></h5>
                                <div class="m-t-15 d-flex">
                                    <div class="radio">
                                        <input id="status_active" name="is_active" type="radio" value="1" {{ $edit_data && $edit_data->is_active==1 ? 'checked' : ''  }}>
                                        <label for="status_active" style="margin-right: 10px;">Active</label>
                                    </div>
                                    <div class="radio">
                                        <input id="status_inactive" name="is_active" type="radio" value="2" {{ $edit_data && $edit_data->is_active==2 ? 'checked' : '' }}>
                                        <label for="status_inactive">Inactive</label>
                                    </div>
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
		// Wait for the DOM to be ready
		$("#form").validate({
			submitHandler: function(form){
			    $.ajaxSetup({
			        headers: {
			              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			    });
			    event.preventDefault();
			    for ( instance in CKEDITOR.instances ) {
		          	CKEDITOR.instances[instance].updateElement();
		        }
				var form_data = new FormData(document.getElementById("form"));
				$.ajax({
		              type: "POST",
		              url:$("#form").attr('action'),
		              dataType:'json',
		              data: form_data,
		              contentType: false,
		              cache: false,
		              processData:false,
		              beforeSend:function() {},
		              success:function(responce)
		              {
		                 if(responce.status==1)
		                {
		                    _success(responce.message);
		                    window.setTimeout(function() {
		                    	window.location.href = '{{ route('web-setting.discover-gruni') }}';
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