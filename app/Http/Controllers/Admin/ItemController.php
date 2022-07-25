<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderProduct;
class ItemController extends Controller
{
    function index() {
        $items = Item::with('category')->orderBy('id', 'DESC')->get();
        //dd($items);
        return view('admin.item.list', compact(['items']));
    } 

    function add() {
        $categories=Category::all();
        //dd($categories);
        return view('admin.item.add',compact('categories'));
    }

    function save(Request $request) { 

        $validatedData = $request->validate([
            'item_name' => 'required',
            'item_weight' => 'required',
            'category_image' => 'required',
            'category' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('category_image')) {
            
            $extension = $request->file('category_image')->getClientOriginalExtension();
            // echo $extension; exit;
            if(!in_array($extension, ['png', 'jpg', 'jpeg'])) {
                return redirect()->back()->with('error',  'Only Images allowed')->withInput();
            }
        }
        
        if ($request->hasFile('category_image')) {
        
            $file = $request->file('category_image');
            $name = time() . '-item_image.' . $file->getClientOriginalExtension();
            $path = public_path('/uploads/items');
            if(!is_dir($path)){
                mkdir($path,0755,true);
            }
            $file_r = $file->move($path, $name);
        }else{
                $name=null;
        }


        $item = new Item();
        $item->item_name= $data['item_name'];
        $item->item_weight= $data['item_weight'];
        $item->item_image = $name;
        $item->description = $data['description'];
        $item->price = $data['price'];
        $item->category_id = $data['category'];
        
        if($item->save()) {
            return redirect()->route('items')->with(['status' => 'success', 'message' => 'Item saved successfully']);
        }else {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Something went wrong.'])->withInput();
        }
    }
       
    
    

    function edit($id = null) {
        if($id == null) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Invalid item id']);
        }
        $item = Item::with('category')->where('id', $id)->first();
        if(!$item) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Invalid item id']);
        }
        $categories=Category::all();
        return view('admin.item.edit', compact(['item','categories']));
    }

    function update($id = null, Request $request){
    	if($id == null) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Please select a item.']);
        }
        $validatedData = $request->validate([
            'item_name' => 'required',
            'item_weight' =>'required'
            //'category_image' => 'required',
        ]);
        
        $data = $request->all();
        $item = Item::find($id);
        if(!$item) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Invalid item id']);
        }

        if ($request->hasFile('category_image')) {
            $extension = $request->file('category_image')->getClientOriginalExtension();
            // echo $extension; exit;
            if(!in_array($extension, ['png', 'jpg', 'jpeg'])) {
                return redirect()->back()->with(['status' => 'danger', 'message' => 'Only jpg,png Images allowed'])->withInput();
            }
            $file = $request->file('category_image');
            $name = time() . '-item_image.' . $file->getClientOriginalExtension();
            $path = public_path('/uploads/items');
            if(!is_dir($path))
            {
                mkdir($path,0755,true);
            }
            $file_r = $file->move($path, $name);
            //unlink old image
            $usersImage = public_path("uploads/items/{$item['item_image']}");

            if (\File::exists($usersImage)) { // unlink or remove previous image from folder
                unlink($usersImage);
            }
            $item->item_image = $name;

        }
        
        $item->item_name = $data['item_name'];
        $item->item_weight= $data['item_weight'];
        
        $item->description = $data['description'];
        $item->category_id = $data['category'];
        $item->price = $data['price'];

        if($item->save()) {
            return redirect()->route('items')->with(['status' => 'success', 'message' => 'Item updated successfully']);
        }   else {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Something went wrong.'])->withInput();
        }
    	
    }

    function delete($id = null) {
        if($id == null) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Please select a item.']);
        }
        $if_placed_ordered = Order::join('order_products','order_products.order_id','=','orders.id')
        ->where([
            ['order_products.product_id','=',$id],
            ['orders.order_status',1]
         ])
        ->get()
        ->toArray();

        if(isset($if_placed_ordered) && count($if_placed_ordered) > 0){
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Item cannot be deleted,some orders are in progress']);
        } 
        if(Item::where('id', $id)->delete()) {
            return redirect()->back()->with(['status' => 'success', 'message' => 'Item deleted successfully']);
        }   else {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Something went wrong.']);
        }
    }
    function publish($id = null) {
        if($id == null) {
             return redirect()->back()->with(['status' => 'danger', 'message' => 'Please select a item.']);
         }
         
         $item = Item::find($id);
         if(!$item) {
             return redirect()->back()->with(['status' => 'danger', 'message' => 'Invalid item id']);
         }
         $publish=($item['is_publish']==0)?1:0;
         
         $item->is_publish = $publish; 
         $message=($publish==0)?"Item deactivated successfully":"Item activated successfully";
         if($item->save()) {
             
             return redirect()->route('items')->with(['status' => 'success', 'message' => $message]);
             
         }   else {
             return redirect()->back()->with(['status' => 'danger', 'message' => 'Something went wrong.']);
         }
     }
    function feature($id = null) {
       if($id == null) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Please select a item.']);
        }
        
        $item = Item::find($id);
        if(!$item) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Invalid item id']);
        }
        $feature=($item['is_featured']==0)?1:0;
        
        $item->is_featured = $feature; 
        $message=($feature==1)?"Item set as featured successfully":"Item set as unfeatured successfully";
        if($item->save()) {
            
        	return redirect()->route('items')->with(['status' => 'success', 'message' => $message]);
            
        }   else {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Something went wrong.']);
        }
    }





    

    
}
