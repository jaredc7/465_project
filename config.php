<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$host="127.0.0.1";
$port=3306;
$socket="";
$user="root";
$password="mysqlpassword1!";
$dbname="bus_465";

// Creates connection to sql server
$db = mysqli_connect($host, $user, $password, $dbname, $port, $socket);

if(!$db)
{
	die ('Could not connect to the database server' . mysqli_connect_error());
}

?>

