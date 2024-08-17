<form action="{{ route('admin.student.store-student') }}" method="POST" class="m-t-15" id="form-interview-scheduled">

    <input type="hidden" name="form_tab" value="InterviewScheduledTab" >
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
            <h2><u>Schedule Interview</u></h2>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Platform</label>
                <select class="form-control" name="platform" > 
                    <option value="Zoom" selected="">Zoom</option>
                    <option value="Google Meet" selected="">Google Meet</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Meeting Link <span class="text-danger">*</span></label>
                <input type="text" value="" class="form-control" name="link" placeholder="">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Date <span class="text-danger">*</span></label>
                <input type="date" value="" class="form-control" name="date" placeholder="">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Time <span class="text-danger">*</span></label>
                <input type="text" value="" class="form-control" name="time" placeholder="">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="control-label">Comment <span class="text-danger">*</span></label>
                <input type="text" value="" class="form-control" name="comment" placeholder="">
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
    <div class="form-row">
        <div class="col-md-12">
            <h4>Scheduled Interview List</h4>
        </div>
        <div class="col-sm-12">
            <div class="table-overflow">
                <table id="dt-opt" class="table table-hover table-xl datatable interview-datatable">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Platform</th>
                            <th>Link</th>
                            <th>Date/Time</th>
                            <th>Comment</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="interview-datatable-body">
                        {{-- <tr>
                            <td>01</td>
                            <td>Zoom</td>
                            <td>zoom.com</td>
                            <td>12/03/2023 11:30AM</td>
                            <td>comment</td>
                            <td>Pending</td>
                        </tr>
                        <tr>
                            <td>02</td>
                            <td>Zoom</td>
                            <td>zoom.com</td>
                            <td>12/03/2023 11:30AM</td>
                            <td>comment</td>
                            <td>Done</td>
                        </tr>
                        <tr>
                            <td>03</td>
                            <td>Zoom</td>
                            <td>zoom.com</td>
                            <td>12/03/2023 11:30AM</td>
                            <td>comment</td>
                            <td>RESCHEDULED</td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>        
    </div>
</form>