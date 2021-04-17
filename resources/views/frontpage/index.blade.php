@extends('layouts.frontend')
@section('title', 'Beauty Products')
<style type="text/css">
/*@media (min-width: 576px)
{.modal-dialog-centered {
    min-height: calc(100% - (1.75rem * 2));
}}
@media (min-width: 576px)
{.modal-dialog {
    max-width: 500px;
    margin: 1.75rem auto;
}}
@media (min-width: 768px)
{.modal-dialog {
    margin: 0px auto !important;
}}
.modal-dialog-centered {
    display: flex;
    align-items: center;
    min-height: calc(100% - (.5rem * 2));
}*/
</style>
@section('preloader')
<div class="preloader">
	<div class="preloader-inner">
		<div class="preloader-icon">
			<span><img src="{{asset('images/others/bdlogo.png')}}"></span>
			<span><img src="{{asset('images/others/bdlogo.png')}}"></span>
		</div>
	</div>
</div>
@endsection
@section('body')
<main id="app">
		<div class="container">

			<!--MAIN SLIDE-->
			<div class="wrap-main-slide">
				<div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
					@foreach($banner as $x)
						@if($x->bstyle == "1")
						<div class="item-slide">
							<img src="{{ asset('/images/banner/'.$x->image_banner.'') }}" alt="" class="img-slide">
							<div class="slide-info slide-1">
								<h2 class="f-title">{{ $x->text_one }} <b>{{ $x->text_two }}</b></h2>
								<span class="subtitle">{{ $x->text_third }}</span>
								<p class="sale-info">Only price: <span class="price">₱{{ $x->text_fourth }}</span></p>
								<a href="/shop" class="btn-link">Shop Now</a>
							</div>
						</div>
						@elseif($x->bstyle == "2")
						<div class="item-slide">
							<img src="{{ asset('/images/banner/'.$x->image_banner.'') }}" alt="" class="img-slide">
							<div class="slide-info slide-2">
								<h2 class="f-title">{{ $x->text_one }}</h2>
								<span class="f-subtitle">{{ $x->text_two }}</span>
								<!-- <p class="discount-code">Use Code: #FA6868</p> -->
								<h4 class="s-title">{{ $x->text_third }}</h4>
								<p class="s-subtitle">{{ $x->text_fourth }}</p>
							</div>
						</div>
						@elseif($x->bstyle == "3")
						<div class="item-slide">
							<img src="{{ asset('/images/banner/'.$x->image_banner.'') }}" alt="" class="img-slide">
							<div class="slide-info slide-3">
								<h2 class="f-title">{{ $x->text_one }} <b>{{ $x->text_two }}</b></h2>
								<span class="f-subtitle">{{ $x->text_third }}</span>
								<p class="sale-info">Stating at: <b class="price">${{ $x->text_fourth }}</b></p>
								<a href="/shop" class="btn-link">Shop Now</a>
							</div>
						</div>
						@endif
					@endforeach
					<!-- <div class="item-slide">
						<img src="{{ asset('/images/banner/main-slider-1-2.jpg') }}" alt="" class="img-slide">
						<div class="slide-info slide-2">
							<h2 class="f-title">Extra 25% Off</h2>
							<span class="f-subtitle">On online payments</span>
							<p class="discount-code">Use Code: #FA6868</p>
							<h4 class="s-title">Get Free</h4>
							<p class="s-subtitle">TRansparent Bra Straps</p>
						</div>
					</div>
					<div class="item-slide">
						<img src="{{ asset('/images/banner/main-slider-1-3.jpg') }}" alt="" class="img-slide">
						<div class="slide-info slide-3">
							<h2 class="f-title">Great Range of <b>Exclusive Furniture Packages</b></h2>
							<span class="f-subtitle">Exclusive Furniture Packages to Suit every need.</span>
							<p class="sale-info">Stating at: <b class="price">$225.00</b></p>
							<a href="#" class="btn-link">Shop Now</a>
						</div>
					</div> -->
				</div>
			</div>

			<!--BANNER-->
			<div class="wrap-banner style-twin-default">
				<div class="banner-item">
					<a href="#" class="link-banner banner-effect-1">
						<figure><img src="assets/images/home-1-banner-1.jpg" alt="" width="580" height="190"></figure>
					</a>
				</div>
				<div class="banner-item">
					<a href="#" class="link-banner banner-effect-1">
						<figure><img src="assets/images/home-1-banner-2.jpg" alt="" width="580" height="190"></figure>
					</a>
				</div>
			</div>

			<!--On Sale-->
			@if(isset($setting))
				@if(count($onsale)>0 && $setting->onsale > Carbon\Carbon::now())
					<div class="wrap-show-advance-info-box style-1 has-countdown hide">
						<h3 class="title-box">On Sale</h3>
						<div class="wrap-countdown mercado-countdown" data-expire="{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $setting->onsale)->format('Y/m/d H:i:s') }}"></div>
						<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>
							@foreach($onsale as $x)
							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="detail.html" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="{{ $x->image ? $x->image : '/images/products/default.png' }}"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item sale-label">sale</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>{{ $x->product_name }}</span></a>
									<div class="wrap-price">
										@if(isset($x->sale_price))
											<ins>
												<p class="product-price">₱{{ $x->sale_price }}.00</p>
											</ins>
											<del>
												<p class="product-price">
													{{ $x->regular_price }}
												</p>
											</del>
										@else
										<ins>
												<p class="product-price">₱{{ $x->sale_price }}.00</p>
											</ins>
										@endif
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
							@endforeach
						</div>
					</div>	
				@endif
			@endif
			<!--Latest Products-->
			<div class="wrap-show-advance-info-box style-1">
				<h3 class="title-box">Latest Products</h3>
				<div class="wrap-top-banner">
					<a href="#" class="link-banner banner-effect-2">
						<figure><img src="assets/images/digital-electronic-banner.jpg" width="1170" height="240" alt=""></figure>
					</a>
				</div>
				<div class="wrap-products">
					<div class="wrap-product-tab tab-style-1">						
						<div class="tab-contents">
							<div class="tab-content-item active" id="digital_1a">
								<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >
									@foreach($product as $products)
									<div class="product product-style-2 equal-elem">
										<div class="product-thumnail">
											<a href="/shop/{{ $products->product_name }}.html/{{ Crypt::encryptString($products->id) }}/{{ rand(1000000000000000, 1000009999999999) }}/" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
												<figure><img src="{{ $products->image_name ? $products->image_name : '/images/products/default.png' }}" width="800" height="800"></figure>
											</a>
											<div class="group-flash">
												@if($products->new == 1)
												<span class="flash-item new-label">new</span>
												@endif
												@if($products->sale==1)
												<span class="flash-item sale-label">sale</span>
												@endif
												@if($products->promo==1)
												<span class="flash-item bestseller-label">promo</span>
												@endif
											</div>
											<!-- <div class="wrap-btn">
												<a href="#" class="function-link" data-toggle="modal" data-target="#{{$products->id}}">Add to Cart</a>
											</div> -->
										</div>
										<div class="product-info">
											<a href="/shop/{{ $products->product_name }}.html/{{ Crypt::encryptString($products->id) }}/{{ rand(1000000000000000, 1000009999999999) }}/" class="product-name"><span>{{ $products->product_name }}</span></a>
											<div class="wrap-price">
												<ins>
													<p class="product-price">₱{{ $products->regular_price }}.00</p>
												</ins>
												<del>
													<p class="product-price">
														@if(isset($products->sale_price))
														{{ $products->sale_price }}
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
									@endforeach
								</div>
							</div>							
						</div>
					</div>
				</div>
			</div>
			<!--Product Categories-->
			<div class="wrap-show-advance-info-box style-1">
				<h3 class="title-box">Product Categories</h3>
				<div class="wrap-top-banner">
					<a href="#" class="link-banner banner-effect-2">
						<figure><img src="assets/images/fashion-accesories-banner.jpg" width="1170" height="240" alt=""></figure>
					</a>
				</div>
				<div class="wrap-products">
					<div class="wrap-product-tab tab-style-1">
						<div class="tab-control">
							@foreach($for_cat as $x)
							<a href="#{{ $x->category_name }}" class="tab-control-item {{ $loop->first ? 'active' : '' }}">{{ $x->category_name }}</a>
							<!-- <a href="#fashion_1b" class="tab-control-item">Watch</a>
							<a href="#fashion_1c" class="tab-control-item">Laptop</a>
							<a href="#fashion_1d" class="tab-control-item">Tablet</a> -->
							@endforeach
						</div>
						<!-- tab content -->
						<div class="tab-contents">
							@foreach($for_cat as $x)
							<div class="tab-content-item {{ $loop->first ? 'active' : '' }}" id="{{ $x->category_name }}">
								<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >
									@foreach($x->product as $y)
									<div class="product product-style-2 equal-elem ">
										<div class="product-thumnail">
											<a href="shop/{{ $y->product_name }}.html/{{ Crypt::encryptString($y->id) }}/{{ rand(1000000000000000, 1000009999999999) }}/" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
												<figure><img src="{{ $y->image ? $y->image : '/images/products/default.png' }}" width="800" height="800" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
											</a>
											<div class="group-flash">
												<span class="flash-item new-label">new</span>
											</div>
											<div class="wrap-btn">
												<a href="#" class="function-link">quick view</a>
											</div>
										</div>
										<div class="product-info">
											<a href="#" class="product-name"><span>{{ $y->product_name }}</span></a>
											<div class="wrap-price">
												<ins>
													<p class="product-price">₱{{ $y->regular_price }}.00</p>
												</ins>
												<del>
													<p class="product-price">
														50000
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
									@endforeach
								</div>
							</div>
							@endforeach
						</div>
						<!-- end tab cont -->
					</div>
				</div>
			</div>			
		</div>

	</main>
@stop
@section('script')
<script type='text/javascript'>
    $(function(){
        $('img').imgPreload()
        setTimeout(() => { 
        	$('.has-countdown').removeClass('hide');
	    }, 0);
    })
    $(document).on('ready', function() {
        $('.preloader').fadeOut('slow');
    });
</script>
@endsection