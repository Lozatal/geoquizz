<template>
  <div>
    <p><b>Temps : </b>{{ timeSpent }}</p>
  </div>
</template>

<script>
export default {
  name: 'Timer',
  data () {
    return {
      timer: 60
    }
  },
  computed :{
    timeSpent() {
      return this.$store.state.time;
    }
  },
  methods: {
  },
  mounted(){

    //sert a récupérer le temps émis
    window.bus.$on('responseEmit', () => {
      window.bus.$emit('recupTimer', this.timeSpent);
    })
  }
}
</script>

<style scoped>
</style>
