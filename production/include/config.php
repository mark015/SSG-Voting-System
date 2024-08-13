<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "db_ssg_voting_system";

	$mysql_connection_object = mysqli_connect($servername,$username,$password,$dbname);
	
	if ($mysql_connection_object->connect_error) {
		die("Connection failed: " . $mysql_connection_object->connect_error);
    }
?>