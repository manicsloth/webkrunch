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


echo "<h1>Remove a walk from the database.</h1>";
echo "<p>Warning: This cannot be undone, all changes are permenant.</p>";
echo "<form action='removeconfirm.php' method='post'>";
	echo "<select name='location' id='location'>";
	$nordic_db=db_connect();
	$query = $nordic_db->prepare("select 'id' , `location` from `walks`");
	$query->execute();
	while($data= $query ->fetch(PDO::FETCH_ASSOC)) {
		echo "<option value='$data[id]'>$data[location]</option>";
	}
	echo "</select>";
	echo "<input type='submit'>";
echo "</form>";
?>
