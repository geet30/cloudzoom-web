<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use App\Models\FavouriteItem;
use Exception;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
	/**
	 * Add user favourite items
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
   public function addFavouriteItem(Request $request)
   {
    	$data=$request->all();
    	$validator = Validator::make($data, [
            'favourite' => 'required',
            'item_id' => 'required'
        ]);
        if ($validator->fails()) {
            $res = [
                'success' => false,
                'message' => __($validator->messages()->first())
            ];
            return response()->json($res);
        }

    	$data['user_id']= \Auth::user()->id;

   
    		if($data['favourite']==1)
    		{
    			//add 
    			$item=Item::find($data['item_id']);
    			if($item)
    			{
    				$favourite_item = FavouriteItem::where(['Item_id'=>$data['item_id'],'user_id'=>\Auth::user()->id])->first();
    				if(!$favourite_item){
    					  unset($data['favourite']);
    					  $favourite=FavouriteItem::create($data);
    				    $res = ['success' => true, 'message' =>'Item added to your favourite','is_favourite'=>1];
    				}else{
    					  $res = ['success' => false, 'message' =>'Item already in your favourite','is_favourite'=>1];
    				}
    			}else{
    				$res = ['success' => false, 'message' =>'Invalid Item id'];
    			}
    			

    		}else{
      				//delete 
      				$favourite_item = FavouriteItem::where(['Item_id'=>$data['item_id'],'user_id'=>\Auth::user()->id])->first();
      				if($favourite_item)
      				{
      					$favourite_item->delete();
      		    		$res = ['success' => true, 'message' =>'Item removed from your favourite','is_favourite'=>0];
      				}else{
      						$res = ['success' => false, 'message' =>'Item not in your favourite','is_favourite'=>0];
      					}
		      }
    		
    	return response()->json($res);

    

   }

   /**
	 * get user favourite items
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */

    public function getFavouriteItem(Request $request)
    {
    	$data=$request->all();
    	$user_id=\Auth::user()->id;
	      if(!$user_id){
	        $res = ['success' => false, 'message' =>'Invalid user'];
	        return response()->json($res);
	      }
        
      $limit=(isset($data['limit']))?$data['limit']:0;

      $favourite_items = FavouriteItem::with('item')->where('user_id',$user_id)->paginate($limit)->toArray();

	     if($favourite_items['data']){
	      	 $res = ['success' => true, 'message' =>'Items list','current_page'=>$favourite_items['current_page'],'last_page'=>$favourite_items['last_page'],'total_results'=>$favourite_items['total'],'data'=>$favourite_items['data']];
          
	      }else{
	      		$res = ['success' => false, 'message' =>'No items found ','current_page'=>$favourite_items['current_page'],'last_page'=>$favourite_items['last_page'],'total_results'=>$favourite_items['total'],'data'=>$favourite_items['data']];
	      	}
    	
         return response()->json($res);

    }

    public function Search(Request $request)
    {
        $data=$request->all();
        $validator = Validator::make($data, [
            'search' => 'required'
        ]);
        if ($validator->fails()) {
            $res = [
                'success' => false,
                'message' => __($validator->messages()->first())
            ];
            return response()->json($res);
        }

        $limit=(isset($data['limit']))?$data['limit']:0;

        $items = Item::where('item_name', 'LIKE', '%'.$data['search'].'%')->paginate($limit)->toArray();

        if($items['data']){
               $res = ['success' => true, 'message' =>'Items list','current_page'=>$items['current_page'],'last_page'=>$items['last_page'],'total_results'=>$items['total'],'data'=>$items['data']];
        } else {
            $res = ['success' => false, 'message' => __('No Items found')];
        }

        return response()->json($res);
    }



}
