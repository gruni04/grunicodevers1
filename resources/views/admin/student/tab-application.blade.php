<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<form action="{{ route('admin.student.store-student') }}" method="POST" class="m-t-15" id="application-tab-form">

	<input type="hidden" name="form_tab" value="ApplicationTab" >
    <input type="hidden" id="application_edit_id" name="application_edit_id" value="{{ $edit_data && $edit_data->id ? $edit_data->id : ''  }}" >
    <div class="form-row border bottom">
        <div class="col-md-12 text-center">
            <h2><u>Student Details</u></h2>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Agent/Partner ID <span class="text-danger">*</span></label>
                <input type="text" readonly="" class="form-control" placeholder="Agent/Partner ID" value="{{ $edit_data && $edit_data->agent_partner_id ? $edit_data->agent_partner_id : $user_id_number  }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label">Tution Fee <span class="text-danger">*</span></label>
                <input type="text" value="{{ $edit_data && $edit_data->application_fee ? $edit_data->application_fee : ''  }}" class="form-control application_fee" name="application_fee" placeholder="Tution Fee" required readonly>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label">Currency</label>
                <select name="currency" class="form-control get-fee" required {{ $edit_data && $edit_data->currency ? 'disabled' : ''  }}>
                    <option value="1" {{ !empty($edit_data) && $edit_data->currency==1 ? "selected":''}}>INR(₹)</option>
                    <option value="2" {{ !empty($edit_data) && $edit_data->currency==2 ? "selected":''}}>Dollar($)</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Name <span class="text-danger">*</span></label>
                <input type="text" value="{{ $edit_data && $edit_data->name ? $edit_data->name : ''  }}" class="form-control" maxlength="30" name="name" onkeydown="return alphaOnly(event)" placeholder="Enter Name" required {{ $edit_data && $edit_data->name ? 'readonly' : ''  }}>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label">Photo<span class="text-danger">*</span></label>
                <input id="photo" name="photo" type="file" class="form-control file1" {{ $edit_data && $edit_data->photo ? '' : 'required'  }}>
            </div>
        </div>
        <div class="col-md-2">
            <img src="" class="img img-fluid" style="width: 75%;">
        </div>
        @if($edit_data && $edit_data->photo)
        <div class="col-md-2">
            <img src="{{ $edit_data && $edit_data->photo ? url('uploads/student/'.$edit_data->photo) : ''  }}" class="img img-fluid" style="width: 75%;">
        </div>
        @endif
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">DOB <span class="text-danger">*</span></label>
                <input type="date" value="{{ $edit_data && $edit_data->dob ? $edit_data->dob : ''  }}" class="form-control" name="dob" placeholder="Enter DOB" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Mobile Number<span class="text-danger">*</span></label>
                <input type="number" value="{{ $edit_data && $edit_data->mobile ? $edit_data->mobile : ''  }}" class="form-control" name="mobile" placeholder="Enter Mobile Number" required min="0">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Father Name <span class="text-danger">*</span></label>
                <input type="text" value="{{ $edit_data && $edit_data->father_name ? $edit_data->father_name : ''  }}" class="form-control" onkeydown="return alphaOnly(event)" name="father_name" placeholder="Enter Father Name" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Parents Mobile Number<span class="text-danger">*</span></label>
                <input type="number" value="{{ $edit_data && $edit_data->parent_mobile ? $edit_data->parent_mobile : ''  }}" class="form-control" name="parent_mobile" placeholder="Enter Parents Mobile Number" required min="0">
            </div>
        </div>
        <?php 
        if(!empty($edit_data->id)){
        $mobil_duplicate = DB::table('tbl_student_fee_history')->where('student_id', $edit_data->id)->first();
        if(!empty($mobil_duplicate->fee_amount)){
        $total = $edit_data->application_fee - $mobil_duplicate->fee_amount; 
        if($edit_data->currency==1){
            $cur = 'INR';
        }else{
            $cur = 'DOLLAR';
        }
        
        
      //  print_r($total); die;
    ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">Total Remaining Fee</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label"><?php echo $cur;?> <?php echo $total;?></label>
            </div>
        </div>
        <?php } }?>
    </div>
    
    <div class="form-row border bottom">
        <div class="col-md-12 text-center">
            <h2><u>Documents</u></h2>
            <a href="javascript:void(0)" class="btn btn-gradient-success application-add-documents" style="float: right;">+</a>
        </div>
        <div class="col-md-12 form-row application-document-row">
            @if($edit_application_docs && count($edit_application_docs)>0)
                @foreach($edit_application_docs as $k=>$v)
                <div class="col-md-12 form-row application-document-section row-section">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">Document Type <span class="text-danger">*</span></label>
                            <input type="text" value="{{ $v->attatchment_type }}" class="form-control" readonly placeholder="Document Type" list="attatchment_type" >
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">Enter Score/Marks </label>
                            <input type="text" value="{{ $v->attatchment_value }}" readonly class="form-control" placeholder="Enter Score/Marks">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">View/Delete </label>
                            <p>
                                <a href="{{ url('uploads/student/documents/'. $v->attatchment) }}" target="_blank" class="btn btn-gradient-info btn-sm">View</a>
                                <a href="javascript:void(0)" class="btn btn-gradient-danger btn-sm delete-this-row" data-delete-id="{{ $v->id }}">Delete</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">Approval Status </label>
                            @if(Auth::user()->hasAnyRole(['Admin', 'Manager']))
                            <select class="form-control update-document-status" data-doc-id="{{ $v->id }}" >
                                <option value="1" {{ $v->approved_status=="1" ? "selected" : "" }}>Approve</option>
                                <option value="2" {{ $v->approved_status=="2" ? "selected" : "" }}>Pending</option>
                            </select>
                            @else
                            <p>{{ $v->approved_status=="1" ? "Approve" : "Pending" }}</p>
                            @endif
                        </div>
                    </div>
                     @if($v->approved_status=="1")
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">Status</label><br>
                            <img src="{{url('uploads/student/png.png')}}" class="img img-fluid" style="width: 25%;">
                        </div>
                    </div>
                     @endif
                </div>
                @endforeach
            @else
            <div class="col-md-12 form-row application-document-section row-section">
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label">Document Type <span class="text-danger">*</span></label>
                        <input type="text" value="" class="form-control attatchment_type" name="attatchment_type[]" placeholder="Document Type" list="attatchment_type" required>
                        <datalist id="attatchment_type">
                          <option value="AADHAR Card">AADHAR Card</option>
                          <option value="PASSPORT">PASSPORT</option>
                          <option value="NEET SCORE">NEET SCORE</option>
                          <option value="10th">10th</option>
                          <option value="12th">12th</option>
                          <option value="Other">Other</option>
                        </datalist>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group parent-container">
                        <label class="control-label">Enter Score/Marks {{-- Percentage <span class="text-danger">*</span> --}}</label>
                        <input type="text" value="" class="form-control attatchment_value" name="attatchment_value[]" id="attatchment_value" placeholder="Enter Score/Marks" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Document <span class="text-danger">*</span></label>
                        <input id="attatchment" name="attatchment[]" type="file" class="form-control file2" required>
                    </div>
                </div>
                <div class="col-md-2" style="margin-top:5px;">
                    <img src="" class="img img-fluid" style="width: 60%;">
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label">View/Delete </label>
                        <p>
                            <a href="javascript:void(0)" class="btn btn-gradient-danger btn-sm remove-this-row">Remove</a>
                        </p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-12 text-center">
            <h2><u>Address</u></h2>
        </div>
    	<div class="col-md-4">
            <div class="form-group">
                <label class="control-label">Country</label>
            	<select name="country" class="form-control" required>
                    <option value="1">India</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label">STATE<span class="text-danger">*</span></label>
                @php
                    $states = DB::table('tbl_states')->get();
                @endphp
                <select class="form-control">
                @foreach($states as $key=>$val)
                    <option value="{{ $val->name }}" {{ ($edit_data && $edit_data->state==$val->name) ? 'Selected' : ''  }}>{{$val->name}}</option>
                @endforeach
                </select>
                
                <!--<input type="text" value="{{ $edit_data && $edit_data->state ? $edit_data->state : ''  }}" class="form-control" name="state" placeholder="Enter STATE" required>-->
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label">CITY <span class="text-danger">*</span></label>
                <input type="text" value="{{ $edit_data && $edit_data->city ? $edit_data->city : ''  }}" class="form-control" name="city" placeholder="Enter CITY" required>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">Address <span class="text-danger">*</span></label>
                <textarea class="form-control" name="address" placeholder="Enter Address" required>{{ $edit_data && $edit_data->address ? $edit_data->address : ''  }}</textarea>
            </div>
        </div>
        
    </div>
    
    <div class="form-row text-right">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="text-sm-right">
                    <button class="btn btn-default" type="reset">Reset</button>
                    <button class="btn btn-gradient-success" type="submit">Submit & Notify</button>
                </div>
            </div>
        </div>        
    </div>
</form>

<script>
    //Onkeyup alpha validation script
	function alphaOnly(event) {
        var key = event.keyCode;
        var inputValue = event.target.value;
        
        if (key === 190 && event.key === '>') {
            return false;
        }

        if ((key >= 65 && key <= 90) || key == 8 || (key == 190 && inputValue.lastIndexOf(".") < inputValue.length - 1) ||
            (key == 32 && inputValue.lastIndexOf(" ") < inputValue.length - 1)) {
            return true;
        } else {
            return false;
        }
    };
    
    
   
   //Image preview
	$('.file1').change( function(event) {
    	var tmppath = URL.createObjectURL(event.target.files[0]);
    	// $(this).next("img").attr('src',tmppath);
    	$(this).parent().parent().next().children('img').attr('src',tmppath);
    });
    
    $('.file2').change( function(event) {
    	var tmppath = URL.createObjectURL(event.target.files[0]);
    	// $(this).next("img").attr('src',tmppath);
    	$(this).parent().parent().next().children('img').attr('src',tmppath);
    });

    
   $(document).ready(function() {
      $(document).on('change', '.attatchment_type', function() {
        var selectedValue = $(this).val();
        var inputElement = $(this).closest('.application-document-section').find('.attatchment_value');
        if (selectedValue === 'AADHAR Card') {
          inputElement.attr('placeholder', 'Enter AADHAR Card Number');
        } else if (selectedValue === 'PASSPORT') {
          inputElement.attr('placeholder', 'Enter PASSPORT Number');
        } else if (selectedValue === 'NEET SCORE') {
          inputElement.attr('placeholder', 'Enter NEET SCORE ');
        } else if (selectedValue === '10th') {
          inputElement.attr('placeholder', 'Enter 10th Marks');
        } else if (selectedValue === '12th') {
          inputElement.attr('placeholder', 'Enter 12th Marks');
        } else if (selectedValue === 'Other') {
          inputElement.attr('placeholder', 'Enter Other');
        } else {
          inputElement.attr('placeholder', 'Default Placeholder');
        }
      });
    });
    
    
    $(document).on('change', '.get-fee', function() {
        var type = $(this).val();
        $.ajax({
            url: '/get-student-fee',
            method: 'post',
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
            data:{type:type},
            
            success: function(response){  
                console.log(response); 
                $('.application_fee').val(response.fee);
            },
        });
    });
  </script>