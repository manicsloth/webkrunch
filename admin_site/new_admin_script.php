<?php
	session_start();
	require"functions.php";

	//kick user to login page if not logged in.
	if(!isset($_SESSION['activeuser']) | empty($_SESSION['activeuser'])){
		header("Location:admin_login.php");
		exit;
	}
	//check if currently logged in admin has the correct permission for this page
	$perm_check = permission_check($_SESSION['activeuser_permissions'], 'Y');
	if($perm_check == "no"){
		echo"<h2>Sorry, you do not have sufficient permissions to view this page.</h2> ";
		echo"<br /><button  onClick='history.go(-1);return true;'> Go Back </button>";
		exit;
	}
	

	//check for POST data with atleast username and password and if missing then redirect to admin home page.
	if(!isset($_POST['username']) || !isset($_POST['password'])){
		echo "There has been an error. Missing POST data. <br /><emp><a href='admin_home.php'> Please click to return.</a><emp>";
		exit;
	}
	//setup session var for data, also works to wipe any old data from previous submissions.
	$_SESSION['new_admin_errors'] = "";
	$_SESSION['new_admin_perms'] = "";
	$_SESSION['new_admin_username'] = "";
	$_SESSION['new_admin_email'] = "";




	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	//convert permissions POST array into string of characters
	$perms= "";
	foreach($_POST['perms'] as $x){
		$perms.=  $x;
	}

	//error if empty password or username or no perms selected
	if(empty($username) || empty($password) || empty($email) || empty($perms)){
		$_SESSION['new_admin_errors'] =  "<br />You must enter a username, password and email as well as select at least one permission.";
		goto error_check;
	}

	

	//check for already existing admin with same user name
	$nordic_db=db_connect(); //connect to db
	$query = $nordic_db->prepare("select `username` from `admins` WHERE username=?"); 
	$query->bindParam(1, $username); 
	$query->execute();
	$count = $query->rowCount(); //count results
	if ($count > 0) { //if a result is found, then username is already taken.
		$_SESSION['new_admin_errors'] =  "<br />An admin user with that Username already exists ($username)";
	}

	//check for already existing admin with same email
	$nordic_db=db_connect(); //connect to db
	$query = $nordic_db->prepare("select `email` from `admins` WHERE email=?"); 
	$query->bindParam(1, $email); 
	$query->execute();
	$count = $query->rowCount(); //count results
	if ($count > 0) { //if a result is found, then username is already taken.
		$_SESSION['new_admin_errors'].=  "<br />An admin user with that Email address already exists ($email)";
	}

	error_check:
	//check for errors - if there are errors return to new admin page to display them, also take form data with you to echo back into form (not password)
	if(!empty($_SESSION['new_admin_errors'])){
		//transfer data into session vars
		$_SESSION['new_admin_username'] = $username;
		$_SESSION['new_admin_email'] = $email;
		$_SESSION['new_admin_perms'] = $perms;
		//close db connection
		$nordic_db = null;
		header("Location:new_admin.php");
		exit;
	}
	//submit into database
	$nordic_db=db_connect(); //connect to db
	$query = $nordic_db->prepare("INSERT INTO admins (username, password, email, permissions) VALUES(?,?,?,?)"); 
	//parameters for query
	$query->bindParam(1, $username); 
	$query->bindParam(2, $password); 
	$query->bindParam(3, $email); 
	$query->bindParam(4, $perms); 
	//execute the query, and count the results.
	$query->execute();
	//close connection to db
	$nordic_db = null;

	//return to admin list.
	header("Location:admins.php");
	exit;
	