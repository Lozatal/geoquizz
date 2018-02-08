<template>
  <gmap-map
    v-on:model="map"
    v-on:click="mostrarMensaje"
    :center="center"
    :zoom="13"
    :draggable="false"
    style="width: 50%; height: 900px"
  >
    <gmap-marker
      v-for="marker in markers"
      :position="marker.position"
      :clickable="true"
      :draggable="true"
      @click="center=marker.position"
    ></gmap-marker>
  </gmap-map>
</template>

<script>
  import * as VueGoogleMaps from 'vue2-google-maps';
  import Vue from 'vue';

  Vue.use(VueGoogleMaps, {
    load: {
      key: 'AIzaSyDW6k5H-IUwCs5HrPIUWz0NWfC41fQWz2Y',
      v: 'OPTIONAL VERSION NUMBER',
    }
  });

  export default {
    name: 'Map',
    data () {
      return {
        center: {lat: 48.8574100, lng: 2.3338000},
        markers: [],
        map: ''
      }
    },
    methods: {
      mostrarMensaje(event){
        let newMarker = {
          position: {
            lat: event.latLng.lat(),
            lng: event.latLng.lng()
            }
        };
        this.markers.push(newMarker);
      },
    }
  }
</script>
