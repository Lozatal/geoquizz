function initMap() {
  var map;
  var markers = [];


  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 48.8574100, lng: 2.3338000},
    draggable: false,
    zoom: 10
  });

  map.addListener('click', function(e) {
    placeMarkerAndPanTo(e.latLng, map);
  });

  map.addListener('click', function(e){
    let PremierMarker=true;
    if(PremierMarker){
      let lat = e.latLng.lat();
      let lng = e.latLng.lng();
      document.getElementById("position_long").value = lat;
      document.getElementById("position_lat").value = lng;
      PremierMarker=false;
    }else{
      deleteMarkers();
      let lat = e.latLng.lat();
      let lng = e.latLng.lng();
      document.getElementById("position_long").value = lat;
      document.getElementById("position_lat").value = lng;
      PremierMarker=true;
    }
  });

  function placeMarkerAndPanTo(latLng, map) {
    marker = new google.maps.Marker({
      position: latLng,
      map: map
    });
  }

  // Adds a marker to the map and push to the array.
  function addMarker(location) {
    var marker = new google.maps.Marker({
      position: location,
      map: map
    });
    markers.push(marker);
  }

  // Sets the map on all markers in the array.
  function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(map);
    }
  }

  // Removes the markers from the map, but keeps them in the array.
  function clearMarkers() {
    setMapOnAll(null);
  }

  // Shows any markers currently in the array.
  function showMarkers() {
    setMapOnAll(map);
  }

  // Deletes all markers in the array by removing references to them.
  function deleteMarkers() {
    clearMarkers();
    markers = [];
  }
}
