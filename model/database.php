<?php
	$dsn = 'mysql:host=localhost;dbname=doost';
	/* dsn stands for database server name*/
	$username = 'root';
	$password = '';

		try{
			$db = new PDO($dsn, $username, $password);
		} catch (PDOException $e){
			$error_message = $e->getMessage();
			include_once('error_database.php');
			exit();
		}
?>
