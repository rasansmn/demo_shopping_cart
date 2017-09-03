<?php 
//start session when each page loads
session_start();

//set your site title and footer in here
$site_title = "Demo Shopping Cart";
$site_footer = "Demo Shopping Cart " . date("Y") . " &copy; Rasan Samarasinghe";

//retrieve cookies
if(isset($_COOKIE['uid'])){
$_SESSION['uid'] = $_COOKIE['uid'];
}

if(isset($_COOKIE['aid'])){
$_SESSION['aid'] = $_COOKIE['aid'];
}

//main navigation menu
function mainMenu(){
if(isset($_SESSION['uid'])){
echo "<ul>";
echo "<li><a href=\"index.php\">Home</a></li>";
echo "<li><a href=\"cart.php\">Cart</a></li>";
echo "<li><a href=\"orders.php\">Orders</a></li>";
echo "<li><a href=\"about.php\">About</a></li>";
echo "<li><a href=\"contact.php\">Contact</a></li>";
echo "<li><a href=\"logout.php\">Log out</a></li>";
echo "</ul>";
}else{
echo "<ul>";
echo "<li><a href=\"index.php\">Home</a></li>";
echo "<li><a href=\"login.php\">Login</a></li>";
echo "<li><a href=\"register.php\">Register</a></li>";
echo "<li><a href=\"about.php\">About</a></li>";
echo "<li><a href=\"contact.php\">Contact</a></li>";
echo "</ul>";
}
}

//main navigation menu for admin
function adminMenu(){
if(isset($_SESSION['aid'])){
echo "<ul>";
echo "<li><a href=\"index.php\">Home</a></li>";
echo "<li><a href=\"orders.php\">Orders</a></li>";
echo "<li><a href=\"products.php\">Products</a></li>";
echo "<li><a href=\"addproduct.php\">Add Product</a></li>";
echo "<li><a href=\"users.php\">Users</a></li>";
echo "<li><a href=\"addadmin.php\">Add Admin</a></li>";
echo "<li><a href=\"admins.php\">Admins</a></li>";
echo "<li><a href=\"logout.php\">Log out</a></li>";
echo "</ul>";
}else{
echo "<ul>";
echo "<li><a href=\"login.php\">Login</a></li>";
echo "</ul>";
}
}

//site title
function showHeading(){
global $site_title;
echo "<h1 id=\"titletext\">$site_title</h1>";
}

//site footer
function showFooter(){
global $site_footer;
echo "<p id=\"footertext\">$site_footer</p>";
}

//validate user input against malicious code
function validateInput($data){
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}

function sendConfirmEmail($email){
$message = "Your order on Demo Shopping Cart confirmed successfully. \n\n Thank you";
$message = wordwrap($message, 70);
$subject = "Order Confirmation";
return mail($email,$subject,$message);
}

?>