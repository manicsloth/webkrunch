<?php
	$title="Admin Users";
	require"header.php";

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
	//obtain admin data from db, echo into list
	$query=get_admin_data("all");
?>

<div id="content">
	<div id="heading">
		<h1>
			Admin List
		</h1>
		<a href="logout.php">
			<button id="logout">
				Logout
			</button>
		</a>
		<a href="admin_home.php"><button id="return_button">Return to Admin Home</button></a>
	</div>

	<a href="new_admin.php"><button> Create New Admin Account </button></a>
	<p> Click an admin to edit them </p>
<?php
	//table for outputing admin users as 'list'
	echo "<table id='member_list'>
		<tr>
			<th>Username</th>
			<th>Password</th>
			<th>Email</th>
			<th>Permissions</th>
		</tr>";

	//for each row in the table
	while($data= $query ->fetch(PDO::FETCH_ASSOC)) {

		//store that rows data into variables
		$username= $data['username'];
		//convert password into sample, show only first 3 characters and mask the rest with stars
		$password_count = strlen($data['password'])  - 3;
		$password = substr($data['password'], 0, 3) .  str_repeat("*", $password_count);
		$email= $data['email'];
		$permissions= $data['permissions'];

		echo '<tr>';
		//echo each row out with link to view that admin on click
		echo '<td  onclick="document.location =' . " 'mod_admin.php?admin=$username'" . ' ;" >' . $username . '</td>';
		echo '<td  onclick="document.location =' . " 'mod_admin.php?admin=$username'" . ' ;" >' . $password . '</td>';
		echo '<td  onclick="document.location =' . " 'mod_admin.php?admin=$username'" . ' ;" >' . $email . '</td>';
		echo '<td  onclick="document.location =' . " 'mod_admin.php?admin=$username'" . ' ;" >' . $permissions . '</td>';
		echo "</tr>";
	}
	echo "</table>";

?>