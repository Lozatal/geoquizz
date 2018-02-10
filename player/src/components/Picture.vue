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
    height:80%;
    display: flex;
  }
  img{
    height:100%;
    margin:auto;
    box-sizing:border-box;
  }
</style>
