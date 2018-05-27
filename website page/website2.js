      function initMap() {
        var latlong = {lat: -27.4698, lng: 153.0251};
        var map = new google.maps.Map(document.getElementById('map_2'), {
          zoom: 12,
          center: latlong
        });
        var marker = new google.maps.Marker({
          position: latlong,
          map: map
        });
      }
