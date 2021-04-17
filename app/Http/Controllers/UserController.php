<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Log;
use Auth;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userAddress()
    {
        return view('user.address');
    }

    public function userReviews()
    {
        return view('user.reviews');
    }

    public function userOrders()
    {
        return view('user.orders');
    }

    public function myaccount()
    {
        $user = Auth::user();
        return view('user.index', ['user'=>$user]);
    }

    public function saveInfo(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|min:5',
            'email'=>'required|email|unique:users,email,'.Auth::user()->id,
            'telephone'=>'min:10|max:15|unique:users,telephone,'.Auth::user()->id,
        ]);
        $user = User::findorfail(Auth::user()->id);
        $user->update($request->all());
    }
}
