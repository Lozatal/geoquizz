<template>
  <form @submit="demarrerPartie">
    <input type='pseudo' v-model="email" placeholder="email">
    <input type='password' v-model="password" placeholder="password">
    <input type="submit" value="Connexion">
    <router-link to="/membre-creation">Créer un compte</router-link>
  </form>
</template>

<script>
export default {
  name: 'Formulaire',
  data () {
    return {
      msg: 'Welcome to Your Vue.js App'
    }
  },
  mounted(){
  	window.axios.get('members', {
        fullname : this.fullname,
        email: this.email,
        password: this.password
      }).then((response) => {
        this.$router.push({path: '/connexion'});
      }).catch((error) => {
        alert(error);
      });
  }
}
</script>

<style scoped>
</style>
