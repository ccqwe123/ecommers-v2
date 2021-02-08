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

Route::get('/', 'ShopController@index');
Route::get('/shop', 'ShopController@shoplist');
Route::get('/cart', 'CartController@index');
Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('login/facebook/confirmation/{user_id}', 'Auth\LoginController@viewSetPassword');
Route::post('confirm/password', 'Auth\LoginController@updateSocialAccountWithPassword');

Auth::routes();

Route::group(['middleware' => ['auth','admin']], function() {
	Route::get('/dashboard', 'DashboardController@index');	
});
// Route::get('/home', 'HomeController@index')->name('home');
