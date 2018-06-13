import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import router from './router/'
import store from './store/'
import axios from 'vue-axios'
import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue);
/// application specific 


Vue.config.productionTip = false

Vue.use(VueRouter);

new Vue({
  el: '#vueApp',
  router,
  axios,
  store,
  template: '<App/>',
  components: { App }
})