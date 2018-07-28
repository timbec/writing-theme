import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './App.vue';
import Header from './globals/Header.vue';
import Menu from './globals/Menu.vue';
import Footer from './globals/Footer.vue';
import BackToTop from './globals/SubComponents/BackToTop.vue';
import { routes } from './routes';

Vue.use( VueRouter );

const router = new VueRouter({
   routes: routes,
   mode: 'history',
   base: '/'
});

Vue.component( 'app-header', Header );
Vue.component( 'app-menu', Menu );
Vue.component( 'app-footer', Footer );
Vue.component( 'app-back-to-top', BackToTop );

new Vue({
  el: '#app',
  router: router,
  render: h => h(App)
});
