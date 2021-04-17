@extends('layouts.frontend')
@section('title', 'My Cart')
<style type="text/css">
	.loading-data
    {
        overflow: hidden;
        height: 100%;
        width: 100%;
        position:fixed;
    }
    .hide
    {
    	display:none;
    }
    .modal {
	  text-align: center;
	  padding: 0!important;
	}

	.modal:before {
	  content: '';
	  display: inline-block;
	  height: 100%;
	  vertical-align: middle;
	  margin-right: -4px; /* Adjusts for spacing */
	}

	.modal-dialog {
	  display: inline-block;
	  text-align: left;
	  vertical-align: middle;
	}
	.modal-header {
     border-bottom: unset !important; 
	}
	.modal-footer {
    	border-top: unset !important;
	}
	.modal-content
	{
		background-color: #fff;
		border-radius: 0px !important;
		border: unset !important;
	}
	.btn-text
	{
		background-color: transparent;
    	border: unset;
    	padding: 0px;
    	color: #ff0404;
	}
	.product-des
	{
		height: 34px;
	    line-height: 20px;
	    display: -webkit-box;
	    -webkit-box-orient: vertical;
	    -webkit-line-clamp: 2;
	    overflow: hidden;
	    margin-bottom: 4px;
	    font-size: 14px;
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
<main id="app" class="main-site">
		<section id="loading">
		    <div id="loading-content"></div>
		  </section>
		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="/" class="link">home</a></li>
					<li class="item-link"><span>Cart</span></li>
				</ul>
			</div>
			<div class=" main-content-area">
				@if (session()->has('success_message'))
                <div class="alert alert-success alert-dismissible" role="alert">
				  {{ session()->get('success_message') }}
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
	            @endif

	            @if(count($errors) > 0)
	                <div class="alert alert-danger">
	                    <ul>
	                        @foreach ($errors->all() as $error)
	                            <li>{{ $error }}</li>
	                        @endforeach
	                    </ul>
	                </div>
	            @endif
	        @if(Cart::count() > 0)
				<div class="col-md-8">
					<div class="wrap-iten-in-cart">
						<table class="table shopping-summery">
							<thead>
								<tr class="main-hading">
									<th>PHOTO</th>
									<th width="30%">NAME</th>
									<th class="text-center">PRICE</th>
									<th class="text-center">QTY</th>
									<th class="text-center">TOTAL</th> 
									<th class="text-center"><i class="ti-trash remove-icon"></i></th>
								</tr>
							</thead>
							<tbody>
								@foreach (Cart::content() as $item)
								<tr>
									<td class="products-cart" data-title="No">
										<div class="product-image">
											<figure><a href="/shop/{{ $item->model->product_name }}.html/{{ Crypt::encryptString($item->model->id) }}/{{ rand(1000000000000000, 1000009999999999) }}/"><img src="{{ asset($item->model->image) }}" alt=""></a></figure>
										</div>
									</td>
									<td class="product-dess" data-title="Description">
										<p class="product-name"><a href="/shop/{{ $item->model->product_name }}.html/{{ Crypt::encryptString($item->model->id) }}/{{ rand(1000000000000000, 1000009999999999) }}/">{{ $item->model->product_name }}</a></p>
										<div class="product-des">{!! $item->model->description !!}</div>
									</td>
									@if(isset($onsale))
										@php
											if($onsale->onsale > Carbon\Carbon::now())
											{
												$price = $item->model->sale_price == NULL ? $item->model->regular_price : $item->model->sale_price;
											}else{
											$price = $item->model->regular_price;
											}
											$total_price = $price * $item->qty;
										@endphp
									@else
										@php
											$price = $item->model->regular_price;
										@endphp
									@endif
									<td class="price" data-title="Price"><span>₱ {{ number_format($price) }}.00</span>
										<div class="cart-action">
											<a href="/a" data-id="{{ $item->rowId }}" title="Move to Wishlist"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
											<a href="#" data-toggle="modal" data-target="#remove" title="Delete Item" data-cartid="{{$item->rowId}}" class="removeCart"><i class="fa fa-trash" aria-hidden="true"></i></a>
										</div>
									</td>
									<td class="products-cart" data-title="Qty"><!-- Input Order -->
										<div class="quantity">
											<div class="quantity-input">
												<input type="text" class="quantityproduct" data-id="{{ $item->rowId }}" data-productQuantity="{{ $item->qty }}" name="quantity" value="{{ $item->qty }}" data-max="250" pattern="[0-9]*" readonly>									
												<a class="btn btn-increase" href="#"></a>
												<a class="btn btn-reduce" href="#" ></a>
											</div>
										</div>
									</td>
									<td class="total-amount" data-title="Total"><span>₱ {{  number_format($item->subtotal) }}</span></td>
									<td class="action" data-title="Remove"><a href="#"><i class="ti-trash remove-icon"></i></a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-md-4" style="margin-bottom:10px;">
					<div class="wrap-iten-in-checkout">
						<div class="order-summary">
							<h4 class="title-box">Order Summary</h4>
							<p class="summary-info"><span class="title">Subtotal({{ Cart::instance('default')->count() }} items)</span><b class="index">₱{{ Cart::subtotal() }}</b></p>
							<p class="summary-info"><span class="title">Shipping Fee</span><b class="index">₱0</b></p>
								@if (session()->has('coupon'))
								<p class="summary-info"><span class="title">Discount ({{ session()->get('coupon')['name'] }})</span><b class="index">-₱{{ presentPrice($discount) }}</b></p>
								<form action="{{ route('coupon.remove') }}" method="POST">
									{{ csrf_field() }}
	                                {{ method_field('delete') }}
	                                <button type="submit" class="btn-text">(Remove Coupon)</button>
								</form>
								@else
								<p class="summary-info"><span class="title">Discount </span><b class="index">₱0</b></p>
								<div class="set-coupon">
									<div class="voucher">
										<form action="{{ route('coupon.apply') }}" method="POST">
											{{ csrf_field() }}
											<div>
												<div class="col">
											    <div class="input-group">
											      <input type="text" placeholder="Coupon Code" class="vtext-input vtext-input-single vtext-input-medium clear coupon-align" name="coupon_code">
											      <span class="input-group-btn">
											        <button class="next-btn next-btn-normal next-btn-large vbutton" type="submit">APPLY</button>
											      </span>
											    </div>
											  </div>
											</div>
										<!-- <div class="voucher-col">
											<span class="vtext-input vtext-input-single vtext-input-medium clear coupon-align">
												<input type="text" name="coupon_code" placeholder="Enter Coupon Code" value="" height="100%">
											</span>
										</div> -->
										</form>
									</div>
								</div>
								@endif
							@if (session()->has('coupon'))
							<p class="summary-info total-info "><span class="title">Total</span><b class="index">₱{{ presentPrice($newSubtotal) }}</b></p>
							@else
							<p class="summary-info total-info "><span class="title">Total</span><b class="index">₱{{ Cart::subtotal() }}</b></p>
							@endif
							<a class="btn btn-checkout" href="{{ route('checkout.index') }}">PROCEED TO CHECKOUT</a>
							<a class="btn btn-continue" href="/shop">CONTINUE SHOPPING</a>
						</div>
					</div>
				</div>
				@else
				<div class="summary">
					<div class="order-summary">
						<h4 class="title-box"></h4>
						<center>There are no items in this cart
						<div class="checkout-info">
							<a class="btn btn-checkout" href="/shop">Continue Shopping <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
						</div></center>
						<p class="summary-info total-info "></p>
					</div>
				</div>
			@endif
			<!--	<div class="wrap-show-advance-info-box style-1 box-in-site">
					<h3 class="title-box">Most Viewed Products</h3>
					<div class="wrap-products">
						<div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="assets/images/products/digital_04.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item new-label">new</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
									<div class="wrap-price"><span class="product-price">$250.00</span></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="assets/images/products/digital_17.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item sale-label">sale</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
									<div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="assets/images/products/digital_15.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item new-label">new</span>
										<span class="flash-item sale-label">sale</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
									<div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="assets/images/products/digital_01.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item bestseller-label">Bestseller</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
									<div class="wrap-price"><span class="product-price">$250.00</span></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="assets/images/products/digital_21.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
									<div class="wrap-price"><span class="product-price">$250.00</span></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="assets/images/products/digital_03.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item sale-label">sale</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
									<div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="assets/images/products/digital_04.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item new-label">new</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
									<div class="wrap-price"><span class="product-price">$250.00</span></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="assets/images/products/digital_05.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item bestseller-label">Bestseller</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
									<div class="wrap-price"><span class="product-price">$250.00</span></div>
								</div>
							</div>
						</div>
					</div>
				</div> -->

			</div>
		</div><!--end container-->
		<!-- remove Cart -->
		<div class="modal fade" id="remove" tabindex="-1" role="dialog" aria-labelledby="smallModal" aria-hidden="true">
		  <div class="modal-dialog modal-sm centered">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h6 class="modal-title">Remove from cart</h6>
		      </div>
		       <form action="{{route('cart.destroy','cart')}}" method="post">
		      	{{method_field('delete')}}
					{{csrf_field()}}
		      <div class="modal-body">
		        <p>Item(s) will be removed from order</p>
		        <input type="hidden" name="cart_id" id="cart_id" value="">
		      </div>
		      <div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        	<button type="submit" id="removeCart" class="btn btn-danger">Remove</button>
		      </div>
	          </form>
		    </div>
		  </div>
		</div>
	</main>
@endsection
@section('script')
	<script src="{{ asset('/js/app.js') }}"></script>
    <script>
    	$(document).ready(function() {
    		$('.preloader').hide();
			$('body').removeClass('loading-data');
			$('body').removeClass('no-scroll');
			$('#remove').on('show.bs.modal', function (event) {
		      var button = $(event.relatedTarget) 
		      var cart_id = button.data('cartid') 
		      var modal = $(this)
		      modal.find('.modal-body #cart_id').val(cart_id);
			})
			$('.alert').delay(2500).fadeOut('slow');
    	});
        (function(){

        		// let delfunc = document.querySelectorAll('.delete')
        		// $(delfunc).on('click', '.btn-delete', function(event) {
        		// 	var _this = $(this),
        		// 		 _id = _this.attr('data-id');
        		// 	_this.closest('.pr-cart-item').remove();
        		// })
        	if($(".quantity-input").length > 0){
        		//quantityproduct
        		const classname = document.querySelectorAll('.quantity-input')
        		 $(classname).on('click', '.btn', function(event) {
        		 	$('.preloader').fadeIn('fast');
        		 	$(".preloader").removeAttr("style")
                    event.preventDefault();
                    var _this = $(this),
                        _input = _this.siblings('input[name=quantity]'),
                        _current_value = _this.siblings('input[name=quantity]').val(),
                        _max_value = _this.siblings('input[name=quantity]').attr('data-max');
                        _id = _this.siblings('input[name=quantity]').attr('data-id');
                    if(_this.hasClass('btn-reduce')){
                        if (parseInt(_current_value, 10) > 1)
                        {
                        	 _input.val(parseInt(_current_value, 10) - 1)
                        	 axios.patch(`/cart/${_id}`, {
	                        quantity: _this.value,
	                        productQuantity: _current_value - 1
		                    })
		                    .then(function (response) {
		                    	$('body').addClass('loading-data');
	                        	window.location.href = '{{ route('cart.index') }}'
	                    	})
                        }else{}
                    }else {
                        if(parseInt(_current_value, 10) < parseInt(_max_value, 10))
                        {

                        	 _input.val(parseInt(_current_value, 10) + 1)
	                        	// console.log(parseInt(_current_value, 10) + 1);
	                        	 axios.patch(`/cart/${_id}`, {
			                        quantity: _this.value,
			                        productQuantity: parseInt(_current_value, 10) + 1
			                    })
			                    .then(function (response) {
			                    	$('body').addClass('loading-data');
		                        	window.location.href = '{{ route('cart.index') }}'
		                    	})
                        }else{
                        	
                        }
                    }
        	});
            }else{
            }

        })();
    </script>
@endsection