<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquiry;
use Spatie\Permission\Models\Role;
use URL;
use File;
use Validator;
use Str;
use DB;
use Hash;
use Session;
use Crypt;
use Cache;
use Image;
use Auth;
use Mail;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        // $response = file_get_contents('https://expert.propertyfinder.ae/feed/newlaunch/propertyfinder/ad20af04d8886773a4fb37a61bcfee48');
        // $xml = simplexml_load_string($response);
        // $json = json_encode($xml);
        // $array = json_decode($json,TRUE);
        // echo "<pre>";
        // print_r($array);die;
        $data['title']="Student";
        $data['title_url']=route('admin.student.index');
        $data['sub_title']="Student List";
        return view('admin.student.index',$data);
    }


    public function profile_list(Request $request)
    {
        // $response = file_get_contents('https://expert.propertyfinder.ae/feed/newlaunch/propertyfinder/ad20af04d8886773a4fb37a61bcfee48');
        // $xml = simplexml_load_string($response);
        // $json = json_encode($xml);
        // $array = json_decode($json,TRUE);
        // echo "<pre>";
        // print_r($array);die;
        $data['title']="Profile";
        $data['title_url']=route('admin.student.profile_list');
        $data['sub_title']="Profile Details";
        return view('admin.student.profile_listing',$data);
    }

    public function save($id='')
    {
        $data['title']="Student";
        $data['title_url']=route('admin.student.index');
        $data['sub_title']="Save Student";
        $data['teaching_cateogry'] = array();

        $data['edit_data'] = array();
        $data['edit_application_docs'] = array();
        $data['edit_university_docs'] = array();
        $data['user_id_number'] = '';
        if(!empty($id)){
            $data['edit_data'] = DB::table('tbl_student')->where('id', $id)->first();
            $data['edit_application_docs'] = DB::table('tbl_student_document')->where('doc_for', 1)->where('student_id', $id)->get();
            $data['edit_university_docs'] = DB::table('tbl_student_document')->where('doc_for', 2)->where('student_id', $id)->get();
            // print_r($data['edit_application_docs']);die;
        }else{
            $data['user_id_number'] = Auth::user()->id_number;
        }
        // print_r($data['edit_data']);die;
        // echo Auth::user()->id;die;
        return view('admin.student.save-student', $data);
    }
    public function view($id)
    {
        $data['title']="Student";
        $data['title_url']=route('admin.student.index');
        $data['sub_title']="View Student";
        $data['teaching_cateogry'] = array();

        $data['edit_data'] = array();
        $data['edit_application_docs'] = array();
        $data['edit_university_docs'] = array();
        $data['user_id_number'] = '';
        if(!empty($id)){
            $data['edit_data'] = DB::table('tbl_student')->where('id', $id)->first();
            $data['edit_application_docs'] = DB::table('tbl_student_document')->where('doc_for', 1)->where('student_id', $id)->get();
            $data['edit_university_docs'] = DB::table('tbl_student_document')->where('doc_for', 2)->where('student_id', $id)->get();
            // print_r($data['edit_application_docs']);die;
        }else{
            $data['user_id_number'] = Auth::user()->id_number;
        }
        // print_r($data['edit_data']);die;
        // echo Auth::user()->id;die;
        return view('admin.student-view.save-student', $data);
    }

    public function store(Request $request)
    {
        // echo count($_POST['attatchment_type']);
        // print_r($_POST);die;
        $form_tab = $request->form_tab;
        $response_status = false;
        $message = '';
        switch ($form_tab) {
            case 'ApplicationTab':
                $response = $this->store_application($request);
                // $message = 'Application Saved Successfully';
                break;
            case 'AdmissionLetterTab':
                $response = $this->store_admission_letter($request);
                break;
            case 'TutionFeeTab':
                $response = $this->store_tutuion_fee($request);
                break;
            case 'InterviewScheduledTab':
                $response = $this->store_interview_scheduled($request);
                break;

            case 'UniversityTab':
                $response = $this->store_university($request);
                break;

            case 'IndianOfficeTab':
                $response = $this->store_indian_office($request);
                break;

            case 'HostelTab':
                $response = $this->store_hostel($request);
                break;

            default:
                $response = ['status'=>0, 'message'=>'Something went wrong....'];
                break;
        }
        // echo "string";die;


        return $response;
    }
    /*
        Application
            All person

        Admission
            other than agent/partner

        Tution Fee
            All person

        Interview
            Admin, Manager

        University
            Admin, Manager

        Indian Office
            Admin, agent/partner

        Hostel
            Admin, agent/partner*/
    private function store_application($request)
    {
         $id = $request->application_edit_id;
        if(empty($id)){
        $mobil_duplicate = DB::table('tbl_student')->where('mobile', $request->mobile)->count();

        if($mobil_duplicate > 0){
          return response()->json(['status'=>2, 'message'=>'Mobile Number Already Exist']);
        }
        }
        $validator = Validator::make($request->all(), [
            'application_fee' => 'required',
            'currency' => 'required',
            'name' => 'required',
            // 'photo' => 'required',
            'dob' => 'required',
            'mobile' => 'required',
            'father_name' => 'required',
            'parent_mobile' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status'=>2, 'message'=>$validator->errors()->all()]);
        }

        // print_r($_POST);die;
        $data['agent_partner_id'] = Auth::user()->id_number;
        $data['application_fee'] = $request->application_fee;
        $data['currency'] = $request->currency;
        $data['name'] = $request->name;
        if($request->file('photo')){
            $data['photo'] = $this->doUpload('photo','student',$request);
        }
        $data['dob'] = $request->dob;
        $data['mobile'] = $request->mobile;
        $data['father_name'] = $request->father_name;
        $data['parent_mobile'] = $request->parent_mobile;
        $data['country'] = $request->country;
        $data['state'] = $request->state;
        $data['city'] = $request->city;
        $data['address'] = $request->address;
        if($request->application_edit_id && $request->application_edit_id>0){
            $s_id = $request->application_edit_id;
            DB::table('tbl_student')->where('id', $request->application_edit_id)->update($data);
        }else{
            $s_id = DB::table('tbl_student')->insertGetId($data);
            $unique_id = "GRUNI-IN-S0000".($s_id+1);
            DB::table('tbl_student')->where('id', $s_id)->update(['student_id'=>$unique_id]);
        }
        if(count($_POST['attatchment_type'])>0){
            $data = array();
            for ($i=0; $i < count($_POST['attatchment_type']); $i++) {
                $sub_array = array();
                $sub_array['doc_for'] = 1;
                $sub_array['student_id'] = $s_id;
                $sub_array['attatchment_type'] = $_POST['attatchment_type'][$i];
                $sub_array['attatchment_value'] = $_POST['attatchment_value'][$i];
                $passport_duplicate = DB::table('tbl_student_document')->where('attatchment_value', $_POST['attatchment_value'][$i])->count();
                if($passport_duplicate > 0){
                    return response()->json(['status'=>2, 'message'=>'Paasport Number Already Exist']);
                }
                $sub_array['attatchment'] = $this->doUploadImages("attatchment", "student/documents", $request, $i);
                $data[] = $sub_array;
            }
            if(count($data)>0){
                DB::table('tbl_student_document')->insert($data);
            }
        }
        $res = $this->store_notification($s_id, "application");

        return response()->json([ 'status'=>1, 'message'=>'Student Save successfully', 'user_id'=>$s_id, 'number'=>$res['user_contact'], 'notification'=>$res['msg'] ]);
        // return ['status'=>1, 'message'=>'Student Save successfully', 'user_id'=>$s_id];
    }
    private function store_admission_letter($request)
    {
        $validator = Validator::make($request->all(), [
            // 'admission_letter' => 'required',
            // 'admission_letter_doc' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status'=>2, 'message'=>$validator->errors()->all()]);
        }

        $data['admission_letter'] = $request->admission_letter;
        $data['admission_letter_comment'] = $request->admission_letter_comment;
        if($request->file('admission_letter_doc')){
            $data['admission_letter_doc'] = $this->doUpload('admission_letter_doc','student/documents', $request);
        }
        DB::table('tbl_student')->where('id', $request->edit_id)->update($data);
        $res = $this->store_notification($request->edit_id, "admission_letter");
        return response()->json(['status'=>1, 'message'=>'Admission Letter Save successfully', 'number'=>$res['user_contact'], 'notification'=>$res['msg'] ]);
    }
    private function store_tutuion_fee($request)
    {
        $validator = Validator::make($request->all(), [
            'fee_year' => 'required',
            'fee_amount' => 'required',
            'attatchment' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status'=>2, 'message'=>$validator->errors()->all()]);
        }

        $data['fee_year'] = $request->fee_year;
        $data['fee_amount'] = $request->fee_amount;
        $data['comment'] = $request->comment;
        $data['student_id'] = $request->edit_id;
        if($request->file('attatchment')){
            $data['attatchment'] = $this->doUpload('attatchment','student/documents', $request);
        }
        DB::table('tbl_student_fee_history')->insert($data);
        $res = $this->store_notification($request->edit_id, "tutuion_fee");
        return response()->json(['status'=>1, 'message'=>'Tutuion Fee Save successfully', 'number'=>$res['user_contact'], 'notification'=>$res['msg'] ]);
    }
    private function store_interview_scheduled($request)
    {
        $validator = Validator::make($request->all(), [
            'platform' => 'required',
            'link' => 'required',
            'date' => 'required',
            'time' => 'required',
            // 'comment' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status'=>2, 'message'=>$validator->errors()->all()]);
        }

        $data['platform'] = $request->platform;
        $data['link'] = $request->link;
        $data['date'] = $request->date;
        $data['time'] = $request->time;
        $data['comment'] = $request->comment;
        $data['student_id'] = $request->edit_id;

        DB::table('tbl_student_interview_history')->insert($data);
        $res = $this->store_notification($request->edit_id, "interview_scheduled");
        return response()->json(['status'=>1, 'message'=>'Interview Scheduled Save successfully', 'number'=>$res['user_contact'], 'notification'=>$res['msg'] ]);
    }
    private function store_university($request)
    {
        $validator = Validator::make($request->all(), [
            'attatchment' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status'=>2, 'message'=>$validator->errors()->all()]);
        }

        $data['university_payment_type'] = $request->university_payment_type;
        if($request->file('university_payment_doc')){
            $data['university_payment_doc'] = $this->doUpload('university_payment_doc','student/documents', $request);
        }
        DB::table('tbl_student')->where('id', $request->edit_id)->update($data);
        if(count($_POST['attatchment_type'])>0){
            $data = array();
            for ($i=0; $i < count($_POST['attatchment_type']); $i++) {
                $sub_array = array();
                $sub_array['doc_for'] = 2;
                $sub_array['student_id'] = $request->edit_id;
                $sub_array['approved_status'] = 1;
                $sub_array['attatchment_type'] = $_POST['attatchment_type'][$i];
                $sub_array['attatchment'] = $this->doUploadImages("attatchment", "student/documents", $request, $i);
                $data[] = $sub_array;
            }
            if(count($data)>0){
                DB::table('tbl_student_document')->insert($data);
            }
            $res = $this->store_notification($request->edit_id, "university");
        }

        return response()->json(['status'=>1, 'message'=>'University Details Save successfully', 'data'=>$data, 'number'=>$res['user_contact'], 'notification'=>$res['msg'] ]);
    }
    private function store_indian_office($request)
    {
        $validator = Validator::make($request->all(), [
            'visa_details' => 'required',
            'visa_details_date' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status'=>2, 'message'=>$validator->errors()->all()]);
        }

        $data['visa_details'] = $request->visa_details;
        $data['visa_details_date'] = $request->visa_details_date;
        if($request->file('visa_details_doc')){
            $data['visa_details_doc'] = $this->doUpload('visa_details_doc','student/documents', $request);
        }
        DB::table('tbl_student')->where('id', $request->edit_id)->update($data);
        $res = $this->store_notification($request->edit_id, "indian_office");
        return response()->json(['status'=>1, 'message'=>'Indian Office Details Save successfully', 'number'=>$res['user_contact'], 'notification'=>$res['msg'] ]);
    }
    private function store_hostel($request)
    {
        $validator = Validator::make($request->all(), [
            'fee_year' => 'required',
            'fee_amount' => 'required',
            'attatchment' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status'=>2, 'message'=>$validator->errors()->all()]);
        }

        $data['fee_year'] = $request->fee_year;
        $data['fee_amount'] = $request->fee_amount;
        $data['student_id'] = $request->edit_id;
        $data['fee_for'] = 2;
        if($request->file('attatchment')){
            $data['attatchment'] = $this->doUpload('attatchment','student/documents', $request);
        }
        DB::table('tbl_student_fee_history')->insert($data);
        $res = $this->store_notification($request->edit_id, "hostel");
        return response()->json(['status'=>1, 'message'=>'ACCOMMODATIONS/HOSTEL Fee Save successfully', 'number'=>$res['user_contact'], 'notification'=>$res['msg'] ]);
    }
    private function store_notification($id, $tab='')
    {
        $s_data = DB::table('tbl_student')->where('id', $id)->first();
        $user_data = DB::table('users')->where('id_number', $s_data->agent_partner_id)->first();
        $msg="";
        $tab_id="";
        if($tab!=''){
            $user_id="";
            switch ($tab) {
                case 'application':
                    $msg = "New Student Application Recieved, Verify Now...";
                    $user_id="1";
                    $tab_id="application-tab";
                    break;
                case 'application_verify':
                    $msg = "Student Application Verified successfully.";
                    $user_id=$user_data->id;
                    $tab_id="application-tab";
                    break;
                case 'admission_letter':
                    $msg = "Admission Letter Uploaded, Now Pay Tution Fee.";
                    $user_id=$user_data->id;
                    $tab_id="admission-tab";
                    break;

                case 'tutuion_fee':
                    $msg = "Tution Fee Updated.";
                    $user_id="1";
                    $tab_id="tution-fee-tab";
                    break;
                case 'tutuion_fee_status':
                    $msg = "Tution Fee Status Updated, Please Schedule the Interview.";
                    $user_id="1";
                    $tab_id="tution-fee-tab";
                    break;
                case 'interview_scheduled':
                    $msg = "Interview Scheduled successfully.";
                    $user_id=$user_data->id;
                    $tab_id="interview-tab";
                    break;

                case 'interview_scheduled_verify':
                    $msg = "Interview Verified, Please Upload the University Details.";
                    $user_id=$user_data->id;
                    $tab_id="interview-tab";
                    break;

                case 'university':
                    $msg = "University Details Uploaded, Verify Now.";
                    $user_id="1";
                    $tab_id="university-tab";
                    break;

                case 'university_verify':
                    $msg = "Your University Details Verified, Now Upload Visa/Indian Office Details.";
                    $user_id="1";
                    $tab_id="university-tab";
                    break;

                case 'indian_office':
                    $msg = "Indian Office Details Uploaded, Verify Now.";
                    $user_id="1";
                    $tab_id="indian-office-tab";
                    break;

                case 'indian_office_verify':
                    $msg = "Your Indian Office Details Verified, Pay ACCOMMODATIONS/HOSTEL FEE.";
                    $user_id=$user_data->id;
                    $tab_id="indian-office-tab";
                    break;

                case 'hostel':
                    $msg = "ACCOMMODATIONS/HOSTEL FEE Uploaded, Verify Now.";
                    $user_id="1";
                    $tab_id="hostel-tab";
                    break;

                default:
                    $msg = "";
                    $user_id="";
                    $tab_id="";
                    break;
            }
            if($msg != "" && $user_id != ""){
                if($user_data->user_type!=1){
                    $msg = "Student Name: ".$s_data->name.", Partner/Agent Name: ".$user_data->name.", Partner/Agent Id: ".$user_data->id_number." and Subject: ".$msg;
                }else{
                    $msg = "Student Name: ".$s_data->name." and Subject: ".$msg;
                }
                DB::table('tbl_notification')->insert(['user_id'=>$user_id, 'student_id'=>$s_data->id, 'partner_id'=>$s_data->agent_partner_id, 'message'=>$msg, 'tab_name'=>$tab_id]);

                $data = [
                    'name' => $s_data->name,
                    'email' => $user_data->email,
                    'mobile' => $s_data->mobile,
                    'date' => date("Y-m-d H:i:s"),
                ];

                $res = Mail::send("email.student-email", $data, function($message) use ($data) {
                    $message->to($data['email'])
                    ->subject("Student Application - Gruni University");
                });
            }

        }
        return ['user_contact'=>$user_data->contact, 'msg'=>$msg];
    }

    public function doUpload($file,$directory,$request){

        $file = $request->file($file);
        $fileName = uniqid() . '_sw_' . trim($file->getClientOriginalName());

        $path = public_path().'/uploads/' . $directory;
        if (!file_exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        $file->move($path,$fileName);

        return $fileName;
    }
    public function doUploadImages($file,$directory,$request, $index=''){

        if($index!=''){
            $file = $request->file($file)[$index];
        }else{
            $file = $request->file($file);
        }
        $fileName = uniqid() . '_sw_' . trim($file->getClientOriginalName());

        $path = public_path().'/uploads/' . $directory;
        if (!file_exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
         }
        $file->move($path,$fileName);
        return $fileName;
    }
    public function removeFile($directory,$files){
        $file = public_path().'/'.$directory.'/'.$files;
        if(File::isFile($file)){
            File::delete($file);
        }
    }
    public function datatables(Request $request){

        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        $id = Auth::user()->id;
        $agent_partner_id = Auth::user()->id_number;

        // Total records
        $totalRecords = DB::table('tbl_student')->select('count(*) as allcount');
        if($id!=1){
            $totalRecords = $totalRecords->where('agent_partner_id', $agent_partner_id);
        }
        $totalRecords = $totalRecords->count();

        $totalRecordswithFilter = DB::table('tbl_student')->select('count(*) as allcount')->whereRaw('1 AND (father_name like "%'.$searchValue.'%" OR mobile like "%'.$searchValue.'%" OR name like "%'.$searchValue.'%"  )');
                                                            /*->where(function($query, $searchValue) {
                                                    			$query->where('father_name', 'like', '%' .$searchValue . '%')
                                                                    ->orWhere('mobile', 'like', '%' .$searchValue . '%')
                                                                    ->orWhere('name', 'like', '%' .$searchValue . '%');
                                                            });*/
        /*$totalRecordswithFilter = DB::table('tbl_student')->select('count(*) as allcount')
                                                        ->where('father_name', 'like', '%' .$searchValue . '%')
                                                        ->orWhere('mobile', 'like', '%' .$searchValue . '%')
                                                        ->orWhere('name', 'like', '%' .$searchValue . '%');*/

        if($id!=1){
            $totalRecordswithFilter = $totalRecordswithFilter->where('agent_partner_id', $agent_partner_id);
        }
        $totalRecordswithFilter = $totalRecordswithFilter->count();



        DB::enableQueryLog();

        // Fetch records
        $records = DB::table('tbl_student')->orderBy($columnName, $columnSortOrder)
                                        // ->where('name', 'like', '%' .$searchValue . '%')
                                        ->select('*');

        // if(!empty($searchValue)){
            $records = $records->whereRaw('(father_name like "%'.$searchValue.'%" OR mobile like "%'.$searchValue.'%" OR name like "%'.$searchValue.'%"  )');
                                //->where('father_name', 'like', '%' .$searchValue . '%')
                                /*->where(function($query, $searchValue) {
                        			$query->where('father_name', 'like', '%' .$searchValue . '%')
                                        ->orWhere('mobile', 'like', '%' .$searchValue . '%')
                                        ->orWhere('name', 'like', '%' .$searchValue . '%');
                                });*/
            /*$records = $records->where('father_name', 'like', '%' .$searchValue . '%')
                                ->orWhere('mobile', 'like', '%' .$searchValue . '%')
                                ->orWhere('name', 'like', '%' .$searchValue . '%');*/
        // }
        if($id!=1){
            $records = $records->where('agent_partner_id', $agent_partner_id);
        }
        $records = $records->skip($start)
                                    ->take($rowperpage)
                                    ->orderBy("id", "DESC")
                                    ->get();

        $last_qry = DB::getQueryLog();

        $data_arr = array();
        $sr = 1;
        foreach($records as $val){
            $arr["id"] = $sr++;

            $arr["name"] = $val->name;
            $arr["mobile"] = $val->mobile;
            $arr["father_name"] = $val->father_name;
            // $arr["image"] = '<img src="'.url('uploads/teaching/'.$val->image).'" class="img img-fluid">' ;

            // $arr["is_active"] = $val->is_active ==1 ? "Active" : "Inactive";

            $action = '';
            if(auth()->user()->can('student-edit')){
                $action .= ' <a href="'.route('admin.student.save-student', ['id'=>$val->id]).'" class="text-gray m-r-15 dropdown-item"><i class="ti-pencil"></i> Edit</a>';
            }
            // if(auth()->user()->can('student-details')){
                $action .= ' <a href="'.route('admin.student.view', ['id'=>$val->id]).'" class="text-gray m-r-15 dropdown-item"><i class="fa fa-info-circle" aria-hidden="true"></i> View</a>';
            // }
            if(auth()->user()->can('student-delete')){
                $action .= ' <a href="javascript:void(0)" onclick="delete_item(`'.route('admin.student.delete-student', ['id'=>$val->id]).'`)" class="text-danger dropdown-item"><i class="ti-trash"></i> Delete</a>';
            }

            $arr["action"] = !empty($action) ? '<div class="dropdown dropdown-animated scale-left">
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -139px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    '.$action.'
                                </div>
                            </div>' : '';

            $data_arr[] = $arr;
        }

        $response = array(
          "permissions" => auth()->user()->can('student-details'),
        //   "id" => $id,
        //   "agent_partner_id" => $agent_partner_id,
        //   "last_qry" => $last_qry,
           "draw" => intval($draw),
           "iTotalRecords" => $totalRecords,
        //    "iTotalRecords" => $totalRecords,
           "iTotalDisplayRecords" => $totalRecordswithFilter,
           "aaData" => $data_arr
        );

        return response()->json($response);
    }


    public function get_fee_history(Request $request, $student_id=''){
        if(empty($student_id)){
            return response()->json(["status" => 1,"aaData" => array()]);
        }
        // Fetch records
        $records = DB::table('tbl_student_fee_history')
                ->select('*')
                ->where('student_id', $student_id)
                ->where('fee_for', 1)
                ->orderBy("id", "DESC")
                ->get();
        $response = array(
           "status" => 1,
           "iTotalRecords" => count($records),
           "aaData" => $records
        );
// print_r($response); die;
        return response()->json($response);
    }

    public function get_detais_of_admin(Request $request){

        // Fetch records
        $id =Auth::user()->id_number;
        $records = DB::table('tbl_student')
                ->select('*')
                ->where('agent_partner_id', $id)
                ->get();
                //print_r($records); die;
        $details = DB::table('users')
                ->select('*')
                ->where('id_number', $id)
                ->first();
        $response = array(
           "status" => 1,
           "iTotalRecords" => count($records),
           "details" => $details,
           "aaData" => $records
        );
// print_r($response); die;
        return response()->json($response);
    }


    public function get_interview_history(Request $request, $student_id=''){
        if(empty($student_id)){
            return response()->json(["status" => 1,"aaData" => array()]);
        }
        // Fetch records
        $records = DB::table('tbl_student_interview_history')
                ->select('*')
                ->where('student_id', $student_id)
                ->orderBy("id", "DESC")
                ->get();
        $response = array(
           "status" => 1,
           "iTotalRecords" => count($records),
           "aaData" => $records
        );

        return response()->json($response);
    }
    public function get_hostel_fee_history(Request $request, $student_id=''){
        if(empty($student_id)){
            return response()->json(["status" => 1,"aaData" => array()]);
        }
        // Fetch records
        $records = DB::table('tbl_student_fee_history')
                ->select('*')
                ->where('student_id', $student_id)
                ->where('fee_for', 2)
                ->orderBy("id", "DESC")
                ->get();
        $response = array(
           "status" => 1,
           "iTotalRecords" => count($records),
           "aaData" => $records
        );

        return response()->json($response);
    }

    public function delete(Request $request, $id)
    {
        if($id){
            // $banner = DB::table('tbl_student')->where('id', $id)->first();
            // $this->removeFile('uploads/teaching',$banner->image);
            DB::table('tbl_student')->where('id', $id)->delete();
            $success = true;
            $message = "Student deleted successfully";
        }else{
            $success = true;
            $message = "Student not found";
        }
        return redirect()->route('admin.student.index')->with('success', $message);
    }
    public function destroy_student_docs(Request $request)
    {
        if($request->delete_id && $request->student_id){
            $doc_record = DB::table('tbl_student_document')->where('id', $request->delete_id)->where('student_id', $request->student_id)->first();
            $this->removeFile('uploads/student/documents',$doc_record->attatchment);
            DB::table('tbl_student_document')->where('id', $request->delete_id)->where('student_id', $request->student_id)->delete();
            $success = 1;
            $message = "Student Document deleted successfully";
        }else{
            $success = 2;
            $message = "Student Document not found";
        }
        $response = array(
           "status" => $success,
           "message" => $message
        );

        return response()->json($response);
    }
    public function update_student_doc_status(Request $request)
    {
        if($request->doc_id && $request->student_id && $request->status){
            $doc_record = DB::table('tbl_student_document')->where('id', $request->doc_id)->where('student_id', $request->student_id)->update(['approved_status'=>$request->status,'approved_by_user_id'=>Auth::user()->id]);
            $doc_data = DB::table('tbl_student_document')->where('id', $request->doc_id)->where('student_id', $request->student_id)->first();
            if($doc_data->doc_for==1){
                $res = $this->store_notification($request->student_id, "application_verify");
            }
            if($doc_data->doc_for==2){
                $res = $this->store_notification($request->student_id, "university_verify");
            }
            $success = 1;
            $message = "Student Document Status Update successfully";
        }else{
            $res = ['user_contact'=>'', 'msg'=>'' ];
            $success = 2;
            $message = "Student Document not found";
        }
        $response = array(
           "status" => $success,
           "message" => $message,
           'number'=>$res['user_contact'],
           'notification'=>$res['msg']
        );

        return response()->json($response);
    }
    public function update_student_fee_status(Request $request)
    {
        if($request->fee_id && $request->student_id){
            $doc_record = DB::table('tbl_student_fee_history')->where('id', $request->fee_id)->where('student_id', $request->student_id)->update(['approval_status'=>$request->status,'approved_by'=>Auth::user()->id]);

            $res = $this->store_notification($request->student_id, "tutuion_fee_status");
            $success = 1;
            $message = "Student Fee Status Update successfully";
        }else{
            $res = ['user_contact'=>'', 'msg'=>'' ];
            $success = 2;
            $message = "Student Fee not found";
        }
        $response = array(
           "status" => $success,
           "message" => $message,
           'number'=>$res['user_contact'],
           'notification'=>$res['msg']
        );

        return response()->json($response);
    }
    public function update_student_indian_office_document_status(Request $request)
    {
        if($request->student_id){
            DB::table('tbl_student')->where('id', $request->student_id)->update(['visa_details_status'=>$request->status,'visa_details_status_approve_by'=>Auth::user()->id]);
            $res = $this->store_notification($request->student_id, "indian_office_verify");
            $success = 1;
            $message = "Student Indian Office Document Status Update successfully";
        }else{
            $res = ['user_contact'=>'', 'msg'=>'' ];
            $success = 2;
            $message = "Student Indian Office Document not found";
        }
        $response = array(
           "status" => $success,
           "message" => $message,
           'number'=>$res['user_contact'],
           'notification'=>$res['msg']
        );

        return response()->json($response);
    }
    public function update_interview_status(Request $request)
    {
        if($request->student_id){
            DB::table('tbl_student_interview_history')->where('id', $request->interview_id)->where('student_id', $request->student_id)->update(['status'=>$request->status,'status_update_by'=>Auth::user()->id]);
            $res = $this->store_notification($request->student_id, "interview_scheduled_verify");
            $success = 1;
            $message = "Student Interview Status Update successfully";
        }else{
            $res = ['user_contact'=>'', 'msg'=>'' ];
            $success = 2;
            $message = "Student Interview Record not found";
        }
        $response = array(
           "status" => $success,
           "message" => $message,
           'number'=>$res['user_contact'],
           'notification'=>$res['msg']
        );

        return response()->json($response);
    }

    public function enquiry()
    {
         $result['title']="Enquiry";
        $result['sub_title']="Enquiry List";
        $result['title_url']="";
        // Country Tabel Data Send
        $result['data']=Enquiry::orderBy('id', 'DESC')->paginate(config('constants.PER_PAGE'));
        return view('admin/student/enquiry',$result);

    }

    public function destroy_enquiry(Request $request, $id)
{
    if ($id) {
        // Fetch the enquiry by ID
        $enquiry = DB::table('enquiries')->where('id', $id)->first();

        if ($enquiry) {
            // Delete the enquiry
            DB::table('enquiries')->where('id', $id)->delete();
            $message = "Enquiry deleted successfully";
        } else {
            $message = "Enquiry not found";
        }
    } else {
        $message = "Invalid request";
    }

    // Redirect with a success message
    return redirect()->route('admin.student.get_enquiry')->with('success', $message);
}


    public function readNotification($id){

        $read = DB::table('tbl_notification')->where('id',$id)->update(['status'=>'1']);
        if($read){
                $response = array(
               "status" => 'Success',
            );
        }else{
            $response = array(
                "status" => 'Failed',
            );
        }
        return response()->json($response);
    }

    public function getFee(Request $request){

        $type = $request->type;
        $data = DB::table('tbl_fee')->where('id',1)->first();
        if($type=='1'){
            $fee = $data->fee_inr;
        }else{
            $fee = $data->fee_usd;
        }

        if($data){
                $response = array(
               "status" => 'Success',
               "fee" => $fee,
            );
        }else{
            $response = array(
                "status" => 'Failed',
            );
        }
        return response()->json($response);
    }
}
