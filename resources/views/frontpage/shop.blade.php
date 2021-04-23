@extends('layouts.frontend')
@section('title', 'Beauty Products')
@section('body')
<div class="preloader">
      <div class="preloader-inner">
        <div class="preloader-icon">
          <span><img src="{{asset('images/others/bdlogo.png')}}"></span>
        </div>
      </div>
    </div>
<main id="app" class="main-site left-sidebar">
	<shop-component :datasearch="'{{ $search }}'" csrf_token="{{ csrf_token() }}"></shop-component>
</main>
@stop

@section('script')
<script src="{{ asset('/js/app.js') }}"></script>

@endsection