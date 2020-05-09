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
Route::get('/', 'Backend\HomeController@welcome')->name('backend.welcome');

// Authentication Routes...
Route::get('login', 'Backend\Auth\LoginController@showLoginForm')->name('backend.login');
Route::post('login', 'Backend\Auth\LoginController@login')->name('backend.login.submit');
Route::post('logout', 'Backend\Auth\LoginController@logout')->name('backend.logout');

// Password Reset Routes...
//Route::get('password/reset', 'Backend\Auth\ForgotPasswordController@showLinkRequestForm')->name('backend.password.request');
//Route::post('password/email', 'Backend\Auth\ForgotPasswordController@sendResetLinkEmail')->name('backend.password.email');
//Route::get('password/reset/{token}', 'Backend\Auth\ResetPasswordController@showResetForm')->name('backend.password.reset');
//Route::post('password/reset', 'Backend\Auth\ResetPasswordController@reset')->name('backend.password.update');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'Backend\HomeController@home')->name('backend.home');
    Route::resource('shops', 'Backend\ShopController', ['as' => 'backend']);
    Route::resource('categories', 'Backend\CategoryController', ['as' => 'backend']);
    Route::resource('items', 'Backend\ItemController', ['as' => 'backend']);

    Route::resource('users', 'Backend\UserController', ['except' => ['show'], 'as' => 'backend']);
	Route::get('profile', ['as' => 'backend.profile.edit', 'uses' => 'Backend\ProfileController@edit']);
	Route::put('profile', ['as' => 'backend.profile.update', 'uses' => 'Backend\ProfileController@update']);
	Route::put('profile/password', ['as' => 'backend.profile.password', 'uses' => 'Backend\ProfileController@password']);
    Route::get('/getcustomers', 'Backend\UserController@getcustomers')->name('backend.getcustomers');

});

