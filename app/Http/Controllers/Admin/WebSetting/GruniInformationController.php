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

class GruniInformationController extends Controller
{
    public function index(Request $request)
    {
        $data['title']="Gruni Information";
        $data['title_url']=route('web-setting.gruni-information');
        $data['sub_title']="Gruni Information List";
        return view('admin.web-setting.gruni-information.index',$data);
    }

    public function save($id='')
    {
        $data['title']="Gruni Information";
        $data['title_url']=route('web-setting.gruni-information');
        $data['sub_title']="Save Gruni Information";
        $data['edit_data'] = array();
        if(!empty($id)){
            $data['edit_data'] = DB::table('tbl_gruni_information')->where('id', $id)->first();
        }
        return view('admin.web-setting.gruni-information.save', $data);
    }

    public function store(Request $request)
    {
        // echo "string";die;
        $validator = Validator::make($request->all(), [
            'y_of_experience' => 'required',
            'global_students' => 'required',
            'students_nationalities' => 'required',
            'link' => 'required',
            // 'is_active' => 'required',
            'description' => 'required'
        ]);
        
        if (!$validator->passes()) {
            return response()->json(['status'=>2, 'message'=>$validator->errors()->all()]);
        }
    
        $data['y_of_experience'] = $request->y_of_experience;
        $data['global_students'] = $request->global_students;
        $data['students_nationalities'] = $request->students_nationalities;
        $data['link'] = $request->link;
        // if($request->file('image')){
        //     $data['image'] = $this->doUpload('image','gruni-information',$request);
        // }
        // $data['is_active'] = $request->is_active;
        $data['description'] = $request->description;
        if($request->edit_id && $request->edit_id>0){
            DB::table('tbl_gruni_information')->where('id', $request->edit_id)->update($data);
        }else{
            DB::table('tbl_gruni_information')->insert($data);
        }
        
        return response()->json(['status'=>1, 'message'=>'Gruni Information Save successfully']);
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
        $totalRecords = DB::table('tbl_gruni_information')->select('count(*) as allcount')->count();

        $totalRecordswithFilter = DB::table('tbl_gruni_information')->select('count(*) as allcount')->where('description', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = DB::table('tbl_gruni_information')->orderBy($columnName, $columnSortOrder)
                ->where('description', 'like', '%' .$searchValue . '%')
                ->select('*')
                ->skip($start)
                ->take($rowperpage)
                ->get();
                
        $data_arr = array();
        $sr = 1;
        foreach($records as $val){
            // $arr["id"] = $sr++;
            $arr["y_of_experience"] = $val->y_of_experience;
            $arr["global_students"] = $val->global_students;
            $arr["students_nationalities"] = $val->students_nationalities;
            // $arr["image"] = '<img src="'.url('uploads/gruni-information/'.$val->image).'" class="img img-fluid">' ;
            
            $arr["description"] = $val->description;
            // $arr["is_active"] = $val->is_active ==1 ? "Active" : "Inactive";
                        
            $action = '';
            
            $action .= ' <a href="'.route('web-setting.save-gruni-information', ['id'=>$val->id]).'" class="text-gray m-r-15 dropdown-item"><i class="ti-pencil"></i> Edit</a>';
            // $action .= ' <a href="javascript:void(0)" onclick="delete_item(`'.route('web-setting.delete-gruni-information', ['id'=>$val->id]).'`)" class="text-danger dropdown-item"><i class="ti-trash"></i> Delete</a>';
            
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
            // $banner = DB::table('tbl_gruni_information')->where('id', $id)->first();
            // $this->removeFile('uploads/gruni-information',$banner->image);
            DB::table('tbl_gruni_information')->where('id', $id)->delete();
            $success = true;
            $message = "Gruni Information deleted successfully";
        }else{
            $success = true;
            $message = "Gruni Information not found";
        }
        return redirect()->route('web-setting.gruni-information')->with('success', $message);
    }
}