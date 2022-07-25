<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
class CustomerController extends Controller
{
    function index() {
        $customers = User::where(['user_type' => 1])->orderBy('id', 'DESC')->get();
        return view('admin.customer.list', compact(['customers']));
    } 

    function block($id = null) {
      
       if($id == null) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Please select a customer.']);
        }
        
        $customer = User::find($id);
        $if_placed_ordered= Order::where(['user_id' => $id,'order_status'=>'1'])->first();
        if(isset($if_placed_ordered) && !empty($if_placed_ordered)){
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Customer cannot be blocked, some orders are in progress']);
        }
        if(!$customer) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Invalid customer id']);
        }
        $block=($customer['is_block']==0)?1:0;
        
        $customer->is_block = $block; 
        $message=($block==0)?"Customer unblocked successfully":"Customer blocked successfully";
        if($customer->save()) {
            return redirect()->route('customers')->with(['status' => 'success', 'message' => $message]);
        }   else {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Something Went wrong.']);
        }
    }

    function delete($id = null) {
        if($id == null) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Please select a customer.']);
        }
        $if_placed_ordered= Order::where(['user_id' => $id,'order_status'=>'1'])->first();
        if(isset($if_placed_ordered) && !empty($if_placed_ordered)){
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Customer cannot be deleted,some orders are in progress']);
        }
        if(User::where('id', $id)->delete()) {
            return redirect()->back()->with(['status' => 'success', 'message' => 'Customer deleted successfully']);
        }   else {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Something Went wrong.']);
        }
    }

    
}
