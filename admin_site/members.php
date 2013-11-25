<?php
	$title="Members";
	require"header.php";

	//kick user to login page if not logged in.
	if(!isset($_SESSION['activeuser']) | empty($_SESSION['activeuser'])){
		header("Location:admin_login.php");
		exit;
	}
	//check if currently logged in admin has the correct permission for this page
	$perm_check = permission_check($_SESSION['activeuser_permissions'], 'L');
	if($perm_check == "no"){
		echo"<h2>Sorry, you do not have sufficient permissions to view this page.</h2> ";
		echo"<br /><button  onClick='history.go(-1);return true;'> Go Back </button>";
		exit;
	}


	//check if user has done a search and store in variable if so.
	if(isset($_GET['searchbox']) && !empty($_GET['searchbox']) ){
		$search=$_GET['searchbox'];
	}
	//otherwise set search term to be 'all' as default.
	else{
		$search= "all";
	}

?>
<div id="content">
	<div id="heading">
		<h1>
			Member List
		</h1>
		<a href="logout.php">
			<button id="logout">
				Logout
			</button>
		</a>
		<a href="admin_home.php"><button id="return_button">Return to Admin Home</button></a>
	</div>
	


	<form name="search" id="searchform" action="members.php" method="get">
		<label for="searchbox">
			Search for member: 
		</label>
		<input name="searchbox" id="searchbox" />
		<a href="members.php"><img src="images/icons/undo.png" id="searchbox_reset" /></a>
	</form>
	<?php 
		//retrieve member data from db, based on users search if search is done (if not then show all members) and print into table.
		
		//run function to search for members
		$query= get_member_data($search); 

		//if no members found
		if($query=="n/a"){
			echo "<br /><p>No members found for search term '$search'.</p>";
		}
		//else make table
		else{
			echo "<table id='member_list'>
				<tr>
					<th>ID No.</th>
					<th>Name</th>
					<th>Location</th>
					<th>Credits</th>
				</tr>";
		
			//for each row in the table
			while($data= $query ->fetch(PDO::FETCH_ASSOC)) {

				
				
				//store that rows data into variables
				$id=$data['id'];
				$name= $data['fname'];
				$location= $data['town'];
				$credits= $data['credits'];

				 //make new table row
				echo '<tr>';
				//echo each row out with link to view that member on click
				echo '<td  onclick="document.location =' . " 'view_member.php?id=$data[id]'" . ' ;" id="'. $id . '">' . $id . '</td>';
				echo '<td  onclick="document.location =' . " 'view_member.php?id=$data[id]'" . ' ;">' . $name . '</td>';
				echo '<td  onclick="document.location =' . " 'view_member.php?id=$data[id]'" . ' ;">' . $location . '</td>';
				echo '<td  onclick="document.location =' . " 'view_member.php?id=$data[id]'" . ' ;">' . $credits . '</td>';
				
				echo "</tr>";
			}
			echo "</table>";
			echo "<p><a href='#heading'>	Return to top</a></p>";
		}

	?>
</div>
</body>
</html>


