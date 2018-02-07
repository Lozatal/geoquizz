function initMap() {
  var myLatLng = {lat: -25.363, lng: 131.044};

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 4,
    center: myLatLng
  });

  var marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    title: 'Hello World!'
  });
}
      // Attaches an info window to a marker with the provided message. When the
      // marker is clicked, the info window will open with the secret message.
      function attachSecretMessage(marker, secretMessage) {
        var infowindow = new google.maps.InfoWindow({
          content: secretMessage
        });

        marker.addListener('click', function() {
          infowindow.open(marker.get('map'), marker);
        });
      }
 // AIzaSyCXalgdg7BmoXIaoUO3gZiZwiLM8_rlr5Q
