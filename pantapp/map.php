<!DOCTYPE html>
<html>
  <head>
  <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <title>Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 80%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
  <div id="demo">
  </div>
    <div id="map"></div>
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          //center: {lat: -34.397, lng: 150.644},
          zoom: 8
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.open(map);
            infoWindow.setContent('Location found.');
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
 
      
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          var data = JSON.parse(this.responseText);
          console.log(data[0]);
          

          var lat = parseFloat(data[0].lat);
          var long = parseFloat(data[0].long);

          var myLatLng = {lat: lat, lng: long};

          try {
            var marker = new google.maps.Marker({
              position: myLatLng,
              map: map,
              title: data[0].comment,
              content: '<h2> test</h2>' 
            });
          }
          catch (error){
          }



        }
      }
      //xhttp.open("GET", "GetPosts.php", true);

      xhttp.open("GET", "userDB.php?function=GetPosts", true);
      xhttp.send();
    </script>
      <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZA6koov3BriSNzUqkWSdAccYuoJV3RhE&callback=initMap">
    </script>
  </body>
</html>