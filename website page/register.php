<!DOCTYPE html>
<title>Register Page</title>
<html>
<head>
<link href="css.css" rel="stylesheet" type="text/css">
</head>
<body>
	<!-- Makes the bar at the top with the logo and navigation -->	
    <div class="center">
		<img src="../Resources/bcc.jpg" alt="Brisbane City Council logo" height="70" width="70">
		Brisbane City Council Wifi Parks
		<div class="topnav">
            		<a href="searchpage.php">Home</a>
			<a href="searchResult.php">Parks</a>
		        <a class="active" href="register.php">Register</a>
		</div>
		</div>
<!-- adds padding over the registerbox-->	    

    <!-- creates a box -->	
    <div class="loginbox">
    <!-- Adds all input to the registerbox with HTML5 validation -->	
    <h1>Login Here</h1>
    <form method="post" action="register.php">
    <p>User name</p>
    <input type="text" name="UserName" pattern="[A-Za-z]{0-25}" placeholder="User Name" required>
    <p>First Name</p>
    <input type="text" name="FirstNames" pattern="[A-Za-z]{0-25}" placeholder="First Name" required>
    <p>Last Name</p>
    <input type="text" name="LastName" pattern="[A-Za-z]{0-25}" placeholder="Last Name" required> 
    <p>Email</p>
    <input type="text" name="Email" placeholder="Email" required>
    <p>Postcode</p>
    <input type="number" pattern="[0-9]{4}" name="PostCode" placeholder="Postcode" title="A four digit postcode is required." required>
    <p>Date of birth</p>
    <input type="date" name="DateOfBirth" placeholder="Date of birth" required>    
    <p>Password</p>
    <input type="password" name="Password" placeholder="Password" required>
    <p>Repeat Password</p>
    <input type="password" name="PasswordRe" placeholder="Repeat Password" >
    <br/>
    <!-- Creates the tearm and contition text and tick box. makes Terms and condition a clickable link -->	
    <a> Do you accept our</a>
    <a href="LinkToTerms">Terms and condition</a>
    <a>?</a>
    <input type="checkbox"  value="Tick" required>
    <input type="submit" name="submit"  value="Register">
    </form>
</div>
    
    

<?php
function insert()
{
//Establish connection    
$pdo = new PDO('mysql:host=localhost:3306;dbname=cab230', 'min', 'Secret!');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//Make prepared statement
$stmt = $pdo->prepare("INSERT into Users (UserName, FirstNames, LastName, Email, PostCode, DateOfBirth, Password, PasswordRe, Salt)
Values (:UserName, :FirstNames, :LastName, :Email, :PostCode, :DateOfBirth, :Password, :PasswordRe, :Salt)");
//Bind parameters that will be inserted into the statement
$stmt->bindParam(":UserName", $UserName);
$stmt->bindParam(":FirstNames", $FirstNames);
$stmt->bindParam(":LastName", $LastName);
$stmt->bindParam(":Email", $Email);
$stmt->bindParam(":PostCode", $PostCode);
$stmt->bindParam(":DateOfBirth", $DateOfBirth);
$stmt->bindParam(":Password", $PasswordHashed);
$stmt->bindParam(":PasswordRe", $PasswordReHashed);
$stmt->bindParam(":Salt", $Salt);
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
$PasswordHashed = hash("sha512", $Password . $Salt);
$PasswordReHashed = hash("sha512", $PasswordRe . $Salt);
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
