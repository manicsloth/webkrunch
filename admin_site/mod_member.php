<?php
	$title="Modify Member";
	require"header.php";

	//kick user to login page if not logged in.
	if(!isset($_SESSION['activeuser']) | empty($_SESSION['activeuser'])){
		header("Location:admin_login.php");
		exit;
	}
	//check permissions
	$perm_check = permission_check($_SESSION['activeuser_permissions'], 'M');
	if($perm_check == "no"){
		echo"<h2>Sorry, you do not have sufficient permissions to view this page.</h2> ";
		echo"<br /><button  onClick='history.go(-1);return true;'> Go Back </button>";
		exit;
	}
	
	//check for get data with member id. if it is missing then redirect to member list.
	if(!isset($_GET['id']) || empty($_GET['id'])){
		header("Location:members.php");
		exit;
	}

	//LOAD USER DATA
	$query= get_member_data($_GET['id']); //run function to get member data from DB
	$member_data= $query ->fetch(PDO::FETCH_ASSOC); //extract data into array
?>


<form id="mod_member_form" action="mod_member_script.php" method="post" >
	<table id="member_data">
		<tr>
			<th>
				ID
			</th>
			<td>
				<input type="text" id="id" name="id" value="<?php echo $member_data['id']; ?>" hidden />
				<?php echo $member_data['id']; ?>
			</td>
		</tr>
		<tr>
			<th>
				First Name
			</th>
			<td>
				<input type="text" name="fname" id="fname" maxlength="25" value="<?php echo $member_data['fname']; ?>" />
			</td>
		</tr>
		<tr>
			<th>
				Surname
			</th>
			<td>
				<input type="text" name="sname" id="sname" maxlength="25" value="<?php echo $member_data['sname']; ?>" />
			</td>
		</tr>
				<tr>
			<th>
				Date of Birth<br/>(yyyy-mm-dd)
			</th>
			<td>
				<input type="text" name="dob" id="dob" value="<?php echo $member_data['dob']; ?>" />
			</td>
		</tr>
		<tr>
			<th>
				Street Address
			</th>
			<td>
				<textarea name="address" id="address" maxlength="300" ><?php echo $member_data['address']; ?> </textarea>
			</td>
		</tr>
		<tr>
			<th>
				Town
			</th>
			<td>
				<input type="text" name="town" id="town" maxlength="30" value="<?php echo $member_data['town']; ?>" />
			</td>
		</tr>
		<tr>
			<th>
				Postcode
			</th>
			<td>
				<input type="text" name="postcode" id="postcode" maxlength="10" value="<?php echo $member_data['postcode']; ?>" />
			</td>
		</tr>
		<tr>
			<th>
				Emergency Contact Number
			</th>
			<td>
				<input type="text" name="emerg_contact" id="emerg_contact" maxlength="25" value="<?php echo $member_data['emerg_contact']; ?>" />
			</td>
		</tr>
		<tr>
			<th>
				Email
			</th>
			<td>
				<input type="text" name="email" id="email" maxlength="350" value="<?php echo $member_data['email']; ?>" />
			</td>
		</tr>
		<tr>
			<th>
				Credits
			</th>
			<td>
				<input type="text" name="credits" id="credits" maxlength="11" value="<?php echo $member_data['credits']; ?>" />
			</td>
		</tr>
	</table>
	<input type="submit" />
</form>