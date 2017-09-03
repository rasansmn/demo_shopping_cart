/*
"Demo Shopping Cart" is a non comprehensive e-commerce website developed for academic purposes only. This is just a demonstration of a simple shopping cart and it may contain bugs and errors.

Design and development by Rasan Samarasinghe. (c) 2015 All Rights Reserved.
*/

function validateLogin(){
if(document.getElementById("txtEmail").value == ""){
	alert("Enter email address");
	document.getElementById("txtEmail").focus();
	return false;
}

if(document.getElementById("txtPassword").value == ""){
	alert("Enter password");
	document.getElementById("txtPassword").focus();
	return false;
}

return true;
}

function validateRegister(){
if(document.getElementById("txtName").value == ""){
	alert("Enter name");
	document.getElementById("txtName").focus();
	return false;
}

if(document.getElementById("txtAddress").value == ""){
	alert("Enter address");
	document.getElementById("txtAddress").focus();
	return false;
}

if(document.getElementById("txtEmail").value == ""){
	alert("Enter email address");
	document.getElementById("txtEmail").focus();
	return false;
}

var email = document.getElementById("txtEmail").value;
var atpos = email.indexOf("@");
var dotpos = email.lastIndexOf(".");
var len = email.length;

if(atpos < 2 || dotpos-atpos < 3 || len-dotpos < 3){
	alert("Enter a valid email address");
	document.getElementById("txtEmail").focus();
	return false;
}

if(document.getElementById("txtPassword").value == ""){
	alert("Enter password");
	document.getElementById("txtPassword").focus();
	return false;
}

if(document.getElementById("txtConfPassword").value != document.getElementById("txtPassword").value){
	alert("Confirm password do not match");
	document.getElementById("txtPassword").focus();
	return false;
}

return true;
}

function validateAddProduct(){
if(document.getElementById("txtName").value == ""){
	alert("Enter name");
	document.getElementById("txtName").focus();
	return false;
}

if(document.getElementById("txtDescription").value == ""){
	alert("Enter description");
	document.getElementById("txtDescription").focus();
	return false;
}

if(document.getElementById("fileImage").value == ""){
	alert("Select an image");
	return false;
}

if(document.getElementById("txtPrice").value == ""){
	alert("Enter price");
	document.getElementById("txtPrice").focus();
	return false;
}

if(isNaN(document.getElementById("txtPrice").value)){
	alert("Enter a valid price");
	document.getElementById("txtPrice").focus();
	return false;
}

return true;	
}

function validateOrder(){
if(document.getElementById("txtCredit").value == ""){
	alert("Enter credit card number");
	document.getElementById("txtCredit").focus();
	return false;
}

if(isNaN(document.getElementById("txtCredit").value) || document.getElementById("txtCredit").value.length != 10){
	alert("Enter a 10 digit credit card number");
	document.getElementById("txtCredit").focus();
	return false;
}

if(document.getElementById("txtAddress").value == ""){
	alert("Enter shipping address");
	document.getElementById("txtAddress").focus();
	return false;
}

return true;
}

function confirmDelete(){
	var ret = confirm("Are you sure you want to delete this?");
	return ret;
}

function confirmValidate(){
	var ret = confirm("Are you sure you want to validate this?");
	return ret;
}
