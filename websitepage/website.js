function markers(map){
    for (i = 0; i < lat1.length; i++){       
        var lat2 = parseFloat(lat1[i][0]);
        var long2 = parseFloat(long1[i][1]);
        var latlong1 = {lat: lat2 , lng: long2}; 
        var marker = new google.maps.Marker({
          position: latlong1,
          map: map,
          title: long1[i][0] 
        });
        }
       }

function initMap() {
    var map;
    var latlong1 = {lat: -27.47091173 , lng: 153.02245980};
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: latlong1
        });
         
       markers(map);
        
      }


window.onload = function () {
	document.getElementById("password1").onchange = validatePassword;
	document.getElementById("password2").onchange = validatePassword;
}
function validatePassword(){
var pass2=document.getElementById("password2").value;
var pass1=document.getElementById("password1").value;
if(pass1!=pass2)
	document.getElementById("password2").setCustomValidity("Passwords Don't Match");
else
	document.getElementById("password2").setCustomValidity('');	 
//empty string means no validation error
}
