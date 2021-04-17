<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use Socialite;
use App\User;
use Log;
use Str;
use Hash;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

      public function redirectToProvider()
    {
        if(!config("services.facebook")) abort('404');
        try {
            return Socialite::driver('facebook')->redirect();

        }catch (Exception $e) {

        }

    }
    public function showLoginForm()
    {
        session()->put('previousUrl', url()->previous());

        return view('auth.login');
    }
    public function logout(Request $request)
    {
        $cart = collect(session()->get('cart'));

        $destination = \Auth::logout();

        if (!config('cart.destroy_on_logout')) {
            $cart->each(function ($rows, $identifier) {
                session()->put('cart.' . $identifier, $rows);
            });
        }

        return redirect()->to($destination);
    }

    public function redirectTo()
    {
        return str_replace(url('/'), '', session()->get('previousUrl', '/'));
    }
    public function handleProviderCallback(Request $request)
    {
        if (!$request->has('code') || $request->has('denied')) {
            return redirect('/login#');
        }
        try {

            $user = Socialite::driver('facebook')->stateless()->user();
            $find_user = User::where('email',$user->email)->first();
             if ($find_user) {
                if($find_user->checker == '0')
                {
                    return redirect()->to('/login/facebook/confirmation/'.$user->id);
                }
                Auth::login($find_user); 
                return redirect()->to('/');
            }else{
                $createUser = User::create([
                    'name' =>$user->name,
                    'email'=>$user->email,
                    'usertype'=>'user',
                    'provider'=>'facebook',
                    'checker'=>'0',
                    'provider_id'=>$user->id,
                    'password'=>HASH::make(Str::random(24))
                ]);
                return redirect()->to('/login/facebook/confirmation/'.$user->id);
            }
        } 
        catch (Exception $e) {
            return redirect ('/');
        }


        // $user->token;
    }
    public function viewSetPassword($user_id)
    {
        $get_user = User::where('provider_id',$user_id)->first();
        return view('auth.social_password_confirm',[
            'user_id'=>$get_user->id,
            'social_id'=>$user_id,
        ]);
    }
    public function updateSocialAccountWithPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',  
            'social_id' => 'required',  
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return redirect('/login/facebook/confirmation/'.$request->social_id)
                        ->withErrors($validator)
                        ->withInput();
        }
        $user = User::findOrFail($request->user_id);
        $user->password = HASH::make($request->password);
        $user->checker = '1';
        $user->save();
        Auth::login($user); 
        return redirect ('/');

    }
}
