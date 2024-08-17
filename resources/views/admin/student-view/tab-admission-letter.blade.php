<form action="{{ route('admin.student.store-student') }}" method="POST" class="m-t-15" id="form-admission-letter">

    <input type="hidden" name="form_tab" value="AdmissionLetterTab" >
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
        <div class="col-md-6 d-none">
            <div class="form-group">
                <label class="control-label">ADMISSION LETTER {{-- <span class="text-danger">*</span> --}}</label>
                <input type="text" value="{{ $edit_data && $edit_data->admission_letter ? $edit_data->admission_letter : ''  }}" class="form-control" name="admission_letter" placeholder="Enter ADMISSION LETTER">
            </div>
        </div>
        @if(Auth::user()->hasAnyRole(['Admin', 'Manager']))
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label">&nbsp;</label>
                <input id="admission_letter_doc" name="admission_letter_doc" type="file" class="form-control" {{ $edit_data && $edit_data->admission_letter_doc ? '' : 'required'  }}>
            </div>
        </div>
        @endif
        @if($edit_data && $edit_data->admission_letter_doc)
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label">View ADMISSION LETTER  </label>
                <p>
                    <a href="{{ $edit_data && $edit_data->admission_letter_doc ? url('uploads/student/documents/'. $edit_data->admission_letter_doc) : 'javascript:void(0)' }}" target="_blank" class="btn btn-gradient-info btn-sm">View</a>
                </p>
            </div>
        </div>
        @endif
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">Comment </label>
                <textarea class="form-control" name="admission_letter_comment" placeholder="Enter Comment">{{ $edit_data && $edit_data->admission_letter_comment ? $edit_data->admission_letter_comment : ''  }}</textarea>
            </div>
        </div>
    </div>
        
    <!--<div class="form-row text-right">
        @if(Auth::user()->hasAnyRole(['Admin', 'Manager']))
        <div class="col-sm-12">
            <div class="form-group">
                <div class="text-sm-right">
                    <button class="btn btn-default" type="reset">Reset</button>
                    <button class="btn btn-gradient-success" type="submit">Submit & Notify</button>
                </div>
            </div>
        </div>   
        @endif     
    </div>-->
</form>