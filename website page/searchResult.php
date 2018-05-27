<html>
	<title>Search Results</title>
		<head>
			<link href="css.css" rel="stylesheet" type="text/css">
		</head>
		<body>
		<!-- Makes the bar at the top with the logo and navigation -->	
			<div class="center">
		<!-- Places and Positions the Logo in the nav bar -->	
				<img src="../Resources/bcc.jpg" alt="Brisbane City Council logo" height="70" width="70">
		Brisbane City Council Wifi Parks
				<div class="topnav">
					<a href="searchpage.php">Home</a>
					<a class="active" href="searchResult.php">Parks</a>
					<a href="register.php">Register</a>
				</div>
			</div>
			<br>
			<br>
			<br>
			<div class="center1"> 
				<table class="Result">
<?php
//Establish connection    
$pdo = new PDO('mysql:host=localhost:3306;dbname=cab230', 'min', 'Secret!');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {
if(isset($_REQUEST['submit'])&&("" != ($_POST['SuburbSelected']))){
    $Suburb=$_POST['SuburbSelected'];

    $result = $pdo->query(" SELECT WifiID, Adress, Suburb, Latitude, Longitude, max(Rating), ROUND(AVG(Rating),2) AS AverageRating
                            FROM WifiSpots LEFT JOIN Reviews on Re_WifiID = WifiID 
                            WHERE Suburb like '%".$Suburb."%' GROUP BY WifiID");
}
    else if(isset($_REQUEST['submit'])&&("" != ($_POST['WifiID']))){
     $WifiID=$_POST['WifiID'];

     $result = $pdo->query(" SELECT WifiID, Adress, Suburb, Latitude, Longitude, max(Rating), ROUND(AVG(Rating),2) AS AverageRating
                             FROM WifiSpots LEFT JOIN Reviews on Re_WifiID = WifiID 
                             WHERE WifiID like '%".$WifiID."%' GROUP BY WifiID");   
    }
    
        else if(isset($_REQUEST['submit'])&&("" != ($_POST['Rating']))){
     $Rating=$_POST['Rating'];

     $result = $pdo->query(" SELECT WifiID, Adress, Suburb, Latitude, Longitude,(SELECT max(Rating), ROUND(AVG(Rating),2) AS AverageRating 
    FROM WifiSpots LEFT JOIN Reviews on Re_WifiID = WifiID ), max(Rating), ROUND(AVG(Rating),2) AS AverageRating
                             FROM WifiSpots LEFT JOIN Reviews on Re_WifiID = WifiID 
                             WHERE Rating >= '".$Rating."' GROUP BY WifiID");   
    }
    
else{
    $result = $pdo->query("SELECT WifiID, Adress, Suburb, Latitude, Longitude, max(Rating), ROUND(AVG(Rating),2) AS AverageRating
FROM WifiSpots LEFT JOIN Reviews on Re_WifiID = WifiID GROUP BY WifiID");
    
}
} catch (PDOException $e) {
echo "{$e->getMessage()}";
}
echo "<table>
<tr><th>Name
</th><th>Adress
</th><th>Subburb
</th><th>Rating
</th><th>More info
</th></tr>";
foreach ($result as $WifiSpots) {
    echo
    
        "<tr><td>".$WifiSpots['WifiID'].
        "</td><td>".$WifiSpots['Adress'].
        "</td><td>".$WifiSpots['Suburb'].
        "</td><td>".$WifiSpots['AverageRating'].
        "</td><td>".'<a href="searchResult2.php?park='.$WifiSpots['WifiID'] . '">More info</a></td></tr>';
        "</td></tr>";
    }
 ?>
				</table>
				<br>
				<br>
		<!-- creates a map with googles API -->
				<div id="map_1">
					<script type="text/javascript" src="website1.js"></script>
				</div>
				<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3h8y5u1ZuB8YNgthTMPxmmi_EBiDKAeY&callback=initMap"></script>
					<div class="spaceForm"></div> 
					<div class="spaceForm"></div> 
	<!-- creates a Footer to stay at the bottom of the page-->
				<div class="footer">
				<p>Made by Benjamin Lynch and Preben Tjemsland</p>
				</div>
			</div>		
		</body>
</html>
