<form action="{{ route('admin.student.store-student') }}" method="POST" class="m-t-15" id="form-tution-fee">

    <input type="hidden" name="form_tab" value="TutionFeeTab" >
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
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Remailing Fee: </label>
                <span class="remaining-fee"> ${{ $edit_data && $edit_data->application_fee ? $edit_data->application_fee : ''  }}</span>
            </div>
        </div>
    </div>
    <div class="form-row custom-border-top">
        <div class="col-md-12 text-center">
            <h2><u>Fee Details</u></h2>
            {{-- <a href="javascript:void(0)" class="btn btn-gradient-success" style="float: right;">+</a> --}}
        </div>
        <div class="col-md-12 form-row">
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label">Payment Year</label>
                    <select class="form-control" name="fee_year" >
                        <option value="1" selected="">1st YEAR PAYMENT</option>
                        <option value="2">2nd YEAR PAYMENT</option>
                        <option value="3">3rd YEAR PAYMENT</option>
                        <option value="4">4th YEAR PAYMENT</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label">Amount in {{ $edit_data && $edit_data->currency && $edit_data->currency==1 ? "INR" : ($edit_data && $edit_data->currency && $edit_data->currency==2 ? "Dollar" : "")  }}<span class="text-danger">*</span></label>
                    <input type="text" value="" class="form-control" name="fee_amount" placeholder="">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">&nbsp;</label>
                    <input id="attatchment" name="attatchment" type="file" class="form-control" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Comment <span class="text-danger">*</span></label>
                    <input type="text" value="" class="form-control" name="comment" placeholder="">
                </div>
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
    <div class="form-row">
        <div class="col-md-12">
            <h4>Tution Fee History</h4>
        </div>
        <div class="col-sm-12">
            <div class="table-overflow">
                <table id="dt-opt" class="table table-hover table-xl datatable fee-history-datatable">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Year</th>
                            <th>Amount</th>
                            <th>Attatchment</th>
                            <th>Comment</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="tution-fee-history">
                        
                    </tbody>
                </table>
            </div>
        </div>        
    </div>
</form>