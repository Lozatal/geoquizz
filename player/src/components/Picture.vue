<template>
  <div>
    <img src="http://www.paisajesbonitos.org/wp-content/uploads/2016/01/paisajes-bonitos-de-mexico-Chichen-Itza-piramide-Templo-de-Kukulc%C3%A1n.jpg" alt="Mountain View" >
  </div>
</template>

<script>
export default {
  name: 'Picture',
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
  		console.log(this.nb_photos_choisis);
  		window.axios.post('parties', {
  	        nb_photos : this.nb_photos_choisis,
  	        joueur: this.pseudo,
  	        id_serie: this.serie.id
  	    }).then((response) => {
  	        this.$store.commit('setToken', response.data.token);

  	        window.axios.defaults.params.token = response.data.token;

  	        this.$router.push({ path: '/partie' });
  	    }).catch((error) => {
  	        alert(error);
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
