<!--
"Demo Shopping Cart" is a non comprehensive e-commerce website developed only for academic purposes. This is just a demonstration of a simple shopping cart and it may contain bugs and errors.

Design and development by Rasan Samarasinghe. (c) 2015 All Rights Reserved.
-->
<?php 

include "../core.php";
include "../dbconnection.php";

//if user not logged in, redirect to login page
if(!isset($_SESSION['aid'])){
header("Location: login.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home</title>
<link href="../styles/style.css" rel="stylesheet" type="text/css" />
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
  <h2>Admin CP</h2>
	  <?php 
	  
	  $sql = "SELECT COUNT(*) AS num FROM tbluser";
	  $result = $con->query($sql);
	  $row = $result->fetch_assoc();
	  echo "<p>Total users: " . $row['num'] . "</p>";
	  
	  $sql = "SELECT COUNT(*) AS num FROM tblproduct";
	  $result = $con->query($sql);
	  $row = $result->fetch_assoc();
	  echo "<p>Total products: " . $row['num'] . "</p>";
	  
	  $sql = "SELECT COUNT(*) AS num FROM tblorder";
	  $result = $con->query($sql);
	  $row = $result->fetch_assoc();
	  echo "<p>Total orders: " . $row['num'] . "</p>";
	  
	  $sql = "SELECT COUNT(*) AS num FROM tblorderitem";
	  $result = $con->query($sql);
	  $row = $result->fetch_assoc();
	  echo "<p>Total order items: " . $row['num'] . "</p>";
	  
	  $sql = "SELECT COUNT(*) AS num FROM tbladmin";
	  $result = $con->query($sql);
	  $row = $result->fetch_assoc();
	  echo "<p>Total admins: " . $row['num'] . "</p>";
	  
	  ?>
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
