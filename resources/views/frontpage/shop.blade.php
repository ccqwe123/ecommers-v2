@extends('layouts.frontend')
@section('title', 'Beauty Products')
@section('body')
<div class="preloader">
      <div class="preloader-inner">
        <div class="preloader-icon">
          <span><img src="https://icon-library.com/images/wow-icon/wow-icon-28.jpg"></span>
          <span><img src="https://icon-library.com/images/wow-icon/wow-icon-28.jpg"></span>
        </div>
      </div>
    </div>
<main id="app" class="main-site left-sidebar">
	<shop-component></shop-component>
</main>
@stop

@section('script')
<script src="{{ asset('/js/app.js') }}"></script>
<!-- 	<script>
		$(document).ready(function() {
			 var token = document.head.querySelector('meta[name="csrf-token"]');
    		window.axios.defaults.headers.common = {
			   'X-Requested-With': 'XMLHttpRequest',
			   'Content-Type':'application/json',
			   'Accept':'application/json'
			   };
    		if (token) {
			    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
			} else {
			    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
			}
			$('#sorting-items').on('change', function() {
				axios.get('/shop',{params: this.value})
				.then((response)=>{
			        $('.preloader').fadeIn('fast');
			        $(".preloader").removeAttr("style");
			    }).catch((error)=>{
			        console.log(error.response.data)
			    });
			});
		});
</script> -->
@endsection