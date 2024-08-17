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


class HomeBannerController extends Controller
{
    public function banner(Request $request)
    {
        $data['title']="Home Banner";
        $data['title_url']=route('web-setting.banner');
        $data['sub_title']="Home Banner List";
        return view('admin.web-setting.banner.index',$data);
    }

    public function save_banner($id='')
    {
        $data['title']="Home Banner";
        $data['title_url']=route('web-setting.banner');
        $data['sub_title']="Save Home Banner";
        $data['edit_data'] = array();
        if(!empty($id)){
            $data['edit_data'] = DB::table('tbl_home_banner')->where('id', $id)->first();
        }

        return view('admin.web-setting.banner.save', $data);
    }

    public function store_banner(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'link' => 'required',
            // 'image' => 'required',
            'is_active' => 'required',
            'description' => 'required'
        ]);
        
        if (!$validator->passes()) {
            return response()->json(['status'=>2, 'message'=>$validator->errors()->all()]);
        }
    
        $data['title'] = $request->title;
        $data['link'] = $request->link;
        if($request->file('image')){
            $data['image'] = $this->doUpload('image','home_banner',$request);
        }
        $data['is_active'] = $request->is_active;
        $data['description'] = $request->description;
        if($request->edit_id && $request->edit_id>0){
            DB::table('tbl_home_banner')->where('id', $request->edit_id)->update($data);
        }else{
            DB::table('tbl_home_banner')->insert($data);
        }
        
        return response()->json(['status'=>1, 'message'=>'Banner Save successfully']);
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
    public function datatables_banner(Request $request){

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
        $totalRecords = DB::table('tbl_home_banner')->select('count(*) as allcount')->count();

        $totalRecordswithFilter = DB::table('tbl_home_banner')->select('count(*) as allcount')->where('title', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = DB::table('tbl_home_banner')->orderBy($columnName, $columnSortOrder)
                ->where('title', 'like', '%' .$searchValue . '%')
                ->select('*')
                ->skip($start)
                ->take($rowperpage)
                ->get();
                
        $data_arr = array();
        $sr = 1;
        foreach($records as $val){
            $arr["id"] = $sr++;
            $arr["title"] = $val->title;
            $arr["link"] = $val->link;
            $arr["image"] = '<img src="'.url('uploads/home_banner/'.$val->image).'" class="img img-fluid">' ;
            $arr["description"] = $val->description;
            $arr["is_active"] = $val->is_active ==1 ? "Active" : "Inactive";
                        
            $action = '';
            
            $action .= ' <a href="'.route('web-setting.save-banner', ['id'=>$val->id]).'" class="text-gray m-r-15 dropdown-item"><i class="ti-pencil"></i> Edit</a>';
            $action .= ' <a href="javascript:void(0)" onclick="delete_item(`'.route('web-setting.delete-banner', ['id'=>$val->id]).'`)" class="text-danger dropdown-item"><i class="ti-trash"></i> Delete</a>';
            
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

    public function delete_banner(Request $request, $id)
    {
        if($id){
            $banner = DB::table('tbl_home_banner')->where('id', $id)->first();
            $this->removeFile('uploads/home_banner',$banner->image);
            DB::table('tbl_home_banner')->where('id', $id)->delete();
            $success = true;
            $message = "Banner deleted successfully";
        }else{
            $success = true;
            $message = "Banner not found";
        }
        return redirect()->route('web-setting.banner')->with('success', $message);
    }

}
