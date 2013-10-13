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
$location = $_POST['location'];
$nordic_db=db_connect();
	$query = $nordic_db->prepare("select `location` , `meet` , `directions` , `details` , `dogs` , `wtime` , `distance` , `imageurl` , `url` from `walks` where `walks`.`location` = ?");
	$query->execute(array($location));
	while($data= $query ->fetch(PDO::FETCH_ASSOC)) {

			

          echo "<div class='routes'>";
          	echo "<table border=1>";
          		echo "<tr>";
          			echo "<td>Location:</td>";

          			echo "<td>$data[location]</td>";
          		echo "</tr>";
          		echo "<tr>";
          			echo "<td>Meeting Point:</td>";
          			echo "<td>$data[meet]</td>";
          		echo "</tr>";
          		echo "<tr>";
          			echo "<td>Directions:</td>";
          			echo "<td>$data[directions]</td>";
          		echo "</tr>";
          		echo "<tr>";
          			echo "<td>About:</td>";
          			echo "<td>$data[details]</td>";
          		echo "</tr>";
          		echo "<tr>";
          			echo "<td>Dogs:</td>";
          			echo "<td>$dogs</td>";
          		echo "</tr>";
          		echo "<tr>";
          			echo "<td>Walk Time:</td>";
          			echo "<td>$data[wtime]</td>";
          		echo "</tr>";
          		echo "<tr>";
          			echo "<td>Distance:</td>";
          			echo "<td>$data[distance]</td>";
          		echo "</tr>";
          		echo "<tr>";
          			echo "<td>Map:</td>";
          			echo "<td><a href='$data[url]'>Map</a></td>";
          		echo "</tr>";
          	echo "</table>";
          echo "</div>";
    }
      
echo "<h1>Are you sure you want to remove the selected walk from the database? This action is not reversible.</h1>";
echo "<p>To go back and select another walk to delete <a href='remove.php'>click here.</a></p>";
echo "<p>To add a walk instead <a href='add.php'>click here.</a></p>";
echo "<p>To delete the selected walk click submit below:</p>";

echo "<form action='removeconfirmed.php' method='post'>";
    echo "<input type='text' name='location' value=$location>";
    echo "<input type='submit'>";
echo "</form>";

?>