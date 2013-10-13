<?
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
$location=$_POST['location'];
echo $location;
$nordic_db=db_connect();
	$query = $nordic_db->prepare("delete from `walks` where `walks`.`location` = ?");
	$query->execute(array($location));