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
div{
  display: flex;
  flex-wrap: wrap;
  width: 100%;
}
p{
  width: 25%;
  margin-left: 6.25%;
  text-align: center;
}
h3{
  width: 25%;
  text-align: center;
  margin-left: 6.25%;
}
</style>
