<?php

	$dsn = "mysql:host=localhost;dbname=doostr";
	$user = "root";
	$pass = "";
	
	
	try
	{
		$db = new DBO($dsn, $user, $pass);
	}
	catch (PDOException $e)
	{
		$error_message = $e->getMessage();
		include_once("error_database.php");
		exit();
	}

?>