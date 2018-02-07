<template>
	<nav class="navbar">
		<ul>
			<li><img src="@/assets/logo_chico.png"/></li>
    	<li><router-link to="/"><p>Accueil</p></router-link></li>
    	<li><router-link to="/historique"><p>Historique</p></router-link></li>
    </ul>
	</nav>
</template>

<script>
export default {
  name: 'NavBar',
  data () {
    return {
    }
  }
}
</script>

<style scoped>

a{
	display:flex;
	width:100%;
	height:100%;
	margin:auto;
	color: white;
	text-decoration: none;
	-webkit-transition-property: color;
	-webkit-transition-duration: 1s;
	-moz-transition-property: color;
	-moz-transition-duration: 1s;
	transition-property: color;
	transition-duration: 1s;
}
a:hover{
  color: red;
}

p{

	margin:auto;
}

nav{
  display: flex;
  flex-wrap: wrap;
  background-color: #34495e;
  box-sizing: border-box;
  width:100%;
  height:70px;
}

ul{
  display: flex;
  flex-wrap: wrap;
  width:100%;
  margin: auto;
  padding:0;
  height:100%;
}
li{
  box-sizing: border-box;
  text-align: center;
  list-style-type: none;
  height:100%;
  margin: auto;
  flex-direction: column; /* direction d'affichage verticale */
  justify-content: center; /* alignement vertical */
}
li:nth-child(1){
  width: 5%;
}
li:nth-child(2){
  width: 45%;
}
li:nth-child(3){
  width: 45%;
}
img{
  text-align:left;
}
p{
  font-size:2em;
}
</style>
