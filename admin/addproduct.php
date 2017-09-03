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
<title>Add Product</title>
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
    <h2>Add Product</h2>
	<?php 
	if($_SERVER['REQUEST_METHOD'] == "POST"){
	$productname = validateInput($_POST['txtName']);
	$description = validateInput($_POST['txtDescription']);
	$price = validateInput($_POST['txtPrice']);
	$uploadpath = "../images/products/" . basename($_FILES['fileImage']['name']);
	$imagepath = "images/products/" . basename($_FILES['fileImage']['name']);
	$temppath = $_FILES['fileImage']['tmp_name'];
	$filesize = $_FILES['fileImage']['size'];
	
	$stmt = $con->prepare("INSERT INTO tblproduct (productname, description, imgurl, price) VALUES (?, ?, ?, ?)"); 
	$stmt->bind_param("sssd", $productname, $description, $imagepath, $price);
	
	if($filesize > 2000000 || !getimagesize($temppath)){
	echo "Select an image file less than 2Mb<br/>";
	}else{
	
	if($stmt->execute() && move_uploaded_file($temppath, $uploadpath)){
	echo "Product added successfully!<br/>";
	}else{
	echo "Failed to add product<br/>";
	}
	}
	
	}	
	
	
	?>
	 <form action="addproduct.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return validateAddProduct()">
      <p>
        <label>Product Name:
        <br />
        <input name="txtName" type="text" id="txtName" />
        </label>
      </p>
      <p>
        <label>Description:
        <br />
        <input name="txtDescription" type="text" id="txtDescription" />
        </label>
      </p>
      <p>
        <label>Image:<br />
        <input name="fileImage" type="file" id="fileImage" />
        </label>
      </p>
      <p>
        <label>Price: <br />
        <input name="txtPrice" type="text" id="txtPrice" />
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
