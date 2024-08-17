<?php
    
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Hash;
use Validator;
use Session;
use Crypt;
    
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title']="Role";
        $data['title_url']=route('roles.index');
        $data['sub_title']="Role Management";
        // $data['roles']=Role::orderBy('id','DESC')->paginate(5);
        return view('roles.index',$data)
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        $title="Role";
        $title_url=route('roles.index');
        $sub_title="Create New Role";
        return view('roles.create',compact('permission', 'title', 'title_url', 'sub_title'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
     
        if (!$validator->passes()) {
            return response()->json(['status'=>2, 'message'=>$validator->errors()->all()]);
        }

        /*$this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);*/
    
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
    
        return response()->json(['status'=>1, 'message'=>'Role created successfully']);
        // return redirect()->route('roles.index')->with('success','Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title="Role";
        $title_url=route('roles.index');
        $sub_title="Show Role";
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
    
        return view('roles.show',compact('role','rolePermissions', 'title', 'title_url', 'sub_title'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title="Role";
        $title_url=route('roles.index');
        $sub_title="Edit Role";
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        
        return view('roles.edit',compact('role','permission','rolePermissions', 'title', 'title_url', 'sub_title'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'permission' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status'=>2, 'message'=>$validator->errors()->all()]);
        }
    
        $role = Role::find($request->id);
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
        return response()->json(['status'=>1, 'message'=>'Role updated successfully']);
        // return redirect()->route('roles.index')->with('success','Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
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

        $filter_user = $request->get('user');
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');
        
        
        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value
        
        $u_id = '';
        if(!auth()->user()->hasRole('Admin')){
            $u_id = [auth()->user()->id];
        }
        
        // Total records
        $totalRecords = Role::select('count(*) as allcount');
        
        $totalRecords = $totalRecords->count();


        $totalRecordswithFilter = Role::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%');
        
        $totalRecordswithFilter = $totalRecordswithFilter->count();

        // Fetch records
        $records = Role::orderBy($columnName, $columnSortOrder);
        
        $records = $records->where('name', 'like', '%' .$searchValue . '%')
                ->select('*')
                ->skip($start)
                ->take($rowperpage)
                ->get();

        $data_arr = array();
        $sr = 1;
        foreach($records as $val){
            $arr["id"] = $sr++;
            $arr["name"] = $val->name;
            
            $action = '<a class="btn btn-info" href="'.route('roles.show',$val->id).'">Show</a>';
            if(auth()->user()->can('role-edit')){
                $action .= '<a class="btn btn-primary" href="'.route('roles.edit',$val->id).'">Edit</a>';
            }
            if(auth()->user()->can('role-delete')){
                if($val->name!="Admin"){
                    $action .= '<a class="btn btn-danger" href="javascript:void(0)" onclick="delete_item(`'.route('role.destroy', ['id'=>$val->id]).'`)">Delete</a>';
                }
            }
            $arr["action"] = $action;
            
            $data_arr[] = $arr;
        }

        $response = array(
           "draw" => intval($draw),
           "iTotalRecords" => $totalRecords,
           "iTotalDisplayRecords" => $totalRecordswithFilter,
           "aaData" => $data_arr,
        );

        return response()->json($response); 
    }
    
}