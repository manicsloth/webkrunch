<?php
	$title="Modify Admin";
	require"header.php";

	//kick user to login page if not logged in.
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
	
	//check for get data with admin username. if it is missing then redirect to admin list.
	if(!isset($_GET['admin']) || empty($_GET['admin'])){
	//	header("Location:admins.php");
	//	exit;
	}

	//LOAD USER DATA
	$query= get_admin_data($_GET['admin']); //run function to get admin data from DB
	$admin_data= $query ->fetch(PDO::FETCH_ASSOC); //extract data into array
?>
<div id="content">

	<form id="mod_admin" action="mod_admin_script.php" method="post" >		
		<label for="username">
			Username
		</label>
		<input type="text" id="username" name="username" value="<?php echo $admin_data['username']; ?>" hidden />
		<?php echo $admin_data['username']; ?>
		<br />
		<label for="password">
			Password
		</label>
		<input type="text" name="password" id="password" maxlength="25" value="<?php echo $admin_data['password']; ?>" />
		<br />
		<label for="email">
			Email
		</label>
		<input type="text" name="email" id="email" maxlength="250" value="<?php echo $admin_data['email']; ?>" />
		<br />
		<label>
			Permissions
		</label>
		<input type="text" name="permissions" id="permissions" maxlength="25" value="<?php echo $admin_data['permissions']; ?>" />		
		<br />
		<fieldset>
			<legend>
				Permissions
			</legend>
			<input type="checkbox" id="all_perms" name="perms[0]" value="Z" onclick="showMe('permission_2')" <?php if(isset($admin_data['permissions'])){ if(strpos($admin_data['permissions'], 'Z')  !== false){ echo "checked";}} ?>>All [Z] - <span class="emp_red">(This will allow to user to access everything below, including the admin account control pannel)</span><br>
			<br />
			<div id="permission_2">
				<input type="checkbox" name="perms[]" value="Y" <?php if(isset($admin_data['permissions'])){ if(strpos($admin_data['permissions'], 'Y')  !== false){ echo "checked";}} ?>>Admin Control Pannel [Y]<br>
				<fieldset>
					<legend>
						Members
					</legend>
					<input type="checkbox" name="perms[]" class="members" value="L" <?php if(isset($admin_data['permissions'])){ if(strpos($admin_data['permissions'], 'L')  !== false){ echo "checked";}} ?> >View Member List [L]<br>

					<input type="checkbox" name="perms[]" class="members" value="V" <?php if(isset($admin_data['permissions'])){ if(strpos($admin_data['permissions'], 'V')  !== false){ echo "checked";}} ?> >See Detailed User Data [V]<br>

					<input type="checkbox" name="perms[]" class="members" value="A" <?php if(isset($admin_data['permissions'])){ if(strpos($admin_data['permissions'], 'A')  !== false){ echo "checked";}} ?> >Account Status (Enable, Disable, Verify) [A]<br>

					<input type="checkbox" name="perms[]" class="members" value="H" <?php if(isset($admin_data['permissions'])){ if(strpos($admin_data['permissions'], 'H')  !== false){ echo "checked";}} ?> >Health &amp; Saftey Form (Accept, Decline, Revoke) [H]<br>

					<input type="checkbox" name="perms[]" class="members" value="C" <?php if(isset($admin_data['permissions'])){ if(strpos($admin_data['permissions'], 'C')  !== false){ echo "checked";}} ?> >Credits (Increase, Decrease) [C]<br>

					<input type="checkbox" name="perms[]" class="members" value="M" <?php if(isset($admin_data['permissions'])){ if(strpos($admin_data['permissions'], 'M')  !== false){ echo "checked";}} ?> >Modify Member Data (Including Name, Email, Address etc) [M]<br>

				</fieldset>
			</div>
		</fieldset>
	<input type="submit" />
</form>

<button onclick="comfirmAdminDelete('<?php echo $admin_data['username'];?>')">Delete Admin Account</button>
</div>