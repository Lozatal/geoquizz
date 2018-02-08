<template>
  <div>
    <Map></Map>
  </div>
</template>

<script>

import Map from '@/components/Map'

export default {
  name: 'Partie',
  data () {
    return {
      partie: ''
    }
  },
  components:{
    Map
  },
  mounted() {
        window.axios.get('parties/' + this.$route.params.id ).then((response) => {
            this.partie = response.data;
        }).catch((error) => {
            alert(error);
        });
  }
}
</script>

<style scoped>
  h1{color:green;}
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    #map {
      height: 100%;
      width: 50%;
      float: left;
    }
    #pic {
      height: 10%;
      width: 50%;
      float: left;
    }
    img{
      width: 80%;
      margin: 10%;
      padding: 10px;
      background-color: #f5f5f5;
      border: 1px solid #999999;
    }
    /* Optional: Makes the sample page fill the window. */
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
</style>
