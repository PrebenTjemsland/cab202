      function initMap() {
        var latlong = {lat: -27.4698, lng: 153.0251};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: latlong
        });
        var marker = new google.maps.Marker({
          position: latlong,
          map: map
        });
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