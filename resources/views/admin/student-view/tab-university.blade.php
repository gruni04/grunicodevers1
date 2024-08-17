<form action="{{ route('admin.student.store-student') }}" method="POST" class="m-t-15" id="form-university">

	<input type="hidden" name="form_tab" value="UniversityTab" >
    <input type="hidden" name="edit_id" class="edit_id" value="{{ $edit_data && $edit_data->id ? $edit_data->id : ''  }}" >
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
                <label class="control-label">Tution Fee </label>
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
    <div class="form-row custom-border-top d-none">
        <div class="col-md-12 text-center">
            <h2><u>FEE COMFIRMATION RECEIPT</u></h2>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label">PAYMENT TYPE <span class="text-danger">*</span></label>
                <input type="text" value="{{ $edit_data && $edit_data->university_payment_type ? $edit_data->university_payment_type : ''  }}" class="form-control" name="university_payment_type" placeholder="Enter PAYMENT TYPE">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label"></label>
                <input id="image" name="university_payment_doc" type="file" class="form-control" {{ $edit_data && $edit_data->university_payment_doc ? '' : 'required'  }}>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label">View </label>
                <p>
                    <a href="{{ $edit_data && $edit_data->university_payment_doc ? url('uploads/student/documents/'. $edit_data->university_payment_doc) : 'javascript:void(0)' }}" target="_blank" class="btn btn-gradient-info btn-sm">View</a>
                </p>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-12 text-center">
            <h2><u>Documents</u></h2>
            @if(Auth::user()->hasAnyRole(['Admin', 'Manager']))
            <a href="javascript:void(0)" class="btn btn-gradient-success university-add-documents" style="float: right;">+</a>
            @endif
        </div>
        <div class="col-md-12 form-row university-document-row">
            @if($edit_university_docs && count($edit_university_docs)>0)
                @foreach($edit_university_docs as $k=>$v)
                <div class="col-md-12 form-row university-document-section row-section">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">Document Type</label>
                            <select name="attatchment_type[]" class="form-control" readonly disabled>
                               <option value="MINISTRY ORDER" {{ $v->attatchment_type=="MINISTRY ORDER" ? "selected" : '' }} >MINISTRY ORDER</option>
                               <option value="RECOGNITION LETTER" {{ $v->attatchment_type=="RECOGNITION LETTER" ? "selected" : '' }}>RECOGNITION LETTER</option>
                               <option value="INSTITUTION LETTER" {{ $v->attatchment_type=="INSTITUTION LETTER" ? "selected" : '' }}>INSTITUTION LETTER</option>
                               <option value="CONFIRMATION LETTER" {{ $v->attatchment_type=="CONFIRMATION LETTER" ? "selected" : '' }}>CONFIRMATION LETTER</option>
                               <option value="RECTORS ORDER" {{ $v->attatchment_type=="RECTORS ORDER" ? "selected" : '' }}>RECTORS ORDER</option>
                               <option value="INSURANCE LETTER" {{ $v->attatchment_type=="INSURANCE LETTER" ? "selected" : '' }}>INSURANCE LETTER</option>
                               <option value="ACCOMMODATIONS LETTER" {{ $v->attatchment_type=="ACCOMMODATIONS LETTER" ? "selected" : '' }}>ACCOMMODATIONS LETTER</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">View/Delete </label>
                            <p>
                                <a href="{{ url('uploads/student/documents/'. $v->attatchment) }}" target="_blank" class="btn btn-gradient-info btn-sm">View</a>
                                @if(Auth::user()->hasAnyRole(['Admin', 'Manager']))
                                <a href="javascript:void(0)" class="btn btn-gradient-danger btn-sm delete-this-row" data-delete-id="{{ $v->id }}">Delete</a>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="col-md-2 d-none">
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
                @if(Auth::user()->hasAnyRole(['Admin', 'Manager']))
                <div class="col-md-12 form-row university-document-section row-section">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">Document Type <span class="text-danger">*</span></label>
                            <select name="attatchment_type[]" class="form-control">
                               <option value="MINISTRY ORDER" selected="">MINISTRY ORDER</option>
                               <option value="RECOGNITION LETTER">RECOGNITION LETTER</option>
                               <option value="INSTITUTION LETTER">INSTITUTION LETTER</option>
                               <option value="CONFIRMATION LETTER">CONFIRMATION LETTER</option>
                               <option value="RECTORS ORDER">RECTORS ORDER</option>
                               <option value="INSURANCE LETTER">INSURANCE LETTER</option>
                               <option value="ACCOMMODATIONS LETTER">ACCOMMODATIONS LETTER</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label"></label>
                            <input id="" name="attatchment[]" type="file" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">Remove </label>
                            <p>
                                <a href="javascript:void(0)" class="btn btn-gradient-danger btn-sm remove-this-row">Remove</a>
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            @endif
        </div>
    </div>
    @if(Auth::user()->hasAnyRole(['Admin', 'Manager']))
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
    @endif
</form>