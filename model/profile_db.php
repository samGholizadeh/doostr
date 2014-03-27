<?php
	require_once 'database.php'; 
	
	function insert_user($user_id, $username){
		global $db;
		$query = "INSERT INTO profiles(user_id, username) VALUES(:user_id, :username)";
		$statement = $db->prepare($query);
		$statement->bindValue(':username', $username);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function check_username_available($username){
		global $db;
		$query = "SELECT username FROM profiles WHERE username = :username";
		$statement = $db->prepare($query);
		$statement->bindValue(':username', $username);
		$statement->execute();
		if($statement->rowCount() == 1){
			$statement->closeCursor();
			return true;
		} else {
			$statement->closeCursor();
			return false;
		}
	}
	
	function get_profile($user_id){
		global $db;
		$query = "SELECT * FROM profiles WHERE user_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		$result = $statement->fetch();
		$statement->closeCursor();
		return $result;
	}
	
	function set_profile($user_id, $name, $lastname, $age, $country, $city, $gender){
		global $db;
		$query = "UPDATE profiles SET name = :name, lastname = :lastname, age = :age, country = :country, city = :city, gender = :gender WHERE user_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':name', $name); $statement->bindValue(':lastname', $lastname);
		$statement->bindValue(':age', $age); $statement->bindValue(':country', $country);
		$statement->bindValue(':city', $city); $statement->bindValue(':gender', $gender);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function insert_profileimg($username, $filename){
		global $db;
		$query = "UPDATE profiles SET profileimg = :filename WHERE username = :username";
		$statement = $db->prepare($query);
		$statement->bindValue(':filename', $filename);
		$statement->bindValue(':username', $username);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function get_profileimg($username){
		global $db;
		$query = "SELECT profileimg FROM profiles WHERE username = :username";
		$statement = $db->prepare($query);
		$statement->bindValue(':username', $username);
		$profileimgExists = $statement->execute();
		if($profileimgExists){
			return $statement->fetch();
		} else {
			return false;
		}
	}
	
	function anonymous($user_id){
		global $db;
		$query = "UPDATE profiles SET anonymous = 1 WHERE user_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function remove_anonymous($user_id){
		global $db;
		$query = "UPDATE profiles SET anonymous = 0 WHERE user_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function appearoffline($user_id){
		global $db;
		$query = "UPDATE profiles SET appearoffline = 1 WHERE user_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function appearonline($user_id){
		global $db;
		$query = "UPDATE profiles SET appearoffline = 0 WHERE user_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function check_appearoffline($user_id){
		global $db;
		$query = "SELECT appearoffline FROM profiles WHERE user_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		$result = $statement->fetch();
		$statement->closeCursor();
		return $result;
	}
	
	function message_preference_all($user_id){
		global $db;
		$query = "UPDATE profiles SET message_preference = 0 WHERE user_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function message_preference_friends($user_id){
		global $db;
		$query = "UPDATE profiles SET message_preference = 1 WHERE user_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function display_friends($user_id, $display){
		global $db;
		$query = "UPDATE profiles SET display_friends = :display_friends WHERE username = :username";
		$statement = $db->prepare($query);
		$statement->bindValue(':username', $user_id);
		$statement->bindValue(':display_friends', $display);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function insert_preference($user_id, $agemin, $agemax, $verified, $gender){
		global $db;
		$query = "UPDATE profiles SET verified = :verified, pref_age_min = :agemin, pref_age_max = :agemax, pref_gender = :gender WHERE user_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id); $statement->bindValue(':agemin', $agemin);
		$statement->bindValue(':agemax', $agemax); $statement->bindValue(':verified', $verified);
		$statement->bindValue(':gender', $gender);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function profilevisibility_public($user_id){
		global  $db;
		$query = "UPDATE profiles SET profilevisibility = 1 WHERE user_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function profilevisibility_friends($user_id){
		global  $db;
		$query = "UPDATE profiles SET profilevisibility = 2 WHERE user_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function profilevisibility_private($user_id){
		global  $db;
		$query = "UPDATE profiles SET profilevisibility = 3 WHERE user_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function online_timestamp($username){
		global $db;
		$query = "UPDATE profiles SET timestamp = 0 WHERE username = :username";
		$statement = $db->prepare($query);
		$statement->bindValue(':username', $username);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function update_profileDescription($username, $profiledescr, $sparetime, $listenmusic, $readbook, $food, $movies){
		global $db;
		$query = "UPDATE profiledescription SET description = :profiledescr, spare_time = :sparetime, music = :listenmusic, books = :readbook, food = :food, movies = :movies WHERE username = :username";
		$statement = $db->prepare($query);
		$statement->bindValue(':profiledescr', $profiledescr); $statement->bindValue(':sparetime', $sparetime);
		$statement->bindValue(':listenmusic', $listenmusic); $statement->bindValue(':readbook', $readbook);
		$statement->bindValue(':food', $food); $statement->bindValue(':movies', $movies);
		$statement->bindValue(':username', $username);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function get_profileDescription($username){
		global $db;
		$query = "SELECT description FROM profiledescription WHERE username = :username";
		$statement = $db->prepare($query);
		$statement->bindValue(':username', $username);
		$statement->execute();
		$result = $statement->fetch();
		$statement->closeCursor();
		return $result;
	}
?>