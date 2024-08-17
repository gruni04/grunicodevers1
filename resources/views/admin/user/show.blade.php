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
	            	<p>Show</p>
	            </div>
	        </div>
	    </div>
	</div>
@endsection


@section('page-script')
	    
    <script type="text/javascript">
    	$(document).on("change", "#reporting-to", function(){
    		if($(this).is(':checked')){
    			$(".reporting-to-section").show();
    		}else{
    			_selectOption('#reporting_role', '');
    			$(".reporting-to-section").hide();
    			$(".reporting-section").hide();
    			$("#reporting-person").html('<option value=" " >Select Reporting Person</option>');
    		}
    	});
    	$(document).on("change", "#reporting_role", function(){
    		$(".reporting-section").hide();
    		$("#reporting-person").html('<option value=" " >Select Reporting Person</option>');
    		if($(this).val()==null){
    			return false;
    		}

    		$.ajaxSetup({
		        headers: {
		              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
    		$.ajax({
		         url:"{{route('user.get-reporting-person')}}",
		         type:"POST",
		         dataType:"json",
		         data:{role_id:$(this).val()},
		         success:function(succ){
		            if(succ.status==1){
		            	data=succ.data;
		            	person = '';
		                for (var i = 0; i <= data.length - 1; i++) {
	                        person += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
	                    }
	                    $("#reporting-person").html(person);
	                    $(".reporting-section").show();
		            }else{
		               _error(succ.message);
		            }
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