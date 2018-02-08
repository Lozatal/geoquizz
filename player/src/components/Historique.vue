<template>
	<div id="historique" class="box">
		<h1 class="title">Tableau des scores</h1>
		<form @submit="recherche">
			<input class="input" type='pseudo' v-model="pseudoRecherche" placeholder="Recherche d'un joueur" />
			<input class="button is-link" type="submit" value="Rechercher">
		</form>
		<div id="tableau">
			<table class="table">
				<thead>
					<tr>
						<th>Position</th>
						<th>Pseudo</th>
						<th>Série</th>
						<th>Nombre de photos</th>
						<th>Score</th>
					</tr>
				</thead>
				<tbody>
					<historiquePartie v-if="listeParties != null" v-for="partie in listeParties" :partie="partie" :key="partie.id" :listeSeries = "listeSeries" :counter = 'counter++'>	
					</historiquePartie>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>

import HistoriquePartie from '@/components/HistoriquePartie'

export default {
  name: 'Historique',
  data () {
    return {
    	pseudoRecherche: '',
    	listeParties: [],
    	listeSeries:[],
    	counter: 1
    }
  },
  components : {
  	HistoriquePartie
  },
  methods : {
  	recherche(){
  		//On réinitialise les données pour êtes sur que les composants sont bien remplacés (sert pour le counter)
  		this.counter = 1;
  		this.listeParties = [];
  		//On a joueur a recherche
  		if(this.pseudoRecherche != ''){
  			this.rechercheJoueur();
  		//recherche de base
  		}else{
  			this.rechercheGeneral();
  		}
  	},
  	//On va recherché un joueur en particulier
  	rechercheJoueur(){
  		window.axios.get('parties/player/' + this.pseudoRecherche ).then((response) => {
      		this.listeParties = response.data;
		}).catch((error) => {
		    alert(error);
		});
  	},

  	rechercheGeneral(){
  		window.axios.get('series').then((response) => {
  			this.listeSeries = response.data;
	  		//On récupère la liste des parties
			window.axios.get('parties').then((response) => {
		  		this.listeParties = response.data;
			}).catch((error) => {
			    alert(error);
			});
		}).catch((error) => {
		    alert(error);
		});
  	}
  },
  created(){
	this.rechercheGeneral();
  }
}
</script>

<style scoped>
#historique{
	width:100%;
	margin:auto;
	text-align: center;
	background-color: #EEF0F1;
	margin-top:10px;
}
#tableau{
	display:flex;
	width:100%;
	overflow: auto;
    white-space: nowrap;

}
h1{
	font-size:2em;
	margin-top:10px;
	margin-bottom:10px;
}
table{
	margin:auto;
}
form{
	width:100%;
	display:flex;
	margin:auto;
}
tr{
	background-color: #EEF0F1;
}

/* TABLETTE */
@media only screen and (min-width: 768px) {
	#historique{
		width:60%;
	}
	#tableau{
		width:60%;
	}
	form{
	width:50%;
	display:flex;
	margin:auto;
	}
}
</style>
