<template>
	<tr>
		<td>{{ counter }}</td>
		<td>{{ partie.joueur }}</td>
		<td>{{ ville }}</td>
		<td>{{ partie.nb_photos }}</td>
		<td>{{ partie.score }}</td>
	</tr>
</template>

<script>
export default {
  name: 'HistoriquePartie',
  props : ['partie', 'listeSeries', 'counter'],
  data () {
    return {
    	serie : '',
    	ville : ''
    }
  },
  created(){
  	
	  this.listeSeries.forEach((s)=>{
		if(this.partie.id_serie === s.id){
			this.serie = s;
			this.ville = s.ville;
		}
	  });
	  /*
	window.axios.get('series/' + this.partie.id_serie ).then((response) => {
  		this.serie = response.data;
  		this.ville = this.serie.ville;
	}).catch((error) => {
	    alert(error);
	});*/
  }
}
</script>

<style scoped>
</style>
