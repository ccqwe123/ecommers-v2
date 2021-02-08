@extends('layouts.frontend')
@section('title', 'Create Account')
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
                                @error('name')
                                <fieldset class="wrap-title item-slide">
                                        <div class="alert slide-info slide-1">
                                          <span class="closebtn f-title" onclick="this.parentElement.style.display='none';">&times;</span>
                                          {{ $message }}
                                        </div>
                                    </fieldset> 
                                @enderror
                                @error('email')
                                <fieldset class="wrap-title item-slide">
                                        <div class="alert slide-info slide-1">
                                          <span class="closebtn f-title" onclick="this.parentElement.style.display='none';">&times;</span>
                                          {{ $message }}
                                        </div>
                                    </fieldset> 
                                @enderror
                                @error('password')
                                <fieldset class="wrap-title item-slide">
                                        <div class="alert slide-info slide-1">
                                          <span class="closebtn f-title" onclick="this.parentElement.style.display='none';">&times;</span>
                                          {{ $message }}
                                        </div>
                                    </fieldset> 
                                @enderror
                                <fieldset class="wrap-title">
                                    <h3 class="form-title">Create an account</h3>
                                </fieldset>                                 
                                <fieldset class="wrap-input">
                                    <div class="social-signin clearfix" style="margin-bottom:10px!important">
                                        <a href="{{ url('/login/facebook') }}" target="_self" class="button facebook btn-block text-center"><i class="fa fa-facebook"></i> &nbsp;&nbsp;&nbsp;CONNECT WITH FACEBOOK</a>
                                    </div>
                                </fieldset>                                 
                                <fieldset class="wrap-input">
                                    <label for="name">{{ __('Full Name') }}</label>
                                    @if(!empty(session('user')->name))
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                                    @else
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @endif
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="email">{{ __('E-Mail Address') }}</label>
                                    @if(!empty(session('user')->email))
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ session('user')->email }}" required autocomplete="email">
                                    @else
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @endif
                                </fieldset>
                                <fieldset class="wrap-input item-width-in-half left-item" style="margin-bottom:20px;">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                </fieldset>
                                <fieldset class="wrap-input item-width-in-half ">
                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
