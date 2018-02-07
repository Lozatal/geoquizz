Vue.component('map',{
  template: '<button v-on:click="alerta"><slot></slot></button>'
});

new Vue({
  el: '#App',
  data: {},
  methods: {
    alerta(){
      alert("WHAT ABOUT USSSS");
    }
  }

});
