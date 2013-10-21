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
// Convert POSt data to standard variables
$location = $_POST['location'];
$meet = $_POST['meet'];
$directions = $_POST['directions'];
$details = $_POST['details'];
$dogs = $_POST['dogs'];
$wtime = $_POST['wtime'];
$distance = $_POST['distance'];
$url = $_POST['url'];
$imageurl = $_POST['imageurl'];
// grab largest id on file already
$nordic_db=db_connect();
$query = $nordic_db->prepare("select `id` from `walks` order by `id`");
$query->execute();
$query ->fetch(PDO::FETCH_ASSOC);
$id = ($query['id']['1']);
echo "$id";




?>
