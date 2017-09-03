<!--
"Demo Shopping Cart" is a non comprehensive e-commerce website developed only for academic purposes. This is just a demonstration of a simple shopping cart and it may contain bugs and errors.

Design and development by Rasan Samarasinghe. (c) 2015 All Rights Reserved.
-->
<?php 

include "core.php";
include "dbconnection.php";

//if user not logged in, redirect to home page
if(isset($_SESSION['uid'])){
header("Location: index.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Register</title>
<link href="styles/style.css" rel="stylesheet" type="text/css" />
<script src="js/myscript.js" language="javascript" type="text/javascript"></script>
</head>

<body>
<div class="page">
  <div class="header">
	<?php 
	
	showHeading();
	
	?>
  </div>
  <div class="wrapper">
  <div class="navigation">
	<?php 
	
	mainMenu();
	
	?>
  </div>
  <div class="contents">
	<h2>Register</h2>
	<?php
	
	if($_SERVER['REQUEST_METHOD'] == "POST"){
	$username = validateInput($_POST['txtName']);
	$address = validateInput($_POST['txtAddress']);
	$email = validateInput($_POST['txtEmail']);
	$password = validateInput($_POST['txtPassword']);
	$stmt = $con->prepare("INSERT INTO tbluser (username, address, email, password) VALUES (?, ?, ?, ?)"); 
	$stmt->bind_param("ssss", $username, $address, $email, md5($password)); //password hash md5
	if($stmt->execute()){
	echo "Registration completed successfully!<br/>";
	}else{
	echo "Registration failed<br/>";
	}
	}	
	?>
	<form id="form1" name="form1" method="post" action="register.php" onsubmit="return validateRegister()">
        <p>
          <label>Name:
          <br />
          <input name="txtName" type="text" id="txtName" />
          </label>
        </p>
        <p>
          <label>Address:<br />
          <input name="txtAddress" type="text" id="txtAddress" />
          </label>
        </p>
        <p>
          <label>Email:
          <br />
          <input name="txtEmail" type="text" id="txtEmail" />
          </label>
        </p>
        <p>
          <label>Password: <br />
          <input name="txtPassword" type="password" id="txtPassword" />
          </label>
        </p>
		<p>
		<label>Confirm Password:
		<br />
		<input name="txtConfPassword" type="password" id="txtConfPassword" />
		</label>
	  </p>
        <p>
          <input type="submit" name="Submit" value="Submit" />
        </p>
    </form>
  </div>
  </div>
  <div class="footer">
	<?php 
	
	showFooter();
	
	?>
  </div>
</div>
</body>
</html>
