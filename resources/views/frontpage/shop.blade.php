@extends('layouts.frontend')
@section('title', 'Beauty Products')
<style type="text/css">
	.row{
		background-color: #fff;
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

	<main id="app" class="main-site left-sidebar">

		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="#" class="link">home</a></li>
					<li class="item-link"><span>Digital & Electronics</span></li>
				</ul>
			</div>
			<div class="row">
				<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
					<div class="banner-shop">
						<a href="#" class="banner-link">
							<figure><img src="assets/images/shop-banner.jpg" alt=""></figure>
						</a>
					</div>
					<div class="wrap-shop-control">
						<h1 class="shop-title">Digital & Electronics title</h1>
						<div class="wrap-right">
							<div class="sort-item orderby ">
								<select name="orderby" class="use-chosen" id="sorting-items">
									<option value="default" selected="selected">Default sorting</option>
									<option value="date">Sort by newness</option>
									<option value="price">Sort by price: low to high</option>
									<option value="price-desc">Sort by price: high to low</option>
								</select>
							</div>
							<div class="sort-item product-per-page">
								<select name="post-per-page" class="use-chosen" >
									<option value="12" selected="selected">12 per page</option>
									<option value="16">16 per page</option>
									<option value="18">18 per page</option>
									<option value="21">21 per page</option>
									<option value="24">24 per page</option>
									<option value="30">30 per page</option>
									<option value="32">32 per page</option>
								</select>
							</div>
							<div class="change-display-mode">
								<a href="#" class="grid-mode display-mode active"><i class="fa fa-th"></i>Grid</a>
								<a href="list.html" class="list-mode display-mode"><i class="fa fa-th-list"></i>List</a>
							</div>
						</div>
					</div>
					<div class="row">
						<ul class="product-list grid-products equal-container">
							@foreach($products as $product)
							<li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
								<div class="product product-style-2 equal-elem ">
									<div class="product-thumnail">
										<a href="/shop/{{ $product->product_name }}.html/{{ Crypt::encryptString($product->id) }}/{{ rand(1000000000000000, 1000009999999999) }}/" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
												<figure><img src="{{ $product->image_name ? $product->image_name : '/images/products/default.png' }}" width="800" height="800"></figure>
											</a>
										<div class="group-flash">
											@if($product->new == 1)
											<span class="flash-item new-label">new</span>
											@endif
											@if($product->sale==1)
											<span class="flash-item sale-label">sale</span>
											@endif
											@if($product->promo==1)
											<span class="flash-item bestseller-label">promo</span>
											@endif
										</div>
									</div>
									<div class="product-info">
											<a href="/shop/{{ $product->product_name }}.html/{{ Crypt::encryptString($product->id) }}/{{ rand(1000000000000000, 1000009999999999) }}/" class="product-name"><span>{{ $product->product_name }}</span></a>
											<div class="wrap-price">
												<ins>
													<p class="product-price">₱{{ $product->regular_price }}.00</p>
												</ins>
												<del>
													<p class="product-price">
														@if(isset($product->sale_price))
														{{ $product->sale_price }}
														@endif
													</p>
												</del>
												<div class="product-rating pull-right">
					                                <i class="fa fa-star" aria-hidden="true"></i>
					                                <i class="fa fa-star" aria-hidden="true"></i>
					                                <i class="fa fa-star" aria-hidden="true"></i>
					                                <i class="fa fa-star" aria-hidden="true"></i>
					                                <i class="fa fa-star" aria-hidden="true"></i>
					                                <a href="#" class="count-review">(05)</a>
					                            </div>
											</div>
										</div>
								</div>
							</li>
							@endforeach		
						</ul>

					</div>
					{!! $products->links('layouts.pagination') !!}
				</div><!--end main products area-->

				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
					<div class="widget mercado-widget filter-widget brand-widget">
						<h2 class="widget-title">Categories</h2>
						<div class="widget-content">
							<ul class="list-style vertical-list list-limited" data-show="6">
								@foreach($categories as $category)
									<li class="list-item {{ $loop->index > 4 ? 'default-hiden' : '' }}"><a class="filter-link " href="#">{{ $category->category_name }}</a></li>
								@endforeach
								<li class="list-item"><a data-label='Show less<i class="fa fa-angle-up" aria-hidden="true"></i>' class="btn-control control-show-more" href="#">Show more<i class="fa fa-angle-down" aria-hidden="true"></i></a></li>
							</ul>
						</div>
					</div>

					<div class="widget mercado-widget widget-product">
						<h2 class="widget-title">New Products</h2>
						<div class="widget-content">
							<ul class="products">
								@foreach($new_products as $products)
								<li class="product-item">
									<div class="product product-widget-style">
										<div class="thumbnnail">
											<a href="detail.html" title="Radiant-360 R6 Wireless Omnidirectional Speaker [White]">
												<figure><img src="{{ $products->image ? $products->image : '/images/products/default.png' }}" alt=""></figure>
											</a>
										</div>
										<div class="product-info">
											<a href="#" class="product-name"><span>{{ $products->product_name }}</span></a>
											<div class="wrap-price"><span class="product-price">$168.00</span></div>
										</div>
									</div>
								</li>
								@endforeach
							</ul>
						</div>
					</div>

				</div>

			</div>

		</div>

	</main>
@stop

@section('script')
<script src="{{ asset('/js/app.js') }}"></script>
	<script>
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
</script>
@endsection