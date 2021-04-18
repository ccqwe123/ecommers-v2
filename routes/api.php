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
Route::get('/products/get/list', 'API\ProductController@fetchProducts');
Route::post('/products/image','API\ProductController@imageUpload');
Route::apiResources(['/category' =>'API\CategoryController']);
Route::get('/category/get/list', 'API\CategoryController@fetchCategories');
Route::apiResources(['/settings' =>'API\SettingController']);
Route::apiResources(['/banners' =>'API\BannerController']);
Route::apiResources(['/coupon' =>'API\CouponController']);
Route::get('/category/list/cat','API\CategoryController@categoryList');
