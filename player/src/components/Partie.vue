<template>
  <div>
    <h1>HOLIS</h1>
    <map></map>
  </div>
</template>

<script>

import Map from '@/components/Map'

export default {
  name: 'Index',
  data () {
    return {
    	pseudo: '',
    	nb_photos: 0,
    	nb_photos_choisis : '',
    	serieId: '',
    	serie: '',
    	series: [],
    	options: []
    }
  },
  components:{
    Map
  },
  methods: {
  	//On va récupérer la liste des images (sert surtout a avoir le nombre d'images de la liste en cours)
  	villeChange(){
  		let found = false;
  		let localSeries = this.series;
  		for(let i = 0; i < this.series.length; i++) {
  		    if (localSeries[i].id == this.serieId) {
  		    	this.serie = localSeries[i];
  		    	this.nb_photos = this.serie.nb_images;
  		        found = true;
  		        break;
  		    }
  		}
  	},
  	demarrerPartie(){
  		window.axios.post('parties', {
  	        nb_photos : this.nb_photos_choisis,
  	        joueur: this.pseudo,
  	        id_serie: this.serie.id
  	    }).then((response) => {
  	        //this.$store.state.member = response.data;
  	        this.$store.commit('setToken', response.data.token);

  	        window.axios.defaults.params.token = response.data.token;

  	        //this.$router.push({ path: '/conversation' });
  	    }).catch((error) => {
  	        alert(error.response.data.error);
  	    });
  	}
  },
  mounted(){
    window.axios.get('series').then((response) => {
              this.series = response.data;
              this.series.forEach((serie)=>{
              	this.options.push({
              		'id':serie.id,
              		'name':serie.ville
              	})
              });
            }).catch((error) => {
                alert(error);
            });
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
