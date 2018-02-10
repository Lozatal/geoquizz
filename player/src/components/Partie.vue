<template>
  <div id="partie">
    <section id="map">
      <Map v-on:markerSet="stopTimer"></Map>
    </section>
    <section id="picScore">
      <Picture id="pic" :image="photoEnCoursUrl"></Picture>
      <Score id="score"></Score>
      <Timer id="timer"></Timer>
      <button v-if="partieEnCours" class="button is-link" v-on:click="showPhoto">Photo suivante</button>
      <div v-else>
        <p>Partie terminée : </p>
        <button class="button is-link" v-on:click="enregistrePartie">Enregistrer le résultat</button>
      </div>
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
      nbImageTraite : 1,
      myTimer: '',
      partieEnCours: true
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

      this.stopTimer();

      //On récupère un chiffre random entre 0 le nombre d'images totale -1
      let nombreImageTotal = this.photos.length;
      // -1 car les tableaux commencent a 0
      let index = Math.floor((Math.random() * nombreImageTotal) + 1) -1;

      //seulement si il y a des images de disponible ou que l'on a pas atteint la limite
      if(nombreImageTotal >= 0 && this.partie.nb_photos >= this.nbImageTraite){
        this.photoEnCoursUrl = '';
        this.photoEnCours = this.photos[index];
        this.photoEnCoursUrl = this.photoEnCours.url;

        //On supprime la photo de la liste
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
    },
    checkTermine(){
      console.log('checktermine arrivé');
      if(this.nbImageTraite >= this.partie.nb_photos){
        console.log('inside if');
        this.partieEnCours = false;
      }
    }
  },
  mounted(){

    //reset des variables
    this.$store.commit('resetScore');
    this.$store.commit('setEarned', 0);

    //On récupère les informations de la partie
    window.axios.get('parties/' + this.$route.params.id).then((response) => {
            this.partieEnCours = true;
            this.partie = response.data;
            this.serie = response.data.serie;
            this.photos = response.data.photos;
            this.$store.state.score=0;
            this.showPhoto();

            window.bus.$emit('initMap', this.serie);

            window.bus.$emit('refreshDeco');
          }).catch((error) => {
              console.log(error);
          });

    //On va vérifier a chaque fin d'image si la partie est terminé pour changé le bouton
    this.$root.$on('checkTermine', () => {
      this.checkTermine();
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
      flex-wrap: wrap;
      margin-top: 1em;
      width:100%;
    }
    #map {
      order: 2;
      margin: auto;
      width: 80%;
      height: 100%;
      max-height: 700px;
    }
    #picScore {
      order: 1;
      margin: auto;
      width: 80%;
      display:flex;
      flex-wrap:wrap;
      height: 100%;
      max-height: 700px;
      box-sizing: border-box;
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

    /* bureau */
    @media screen and (min-width: 1024px) {
      #partie{
        display:flex;
        flex-wrap: wrap;
        margin-top: 1em;
        width:100%;
      }
      #map{
        order: 1;
        width: 45%;
        margin: auto;
        margin-left: 3.333333%;
      }
      #picScore{
        order: 2;
        width: 45%;
        margin: auto;
        margin-left: 3.333333%;
      }
    }

</style>
