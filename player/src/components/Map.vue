<template>
<div>
  <gmap-map
    id="map"
    v-on:model="map"
    v-on:click="setMarker"
    :center="center"
    :zoom="13"
    :draggable="false"
  >
    <gmap-marker
      v-for="(marker, idx) in markers"
      :position="marker.position"
      :clickable="true"
      :draggable="true"
      :key="idx"
      @click="center=marker.position"
    ></gmap-marker>
  </gmap-map>
  <button class="button is-link" v-on:click="validerResponse">Valider la sélection</button>
</div>
</template>

<script>
  import * as VueGoogleMaps from 'vue2-google-maps';
  import Vue from 'vue';

  Vue.use(VueGoogleMaps, {
    load: {
      key: 'AIzaSyDW6k5H-IUwCs5HrPIUWz0NWfC41fQWz2Y',
      libraries: 'geometry',
      v: '1.0',
    }
  });

  export default {
    name: 'Map',
    props: ['points'],
    data () {
      return {
        center: {lat: 0, lng: 0},
        markers: [],
        map: '',
        realPosition: {},
        userPosition: {},
        imageLatitude: 0,
        imageLongitude : 0,
        utilisateurAChoisit : false
      }
    },
    methods: {
      setMarker(event){
        if(this.utilisateurAChoisit == false){
          console.log('erf');
          console.log(this.utilisateurAChoisit);
          this.utilisateurAChoisit = true;
          this.markers = [];
          let newMarker = {
            position: {
              lat: parseFloat(event.latLng.lat()),
              lng: parseFloat(event.latLng.lng())
              }
          };
          
          this.markers.push(newMarker);
          this.realPosition = {lat:this.imageLatitude, lng:this.imageLongitude};

          this.userPosition = {lat: this.markers[this.markers.length-1].position.lat, lng: this.markers[this.markers.length-1].position.lng};
          
          this.evaluateDistance(this.getDistance(this.realPosition, this.userPosition));
          this.$emit('markerSet');
        }
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
        let userDistance = parseFloat(distance);
        let serieDistance = parseFloat(this.serie.dist);
        let score=0;
        if(userDistance <= serieDistance){
          score=5;
        }else if(userDistance <= (serieDistance * 2)){
          score=3;
        }else{
          score=1;
        }
        return score;
      }
    },
    mounted(){
      window.bus.$on('initMap', (serieOrigine) => {
        this.serie = serieOrigine;
        this.center = {
          lat:parseFloat(this.serie.serie_lat),
          lng:parseFloat(this.serie.serie_long)
        };
      })

      window.bus.$on('showPhoto', (image) => {
        this.markers = [];
        this.utilisateurAChoisit = false;
        this.imageLatitude = parseFloat(image.position_lat);
        this.imageLongitude = parseFloat(image.position_long);
      })
    }
  }
</script>

<style scoped>
div{
  max-width: 700px;
  margin: auto;
  border-radius: 5px;
  height: 100%;
  max-height: 700px;
  box-sizing: border-box;
}
#map{
  width:100%;
  height: 70vh;
  max-height: 700px;
  border: 5px solid hsl(217, 71%, 53%);
}
</style>
