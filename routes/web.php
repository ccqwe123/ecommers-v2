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
Route::get('/', 'ShopController@index')->name('shop.list');
Route::get('/shop', 'ShopController@shoplist')->name('shop.list');
Route::get('/category-get', 'API\CategoryController@categoryList');
Route::delete('/cart/{id}/delete/data','CartController@destroy')->name('cart.deldata');
Route::get('/cart/data-list','CartController@getCart')->name('cart.get');
Route::get('cart', 'CartController@index')->name('cart.index');
Route::post('cart','CartController@store')->name('cart.store');
Route::patch('/cart/{product}', 'CartController@update')->name('cart.update');
Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');
Route::post('/coupon/apply', 'API\CouponController@applyCoupon')->name('coupon.apply');
Route::delete('/coupon/remove', 'API\CouponController@removeCoupon')->name('coupon.remove');
Route::get('/cart/empty', function() {
	Cart::destroy();
	return redirect()->route('cart.index')->with('success_message','Cart has been cleared!');
});
Route::get('/checkout', 'CartController@checkout')->name('checkout.index')->middleware('auth');
Route::patch('/cart/{product}','CartController@update')->name('cart.update');
Route::get('/shop/{slug}','API\ProductController@showProduct')->name('product.showproduct');
Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('login/facebook/confirmation/{user_id}', 'Auth\LoginController@viewSetPassword');
Route::get('/contact-us', 'FrontendController@contactus');
Route::post('confirm/password', 'Auth\LoginController@updateSocialAccountWithPassword');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/account', 'UserController@myaccount')->name('user.myaccount');
Route::post('/account/info', 'UserController@saveInfo')->name('user.saveinfo');		
Route::resource('/address', 'AddressController');	
Route::get('/reviews', 'UserController@userReviews')->name('user.review');	
Route::get('/orders', 'UserController@userOrders')->name('user.order');	
Route::get('/wishlist', 'UserController@userWishlist')->name('user.wishlist');	


Route::group(['middleware' => ['auth','admin']], function() {
	Route::get('/dashboard', 'DashboardController@index');	
	// Route::get('/banner', 'API\ProductController@banner')->name('admin.banner');
Route::get('{path}','HomeController@index')->where('path','([A-z\d-/_.]+)?' );
});
// Route::get('/home', 'HomeController@index')->name('home');
