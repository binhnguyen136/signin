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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/redirect/{social}', 'Auth\SocialAuthController@redirect');
Route::get('/callback/{social}', 'Auth\SocialAuthController@callback');

Route::group(['middleware' => 'auth'], function($r) {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/update-profile', 'HomeController@update');
    Route::get('/change-password', 'HomeController@change_pass_index')->name('change-password');
    Route::post('/change-password', 'HomeController@change_pass')->name('change-password');
});
