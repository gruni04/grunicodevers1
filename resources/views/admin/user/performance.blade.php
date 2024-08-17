@extends('layouts.app')


@section('page-style')
    
    <link href="{{ url('assets/admin/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet">
    <style type="text/css">
    	.badge-pill{
    	    color:black;
    	}
    	
        .task-status-red{
            background-color: red;
        }
        .task-status-green{
            background-color: green;
        }
        .task-status-gray{
            background-color: gray;
        }
        .task-status-black{
            background-color: black;
            color:white;
        }
    </style>
@endsection


@section('content')
	
	<div class="card">
	    <div class="card-header border bottom">
	        <h4 class="card-title">User Details<!--{{ $sub_title }}--></h4>
	        <a href="{{ route('users.list.index') }}" class="btn btn-gradient-success" style="float: right;">Back</a>
	    </div>
	    <div class="card-body">
	        <div class="row">
	            <div class="col-sm-12">
	            	<div class="row">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label control-label text-dark">User Name:</label>
                                <div class="col-sm-8">
                                    <p class="form-control-plaintext">{{ $user && $user->name ? $user->name : '' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label control-label text-dark">User Email:</label>
                                <div class="col-sm-8">
                                    <p class="form-control-plaintext">{{ $user && $user->email ? $user->email : '' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label control-label text-dark">Grade:</label>
                                <div class="col-sm-8">
                                    <p class="form-control-plaintext final-grade">A++</p>
                                </div>
                            </div>
                        </div>
                    </div>
	            </div>
	            <div class="col-sm-12">
	            	<div class="row">
                        <h4>Filter By Date</h4><br>
                        <form class="form-inline" action="{{ route('user.performance', ['id'=>Crypt::encrypt($user->id)]) }}" method="GET" id="form">
                            <input type="text" readonly name="from_date" id="from_date" data-provide="datepicker" class="form-control datepicker-from date-pickerx m-b-20 m-r-15" value="{{ $from_date ? $from_date : '' }}" placeholder="dd-mm-yyyy" >
                            <input type="text" readonly name="to_date" id="to_date" data-provide="datepicker" class="form-control datepicker-to date-pickerx m-b-20 m-r-15" value="{{ $to_date ? $to_date : '' }}" placeholder="dd-mm-yyyy" >
                            <button type="submit" class="btn btn-gradient-success m-b-20">Filter</button>
                            <a  class="btn btn-gradient-info m-b-20" href="{{ route('user.performance', ['id'=>Crypt::encrypt($user->id)]) }}">Reset</a> 
                        </form>
                    </div>
	            </div>
	        </div>
	    </div>
	</div>
	<div class="card">
	    <div class="card-header border bottom">
	        <h4 class="card-title">Project Details</h4>
	    </div>
	    <div class="card-body">
	        <div class="accordion" id="accordion-default" role="tablist">
                @php
                    $i=1;
                    date_default_timezone_set('UTC');
                    $u_tasks = App\Models\ProjectUser::select('board_id')->where(['board_type'=>2, 'user_id'=>$user->id])->get();
                    $countable_project = $project_percentage = 0;
                @endphp
                @foreach ($projects as $key => $value)
                <div class="card">
                    <div class="card-header" role="tab">
                        <h5 class="card-title">
                            <a class="collapsed" data-toggle="collapse" href="#collapseThreeDefault{{$i}}" aria-expanded="false">
                                <span>{{ $value->project_name }} #{{$i}}</span>
                            </a>
                        </h5>
                    </div>
                    <div id="collapseThreeDefault{{$i}}" class="collapse" data-parent="#accordion-default">
                        <div class="card-header border bottom">
                	        <h5 class="card-title">{{ $value->project_name }} Tasks</h5>
                	    </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    
                                @php
                                    DB::connection()->enableQueryLog();
                                    $tasks = App\Models\ProjectTask::where(['project'=>$value->id])->whereIn('id', $u_tasks);//->get();
                                    if($from_date){
                                        $tasks = $tasks->whereDate('from_date', '>=', date('Y-m-d', strtotime(str_replace("/", "-", $from_date))));
                                    }
                                    if($to_date){
                                        $tasks = $tasks->whereDate('to_date', '<=', date('Y-m-d', strtotime(str_replace("/", "-", $to_date))));
                                    }
                                    $tasks = $tasks->get();
                                    $query = DB::getQueryLog();
                                    
                                    $j=1;
                                    $task_count = count($tasks);
                                    $done = 0;
                                @endphp
                                <p class="d-none">@php print_r($query) @endphp</p>
                                @foreach($tasks as $k => $v)
                                    @php
                                        $is_assigned = App\Models\ProjectUser::where(['user_id'=>$user->id, 'board_type'=>2, 'board_id'=>$v->id])->exists();
                                        if($is_assigned){
                                            $lable = App\Models\ProjectLable::where(['id'=>$v->lable])->first();//lable_color
                                            $task_status = '';
                                            $lable_history = App\Models\ProjectTaskLableHistory::orderby('id', 'asc')->where(['project_task_id'=>$v->id])->get();
                                            
                                            $consumed_time = $work_start_time = 0;
                                            foreach($lable_history as $lh_k => $lh_v){
                                                
                                                //$created_at_time = strtotime(explode(" ", $lh_v->created_at)[1]);
                                                
                                                switch ($lh_v->lable_id) {
                                                    case 1:
                                                        // code...Working on it
                                                        $work_start_time += strtotime($lh_v->created_at);
                                                        
                                                        break;
                                                    case 2:
                                                        // code...Stuck
                                                        break;
                                                    case 3 :
                                                        // code...Done
                                                        $consumed_time += $work_start_time > 0 ? strtotime($lh_v->created_at) - $work_start_time : 0;
                                                        $work_start_time = 0;
                                                        break;
                                                    case 4:
                                                        // code...New Task
                                                        break;
                                                    case 5:
                                                        // code...Testing(QA)
                                                        break;
                                                    case 6:
                                                        // code...Hold
                                                        $consumed_time += $work_start_time > 0 ? strtotime($lh_v->created_at) - $work_start_time : 0;
                                                        $work_start_time = 0;
                                                        break;
                                                }
                                            }
                                            //echo $consumed_time;
                                            $c_time = date("Y-m-d H:i", strtotime(date("H:i", $consumed_time)));
                                            $d_time = date("Y-m-d H:i", strtotime($v->from_time));
                                            //echo $c_time>$d_time ? date("H:i", strtotime($c_time)-strtotime($d_time)) : 0;
                                            
                                            if($lable->id==3 ){
                                                $extra_time_in_per = 1;
                                                if($consumed_time > 0 && isset($v->from_time) && $c_time>$d_time ){
                                                    $duration = strtotime($c_time)-strtotime($d_time);
                                                    
                                                    $c_minutes = (int)(date("H", $duration)*60)+(int)(date("i", $duration));
                                                    $d_minutes = (int)(date("H", strtotime($d_time))*60)+(int)(date("i", strtotime($d_time)));
                                                    $extra_time_in_per = $extra_time_in_per - ($c_minutes/$d_minutes);
                                                    if($extra_time_in_per <= 0){
                                                        $extra_time_in_per = 0;
                                                    }
                                                    $task_status = '<span class="badge badge-pill task-status-red" >Completed with '. date("H:i", $duration) .' Hour Late</span></p>';
                                                }
                                                $done = $extra_time_in_per+$done;
                                                
                                            }else{
                                                if(date("Y-m-d") > $v->to_date ){
                                                    $date_str = strtotime(date("Y-m-d")) - strtotime($v->to_date);
                                                    $task_status = '<span class="badge badge-pill task-status-red" >Not Completed, Due date:'.$v->to_date.', Late with '. $date_str/ 86400 .' days</span></p>';
                                                }
                                            }
                                            echo '<p>'.$v->task_name.'<span class="badge badge-pill " style="background-color:'.$lable->lable_color.'" >'.$lable->lable.'</span>';
                                            
                                            echo $task_status;
                                            
                                            echo '</p>';
                                        }
                                    @endphp
                                    
                                    @php
                                        $j++;
                                    @endphp
                                @endforeach
                                </div>
                                <div class="col-4">
                                    @php
                                        if($done>0){
                                            $percent = (100/$task_count)*$done;
                                            $grade = number_format($percent, 2);
                                        }else{
                                            $grade = 0;
                                        }
                                    @endphp
                                    
                                    @php
                                        $grade_symbol = "";
                                        $color="";
                                        
                                        switch (true) {
                                            case $grade >= 80:
                                                $grade_symbol = "A++";
                                                $color="green";
                                                break;
                                            
                                            case $grade >= 60 && $grade < 80:
                                                $grade_symbol = "A";
                                                $color="green";
                                                break;
                                            
                                            case $grade >= 50 && $grade < 60:
                                                $grade_symbol = "B";
                                                $color="orange";
                                                break;
                                            
                                            case $grade == 0:
                                                $grade_symbol = "";
                                                $color="";
                                                break;
                                            
                                            case $grade < 50:
                                                $grade_symbol = "C";
                                                $color="red";
                                                break;
                                            
                                            default:
                                                $grade_symbol = "X";
                                                $color="red";
                                                break;
                                        }
                                    @endphp
                                    @if($grade_symbol)
                                    @php
                                        $countable_project++;
                                        $project_percentage += $grade;
                                    @endphp
                                    <h3 style="color:{{ $color }}">Grade:{{ $grade_symbol }}, ({{$grade}}%)</h3>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $i++;
                @endphp
                @endforeach
            </div>
	    </div>
	</div>
@endsection


@section('page-script')
	    
    <script src="{{ url('assets/admin/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
    <script type="text/javascript">
        var total_grade = '{{ $project_percentage/$countable_project }}';
        var grade_symbol = color = '';
        switch (true) {
            case total_grade >= 80:
                grade_symbol = "A++";
                color="green";
                break;
            
            case total_grade >= 60 && total_grade < 80:
                grade_symbol = "A";
                color="green";
                break;
            
            case total_grade >= 50 && total_grade < 60:
                grade_symbol = "B";
                color="orange";
                break;
            
            case total_grade == 0:
                grade_symbol = "";
                color="";
                break;
            
            case total_grade < 50:
                grade_symbol = "C";
                color="red";
                break;
            
            default:
                grade_symbol = "X";
                color="red";
                break;
        }
        $(".final-grade").html(grade_symbol).css('color', color);
        // console.log(total_grade);
        $('.date-pickerx').datepicker({
             autoclose: true,
        });
        $(".date-pickerx").change(function(){
            
            var from_date = $("#from_date").val(), to_date = $("#to_date").val();
            if(!from_date || !to_date){
                return false;
            }
            from_date = changeFormatDate(from_date);
            to_date = changeFormatDate(to_date);
            //YYYY-MM-DD
            const x = new Date(from_date);
            const y = new Date(to_date);
            // console.log("dd"+from_date);
            if(x > y){
                _error("'From Date' should be less than 'To Date'");
                $("#to_date").val('')
                return false;
            }
        
        });
	</script>
@endsection