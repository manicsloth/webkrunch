<?php
//PHP script to handle admin login process.

require"functions.php"; session_Start();

//if no username / password in post data then return to login page. Prevent accidental visits to this page (e.g. entering login_script.php in url)
if (!isset($_POST['username'], $_POST['password'])){
	header("Location: admin_login.php"); 
	exit;
}

//extract  data from post. setup / clear the session variable for login errors.
$username = $_POST['username'];
$password = $_POST['password'];
$_SESSION['loginerrors'] = "";
	
//send user back to login page with error if either password or username is empty.
if(empty($username) || empty($password)){
	$_SESSION['loginerrors'] = "Please enter both your username and your password to login";
	header("Location: admin_login.php"); 
}
else {		
//check login username and password valid for admin login. return row count ( 0 = invalid login, 1 = valid, anything more means there are duplicates in db..)
	
	$nordic_db=db_connect(); //connect to db
	//select statement for user name and password
	$query = $nordic_db->prepare("select `username`, `rank` from `admins` WHERE username=? AND password=?"); 
	$query->bindParam(1, $username); 
	$query->bindParam(2, $password); 

	//execute the query, and count the results.
	$query->execute();
	$count = $query->rowCount();
	$data= $query ->fetch(PDO::FETCH_ASSOC); //extract data into array
	// close connection to db
	$nordic_db = null;
	

	//Correct password
	if ($count > 0) {//if user name + password match is found log them in and send to admin home page. also unset the username stored in session variable if exists (used to auto fill the form on login page when user fails login)
		$_SESSION['activeuser'] = $data['username'];
		$_SESSION['activeuser_rank'] = $data['rank'];

		if(isset($_SESSION['login_username'])){ 
			unset($_SESSION['login_username']);
		}
		header("Location:admin_home.php");			
	}

	// if wrong wrong password error and store user name in session variable to recall it on login page form
	else {
		mysqli_close($link);
		$_SESSION['loginerrors'] = "Sorry, incorrect username or password";
		$_SESSION['login_username'] = $username;
		$_SESSION['activeuser'] = "";
		mysqli_close($link);	
		header("Location: admin_login.php"); //send user back to login page
		exit;
	}
}
?>