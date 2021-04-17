@extends('layouts.frontend')
@section('title', 'My Account')
<style type="text/css">
    .widget-content>ul>li>a:hover, .widget-content>ul>li>ul>li>a:hover
    {
        color:unset !important;
    }
    .invoice {
        background: #fff;
        border: 1px solid rgba(0,0,0,.125);
        position: relative;
    }
    .widget ul li a {
        line-height: 25px!important;
        letter-spacing:0;
    }
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
                    <li><a href="{{ route('user.myaccount') }}">Account Info</a></li>
                    <li><a href="{{ route('user.address') }}">Saved Address</a></li>
                    <li class="active"><a href="#">Product Reviews</a></li>
                    <li><a href="{{ route('user.order') }}">My Orders</a></li>
                    <li><a href="{{ route('user.wishlist') }}">My Wishlist</a></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-9">
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                  <h4>
                    <i class="fas fa-globe"></i> AdminLTE, Inc.
                    <small class="float-right">Date: 2/10/2014</small>
                  </h4>
                </div>
              </div>
            </div>
        </div>
    </div>

    </div><!--end container-->

</main>

@stop
@section('script')
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