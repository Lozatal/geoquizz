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
    window.bus.$on('responseEmit', () => {
      window.bus.$emit('recupTimer', this.timeSpent);
    })
  }
}
</script>

<style scoped>
</style>
