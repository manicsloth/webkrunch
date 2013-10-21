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
$id=$_POST['id'];
echo $id;
$nordic_db=db_connect();
	$query = $nordic_db->prepare("select `id` , `location` , `details` from `walks` where `id` = ?");
	$query->execute(array($id));
	echo "The Following walk has been deleted from the database:";
	echo "Id = $query[id]";
	echo "Location: $query[location]";
	echo "About: $query[details]";
	$query = $nordic_db->prepare("delete from `walks` where `walks`.`id` = ?");
	$query->execute(array($id));
	?>