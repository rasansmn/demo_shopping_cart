<!--
"Demo Shopping Cart" is a non comprehensive e-commerce website developed only for academic purposes. This is just a demonstration of a simple shopping cart and it may contain bugs and errors.

Design and development by Rasan Samarasinghe. (c) 2015 All Rights Reserved.
-->
<?php 

include "../core.php";
include "../dbconnection.php";

//if user logged in, redirect to home page
if(isset($_SESSION['aid'])){
header("Location: index.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Admin Login</title>
<link href="../styles/style.css" rel="stylesheet" type="text/css" />
<script src="../js/myscript.js" language="javascript" type="text/javascript"></script>
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
	
	adminMenu();
	
	?>
  </div>
  <div class="contents">
	<h2>Admin Login</h2>
	<?php 

	if($_SERVER['REQUEST_METHOD'] == "POST"){
	$email = validateInput($_POST['txtEmail']);
	$password = md5(validateInput($_POST['txtPassword']));
	$sql = "SELECT * FROM tbladmin WHERE email='$email' AND password='$password'";
	$result = $con->query($sql);
	if($result->num_rows > 0){
	//login success
	$row=$result->fetch_assoc();
	$_SESSION["aid"] = $row['aid']; //set session
	setcookie("aid", $row['aid'], time()+(86400*30), "/"); //set cookie
	header("Location: index.php");
	}else{
	//login failed
	echo "Invalid login<br/>";
	}
	}
	
	?>
	  <form id="form1" name="form1" method="post" action="login.php" onsubmit="return validateLogin()">
	  <p>
		<label>Email:
		<br />
		<input name="txtEmail" type="text" id="txtEmail" />
		</label>
	</p>
	  <p>
		<label>Password:
		<br />
		<input name="txtPassword" type="password" id="txtPassword" />
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
