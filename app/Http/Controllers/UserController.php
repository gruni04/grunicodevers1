<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
// use App\Models\AssigneProject;
// use App\Models\Admin\WorkingLocation;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Validator;
use Session;
use Auth;
// use Crypt;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Arr;
use App\Models\Admin\UserDetails;
use App\Models\ProjectUser;
    
class UserController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete|user-details-update', ['only' => ['index','store']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title']="Admin User";
        $data['title_url']=route('users.list.index');
        $data['sub_title']="Admin User List";
        $data['projects']=array();
        return view('admin.user.index',$data);
    }
    public function partner_agent(Request $request)
    {
        // echo Auth::user()->user_type;die;
        $data['title']="Partner/Agent";
        $data['title_url']=route('partner-user.list.index');
        $data['sub_title']="Partner/Agent List";
        $data['projects']=array();
        return view('admin.user.index-partner-agent',$data);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title="Admin User";
        $title_url=route('users.list.index');
        $sub_title="Add Admin User";
        $roles = Role::pluck('name','name')->all();
        // $roles = Role::pluck('name','name')->whereNotIn('name', ['Partner', 'Agent'])->get();
        // $roles = Role::whereNotIn('name', ['Partner', 'Agent'])->get();
        // print_r($roles);die;
        return view('admin.user.save',compact('roles', 'title', 'title_url', 'sub_title'));
    }
    
    public function create_partner_agent($id='')
    {
        $title="Partner/Agent";
        $title_url=route('partner-user.list.index');
        $sub_title="Save Partner/Agent";
        $edit_data=array();
        if(!empty($id)){
            $id = Crypt::decrypt($id);
            $edit_data = User::where('id', $id)->first();
        }
        $partner_list = User::where('user_type', 2)->get();
        // print_r($roles);die;
        return view('admin.user.save-partner-agent',compact('edit_data', 'title', 'title_url', 'sub_title', 'partner_list'));
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            // 'reporting_role' => 'required',
        ]);
     
        if (!$validator->passes()) {
            return response()->json(['status'=>2, 'message'=>$validator->errors()->all()]);
        }
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        
        return response()->json(['status'=>1, 'message'=>'User created successfully']);
    }
    public function save_partner_agent(Request $request)
    {
        //
        $validator_arr = [
            'user_type' => 'required',
            'country' => 'required',
            'contact' => 'required',
            'commision_type' => 'required',
            'commision_value' => 'required',
            'currency' => 'required',
            'name' => 'required'
        ];
        if($request->input('edit_id')==0){
            $validator_arr['email'] = 'required|email|unique:users,email';
            $validator_arr['password'] = 'required|same:confirm-password';
        }
        if($request->input('edit_id')>0 && $request->input('password')){
            $validator_arr['password'] = 'required|same:confirm-password';
        }
        $validator = Validator::make($request->all(), $validator_arr);
        
        if (!$validator->passes()) {
            return response()->json(['status'=>2, 'message'=>$validator->errors()->all()]);
        }
    
        // $input = $request->all();
        $input['name'] = $request->input('name');
        $input['email'] = $request->input('email');
        $input['address'] = $request->input('address');
        $input['contact'] = $request->input('contact');
        $input['whatsapp_contact'] = $request->input('whatsapp_contact');
        $input['user_type'] = $request->input('user_type');
        $input['country'] = $request->input('country');
        $input['commision_type'] = $request->input('commision_type');
        $input['commision_value'] = $request->input('commision_value');
        $input['currency'] = $request->input('currency');

        if($request->input('password') || $request->input('edit_id')==0){
            $input['password'] = $request->input('password');
            $input['password'] = Hash::make($input['password']);
        }
        if($request->input('user_type')==2){
            $input['partner_id'] = '';
            $role = "Partner";
            $id_name = "P";
        }else if($request->input('user_type')==3){
            $input['partner_id'] = $request->input('partner_id');
            $role = "Agent";
            $id_name = "A";
        }
        if($request->input('edit_id')==0){
            $user = User::create($input);
            if(!empty($role)){
                $user->assignRole($role);
            }
            $unique_id = "GRUNI-IN-".$id_name."0000".($user->id+1);
            User::where('id', $user->id)->update(['id_number'=>$unique_id]);
            // echo $user->id;die;
        }else{
            User::where('id', $request->input('edit_id'))->update($input);
        }
        
        return response()->json(['status'=>1, 'input'=>$input, 'message'=>'Partner/Agent Save successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::find($id);
        $title="Partner/Agent";
        $title_url=route('users.list.index');
        $sub_title="Show Partner/Agent";
        return view('admin.user.show',compact('user', 'title', 'title_url', 'sub_title'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $title="Partner/Agent";
        $title_url=route('users.list.index');
        $sub_title="Edit Partner/Agent";
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        $reporting_person = '';
        if($user->reporting_role){
            $reporting_person = Role::where('roles.name', $user->reporting_role)
                                ->select('users.id', 'users.name')
                                ->join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
                                ->join('users', 'model_has_roles.model_id', '=', 'users.id')
                                ->get();
        }
        
        return view('admin.user.edit',compact('user','roles','userRole', 'title', 'title_url', 'sub_title', 'reporting_person'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updates(Request $request)
    {
        $id = $request->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
            // 'emp_position' => 'required',
        ]);
        if (!$validator->passes()) {
            return response()->json(['status'=>2, 'message'=>$validator->errors()->all(), 'data'=>$request->name]);
        }
    
        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input, array('password'));    
        }
        // DB::enableQueryLog();
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));

        // return response()->json(['status'=>2, 'message'=>"data", 'data1'=>$input1, 'data2'=>$input, 'qry'=>DB::getQueryLog()]);
        return response()->json(['status'=>1, 'message'=>'User updated successfully']);
    }
        
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        User::find($id)->delete();
        if(UserDetails::where("user_id", $id)->exists()){
            UserDetails::where("user_id", $id)->delete();
        }
        // return redirect()->route('users.index')
        return redirect()->back()
                        ->with('success','Record deleted successfully');
    }
    public function getReportingPerson(Request $request)
    {
        $id = $request->role_id;
        $users = Role::where('roles.name', $id)
                    ->select('users.id', 'users.name')
                    ->join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
                    ->join('users', 'model_has_roles.model_id', '=', 'users.id')
                    ->get();
        
        return response()->json(['status'=>1, 'message'=>'Partner/Agent lists', 'data'=>$users]);        
    }
    public function userProjects($id)
    {
        $id = Crypt::decrypt($id);
        $data['user'] = User::select('id', 'name')->find($id);
        if(empty($data['user'])){
            return redirect()->back()->with('error','Invalid user data...');
        }
        
        $data['user_projects'] = AssigneProject::select('assigne_project')
                                ->whereRaw("find_in_set('".$data['user']->id."', assigne_to)")
                                ->pluck('assigne_project','assigne_project')
                                ->all();
        
        $data['projects']=WorkingLocation::where('status', 1)->get();
        $data['title']="Partner/Agent";
        $data['title_url']=route('users.list.index');
        $data['sub_title']="Partner/Agent Projects";
        return view('admin.user.user-projects', $data);
    }
    public function removeUserProject(Request $request)
    {
        
        if(empty($request->pid)){
            return response()->json(['status'=>0, 'message'=>'Project not found...']);
        }
        $pid = Crypt::decrypt($request->pid);
        
        if(empty($request->uid)){
            return response()->json(['status'=>0, 'message'=>'Partner/Agent not found...']);
        }
        $uid = Crypt::decrypt($request->uid);
        
        $assigned_project = AssigneProject::where("assigne_project", $pid)->pluck('assigne_to','assigne_to')->first();
        $project = explode(",", $assigned_project);
        for($i=0;$i<count($project); $i++){
            if($project[$i]==$uid){
                unset($project[$i]);
            }
        }
        $res = AssigneProject::where("assigne_project", $pid)->update(['assigne_to'=>implode(",", $project)]);
        if($res){
            return response()->json(['status'=>1, 'message'=>'Project Removed Successfull']);
        }else{
            return response()->json(['status'=>0, 'message'=>'Failed to Remove Project']);
        }
    }
    public function saveUserProjects(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uid' => 'required',
            'projects' => 'required',
        ]);
        if (!$validator->passes()) {
            return response()->json(['status'=>0, 'message'=>$validator->errors()->all(), 'data'=>$request->name]);
        }
        $uid = Crypt::decrypt($request->uid);
        
        $assigned_project = AssigneProject::select('id', 'assigne_project', 'assigne_to')->whereIn("assigne_project", $request->projects)->get();
        foreach($assigned_project as $key=>$val){
            AssigneProject::where("id", $val->id)->update(['assigne_to'=>$val->assigne_to.",".$uid]);
        }
        
        return response()->json(['status'=>1, 'message'=>'Project assigned to user Successfull']);
        
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
        $totalRecords = User::select('count(*) as allcount')->whereIn('user_type', [1])->count();

        $totalRecordswithFilter = User::select('count(*) as allcount')->whereIn('user_type', [1])->where('name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records 
        $records = User::orderBy($columnName, $columnSortOrder)
                ->select('*');

        

        $records = $records->whereIn('user_type', [1])
                ->where('name', 'like', '%' .$searchValue . '%')
                ->skip($start)
                ->take($rowperpage)
                ->get();
                /*User::orderBy($columnName, $columnSortOrder)
                ->where('users.name', 'like', '%' .$searchValue . '%')
                ->select('users.*', 'x.name as reporting_to')
                ->join('users as x', 'x.reporting_to', '=', 'users.id')
                ->skip($start)
                ->take($rowperpage)
                ->get();*/

        $data_arr = array();
        $sr = 1;
        foreach($records as $val){
            $arr["id"] = $sr++;
            $arr["name"] = $val->name;
            $arr["email"] = $val->email;
            $arr["contact"] = $val->contact;
            $role='';
            if(!empty($val->getRoleNames())){
                foreach($val->getRoleNames() as $v){
                    $role .= '<span class="badge badge-pill badge-gradient-success">'.$v.'</span>';
                }
            }
            $arr["role"] = $role;
            
            $action = '';
            
            if(auth()->user()->can('user-edit')){
                $action .= '
                    <a href="'.route('user.edit', ['id'=>Crypt::encrypt($val->id)]).'" class="text-gray m-r-15 dropdown-item"><i class="ti-pencil"></i> Edit</a>';
            }
            if($val->id!=1){
                if(auth()->user()->can('user-delete')){
                    $action .= '
                        <a href="javascript:void(0)" onclick="delete_item(`'.route('user.destroy', ['id'=>Crypt::encrypt($val->id)]).'`)" class="text-danger dropdown-item"><i class="ti-trash"></i> Delete</a>';
                }
            }
            
            // data-toggle="modal" data-target="#modal-sm"   user-projects
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
    public function datatables_partner_agent(Request $request){

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
        $totalRecords = User::select('count(*) as allcount');
        if(Auth::user()->user_type==2){
            $totalRecords = $totalRecords->where('partner_id', Auth::user()->id);
        }
        $totalRecords = $totalRecords->whereIn('user_type', [3,2])->count();

        $totalRecordswithFilter = User::select('count(*) as allcount')->whereIn('user_type', [3,2]);
        if(Auth::user()->user_type==2){
            $totalRecordswithFilter = $totalRecordswithFilter->where('partner_id', Auth::user()->id);
        }
        $totalRecordswithFilter = $totalRecordswithFilter->where('name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = User::orderBy($columnName, $columnSortOrder);

        if(Auth::user()->user_type==2){
            $records = $records->where('partner_id', Auth::user()->id);
        }
        $records = $records->where('name', 'like', '%' .$searchValue . '%')
                ->whereIn('user_type', [3,2])
                ->select('*')
                ->skip($start)
                ->take($rowperpage)
                ->get();
                
        $data_arr = array();
        $sr = 1;
        foreach($records as $val){
            $arr["id"] = $sr++;
            $arr["name"] = $val->name;
            $arr["email"] = $val->email;
            $arr["contact"] = $val->contact;
            $arr["role"] = $val->user_type==2?"Partner":"Agent";
            
            $action = '';
            
            if(auth()->user()->can('partner-agent-edit')){
                $action .= '
                    <a href="'.route('admin.partner-user.save', ['id'=>Crypt::encrypt($val->id)]).'" class="text-gray m-r-15 dropdown-item"><i class="ti-pencil"></i> Edit</a>';
            }
            if($val->id!=1){
                if(auth()->user()->can('partner-user-delete')){
                    $action .= '
                        <a href="javascript:void(0)" onclick="delete_item(`'.route('user.destroy', ['id'=>Crypt::encrypt($val->id)]).'`)" class="text-danger dropdown-item"><i class="ti-trash"></i> Delete</a>';
                }
            }
            
            // data-toggle="modal" data-target="#modal-sm"   user-projects
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
    
    public function change_password()
    {
        // $password = Hash::make("aepl@co");
        
        // $user = User::where(['id'=>auth()->user()->id])->update(['password'=>$password]);
        
        $title="User";
        $title_url=route('users.list.index');
        $sub_title="Edit Password";
        
        return view('admin.user.update-password',compact('title', 'title_url', 'sub_title'));
    }
    
    public function update_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|same:confirm_password',
        ]);
     
        if (!$validator->passes()) {
            return response()->json(['status'=>0, 'message'=>$validator->errors()->all()]);
        }
        
        // if(User::find(auth()->user()->id)->password!==Hash::make($request->old_password)){
        if(!Hash::check( $request->old_password, User::find(auth()->user()->id)->password )){
            return response()->json([
                    'status'=>0, 'message'=>'Old password not matched.', 
                    'db'=>User::find(auth()->user()->id)->password, 
                    'old'=>$request->old_password, 
                    'my'=>Hash::make("aepl@co"),
                    'check'=>Hash::check( $request->old_password, User::find(auth()->user()->id)->password ),
                ]);
        }
        $password = Hash::make($request->password);
    
        $user = User::where(['id'=>auth()->user()->id])->update(['password'=>$password]);
        
        if($user){
            return response()->json(['status'=>1, 'message'=>'Password Update Successfull']);
        }else{
            return response()->json(['status'=>0, 'message'=>'Failed to update password, try again...']);
        }
    }
    public function user_performance(Request $request, $uid)
    {
        $data['title']="User";
        $data['title_url']=route('users.list.index');
        $data['sub_title']="Performance";
        $data['from_date'] = '';
        $data['to_date'] = '';
        $id = Crypt::decrypt($uid);
        $data['user'] = User::where(['id'=>$id])->first();
        $data['projects'] = ProjectUser::where(['project_users.user_id'=>$id, 'project_users.board_type'=>1])
                                            ->join('projects as x', 'x.id', '=', 'project_users.board_id')
                                            ->select('x.id', 'x.project_name')
                                            ->get();
        if(isset($request->from_date) &&isset($request->to_date)){
            $data['from_date'] = $request->from_date;
            $data['to_date'] = $request->to_date;
        }
        
        return view('admin.user.performance', $data);
    }


}