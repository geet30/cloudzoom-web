<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Address;
use Exception;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
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

        $addresses = Address::where(['user_id'=>\Auth::user()->id])->orderBy('created_at', 'Desc')->paginate($limit)->toArray();

        if($addresses['data']){
            $res = ['success' => true, 'message' =>'Addresses list','current_page'=>$addresses['current_page'],'last_page'=>$addresses['last_page'],'total_results'=>$addresses['total'],'data'=>$addresses['data']];
        }else{
        	 $res = ['success' => false, 'message' =>'No addresses found','current_page'=>$addresses['current_page'],'last_page'=>$addresses['last_page'],'total_results'=>$addresses['total'],'data'=>$addresses['data']];
        }

         return response()->json($res);
          
    	
    }

    public function addAddress(Request $request)
    {
    	$data=$request->all();

         $validator = Validator::make($data, [
            'name' => 'required|string',
            'pin_code' => 'required|numeric',
            'address' =>'required',
            'street_address' =>'required',
            'city' =>'required',
        ]);
        if ($validator->fails()) {
            $res = [
                'success' => false,
                'message' => __($validator->messages()->first())
            ];
            return response()->json($res);
        }

        $data['user_id']=\Auth::id();
        $address = new Address();
        if($address->fill($data)->save()) {
            $res = ['success' => true, 'message' => 'Address added successfully'];
        }else {
            $res = ['success' => false, 'message' =>'Something went wrong'];
        }

        return response()->json($res);



    }

     public function edit(Request $request)
    {
        $data=$request->all();

         $validator = Validator::make($data, [
            'address_id' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            $res = [
                'success' => false,
                'message' => __($validator->messages()->first())
            ];
            return response()->json($res);
        }

        $address =  Address::where(['user_id'=>\Auth::id(),'id'=>$data['address_id']])->first();
        if($address)
        {
            if($address->fill($data)->save()) {
                $res = ['success' => true, 'message' => 'Address updated successfully'];
            }else {
                $res = ['success' => false, 'message' =>'Something went wrong'];
            }

        }else{
            $res = ['success' => false, 'message' =>'No address found'];
        }

        return response()->json($res);

    }
     public function delete(Request $request)
    {
        $data=$request->all();
        $validator = Validator::make($data, [
            'address_id' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            $res = [
                'success' => false,
                'message' => __($validator->messages()->first())
            ];
            return response()->json($res);
        }
        $address =  Address::where(['user_id'=>\Auth::id(),'id'=>$data['address_id']])->first();
        if($address)
        {
            if($address->delete()) {
                $res = ['success' => true, 'message' => 'Address deleted successfully'];
            }else {
                $res = ['success' => false, 'message' =>'Something went wrong'];
            }
        }else{
            $res = ['success' => false, 'message' =>'No address found'];
        }    

        return response()->json($res);

    }
}
