<?php

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
$id = $_POST['id'];
$nordic_db=db_connect();
	$query = $nordic_db->prepare("select `location` , `meet` , `directions` , `details` , `dogs` , `wtime` , `distance` , `imageurl` , `url` from `walks` where `walks`.`id` = ?");
	$query->execute(array($id));
	$data= $query ->fetch(PDO::FETCH_ASSOC);
	echo "<form action='walkeditconfirm.php' method='post'>";
		echo "<div class='routes' width='100%''>";
	          	echo "<table border=1>";
	          		echo "<tr>";
	          			echo "<td>Location:</td>";
	          			echo "<td><input type='text' value='$data[location]'></td>";
	          		echo "</tr>";
	          		echo "<tr>";
	          			echo "<td>Meeting Point:</td>";
	          			echo "<td><input type='text' value='$data[meet]'></td>";
	          		echo "</tr>";
	          		echo "<tr>";
	          			echo "<td height='20em'>Directions:</td>";
	          			echo "<td height='20em'><input type='text' value='$data[directions]'></td>";
	          		echo "</tr>";
	          		echo "<tr>";
	          			echo "<td height='100'>About:</td>";
	          			echo "<td height='100'><textarea rows='5' name='details'>$data[details]</textarea></td>";
	          		echo "</tr>";
	          		echo "<tr>";
	          			echo "<td>Dogs:</td>";
	          			echo "<td><input type='text' value='$data[dogs]'></td>";
	          		echo "</tr>";
	          		echo "<tr>";
	          			echo "<td>Walk Time:</td>";
	          			echo "<td><input type='text' value='$data[wtime]'></td>";
	          		echo "</tr>";
	          		echo "<tr>";
	          			echo "<td>Distance:</td>";
	          			echo "<td><input type='text' value='$data[distance]'></td>";
	          		echo "</tr>";
	          		echo "<tr>";
	          			echo "<td>Map:</td>";
	          			echo "<td><input type='text' value='$data[url]'></td>";
	          		echo "</tr>";
	          		echo "<tr>";
	          			echo "<td>Update this walk?</td>";
	          			echo "<td><input type='submit'></td>";
	          		echo "</tr>";
	          	echo "</table>";
	          echo "</div>";
	       echo "</form>";

?>