@extends('layouts.app')


@section('page-style')
    <link href="{{ url('assets/admin/vendor/selectize/dist/css/selectize.default.css')}}" rel="stylesheet">
    <link href="{{ url('assets/admin/vendor/summernote/dist/summernote-bs4.css')}}"  rel="stylesheet">
    <style type="text/css">
        .show_img{
           display: none;
        }
   </style>
@endsection


@section('content')
	
<form action="{{ route('user.update-user-profile') }}" method="POST" class="m-t-15" id="form" enctype="multipart/form-data" >
   <input type="hidden" name="id" value="{{ Crypt::encrypt($user->id) }}">
   <div class="card">
      <div class="card-header border bottom">
         <h4 class="card-title">Personal Details</h4>
         <a href="{{ route('users.list.index') }}" class="btn btn-gradient-success" style="float: right;">Back</a>
      </div>
      <div class="card-body">
         <div class="row">
            <div class="col-sm-12">
               <div class="form-row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Profile Image</label>
                        <input type="file" class="form-control" name="image" id="image" onchange="show_image(event)" />
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <div class="mb-3 <?php echo !empty($user_details) && !empty($user_details->image) ? '' : 'show_img' ?>">
                             <label class="form-label">Image Preview</label>
                             <button type="button" class="btn btn-danger remove-image" onclick="reset($('#image'))">Remove</button>
                             <img src="<?php echo !empty($user_details) && !empty($user_details->image) ? url($user_details->image) : '' ?>" title="attach image" style="width: 50%;" id="load_img" class="form-control ">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Name</label>
                        <input type="text" readonly class="form-control" placeholder="Enter Name"  value="{{ $user->name }}">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Father's Name *</label>
                        <input type="text" class="form-control" name="father_name" placeholder="Enter Father's Name "  value="{{ !empty($user_details) && $user_details->father_name ? $user_details->father_name : '' }}">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Date of Birth</label>
                        <input type="text" class="form-control" name="dob" placeholder="Enter Date of Birth"  value="{{ !empty($user_details) && $user_details->dob ? $user_details->dob : '' }}">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Gender</label>
                        <select class="form-control" name="gender" >
                           <option value="1">Male</option>
                           <option value="2">Female</option>
                           <option value="3">Other</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Phone Number</label>
                        <input type="number" class="form-control" name="phone" placeholder="Enter Phone Number"  value="{{ !empty($user_details) && $user_details->phone ? $user_details->phone : '' }}">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Local Address</label>
                        <textarea class="form-control" name="localaddress" placeholder="Enter Local Address">{{ !empty($user_details) && $user_details->localaddress ? $user_details->localaddress : '' }}</textarea>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Permanent Address</label>
                        <textarea class="form-control" name="premanent_address" placeholder="Enter Permanent Address" >{{ !empty($user_details) && $user_details->premanent_address ? $user_details->premanent_address : '' }}</textarea>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      
      {{-- Bank Details --}}
      <div class="card-header border bottom">
         <h4 class="card-title">Bank Details</h4>
      </div>
      <div class="card-body">
         <div class="row">
            <div class="col-sm-12">
               <div class="form-row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Account Holder Name</label>
                        <input type="text" class="form-control" name="ac_holder_name" placeholder="Enter Account Holder Name"  value="{{ !empty($user_details) && $user_details->ac_holder_name ? $user_details->ac_holder_name : '' }}">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Account Number</label>
                        <input type="text" class="form-control" name="ac_number" placeholder="Enter Account Number" value="{{ !empty($user_details) && $user_details->ac_number ? $user_details->ac_number : '' }}" >
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Bank Name</label>
                        <input type="text" class="form-control" name="bank_name" placeholder="Enter Bank Name" value="{{ !empty($user_details) && $user_details->bank_name ? $user_details->bank_name : '' }}" >
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Bank Identifier Code</label>
                        <input type="text" class="form-control" name="ifsc_code" placeholder="Enter Bank Identifier Code" value="{{ !empty($user_details) && $user_details->ifsc_code ? $user_details->ifsc_code : '' }}" >
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Branch Location</label>
                        <input type="text" class="form-control" name="branch_location" placeholder="Enter Branch Location" value="{{ !empty($user_details) && $user_details->branch_location ? $user_details->branch_location : '' }}" >
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Tax Payer Id </label>
                        <input type="text" class="form-control" name="tax_payer_id" placeholder="Enter Tax Payer Id " value="{{ !empty($user_details) && $user_details->tax_payer_id ? $user_details->tax_payer_id : '' }}" >
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      {{-- Documents --}}
      <div class="card-header border bottom">
         <h4 class="card-title">Documents</h4>
      </div>
      <div class="card-body">
         <div class="row">
            <div class="col-sm-12">
               <div class="form-row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Resume </label>
                        <input type="file" class="form-control" name="resume" >
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Offer Letter </label>
                        <input type="file" class="form-control" name="offer_letter" >
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Joining Letter</label>
                        <input type="file" class="form-control" name="joining_letter" >
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">Contract/Agreement</label>
                        <input type="file" class="form-control" name="agreement" >
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label">ID Proof</label>
                        <input type="file" class="form-control" name="id_proof" >
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      
   </div>

   <div class="form-row text-right">
      <div class="col-sm-12">
         <div class="form-group">
            <div class="text-sm-right">
               <button class="btn btn-default">Reset</button>
               <button class="btn btn-gradient-success">Submit</button>
            </div>
         </div>
      </div>
   </div>
</form>

@endsection


@section('page-script')
	    
    <script type="text/javascript">
      function show_image(event) {
        $("#load_img").attr('src', URL.createObjectURL(event.target.files[0]));
        $(".show_img").show();
      }
      $(document).on("click", ".remove-image", function(){
         $(".show_img").hide();
         $("#load_img").attr('src', '');
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