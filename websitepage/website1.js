        function markers(map){
        for (x = 0; x <  WifiID.length;  x++){   
            for (i = 0; i < long1.length; i++){     
                var lat2 = parseFloat(lat1[i][0]);
                var long2 = parseFloat(long1[i][1]);
            if (WifiID[x][0] == long1[i][0]){
                var latlong1 = {lat: lat2 , lng: long2};
                var marker = new google.maps.Marker({
            position: latlong1,
            map: map,
            title: long1[i][0] 
            });
        }
    }
             
 }
        }
      function initMap(){
        for (x = 0; x <  WifiID.length;  x++){   
            for (i = 0; i < long1.length; i++){     
            var lat2 = parseFloat(lat1[i][0]);
            var long2 = parseFloat(long1[i][1]);
        if (WifiID[x][0] == long1[i][0]){
            var latlong1 = {lat: lat2 , lng: long2};
            }
        }
          initMap1(latlong1);
      }
      }
        function initMap1(latlong1) {
        var map;
        map = new google.maps.Map(document.getElementById('map_1'), {
          zoom: 10,
          center: latlong1
        });  
       markers(map);  
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
