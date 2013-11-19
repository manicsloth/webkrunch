	<?php
	$title="View Member";
	require"header.php";


	//kick user to login page if not logged in.
	if(!isset($_SESSION['activeuser']) | empty($_SESSION['activeuser'])){
		header("Location:admin_login.php");
		exit;
	}
	//check if currently logged in admin has the correct permission for this page
	$perm_check = permission_check($_SESSION['activeuser_permissions'], 'V');
	if($perm_check == "no"){
		echo"<h2>Sorry, you do not have sufficient permissions to view this page.</h2> ";
		echo"<br /><button  onClick='history.go(-1);return true;'> Go Back </button>";
		exit;
	}

 	//check for get data with member id, if missing then redirect to member list.
	if(!isset($_GET['id']) || empty($_GET['id'])){
		header("Location:members.php");
		exit;
	}

	//check for new acc status or new hs status in GET if yes then run appropriate function
	if(isset($_GET['new_acc_status'])){
		mod_acc_status($_GET['id'],$_GET['new_acc_status']);
	}
	if(isset($_GET['new_hs_status'])){
		mod_hs_status($_GET['id'],$_GET['new_hs_status']);
	}

	//LOAD USER DATA
	$query= get_member_data($_GET['id']); //run function to get member data from DB
	$member_data= $query ->fetch(PDO::FETCH_ASSOC); //extract data into array
?>

<div id="content">
	<div id="heading">
		<h1>
			<?php echo $member_data['fname'] . " " . $member_data['sname']; ?>
		</h1>
		<a href="logout.php">
			<button id="logout">
				Logout
			</button>
		</a>
		<a href="members.php#<?php echo $member_data['id'] ; ?>"><button id="return_button">Return to Member List</button></a>
	</div>
	<!-- echo data into table -->
	<table id="member_data">
		<tr>
			<th>
				Account Status
			</th>
			<td>
				<?php 	
					//Output the accounts status, if the admin has permission also show controls.
					switch ($member_data['account_status']){
						//check the account status and show different message / button depending
					    case -1: //if account is disabled. offer button to enable
					    	echo "<span class='emp_red'>Account has been disabled.</span>";
					    		$perm_check = permission_check($_SESSION['activeuser_permissions'], 'A');
							if($perm_check == "yes"){
						    		echo" <br/> <a href='view_member.php?id=$member_data[id]&new_acc_status=enable'><button id='enable_acc'> Enable Account </button></a>";
						  	  }
					    break;
					    case 0: //if account is still awaiting verification via email. offer button to manually verify.
					    	echo "Account awaiting verification via email.";
					    	$perm_check = permission_check($_SESSION['activeuser_permissions'], 'A');
						if($perm_check == "yes"){
					    		echo "<br/> <a href='view_member.php?id=$member_data[id]&new_acc_status=verify'><button id='enable_acc'>Verify Account </button></a>";
					    	}
					    break;
					    case 1: // if account is active and in good standing. offer button to disable.

					    	echo "<span class='emp_green'>Member's account is active.</span>";
					   	$perm_check = permission_check($_SESSION['activeuser_permissions'], 'A');
						if($perm_check == "yes"){
					    		echo "<br/> <a href='view_member.php?id=$member_data[id]&new_acc_status=disable'><button id='disable_acc'> Disable Account </button></a>";
					    	}
					    break;
					}
				?>
			</td>
		</tr>
		<tr>
			<th>
				ID
			</th>
			<td>
				<?php echo $member_data['id']; ?>
			</td>
		</tr>
		<tr>
			<th>
				Name
			</th>
			<td>
				<?php echo $member_data['fname'] . " " . $member_data['sname']; ?>
			</td>
		</tr>
		<tr>
			<th>
				Age
			</th>
			<td>
				<?php 
					$dob_ex = (explode("-",$member_data['dob'])); //explode date from db
					$age = get_age($dob_ex['1'], $dob_ex['2'], $dob_ex['0'] ); //run function to calculate age
					echo " $age ($dob_ex[2]/$dob_ex[1]/$dob_ex[0])";  //echo both age and dob in dd/mm/yy format.
				?>
			</td>
		</tr>
		<tr>
			<th>
				Address
			</th>
			<td>
				<?php 
					echo $member_data['address'] . "<br>" . $member_data['town'] . "<br>" . $member_data['postcode']; ?>
			</td>
		</tr>
		<tr>
			<th>
				Email
			</th>
			<td>
				<?php 
					echo $member_data['email'] ?>
			</td>
		</tr>
		<tr>
			<th>
				Emergency Contact Number
			</th>
			<td>
				<?php 
					echo $member_data['emerg_contact'] ?>
			</td>
		</tr>
		<tr>
			<th>
				Health and Safety Form
			</th>
			<td>
				<?php  //check status of health and safety form, output link to view it (pdf) if applicable. If admin has correct permission show control buttons.
					if($member_data['hs_status'] == "0"){
						echo "Health and saftey form has not been submitted yet";
						$perm_check = permission_check($_SESSION['activeuser_permissions'], 'H');
						if($perm_check == "yes"){
							echo "<br /><a href='view_member.php?id=$member_data[id]&new_hs_status=verify'><button id='verify_hs'>Manual Verify</button></a>";
						}
					}
					if($member_data['hs_status'] == "1"){
						echo "<a href='hsforms/form.pdf'>Submitted and awaiting verification - Click to open</a>";
						$perm_check = permission_check($_SESSION['activeuser_permissions'], 'H');
						if($perm_check == "yes"){
							echo "<br /><a href='view_member.php?id=$member_data[id]&new_hs_status=verify'><button id='verify_hs'>Verify</button></a>";
							echo "<br /><a href='view_member.php?id=$member_data[id]&new_hs_status=revoke'><button id='revoke_hs' class='emp_red'>Deny</button></a>";
						}
					}
					if($member_data['hs_status'] == "2"){
						echo "<span class='emp_green'>Completed and Verified- </span><a href='hsforms/form.pdf'>Click to open</a>";
						$perm_check = permission_check($_SESSION['activeuser_permissions'], 'H');
						if($perm_check == "yes"){
							echo "<br /><a href='view_member.php?id=$member_data[id]&new_hs_status=revoke'><button id='revoke_hs' class='emp_red'>Revoke</button></a>";
						}
					}
					if($member_data['hs_status'] == "-1"){
						echo "<span class='emp_red'>HS Denied - </span><a href='hsforms/form.pdf'>Click to open</a>";
						$perm_check = permission_check($_SESSION['activeuser_permissions'], 'H');
						if($perm_check == "yes"){
							echo "<br /><a href='view_member.php?id=$member_data[id]&new_hs_status=verify'><button id='verify_hs' class='emp_green'>Verify</button></a>";
						}
					}


				?>
			</td>
		</tr>
			<tr>
			<th>
				Credits
			</th>
			<td>
				<?php //shows users credits, if admin has correct permission will show plus and minus buttons 
				$perm_check = permission_check($_SESSION['activeuser_permissions'], 'C');
				if($perm_check == "yes"){
					echo "<button id='minus_credit' onclick='minus_credit(" . '"' . "$member_data[id]" . '"' . ")'><img src='images/icons/minus.png'/></button>";
				}
				echo "<span id='credit'>$member_data[credits]</span>";
				$perm_check = permission_check($_SESSION['activeuser_permissions'], 'C');
				if($perm_check == "yes"){
					echo "<button id='add_credit' onclick='plus_credit(" . '"' . "$member_data[id]" . '"' . ")'><img src='images/icons/plus.png'/></button>";
				}
				?>
			</td>
		</tr>
	</table>
	<?php 
		//If admin has correct permission, add a button to allow them to go to the page to modify members data
		$perm_check = permission_check($_SESSION['activeuser_permissions'], 'M');
		if($perm_check == "yes"){
		echo "<a href='mod_member.php?id=$member_data[id]'><button id='mod_member'>Modify Member Data</button></a>";
		}
	?>
</div>
</body>
</html>