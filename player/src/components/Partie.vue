<template>
  <div id="partie">
    <section id="map">
      <Map v-on:markerSet="stopTimer"></Map>
    </section>
    <section id="picScore">
      <Picture id="pic" :image="photoEnCoursUrl"></Picture>
      <Score id="score"></Score>
      <Timer id="timer"></Timer>
      <button class="button is-link" v-on:click="showPhoto">Photo suivante</button>
    </section>
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
      photoEnCoursUrl : '',
      photoEnCours : '',
      points: 0,
      nbImageTraite : 0,
      myTimer: ''
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
      //On récupère un chiffre random entre 0 le nombre d'images totale -1
      let nombreImageTotal = this.photos.length;
      // -1 car les tableaux commencent a 0
      let index = Math.floor((Math.random() * nombreImageTotal) + 1) -1;

      //seulement si il y a des images de disponible
      if(nombreImageTotal >= 0 && this.partie.nb_photos >= this.nbImageTraite){
        this.photoEnCoursUrl = '';
        this.photoEnCours = this.photos[index];
        this.photoEnCoursUrl = this.photoEnCours.url;

        //On supprimer la photo de la liste
        this.photos.splice(index, 1);
        this.nbImageTraite++;

        //On envoye l'event a la map
        window.bus.$emit('showPhoto', this.photoEnCours);

        this.$store.commit('setEarned', 0);

        var _this = this;
        let seconds = 20;
        this.myTimer = setInterval(function(){
          console.log("RANDOM");
          if(seconds > 0){
            seconds--;
          }else{
            _this.stopTimer();
            _this._showPhoto();
          }
          _this.$store.commit('setTime', seconds);}, 1000);
      }else{
        console.log("fin de array");
      }
    },
    stopTimer(){
      clearInterval(this.myTimer);
    },
    _showPhoto(){
      this.showPhoto();
    },
    updateScore(tiempo){
      this.$store.commit('setTime', tiempo)
    }
  },
  mounted(){
    window.axios.get('parties/' + this.$route.params.id).then((response) => {
            this.partie = response.data;
            this.serie = response.data.serie;
            this.photos = response.data.photos;
            this.$store.state.score=0;
            this.showPhoto();

            window.bus.$emit('initMap', this.serie);

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
    #partie{
      display:flex;
      width:100%;
    }
    #map {
      height: 100%;
      width: 50%;
    }
    #picScore {
      height: 700px;
      width: 50%;
      display:flex;
      flex-wrap:wrap;
    }
    #pic{
      margin:auto;
      width:100%;
      display:flex;
    }
    #score{
      width:100%;
    }
    #timer{
      width:100%;
      text-align:center;
    }
    img{
      width: 80%;
      margin: 10%;
      padding: 10px;
      background-color: #f5f5f5;
      border: 1px solid #999999;
    }
    button{
      margin:auto;
    }

</style>
