<template>
	<nav class="navbar">
		<ul>
			<li><img src="@/assets/logo_chico.png"/></li>
    	<li><router-link v-on:click.native="refreshDeco" to="/"><p>Accueil</p></router-link></li>
    	<li><router-link v-on:click.native="refreshDeco" to="/historique"><p>Historique</p></router-link></li>
      <li><button id='quitter' v-show="afficherDeconnecter" class="button is-danger" v-on:click="deleteToken"><p>Quitter</p></button></li>
    </ul>
	</nav>
</template>

<script>
export default {
  name: 'NavBar',
  data () {
    return {
      afficherDeconnecter: false
    }
  },
  methods : {
    deleteToken(){
      this.afficherDeconnecter = false;
      window.bus.$emit('deleteToken');
    },
    refreshDeco(){
      if(this.$store.state.token != null && this.$route.name === "partie"){
        this.afficherDeconnecter = true;
      }else{
        this.afficherDeconnecter = false;
      }
    }
  },
  mounted(){
    window.bus.$on('refreshDeco', () => {
      console.log('windows on');
      this.refreshDeco();
    })

    this.refreshDeco();
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
  transition-property: background-color;
  transition-duration: 1s;
}
a:hover{
  color: red;
  background-color:black;
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
  width: 20%;
}
li:nth-child(2){
  width: 30%;
}
li:nth-child(3){
  width: 30%;
}
li:nth-child(4){
  width: 20%;
  display:flex;
}
img{
  text-align:left;
}
p{
  font-size:1em;
  margin:auto;
}
#quitter{
  vertical-align: baseline;
  margin:auto;
}
button{
  box-sizing: border-box;
  width:100%;
  height:100%;
}

/* TABLETTE */
@media only screen and (min-width: 768px) {
  p{
    font-size:1.5em;
  }
}

/* BUREAU */
@media only screen and (min-width: 1024px) {

  a{
    width:40%;
  }

  p{
    font-size:2em;
  }
  li:nth-child(1){
  width: 10%;
  }
  li:nth-child(2){
    width: 40%;
  }
  li:nth-child(3){
    width: 40%;
  }
  li:nth-child(4){
    width: 10%;
    display:flex;
  }
}

</style>
