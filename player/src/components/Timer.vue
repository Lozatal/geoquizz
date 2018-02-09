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
      console.log('timer responseEmit recus');
    })
  }
}
</script>

<style scoped>
</style>
