<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\FavouriteItem;
use Exception;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

	/**
     * Fetch all orders of a requested user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {

        $data=$request->all();

        $validator = Validator::make($data, [
            'limit' => 'numeric | nullable',
            'page' => 'numeric | nullable',
        ]);

       if ($validator->fails()) {
            $res = [
                'success' => false,
                'message' => __($validator->messages()->first())
            ];
            return response()->json($res);
        }

        $limit = $request->limit ? $request->limit : 10;


         //pagination

        $orders = Order::with(['orderproduct'])->where(['orders.user_id'=>\Auth::user()->id])->orderBy('created_at', 'Desc')->paginate($limit)->toArray();

        if($orders['data']){
            $res = ['success' => true, 'message' =>'Orders list','current_page'=>$orders['current_page'],'last_page'=>$orders['last_page'],'total_results'=>$orders['total'],'data'=>$orders['data']];
        }else{
        	 $res = ['success' => false, 'message' =>'No orders found','current_page'=>$orders['current_page'],'last_page'=>$orders['last_page'],'total_results'=>$orders['total'],'data'=>$orders['data']];
        }

         return response()->json($res);
          
    	
    }

    public function addOrder(Request $request)
    {
    	$data=$request->all();

         $validator = Validator::make($data, [
            'products' => 'required|array|min:1',
            'products.*'  => 'required|min:4',
            'quantity' => 'required|numeric',
            'sub_total' =>'required|numeric',
            'service_fee' =>'required|numeric',
            'delivery_fee' =>'required|numeric',
            'discount' =>'required|numeric',
            'total' =>'required|numeric',
        ]);
        if ($validator->fails()) {
            $res = [
                'success' => false,
                'message' => __($validator->messages()->first())
            ];
            return response()->json($res);
        }

        
        // Begin Transaction
        \DB::beginTransaction();
        try{
            
            $order=new Order();
            $order->user_id= \Auth::user()->id;
            $order->quantity= $data['quantity'];
            $order->sub_total= $data['sub_total'];
            $order->service_fee= $data['service_fee'];
            $order->delivery_fee= $data['delivery_fee'];
            $order->discount= $data['discount'];
            $order->promo_id= (isset($data['promo_id'])) ? $data['promo_id']:'0';
            $order->total= $data['total'];
            $order->order_status= 1;
            $order->save();

        	 
		     foreach($data['products'] as $product){
		     	$order_product = new OrderProduct();
		         $order_product->fill(array_merge($product, ['order_id'=>$order->id]))->save();
		         \DB::commit();

		     }

            
            $res = ['success' => true, 'message' => 'Order added successfully'];
        }catch (\Exception $e) {
                // Rollback Transaction
            \DB::rollback();
            $res = ['success' => false, 'message' => $e->getMessage()];
        }

        return response()->json($res);



    }
}
