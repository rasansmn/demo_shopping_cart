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
<title>Edit Product</title>
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
    <h2>Edit Product</h2>
	<?php 
	$pid = "";
	$name = "";
	$description = "";
	$price = "";
	$oldimage = "";
	
	//get current product details
	if(isset($_GET['editpid'])){
	$sql = "SELECT * FROM tblproduct WHERE pid=" . validateInput($_GET['editpid']);
	$result = $con->query($sql);
	if($result->num_rows > 0){
	$row = $result->fetch_assoc();
	$pid = $row['pid'];
	$name = $row['productname'];
	$description = $row['description'];
	$price = $row['price'];
	$oldimage = "../" . $row['imgurl'];
	}
	}
	
	//update product details
	if($_SERVER['REQUEST_METHOD'] == "POST"){
	$pid = validateInput($_POST['pid']);
	$name = validateInput($_POST['txtName']);
	$description = validateInput($_POST['txtDescription']);
	$price = validateInput($_POST['txtPrice']);
	$oldimage = validateInput($_POST['oldimage']);
	$uploadpath = "../images/products/" . basename($_FILES['fileImage']['name']);
	$imagepath = "images/products/" . basename($_FILES['fileImage']['name']);
	$temppath = $_FILES['fileImage']['tmp_name'];
	$filesize = $_FILES['fileImage']['size'];
	
	$stmt = $con->prepare("UPDATE tblproduct SET productname=?, description=?, imgurl=?, price=? WHERE pid=?"); 
	$stmt->bind_param("sssdi", $name, $description, $imagepath, $price, $pid);
	
	if($filesize > 2000000 || !getimagesize($temppath)){
	echo "Select an image file less than 2Mb<br/>";
	}else{

	if($stmt->execute() && unlink($oldimage) && move_uploaded_file($temppath, $uploadpath)){
	echo "Product updated successfully!<br/>";
	}else{
	echo "Failed to update product<br/>";
	}
	}
	
	}	
	
	?>
	 <form action="editproduct.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return validateAddProduct()">
      <p>
        <label>Product Name:
        <br />
        <input name="txtName" type="text" id="txtName" value="<?php echo $name; ?>" />
        </label>
      </p>
      <p>
        <label>Description:
        <br />
        <input name="txtDescription" type="text" id="txtDescription" value="<?php echo $description; ?>" />
        </label>
      </p>
      <p>
        <label>Image:<br />
        <input name="fileImage" type="file" id="fileImage" />
        </label>
      </p>
      <p>
        <label>Price: <br />
        <input name="txtPrice" type="text" id="txtPrice" value="<?php echo $price; ?>" />
        </label>
      </p>
      <p>
	  <input name="pid" type="hidden" value="<?php echo $pid; ?>" />
	  <input name="oldimage" type="hidden" value="<?php echo $oldimage; ?>" />
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
