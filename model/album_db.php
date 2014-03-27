<?php
	include_once 'database.php';
	//
	function insert_album($username, $album_name, $filesArray){
		global $db;
		$query = "INSERT INTO albums(username, album_name, displayimage) VALUES(:username, :album_name, :displayimage)";
		$statement = $db->prepare($query);
		$statement->bindValue(':username', $username);
		$statement->bindValue(':album_name', $album_name);
		$statement->bindValue(':displayimage', $filesArray[0]);
		$statement->execute(); $statement->closeCursor();
		$query = "SELECT max(album_id) FROM album_id WHERE username = :username";
		$statement = $db->prepare($query);
		$statement->bindValue(':username', $username);
		$statement->execute();
		$album_id = $statement->fetch(); $statement->closeCursor();
		foreach($filesArray as $filename){
			$query = "INSERT INTO album_images(filename, album_id) VALUES(:filename, :album_id)";
			$statement = $db->prepare($query);
			$statement->bindValue(':filename', $filename);
			$statement->bindValue(':album_id', $album_id);
			$statement->execute(); $statement->closeCursor();
		}
	}
	
	function get_album_display($username){
		global $db;
		$query = "SELECT * FROM albums WHERE username = :username";
		$statement = $db->prepare($query);
		$statement->bindValue(':username', $username);
		$statement->execute();
		if($statement->rowCount() >= 1){
			$result = $statement->fetchAll(); $statement->closeCursor();
			return $result;
		} else {
			return false;
		}
	}
	
	
	function get_album($username){
		global $db;
		$query = "SELECT albums.album_name, album_images.filename FROM albums 
		LEFT JOIN albums_images ON albums.album_id=album_images.album_id WHERE username = :username";
		$statement = $db->prepare($query);
		$statement->bindValue(':username', $username);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		return $result;
	}
?>