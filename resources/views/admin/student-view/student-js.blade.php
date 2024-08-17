{{-- Global Start--}}
<script type="text/javascript">
    var interval = setInterval(function() {
        window.location.reload();
    }, 600000);
    
    $("input[type=submit]").attr("disabled");
</script>
{{-- Global end--}}


{{-- Application Tab Start --}}
<script type="text/javascript">
	$(document).on("click", ".application-add-documents", function(){
		// console.log("Init student js");
		var html = '';
		html += '<div class="col-md-12 form-row application-document-section row-section">\
	                <div class="col-md-2">\
	                    <div class="form-group">\
	                        <label class="control-label">Document Type <span class="text-danger">*</span></label>\
	                        <input type="text" value="" class="form-control" name="attatchment_type[]" placeholder="Document Type" list="attatchment_type">\
	                        <datalist id="attatchment_type">\
	                          <option value="AADHAR Card">AADHAR Card</option>\
	                          <option value="PASSPORT">PASSPORT</option>\
	                          <option value="NEET SCORE">NEET SCORE</option>\
	                          <option value="10th">10th</option>\
	                          <option value="12th">12th</option>\
	                          <option value="Other">Other</option>\
	                        </datalist>\
	                    </div>\
	                </div>\
	                <div class="col-md-2">\
	                    <div class="form-group">\
	                        <label class="control-label">Enter Score/Marks</label>\
	                        <input type="text" value="" class="form-control" name="attatchment_value[]" placeholder="Enter Score/Marks">\
	                    </div>\
	                </div>\
	                <div class="col-md-3">\
	                    <div class="form-group">\
	                        <label class="control-label">Document <span class="text-danger">*</span></label>\
	                        <input id="attatchment" name="attatchment[]" type="file" class="form-control">\
	                    </div>\
	                </div>\
	                <div class="col-md-2">\
	                    <div class="form-group">\
	                        <label class="control-label">Delete </label>\
	                        <p>\
	                            <a href="javascript:void(0)" class="btn btn-gradient-danger btn-sm remove-this-row">Remove</a>\
	                        </p>\
	                    </div>\
	                </div>\
	            </div>';

	    $(".application-document-row").append(html);
	});
	$(document).on("click", ".remove-this-row", function(){
		if(confirm("Are You sure want to remove this record?")){
	    	$(this).parents(".row-section").remove();
		}
	});
	$(document).on("click", ".delete-this-row", function(){
		if(confirm("Are You sure want to delete this record?")){
	    	var _this = this;
	    	var delete_id = $(this).data('delete-id');
	    	var student_id = $("#application_edit_id").val();
	    	if(delete_id=='' || delete_id==undefined){
	    		_error('Data not found, Please Try again later....');
	    		return false;
	    	}
	    	$.ajaxSetup({
		        headers: {
		              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
	    	$.ajax({
	              type: "POST",
	              url:'{{ route('admin.student.delete-student-docs')}}',
	              dataType:'json',
	              data: {delete_id:delete_id, student_id:student_id},
	              beforeSend:function() {},
	              success:function(responce)
	              {
	                if(responce.status==1)
	                {
	                    _success(responce.message);
	                    $(_this).parents(".row-section").remove();
	                }else{
	                   	_error(responce.message); 
	                }
	              },
	              error:function()
	              {
	                 	_error('Something Went Wrong..');
	              },
	              complete:function() { }
	        });
		}
	});
	$(document).on("change", ".update-document-status", function(){
		if(confirm("Are You sure want to Update Status of this record?")){
	    	var _this = this;
	    	var doc_id = $(this).data('doc-id');
	    	var status = $(this).val();
	    	var student_id = $("#application_edit_id").val();
	    	if(doc_id=='' || doc_id==undefined){
	    		_error('Data not found, Please Try again later....');
	    		return false;
	    	}
	    	$.ajaxSetup({
		        headers: {
		              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
	    	$.ajax({
	              type: "POST",
	              url:'{{ route('admin.student.update-student-docs-status')}}',
	              dataType:'json',
	              data: {doc_id:doc_id, student_id:student_id, status:status},
	              beforeSend:function() {},
	              success:function(responce)
	              {
	                if(responce.status==1)
	                {
	                    _success(responce.message);
	                    sendWhatsAppMessage(responce);
	                }else{
	                   	_error(responce.message); 
	                }
	              },
	              error:function()
	              {
	                 	_error('Something Went Wrong..');
	              },
	              complete:function() { }
	        });
		}
	});
	// Wait for the DOM to be ready
	$("#application-tab-form").validate({
		submitHandler: function(form){
		    $.ajaxSetup({
		        headers: {
		              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
		    event.preventDefault();
		    
			var form_data = new FormData(document.getElementById("application-tab-form"));
			$.ajax({
	              type: "POST",
	              url:$("#application-tab-form").attr('action'),
	              dataType:'json',
	              data: form_data,
	              contentType: false,
	              cache: false,
	              processData:false,
	              beforeSend:function() {},
	              success:function(responce)
	              {
	                if(responce.status==1 && responce.user_id!='' && responce.user_id!=undefined)
	                {
	                    _success(responce.message);
	                    sendWhatsAppMessage(responce);
	                    // if(responce.number && responce.notification){
	                    // }else{
	                    // 	// alert("No")
	                    // }
	                    window.setTimeout(function() {
	                    	window.location.href = '{{ url('admin/student/save-student') }}/'+responce.user_id;
	                    }, 1000);
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

	function sendWhatsAppMessage(responce){
		if(responce.number && responce.notification){
		    var number = responce.number, message = responce.notification;
			window.open("https://api.whatsapp.com/send?phone=91"+number+"&text="+message, '_blank').focus();
	    }
	}

	@if(isset($_GET['tab']) && !empty($_GET['tab']))
	var tab = '{{ $_GET['tab'] }}';
	$("#"+tab).click();
	@endif
</script>
{{-- Application Tab End --}}

{{-- Admission Letter Tab start --}}
<script type="text/javascript">
	// Wait for the DOM to be ready
	$("#form-admission-letter").validate({
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
			var form_data = new FormData(document.getElementById("form-admission-letter"));
			$.ajax({
	              type: "POST",
	              url:$("#form-admission-letter").attr('action'),
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
	                    sendWhatsAppMessage(responce);
	                    // window.setTimeout(function() {
	                    // 	window.location.href = '{{ url('admin/student/save-student') }}/'+responce.user_id;
	                    // }, 1000);c
	                    // $("#tution-fee-tab").removeClass("disabled");
	                }else{
	                   _error(responce.message); 
	                }
	              },
	              error:function()
	              {
	                 _error('Something Went Wrong..');
	              },
	              complete:function()
	              {}
	        });    
	    }
	});
</script>
{{-- Application Tab End --}}

{{-- Tution Fee Tab start --}}
<script type="text/javascript">
	// Wait for the DOM to be ready
	$("#form-tution-fee").validate({
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
			var form_data = new FormData(document.getElementById("form-tution-fee"));
			$.ajax({
	              type: "POST",
	              url:$("#form-tution-fee").attr('action'),
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
	                    $("#form-tution-fee")[0].reset();
	                    sendWhatsAppMessage(responce);
	                    // $('.fee-history-datatable').DataTable().destroy();
	                    // $("#interview-tab").removeClass("disabled").click();
	                    getFeeHistory();
	                }else{
	                   _error(responce.message); 
	                }
	              },
	              error:function()
	              {
	                 _error('Something Went Wrong..');
	              },
	              complete:function() {}
	        });    
	    }
	});
	// $('.fee-history-datatable').DataTable().destroy();
	getFeeHistory();
	function getFeeHistory(){
		//
		$.ajax({
              type: "GET",
              url:"{{ url('admin/student/get-fee-history') }}/{{ $edit_data && $edit_data->id ? $edit_data->id : ''  }}",
              dataType:'json',
              // data: form_data,
              beforeSend:function() {},
              success:function(responce)
              {
                if(responce.status==1)
                {
                    // _success(responce.message);
                    
                    if(responce.aaData.length>0){
                    	var html = '';
                    	for (var i = 0; i < responce.aaData.length; i++) {
                    		var fee = responce.aaData[i];
                    		html += '<tr>\
			                            <td>'+(i+1)+'</td>\
			                            <td>'+fee.fee_year+'</td>\
			                            <td>{{ $edit_data && $edit_data->currency && $edit_data->currency==1 ? "₹" : ($edit_data && $edit_data->currency && $edit_data->currency==2 ? "$" : "")  }}'+fee.fee_amount+'</td>\
			                            <td><a href="{{  url('uploads/student/documents') }}/'+fee.attatchment+'" target="_blank" class="btn btn-gradient-info btn-sm">View</a></td>\
			                            <td>'+(fee.comment ? fee.comment : '' )+'</td>\
			                            <td>'+fee.created_at+'</td>\
			                            @if(Auth::user()->hasAnyRole(['Admin', 'Manager']))\
			                            <td>\
			                            <select class="form-control update-fee-status" data-fee-id="'+fee.id+'" >\
			                                <option value="1" '+(fee.approval_status=='1' ? "selected" : "")+'>Approve</option>\
			                                <option value="2" '+(fee.approval_status=='2' ? "selected" : "")+'>Reject</option>\
			                                <option value="3" '+(fee.approval_status=='3' ? "selected" : "")+'>Pending</option>\
			                            </select>\
			                            </td>\
			                            @else\
			                            <td>'+(fee.approval_status=='1' ? "Approved" : (fee.approval_status=='2' ? "Reject" : "Pending") )+'</td>\
			                            @endif\
			                        </tr>';
                    	}
                    	$("#tution-fee-history").html(html);
                    }
                }else{
                   _error(responce.message); 
                }
              },
              error:function()
              {
                 _error('Something Went Wrong..');
              },
              complete:function() {}
        });		
	}
	$(document).on("change", ".update-fee-status", function(){
		if(confirm("Are You sure want to Update Status of this record?")){
	    	var _this = this;
	    	var fee_id = $(this).data('fee-id');
	    	var status = $(this).val();
	    	var student_id = $("#application_edit_id").val();
	    	if(fee_id=='' || fee_id==undefined){
	    		_error('Data not found, Please Try again later....');
	    		return false;
	    	}
	    	$.ajaxSetup({
		        headers: {
		              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
	    	$.ajax({
	              type: "POST",
	              url:'{{ route('admin.student.update-student-fee-status')}}',
	              dataType:'json',
	              data: {fee_id:fee_id, student_id:student_id, status:status},
	              beforeSend:function() {},
	              success:function(responce)
	              {
	                if(responce.status==1)
	                {
	                    _success(responce.message);
	                    sendWhatsAppMessage(responce);
	                }else{
	                   	_error(responce.message); 
	                }
	              },
	              error:function()
	              {
	                 	_error('Something Went Wrong..');
	              },
	              complete:function() { }
	        });
		}
	});
	
</script>
{{-- Tution Tab End --}}

{{-- Interview Tab start --}}
<script type="text/javascript">
	// Wait for the DOM to be ready
	$("#form-interview-scheduled").validate({
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
			var form_data = new FormData(document.getElementById("form-interview-scheduled"));
			$.ajax({
	              type: "POST",
	              url:$("#form-interview-scheduled").attr('action'),
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
	                    sendWhatsAppMessage(responce);
	                    $("#form-interview-scheduled")[0].reset();
	                    // $('.interview-history-datatable').DataTable().destroy();
	                    // $("#university-tab").removeClass("disabled").click();
	                    getInterviewHistory();
	                }else{
	                   _error(responce.message); 
	                }
	              },
	              error:function()
	              {
	                 _error('Something Went Wrong..');
	              },
	              complete:function() {}
	        });    
	    }
	});
	// $('.interview-datatable').DataTable().destroy();
	getInterviewHistory();
	function getInterviewHistory(){
		$.ajax({
              type: "GET",
              url:"{{ url('admin/student/get-interview-history') }}/{{ $edit_data && $edit_data->id ? $edit_data->id : ''  }}",
              dataType:'json',
              // data: form_data,
              beforeSend:function() {},
              success:function(responce)
              {
                if(responce.status==1)
                {
                    // _success(responce.message);
                    
                    if(responce.aaData.length>0){
                    	var html = '';
                    	for (var i = 0; i < responce.aaData.length; i++) {
                    		var interview = responce.aaData[i];
                    		html += '<tr>\
			                            <td>'+(i+1)+'</td>\
			                            <td>'+interview.platform+'</td>\
			                            <td>'+interview.link+'</td>\
			                            <td>'+interview.date+' '+interview.time+'</td>\
			                            <td>'+interview.comment+'</td>\
			                            @if(Auth::user()->hasAnyRole(['Admin', 'Manager']))\
			                            <td>\
			                            <select class="form-control update-interview-status" data-interview-id="'+interview.id+'" >\
			                                <option value="1" '+(interview.status=='1' ? "selected" : "")+'>Pending</option>\
			                                <option value="2" '+(interview.status=='2' ? "selected" : "")+'>Done</option>\
			                                <option value="3" '+(interview.status=='3' ? "selected" : "")+'>Reject</option>\
			                            </select>\
			                            </td>\
			                            @else\
			                            <td>'+(interview.status=='1' ? "Pending" : (interview.status=='2' ? "Done" : "Expired") )+'</td>\
			                            @endif\
			                        </tr>';
                    	}
                    	$(".interview-datatable-body").html(html);
                    }
                }else{
                   _error(responce.message); 
                }
              },
              error:function()
              {
                 _error('Something Went Wrong..');
              },
              complete:function() {}
        });
	}

	$(document).on("change", ".update-interview-status", function(){
		if(confirm("Are You sure want to Update Status of this record?")){
	    	var _this = this;
	    	var interview_id = $(this).data('interview-id');
	    	var status = $(this).val();
	    	var student_id = $("#application_edit_id").val();
	    	if(interview_id=='' || interview_id==undefined){
	    		_error('Data not found, Please Try again later....');
	    		return false;
	    	}
	    	$.ajaxSetup({
		        headers: {
		              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
	    	$.ajax({
	              type: "POST",
	              url:'{{ route('admin.student.update-student-interview-status')}}',
	              dataType:'json',
	              data: {interview_id:interview_id, student_id:student_id, status:status},
	              beforeSend:function() {},
	              success:function(responce)
	              {
	                if(responce.status==1)
	                {
	                    _success(responce.message);
	                    sendWhatsAppMessage(responce);
	                }else{
	                   	_error(responce.message); 
	                }
	              },
	              error:function()
	              {
	                 	_error('Something Went Wrong..');
	              },
	              complete:function() { }
	        });
		}
	});
</script>
{{-- Interview Tab End --}}

{{-- university Tab start --}}
<script type="text/javascript">
	$(document).on("click", ".university-add-documents", function(){
		// console.log("Init student js");
		var html = '';
		html += '<div class="col-md-12 form-row university-document-section row-section">\
                    <div class="col-md-2">\
                        <div class="form-group">\
                            <label class="control-label">Document Type <span class="text-danger">*</span></label>\
                            <select name="attatchment_type[]" class="form-control">\
                               <option value="MINISTRY ORDER" selected="">MINISTRY ORDER</option>\
                               <option value="RECOGNITION LETTER">RECOGNITION LETTER</option>\
                               <option value="INSTITUTION LETTER">INSTITUTION LETTER</option>\
                               <option value="CONFIRMATION LETTER">CONFIRMATION LETTER</option>\
                               <option value="RECTORS ORDER">RECTORS ORDER</option>\
                               <option value="INSURANCE LETTER">INSURANCE LETTER</option>\
                               <option value="ACCOMMODATIONS LETTER">ACCOMMODATIONS LETTER</option>\
                            </select>\
                        </div>\
                    </div>\
                    <div class="col-md-3">\
                        <div class="form-group">\
                            <label class="control-label"></label>\
                            <input id="" name="attatchment[]" type="file" class="form-control" required>\
                        </div>\
                    </div>\
                    <div class="col-md-2">\
	                    <div class="form-group">\
	                        <label class="control-label">Remove </label>\
	                        <p>\
	                            <a href="javascript:void(0)" class="btn btn-gradient-danger btn-sm remove-this-row">Remove</a>\
	                        </p>\
	                    </div>\
	                </div>\
                </div>';
	    $(".university-document-row").append(html);
	});

	// Wait for the DOM to be ready
	$("#form-university").validate({
		submitHandler: function(form){
		    $.ajaxSetup({
		        headers: {
		              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
		    event.preventDefault();
		    
			var form_data = new FormData(document.getElementById("form-university"));
			$.ajax({
	              type: "POST",
	              url:$("#form-university").attr('action'),
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
	                    sendWhatsAppMessage(responce);
	                    // $("#form-university")[0].reset();
	                    // $("#indian-office-tab").removeClass("disabled").click();
	                }else{
	                   _error(responce.message); 
	                }
	              },
	              error:function()
	              {
	                 _error('Something Went Wrong..');
	              },
	              complete:function() {}
	        });    
	    }
	});
	
</script>
{{-- university Tab End --}}

{{-- indian office Tab start --}}
<script type="text/javascript">
	// Wait for the DOM to be ready
	$("#form-indian-office").validate({
		submitHandler: function(form){
		    $.ajaxSetup({
		        headers: {
		              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
		    event.preventDefault();
		    
			var form_data = new FormData(document.getElementById("form-indian-office"));
			$.ajax({
	              type: "POST",
	              url:$("#form-indian-office").attr('action'),
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
	                    sendWhatsAppMessage(responce);
	                    // $("#form-indian-office")[0].reset();
	                    // $("#hostel-tab").removeClass("disabled").click();
	                }else{
	                   _error(responce.message); 
	                }
	              },
	              error:function()
	              {
	                 _error('Something Went Wrong..');
	              },
	              complete:function() {}
	        });    
	    }
	});

	$(document).on("change", ".update-indian-office-document-status", function(){
		if(confirm("Are You sure want to Update Status of this record?")){
	    	
	    	var status = $(this).val();
	    	var student_id = $("#application_edit_id").val();
	    	
	    	$.ajaxSetup({
		        headers: {
		              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
	    	$.ajax({
	              type: "POST",
	              url:'{{ route('admin.student.update-student-indian-office-document-status')}}',
	              dataType:'json',
	              data: {student_id:student_id, status:status},
	              beforeSend:function() {},
	              success:function(responce)
	              {
	                if(responce.status==1)
	                {
	                    _success(responce.message);
	                    sendWhatsAppMessage(responce);
	                }else{
	                   	_error(responce.message); 
	                }
	              },
	              error:function()
	              {
	                 	_error('Something Went Wrong..');
	              },
	              complete:function() { }
	        });
		}
	});
	
</script>
{{-- indian office Tab End --}}

{{-- university Tab start --}}
<script type="text/javascript">	
	// Wait for the DOM to be ready
	$("#form-hostel").validate({
		submitHandler: function(form){
		    $.ajaxSetup({
		        headers: {
		              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
		    event.preventDefault();
		    
			var form_data = new FormData(document.getElementById("form-hostel"));
			$.ajax({
	              type: "POST",
	              url:$("#form-hostel").attr('action'),
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
	                    getHostelFeeHistory();
	                    $("#form-hostel")[0].reset();
	                    sendWhatsAppMessage(responce);
	                }else{
	                   _error(responce.message); 
	                }
	              },
	              error:function()
	              {
	                 _error('Something Went Wrong..');
	              },
	              complete:function() {}
	        });    
	    }
	});
	getHostelFeeHistory();
	function getHostelFeeHistory(){
		$.ajax({
              type: "GET",
              url:"{{ url('admin/student/get-hostel-fee-history') }}/{{ $edit_data && $edit_data->id ? $edit_data->id : ''  }}",
              dataType:'json',
              // data: form_data,
              beforeSend:function() {},
              success:function(responce)
              {
                if(responce.status==1)
                {
                    // _success(responce.message);
                    
                    if(responce.aaData.length>0){
                    	var html = '';
                    	for (var i = 0; i < responce.aaData.length; i++) {
                    		var fee = responce.aaData[i];
                    		html += '<tr>\
			                            <td>'+(i+1)+'</td>\
			                            <td>'+fee.fee_year+'</td>\
			                            <td>{{ $edit_data && $edit_data->currency && $edit_data->currency==1 ? "₹" : ($edit_data && $edit_data->currency && $edit_data->currency==2 ? "$" : "")  }}'+fee.fee_amount+'</td>\
			                            <td><a href="{{  url('uploads/student/documents') }}/'+fee.attatchment+'" target="_blank" class="btn btn-gradient-info btn-sm">View</a></td>\
			                            <td>'+fee.created_at+'</td>\
			                            @if(Auth::user()->hasAnyRole(['Admin', 'Manager']))\
			                            <td>\
			                            <select class="form-control update-fee-status" data-fee-id="'+fee.id+'" >\
			                                <option value="1" '+(fee.approval_status=='1' ? "selected" : "")+'>Approve</option>\
			                                <option value="2" '+(fee.approval_status=='2' ? "selected" : "")+'>Reject</option>\
			                                <option value="3" '+(fee.approval_status=='3' ? "selected" : "")+'>Pending</option>\
			                            </select>\
			                            </td>\
			                            @else\
			                            <td>'+(fee.approval_status=='1' ? "Approved" : (fee.approval_status=='2' ? "Reject" : "Pending") )+'</td>\
			                            @endif\
			                        </tr>';
                    	}
                    	$("#hostel-fee-list").html(html);
                    }
                }else{
                   _error(responce.message); 
                }
              },
              error:function()
              {
                 _error('Something Went Wrong..');
              },
              complete:function() {}
        });
	}
</script>
{{-- university Tab End --}}