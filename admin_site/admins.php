<?php
	$title="Admin Users";
	require"header.php";

	//kick user to login page if not logged in.
	if(!isset($_SESSION['activeuser']) | empty($_SESSION['activeuser'])){
		header("Location:admin_login.php");
		exit;
	}
	//check if currently logged in admin has the correct permission for this page
	$perm_check = permission_check($_SESSION['activeuser_rank'], 'Y');
	if($perm_check == "no"){
		echo"<h2>Sorry, you do not have sufficient permissions to view this page.</h2> ";
		echo"<br /><button  onClick='history.go(-1);return true;'> Go Back </button>";
		exit;
	}

	//obtain admin data from db, echo into list
	$data=get_admin_data("all");

	echo "<table id='member_list'>
		<tr>
			<th>Username</th>
			<th>Password</th>
			<th>Permissions</th>
		</tr>";

	//for each row in the table
	while($data= $query ->fetch(PDO::FETCH_ASSOC)) {

	
	
	//store that rows data into variables
	$username= $data['username'];
	$password= $data['password'];
	$rank= $data['rank'];

	 //make new table row
	echo '<tr>';
	//echo each row out with link to view that order on click
	echo '<td  onclick="document.location =' . " 'view_member.php?id=$data[id]'" . ' ;" id="'. $id . '">' . $id . '</td>';
	echo '<td  onclick="document.location =' . " 'view_member.php?id=$data[id]'" . ' ;">' . $name . '</td>';
	echo '<td  onclick="document.location =' . " 'view_member.php?id=$data[id]'" . ' ;">' . $location . '</td>';
	echo '<td  onclick="document.location =' . " 'view_member.php?id=$data[id]'" . ' ;">' . $credits . '</td>';
	
	echo "</tr>";
}
echo "</table>";
echo "<p><a href='#heading'>	Return to top</a></p>";
}
