var map;
var markers = [];

function initMap() {

  let longitude = parseFloat(document.getElementById("long_serie").value);
  let latitude = parseFloat(document.getElementById("lat_serie").value);

  let centre = {lat: latitude, lng: longitude};


  console.log(centre);

  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 12,
    center: centre,
    mapTypeId: 'terrain'
  });

  // This event listener will call addMarker() when the map is clicked.
  map.addListener('click', function(event) {
    deleteMarkers();
    addMarker(event.latLng);
    let lat = event.latLng.lat();
    let lng = event.latLng.lng();
    document.getElementById("position_lat").value = lat;
    document.getElementById("position_long").value = lng;
    PremierMarker=false;
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
