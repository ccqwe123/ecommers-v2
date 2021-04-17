@extends('layouts.frontend')
@section('title', 'My Account')
<style type="text/css">
	.invoice {
	    background: #fff;
	    border: 1px solid rgba(0,0,0,.125);
	    position: relative;
	}

.profile-label
{
    color: #444;
    font-size: 14px;
    font-weight: 550;
}
.col-md-12,.col-md-8{float: left;  position: relative; padding-left: unset!important; padding-right: unset!important}
input[type="text"]{font: 15px/24px "Lato", Arial, sans-serif; color: #333; width: 100%; box-sizing: border-box; letter-spacing: 1px;}

</style>
@section('preloader')
<div class="preloader" style="visibility: hidden;">
    <div class="preloader-inner">
        <div class="preloader-icon">
            <span><img src="{{asset('images/others/bdlogo.png')}}"></span>
            <span><img src="{{asset('images/others/bdlogo.png')}}"></span>
        </div>
    </div>
</div>
@endsection
@section('body')
<main id="main" class="main-site left-sidebar pt-5 pb-60">
	<div class="container">
		<div class="row">
        <div class="col-sm-3">
            <div class="dropdown sidebar sidebar-md pb-10">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    My Account
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li class="dropdown-header">Hello User</li>
                    <li class="active"><a href="#">Account Info</a></li>
                    <li><a href="{{ route('user.address') }}">Saved Address</a></li>
                    <li><a href="{{ route('user.review') }}">Product Reviews</a></li>
                    <li><a href="{{ route('user.order') }}">My Orders</a></li>
                    <li><a href="{{ route('user.wishlist') }}">My Wishlist</a></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="invoice p-3 mb-3">
              <div class="row">
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
                <form action="{{ route('user.saveinfo') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                        <h3 class="profile-label">Full Name</h3>
                    </div>
                    <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                        <input class="effect-8" type="text" placeholder="Name" name="name" autocomplete="off" value="{{ $user->name }}">
                          <span class="focus-border">
                            <i></i>
                          </span>
                    </div>
                    <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                        <h3 class="profile-label">Email Address</h3>
                    </div>
                    <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12 mt-3">
                        <input class="effect-8" type="text" placeholder="Email Address" name="email" autocomplete="off" value="{{ $user->email }}">
                          <span class="focus-border">
                            <i></i>
                          </span>
                    </div>

                    <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                        <h3 class="profile-label">Telephone Number</h3>
                    </div>
                    <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12 mt-3">
                        <input class="effect-8" type="text" name="telephone" placeholder="Contact Number" autocomplete="off" value="{{ $user->telephone }}">
                          <span class="focus-border">
                            <i></i>
                          </span>
                    </div>
                    <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12 mt-5 mb-3">
                        <button type="submit" class="btn btn-success btn-block btn-lg">Save &nbsp;<i class="fa fa-save"></i></button>
                    </div>
                </form>
              </div>
            </div>
        </div>
    </div>

	</div><!--end container-->

</main>

@stop
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/snap.svg/0.4.1/snap.svg-min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('li').not(".active, .dropdown-header").addClass('preload');
        $(".preload").on('click', function() {
            $(".preloader").removeAttr("style");
            $('.preloader').fadeIn('slow');
        })
    });
</script>
@endsection