@extends('layouts.frontend')
@section('title', 'Login')
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700">
@section('body')
<main id="main" class="main-site left-sidebar">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">home</a></li>
                <li class="item-link"><span>login</span></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
                <div class=" main-content-area">
                    <div class="wrap-login-item ">                      
                        <div class="login-form form-item form-stl">
                             <form method="POST" action="{{ route('login') }}">
                                 @csrf
                                <fieldset class="wrap-title">
                                    @if (session('user_invalid'))
                                        <div class="alert slide-info slide-1">
                                          <span class="closebtn f-title" onclick="this.parentElement.style.display='none';">&times;</span>
                                          {{ session('user_invalid') }}
                                        </div>
                                    @endif
                                </fieldset>
                                <fieldset class="wrap-title">
                                    <h3 class="form-title">Log in to your account</h3>                                      
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="email">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </fieldset>
                                
                                <fieldset class="wrap-input">
                                    <label class="remember-field">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </span>
                                    </label>
                                    @if (Route::has('password.request'))
                                    <a class="link-function left-position" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif
                                </fieldset>
                                <!-- <input type="submit" class="btn btn-submit" value="Login" name="submit"> -->
                                <button type="submit" class="btn btn-submit btn-block">
                                    {{ __('Login') }}
                                </button>
                                <div class="or-seperator"><b>or</b></div>
                                <div class="social-signin clearfix">
                                    <a href="{{ url('/login/facebook') }}" target="_self" class="button facebook btn-block text-center"><i class="fa fa-facebook"></i> &nbsp;&nbsp;&nbsp;CONTINUE WITH FACEBOOK</a>
                                </div>
                            </form>
                        </div>                                              
                    </div>
                </div>    
            </div>
        </div>
    </div>
</main>
@endsection
