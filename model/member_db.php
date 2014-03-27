<?php
	require_once 'database.php';
	
	function get_members(){
		global $db;
		$query = "SELECT * FROM profiles";
		$statement = $db->query($query);
		$result = $statement->fetchAll();
		return $result;
	}
	
	function get_timestamp($username){
		global $db;
		$query = "SELECT timestamp FROM profiles WHERE username = '$username'";
		$result = $db->query($query)->fetch();
		return $result;
	}
	
	function userExists($searchUser){
		global $db;
		$query = "SELECT userID, username, email FROM members WHERE username = '$searchUser'";
		$statement = $db->prepare($query);
		$result = $statement->execute();
		return $result;
	}
	
	function get_member($user){
		global $db;
		$query = "SELECT * FROM profiles WHERE username = '$user'";
		$statement = $db->query($query);
		$result = $statement->fetchAll();
		return $result; 
	}
	
	function search_members($username, $name, $lastname, $country, $city, $lastseen, $gender, $arbitrary, $offset){
		global $db;
		$query = "SELECT * FROM profiles WHERE 1";
		if(!empty($username)){
			$query .= " AND username = :username ";
		}
		if(!empty($name)){
			$query .= " AND name = :name ";
		}
		if(!empty($lastname)){
			$query .= " AND lastname = :lastname ";
		}
		if(!empty($gender)){
			if($gender == "Both"){
				$query .= " AND (gender = :Male OR gender = :Female OR gender = :empty) ";
			} else if($gender == "Male"){
				$query .= " AND gender = :Male ";
			} else {
				$query .= " AND gender = :Female ";
			}
		}
		/*if(!empty($ageMin)){
			$query .= " AND age >= :ageMin ";
		}
		if(!empty($ageMax)){
			$query .= " AND age <= :ageMax ";
		}*/
		if(!empty($country)){
			$query .= " AND country = :country ";
		}
		if(!empty($city)){
			$query .= " AND city = :city";
		}
		if($lastseen == 'online'){
			$query .= " AND online = 1 ";
		}
		if($arbitrary == 1){
			$query .= " ORDER BY username DESC LIMIT 0, 24";
		} else {
			$query .= " ORDER BY username DESC LIMIT $offset, 25";
		}
		$statement = $db->prepare($query);
		if(!empty($username)){
			$statement->bindValue(':username', $username);
		}
		/*if(!empty($ageMin)){
			$statement->bindValue(':ageMin', $ageMin);
		}
		if(!empty($ageMax)){
			$statement->bindValue(':ageMax', $ageMax);
		}*/
		if(!empty($gender)){
			if($gender == "Both"){
				$statement->bindValue(':Male', "Male");
				$statement->bindValue(':Female', "Female");
				$statement->bindValue(':empty', "");
			} else if($gender == "Male"){
				$statement->bindValue(':Male', "Male");
			} else {
				$statement->bindValue(':Female', "Female");
			}
		}
		if(!empty($name)){
			$statement->bindValue(':country', $name);
		}
		if(!empty($lastname)){
			$statement->bindValue(':country', $lastname);
		}
		if(!empty($country)){
			$statement->bindValue(':country', $country);
		}
		if(!empty($city)){
			$statement->bindValue(':city', $city);
		}
		$statement->execute();
		if($statement->rowCount() >= 1){
			return $statement->fetchAll();
		} else {
			return false;
		}
	}
	
	function delete_member($user_id){
		global $db;
		$query = "DELETE FROM members WHERE user_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		$statement->closeCursor();
	}
?>