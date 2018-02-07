// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import store from './store.js'
import axios from 'axios'

Vue.config.productionTip = false
<<<<<<< HEAD
//player.geoquizz.local:10081/parties
=======

//http://localhost/html/geoquizz/backend/player/
//http://player.geoquizz.local:10081/

>>>>>>> 51d0a5a1c3720838a48b35a71504c672607ad7c0
window.axios = axios.create({
  baseURL: 'http://player.geoquizz.local:10081/',
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
