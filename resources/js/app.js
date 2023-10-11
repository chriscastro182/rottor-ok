require('./bootstrap');

import BootstrapVue from 'bootstrap-vue'
import VueCookies from 'vue-cookies'
import LinGallery from 'lingallery';

Vue.use(BootstrapVue);
Vue.use(VueCookies);
Vue.component('lingallery', LinGallery);


Vue.component('contactform-component', require('./components/ContactFormComponent.vue').default);
Vue.component('loginform-component', require('./components/customer/LoginFormComponent.vue').default);
Vue.component('helpform-component', require('./components/customer/HelpFormComponent.vue').default);

Vue.component('sell-component', require('./components/product/SellComponent.vue').default);

Vue.component('brand-model-component', require('./components/product/ProductBrandModelComponent.vue').default);
Vue.component('brand-model-version-component', require('./components/product/ProductBrandModelVersionEditComponent.vue').default);

Vue.component('product-gallery-component', require('./components/product/ProductGalleryComponent.vue').default);
Vue.component('product-appointment-component', require('./components/product/ProductAppointmentComponent.vue').default);
Vue.component('product-quote-component', require('./components/product/ProductsQuote.vue').default);
Vue.component('product-quotecc-component', require('./components/product/ProductQuoteCC.vue').default);
Vue.component('product-quotekm-component', require('./components/product/ProductsQuoteKM.vue').default);
Vue.component('product-quotedate-component', require('./components/product/ProductsQuoteDate.vue').default);

Vue.component('product-list', require('./components/product/ProductList.vue').default);

Vue.component('market-brand-quote', require('./components/market/MarketBrandQuote.vue').default);

Vue.component('quote-brands', require('./components/quote/QuoteBrands.vue').default);
Vue.component('quote-versions', require('./components/quote/QuoteVersions.vue').default);
Vue.component('quote-cc', require('./components/quote/QuoteCC.vue').default);


Vue.$cookies.config('7d');
/**
 ** Next, we will create a fresh Vue application instance and attach it to
 ** the page. Then, you may begin adding components to this application
 ** or customize the JavaScript scaffolding to fit your unique needs.
 **/

const app = new Vue({
	    el: '#app',
});

