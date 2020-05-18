<?php

use Illuminate\Http\Request;

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

Route::post('/login', 'API\UserController@login');
Route::post('/register', 'API\UserController@register');
Route::post('/addImage/{item_id}', 'API\ItemController@addImage');


Route::middleware(['jwt'])->group(function (){
    Route::middleware(['jwt.auth'])->group(function (){


        //user
        Route::get('/userProfile', 'API\UserController@userProfile');
        Route::post('/updateUser', 'API\UserController@updateUser');
        Route::delete('/destroy', 'API\UserController@destroy');
        Route::get('/logout', 'API\UserController@logout');
        Route::post('/updateImage', 'API\UserController@updateImage');

        //shop
        Route::get('/getAllShop', 'API\ShopController@getAllShop');
        Route::get('/getShopById/{shop_id}', 'API\ShopController@getShopById');

        //Item
        Route::get('/getAllItem/{shop_id}', 'API\ItemController@getAllItem');
        Route::get('/getItemById/{item_id}', 'API\ItemController@getItemById');

        // //cart
        // Route::post('/addToCart', 'API\CartItemController@addToCart');
        // Route::get('/getAllCartItems/{shop_id}', 'API\CartItemController@getAllCartItems');
        // Route::get('/getCartItemById/{id}', 'API\CartItemController@getCartItemById');
        // Route::delete('/removeItem/{id}', 'API\CartItemController@removeItem');

        //order
        Route::post('/addToOrder', 'API\OrderController@addToOrder');
        Route::get('/getAllOrders/{shop_id}', 'API\OrderController@getAllOrders');
        Route::get('/getOrderById/{id}', 'API\OrderController@getOrderById');
        Route::delete('/cancelOrder/{id}', 'API\OrderController@cancelOrder');

        //quantityType  
        Route::get('/getQuantityType/{id}', 'API\QuantityTypeController@getQuantityType');

    });

});
