<!--
"Demo Shopping Cart" is a non comprehensive e-commerce website developed only for academic purposes. This is just a demonstration of a simple shopping cart and it may contain bugs and errors.

Design and development by Rasan Samarasinghe. (c) 2015 All Rights Reserved.
-->
<?php 

include "core.php";
include "dbconnection.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home</title>
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
    <h2>Browse Our Products!</h2>
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
		<?php 
		
		//add item to the cart
		if(isset($_GET['pid'])){
		if(isset($_SESSION['uid'])){
		$stmt = $con->prepare("INSERT INTO tblcart (uid, pid) VALUES (?, ?)");
		$stmt->bind_param("ii", $_SESSION['uid'], validateInput($_GET['pid']));
		if($stmt->execute()){
		echo "Item added to the cart successfully!<br/>";
		}else{
		echo "Error add item to the cart<br/>";
		}
		}else{
		echo "You must login to add this product into cart<br/>";
		}
		}
		
		//get items per page
		$page = null;
		$items_per_page = 4; //items per page
		if (isset($_GET["page"])){ $page = validateInput($_GET["page"]); }
		if($page=="" || $page<=0){$page=1;}		
		$result = $con->query("SELECT COUNT(*) AS num FROM tblproduct");		   						   
		$row = $result->fetch_assoc();
		$num_items = $row['num'];
		$num_pages = ceil($num_items/$items_per_page);
		if(($page > $num_pages) && $page != 1){$page = $num_pages;}
		$limit_start = ($page-1) * $items_per_page;
		//end get items per page
		
		//show products
		$sql = "SELECT * FROM tblproduct ORDER BY pid DESC LIMIT $limit_start, $items_per_page";
		$result = $con->query($sql);
		if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
		echo "<tr>";
		echo "<td width=\"100\" ><img src=\"" . $row['imgurl'] . "\" height=\"100\" width=\"100\" /></td>";
		echo "<td>" . $row['productname'] . "</td>";
		echo "<td>" . $row['description'] . "</td>";
		echo "<td>" . $row['price'] . "</td>";
		echo "<td width=\"100\"><a href=\"index.php?pid=" . $row['pid'] . "&page=$page\">Add To Cart</a></td>";
		echo "</tr>";
		}
		}
		
		?>
	</table>
	
	<?php 
	
	//page navigation links
	if($num_pages>1)
	{
	echo "<p>";
	if($page>1)
	{
	$ppage = $page-1;
	echo "<a href=\"index.php?page=$ppage\">&#171;Prev</a> ";
	}
	echo "$page/$num_pages";
	if($page<$num_pages)
	{
	$npage = $page+1;
	echo " <a href=\"index.php?page=$npage\"> Next&#187;</a>";
	}
	echo "</p>";
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
