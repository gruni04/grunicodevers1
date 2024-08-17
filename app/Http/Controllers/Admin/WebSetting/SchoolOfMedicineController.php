<?php

namespace App\Http\Controllers\Admin\WebSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

class SchoolOfMedicineController extends Controller
{
    public function index(Request $request)
    {
        $data['title']="School of Medicine";
        $data['title_url']=route('web-setting.school-of-medicine');
        $data['sub_title']="School of Medicine List";
        return view('admin.web-setting.school-of-medicine.index',$data);
    }

    public function save($id='')
    {
        $data['title']="School of Medicine";
        $data['title_url']=route('web-setting.school-of-medicine');
        $data['sub_title']="Save School of Medicine";
        $data['course_category'] = DB::table('tbl_school_of_medicine_course')->where('is_active', 1)->get();
        $data['edit_data'] = array();
        if(!empty($id)){
            $data['edit_data'] = DB::table('tbl_school_of_medicine')->where('id', $id)->first();
        }

        return view('admin.web-setting.school-of-medicine.save', $data);
    }

    public function store(Request $request)
    {
        // echo "string";die;
        $validator = Validator::make($request->all(), [
            'course' => 'required',
            'title' => 'required',
            'description' => 'required',
            'is_active' => 'required'
        ]);
        
        if (!$validator->passes()) {
            return response()->json(['status'=>2, 'message'=>$validator->errors()->all()]);
        }
    
        $data['course'] = $request->course;
        $data['title'] = $request->title;
        if($request->file('image')){
            $data['image'] = $this->doUpload('image','school-of-medicine',$request);
        }
        $data['is_active'] = $request->is_active;
        $data['description'] = $request->description;
        if($request->edit_id && $request->edit_id>0){
            DB::table('tbl_school_of_medicine')->where('id', $request->edit_id)->update($data);
        }else{
            $data['slug'] = $this->createSlug($data['title'], 'tbl_school_of_medicine');
            DB::table('tbl_school_of_medicine')->insert($data);
        }
        
        return response()->json(['status'=>1, 'message'=>'School of Medicine Save successfully']);
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

        // Total records
        $totalRecords = DB::table('tbl_school_of_medicine')->select('count(*) as allcount')->count();

        $totalRecordswithFilter = DB::table('tbl_school_of_medicine')->select('count(*) as allcount')->where('title', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = DB::table('tbl_school_of_medicine')->orderBy($columnName, $columnSortOrder)
                ->where('title', 'like', '%' .$searchValue . '%')
                ->select('*')
                ->skip($start)
                ->take($rowperpage)
                ->get();
                
        $data_arr = array();
        $sr = 1;
        foreach($records as $val){
            // print_r($val);die;
            $arr["id"] = $sr++;
            $course_data = DB::table('tbl_school_of_medicine_course')->where('is_active', 1)->where('slug', $val->course)->first();
            $arr["course"] = $course_data && $course_data->course_name ? $course_data->course_name : '';
            $arr["title"] = $val->title;
            $arr["description"] = $val->description;
            $arr["image"] = '<img src="'.url('uploads/school-of-medicine/'.$val->image).'" class="img img-fluid">' ;
            
            $arr["is_active"] = $val->is_active ==1 ? "Active" : "Inactive";
            
            $action = '';
            
            $action .= ' <a href="'.route('web-setting.save-school-of-medicine', ['id'=>$val->id]).'" class="text-gray m-r-15 dropdown-item"><i class="ti-pencil"></i> Edit</a>';
            $action .= ' <a href="javascript:void(0)" onclick="delete_item(`'.route('web-setting.delete-school-of-medicine', ['id'=>$val->id]).'`)" class="text-danger dropdown-item"><i class="ti-trash"></i> Delete</a>';
            
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
           "draw" => intval($draw),
           "iTotalRecords" => $totalRecords,
           "iTotalDisplayRecords" => $totalRecordswithFilter,
           "aaData" => $data_arr
        );

        return response()->json($response); 
    }

    public function delete(Request $request, $id)
    {
        if($id){
            $banner = DB::table('tbl_school_of_medicine')->where('id', $id)->first();
            $this->removeFile('uploads/school-of-medicine',$banner->image);
            DB::table('tbl_school_of_medicine')->where('id', $id)->delete();
            $success = true;
            $message = "School of Medicine deleted successfully";
        }else{
            $success = true;
            $message = "School of Medicine not found";
        }
        return redirect()->route('web-setting.school-of-medicine')->with('success', $message);
    }
}
