<template>
	<div id="formulaire" class="box">
		<h1 class="title">Déroulement d'une partie</h1>
		<div id="regle">
			<ul>
				<li>Choisissez un pseudo, une zone géographique et un nombre d'images</li>
				<li>Une photo d'un lieu de cette zone va vous être présentée</li>
				<li>Sur la carte de la ville, choisir où se trouve ce lieu</li>
				<li>En fonction de la justesse de vos réponses et de votre rapiditée, vous gagnez des points</li>
				<li>A la fin de la partie, votre résultat vous est fournit</li>
			</ul>
		</div>
		<h1 class="title secondTitre">Démarrer une partie</h1>
		<form @submit="demarrerPartie">
			<div class="field">
				<label class="label">Pseudo :</label>
				<div class="control">
					<input class="input" type='pseudo' v-model="pseudo" placeholder="Pseudo" required>
				</div>
			</div>
			<div class="field">
				<label class="label">Lieu du quizz :</label>
				<div class="control">
					<div class="select">
						<select v-model="serieId" v-on:change="villeChange" required>
							<option value="" disabled selected>Lieu du quizz</option>
							<option v-for="serie in series" v-bind:value="serie.id"  v-bind:label="serie.ville">{{serie.ville}}</option>
						</select>
					</div>
				</div>
			</div>
			<div class="field">
				<label class="label">Nombre de photos dans le quizz:</label>
				<div class="control">
					<input class="input" type="number" min="1" :max="nb_photos" v-model="nb_photos_choisis" placeholder="Nombre de photos dans le quizz" required/>
				</div>
			</div>
			<div class="control">
				<input class="button is-link" type="submit" value="Démarrer">
			</div>
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
  		window.axios.post('parties', {
  	        nb_photos : this.nb_photos_choisis,
  	        joueur: this.pseudo,
  	        id_serie: this.serie.id
  	    }).then((response) => {
  	        this.$store.commit('setToken', response.data.token);

  	        window.axios.defaults.params.token = response.data.token;

  	        this.$router.push({ path: '/partie/' + response.data.id });
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
	width:60%;
	margin:auto;
	text-align: center;
	background-color: #EEF0F1;
	margin-top:10px;
}
label{
	width:50%;
	text-align:left;
}
h1{
	font-size:2em;
}
ul{
	list-style-type: square;
}
li{
	width:80%;
	text-align: left;
	margin-left:20px;
}
input{
	width:20em;
}
.secondTitre{
	margin-top:20px;
}
</style>
