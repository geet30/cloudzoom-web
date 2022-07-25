<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Location;
class LocationController extends Controller
{
    protected $jwtAuth;
    function __construct( JWTAuth $jwtAuth ) {
        $this->jwtAuth = $jwtAuth;
       
    }

    /**
     * get location
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
    	
        $locations=Location::select('id','location_name','location_image')->get();
        if(count($locations)>0)
        {
            $res = ['success' => true, 'message' => 'Location list','locations'=>$locations];
        }else{
            $res = ['success' => false, 'message' => 'Location list','locations'=>$locations];
        }

        return response()->json($res);
        
    }

     /**
     * update the user location lat long
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUserLocation(Request $request)
    {
        $data=$request->all();

         $validator = Validator::make($data, [
            'latitude' => 'required',
            'longitude' =>'required',
            'location' => 'sometimes|numeric'
        ]);
        if ($validator->fails()) {
            $res = [
                'success' => false,
                'message' => __($validator->messages()->first())
            ];
            return response()->json($res);
        }

        $user=User::find(\Auth::id());
        if($user){

            if(isset($data['location'])){
                $location=Location::find($data['location']);
                if($location){
                    $user->location=($data['location'])??$user['location'];
                 }else{
                    $res = ['success' => false, 'message' => 'Invalid location'];
                     return response()->json($res);
                 }
            }
            $user->latitude=($data['latitude'])??$user['latitude'];
            $user->longitude=($data['longitude'])??$user['longitude'];
            if($user->save()){
                $res = ['success' => true, 'message' => 'Location updated successfully','user'=>$user];
            }


        }else{
            $res = ['success' => false, 'message' => 'Invalid user'];

        }
        return response()->json($res);
       
        
        
    }

    

   
}
