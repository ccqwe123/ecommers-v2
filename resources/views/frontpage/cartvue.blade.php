@extends('layouts.frontend')
@section('title', 'My Cart')
@section('body')
<main class="main-site" id="app">
<cart-component></cart-component>\
</main>
@endsection
@section('script')
	<script src="{{ asset('/js/app.js') }}"></script>
@endsection