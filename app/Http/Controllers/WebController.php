<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquiry;
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
use Illuminate\Support\Facades\Mail;
use App\Mail\EnquiryMail;

class WebController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $data = array();
        // $data['title']="";
        $data['page_title'] = 'GRUNI India';
        // $data['breadcum']   = array(
        //                 'Home' => url('/'),
        //                 'Home'=>''
        //             );
        return view("web.index", $data);
    }

    public function mission_admission()
    {
        $data = array();
        // $data['title']="";
        $data['page_title'] = 'GRUNI India';
        // $data['breadcum']   = array(
        //                 'Home' => url('/'),
        //                 'Home'=>''
        //             );
        return view("web.index2", $data);
    }
    public function university($id='', $id2='')
    {
        // echo $id;die;
        $data = array();
        $data['page_title'] = 'University';
        if($id2==''){
            $u_data = DB::table('tbl_university')->where('is_active', 1)->where('category', $id)->first();
            if(empty($u_data)){
                $u_data =DB::table('tbl_university')->where('is_active', 1)->first();
            }
            $id2=$u_data->slug;
        }
        $data['data_id'] = $id;
        $data['data_id2'] = $id2;

        return view("web.pages.about-us", $data);
    }
    public function student($id='', $id2='')
    {
        $data = array();
        $data['page_title'] = 'Accommodation';
        return view("web.pages.indian_student", $data);
    }
    public function food($id='', $id2='')
    {
        $data = array();
        $data['page_title'] = 'india-Food';
        return view("web.pages.indian-food", $data);
    }
    public function health($id='', $id2='')
    {
        $data = array();
        $data['page_title'] = 'Health and Wellness';
        return view("web.pages.health", $data);
    }
    public function school_of_medicine($id='', $id2='')
    {
        $data = array();
        $data['page_title'] = 'School of Medicine';
        if($id2==''){
            $u_data = DB::table('tbl_school_of_medicine')->where('is_active', 1)->where('course', $id)->first();
            if(empty($u_data)){
                $u_data =DB::table('tbl_school_of_medicine')->where('is_active', 1)->first();
            }
            $id2=$u_data->slug;
        }
        $data['data_id'] = $id;
        $data['data_id2'] = $id2;
        // print_r($data);
        //     die("ss");
        return view("web.pages.school-of-medicine", $data);
    }
    public function learning_teaching($id='', $id2='')
    {
        $data = array();
        $data['page_title'] = 'Learning-Teaching';
        if($id2==''){
            $u_data = DB::table('tbl_teaching')->where('is_active', 1)->where('category', $id)->first();
            if(empty($u_data)){
                $u_data =DB::table('tbl_teaching')->where('is_active', 1)->first();
            }
            $id2=$u_data->slug;
        }
        $data['data_id'] = $id;
        $data['data_id2'] = $id2;
        return view("web.pages.learning-teaching", $data);
    }
    public function admission($id='', $id2='')
    {
        $data = array();
        $data['page_title'] = 'Admission';
        if($id2==''){
            $u_data = DB::table('tbl_admission')->where('is_active', 1)->where('category', $id)->first();
            if(empty($u_data)){
                $u_data =DB::table('tbl_admission')->where('is_active', 1)->first();
            }
            $id2=$u_data->slug;
        }
        $data['data_id'] = $id;
        $data['data_id2'] = $id2;
        // print_r($data);die;
        return view("web.pages.admission", $data);
    }
    public function latest_news_list()
    {
        $data = array();
        $data['page_title'] = 'Latest News';
        // if($id==''){
        //     $u_data = DB::table('tbl_latest_news')->where('is_active', 1)->first();
        //     $id=$u_data->slug;
        // }
        $data['data_id'] = '';
        return view("web.pages.new-list", $data);
    }
    public function latest_news($id='')
    {
        $data = array();
        $data['page_title'] = 'Latest News';
        if($id==''){
            $u_data = DB::table('tbl_latest_news')->where('is_active', 1)->first();
            $id=$u_data->slug;
        }
        $data['data_id'] = $id;
        return view("web.pages.latest-news", $data);
    }
    public function discover_gruni($id='')
    {
        $data = array();
        $data['page_title'] = 'Discover Gruni';
        $data['data_id'] = $id;
        return view("web.pages.discover-gruni", $data);
    }
    public function success_story()
    {
        $data = array();
        $data['page_title'] = 'Success Story';
        return view("web.pages.success-story", $data);
    }
    public function testimonial()
    {
        $data = array();
        $data['page_title'] = 'Testimonial';
        return view("web.pages.testimonial", $data);
    }
    public function announcement($id)
    {
        $data = array();
        $data['page_title'] = 'Announcement';
        $data['announcement_data'] = DB::table('tbl_announcement')->where('is_active', 1)->where('slug', $id)->first();
        // print_r($data['announcement_data']);die;
        return view("web.pages.announcement", $data);
    }

     public function subscribe(Request $request)
    {
        print_r($_POST); die;
    }

    // public function save_enquiry(Request $request)
    // {
    //     $data['page_title'] = 'GRUNI India';
    //     // $data['breadcum']   = array(
    //     //                 'Home' => url('/'),
    //     //                 'Home'=>''
    //     //             );

    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required | string | max:255',
    //         'email' => 'required | email | max:255',
    //         'mobile' => 'required | regex:/^[0-9]{10}$/',
    //         'admission_city' => 'required',
    //     ]);
    //     if (!$validator->passes()) {
    //         return response()->json(['status'=>0, 'message'=>$validator->errors()->all()]);
    //     }

    //     $obj = new Enquiry;
    //     $msg = "Enquiry Send Successful";
    //     $msg_error="Failed to Send Enquiry";
    //     $data['page_title'] = 'GRUNI India';
    //     $obj->name = $request->name;
    //     $obj->email = $request->email;
    //     $obj->mobile = $request->mobile;
    //     $obj->admission_city = $request->admission_city;
    //     $obj->message = $request->message;

    //     if($obj->save()){

    //         $res['status']=1;
    //         $res['message']=$msg;
    //     }else{
    //         $res['status']=0;
    //         $res['message']=$msg_error;
    //     }

    //     return view("web.index", $data);
    // }

public function save_enquiry(Request $request)
{
    $data['page_title'] = 'GRUNI India';

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'mobile' => 'required|regex:/^[0-9]{10}$/',
        'admission_city' => 'required',
    ]);

    if (!$validator->passes()) {
        return response()->json(['status' => 0, 'message' => $validator->errors()->all()]);
    }

    $obj = new Enquiry;
    $msg = "Enquiry Sent Successfully";
    $msg_error = "Failed to Send Enquiry";

    $obj->name = $request->name;
    $obj->email = $request->email;
    $obj->mobile = $request->mobile;
    $obj->admission_city = $request->admission_city;
    $obj->message = $request->message;

    if ($obj->save()) {
        // Send email after successfully saving the enquiry
        $enquiryData = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'admission_city' => $request->admission_city,
            'message' => $request->message,
        ];

        try {
            Mail::to('info@gruni.co.in')->send(new EnquiryMail($enquiryData)); // Replace with the desired recipient email
            $res['status'] = 1;
            $res['message'] = $msg;
        } catch (\Exception $e) {
            $res['status'] = 0;
            $res['message'] = 'Enquiry saved, but email could not be sent: ' . $e->getMessage();
        }
    } else {
        $res['status'] = 0;
        $res['message'] = $msg_error;
    }

    return view("web.index", $data);
}


    public function associate_parter()
    {
        return view('web.pages.associate-partner');
    }

    public function gallary()
    {
        // You can fetch any required data from the database here.
        // Example: $photos = Photo::all();

        return view('web.pages.gallary'); // Return the gallery view
    }

    public function campus_life()
    {
        return view('web.pages.campus-life');
    }

    public function our_campus()
    {
        return view('web.pages.our-campus');
    }

    public function academics()
    {
        return view('web.pages.academics');
    }

}
