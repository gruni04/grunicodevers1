<form action="{{ route('admin.student.store-student') }}" method="POST" class="m-t-15" id="form-indian-office">

	<input type="hidden" name="form_tab" value="IndianOfficeTab" >
    <input type="hidden" name="edit_id" value="{{ $edit_data && $edit_data->id ? $edit_data->id : ''  }}" >
    <div class="form-row">
        <div class="col-md-12 text-center">
            <h2><u>Student Details</u></h2>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Agent/Partner ID </label>
                <input type="text" readonly="" class="form-control" placeholder="Agent/Partner ID" value="{{ $edit_data && $edit_data->agent_partner_id ? $edit_data->agent_partner_id : $user_id_number  }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label">Tution Fee <span class="text-danger">*</span></label>
                <input type="text" value="{{ $edit_data && $edit_data->application_fee ? $edit_data->application_fee : ''  }}" class="form-control" name="application_fee" placeholder="Tution Fee" required {{ $edit_data && $edit_data->application_fee ? 'readonly' : ''  }}>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label">Currency</label>
                <select name="currency" class="form-control" required {{ $edit_data && $edit_data->currency ? 'disabled' : ''  }}>
                    <option value="1" {{ !empty($edit_data) && $edit_data->currency==1 ? "selected":''}}>INR(₹)</option>
                    <option value="2" {{ !empty($edit_data) && $edit_data->currency==2 ? "selected":''}}>Dollar($)</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Name </label>
                <input type="text" value="{{ $edit_data && $edit_data->name ? $edit_data->name : ''  }}" class="form-control" name="name" placeholder="Enter Name" required {{ $edit_data && $edit_data->name ? 'readonly' : ''  }}>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Student Id </label>
                <input type="text" value="{{ $edit_data && $edit_data->student_id ? $edit_data->student_id : ''  }}" readonly class="form-control" placeholder="">
            </div>
        </div>
    </div>
    <div class="form-row custom-border-top">
        <div class="col-md-12 text-center">
            <h2><u>VISA DETAILS</u></h2>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">VISA DETAILS <span class="text-danger">*</span></label>
                <input type="text" value="{{ $edit_data && $edit_data->visa_details ? $edit_data->visa_details : ''  }}" class="form-control" name="visa_details" placeholder="Enter VISA DETAILS">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label"></label>
                <input id="image" name="visa_details_doc" type="file" class="form-control" {{ $edit_data && $edit_data->visa_details_doc ? '' : 'required'  }}>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label">Date<span class="text-danger">*</span></label>
                <input type="date" value="{{ $edit_data && $edit_data->visa_details_date ? $edit_data->visa_details_date : ''  }}" class="form-control" name="visa_details_date" placeholder="Enter PAYMENT TYPE">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label">View </label>
                <p>
                    <a href="{{ $edit_data && $edit_data->visa_details_date ? url('uploads/student/documents/'. $edit_data->visa_details_date) : 'javascript:void(0)' }}" target="_blank" class="btn btn-gradient-info btn-sm">View</a>
                </p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label">Status </label>
                {{-- visa_details_status --}}
                @if(Auth::user()->hasAnyRole(['Admin', 'Manager']))
                <select class="form-control update-indian-office-document-status" >
                    <option value="1" {{ $edit_data && $edit_data->visa_details_status=="1" ? "selected" : "" }}>Approve</option>
                    <option value="2" {{ $edit_data && $edit_data->visa_details_status=="2" ? "selected" : "" }}>Pending</option>
                    <option value="3" {{ $edit_data && $edit_data->visa_details_status=="3" ? "selected" : "" }}>Reject</option>
                </select>
                @else
                <p>{{ $edit_data && $edit_data->visa_details_status=="1" ? "Approved" : ($edit_data && $edit_data->visa_details_status=="3" ? "Reject" : "Pending")  }}</p>
                @endif
            </div>
        </div>
    </div>
            
    <!--<div class="form-row text-right">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="text-sm-right">
                    <button class="btn btn-default" type="reset">Reset</button>
                    <button class="btn btn-gradient-success" type="submit">Submit & Notify</button>
                </div>
            </div>
        </div>        
    </div>-->
</form>