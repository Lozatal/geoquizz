<template>
	<div id="formulaire">
		<h1 class="title">Démarrer une partie</h1>
		<h2>Déroulement d'une partie :</h2>
		<ul>
			<li>Choisissez un pseudo, une ville et un nombre d'images</li>
			<li>Une photo d'un lieu va vous être présentée</li>
			<li>Sur la carte de la ville, choisir où se trouve ce lieu</li>
			<li>En fonction de la justesse de vos réponses et de votre rapiditée, vous gagnez des points</li>
			<li>A la fin de la partie, votre résultat vous est fournit</li>
		</ul>
		<form @submit="demarrerPartie">
			<div>
				<label>Pseudo :</label>
				<input type='pseudo' v-model="pseudo" placeholder="Pseudo" required>
			</div>
			<div>
				<label>Ville :</label>
				<select v-model="serieId" v-on:change="villeChange" required>
					<option v-for="serie in series" v-bind:value="serie.id"  v-bind:label="serie.ville">{{serie.ville}}</option>
				</select>
			</div>
			<div>
				<label>Nombre de photos :</label>
				<input type="number" min="1" :max="nb_photos" v-model="nb_photos_choisis" required/>
			</div>
			<input type="submit" value="Démarrer">
		</form>
	</div>
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
#formulaire{
	width:40%;
	margin:auto;
	text-align: center;
	border:1px black solid;
	margin-top:10px;
}
form>div{
	display:flex;
	width:100%;
	margin-top:10px;
}
label{
	width:50%;
	text-align:right;
}
h1{
	font-size:2em;
}
h2{
	border-top:black 1px solid;;
}
ul{
	list-style-type: square;
	border-bottom:black 1px solid;
}
li{
	width:80%;
	text-align: left;
	margin-left:20px;
}
</style>
