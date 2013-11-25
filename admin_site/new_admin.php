<?php
	$title="New Admin";
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
			New Admin
		</h1>
		<a href="logout.php">
			<button id="logout">
				Logout
			</button>
		</a>
		<a href="admin_home.php"><button id="return_button">Return to Admin Home</button></a>
	</div>
	<?php 
		if(isset($_SESSION['new_admin_errors'])){
			echo "<div id='errors'>";
			echo $_SESSION['new_admin_errors'];
			echo "</div>";
		}


	?>
	<form id="new_admin" method="post" action="new_admin_script.php">
		<!-- PHP used to echo data back into form from session variable upon return to this page after error in new_admin_script.php -->
		<label for="username">
			Username: 
		</label>
		<input type="text" id="username" name="username" <?php if(isset($_SESSION['new_admin_username'])){echo "value='" . $_SESSION['new_admin_username'] . "'" ; }?>/>
		<br />
		<label for="password">
			Password: 
		</label>
		<input type="password" id="password" name="password" />
		</br>
		<label for="email">
			Email:
		</label>
		<input type="text" id="email" name="email" <?php if(isset($_SESSION['new_admin_email'])){echo "value='" . $_SESSION['new_admin_email'] . "'" ; }?> />
		<fieldset>
			<legend>
				Permissions
			</legend>
			<input type="checkbox" id="all_perms" name="perms[0]" value="Z" onclick="showMe('permission_2')" <?php if(isset($_SESSION['new_admin_perms'])){ if(strpos($_SESSION['new_admin_perms'], 'Z')  !== false){ echo "checked";}} ?>>All [Z] - <span class="emp_red">(This will allow to user to access everything below, including the admin account control pannel)</span><br>
			<br />
			<div id="permission_2">
				<input type="checkbox" name="perms[]" value="Y" <?php if(isset($_SESSION['new_admin_perms'])){ if(strpos($_SESSION['new_admin_perms'], 'Y')  !== false){ echo "checked";}} ?>>Admin Control Pannel [Y]<br>
				<fieldset>
					<legend>
						Members
					</legend>
					<input type="checkbox" name="perms[]" class="members" value="L" <?php if(isset($_SESSION['new_admin_perms'])){ if(strpos($_SESSION['new_admin_perms'], 'L')  !== false){ echo "checked";}} ?> >View Member List [L]<br>

					<input type="checkbox" name="perms[]" class="members" value="V" <?php if(isset($_SESSION['new_admin_perms'])){ if(strpos($_SESSION['new_admin_perms'], 'V')  !== false){ echo "checked";}} ?> >See Detailed User Data [V]<br>

					<input type="checkbox" name="perms[]" class="members" value="A" <?php if(isset($_SESSION['new_admin_perms'])){ if(strpos($_SESSION['new_admin_perms'], 'A')  !== false){ echo "checked";}} ?> >Account Status (Enable, Disable, Verify) [A]<br>

					<input type="checkbox" name="perms[]" class="members" value="H" <?php if(isset($_SESSION['new_admin_perms'])){ if(strpos($_SESSION['new_admin_perms'], 'H')  !== false){ echo "checked";}} ?> >Health &amp; Saftey Form (Accept, Decline, Revoke) [H]<br>

					<input type="checkbox" name="perms[]" class="members" value="C" <?php if(isset($_SESSION['new_admin_perms'])){ if(strpos($_SESSION['new_admin_perms'], 'C')  !== false){ echo "checked";}} ?> >Credits (Increase, Decrease) [C]<br>

					<input type="checkbox" name="perms[]" class="members" value="M" <?php if(isset($_SESSION['new_admin_perms'])){ if(strpos($_SESSION['new_admin_perms'], 'M')  !== false){ echo "checked";}} ?> >Modify Member Data (Including Name, Email, Address etc) [M]<br>

				</fieldset>
			</div>
			
		</fieldset>
		<input type="submit" />
	</form>
	<a href="admins.php"><button>Cancel</button></a>
	<?php //empty session vars to prevent data / errors being show again on reloading this page at later time
		$_SESSION['new_admin_perms'] = "";
		$_SESSION['new_admin_username'] = "";
		$_SESSION['new_admin_email'] = "";
		$_SESSION['new_admin_errors'] = "";
	?>

</body>
</html>
	