      function initMap() {
        var latlong = {lat: -27.4698, lng: 153.0251};
        var map = new google.maps.Map(document.getElementById('map_1'), {
          zoom: 12,
          center: latlong
        });
        var marker = new google.maps.Marker({
          position: latlong,
          map: map
        });
      }

	   var check = function() {
      if (document.getElementById('Password').value ==
          document.getElementById('Repeat').value) {
          document.getElementById('message').style.color = 'green';
          document.getElementById('message').innerHTML = 'matching';
      } else {
      		document.getElementById('message').style.color = 'red';
          document.getElementById('message').innerHTML = 'not matching';
      }
  }