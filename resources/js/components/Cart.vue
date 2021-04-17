<template>
    <div class="container">

      <div class="wrap-breadcrumb">
        <ul>
          <li class="item-link"><a href="/" class="link">home</a></li>
          <li class="item-link"><span>Cart</span></li>
        </ul>
      </div>
      <div class=" main-content-area">
        <div class="wrap-iten-in-cart">
          <h3 class="box-title">Products Name</h3>
          <ul class="products-cart">
              <li class="pr-cart-item" v-for="cart in carts">
                <div class="product-image">
                  <figure><img :src="`${cart.model.image}`" alt=""></figure>
                </div>
                <div class="product-name">
                  <a class="link-to-product" href="#">{{cart.name}}</a>
                </div>
                <div class="price-field product-price"><p class="price">₱{{cart.price}}.00</p></div>
                <div class="quantity">
                  <div class="quantity-input">
                    <input type="text" class="quantityproduct" name="quantity" value="1" v-model="cart.qty" data-max="120" pattern="[0-9]*" readonly>                 
                    <a class="btn btn-increase" href="#" ></a>
                    <a class="btn btn-reduce" href="#" @click="decreaseCart(cart.rowId)"></a>
                  </div>
                </div>
                <div class="price-field sub-total"><p class="total_price">₱{{cart.subtotal}}</p></div>
                <div class="delete">
                  <a href="#" class="btn btn-delete" title="">
                    <span>Delete from your cart</span>
                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                  </a>
                </div>
              </li>                  
          </ul>
        </div>

        <div class="summary">
          <div class="order-summary">
            <h4 class="title-box">Order Summary</h4>
            <p class="summary-info"><span class="title">Subtotal</span><b class="index">$512.00</b></p>
            <p class="summary-info"><span class="title">Shipping</span><b class="index">Free Shipping</b></p>
            <p class="summary-info total-info "><span class="title">Total</span><b class="index">$512.00</b></p>
          </div>
          <div class="checkout-info">
            <label class="checkbox-field">
              <input class="frm-input " name="have-code" id="have-code" value="" type="checkbox"><span>I have promo code</span>
            </label>
            <a class="btn btn-checkout" href="checkout.html">Check out</a>
            <a class="link-to-shop" href="shop.html">Continue Shopping<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
          </div>
          <div class="update-clear">
            <a class="btn btn-clear" href="#">Clear Shopping Cart</a>
            <a class="btn btn-update" href="#">Update Shopping Cart</a>
          </div>
        </div>

        <div class="wrap-show-advance-info-box style-1 box-in-site">
          <h3 class="title-box">Most Viewed Products</h3>
          <div class="wrap-products">
            <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >

              <div class="product product-style-2 equal-elem ">
                <div class="product-thumnail">
                  <a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                    <!-- <figure><img src="assets/images/products/digital_04.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure> -->
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
                    <!-- <figure><img src="assets/images/products/digital_17.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure> -->
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
                    <!-- <figure><img src="assets/images/products/digital_15.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure> -->
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
                    <!-- <figure><img src="assets/images/products/digital_01.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure> -->
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
                    <!-- <figure><img src="assets/images/products/digital_21.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure> -->
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
                    <!-- <figure><img src="assets/images/products/digital_03.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure> -->
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
                    <!-- <figure><img src="assets/images/products/digital_04.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure> -->
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
                    <!-- <figure><img src="assets/images/products/digital_05.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure> -->
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
          </div><!--End wrap-products-->
        </div>

      </div><!--end main content area-->
    </div>
</template>
<script>

    export default {
      data(){
            return {
                carts: {},
                quantity: 2,
            }
        },
        mounted() {
            this.loadCartlist();
            
        },
        methods: {
          increaseCart(rowId, qty)
          {
            console.log(rowId);
            var count = 1;
            // axios.post("/cart-update/"+rowID+"/1")
            //     .then(response => {
            //       console.log("viva");
            //     });
          },
          decreaseCart(id)
          {

          },
           loadCartlist()
            {
              axios.get("/cart/data-list")
                .then(response => {
                  // console.log(response.data);
                    this.carts = response.data.cart;
                    console.log(response.data.cart);
                });
            },
        }
    }
</script>
