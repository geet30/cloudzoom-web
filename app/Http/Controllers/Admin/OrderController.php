<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Promo;
class OrderController extends Controller
{
    function index() {
        $orders = Order::with('user')->orderBy('id', 'DESC')->get();      
        return view('admin.order.list', compact(['orders']));
    } 

    function viewOrder($id) {
        $order_view= Order::with('user','promos')->where(['id' => $id])->orderBy('id', 'DESC')->first();
        // $order_products= Order::with('OrderProduct')->where(['id' => $id])->orderBy('id', 'DESC')->get();
       
        $order_products=OrderProduct::with( ['product','product.Category'])->where(['order_id' => $id])->orderBy('id', 'DESC')->get();
        // foreach($order_products as $order){
          
        //     foreach($order->product as $category){
        //         echo "<pre>";print_r($category);die;
        //         // echo "<pre>";print_r($order->product->item_name);die;
        //     }
        // }
        // echo "<pre>";print_r($order_products);die;
        return view('admin.order.view', compact(['order_view','order_products']));
    } 

    function delete($id = null) {
        if($id == null) {
            return redirect()->back()->with(['status' => 'danger','message' =>'Please select a Order.']);
        }
        
        if(Order::where('id', $id)->delete()) {
            return redirect()->back()->with(['status' => 'success', 'message' => 'Order deleted successfully']);
        }   else {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Something went wrong.']);
        }
    }
   
}
