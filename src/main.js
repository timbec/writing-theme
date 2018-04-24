import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './App.vue';
import Header from './globals/Header.vue';
import Footer from './globals/Footer.vue';
import { routes } from './routes';

Vue.use( VueRouter );

const router = new VueRouter({
   routes: routes,
   mode: 'history',
   base: '/'
});

Vue.component( 'app-header', Header );
Vue.component( 'app-footer', Footer );

new Vue({
  el: '#app',
  router: router,
  render: h => h(App)
});
