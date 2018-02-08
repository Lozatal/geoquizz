<template>
	<div>
		<div class="field">
			<div class="control">
				<input class="input" type='pseudo' v-model="pseudoRecherche" placeholder="Recherche d'un joueur">
			</div>
		</div>
	</div>
</template>

<script>
export default {
  name: 'Historique',
  data () {
    return {
    	pseudoRecherche: ''
    }
  }
}
</script>

<style scoped>
</style>
