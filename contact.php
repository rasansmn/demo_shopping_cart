<!--
"Demo Shopping Cart" is a non comprehensive e-commerce website developed only for academic purposes. This is just a demonstration of a simple shopping cart and it may contain bugs and errors.

Design and development by Rasan Samarasinghe. (c) 2015 All Rights Reserved.
-->
<?php 

include "core.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Contact</title>
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
	  <h2>Contact Us</h2>
	  <p>Design and development by Rasan Samarasinghe</p>
	  <p>E-Mail: rasansmn@gmail.com</p>
	  <p>Web: http://www.rasan.net</p>
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
