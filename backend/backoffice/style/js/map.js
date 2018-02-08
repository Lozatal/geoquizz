function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 48.8574100, lng: 2.3338000},
    draggable: true,
    zoom: 10
  });

  map.addListener('click', function(e) {
    placeMarkerAndPanTo(e.latLng, map);
  });
}

function placeMarkerAndPanTo(latLng, map) {
  var marker = new google.maps.Marker({
    position: latLng,
    map: map
  });

}
 // AIzaSyCXalgdg7BmoXIaoUO3gZiZwiLM8_rlr5Q
