<template>
<div>
  <gmap-map
    v-on:model="map"
    v-on:click="setMarker"
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
      :key="marker"
      @click="center=marker.position"
    ></gmap-marker>
  </gmap-map>
  <button v-on:click="validerResponse">Valider la sélection</button>
</div>
</template>

<script>
  import * as VueGoogleMaps from 'vue2-google-maps';
  import Vue from 'vue';

  Vue.use(VueGoogleMaps, {
    load: {
      key: 'AIzaSyDW6k5H-IUwCs5HrPIUWz0NWfC41fQWz2Y',
      v: '1.0',
    }
  });

  export default {
    name: 'Map',
    props: ['imageLatitude', 'imageLongituede', 'serieDist', 'points'],
    data () {
      return {
        center: {lat: 48.8574100, lng: 2.3338000},
        markers: [],
        map: '',
        realPosition: {},
        userPosition: {}
      }
    },
    methods: {
      setMarker(event){
        let newMarker = {
          position: {
            lat: event.latLng.lat(),
            lng: event.latLng.lng()
            }
        };
        this.markers.push(newMarker);
        this.realPosition = {lat:this.imageLatitude, lng:this.imageLongituede};
        this.userPosition = {lat: this.markers[this.markers.length-1].position.lat, lng: this.markers[this.markers.length-1].position.lng};
        this.evaluateDistance(this.getDistance(this.realPosition, this.userPosition));
      },
      validerResponse(){
        let newScore = this.evaluateDistance(this.getDistance(this.realPosition, this.userPosition));
        this.$store.commit('setScore', newScore);
        this.$store.commit('setEarned', newScore);
        window.bus.$emit('responseEmit');
      },
      getDistance(realPosition, userPosition) {
        var distance = google.maps.geometry.spherical.computeDistanceBetween(
          new google.maps.LatLng(realPosition.lat, realPosition.lng),
          new google.maps.LatLng(userPosition.lat, userPosition.lng));
          return distance;
      },
      evaluateDistance(distance){
        let d = parseFloat(distance);
        let s = parseFloat(this.serieDist);
        let score=0;
        if(d <= s){
          score=5;
        }else if(d <= (s * 2)){
          score=3;
        }else{
          score=1;
        }
        return score;
      }

    }
  }
</script>
