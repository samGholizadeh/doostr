<?php
	include_once 'database.php';
	
	function insert_friendreq($user_id, $userx_id, $request_username, $requested_username){
		global $db;
		$query = "INSERT INTO friends(user_id, userx_id, state, permission, affected, request_username) VALUES(:user_id, :userx_id, 1, 1, 1, :request_username)";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->bindValue(':userx_id', $userx_id);
		$statement->bindValue(':request_username', $request_username);
		$statement->execute();
		$statement->closeCursor();
		$query = "INSERT INTO friends(user_id, userx_id, state, permission, affected, request_username) VALUES(:user_id, :userx_id, 1, 1, 0, :requested_username)";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $userx_id);
		$statement->bindValue(':userx_id', $user_id);
		$statement->bindValue(':requested_username', $requested_username);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function check_relationship($user_id, $userx_id){
		global $db;
		$query = "SELECT * FROM friends WHERE user_id = :user_id AND userx_id = :userx_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->bindValue(':userx_id', $userx_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			return $statement->fetch();
		} else {
			return false;
		}
	}
	
	function get_friends($user_id){
		global $db;
		$query = "SELECT friends.*, profiles.username, profiles.online, profiles.appearoffline FROM friends LEFT JOIN profiles ON friends.userx_id = profiles.user_id WHERE friends.user_id = :user_id OR friends.userx_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			$results = $statement->fetchAll();
			$friends_container = array();
			$friends = array();
			$requests = array();
			$blocked = array();
			foreach($results as $result)
			{
				if(($result['user_id'] == $user_id) && ($result['state'] == 2)){
					array_push($friends, $result);
				} else if((($result['state'] == 1) && ($result['userx_id'] == $user_id) && ($result['affected'] == 1)) || (($result['state'] == 1) && ($result['userx_id'] == $user_id) && ($result['affected'] == 0))){
					array_push($requests, $result);
				} else if(($result['state'] == 3) && ($result['user_id'] == $user_id) && ($result['affected'] == 0)){
					array_push($blocked, $result);
				}
			}
			array_push($friends_container, $friends);
			array_push($friends_container, $requests);
			array_push($friends_container, $blocked);
			return $friends_container;
		} else {
			return false;
		}
	}
	
	/*function get_friends_requested($user_id){
		$query = "SELECT friends.*, profiles.username, profiles.online, profiles.appearoffline FROM friends LEFT JOIN profiles ON friends.userx_id = profiles.user_id WHERE friends.user_id = :user_id AND friends.state = 1 AND friends.affected = 0";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		
	}*/
	
	function friend_state($user_id, $userx_id){
		global $db;
		$query = "SELECT * FROM friends WHERE user_id = :user_id AND userx_id = :userx_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->bindValue(':userx_id', $userx_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			return $statement->fetchAll();
		} else {
			return false;
		}
	}
	
	function drop_friend($user_id, $userx_id){
		global $db;
		$query = "DELETE FROM friends WHERE user_id = :user_id AND userx_id = :userx_id OR user_id = :userx_id AND userx_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->bindValue(':userx_id', $userx_id);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function update_friendrequest($user_id, $userx_id, $choice){
		global $db;
		if($choice == 2){
			$query = "DELETE FROM friends WHERE user_id = :user_id AND userx_id = :userx_id OR user_id = :userx_id AND userx_id = :user_id";
			$statement = $db->prepare($query);
			$statement->bindValue(':user_id', $user_id);
			$statement->bindValue(':userx_id', $userx_id);
			$statement->execute();
			$statement->closeCursor();
			$query = "SELECT COUNT(user_id) FROM friends WHERE userx_id = :user_id AND state = 1 AND affected = 1";
			$statement = $db->prepare($query);
			$statement->bindValue(':user_id', $user_id);
			$statement->execute();
			return $statement->fetch();
		} else if($choice == 1) {
			$query = "UPDATE friends SET state = 2, affected = 0 WHERE user_id = :user_id AND userx_id = :userx_id OR user_id = :userx_id AND userx_id = :user_id";
			$statement = $db->prepare($query);
			$statement->bindValue(':choice', $choice);
			$statement->bindValue(':user_id', $user_id);
			$statement->bindValue(':userx_id', $userx_id);
			$statement->execute();
			$statement->closeCursor();
			$query = "SELECT COUNT(user_id) FROM friends WHERE userx_id = :user_id AND state = 1 AND affected = 1";
			$statement = $db->prepare($query);
			$statement->bindValue(':user_id', $user_id);
			$statement->execute();
			return $statement->fetch();
		} else {
			$query = "UPDATE friends SET state = 3, affected = 1 WHERE user_id = :user_id AND userx_id = :userx_id";
			$statement = $db->prepare($query);
			$statement->bindValue(':user_id', $user_id);
			$statement->bindValue(':userx_id', $userx_id);
			$statement->execute();
			$statement->closeCursor();
			$query = "UPDATE friends SET state = 3, affected = 0 WHERE user_id = :userx_id AND userx_id = :user_id";
			$statement = $db->prepare($query);
			$statement->bindValue(':user_id', $user_id);
			$statement->bindValue(':userx_id', $userx_id);
			$statement->execute();
			$statement->closeCursor();
			$query = "SELECT COUNT(user_id) FROM friends WHERE userx_id = :user_id AND state = 1 AND affected = 1";
			$statement = $db->prepare($query);
			$statement->bindValue(':user_id', $user_id);
			$statement->execute();
			return $statement->fetch();
		}
	}
	
	function remove_block($user_id, $userx_id){
		global $db;
		$query = "DELETE FROM friends WHERE user_id = :user_id AND userx_id = :userx_id OR user_id = :userx_id AND userx_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->bindValue(':userx_id', $userx_id);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function block_user($user_id, $userx_id){
		global $db;
		$query = "INSERT INTO friends(user_id, userx_id, state, affected) VALUES(:user_id, :userx_id, 3, 0)";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->bindValue(':userx_id', $userx_id);
		$statement->execute();
		$statement->closeCursor();
		$query = "INSERT INTO friends(user_id, userx_id, state, affected) VALUES(:userx_id, :user_id, 3, 1)";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->bindValue(':userx_id', $userx_id);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function block_friend($user_id, $userx_id){
		global $db;
		$query = "UPDATE friends SET state = 3 WHERE user_id = :user_id AND userx_id = :userx_id OR user_id = :userx_id AND userx_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->bindValue(':userx_id', $userx_id);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function alter_permission($user_id, $userx_id, $permission){
		global $db;
		$query = "UPDATE friends SET permission = :permission WHERE user_id = :user_id AND userx_id = :userx_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':permission', $permission);
		$statement->bindValue(':user_id', $user_id);
		$statement->bindValue(':userx_id', $userx_id);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function check_new_friends($user_id){
		global $db;
		$query = "SELECT COUNT(user_id) FROM friends WHERE userx_id = :user_id AND state = 1 AND affected = 1";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		return $statement->fetch();
	}
	
	/* !!!!!!!!!!!!!!!!!!!! DISCONTINUED !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
	
	function insert_friendreq_db($user_id, $friendrequested){
		global $db;
		$query = "SELECT * FROM friends WHERE user_id = '$user_id' AND friendrequested = '$friendrequested'";
		$statement = $db->prepare($query);
		$statement->execute();
		$query2 = "SELECT * FROM friends WHERE user_id = '$friendrequested' AND friendrequested = '$user_id'";
		$statement2 = $db->prepare($query2);
		$statement2->execute();
		if(($statement->rowCount() != 1) && ($statement2->rowCount() != 1)){
			$query = "INSERT INTO friends(user_id, friendrequester, friendrequested, state) VALUES('$user_id', '$user_id', '$friendrequested', 0)";
			$statement = $db->prepare($query);
			$statement->execute();
			$statement->closeCursor();
		} else {
			$query = "SELECT user_id FROM friends WHERE user_id = '$user_id' AND friendrequested = '$friendrequested'";
			$statement = $db->prepare($query);
			$statement->execute();
			if(($statement->rowCount() != 1)){
				$query = "UPDATE friends SET user_id = '$user_id', friendrequester = '$user_id', friendrequested = '$friendrequested', state = 0 WHERE user_id = '$friendrequested' AND friendrequested = '$user_id'";
				$statement = $db->prepare($query)->execute();
			}
		}
	}
?>