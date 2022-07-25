<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Item;
use App\Models\Promos;
use App\Models\Order;

class DashboardController extends Controller
{
    function dashboard() { 
        $approved_drivers = User::where(['user_type' => 2,'is_approved'=>1])->count();
        $disapproved_drivers = User::where(['user_type' => 2,'is_approved'=>0])->count();
        $rejected_drivers = User::where(['user_type' => 2,'is_approved'=>2])->count();
        $customers = User::where(['user_type' => 1])->count();
        $categories = Category::all()->count();
        $items = Item::all()->count();
        $promos = Promos::all()->count();
        $orders = Order::all()->count();

        return view('admin/dashboard', compact(['approved_drivers', 'disapproved_drivers','rejected_drivers','customers','categories','items','promos','orders']));
    }
}
