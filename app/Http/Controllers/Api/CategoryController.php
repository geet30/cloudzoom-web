<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

	 protected $jwtAuth;
    function __construct( JWTAuth $jwtAuth ) {
        $this->jwtAuth = $jwtAuth;
    }

    /**
     * Get categories
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

    	$categories=Category::where('is_publish',1)->orderBy('id', 'DESC')->paginate($limit)->toArray();
    	//dd($categories);

    	if(count($categories)>0)
    	{
    		$res = ['success' => true, 'message' => 'Categories list','current_page'=>$categories['current_page'],'last_page'=>$categories['last_page'],'total_results'=>$categories['total'],'data'=>$categories['data']];
    	}else{
    		$res = ['success' => false, 'message' => 'No categories found','data'=>$categories];
    	}

    	return response()->json($res);
    	
    }
    public function getCategoryItems(Request $request)
    {
    	$data=$request->all();
    	 $validator = Validator::make($data, [
            'limit' => 'numeric | nullable',
            'page' => 'numeric | nullable',
            'category_id' => 'numeric | required',
        ]);

       if ($validator->fails()) {
            $res = [
                'success' => false,
                'message' => __($validator->messages()->first())
            ];
            return response()->json($res);
        }

        $limit = $request->limit ? $request->limit : 10;


        $items=Item::where('category_id',$data['category_id'])->paginate($limit)->toArray();

        $featured_items=Item::where(['category_id'=>$data['category_id'],'is_featured'=>1])->paginate($limit)->toArray();

        //dd($items);
        if($items['data'])
        {

   		   $itemdata=[
                      'all_items'=>$items['data'],
                      'featured_items' =>$featured_items['data']
                    ];

           $res = ['success' => true, 'message' =>'Items list','current_page'=>$items['current_page'],'last_page'=>$items['last_page'],'total_results'=>$items['total'],'items'=>$itemdata];

        }else{
   
        	 $res = ['success' => false, 'message' =>'No items found ','current_page'=>$items['current_page'],'last_page'=>$items['last_page'],'total_results'=>$items['total'],'items'=> new \stdClass()];
        }

      
        return response()->json($res);
        
        
        
    }

    
}
