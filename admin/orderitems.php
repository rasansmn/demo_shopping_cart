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
<title>Order Items</title>
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
  <h2>Order Items</h2>
  <table width="100%" border="1" cellspacing="0" cellpadding="0">
      <tr>
        <th scope="col">Order ID </th>
        <th scope="col">Product ID </th>
        <th scope="col">Product Name </th>
      </tr>
		<?php 
		
		//display order items
		if(isset($_GET['oid'])){
		$sql = "SELECT tblorderitem.oid, tblorderitem.pid, tblproduct.productname FROM tblorderitem INNER JOIN tblproduct ON tblorderitem.pid = tblproduct.pid WHERE tblorderitem.oid=" . validateInput($_GET['oid'] . " ORDER BY tblorderitem.oiid DESC");
		$result = $con->query($sql);
		if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){  
		echo "<tr>";
		echo "<td>". $row['oid'] . "</td>";
		echo "<td>". $row['pid'] . "</td>";
		echo "<td>". $row['productname'] . "</td>";
		echo "</tr>";
		}
		}else{
		echo "<tr><td colspan=\"3\">No records found!</td></tr>";
		}
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
