<?php
    //Establish connection    
    include("config.php");   
?>
<script type="text/javascript" src="website1.js"></script>
<!DOCTYPE html>
<title>Register Page</title>
	<html>
		<head>
			<link href="css.css" rel="stylesheet" type="text/css">
		</head>
		
		<body>
		<!-- Makes the bar at the top with the logo and navigation -->	
		<div class="center">
			
					<div class="topnav">
						<img src="../Resources/bcc.jpg" alt="Brisbane City Council logo" height="70" width="70">
						Brisbane City Council Wifi Parks
						<a class="active" href="register.php">Register</a>
						<a href="searchResult.php">Parks</a>
						<a href="searchpage.php">Home</a>
					</div>
		</div>
		<!-- adds padding over the registerbox-->	    

		<!-- creates a box -->	
		<div class="loginbox">
    <!-- Adds all input to the registerbox with HTML5 validation -->	
			<h1>Register</h1>
				<form method="post" action="register.php">
				
					<p>User name</p>
						<input type="text" name="UserName" pattern="[A-Za-z]{1,}" placeholder="User Name" title="Must contain at least only letters" required>
					<p>First Name</p>
						<input type="text" name="FirstNames" pattern="[A-Za-z]{1,}" placeholder="First Name" title="Must contain at least only letters" required>
					<p>Last Name</p>
						<input type="text" name="LastName" pattern="[A-Za-z]{1,}" placeholder="Last Name" title="Must contain at least only letters" required> 
					<p>Email</p>
						<input type="text" name="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="Email" title="Must be valid email adress format" required>
					<p>Postcode</p>
						<input type="text" pattern="[0-9]{4}" name="PostCode" placeholder="Postcode" title="A four digit postcode is required." required>
					<p>Date of birth</p>
						<input type="date" name="DateOfBirth" placeholder="Date of birth" required>  
					
						<script type="text/javascript" src="website.js"></script>
					<label>Password
						<input type="password" name="Password" placeholder="Password" id="Password" onkeyup='check();' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
					</label>
					<br>
					<label>Repeat Password
						<input type="password" name="PasswordRe" placeholder="Repeat Password" id="Repeat" onkeyup='check();' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" >
					<span id='message'></span>	
					</label>
											
						
					<br/>
    <!-- Creates the tearm and contition text and tick box. makes Terms and condition a clickable link -->	
					<a> Do you accept our</a>
						<a href="LinkToTerms">Terms and conditions</a>
						<a>?</a>
					<input type="checkbox"  value="Tick" required>
					<input type="submit" name="submit"  value="Register">
				</form>
		</div>
       

<?php
function insert()
{
//Make prepared statement
$stmt = $pdo->prepare("INSERT into Users (UserName, FirstNames, LastName, Email, PostCode, DateOfBirth, Password, PasswordRe)
Values (:UserName, :FirstNames, :LastName, :Email, :PostCode, :DateOfBirth, :Password, :PasswordRe)");
//Bind parameters that will be inserted into the statement
$stmt->bindParam(":UserName", $UserName);
$stmt->bindParam(":FirstNames", $FirstNames);
$stmt->bindParam(":LastName", $LastName);
$stmt->bindParam(":Email", $Email);
$stmt->bindParam(":PostCode", $PostCode);
$stmt->bindParam(":DateOfBirth", $DateOfBirth);
$stmt->bindParam(":Password", $PasswordHashed);
$stmt->bindParam(":PasswordRe", $PasswordReHashed);

//Getting variables ready to be binded    
$UserName = $_POST['UserName'];
$FirstNames = $_POST['FirstNames'];
$LastName = $_POST['LastName'];
$Email = $_POST['Email'];
$PostCode = $_POST['PostCode'];
$DateOfBirth = $_POST['DateOfBirth'];
$Password = $_POST['Password'];
$PasswordRe = $_POST['PasswordRe'];
//Hashing passwords
$Salt = openssl_random_pseudo_bytes(64);
$PasswordHashed = hash("sha512", $Password );
$PasswordReHashed = hash("sha512", $PasswordRe);
//Execute prepared statement
$stmt->execute();
//Run insert() when submit is pressed    
 }
if($_SERVER['REQUEST_METHOD']=='POST')
 {
    insert();
}
?>
    
    
		</body>
	</html>
