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
      :key="index"
      v-for="(m, index) in markers"
      :position="m.position"
      :clickable="true"
      :draggable="true"
      @click="center=m.position"
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
        //console.log(event.latLng.lat());
        //console.log(event.latLng.lng());
        //placeMarkerAndPanTo(event, map);
        let newMarker = {
          position: {
            lat: event.latLng.lat(),
            lng: event.latLng.lng()
            }
        };
        this.markers.push(newMarker);
      }/*,
      placeMarkerAndPanTo(event, map) {
        var marker = new google.maps.Marker({
          position: event,
          map: map
          });
      }*/
    }
  }
</script>
