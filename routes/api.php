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

Route::post('/login', 'APIController\UserController@login');
Route::post('/register', 'APIController\UserController@register');


Route::middleware(['jwt'])->group(function (){
    Route::middleware(['jwt.auth'])->group(function (){


        //user
        Route::get('/userProfile', 'APIController\UserController@userProfile');
        Route::post('/updateUser', 'APIController\UserController@updateUser');
        Route::delete('/destroy', 'APIController\UserController@destroy');
        Route::get('/logout', 'APIController\UserController@logout');
    });

});
