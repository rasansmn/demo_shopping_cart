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
<title>Cart</title>
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
    <h2>Cart</h2>
	<?php 
	
	//delete cart item
	if(isset($_GET['deleteid'])){
	$stmt = $con->prepare("DELETE FROM tblcart WHERE cid=?");
	$stmt->bind_param("i", validateInput($_GET['deleteid']));
	if($stmt->execute()){
	echo "Item deleted from the cart<br/>";
	}else{
	echo "Error deleting item<br/>";
	}
	}
	
	?>
	
	<table width="100%" border="1" cellspacing="0" cellpadding="0">
	  <tr>
		<th scope="col">Item Name</th>
		<th scope="col">Description</th>
		<th scope="col">Price</th>
		<th scope="col">Options</th>
	  </tr>
	  <?php 
	  
	  //show cart items
	  $sql = "SELECT tblproduct.productname, tblproduct.description, tblproduct.price, tblcart.cid FROM tblproduct INNER JOIN tblcart ON tblproduct.pid = tblcart.pid WHERE tblcart.uid =" . $_SESSION["uid"];
	  $result = $con->query($sql);
	  if($result->num_rows > 0){
	  while($row = $result->fetch_assoc()){
	  echo "<tr>";
		echo "<td>". $row['productname'] . "</td>";
		echo "<td>". $row['description'] . "</td>";
		echo "<td>". $row['price'] . "</td>";
		echo "<td><a href=\"cart.php?deleteid=" .$row['cid']. "\" onclick=\"return confirmDelete()\">Delete</a></td>";
	  echo "</tr>";
	  }
	  }else{
	  echo "<tr><td colspan=\"4\">No items found in cart</td></tr>";
	  }
	  
	  ?>
	  </table>
	  
	<?php
	
	// display order section only when there are items in the cart
	if($result->num_rows > 0){
	$sql = "SELECT SUM(tblproduct.price) AS total FROM tblproduct INNER JOIN tblcart ON tblproduct.pid = tblcart.pid WHERE tblcart.uid =" . $_SESSION["uid"];
	$res = $con->query($sql);
	$row = $res->fetch_assoc();
	echo "<br/>Total: Rs.". $row['total'];
	
	echo "<br/><form action=\"orders.php\" method=\"post\" onsubmit=\"return validateOrder()\">";
	echo "<p><label>Credit card number:";
	echo "<br/><input id=\"txtCredit\" type=\"text\" name=\"txtCredit\" /></label></p>";
	echo "<p><label>Shipping address:";
	echo "<br/><input id=\"txtAddress\" type=\"text\" name=\"txtAddress\" /></label></p>";
	echo "<input name=\"price\" type=\"hidden\" value=\"" . $row['total'] .  "\" />";
	echo "<input name=\"\" type=\"submit\" value=\"Order\" />";
	echo "</form>";
	}
	
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
