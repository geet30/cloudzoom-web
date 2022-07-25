<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\Models\User;
use App\Models\DeviceToken;
use Illuminate\Support\Facades\Validator;
use App\Mail\ResetPasswordMail;
use Mail;
class RegisterController extends Controller
{
    protected $jwtAuth;
    function __construct( JWTAuth $jwtAuth ) {
        $this->jwtAuth = $jwtAuth;
        $this->middleware('auth:api', ['except' => ['Register']]);
        //
    }

    /**
     * User registration
     *
     * 
     */

    function Register(Request $request) {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users,email,{$id},id,deleted_at,NULL',
            'password' => 'required',
            'device_token' => 'required',
            'device_type' => 'required|in:1,2'
        ]);

        if ($validator->fails()) {
            $res = [
                'success' => false,
                'message' => $validator->messages()->first()
            ];
            return response()->json($res);
        }

        $data = $request->all();
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return response()->json(['success' => false, 'message' => "Email is Invalid"]);
        }

         \DB::beginTransaction();
        try 
        {
            $user = new User();
            $user->name = $data['fullname'];
            $user->username = $data['username'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->user_type = 3;
            $result = $user->save();

            $device=new DeviceToken();
            $device->user_id=$user->id;
            $device->device_type=$data['device_type'];
            $device->device_token=$data['device_token'];
            $device->save();
            \DB::commit();


            if($result) {
                $token = $this->jwtAuth->fromUser($user);
                $user_info=User::where('id',$user->id)->first();
                $res = ['success' => true, 'message' => 'Registerd successfully', 'token' => $token,'user'=>$user_info];

            }   else {
                $res = ['success' => false, 'message' => 'Something went wrong, please try again.'];
            }

        } catch (\Exception $e) {
            // Rollback Transaction
            \DB::rollback();
            $res = ['success' => true, 'message' => $e->getMessage()];
        }   
        return response()->json($res);
    }

}
