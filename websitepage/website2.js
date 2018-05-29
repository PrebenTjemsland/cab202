            function markers(map){
            for (i = 0; i < lat1.length; i++){     
                var lat2 = parseFloat(lat1[i][0]);
                var long2 = parseFloat(long1[i][1]);
            if (WifiID == long1[i][0]){
                var latlong1 = {lat: lat2 , lng: long2};
                var marker = new google.maps.Marker({
            position: latlong1,
            map: map,
            title: long1[i][0] 
            });
        }
    }
 }
      function initMap(){
        for (i = 0; i < lat1.length; i++){     
            var lat2 = parseFloat(lat1[i][0]);
            var long2 = parseFloat(long1[i][1]);
        if (WifiID == long1[i][0]){
            var latlong1 = {lat: lat2 , lng: long2};
            }
        }
          initMap1(latlong1);
      }
        function initMap1(latlong1) {
        var map;
        map = new google.maps.Map(document.getElementById('map_2'), {
          zoom: 15,
          center: latlong1
        });  
       markers(map);  
      }
