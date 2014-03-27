<?php
	include_once 'database.php';
	
	function insert_image_comment($image_id, $comment, $username, $user_id){
		global $db;
		$query = "INSERT INTO imagecomment(image_id, comment, username, is_reply, user_id) VALUES(:image_id, :comment, :username, 0, :user_id)";
		$statement = $db->prepare($query);
		$statement->bindValue(':image_id', $image_id);
		$statement->bindValue(':comment', $comment);
		$statement->bindValue(':username', $username);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		$statement->closeCursor();
		$query = "SELECT LAST_INSERT_ID() FROM imagecomment";
		$statement = $db->prepare($query);
		$statement->execute();
		$result = $statement->fetch();
		$statement->closeCursor();
		$query = "UPDATE images SET comments = comments + 1 WHERE image_id = :image_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':image_id', $image_id);
		$statement->execute();
		$statement->closeCursor();
		return $result;
	}
	
	function insert_comment_reply($image_id, $username, $user_id, $comment, $parent_commentid){
		global $db;
		$query = "INSERT INTO imagecomment(image_id, username, user_id, comment, parent_commentid, is_reply) VALUES(:image_id, :username, :user_id, :comment, :parent_commentid, 1)";
		$statement = $db->prepare($query);
		$statement->bindValue(':image_id', $image_id);
		$statement->bindValue(':username', $username);
		$statement->bindValue(':user_id', $user_id);
		$statement->bindValue(':comment', $comment);
		$statement->bindValue(':parent_commentid', $parent_commentid);
		$statement->execute();
		$statement->closeCursor();
		$query = "SELECT LAST_INSERT_ID() FROM imagecomment";
		$statement = $db->prepare($query);
		$statement->execute();
		$result = $statement->fetch();
		$statement->closeCursor();
		$query = "UPDATE imagecomment SET has_replies = has_replies + 1 WHERE commentid = :parent_commentid";
		$statement = $db->prepare($query);
		$statement->bindValue(':parent_commentid', $parent_commentid);
		$statement->execute();
		$statement->closeCursor();
		return $result;
	}
	
	function get_usercomments($user_id){
		global $db;
		$query = "SELECT imagecomment.*, images.filename, images.user_id, images.state, images.title FROM imagecomment LEFT JOIN images ON imagecomment.image_id = images.image_id WHERE imagecomment.user_id = :user_id AND imagecomment.is_reply = 0 AND imagecomment.display_state = 0 ORDER BY imagecomment.comment_timestamp DESC LIMIT 0, 10";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			return $statement->fetchAll();
		} else {
			return false;
		}
	}
	
	function count_usercomments($user_id){
		global $db;
		$query = "SELECT COUNT(commentid) FROM imagecomment WHERE user_id = :user_id AND is_reply = 0 AND display_state = 0";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		return $statement->fetch();
	}
	
	function get_usercomments_likes($user_id){
		global $db;
		$query = "SELECT imagecomment.*, images.filename, images.user_id, images.state, images.title FROM imagecomment LEFT JOIN images ON imagecomment.image_id = images.image_id WHERE imagecomment.user_id = :user_id AND imagecomment.is_reply = 0 AND imagecomment.display_state = 0 ORDER BY imagecomment.comment_likes DESC LIMIT 0, 10";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			return $statement->fetchAll();
		} else {
			return false;
		}
	}
	
	function get_usercomments_next_ten($user_id, $offset, $arbitrary){
		global $db;
		if($arbitrary == 1){
			$query = "SELECT imagecomment.*, images.filename, images.user_id, images.state, images.title FROM imagecomment LEFT JOIN images ON imagecomment.image_id = images.image_id WHERE imagecomment.user_id = :user_id AND imagecomment.is_reply = 0 AND imagecomment.display_state = 0 ORDER BY imagecomment.comment_timestamp DESC LIMIT $offset, 10";
		} else {
			$query = "SELECT imagecomment.*, images.filename, images.user_id, images.state, images.title FROM imagecomment LEFT JOIN images ON imagecomment.image_id = images.image_id WHERE imagecomment.user_id = :user_id AND imagecomment.is_reply = 0 AND imagecomment.display_state = 0 ORDER BY imagecomment.comment_likes DESC LIMIT $offset, 10";
		}
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			return $statement->fetchAll();
		} else {
			return false;
		}
	}
	
	function get_imagecomments($image_id, $user_id){
		global $db;
		$query = "SELECT imagecomment.*, likes.user_id FROM imagecomment LEFT JOIN likes ON imagecomment.commentid = likes.commentid AND likes.user_id = :user_id WHERE imagecomment.image_id = :image_id AND imagecomment.is_reply = 0 AND imagecomment.is_reported <= 50 ORDER BY imagecomment.comment_likes DESC LIMIT 0, 3";
		$statement = $db->prepare($query);
		$statement->bindValue(':image_id', $image_id);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			$comments = array();
			$result = $statement->fetchAll();
			array_push($comments, $result);
			$statement->closeCursor();
			$query = "SELECT imagecomment.*, likes.user_id FROM imagecomment LEFT JOIN likes ON imagecomment.commentid = likes.commentid AND likes.user_id = :user_id WHERE imagecomment.image_id = :image_id AND imagecomment.is_reply = 0 ORDER BY imagecomment.comment_timestamp DESC LIMIT 3, 10";
			$statement = $db->prepare($query);
			$statement->bindValue(':image_id', $image_id);
			$statement->bindValue(':user_id', $user_id);
			$statement->execute();
			$result = $statement->fetchAll();
			array_push($comments, $result);
			return $comments;
		} else {
			return false;
		}
	}
	
	function get_imagecomments_guest($image_id){
		global $db;
		$query = "SELECT * FROM imagecomment WHERE image_id = :image_id AND is_reply = 0 AND is_reported <= 50 ORDER BY comment_likes DESC LIMIT 0, 3";
		$statement = $db->prepare($query);
		$statement->bindValue(':image_id', $image_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			$comments = array();
			$result = $statement->fetchAll();
			array_push($comments, $result);
			$statement->closeCursor();
			$query = "SELECT * FROM imagecomment WHERE image_id = :image_id AND is_reply = 0 ORDER BY comment_timestamp DESC LIMIT 3, 10";
			$statement = $db->prepare($query);
			$statement->bindValue(':image_id', $image_id);
			$statement->execute();
			$result = $statement->fetchAll();
			array_push($comments, $result);
			return $comments;
		} else {
			return false;
		}
	}
	
	function count_imagecomments($image_id){
		global $db;
		$query = "SELECT COUNT(commentid) FROM imagecomment WHERE image_id = :image_id AND is_reply = 0";
		$statement = $db->prepare($query);
		$statement->bindValue(':image_id', $image_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			return $statement->fetch();
		} else {
			return false;
		}
	}
	
	function get_parent_comment($commentid){
		global $db;
		$query = "SELECT * FROM imagecomment WHERE commentid = :commentid";
		$statement = $db->prepare($query);
		$statement->bindValue(':commentid', $commentid);
		$statement->execute();
		$result = $statement->fetch();
		$statement->closeCursor();
		return $result;
	}
	
	function insert_modal_comment($comment, $image_id, $private, $user_id, $username){
		global $db;
		$query = "INSERT INTO imagecomment(image_id, username, user_id, comment, private_comment, modal_comment) VALUES(:image_id, :username, :user_id, :comment, :private_comment, 1)";
		$statement = $db->prepare($query);
		$statement->bindValue(':image_id', $image_id);
		$statement->bindValue(':username', $username);
		$statement->bindValue(':user_id', $user_id);
		$statement->bindValue(':comment', $comment);
		$statement->bindValue(':private_comment', $private);
		$statement->execute();
		$statement->closeCursor();
		$query = "SELECT LAST_INSERT_ID() FROM imagecomment";
		$statement = $db->prepare($query);
		$statement->execute();
		$result = $statement->fetch();
		$statement->closeCursor();
		return $result;
	}
	
	function get_modal_comments($image_id){
		global $db;
		$query = "SELECT imagecomment.*, likes.user_id FROM imagecomment LEFT JOIN likes ON imagecomment.commentid = likes.commentid 
				WHERE imagecomment.image_id = :image_id AND imagecomment.modal_comment = 1 AND imagecomment.display_state = 0 ORDER BY imagecomment.comment_timestamp DESC LIMIT 0, 7";
		$statement = $db->prepare($query);
		$statement->bindValue(':image_id', $image_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			$result_set = $statement->fetchAll();
			$statement->closeCursor();
			return $result_set;
		} else {
			return false;
		}
	}
	
	function get_modal_comments_next($image_id, $offset){
		global $db;
		$query = "SELECT imagecomment.*, likes.user_id FROM imagecomment LEFT JOIN likes ON imagecomment.commentid = likes.commentid WHERE imagecomment.image_id = :image_id AND imagecomment.modal_comment = 1 AND imagecomment.display_state = 0 ORDER BY imagecomment.comment_timestamp DESC LIMIT $offset, 7";
		$statement = $db->prepare($query);
		$statement->bindValue(':image_id', $image_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			$result_set = $statement->fetchAll();
			$statement->closeCursor();
			return $result_set;
		} else {
			return false;
		}
	}
	
	function count_modal_comments($image_id){
		global $db;
		$query = "SELECT COUNT(commentid) FROM imagecomment WHERE image_id = :image_id AND modal_comment = 1 AND display_state = 0";
		$statement = $db->prepare($query);
		$statement->bindValue(':image_id', $image_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			return $statement->fetch();
		} else {
			return false;
		}
	}
	
	function report_comment($commentid){
		global $db;
		$query = "UPDATE imagecomment SET is_reported = is_reported + 1 WHERE commentid = :commentid";
		$statement = $db->prepare($query);
		$statement->bindValue(':commentid', $commentid);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function get_next_ten_comments($image_id, $offset){
		global $db;
		$query = "SELECT imagecomment.*, likes.user_id FROM imagecomment LEFT JOIN likes ON imagecomment.commentid = likes.commentid AND imagecomment.user_id = likes.user_id WHERE imagecomment.image_id = :image_id AND imagecomment.is_reply = 0 ORDER BY imagecomment.comment_timestamp DESC LIMIT $offset, 10";
		$statement = $db->prepare($query);
		$statement->bindValue(':image_id', $image_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			return $statement->fetchAll();
		} else {
			return false;
		}
	}
	
	function get_replies($commentid){
		global $db;
		$query = "SELECT imagecomment.*, likes.user_id FROM imagecomment LEFT JOIN likes ON imagecomment.commentid = likes.commentid AND imagecomment.user_id = likes.user_id WHERE imagecomment.parent_commentid = :commentid ORDER BY imagecomment.comment_likes DESC";
		$statement = $db->prepare($query);
		$statement->bindValue(':commentid', $commentid);
		$statement->execute();
		if($statement->rowCount() >= 1){
			return $statement->fetchAll();
		} else {
			return false;
		}
	}
	
	function get_next_ten_replies($parent_commentid, $offset){ /*Discontinued for now*/
		global $db;
		$query = "SELECT imagecomment.*, likes.user FROM imagecomment LEFT JOIN likes ON imagecomment.commentid = likes.commentid AND imagecomment.user_id = likes.user_id WHERE imagecomment.parent_commentid = :parent_commentid ORDER BY imagecomment.comment_likes DESC LIMIT $offset, 10";
		$statement = $db->prepare($query);
		$statement->bindValue(':parent_commentid', $parent_commentid);
		$statement->execute();
		if($statement->rowCount() >= 1){
			return $statement->fetchAll();
		} else {
			return false;
		}
	}
	
	function remove_comment($commentid, $parent_commentid){
		global $db;
		$query = "UPDATE imagecomment SET display_state = 1 WHERE commentid = :commentid";
		$statement = $db->prepare($query);
		$statement->bindValue(':commentid', $commentid);
		$statement->execute();
		$statement->closeCursor();
		/*if($parent_commentid != 0){
			$query = "UPDATE imagecomment SET has_replies = has_replies - 1 WHERE commentid = :commentid";
			$statement = $db->prepare($query);
			$statement->bindValue(':commentid', $parent_commentid);
			$statement->execute();
			$statement->closeCursor();
		}*/
	}
	
	function like_comment($commentid, $userx_id, $user_id){
		global $db;
		$query = "UPDATE imagecomment SET comment_likes = comment_likes + 1 WHERE commentid = :commentid";
		$statement = $db->prepare($query);
		$statement->bindValue(':commentid', $commentid);
		$statement->execute();
		$statement->closeCursor();
		$query = "UPDATE profiles SET total_likes = total_likes + 1 WHERE user_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $userx_id);
		$statement->execute();
		$statement->closeCursor();
		$query = "INSERT INTO likes(user_id, commentid) VALUES(:user_id, :commentid)";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->bindValue(':commentid', $commentid);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function dislike_comment($commentid, $user_id){
		global $db;
		$query = "UPDATE imagecomment SET comment_dislikes = comment_dislikes + 1 WHERE commentid = :commentid";
		$statement = $db->prepare($query);
		$statement->bindValue(':commentid', $commentid);
		$statement->execute();
		$statement->closeCursor();
		$query = "INSERT INTO likes(user_id, commentid) VALUES(:user_id, :commentid)";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->bindValue(':commentid', $commentid);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function get_comment_likes($commentid){ //Maybe not needed.
		global $db;
		$query = "SELECT likes FROM imagecomment WHERE commentid = :commentid";
		$statement = $db->prepare($query);
		$statement->bindValue(':commentid', $commentid);
		$statement->execute();
		if($statement->rowCount() >= 1){
			$result = $statement->fetchAll();
			$statement->closeCursor();
			return $result;
		} else {
			return false;
		}
	}
	
	
?>