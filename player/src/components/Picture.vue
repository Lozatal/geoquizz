<template>
    <div>
      <img :src="image"></img>
    </div>
</template>

<script>
export default {
  name: 'Picture',
  props: ['image'],
  data () {
    return {
    }
  },
  methods: {
  }
}
</script>

<style scoped>
  div{
    height:70vh;
    display: flex;
  }
  img{
    height:100%;
    max-height: 650px;
    margin:auto;
    box-sizing:border-box;
  }
  /* bureau */
  @media screen and (min-width: 1024px) {
    div{
      height:50vh;
      display: flex;
    }
    img{
      height:100%;
      max-height: 650px;
      margin:auto;
      box-sizing:border-box;
    }
  }
</style>
