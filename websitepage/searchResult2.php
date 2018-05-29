
	<?php
 include("config.php"); 
try{

    $sth = $pdo->query("SELECT wifiID, longitude FROM wifispots");
    $youapp = $sth->fetchAll();
    $Re_WifiID = $_GET['park'];
    echo '<script type="text/javascript">';
    echo 'var WifiID = "';
    echo "$Re_WifiID";
    echo '"';
    echo '</script>';
    echo '<script type="text/javascript">';
    echo  "var long1 =".json_encode( $youapp );  
    echo '</script>';
    $sth = $pdo->query("SELECT latitude FROM wifispots");
     $youapp1 = $sth->fetchAll();
    echo '<script type="text/javascript">';
    echo  "var lat1 =".json_encode( $youapp1 );  
    echo '</script>';
  } catch (Exception $e) {
    echo $e->getMessage();
  }

?>

<html>
	<title>Park Page</title>
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
			<a href="searchResult.php">Parks</a>
			<a href="register.php">Register</a>
		</div>
		</div>
		
		<br>
		<br>
		<br> 
<div class="center2"> 
    <table id="Result2">
        
<?php
try {
$WifiID = $_GET['park'];
$result = $pdo->query('SELECT WifiID, Adress, Suburb, Latitude, Longitude, max(Rating), ROUND(AVG(Rating),2) AS AverageRating
FROM Reviews INNER JOIN WifiSpots on Re_WifiID = WifiID
WHERE WifiID = "'.$WifiID.'"
ORDER BY Suburb;');
} catch (PDOException $e) {
echo "{$e->getMessage()}";
}
echo "<table>
<tr><th>Name
</th><th>Adress
</th><th>Subburb 
</th><th>Rating
</th></tr>";
foreach ($result as $WifiSpots) {
    echo
        "<tr><td>".$WifiSpots['WifiID'].
        "</td><td>".$WifiSpots['Adress'].
        "</td><td>".$WifiSpots['Suburb'].
         "</td><td>".$WifiSpots['AverageRating'].
        "</td></tr>";
    }
 ?>
    </table>
        </div>
      
    <br> <br> <br>
<div class="center2"> 
    <table id="Review">
 
   <?php
try {
$WifiID2 = $_GET['park'];
$stmt = $pdo->prepare('SELECT Rating, Content, Re_Username, Re_WifiID
FROM Reviews INNER JOIN WifiSpots on Re_WifiID = WifiID
WHERE WifiID = "'.$WifiID2.'"
;'); 
$stmt->execute();
} 
catch (PDOException $e) {
echo "{$e->getMessage()}";
}
echo "<table>
<tr><th>Username
</th><th>Content
</th><th>Name 
</th><th>Rating 
</th></tr>";
foreach ($stmt as $Reviews) {
    echo
        "<tr><td>".$Reviews['Re_Username'].
        "</td><td>".$Reviews['Content'].
        "</td><td>".$Reviews['Re_WifiID'].
        "</td><td>".$Reviews['Rating'].
        "</td></tr>";
    }     
  ?>                 
</table>        
</div> 
        
   <br>     
   <br>     
   <br>    
            
<?php      
        if (empty(isset($_SESSION['login_user']))) {
            ?> 
            <div class="center2"> 
            <a>You need to be logged in to leave a review.</a>
            <a>You can go to the <a href="searchpage.php">Home page</a> to login</a>
            </div>
            <?php
                }
            else{
                ?>
            <div class="center2"> 
                <a>Leave a review</a>
                <br>
                <form method="post" action="">
                    <input type="text" name="Content" placeholder="Review">
                    <select name='Rating'>
                    <option value="">--Choose rating--</option>
                    <option Value="1">-1-</option>
                    <option Value="2">-2-</option>
                    <option Value="3">-3-</option>
                    <option Value="4">-4-</option>
                    <option Value="5">-5-</option> 
                    </select>
    	<input type="submit" name="submitRating" value="Add">
  <?PHP 
        }
        ?>
        
</form>   
        </div>
          <?PHP           
    if(isset($_POST['submitRating'])) {

        $stmt = $pdo->prepare("INSERT INTO Reviews (Content, Rating, Re_UserName, Re_WifiID) VALUES (:Content, :Rating, :Re_UserName, :Re_WifiID)");
        $stmt->bindParam(":Content", $Content);
        $stmt->bindParam(":Rating", $Rating);
        $stmt->bindParam(":Re_UserName", $Re_UserName);
        $stmt->bindParam(":Re_WifiID", $Re_WifiID);
        
        $Content = $_POST['Content'];
        $Rating = $_POST['Rating'];
        $Re_UserName = $_SESSION['login_user'];
        $Re_WifiID = $_GET['park'];
        
        $stmt->execute();
    }
    
    ?>
    
   <br>     
   <br>     
   <br> 
        <!-- creates a map with googles API -->
		<div id="map_2">
		<script type="text/javascript" src="website2.js">
    </script>
	</div>
       
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3h8y5u1ZuB8YNgthTMPxmmi_EBiDKAeY&callback=initMap">
    </script>

    
        <!-- Makes some space between the last item on the screen and the footer -->
        <div class="space"></div> 


		<!-- creates a Footer to stay at the bottom of the page-->
		<div class="footer">
			<p>Made by Benjamin Lynch and Preben Tjemsland</p>
		</div>
		
	</body>
</html>
		
	
