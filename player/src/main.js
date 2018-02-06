// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import store from './store.js'
import axios from 'axios'

Vue.config.productionTip = false

window.axios = axios.create({
  baseURL: 'http://localhost/html/geoquizz/backend/player/',
  params : {

  }
});
/*
store.subscribe((mutation, state) => {
	localStorage.setItem('store', JSON.stringify(state));
});
*/
window.bus = new Vue();

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store: store,
  components: { App },
  template: '<App/>'
})
