<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['register' => true]);
// Auth::routes();
Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout');
Route::group(['middleware' => ['auth'] ], function() {
    Route::get('/', 'App\Http\Controllers\Admin\DashboardController@dashboard')->name('dashboard');
   
    Route::group(['prefix'=>'customers'], function() {
        Route::get('/', 'App\Http\Controllers\Admin\CustomerController@index')->name('customers');
        
        Route::get('/delete/{id}', 'App\Http\Controllers\Admin\CustomerController@delete')->name('deleteCustomer');
        Route::get('/block/{id}', 'App\Http\Controllers\Admin\CustomerController@block')->name('blockCustomer');
    });

    Route::group(['prefix'=>'drivers'], function() {
        Route::get('/approved', 'App\Http\Controllers\Admin\DriverController@approvedDrivers')->name('approvedDrivers');
        Route::get('/unapproved', 'App\Http\Controllers\Admin\DriverController@unapprovedDrivers')->name('unapprovedDrivers');
        Route::get('/rejected', 'App\Http\Controllers\Admin\DriverController@rejectedDrivers')->name('rejectedDrivers');
        Route::get('/add', 'App\Http\Controllers\Admin\DriverController@add')->name('addDriver');
        Route::post('/save', 'App\Http\Controllers\Admin\DriverController@save')->name('saveDriver');
        Route::get('/view/{id}', 'App\Http\Controllers\Admin\DriverController@viewProfile')->name('viewProfile');
        Route::get('/edit/{id}', 'App\Http\Controllers\Admin\DriverController@edit')->name('editDriver');
        Route::post('/update/{id}', 'App\Http\Controllers\Admin\DriverController@update')->name('updateDriver');
        Route::get('/delete/{id}', 'App\Http\Controllers\Admin\DriverController@delete')->name('deleteDriver');
        Route::get('/approve/{id}', 'App\Http\Controllers\Admin\DriverController@approve')->name('approveDriver');
        Route::get('/reject/{id}', 'App\Http\Controllers\Admin\DriverController@reject')->name('rejectDriver');
        Route::get('/block/{id}', 'App\Http\Controllers\Admin\DriverController@block')->name('blockDriver');
        
       
    });

    Route::group(['prefix'=>'categories'], function() {
        Route::get('/', 'App\Http\Controllers\Admin\CategoryController@index')->name('categories');
        
        Route::get('/add', 'App\Http\Controllers\Admin\CategoryController@add')->name('addCategory');
        Route::post('/save', 'App\Http\Controllers\Admin\CategoryController@save')->name('saveCategory');
    
        Route::get('/edit/{id}', 'App\Http\Controllers\Admin\CategoryController@edit')->name('editCategory');
        Route::post('/update/{id}', 'App\Http\Controllers\Admin\CategoryController@update')->name('updateCategory');
        Route::get('/delete/{id}', 'App\Http\Controllers\Admin\CategoryController@delete')->name('deleteCategory');

         Route::get('/publish/{id}', 'App\Http\Controllers\Admin\CategoryController@publish')->name('publishCategory');
       
    });

    Route::group(['prefix'=>'items'], function() {
        Route::get('/', 'App\Http\Controllers\Admin\ItemController@index')->name('items');
        
        Route::get('/add', 'App\Http\Controllers\Admin\ItemController@add')->name('addItem');
        Route::post('/save', 'App\Http\Controllers\Admin\ItemController@save')->name('saveItem');
    
        Route::get('/edit/{id}', 'App\Http\Controllers\Admin\ItemController@edit')->name('editItem');
        Route::post('/update/{id}', 'App\Http\Controllers\Admin\ItemController@update')->name('updateItem');
        Route::get('/delete/{id}', 'App\Http\Controllers\Admin\ItemController@delete')->name('deleteItem');
        Route::get('/publish/{id}', 'App\Http\Controllers\Admin\ItemController@publish')->name('publishItem');
        Route::get('/feature/{id}', 'App\Http\Controllers\Admin\ItemController@feature')->name('featureItem');
       
    });
    Route::group(['prefix'=>'promo'], function() {
        Route::get('/', 'App\Http\Controllers\Admin\PromoController@index')->name('promos');
        
        Route::get('/add', 'App\Http\Controllers\Admin\PromoController@add')->name('addPromo');
        Route::post('/save', 'App\Http\Controllers\Admin\PromoController@save')->name('savePromo');
    
        Route::get('/edit/{id}', 'App\Http\Controllers\Admin\PromoController@edit')->name('editPromo');
        Route::post('/update/{id}', 'App\Http\Controllers\Admin\PromoController@update')->name('updatePromo');
        Route::get('/delete/{id}', 'App\Http\Controllers\Admin\PromoController@delete')->name('deletePromo');
     });
     Route::group(['prefix'=>'order'], function() {
        Route::get('/', 'App\Http\Controllers\Admin\OrderController@index')->name('orders'); 
        
        Route::get('/view/{id}', 'App\Http\Controllers\Admin\OrderController@viewOrder')->name('viewOrder');
        Route::get('/delete/{id}', 'App\Http\Controllers\Admin\OrderController@delete')->name('deleteOrder');
     });
});
