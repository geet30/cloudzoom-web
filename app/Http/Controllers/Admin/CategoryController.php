<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Item;
class CategoryController extends Controller
{
    function index() {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('admin.category.list', compact(['categories']));
    } 

    function add() {
        return view('admin.category.add');
    }

    function save(Request $request) { 

        $validatedData = $request->validate([
            'category_name' => 'required',
            'category_image' => 'required',
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
            $name = time() . '-category-image.' . $file->getClientOriginalExtension();
            $path = public_path('/uploads/categories');
            if(!is_dir($path)) {
                mkdir($path,0755,true);
            }
            $file_r = $file->move($path, $name);
        }else{
            $name=null;
        }


        $category = new Category();
        $category->category_name = $data['category_name'];
        $category->category_image = $name;
        if($category->save()) {
            return redirect()->route('categories')->with(['status' => 'success', 'message' => 'Category saved successfully']);
        }   else {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Something went wrong.'])->withInput();
        }
    }
       
    
    

    function edit($id = null) {
        if($id == null) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Invalid category id']);
        }
        $category = Category::where('id', $id)->first();
        if(!$category) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Invalid category id']);
        }
        return view('admin.category.edit', compact(['category']));
    }

    function update($id = null, Request $request){
    	if($id == null) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Please select a category.']);
        }
        $validatedData = $request->validate([
            'category_name' => 'required',
            //'category_image' => 'required',
        ]);
        
        $data = $request->all();
        $category = Category::find($id);
        if(!$category) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Invalid category id']);
        }
        $category->category_name = $data['category_name'];
        if ($request->hasFile('category_image')) {
            $extension = $request->file('category_image')->getClientOriginalExtension();
            // echo $extension; exit;
            if(!in_array($extension, ['png', 'jpg', 'jpeg'])) {
                return redirect()->back()->with(['status' => 'danger', 'message' => 'Only jpg,png Images allowed'])->withInput();
            }
           
            $file = $request->file('category_image');
            $name = time() . '-category-image.' . $file->getClientOriginalExtension();
            $path = public_path('/uploads/categories');
            if(!is_dir($path)){
                mkdir($path,0755,true);
            }
            $file_r = $file->move($path, $name);
            //unlink old image
            $usersImage = public_path("uploads/categories/{$category['category_image']}");
            if (\File::exists($usersImage)) { // unlink or remove previous image from folder
                unlink($usersImage);
            }
            $category->category_image = $name;

        }
        if($category->save()) {
            return redirect()->route('categories')->with(['status' => 'success', 'message' => 'Category updated successfully']);
        }else {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Something went wrong.'])->withInput();
        }
    	
    }

    function delete($id = null) {
        if($id == null) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Please select a category.']);
        }
        // check if item exist and are published or not//
        // $get_items = Category::whereHas('items', function($q) {
        //     $q->where('is_publish', '1'); 
        // })->where('id', $id)->get();
        // $items = Item::with('category')->orderBy('id', 'DESC')->get();
        // $items =  Item::with(['category' => function($q) use($id) {
        //     $q->where('id', $id); 
        // }])
        // ->where('is_publish', 1)->get();
        $get_items = Category::with(['items' => function($q) {
                $q->where('is_publish', '1'); 
        }])
        ->where('id', $id)->first();
        
        if ($get_items->items->count()){ 
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Category cannot be deleted it contains active items']);

        }
        $if_placed_ordered = Order::join('order_products','order_products.order_id','=','orders.id')
        ->where([
            ['order_products.category_id','=',$id],
            ['orders.order_status',1]
         ])
        ->get()
        ->toArray();
        if(isset($if_placed_ordered) && count($if_placed_ordered) > 0){
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Category cannot be deleted,some orders are in progress']);
        }
        if(Category::where('id', $id)->delete()) {
            return redirect()->back()->with(['status' => 'success', 'message' => 'Category deleted successfully']);
        }   else {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Something went wrong.']);
        }
    }

    function publish($id = null) {
       if($id == null) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Please select a driver.']);
        }
        
        $category = Category::find($id);
        if(!$category) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Invalid category id']);
        }
        $publish=($category['is_publish']==0)?1:0;
        
        $category->is_publish = $publish; 
        $message=($publish==0)?"Category deactivated successfully":"Category activated successfully";
        if($category->save()) {
            
        	return redirect()->route('categories')->with(['status' => 'success', 'message' => $message]);
            
        }   else {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Something went wrong.']);
        }
    }
  
}
