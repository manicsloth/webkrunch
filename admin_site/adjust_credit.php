<?php
session_start();
require("functions.php");
//kick user to login page if not logged in.
if(!isset($_SESSION['activeuser']) | empty($_SESSION['activeuser'])){
	header("Location:admin_login.php");
	exit;
}
//check permissions
$perm_check = permission_check($_SESSION['activeuser_permissions'], 'C');
if($perm_check == "no"){
	echo"<h2>Sorry, you do not have sufficient permissions to view this page.</h2> ";
	echo"<br /><button  onClick='history.go(-1);return true;'> Go Back </button>";
	exit;
}


if($_GET['mod'] == "plus"){ //increase credits by 1
	$nordic_db=db_connect(); //connect to db
	$query = $nordic_db->prepare("UPDATE members set credits=credits+1 WHERE id=?"); 
	//parameters for query
	$query->bindParam(1, $_GET['id']); 
	$query->execute();
}
if($_GET['mod'] == "minus"){ //decrease credits by 1
	$nordic_db=db_connect(); //connect to db
	$query = $nordic_db->prepare("UPDATE members set credits=credits-1 WHERE id=?"); 
	//parameters for query
	$query->bindParam(1, $_GET['id']); 
	$query->execute();
}

// close connection to db
$nordic_db = null;
exit();
?>