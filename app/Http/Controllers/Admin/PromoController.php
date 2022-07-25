<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Promos;
use Illuminate\Support\Str;

class PromoController extends Controller
{
    function index() {
        $promos = Promos::orderBy('id', 'DESC')->get();
        //dd($promos);
        return view('admin.promo.list', compact(['promos']));
    } 

    function add() {
        $promos=Promos::all();
        return view('admin.promo.add',compact('promos'));
    }

    function save(Request $request) { 

        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'discount' => 'required',
            // 'is_active' => 'required',
        ]);

        $data = $request->all();

        $promo = new Promos();
        $promo->name= $data['name'];
        $promo->description = $data['description'];
        $promo->discount = $data['discount'];
        $promo->promo_code =  Str::random($length = 6);
        
        if($promo->save()) {
            return redirect()->route('promos')->with(['status' => 'success', 'message' => 'promo Saved Successfully']);
        }   else {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Something went wrong.'])->withInput();
        }
    }
       
    function edit($id = null) {
        if($id == null) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Invalid promo id']);
        }
        $promo = Promos::where('id', $id)->first();
        if(!$promo) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Invalid promo id']);
        }
      
        return view('admin.promo.edit', compact(['promo']));
    }

    function update($id = null, Request $request){
    	if($id == null) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Please select a promo.']);
        }
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
        
        $data = $request->all();
        $promo = Promos::find($id);
        if(!$promo) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Invalid Promo id']);
        }       
 
        $promo->name= $data['name'];
        $promo->description = $data['description'];
        $promo->discount = $data['discount'];
        // $promo->promo_code =  Str::random($length = 6);
        if($promo->save()) {
            return redirect()->route('promos')->with(['status' => 'success', 'message' => 'Promo updated successfully']);
        }   else {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Something went wrong.'])->withInput();
        }
    	
    }

    function delete($id = null) {
        if($id == null) {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Please select a item.']);
        }
        
        if(Promos::where('id', $id)->delete()) {
            return redirect()->back()->with(['status' => 'success', 'message' => 'Promo deleted successfully']);
        }   else {
            return redirect()->back()->with(['status' => 'danger', 'message' => 'Something went wrong.']);
        }
    }
   
}
