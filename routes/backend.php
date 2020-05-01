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

// Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'Backend\HomeController@home')->name('backend.home');

    //traditional songs
    Route::resource('traditional_songs', 'Backend\TraditionalSongController', ['as' => 'backend']);
    
// });

