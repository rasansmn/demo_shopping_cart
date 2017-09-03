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
<title>Orders</title>
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
  <h2>Orders</h2>
    <?php 
	  
	//validate order
	if(isset($_GET['validateoid'])){
	$stmtvalidate = $con->prepare("UPDATE tblorder SET valid='Yes' WHERE oid=?");
	$stmtvalidate->bind_param("i", validateInput($_GET['validateoid']));
	if($stmtvalidate->execute()){
	echo "Order validated successfully!<br/>";
	//send email notification to the user
	$row = $con->query("SELECT tbluser.email FROM tbluser INNER JOIN tblorder ON tbluser.uid=tblorder.uid WHERE tblorder.oid=" . validateInput($_GET['validateoid']))->fetch_assoc();
	if(sendConfirmEmail($row['email'])){
	echo "Email notification sent!<br/>";
	}else{
	echo "Email notification not sent!<br/>";
	}
	}else{
	echo "Error validating order<br/>";
	}
	}
	
	?>
	
	<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="col">Order ID </th>
	<th scope="col">User ID </th>
    <th scope="col">Time</th>
    <th scope="col">Price</th>
    <th scope="col">Credit Card # </th>
	<th scope="col">Shipping Address </th>
    <th scope="col">Validated</th>
    <th scope="col" colspan="2">Options</th>
  </tr>
  <?php 
   
   //display orders
	$sql = "SELECT * FROM tblorder  ORDER BY oid DESC";
	$result = $con->query($sql);
	if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){  
	  echo "<tr>";
		echo "<td>" . $row['oid'] . "</td>";
		echo "<td>" . $row['uid'] . "</td>";
		echo "<td>" . $row['time'] . "</td>";
		echo "<td>" . $row['price'] . "</td>";
		echo "<td>" . $row['creditcno'] . "</td>";
		echo "<td>" . $row['address'] . "</td>";
		echo "<td>" . $row['valid'] . "</td>";
		echo "<td><a href=\"orderitems.php?oid=" . $row['oid'] . "\">Items</a></td>";
		echo "<td><a href=\"orders.php?validateoid=" . $row['oid'] . "\" onclick=\"return confirmValidate()\">Validate</a></td>";
	  echo "</tr>";
	  }
	  }else{
	  echo "<tr><td colspan=\"8\">No orders found!</td></tr>";
	  }
  
  ?>
</table>
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