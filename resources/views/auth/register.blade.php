@extends('layouts.frontend')
@section('title', 'Create Account')
<style type="text/css">
    .col-md-12,.col-md-8{float: left;  position: relative; padding-left: unset!important; padding-right: unset!important}
    input[type="text"]{font: 15px/24px "Lato", Arial, sans-serif; color: #333; width: 100%; box-sizing: border-box; letter-spacing: 1px;}

</style>
@section('body')
<main id="main" class="main-site left-sidebar">
    <div class="container">
        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">home</a></li>
                <li class="item-link"><span>Register</span></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">                          
                <div class=" main-content-area">
                    <div class="wrap-login-item ">
                        <div class="register-form form-item ">
                            <form class="form-stl" method="POST" action="{{ route('register') }}">
                                @csrf
                                @if($errors->all())
                                <fieldset class="wrap-title item-slide">
                                    <div class="alert slide-info slide-1">
                                      <span class="closebtn f-title" onclick="this.parentElement.style.display='none';">&times;</span>
                                @foreach ($errors->all() as $error)
                                      <ul>
                                          <li>{{ $error }}</li>
                                      </ul>
                                @endforeach
                                    </div>
                                </fieldset> 
                                @endif
                                <fieldset class="wrap-title">
                                    <h3 class="form-title">Create an account</h3>
                                </fieldset>                                 
                                <fieldset class="wrap-input">
                                    <div class="social-signin clearfix" style="margin-bottom:10px!important">
                                        <a href="{{ url('/login/facebook') }}" target="_self" class="button facebook btn-block text-center"><i class="fa fa-facebook"></i> &nbsp;&nbsp;&nbsp;CONNECT WITH FACEBOOK</a>
                                    </div>
                                </fieldset>                                 
                                <fieldset class="wrap-input">
                                    <div class="or-seperator"><b>or</b></div>
                                </fieldset>                                 
                                <fieldset class="wrap-input">
                                    <label for="name">{{ __('Full Name') }}</label>
                                    <!-- <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus> -->
                                    <div class="col-md-12">
                                        <input class="effect-8" type="text" name="name" placeholder="Name" autocomplete="off" value="{{ old('name') }}">
                                          <span class="focus-border">
                                            <i></i>
                                          </span>
                                    </div>
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="email">{{ __('E-Mail Address') }}</label>
                                    <div class="col-md-12">
                                        <input class="effect-8"id="email" type="email" placeholder="example@gmail.com" autocomplete="off" name="email" value="{{ old('email') }}">
                                          <span class="focus-border">
                                            <i></i>
                                          </span>
                                    </div>
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="telephone">{{ __('Mobile No.') }}</label>
                                    <div class="col-md-12">
                                        <input class="effect-8" id="telephone" type="text" placeholder="(optional)" autocomplete="off" name="telephone" value="{{ old('telephone') }}" >
                                          <span class="focus-border">
                                            <i></i>
                                          </span>
                                    </div>
                                </fieldset>
                                <fieldset class="wrap-input item-width-in-half left-item" style="margin-bottom:20px;">
                                    <label for="password">{{ __('Password') }}</label>
                                    <div class="col-md-12">
                                        <input class="effect-8" id="password" type="password" name="password" placeholder="Enter your Password" autocomplete="off">
                                          <span class="focus-border">
                                            <i></i>
                                          </span>
                                    </div>
                                </fieldset>
                                <fieldset class="wrap-input item-width-in-half ">
                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                    <div class="col-md-12">
                                        <input class="effect-8" id="password-confirm" type="password" name="password_confirmation" placeholder="Confirm your Password" autocomplete="off">
                                          <span class="focus-border">
                                            <i></i>
                                          </span>
                                    </div>
                                </fieldset>
                                 <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Submit') }}
                                </button>
                            </form>
                        </div>                                          
                    </div>
                </div><!--end main products area-->     
            </div>
        </div><!--end row-->

    </div><!--end container-->

</main>
@endsection
