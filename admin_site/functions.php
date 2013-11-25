<?php

//db connection info
function db_connect() {
	$config['db'] = array(
		'host'		=> 'localhost',
		'username'	=> 'administrator',
		'password'	=> 'parad1Gm',
		'dbname'	=> 'nordic'
		);
	$nordic_db= new PDO('mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['dbname'], $config['db']['username'],$config['db']['password']);
	return $nordic_db;
}


function get_member_data($search){
//function to retrieve member data based on search terms
	$nordic_db=db_connect(); //connect to db

	if ($search == "all"){ //if search is 'all' then search with no parameters, used to generate list of all members
		$query = $nordic_db->prepare("select * from `members`"); 
	}
	elseif(is_numeric($search)) { //if search is only numbers - i.e. a members id
		$query = $nordic_db->prepare("select * from `members` WHERE id=?"); 
		$query->bindParam(1, $search); 
	}
	else{//search for a members name
		//split up string on whitespace into an array
		$search = preg_split('/\s+/', $search);

		//assign first part of array to its own variable and apply wild card to search for results that start with the search terms. (e.g  'bo' will find 'bob, will not find 'bill''
		$search1 = "$search[0]%";
		//check if there is second part of array, and if so store it in its own variable and add wildcard
		if(isset($search['1'])){
			$search2 = "$search[1]%";
		}

		//if there was a second part to array, assume the user input is fname and sname and create appropriate query. Otherwise search for only fname,
		if(isset($search2)){
			$query = $nordic_db->prepare("select * from `members` WHERE fname like ? and sname like ?"); 
			$query->bindParam(1, $search1); 
			$query->bindParam(2, $search2);
		}
		else{
			$query = $nordic_db->prepare("select * from `members` WHERE fname like ?"); 
			$query->bindParam(1, $search1); 
		}
	}

	//execute the query, and count the results.
	$query->execute();
	$count = $query->rowCount();

	if ($count == 0) {//no matches found
		$query="n/a";
	}

	// close connection to db
	$nordic_db = null;
	//return results to script calling this function
	return $query;
	exit();
}

function get_admin_data($search){
//function to get admin data, either specific admin or list of all

	$nordic_db=db_connect(); //connect to db
	if ($search == "all"){ //if search is 'all' then search with no parameters, used to generate list of all members
		$query = $nordic_db->prepare("select * from `admins`"); 
	}
	else{ //search for specified admin by username
		$query = $nordic_db->prepare("select * from `admins` WHERE username=?"); 
		$query->bindParam(1, $search); 
	}

	$query->execute();
	//close connection to db
	$nordic_db = null;
	//return results to script calling this function
	return $query;
	exit();

}

function get_age($dob_month,$dob_day,$dob_year){
//function to calculate age from date

	$year   = gmdate('Y');
	$month  = gmdate('m');
	$day    = gmdate('d');
	//seconds in a day = 86400
	$days_in_between = (mktime(0,0,0,$month,$day,$year) - mktime(0,0,0,$dob_month,$dob_day,$dob_year))/86400;
	$age_float = $days_in_between / 365.242199; // Account for leap year
	$age = (int)($age_float); // Remove decimal places without rounding up once number is + .5
	return $age;

}

function mod_acc_status($id, $new_acc_status){
	//function to modify a members account status.

	if($new_acc_status == "enable" | $new_acc_status == "verify"){ //if account toggle from disable to enabled, or is manually 'email verification' is done.
		$status="1";
	}
	if($new_acc_status == "disable"){
		$status ="-1";
	}

	$nordic_db=db_connect(); //connect to db
	$query = $nordic_db->prepare("UPDATE members set account_status=? WHERE id=?"); 
	//parameters for query
	$query->bindParam(1, $status); 
	$query->bindParam(2, $id); 
	//execute the query, and count the results.
	$query->execute();
	//close connection to db
	$nordic_db = null;
}


function mod_hs_status($id, $new_hs_status){
	//function to modify a members account status.

	if($new_hs_status == "verify"){
		$status="2";
	}
	if($new_hs_status == "revoke"){
		$status ="-1";
	}

	$nordic_db=db_connect(); //connect to db
	$query = $nordic_db->prepare("UPDATE members set hs_status=?, hs_admin=? WHERE id=?"); 
	//parameters for query
	$query->bindParam(1, $status); 
	$query->bindParam(2, $_SESSION['active_user']); 
	$query->bindParam(3, $id); 
	//execute the query, and count the results.
	$query->execute();
	//close connection to db
	$nordic_db = null;
}


function permission_check($permissions, $req){
	//function to check a users permission and match it against a requirement.

	//if character Z is found then return yes
	if(strpos($permissions, 'Z')  !== false){
		$result = "yes";
		return $result;
		end;
	}
	//if the specified character is found, return yes
	elseif(strpos($permissions, $req)  !== false){
		$result = "yes";
		return  $result;
		end;
	}
	//otherwise return no
	else{
		$result = "no";
		return $result;
		end;
	}
}


?>




<!-- JAVASCRIPT FUNCTIONS -->

<script>

//Function to decrease credits by one
function minus_credit(str)
{

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","adjust_credit.php?mod=minus&id="+str,true);
xmlhttp.send();
setTimeout(function(){location.reload();}, 100);
}

//Function to increase credits by one
function plus_credit(str)
{

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","adjust_credit.php?mod=plus&id="+str,true);
xmlhttp.send();
setTimeout(function(){location.reload();}, 100);
}



function comfirmAdminDelete(username){
var x = confirm('Are you sure you want to delete this account?');
	if( x ==true){
		window.location = "mod_admin_script.php?admin="+username+"&delete=true";
	}
	else{
		null;
	}
}

function showMe (box) {
//function to show and hide list of permission on new admin page when selecting the "all" checkbox
    var chboxs = document.getElementsByName("perms[0]");
    var vis = "block";
    for(var i=0;i<chboxs.length;i++) { 
        if(chboxs[i].checked){
         vis = "none";
            break;
        }
    }
    document.getElementById(box).style.display = vis;

}
</script>