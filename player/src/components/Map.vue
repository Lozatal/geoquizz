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
        utilisateurAChoisit : false,
        timer: 0
      }
    },
    methods: {

      //Sert a créer le marker, on préviens le parent que le résultat a été donné ce qui enclèche d'autres evenements
      setMarker(event){
        if(this.utilisateurAChoisit == false){
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
          this.$emit('markerSet');
          window.bus.$emit('responseEmit');
        }
      },
      validerResponse(){
        let newScore = this.evaluateDistance(this.getDistance(this.realPosition, this.userPosition));
        this.$store.commit('setScore', newScore);
        this.$store.commit('setEarned', newScore);

        //On va vérifier si le nombre d'image max n'est pas atteint
        this.$root.$emit('checkTermine');

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

        //On regarde le score de base en fonction du la justesse de la distance
        if(userDistance <= serieDistance){
          score=5;
        }else if(userDistance <= (serieDistance * 2)){
          score=3;
        }else if(userDistance <= (serieDistance * 3)){
          score=1;
        }

        //Puis on regarde en combien de temps l'utilisateur a choisit
        if(this.timer >15){
          score = score * 4;
        }else if(this.timer >10){
          score = score * 2;
        }else if(this.timer == 0){
          score = 0;
        }
        return score;
      }
    },
    mounted(){
      //On va initier la carte a l'emplacement de la série
      window.bus.$on('initMap', (serieOrigine) => {
        this.serie = serieOrigine;
        this.center = {
          lat:parseFloat(this.serie.serie_lat),
          lng:parseFloat(this.serie.serie_long)
        };
      })

      //A chaque changement de photos, on change les informations sur les images et on reset le/les markers
      window.bus.$on('showPhoto', (image) => {
        this.markers = [];
        this.utilisateurAChoisit = false;
        this.imageLatitude = parseFloat(image.position_lat);
        this.imageLongitude = parseFloat(image.position_long);
      })

      //dernière étape, on va calculer le score et l'envoyer a la partie
      window.bus.$on('recupTimer', (timer) => {
        this.timer = timer;
        this.validerResponse();
      })
    }
  }
</script>

<style scoped>
div{
  max-width: 800px;
  margin: auto;
  border-radius: 5px;
  height: 100%;
  max-height: 800px;
  box-sizing: border-box;
}
#map{
  width:100%;
  height: 50vh;
  max-height: 800px;
  border: 5px solid hsl(217, 71%, 53%);
}

/* bureau */
@media screen and (min-width: 1024px) {
  div{
    max-width: 800px;
    margin: auto;
    border-radius: 5px;
    height: 100%;
    max-height: 800px;
    box-sizing: border-box;
  }
  #map{
    width:100%;
    height: 90vh;
    max-height: 800px;
    border: 5px solid hsl(217, 71%, 53%);
  }
}
</style>
