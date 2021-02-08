@extends('layouts.frontend')
@section('title', 'Set Your Password')
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700">
@section('body')
<main id="main" class="main-site left-sidebar">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">home</a></li>
                <li class="item-link"><span>Confirm Password</span></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
                <div class=" main-content-area">
                    <div class="wrap-login-item ">                      
                        <div class="login-form form-item form-stl">
                             <form method="POST" action="/confirm/password">
                                 @csrf
                                <fieldset class="wrap-title">
                                	@if ($errors->has('password'))
                    <div class="alert alert-success">{{ $errors->first('password') }}</div>
                    @endif

                                    @if (session('user_invalid'))
                                        <div class="alert slide-info slide-1">
                                          <span class="closebtn f-title" onclick="this.parentElement.style.display='none';">&times;</span>
                                          {{ session('user_invalid') }}
                                        </div>
                                    @endif
                                </fieldset>
                                <fieldset class="wrap-title">
                                    <h3 class="form-title">Set your Password</h3>                                      
                                </fieldset>
                                <fieldset class="wrap-input">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input type="hidden" class="form-control" name="user_id" value="{{ $user_id }}">
                                    <input type="hidden" class="form-control" name="social_id" value="{{ $social_id }}" >
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                </fieldset>
                                <fieldset class="wrap-input" style="margin-bottom:20px;">
                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </fieldset>
                               
                                <button type="submit" class="btn btn-submit btn-block">
                                    {{ __('Submit') }}
                                </button>
                            </form>
                        </div>                                              
                    </div>
                </div>    
            </div>
        </div>
    </div>
</main>
@endsection
