<!--
	Create a connection to SQL
	Created 9/22
	Author: Steve Cina
-->
<?php
	define('DB_SERVER','localhost');
	define('DB_USERNAME','pd_user');
	define('DB_PASSWORD','pr1nt3rDyn@1c$');
	define('DB_NAME','pd');


$link = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

if ($link === false){
	die("Error connecting to database.");
} else {
	# For troubleshooting, uncomment next line
	#echo("Succesfully connected to database!<br />");
}
?>
