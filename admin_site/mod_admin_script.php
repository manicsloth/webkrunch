<?php
session_start();
require 'functions.php';
//check user is logged in
if(!isset($_SESSION['activeuser']) | empty($_SESSION['activeuser'])){
		header("Location:admin_login.php");
		exit;
	}
//check permissions
$perm_check = permission_check($_SESSION['activeuser_permissions'], 'Y');
if($perm_check == "no"){
	echo"<h2>Sorry, you do not have sufficient permissions to view this page.</h2> ";
	echo"<br /><button  onClick='history.go(-1);return true;'> Go Back </button>";
	exit;
}
//check for the existence of 'delete' in GET data, if this exists then  delete the admin account otherwise proceed to modify the data.
if(isset($_GET['delete']) && $_GET['delete'] == "true"){
	//check an admin is not deleting themselves..
	if($_GET['admin'] == $_SESSION['activeuser']){
		echo "Error - You cannot delete the account you are currently logged in as. <br /> <a href='admins.php'><button> Return </button></a>";
		exit;
	}

	//run query to delete the admin user
	$nordic_db=db_connect(); //connect to db
	$query = $nordic_db->prepare("DELETE FROM admins WHERE username =?");
	$query->bindParam(1, $_GET['admin']);
	$query->execute();
	//close connection to db
	$nordic_db = null;
	// return user to admins page and exit to make sure that the rest of this script does not run
	header("Location:admins.php");
	exit;
}


//check for POST data with data and if missing then redirect to admin home page.
if(!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['email']) || !isset($_POST['perms'])){
	echo "There has been an error. Missing POST data. <br /><emp><a href='admin_home.php'> Please click to return.</a><emp>";
	exit;
}

//convert permissions POST array into string of characters
$perms= "";
foreach($_POST['perms'] as $x){
	$perms.=  $x;
}

$nordic_db=db_connect(); //connect to db

//query to update database with new data
$query = $nordic_db->prepare("UPDATE admins set username=?, password=?, email=?, permissions=? WHERE username=?"); 
//parameters for query
$query->bindParam(1, $_POST['username']); 
$query->bindParam(2, $_POST['password']); 
$query->bindParam(3, $_POST['email']); 
$query->bindParam(4, $perms); 
$query->bindParam(5, $_POST['username']); 
//execute the query
$query->execute();
//return user to the admins page.
header("Location:admins.php");

?>;