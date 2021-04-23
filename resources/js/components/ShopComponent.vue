<style type="text/css" scoped>
  
.cat-label 
{
  font-weight: 550!important;
    padding: 5px!important;
}
.row{
    background-color: #fff;
  }

.hideme
{
  visibility: hidden!important;
}
/** preloader End **/
.main-site
{
    background: #f5f5f5;
}
.seperator-line
{
  border-top: 1px solid #f1f1f1;
    zoom: 1;
  padding:10px;
  margin-top:20px;
}
.plist-item
{
      height: 105px;
    padding: 10px;
}
</style>
<template>
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
                <select name="orderby" class="use-chosen" id="sorting-items" v-model="selected.sortperitem">
                  <option value="default" selected="selected">Default sorting</option>
                  <option value="newness">Sort by newness</option>
                  <option value="price-asc">Sort by price: low to high</option>
                  <option value="price-desc">Sort by price: high to low</option>
                </select>
              </div>
              <div class="sort-item product-per-page">
                <select name="post-per-page" class="use-chosen" @change="sortpage()" v-model="selected.sortperpage">
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
                <a href="#" class="grid-mode display-mode" :class="{ 'active': gridName =='grid' }" @click.prevent="gridView('grid')"><i class="fa fa-th"></i>Grid</a>
                <a href="#" class="list-mode display-mode" :class="{ 'active': gridName =='list' }" @click.prevent="gridView('list')"><i class="fa fa-th-list"></i>List</a>
              </div>
            </div>
          </div>
            <div class="seperator-line"></div>
          <div class="row" v-if="gridview">
            <div class="p-1">
              <ul class="product-list grid-products equal-container">
              <li class="col-lg-3 col-md-4 col-sm-6 col-xs-6" v-for="product in products.data">
                <div class="product product-style-2 equal-elem ">
                  <div class="product-thumnail">
                    <a :href="'/shop/' + product.slug">
                        <figure><img :src="product.image" width="800" height="800"></figure>
                      </a>
                    <div class="group-flash">
                      <span class="flash-item new-label" v-if="product.new === '1'">New</span>
                      <span class="flash-item bestseller-label" v-if="product.promo === '1'">Promo</span>
                      <span class="flash-item sale-label" v-if="product.sale === '1'">Sale</span>
                    </div>
                  </div>
                  <div class="product-info">
                      <a :href="'/shop/' + product.slug" class="product-name"><span>{{ product.product_name }}</span>
                      <div class="wrap-price">
                        <ins>
                          <p class="product-price">₱{{ product.regular_price }}</p>
                        </ins>
                        <del>
                          <p class="product-price" v-if="product.sale_price !== '0.00'">
                           {{ product.sale_price}}
                          </p>
                        </del>
                      </div>
                      </a>
                    </div>
                </div>
              </li>
              </ul>
            </div>
          </div>
          <div class="widget mercado-widget widget-product" v-else>
            <div class="widget-content">
              <ul class="products">
                <!-- foreach new products -->
                <li class="product-item plist-item" v-for="product in products.data">
                      <a :href="'/shop/' + product.slug">
                  <div class="product product-widget-style" style="height: unset!important">
                    <div class="thumbnnail" style="padding-bottom: 0px !important;">
                        <figure><img :src="product.image" alt=""></figure>
                    </div>
                    <div class="product-info">
                      <a href="#" class="product-name"><span>{{ product.product_name }}</span></a>
                      <div class="wrap-price">
                        <span class="product-price">₱{{ product.regular_price }}</span>
                        <del>
                          <p class="product-price" v-if="product.sale_price !== '0.00'">
                           {{ product.sale_price}}
                          </p>
                        </del>
                      </div>
                    </div>
                  </div>
                      </a>
                </li>
                <!-- end -->
              </ul>
            </div>
          </div>
         <!-- pagination -->
         <div class="wrap-pagination-info">
         <pagination :data="this.products" @pagination-change-page="getResults" class="float-right"></pagination>
        </div>
        </div><!--end main products area-->

        <input type="hidden" name="datasearch" v-model="selected.dataget">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
          <div class="widget mercado-widget filter-widget brand-widget">
            <h2 class="widget-title">Categories</h2>
            <div class="widget-content">
              <ul class="list-style vertical-list list-limited" data-show="6">
               <!-- foreach category -->
                  <li v-for="(category, index) in categories" class="list-item" :class="{ 'default-hiden': index >= 7}" >
                    <input class="form-check-input filter-link" type="checkbox" :value="category.id" :id="'category'+index" v-model="selected.categories">
                    <label class="form-check-label cat-label" :for="'category' + index">
                        {{ category.category_name }} ({{ category.products_count }})
                    </label>
                  </li>
                  <!-- <li class="list-item default-hiden"><a class="filter-link " href="#">cat 2</a></li> -->
              <!-- end -->
                <li class="list-item"><a data-label='Show less<i class="fa fa-angle-up" aria-hidden="true"></i>' class="btn-control control-show-more" href="#">Show more<i class="fa fa-angle-down" aria-hidden="true"></i></a></li>
              </ul>
            </div>
          </div>
          
          <div class="widget mercado-widget widget-product">
            <h2 class="widget-title">New Products</h2>
            <div class="widget-content">
              <ul class="products">
                <!-- foreach new products -->
                <li class="product-item" v-for="product in productsnew.data">
                  <a :href="'/shop/' + product.slug">
                  <div class="product product-widget-style">
                    <div class="thumbnnail">
                        <figure><img :src="product.image" alt=""></figure>
                    </div>
                    <div class="product-info">
                      <span class="product-name">{{ product.product_name }}</span>
                      <div class="wrap-price">
                        <span class="product-price">₱{{ product.regular_price }}</span>
                        <del>
                          <p class="product-price" v-if="product.sale_price !== '0.00'">
                           {{ product.sale_price}}
                          </p>
                        </del>
                      </div>
                    </div>
                  </div>
                  </a>
                </li>
                <!-- end -->
              </ul>
            </div>
          </div>

        </div>

      </div>

    </div>
</template>
<script>
    export default {
       data() {
            return {
                gridview: true,
                gridName: 'grid',
                prices: [],
                categories: [],
                products: {},
                productsnew: {},
                loading: true,
                selected: {
                    prices: [],
                    categories: [],
                    sortperpage: '12',
                    sortperitem: 'default',
                    dataget: this.datasearch,
                },
            }
        },
      props: ['datasearch', 'csrf_token'],
        mounted() {
            this.loadProducts();
            this.loadNewProducts();
            this.loadCategories();
            console.log(this.datasearch);
        },
         watch: {
            selected: {
                handler: function () {
                    this.loadProducts();
                },
                deep: true
            },
        },
        methods: {
          sortpage() {
                return this.selected.sortperpage
            },
          loadCategories: function () {
                axios.get('/api/category/get/list', {
                        params: _.omit(this.selected, 'categories')
                    })
                    .then((response) => {
                        this.categories = response.data.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            loadProducts: function () {
              $('.preloader').css("visibility","");
                axios.get('/api/products/get/list', {
                        params: this.selected,
                        datasearch: this.datasearch
                    })
                    .then((response) => {
                      // console.log(response.data.data);
                        this.products = response.data;
                        $('.preloader').css("visibility","hidden");
                        this.loading = false;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            loadNewProducts: function () {
              $('.preloader').css("visibility","");
                axios.get('/api/products/get/new')
                    .then((response) => {
                      // console.log(response.data.data);
                        this.productsnew = response.data;
                        $('.preloader').css("visibility","hidden");
                        this.loading = false;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            getResults(page = 1) {
              $('.preloader').css("visibility","");
              this.loading = true;
              axios.get('api/products/get/list?page=' + page, {
                params: this.selected, 
                sortparam: this.sortperpage
              })
                  .then(response => {
                      this.products = response.data;
                      this.loading = false;
                      $('.preloader').css("visibility","hidden");
                  });
          },
          gridView(grid)
          {
            if(grid == 'grid')
            {
              this.gridview = true;
              this.gridName = 'grid';
            }
            if(grid == 'list')
            {
              this.gridview = false;
              this.gridName = 'list';
            }
          }
        }
    }
</script>
