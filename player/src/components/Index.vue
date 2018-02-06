<template>
  <form @submit="demarrerPartie">
    <input type='pseudo' v-model="pseudo" placeholder="Pseudo">
    <input v-model="serie" list="serieslist" v-on:input="villeChange" placeholder="Choisissez la ville ..."/>
  	<datalist id="serieslist">
    	<option v-for="serie in series" v-bind:value="serie.ville"  v-bind:label="serie.ville"></option>
	</datalist>
	<input type="number" min="0" v-max="{{ serie./>
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
    	serie: '',
    	series: []
    }
  },
  methods: {
  	villeChange(){

  		},
  	demarrerPartie(){
		window.axios.post('parties', {
	        nb_photos : this.nb_photos,
	        joueur: this.pseudo,
	        id_serie: this.serie.id
	    }).then((response) => {
	        //this.$store.state.member = response.data;
	        this.$store.commit('setMember', response.data);
	        this.$store.commit('setToken', response.data.token);

	        window.axios.defaults.params.token = response.data.token;

	        this.$router.push({ path: '/conversation' });
	    }).catch((error) => {
	        alert(error.response.data.error);
	    });
  	}
  },
  mounted(){
    window.axios.get('series').then((response) => {
              this.series = response.data;
            }).catch((error) => {
                alert(error);
            });
  }
}
</script>

<style scoped>
</style>
