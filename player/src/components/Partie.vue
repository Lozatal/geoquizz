<template>
  <div>
    <Map :imageLatitude="imageLatitude" :imageLongituede="imageLongituede" :serieDist="serieDist"></Map>
    <Timer></Timer>
    <Picture :imageSource="photoEnCours"></Picture>
    <Score></Score>
    <button v-on:click="showPhoto">Photo suivante</button>
  </div>
</template>

<script>

import Map from '@/components/Map'
import Picture from '@/components/Picture'
import Score from '@/components/Score'
import Timer from '@/components/Timer'

export default {
  name: 'Partie',
  data () {
    return {
      partie: '',
      serie : '',
      photos : [],
      photosList : [],
      photoEnCours : '',
      photoIndex: 0,
      points: 0,
      imageLatitude: 0,
      imageLongituede: 0,
      serieDist: 0,
    }
  },
  components:{
    Map,
    Picture,
    Score,
    Timer
  },
  methods: {
    showPhoto(){
      if(this.photoIndex <= this.photosList.length-1){
        this.photoEnCours = this.photosList[this.photoIndex].url;
        this.imageLatitude = this.photosList[this.photoIndex].latitude;
        this.imageLongituede = this.photosList[this.photoIndex].longitude;
        this.$store.commit('setEarned', 0);
        this.photoIndex ++;

        var _this = this;
        let seconds = 0;
        setInterval(function(){ seconds++; _this.$store.commit('setTime', seconds);}, 1000);


      }else{
        console.log("fin de array");
      }
    },
    updateScore(tiempo){
      this.$store.commit('setTime', tiempo)
    }
  },
  mounted(){
    window.axios.get('parties/' + this.$route.params.id).then((response) => {
            this.partie = response.data;
            this.serie = response.data.serie;
            this.serieDist = response.data.serie.dist;
            this.photos = response.data.photos;
            this.photosList = response.data.photos;
            this.$store.state.score=0;
            this.showPhoto();

            window.bus.$emit('refreshDeco');
          }).catch((error) => {
              alert(error);
          });

    window.bus.$on('responseEmit', () => {
      console.log('partie responseEmit recus');
    })
  }
}
</script>

<style scoped>
  h1{color:green;}
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    #map {
      height: 100%;
      width: 50%;
      float: left;
    }
    #pic {
      height: 10%;
      width: 50%;
      float: left;
    }
    img{
      width: 80%;
      margin: 10%;
      padding: 10px;
      background-color: #f5f5f5;
      border: 1px solid #999999;
    }
    /* Optional: Makes the sample page fill the window. */
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
</style>
