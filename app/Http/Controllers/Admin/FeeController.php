<?php

namespace App\Http\Controllers\Admin;

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


class FeeController extends Controller
{
    public function fee(Request $request)
    {
        $data['title']="Home fee";
        $data['title_url']=route('setting.fee');
        $data['sub_title']="Fee List";
        return view('admin.fee-setting.index',$data);
    }

    public function save_fee($id='')
    {
        $data['title']="Fee";
        $data['title_url']=route('setting.save-fee');
        $data['sub_title']="Save fee";
        $data['edit_data'] = array();
        if(!empty($id)){
            $data['edit_data'] = DB::table('tbl_fee')->where('id', $id)->first();
        }

        return view('admin.fee-setting.save', $data);
    }

    public function store_fee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fee_inr' => 'required',
            'fee_usd' => 'required',
        ]);
        
        if (!$validator->passes()) {
            return response()->json(['status'=>2, 'message'=>$validator->errors()->all()]);
        }
    
        $data['fee_inr'] = $request->fee_inr;
        $data['fee_usd'] = $request->fee_usd;
        if($request->edit_id && $request->edit_id>0){
            DB::table('tbl_fee')->where('id', $request->edit_id)->update($data);
        }else{
            DB::table('tbl_fee')->insert($data);
        }
        
        return response()->json(['status'=>1, 'message'=>'fee Save successfully']);
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
    public function datatables_fee(Request $request){

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
        $totalRecords = DB::table('tbl_fee')->select('count(*) as allcount')->count();

        $totalRecordswithFilter = DB::table('tbl_fee')->select('count(*) as allcount')->where('fee_inr', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = DB::table('tbl_fee')->orderBy($columnName, $columnSortOrder)
                ->where('fee_inr', 'like', '%' .$searchValue . '%')
                ->select('*')
                ->skip($start)
                ->take($rowperpage)
                ->get();
                
        $data_arr = array();
        $sr = 1;
        foreach($records as $val){
            $arr["id"] = $sr++;
            $arr["fee_inr"] = '&#8377;'.$val->fee_inr;
            $arr["fee_usd"] = '&#36;'.$val->fee_usd;
                        
            $action = '';
            
            $action .= ' <a href="'.route('setting.save-fee', ['id'=>$val->id]).'" class="text-gray m-r-15 dropdown-item"><i class="ti-pencil"></i> Edit</a>';
        //   / $action .= ' <a href="javascript:void(0)" onclick="delete_item(`'.route('setting.delete-fee', ['id'=>$val->id]).'`)" class="text-danger dropdown-item"><i class="ti-trash"></i> Delete</a>';
            
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

    public function delete_fee(Request $request, $id)
    {
        if($id){
            $fee = DB::table('tbl_fee')->where('id', $id)->first();
            $this->removeFile('uploads/home_fee',$fee->image);
            DB::table('tbl_fee')->where('id', $id)->delete();
            $success = true;
            $message = "fee deleted successfully";
        }else{
            $success = true;
            $message = "fee not found";
        }
        return redirect()->route('fee-setting.')->with('success', $message);
    }

}
