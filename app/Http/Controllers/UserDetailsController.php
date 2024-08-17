<?php

namespace App\Http\Controllers;

use App\Models\Admin\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Crypt;
use Validator;

class UserDetailsController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:user-details-update', ['only' => ['index','store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $id = Crypt::decrypt($id);
        $data['user']=User::find($id);
        if(empty($data['user'])){
            return redirect()->route('users.index')
                        ->with('success','User not Found');
        }
        $data['title']="User";
        $data['title_url']=route('users.apel.index');
        $data['sub_title']="Update User Details";
        $data['user_details']=UserDetails::where('user_id', $id)->first();
        return view('admin.user.user-details',$data);
    }
    public function profile()
    {
        $data['title']="Profile";
        $data['title_url']=route('users.apel.index');
        $data['sub_title']="Update Profile";
        $data['user']=User::find(auth()->user()->id);
        $data['user_details']=UserDetails::where('user_id', auth()->user()->id)->first();
        return view('admin.user.profile',$data);
    }

    
    public function create()
    {
        
    }
    public function store(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'basic_salary' => 'required',
        ]);
        if (!$validator->passes()) {
            return response()->json(['status'=>2, 'message'=>$validator->errors()->all(), 'data'=>$request->name]);
        }

        // return response()->json(['status'=>0, 'message'=>$validator->errors()->all(), 'data'=>$_FILES]);

        $u_details=UserDetails::where("user_id", $id)->first();
        if(!$u_details)
        {
            $obj=new UserDetails();
            $obj->user_id = $id;
        }else{
            $obj=UserDetails::find($u_details->id);
        }

        $obj->father_name = $request->father_name;
        $obj->dob = $request->dob;
        $obj->gender = $request->gender;
        $obj->phone = $request->phone;
        $obj->localaddress = $request->localaddress;
        $obj->premanent_address = $request->premanent_address;
        $obj->employe_id = $request->employe_id;
        $obj->department = $request->department;
        $obj->designation = $request->designation;
        $obj->credit_leaves = $request->credit_leaves;
        $obj->doj = $request->doj;
        $obj->basic_salary = $request->basic_salary;
        $obj->hourly_salary = $request->hourly_salary;
        $obj->ac_holder_name = $request->ac_holder_name;
        $obj->ac_number = $request->ac_number;
        $obj->bank_name = $request->bank_name;
        $obj->ifsc_code = $request->ifsc_code;
        $obj->branch_location = $request->branch_location;
        $obj->tax_payer_id = $request->tax_payer_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_name1 = 'img_' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath1 = public_path('uploads/user-profile/');
            if (!File::exists($destinationPath1)) {
                File::makeDirectory($destinationPath1);
            }
            $image->move($destinationPath1, $file_name1);
            if(File::exists($obj->image)) {
                File::delete($obj->image);
            }
            $obj->image = 'uploads/user-profile/' . $file_name1;
        }
        if ($request->hasFile('resume')) {
            $resume = $request->file('resume');
            $file_name2 = 'resume_' . time() . '.' . $resume->getClientOriginalExtension();
            $destinationPath2 = public_path('uploads/user-docs/');
            if (!File::exists($destinationPath2)) {
                File::makeDirectory($destinationPath2);
            }
            $resume->move($destinationPath2, $file_name2);
            if(File::exists($obj->resume)) {
                File::delete($obj->resume);
            }
            $obj->resume = 'uploads/user-docs/' . $file_name2;
        }
        if ($request->hasFile('offer_letter')) {
            $offer_letter = $request->file('offer_letter');
            $file_name3 = 'offer_letter_' . time() . '.' . $offer_letter->getClientOriginalExtension();
            $destinationPath3 = public_path('uploads/user-docs/');
            if (!File::exists($destinationPath3)) {
                File::makeDirectory($destinationPath3);
            }
            $offer_letter->move($destinationPath3, $file_name3);
            if(File::exists($obj->offer_letter)) {
                File::delete($obj->offer_letter);
            }
            $obj->offer_letter = 'uploads/user-docs/' . $file_name3;
        }
        if ($request->hasFile('joining_letter')) {
            $joining_letter = $request->file('joining_letter');
            $file_name4 = 'joining_letter_' . time() . '.' . $joining_letter->getClientOriginalExtension();
            $destinationPath4 = public_path('uploads/user-docs/');
            if (!File::exists($destinationPath4)) {
                File::makeDirectory($destinationPath4);
            }
            $joining_letter->move($destinationPath4, $file_name4);
            if(File::exists($obj->joining_letter)) {
                File::delete($obj->joining_letter);
            }
            $obj->joining_letter = 'uploads/user-docs/' . $file_name4;
        }
        if ($request->hasFile('agreement')) {
            $agreement = $request->file('agreement');
            $file_name5 = 'agreement_' . time() . '.' . $agreement->getClientOriginalExtension();
            $destinationPath5 = public_path('uploads/user-docs/');
            if (!File::exists($destinationPath5)) {
                File::makeDirectory($destinationPath5);
            }
            $agreement->move($destinationPath5, $file_name5);
            if(File::exists($obj->agreement)) {
                File::delete($obj->agreement);
            }
            $obj->agreement = 'uploads/user-docs/' . $file_name5;
        }
        if ($request->hasFile('id_proof')) {
            $id_proof = $request->file('id_proof');
            $file_name6 = 'id_proof_' . time() . '.' . $id_proof->getClientOriginalExtension();
            $destinationPath6 = public_path('uploads/user-docs/');
            if (!File::exists($destinationPath6)) {
                File::makeDirectory($destinationPath6);
            }
            $id_proof->move($destinationPath6, $file_name6);
            if(File::exists($obj->id_proof)) {
                File::delete($obj->id_proof);
            }
            $obj->id_proof = 'uploads/user-docs/' . $file_name6;
        }
        if ($request->hasFile('high_school')) {
            $high_school = $request->file('high_school');
            $file_name7 = 'high_school_' . time() . '.' . $high_school->getClientOriginalExtension();
            $destinationPath7 = public_path('uploads/user-docs/');
            if (!File::exists($destinationPath7)) {
                File::makeDirectory($destinationPath7);
            }
            $high_school->move($destinationPath7, $file_name7);
            if(File::exists($obj->high_school)) {
                File::delete($obj->high_school);
            }
            $obj->high_school = 'uploads/user-docs/' . $file_name7;
        }
        if ($request->hasFile('intermediate')) {
            $intermediate = $request->file('intermediate');
            $file_name8 = 'intermediate_' . time() . '.' . $intermediate->getClientOriginalExtension();
            $destinationPath8 = public_path('uploads/user-docs/');
            if (!File::exists($destinationPath8)) {
                File::makeDirectory($destinationPath8);
            }
            $intermediate->move($destinationPath8, $file_name8);
            if(File::exists($obj->intermediate)) {
                File::delete($obj->intermediate);
            }
            $obj->intermediate = 'uploads/user-docs/' . $file_name8;
        }
        if ($request->hasFile('graduation')) {
            $graduation = $request->file('graduation');
            $file_name9 = 'graduation_' . time() . '.' . $graduation->getClientOriginalExtension();
            $destinationPath9 = public_path('uploads/user-docs/');
            if (!File::exists($destinationPath9)) {
                File::makeDirectory($destinationPath9);
            }
            $graduation->move($destinationPath9, $file_name9);
            if(File::exists($obj->graduation)) {
                File::delete($obj->graduation);
            }
            $obj->graduation = 'uploads/user-docs/' . $file_name9;
        }
        if ($request->hasFile('post_graduation')) {
            $post_graduation = $request->file('post_graduation');
            $file_name10 = 'post_graduation_' . time() . '.' . $post_graduation->getClientOriginalExtension();
            $destinationPath10 = public_path('uploads/user-docs/');
            if (!File::exists($destinationPath10)) {
                File::makeDirectory($destinationPath10);
            }
            $post_graduation->move($destinationPath10, $file_name10);
            if(File::exists($obj->post_graduation)) {
                File::delete($obj->post_graduation);
            }
            $obj->post_graduation = 'uploads/user-docs/' . $file_name10;
        }
        if ($request->hasFile('other_certificates')) {
            $other_certificates = $request->file('other_certificates');
            $file_name11 = 'other_certificates_' . time() . '.' . $other_certificates->getClientOriginalExtension();
            $destinationPath11 = public_path('uploads/user-docs/');
            if (!File::exists($destinationPath11)) {
                File::makeDirectory($destinationPath11);
            }
            $other_certificates->move($destinationPath11, $file_name11);
            if(File::exists($obj->other_certificates)) {
                File::delete($obj->other_certificates);
            }
            $obj->other_certificates = 'uploads/user-docs/' . $file_name11;
        }
        // $a = $obj;

        if($obj->save()){
            $res['status']=1;
            $res['message']="User details Update Successful";
        }else{
            $res['status']=0;
            $res['message']="Failed to update User details";
        }
            // $res['aa']=$a;
        return response()->json($res);

    }
    public function updateProfile(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            // 'basic_salary' => 'required',
        ]);
        if (!$validator->passes()) {
            return response()->json(['status'=>2, 'message'=>$validator->errors()->all(), 'data'=>$request->name]);
        }

        // return response()->json(['status'=>0, 'message'=>$validator->errors()->all(), 'data'=>$_FILES]);

        $u_details=UserDetails::where("user_id", $id)->first();
        if(!$u_details)
        {
            $obj=new UserDetails();
            $obj->user_id = $id;
        }else{
            $obj=UserDetails::find($u_details->id);
        }

        $obj->father_name = $request->father_name;
        $obj->dob = $request->dob;
        $obj->gender = $request->gender;
        $obj->phone = $request->phone;
        $obj->localaddress = $request->localaddress;
        $obj->premanent_address = $request->premanent_address;
        // $obj->employe_id = $request->employe_id;
        // $obj->department = $request->department;
        // $obj->designation = $request->designation;
        // $obj->credit_leaves = $request->credit_leaves;
        // $obj->doj = $request->doj;
        // $obj->basic_salary = $request->basic_salary;
        // $obj->hourly_salary = $request->hourly_salary;
        $obj->ac_holder_name = $request->ac_holder_name;
        $obj->ac_number = $request->ac_number;
        $obj->bank_name = $request->bank_name;
        $obj->ifsc_code = $request->ifsc_code;
        $obj->branch_location = $request->branch_location;
        $obj->tax_payer_id = $request->tax_payer_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_name1 = 'img_' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath1 = public_path('uploads/user-profile/');
            if (!File::exists($destinationPath1)) {
                File::makeDirectory($destinationPath1);
            }
            $image->move($destinationPath1, $file_name1);
            if(File::exists($obj->image)) {
                File::delete($obj->image);
            }
            $obj->image = 'uploads/user-profile/' . $file_name1;
        }
        if ($request->hasFile('resume')) {
            $resume = $request->file('resume');
            $file_name2 = 'resume_' . time() . '.' . $resume->getClientOriginalExtension();
            $destinationPath2 = public_path('uploads/user-docs/');
            if (!File::exists($destinationPath2)) {
                File::makeDirectory($destinationPath2);
            }
            $resume->move($destinationPath2, $file_name2);
            if(File::exists($obj->resume)) {
                File::delete($obj->resume);
            }
            $obj->resume = 'uploads/user-docs/' . $file_name2;
        }
        if ($request->hasFile('offer_letter')) {
            $offer_letter = $request->file('offer_letter');
            $file_name3 = 'offer_letter_' . time() . '.' . $offer_letter->getClientOriginalExtension();
            $destinationPath3 = public_path('uploads/user-docs/');
            if (!File::exists($destinationPath3)) {
                File::makeDirectory($destinationPath3);
            }
            $offer_letter->move($destinationPath3, $file_name3);
            if(File::exists($obj->offer_letter)) {
                File::delete($obj->offer_letter);
            }
            $obj->offer_letter = 'uploads/user-docs/' . $file_name3;
        }
        if ($request->hasFile('joining_letter')) {
            $joining_letter = $request->file('joining_letter');
            $file_name4 = 'joining_letter_' . time() . '.' . $joining_letter->getClientOriginalExtension();
            $destinationPath4 = public_path('uploads/user-docs/');
            if (!File::exists($destinationPath4)) {
                File::makeDirectory($destinationPath4);
            }
            $joining_letter->move($destinationPath4, $file_name4);
            if(File::exists($obj->joining_letter)) {
                File::delete($obj->joining_letter);
            }
            $obj->joining_letter = 'uploads/user-docs/' . $file_name4;
        }
        if ($request->hasFile('agreement')) {
            $agreement = $request->file('agreement');
            $file_name5 = 'agreement_' . time() . '.' . $agreement->getClientOriginalExtension();
            $destinationPath5 = public_path('uploads/user-docs/');
            if (!File::exists($destinationPath5)) {
                File::makeDirectory($destinationPath5);
            }
            $agreement->move($destinationPath5, $file_name5);
            if(File::exists($obj->agreement)) {
                File::delete($obj->agreement);
            }
            $obj->agreement = 'uploads/user-docs/' . $file_name5;
        }
        if ($request->hasFile('id_proof')) {
            $id_proof = $request->file('id_proof');
            $file_name6 = 'id_proof_' . time() . '.' . $id_proof->getClientOriginalExtension();
            $destinationPath6 = public_path('uploads/user-docs/');
            if (!File::exists($destinationPath6)) {
                File::makeDirectory($destinationPath6);
            }
            $id_proof->move($destinationPath6, $file_name6);
            if(File::exists($obj->id_proof)) {
                File::delete($obj->id_proof);
            }
            $obj->id_proof = 'uploads/user-docs/' . $file_name6;
        }
        
        /*if ($request->hasFile('high_school')) {
            $high_school = $request->file('high_school');
            $file_name7 = 'high_school_' . time() . '.' . $high_school->getClientOriginalExtension();
            $destinationPath7 = public_path('uploads/user-docs/');
            if (!File::exists($destinationPath7)) {
                File::makeDirectory($destinationPath7);
            }
            $high_school->move($destinationPath7, $file_name7);
            if(File::exists($obj->high_school)) {
                File::delete($obj->high_school);
            }
            $obj->high_school = 'uploads/user-docs/' . $file_name7;
        }
        if ($request->hasFile('intermediate')) {
            $intermediate = $request->file('intermediate');
            $file_name8 = 'intermediate_' . time() . '.' . $intermediate->getClientOriginalExtension();
            $destinationPath8 = public_path('uploads/user-docs/');
            if (!File::exists($destinationPath8)) {
                File::makeDirectory($destinationPath8);
            }
            $intermediate->move($destinationPath8, $file_name8);
            if(File::exists($obj->intermediate)) {
                File::delete($obj->intermediate);
            }
            $obj->intermediate = 'uploads/user-docs/' . $file_name8;
        }
        if ($request->hasFile('graduation')) {
            $graduation = $request->file('graduation');
            $file_name9 = 'graduation_' . time() . '.' . $graduation->getClientOriginalExtension();
            $destinationPath9 = public_path('uploads/user-docs/');
            if (!File::exists($destinationPath9)) {
                File::makeDirectory($destinationPath9);
            }
            $graduation->move($destinationPath9, $file_name9);
            if(File::exists($obj->graduation)) {
                File::delete($obj->graduation);
            }
            $obj->graduation = 'uploads/user-docs/' . $file_name9;
        }
        if ($request->hasFile('post_graduation')) {
            $post_graduation = $request->file('post_graduation');
            $file_name10 = 'post_graduation_' . time() . '.' . $post_graduation->getClientOriginalExtension();
            $destinationPath10 = public_path('uploads/user-docs/');
            if (!File::exists($destinationPath10)) {
                File::makeDirectory($destinationPath10);
            }
            $post_graduation->move($destinationPath10, $file_name10);
            if(File::exists($obj->post_graduation)) {
                File::delete($obj->post_graduation);
            }
            $obj->post_graduation = 'uploads/user-docs/' . $file_name10;
        }
        if ($request->hasFile('other_certificates')) {
            $other_certificates = $request->file('other_certificates');
            $file_name11 = 'other_certificates_' . time() . '.' . $other_certificates->getClientOriginalExtension();
            $destinationPath11 = public_path('uploads/user-docs/');
            if (!File::exists($destinationPath11)) {
                File::makeDirectory($destinationPath11);
            }
            $other_certificates->move($destinationPath11, $file_name11);
            if(File::exists($obj->other_certificates)) {
                File::delete($obj->other_certificates);
            }
            $obj->other_certificates = 'uploads/user-docs/' . $file_name11;
        }*/
        // $a = $obj;

        if($obj->save()){
            $res['status']=1;
            $res['message']="Profile Update Successful";
        }else{
            $res['status']=0;
            $res['message']="Failed to update Profile";
        }
            // $res['aa']=$a;
        return response()->json($res);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\UserDetails  $userDetails
     * @return \Illuminate\Http\Response
     */
    public function show(UserDetails $userDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\UserDetails  $userDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(UserDetails $userDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\UserDetails  $userDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserDetails $userDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\UserDetails  $userDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDetails $userDetails)
    {
        //
    }
}
