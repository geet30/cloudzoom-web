<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
class UserController extends Controller
{
    protected $jwtAuth;
    function __construct( JWTAuth $jwtAuth ) {
        $this->jwtAuth = $jwtAuth;
        //$this->middleware('auth:api', ['except' => ['updateUserType']]);
    }

    /**
     * Set user as customer or driver
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUserType(Request $request)
    {
    	$data = $request->all();
         $validator = Validator::make($data, [
            'user_type' => 'required|in:1,2'
        ]);

        if ($validator->fails()) {
            $res = [
                'success' => false,
                'message' => $validator->messages()->first()
            ];
            return response()->json($res);
        }

        
        $user=User::find(\Auth::user()->id);
        if($user){
        	if($user['user_type']==$data['user_type']){
                //check the user type
                $user=($user->user_type==2)?"driver":"customer";
                $res = ['success' => false, 'message' =>"User already a  $user"];
		    }else{
                //only update if user type 3
                if($user->user_type==3)
                { 
                    $user_type=($data['user_type']==2)?"driver":"customer";
                    $user->user_type = $data['user_type'];
                    if($user->fill($data)->save()) {
                        $res = ['success' => true, 'message' => "User  selected  as $user_type successfully",'user_type'=>$data['user_type']];
                    }   else {
                        $res = ['success' => false, 'message' => 'Something went wrong, Please try again.'];
                    }

                }else{
                        $res = ['success' => false, 'message' => 'Permission denied'];
                }
		    }
        }else{
        	 $res = ['success' => false, 'message' => 'Invalid user'];

        }

        return response()->json($res);
       
        
        
    }

   
}
