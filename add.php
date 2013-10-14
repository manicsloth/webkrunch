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
echo "<h1>Add a new walk</h1>";
echo "<form action='addconfirm.php' method='post'>";
	echo "<label for='location'>Location:</label>";
	echo "<input type='text' name='location'>";
	echo "<label for='meet'>Meeting Place:</label>";
	echo "<input type='text' name='meet'>";
	echo "<label for='directions'>Directions:</label>";
	echo "<input type='text' name='directions'>";
	echo "<label for='details'>About:</label>";
	echo "<input type='text' name='details'>";
	echo "<label for='dogs'>Dogs:</label>";
	echo "<select name='dogs'>";
		echo "<option value='y'>Yes, dogs allowed</option>";
		echo "<option value='n'>No, dogs not allowed</option>";
	echo "</select>";
	echo "<label for='wtime'>Walk Time:</label>";
	echo "<input type='text' name='wtime'>";
	echo "<label for='distance'>Distance:</label>";
	echo "<input type='text' name='distance'>";
	echo "<label for='imageurl'>Image Location:</label>";
	echo "<input type='text' name='iamgeurl'>";
	echo "<label for='url'>KML file location:</label>";
	echo "<input type='text' name='url'>";
	echo "<input type='submit'>";
echo "</form>";

?>