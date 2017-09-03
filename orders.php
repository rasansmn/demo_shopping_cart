<!--
"Demo Shopping Cart" is a non comprehensive e-commerce website developed only for academic purposes. This is just a demonstration of a simple shopping cart and it may contain bugs and errors.

Design and development by Rasan Samarasinghe. (c) 2015 All Rights Reserved.
-->
<?php 

include "core.php";
include "dbconnection.php";

//if user not logged in, redirect to home page
if(!isset($_SESSION['uid'])){
header("Location: index.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Orders</title>
<link href="styles/style.css" rel="stylesheet" type="text/css" />
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
  <h2>Orders</h2>
  <?php 
    
	//add new order
	if($_SERVER['REQUEST_METHOD']=="POST"){
	
	$q1 = NULL;
	$q2 = NULL;
	$q3 = NULL;
	
	//add a new record to order table
	$stmtorder = $con->prepare("INSERT INTO tblorder (price, creditcno, address, uid) VALUES (?, ?, ?, ?)");
	$stmtorder->bind_param("disi", validateInput($_POST['price']), validateInput($_POST['txtCredit']), validateInput($_POST['txtAddress']), $_SESSION['uid']);
	$q1 = $stmtorder->execute();
	$lastoid = $stmtorder->insert_id;
	 
	//add cart items into order items table
	$sql = "SELECT * FROM tblcart WHERE uid=" . $_SESSION['uid'];
	$result = $con->query($sql);
	if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
	$stmtorderitem = $con->prepare("INSERT INTO tblorderitem (pid, oid, uid) VALUES (?, ?, ?)");
	$stmtorderitem->bind_param("iii", $row['pid'], $lastoid, $row['uid']);
	$q2 = $stmtorderitem->execute();
	}
	}
	
	//clear cart table
	$stmt_clearcart = $con->prepare("DELETE FROM tblcart WHERE uid=?");
	$stmt_clearcart->bind_param("i", $_SESSION['uid']);
	$q3 = $stmt_clearcart->execute();
	  
	  //success message
	  if($q1 && $q2 && $q3){
	  echo "Order created successfully!<br/>";
	  }else{
	  echo "Error creating order<br/>";
	  }
	  
	  }
	?>
	
	<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="col">Order ID </th>
    <th scope="col">Time</th>
    <th scope="col">Price</th>
    <th scope="col">Credit Card # </th>
	<th scope="col">Shipping Address </th>
    <th scope="col">Validated</th>
    <th scope="col">Options</th>
  </tr>
  <?php 
   
    //show orders list
	$sql = "SELECT * FROM tblorder WHERE uid=" . $_SESSION["uid"] . " ORDER BY oid DESC";
	$result = $con->query($sql);
	if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){  
	  echo "<tr>";
		echo "<td>" . $row['oid'] . "</td>";
		echo "<td>" . $row['time'] . "</td>";
		echo "<td>" . $row['price'] . "</td>";
		echo "<td>" . $row['creditcno'] . "</td>";
		echo "<td>" . $row['address'] . "</td>";
		echo "<td>" . $row['valid'] . "</td>";
		echo "<td><a href=\"orderitems.php?oid=" . $row['oid'] . "\">Items</a></td>";
	  echo "</tr>";
	  }
	  }else{
	  echo "<tr><td colspan=\"7\">No orders found!</td></tr>";
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