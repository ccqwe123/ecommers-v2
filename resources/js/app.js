/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import moment from 'moment';
window.moment = moment;
import { Form, HasError, AlertError } from 'vform'
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
import VueRouter from 'vue-router'

Vue.use(VueRouter)
import Vue2Editor from "vue2-editor";
Vue.use(Vue2Editor);
Vue.component('pagination', require('laravel-vue-pagination'));

import swal from 'sweetalert2';
window.swal = swal;

const toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

window.toast = toast;
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));


let routes = [
  { path: '/dashboard', component: require('./components/Dashboard.vue').default },
  { path: '/products', component: require('./components/Products.vue').default },
  { path: '/orders', component: require('./components/Orders.vue').default },
  { path: '/category', component: require('./components/Category.vue').default },
  { path: '/main-banner', component: require('./components/MainBanner.vue').default },
  { path: '/product-banner', component: require('./components/ProductBanner.vue').default },
  { path: '/product-category-banner', component: require('./components/ProductCategoryBanner.vue').default },
  { path: '/users', component: require('./components/Users.vue').default }
]

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('cart-component', require('./components/Cart.vue').default);
Vue.component('shop-component', require('./components/ShopComponent.vue').default);
// Vue.component('product', require('./components/Product.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.filter('humanDate',function(created){
    return moment(created).format('MMMM Do YYYY');
});

const router = new VueRouter({
	mode: 'history',
  	routes
})

const app = new Vue({
    el: '#app',
    router
});
