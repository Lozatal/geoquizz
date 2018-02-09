<template>
  <div>
    <h3>SCORE</h3>
    <p><b>Points gagnés : </b>{{ pointsEarned }}</p>
    <p><b>Points accumulés : </b>{{ valeurPoints }}</p>
  </div>
</template>

<script>
export default {
  name: 'Score',
  data () {
    return {
    }
  },
  computed :{
    valeurPoints() {
      return this.$store.state.score;
    },
    pointsEarned() {
      return this.$store.state.earned;
    },
  },
  methods: {
  },
  mounted(){
  }
}
</script>

<style scoped>
</style>
