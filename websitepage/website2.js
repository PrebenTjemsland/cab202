      function initMap() {
        var latlong = {lat: -27.317, lng: 153.0378};
        var map = new google.maps.Map(document.getElementById('map_2'), {
          zoom: 12,
          center: latlong
        });
        var marker = new google.maps.Marker({
          position: latlong,
          map: map
        });
      }
