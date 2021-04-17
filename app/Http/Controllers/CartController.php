<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Setting;
use Gloudemans\Shoppingcart\Facades\Cart;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCart()
    {
        $cart = Cart::content();
        $count_cart = Cart::count();

        $subtotal = 0;
        foreach ($cart as $value) {
            $subtotal += $value->subtotal;
        }
        return response()->json([
            'cart' => $cart,
            'count_cart' => $count_cart,
            'subtotal' => $subtotal
        ]);
        // log::info($cart);
    }
    public function index()
    {
        $discount = session()->get('coupon')['discount'] ?? 0;
        $code = session()->get('coupon')['name'] ?? null;
        $newSubtotal = (floatval(implode(explode(',',Cart::subtotal()))) - $discount);
        if ($newSubtotal < 0) {
            $newSubtotal = 0;
        }
        // return view('frontpage.cart');
        $setting = Setting::whereNotNull('onsale')->first();
        return view('frontpage.cart', [
            'onsale'=>$setting,
            'discount'=>$discount,
            'newSubtotal'=>$newSubtotal,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        Cart::add($request->id, $request->product_name, $request->quantity, $request->price)
        ->associate('App\Product');
        return redirect()->route('cart.index')->with('success_message','Item was added to your cart!');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        log::info("show: ".$id);
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
        log::info("edit: ".$id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // increase cart
    public function update(Request $request, $id)
    {
        Cart::update($id, $request->productQuantity);
        // session()->flash('success_message', 'Quantity was updated successfully!');
        return response()->json(['success' => true]);
    }
    //decrease cart
    public function decreaseCart(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // log::info($id);
        Cart::remove($request->cart_id);
        return redirect()->back();
        // log::info($request->cart_id);
    }

    public function checkout()
    {
        $discount = session()->get('coupon')['discount'] ?? 0;
        $code = session()->get('coupon')['name'] ?? null;
        $newSubtotal = (floatval(implode(explode(',',Cart::subtotal()))) - $discount);
        if ($newSubtotal < 0) {
            $newSubtotal = 0;
        }
        // return view('frontpage.cart');
        $setting = Setting::whereNotNull('onsale')->first();
        return view('frontpage.checkout', [
            'onsale'=>$setting,
            'discount'=>$discount,
            'newSubtotal'=>$newSubtotal,
        ]);
    }
}
