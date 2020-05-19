<?php

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


// Authentication Routes...
Route::get('', 'Backend\Auth\LoginController@showLoginForm')->name('backend.login');
Route::post('', 'Backend\Auth\LoginController@login')->name('backend.login.submit');
Route::post('logout', 'Backend\Auth\LoginController@logout')->name('backend.logout');


Route::group(['middleware' => 'auth'], function () {

    //home
    Route::get('/home', 'Backend\HomeController@home')->name('backend.home');

    //shops
    Route::resource('shops', 'Backend\ShopController', ['as' => 'backend']);

    //categories
    Route::resource('categories', 'Backend\CategoryController', ['as' => 'backend']);

    //items
    Route::resource('items', 'Backend\ItemController', ['as' => 'backend']);
    Route::post('/itemSearch', 'Backend\ItemController@itemSearch')->name('backend.itemSearch');

    Route::resource('quantityTypes', 'Backend\QuantityTypeController', ['as' => 'backend']);



    //order
    Route::resource('orders', 'Backend\OrderController', ['as' => 'backend']);
    Route::post('/changeOrderStatus/{id}', 'Backend\OrderController@changeOrderStatus')->name('backend.changeOrderStatus');
    Route::post('/changeStatus/{id}', 'Backend\OrderController@changeStatus')->name('backend.changeStatus');
    Route::post('/removeItem/{id}', 'Backend\OrderController@removeItem')->name('backend.removeItem');
    Route::get('/getTodayOreder', 'Backend\OrderController@getTodayOreder')->name('backend.getTodayOreder');
    Route::post('/orderSearch', 'Backend\OrderController@orderSearch')->name('backend.orderSearch');


    //users
    Route::resource('users', 'Backend\UserController', ['except' => ['show'], 'as' => 'backend']);
	Route::get('profile', ['as' => 'backend.profile.edit', 'uses' => 'Backend\ProfileController@edit']);
	Route::put('profile', ['as' => 'backend.profile.update', 'uses' => 'Backend\ProfileController@update']);
	Route::put('profile/password', ['as' => 'backend.profile.password', 'uses' => 'Backend\ProfileController@password']);
    Route::get('/getcustomers', 'Backend\UserController@getcustomers')->name('backend.getcustomers');

});

