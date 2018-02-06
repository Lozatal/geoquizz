<template>
  <form @submit="demarrerPartie">
    <input type='pseudo' v-model="pseudo" placeholder="Pseudo">
	<select v-model="serieId" v-on:change="villeChange">
		<option v-for="serie in series" v-bind:value="serie.id"  v-bind:label="serie.ville">{{serie.ville}}</option>
	</select>
	<input type="number" min="0" :max="nb_photos" v-model="nb_photos_choisis"/>
    <input type="submit" value="Démarrer">
  </form>
</template>

<script>
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
</style>
