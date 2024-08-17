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
	        <a href="{{ route('web-setting.gruni-information') }}" class="btn btn-gradient-success" style="float: right;">Back</a>
	    </div>
	    <div class="card-body">
	        <div class="row">
	            <div class="col-sm-12">
	            	
	            	<form action="{{ route('web-setting.store-gruni-information') }}" method="POST" class="m-t-15" id="form">

	            		<input type="hidden" name="edit_id" value="{{ $edit_data && $edit_data->id ? $edit_data->id : ''  }}" >
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Year of Experience <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ $edit_data && $edit_data->y_of_experience ? $edit_data->y_of_experience : ''  }}" class="form-control" name="y_of_experience" placeholder="Enter Year of Experience" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Global Students <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ $edit_data && $edit_data->global_students ? $edit_data->global_students : ''  }}" class="form-control" name="global_students" placeholder="Enter Global Students" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Students Nationalities <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ $edit_data && $edit_data->students_nationalities ? $edit_data->students_nationalities : ''  }}" class="form-control" name="students_nationalities" placeholder="Enter Students Nationalities" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Video Link <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ $edit_data && $edit_data->link ? $edit_data->link : ''  }}" class="form-control" name="link" placeholder="Enter Video Link" required>
                                </div>
                            </div>
                            <div class="col-md-12">
			                    <div class="form-group">
			                        <label class="control-label">Description <span class="text-danger">*</span></label>
			                        <textarea class="form-control" name="description" placeholder="Enter Description" >{{ $edit_data && $edit_data->description ? $edit_data->description : ''  }}</textarea>
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
		                    	window.location.href = '{{ route('web-setting.gruni-information') }}';
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