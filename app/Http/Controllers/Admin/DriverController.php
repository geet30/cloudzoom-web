<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;

class DriverController extends Controller
{
    function approvedDrivers(Request $request) {
        $is_approve=$request->get('is_approved');
        $drivers = User::with('getlocation')->where(['user_type' => 2,'is_approved'=>1])->orderBy('id', 'DESC')->get();
        return view('admin.driver.list', compact(['drivers','is_approve']));
    } 

    function unapprovedDrivers(Request $request) {
        $is_approve=$request->get('is_approved');
        $drivers = User::with('getlocation')->where(['user_type' => 2,'is_approved'=>0])->orderBy('id', 'DESC')->get();
        return view('admin.driver.list', compact(['drivers','is_approve']));
    } 
    function rejectedDrivers(Request $request) {
        $is_approve=$request->get('is_approved');
        $drivers = User::with('getlocation')->where(['user_type' => 2,'is_approved'=>2])->orderBy('id', 'DESC')->get();
        return view('admin.driver.list', compact(['drivers','is_approve']));
    } 

    function add(Request $request) {
        $is_approve=$request->get('is_approved');
        return view('admin.driver.add', compact(['is_approve']));
    }

    function save(Request $request) { 
        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);
        
        $data = $request->all();
        
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Email Address is invalid'])->withInput();
        }
        // echo "<pre>"; print_r($data); exit;
        $driver = new User();
        $driver->name = $data['name'];
        $driver->username = $data['username'];
        $driver->email = $data['email'];
        $driver->password = bcrypt($data['password']);
        $driver->user_type = 2;
        if($driver->save()) {
            return redirect()->route('unapprovedDrivers',['is_approved' => 0])->with(['status' => 'success', 'message' => 'Driver Saved Successfully']);
            
        }   else {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Something Went wrong.'])->withInput();
        }
    
    }

    function viewProfile($id) {
        $driver= User::where(['user_type' => 2])->orderBy('id', 'DESC')->first();
        return view('admin.driver.profile', compact(['driver']));
    } 

    function edit(Request $request,$id = null) {
        $is_approve=$request->get('is_approved');
        if($id == null) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Invalid driver id']);
        }
        $driver = User::where('id', $id)->first();
        if(!$driver) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Invalid user id']);
        }
        return view('admin.driver.edit', compact(['driver','is_approve']));
    }

    function update($id = null, Request $request){
    	if($id == null) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Please select a user.']);
        }
        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'sometimes|confirmed'
        ]);
        
        $data = $request->all();
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Email Address is invalid'])->withInput();
        }
        $driver = User::find($id);
        if(!$driver) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Invalid user id']);
        }
        $driver->name = $data['name'];
        $driver->username = $data['username'];
        $driver->email = $data['email'];
        if($data['password'] != "") {
            $driver->password = bcrypt($data['password']);
        }

        if($driver->save()) {
            if($data['is_approved']==0)
            {
              return redirect()->route('unapprovedDrivers',['is_approved' => 0])->with(['status' => 'success', 'message' => 'Driver updated successfully']);

            }else{
                return redirect()->route('approvedDrivers',['is_approved' =>1])->with(['status' => 'success', 'message' => 'Driver updated successfully']);
            }
            
        }else {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Something Went wrong.'])->withInput();
        }
    	
    }

    function delete(Request $request,$id=null) {
       
        
        if(User::where('id', $id)->delete()) {
            return response()->json(array('success' => true,'message'=>'Driver deleted successfully')); 
        }   else {
            return response()->json(array('success' => true,'message'=>'Something Went wrong.')); 
        }
    }
    function reject($id = null) {
        if($id == null) {
             return redirect()->back()->with(['status' => 'danger', 'message' => 'Please select a driver.']);
         }
         
         $driver = User::find($id);
         if(!$driver) {
             return response()->json(array('success' => fasle,'message'=>'Invalid driver id'));
         }
         $approve=($driver['is_approved']==2)?1:2;
         
         $driver->is_approved = $approve; 
         $message=($approve==2)?"Driver Rejected successfully":"Driver Approved successfully";
         if($driver->save()) {
             return response()->json(array('success' => true,'message'=>$message));
         }else{
             return response()->json(array('success' => false,'message'=>'Something Went wrong.'));
         }
     }
    function block($id = null) {
      
        if($id == null) {
             return redirect()->back()->with(['status' => 'danger', 'message' => 'Please select a driver.']);
         }
         
         $driver = User::find($id);
         if(!$driver) {
            return redirect()->back()->with(['status' => 'danger','message' => 'Invalid driver id']);
         }
         $block=($driver['is_block']==0)?1:0;
         
         $driver->is_block = $block; 
         $message=($block==0)?"Driver unblocked successfully":"Driver blocked successfully";
         if($driver->save()) {
             return redirect()->route('approvedDrivers')->with(['status' => 'success', 'message' => $message]);
         }   else {
             return redirect()->back()->with(['status' => 'danger', 'message' => 'Something Went wrong.']);
         }
    }
    function approve($id = null) {
       if($id == null) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Please select a driver.']);
        }
        
        $driver = User::find($id);
        if(!$driver) {
            return response()->json(array('success' => fasle,'message'=>'Invalid driver id'));
        }
        $approve=($driver['is_approved']==0)?1:0;
        
        $driver->is_approved = $approve; 
        $message=($approve==0)?"Driver Disapproved successfully":"Driver Approved successfully";
        if($driver->save()) {
        	return response()->json(array('success' => true,'message'=>$message));
        }else{
            return response()->json(array('success' => false,'message'=>'Something Went wrong.'));
        }
    }
  
}
