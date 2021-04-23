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

Route::apiResources(['/products' =>'API\ProductController']);
Route::get('/products/get/list', 'API\ProductController@fetchProducts')->name('products.list');
Route::get('/products/get/new', 'API\ProductController@fetchNewProducts');
Route::post('/products/image','API\ProductController@imageUpload');
Route::apiResources(['/category' =>'API\CategoryController']);
Route::get('/category/get/list', 'API\CategoryController@fetchCategories');
Route::apiResources(['/settings' =>'API\SettingController']);
Route::apiResources(['/banners' =>'API\BannerController']);
Route::apiResources(['/coupon' =>'API\CouponController']);
Route::get('/category/list/cat','API\CategoryController@categoryList');
Route::get('prices', 'API\ProductController@price');

//address API
Route::get('/province', 'AddressController@getProvince')->name('useradd.province');
Route::get('/city/{province_id}', 'AddressController@getCity')->name('useradd.city');
Route::get('/barangay/{city_id}', 'AddressController@getBarangay')->name('useradd.barangay');
