<?php
    //Establish connection    
    include("config.php");
    
    $stmt = ("SELECT Suburb, WifiID FROM WifiSpots");
    try {
    $stmt=$pdo->prepare($stmt);
    $stmt->execute();
    $results=$stmt->fetchAll();
        } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
        }

   
 session_start();
  if($_SERVER["REQUEST_METHOD"] == "POST") {
      $UserName = $_POST["username"];
      $Password = $_POST['password'];
      $PasswordHashed = hash("sha512", $Password);
       // username and password sent from form 
       $stmt = $pdo->prepare("SELECT Username FROM users WHERE Username = '$UserName' and password = '$PasswordHashed'");
       $stmt->execute();
       $resultLogin = $stmt->fetchAll();
       $counter = 0;
       foreach ($resultLogin as $test)
       {
           $counter++;
       }
       if($counter == 1) {
           $_SESSION['login_user'] = $UserName;
           header("location: welcome.php");

           
       }
      else {
         $error = "Your Login Name or Password is invalid";
      }
  }
?>



<html>
	<title>Search Page</title>
		<script type="text/javascript" src="website.js"></script>
			<head>
				<link href="css.css" rel="stylesheet" type="text/css">
			</head>
			<body >
		 <!-- Makes the bar at the top with the logo and navigation -->	
				<div class="center">
		<!-- Places and Positions the Logo in the nav bar -->	

		<!-- Makes the boxes inside the bar and positions information-->	

					<div class="topnav">
						<img src="../Resources/bcc.jpg" alt="Brisbane City Council logo" height="70" width="70">
						Brisbane City Council Wifi Parks
						<a href="register.php">Register</a>		
						<a href="searchResult.php">Parks</a>
						<a class="active" href="searchpage.html">Home</a>
						
					</div>
				</div>
                
                
			<div class="rightlog"> 
				Log in Here
				 <form action = "" method = "post">
                     <input type="text" name="username" placeholder="username">
					 <br>
					 <br>
                      <input type="text" name="password" placeholder="password">
					<input type = "submit" value = " Submit "/><br /> 
				</form>
			</div>
                
                
		<br>
		<br>
		<br>
		<br>

			<div class="center1">
                Search For a local Wifi Park:
				<form method="post" action="searchResult.php">
                  <select name='SuburbSelected'>
            <option value="">-- Select Suburb--</option>
                    <?php foreach($results as $output) {?>
                      <option><?PHP echo $output["Suburb"];?></option>
                      <?PHP } ?>
                    </select> 
                    <input type="text" name="WifiID" placeholder="Name">
                    <select name='Rating'>
                    <option value="">--Choose min rating--</option>
                    <option Value="1">-1-</option>
                    <option Value="2">-2-</option>
                    <option Value="3">-3-</option>
                    <option Value="4">-4-</option>
                    <option Value="5">-5-</option> 
                    </select>
					<input type="submit" name="submit"  value="Search">
				</form>
			</div>

    <br>
    <br>        
    <br>
				
		<!-- creates a map with googles API -->
				<div id="map">
					<script type="text/javascript" src="website.js">
					</script>
				</div>
				
				<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3h8y5u1ZuB8YNgthTMPxmmi_EBiDKAeY&callback=initMap">
				</script>
	<!-- creates a Footer to stay at the bottom of the page-->
				<div class="footer">
					<p>Made by Benjamin Lynch and Preben Tjemsland</p>
				</div>
              
			</body>
</html>
