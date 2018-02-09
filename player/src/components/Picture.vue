<template>
    <div>
      <img :src="imageSource"></img>
    </div>
</template>

<script>
export default {
  name: 'Picture',
  props: ['imageSource'],
  data () {
    return {
    }
  },
  methods: {
  }
}
</script>

<style scoped>
</style>
