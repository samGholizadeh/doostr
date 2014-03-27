<?php
	include_once 'database.php';
	
	function get_inboxmessage_list($user_id){
		global $db;
		$query = "SELECT * FROM messages WHERE userx_id = :user_id AND recip_copy = 1 OR user_id = :user_id AND author_copy = 1 ORDER BY message_timestamp DESC";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			$results = $statement->fetchAll();
			$query = "UPDATE messages SET message_collected = 1 WHERE userx_id = :user_id AND message_collected = 0";
			$statement = $db->prepare($query);
			$statement->bindValue(':user_id', $user_id);
			$statement->execute();
			$message_send = array();
			$message_inbox = array();
			$messages = array();
			foreach($results as $result){
				if($result['user_id'] == $user_id){
					array_push($message_send, $result);
				} else if($result['userx_id'] == $user_id) {
					array_push($message_inbox, $result);
				}
			}
			array_push($messages, $message_inbox); array_push($messages, $message_send);
			return $messages;	
		} else {
			return false;
		}
	}
	
	function send_message($user_id, $author, $userx_id, $message, $recip){
		global $db;
		$query = "INSERT INTO messages(user_id, userx_id, message, author_copy, recip_copy, author, recip) VALUES(:user_id, :userx_id, :message, 1, 1, :author, :recip)";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->bindValue(':userx_id', $userx_id);
		$statement->bindValue(':message', $message);
		$statement->bindValue(':author', $author);
		$statement->bindValue(':recip', $recip);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function update_message_status($message_id, $user_id){
		global $db;
		$query = "UPDATE messages SET message_state = 1 WHERE message_id = :messageid";
		$statement = $db->prepare($query);
		$statement->bindValue(':messageid', $message_id);
		$statement->execute();
		$statement->closeCursor();
		
	}
	
	function insert_message_reply($parent_message_id, $user_id, $userx_id, $recipient, $reply, $username){
		global $db;
		$query = "INSERT INTO messages(parent_message_id, user_id, userx_id, author, recip, author_copy, recip_copy, message) VALUES(:parent_message_id, :user_id, :userx_id, :author, :recipient, 1, 1, :reply)";
		$statement = $db->prepare($query);
		$statement->bindValue(':parent_message_id', $parent_message_id);
		$statement->bindValue(':user_id', $user_id);
		$statement->bindValue(':userx_id', $userx_id);
		$statement->bindValue(':author', $username);
		$statement->bindValue(':recipient', $recipient);
		$statement->bindValue(':reply', $reply);
		$statement->execute();
		$statement->closeCursor();
		$query = "SELECT LAST_INSERT_ID() FROM messages";
		$statement = $db->prepare($query);
		$statement->execute();
		return $statement->fetch();
	}
	
	function get_next_twenty_messages($user_id, $offset){
		global $db;
		$query = "SELECT * FROM messages WHERE userx_id = :user_id AND recip_copy = 1 ORDER BY message_timestamp DESC LIMIT $offset, 17";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			$result = $statement->fetchAll();
			$query = "UPDATE messages SET message_collected = 1 WHERE userx_id = :user_id AND message_collected = 0";
			$statement = $db->prepare($query);
			$statement->bindValue(':user_id', $user_id);
			$statement->execute();
			return $result;
		} else {
			return false;
		}
	}
	
	function get_next_twenty_sent_messages($user_id, $offset){
		global $db;
		$query = "SELECT * FROM messages WHERE user_id = :user_id AND author_copy = 1 ORDER BY message_timestamp DESC LIMIT $offset, 17";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			return $statement->fetchAll();
		} else {
			return false;
		}
	}
	
	function collect_new_messages($user_id){
		global $db;
		$query = "SELECT message_id, user_id, author, message_timestamp, message FROM messages WHERE userx_id = :user_id AND message_collected = 0";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			$result = $statement->fetchAll();
			$query = "UPDATE messages SET message_collected = 1 WHERE userx_id = :user_id AND message_collected = 0";
			$statement = $db->prepare($query);
			$statement->bindValue(':user_id', $user_id);
			$statement->execute();
			return $result;
		} else {
			return false;
		}
	}
	
	function check_new_messages($user_id){
		global $db;
		$query = "SELECT COUNT(message_id) FROM messages WHERE userx_id = :user_id AND message_state = 0";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		return $statement->fetch();
	}
	
	function check_message_friend_only($user_id){
		global $db;
		$query = "SELECT message_preference FROM profiles WHERE user_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		$result = $statement->fetch();
		if($result['message_preference'] == 1){
			return true;
		} else {
			return false;
		}
	}
	
	function delete_message($messageid, $arbitrary){
		global $db;
		if($arbitrary == 1){
			$query = "UPDATE messages SET author_copy = 0 WHERE message_id = :messageid";
		} else {
			$query = "UPDATE messages SET recip_copy = 0, message_state = 1 WHERE message_id = :messageid";
		}
		$statement = $db->prepare($query);
		$statement->bindValue(':messageid', $messageid);
		$statement->execute();
		$statement->closeCursor();
	}
?>