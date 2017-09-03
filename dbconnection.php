<?php 

//update your database connection details here
$hostname = "localhost";
$dbuser = "rasan";
$dbpass = "abcd";
$dbname = "demo_cart_db";
	
$con = new mysqli($hostname, $dbuser, $dbpass, $dbname);

if($con->connect_error){
die("Error connect to db");
}

?>
