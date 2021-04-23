<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Setting;
use App\Banner;
use Log;
use Carbon\Carbon;
class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::select(['products.*','images.image_name'])->leftjoin('images','images.product_id','=','products.id')->groupBy('products.product_name')->take(10)->inRandomOrder()->get();
        $setting = Setting::whereNotNull('onsale')->first();
        $onsale = Product::where('sale','1')->inRandomOrder()->take(10)->get();
        $banner = Banner::get();
        // inRandomOrder()
        $for_cat = Category::with('productByCategory')->take(20)->get();

        return view('frontpage.index',compact('product','for_cat','setting','onsale','banner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shoplist(Request $request)
    {
        $search = $request->search;
        return view('frontpage.shop',compact('search'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
