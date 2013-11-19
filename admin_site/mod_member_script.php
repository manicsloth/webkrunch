<?php
session_start();
require 'functions.php';
//check user is logged in
if(!isset($_SESSION['activeuser']) | empty($_SESSION['activeuser_permissions'])){
		header("Location:admin_login.php");
		exit;
	}
//check permissions
$perm_check = permission_check($_SESSION['activeuser_rank'], 'M');
if($perm_check == "no"){
	echo"<h2>Sorry, you do not have sufficient permissions to view this page.</h2> ";
	echo"<br /><button  onClick='history.go(-1);return true;'> Go Back </button>";
	exit;
}

//check for POST data with member id m if missing then redirect to member list.
if(!isset($_POST['id']) || !isset($_POST['fname']) || !isset($_POST['sname']) || !isset($_POST['dob']) || !isset($_POST['address']) || !isset($_POST['town']) || !isset($_POST['postcode']) || !isset($_POST['emerg_contact']) || !isset($_POST['email']) || !isset($_POST['credits'])){
	echo "There has been an error. Missing POST data. <br /><emp><a href='admin_home.php'> Please click below to return.</a><emp>";
	exit;
}

$nordic_db=db_connect(); //connect to db

//query to update database with new data
$query = $nordic_db->prepare("UPDATE members set fname=?, sname=?, dob=?, address=?, town=?, postcode=?, emerg_contact=?, email=?, credits=? WHERE id=?"); 
//parameters for query
$query->bindParam(1, $_POST['fname']); 
$query->bindParam(2, $_POST['sname']); 
$query->bindParam(3, $_POST['dob']); 
$query->bindParam(4, $_POST['address']); 
$query->bindParam(5, $_POST['town']);
$query->bindParam(6, $_POST['postcode']);
$query->bindParam(7, $_POST['emerg_contact']);
$query->bindParam(8, $_POST['email']); 
$query->bindParam(9, $_POST['credits']);
$query->bindParam(10, $_POST['id']);
//execute the query
$query->execute();
//return user to the members page.
header("Location:view_member.php?id=$_POST[id]");

?>;