<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([ 'middleware' => ['api'],'prefix' => 'auth'], function ($router) {


    Route::post('register', 'App\Http\Controllers\Api\RegisterController@Register');
    Route::post('login', 'App\Http\Controllers\Api\AuthController@login');
    Route::post('me', 'App\Http\Controllers\Api\AuthController@me');
    Route::post('forgot_password', 'App\Http\Controllers\Api\ForgotPasswordController@forgot_password');
    Route::post('update_password', 'App\Http\Controllers\Api\ForgotPasswordController@update_password');

});



Route::group([ 'middleware' => ['api','jwt.verify'] ], function ($router) {
    Route::post('logout', 'App\Http\Controllers\Api\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\Api\AuthController@refresh');

    Route::post('update_user_type', 'App\Http\Controllers\Api\UserController@updateUserType');

     
    Route::group(['prefix' => 'category'], function ($router) {
       Route::post('get_categories', 'App\Http\Controllers\Api\CategoryController@index');
       Route::post('get_categories_items', 'App\Http\Controllers\Api\CategoryController@getCategoryItems');
    });


    Route::group(['prefix' => 'location'], function ($router) {
     	Route::get('get_locations', 'App\Http\Controllers\Api\LocationController@index');
     	Route::post('update_user_location', 'App\Http\Controllers\Api\LocationController@updateUserLocation');
    });

    Route::group(['prefix' => 'item'], function ($router) {
     	Route::post('favourite_item', 'App\Http\Controllers\Api\ItemController@addFavouriteItem');
     	Route::post('get_favourite_items', 'App\Http\Controllers\Api\ItemController@getFavouriteItem');
     	Route::post('search', 'App\Http\Controllers\Api\ItemController@Search');
    });

    Route::group(['prefix' => 'order'], function ($router) {
     	Route::post('add_order', 'App\Http\Controllers\Api\OrderController@addOrder');
     	Route::post('my_orders', 'App\Http\Controllers\Api\OrderController@index');
    });

    Route::group(['prefix' => 'address'], function ($router) {
    	Route::post('my_addresses', 'App\Http\Controllers\Api\AddressController@index');
     	Route::post('add_address', 'App\Http\Controllers\Api\AddressController@addAddress');
     	Route::post('edit_address', 'App\Http\Controllers\Api\AddressController@edit');
     	Route::post('delete_address', 'App\Http\Controllers\Api\AddressController@delete');
     	
    });
   

  });



