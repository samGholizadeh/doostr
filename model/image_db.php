<?php
	include_once 'database.php';
	include_once 'friend_db.php'; /* FRIEND_DB IS NEEDED TO CHECK RELATIONSHIP*/
	
	function check_file($image_id){ //This should be used instead of check_file. Does not work.
		global $db;
		$query = "SELECT images.image_id, images.user_id, images.vote, images.numvotes, images.totalscore, images.average, images.likes, images.dislikes, images.views, images.bandwidth, images.category, images.subcategory, images.title, 
		images.state, images.size, images.filename, profiles.username FROM images LEFT JOIN profiles ON images.user_id = profiles.user_id WHERE images.image_id = :image_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':image_id', $image_id);
		$statement->execute();
		return $statement->fetch();
	}
	
	function check_file_filename($filename){ //This should be used instead of check_file. Does not work.
		global $db;
		$query = "SELECT images.image_id, images.user_id, images.vote, images.numvotes, images.totalscore, images.average, images.likes, images.dislikes, images.views, images.bandwidth, images.category, images.subcategory, images.title,
		images.state, images.size, images.filename, profiles.username FROM images LEFT JOIN profiles ON images.user_id = profiles.user_id WHERE images.filename = :filename";
		$statement = $db->prepare($query);
		$statement->bindValue(':filename', $filename);
		$statement->execute();
		return $statement->fetch();
	}
	
	function guest_uploaded_images($upload_id){
		global $db;
		$query = "SELECT filename FROM images_guest WHERE upload_id = :upload_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':upload_id', $upload_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			return $statement->fetchAll();
		} else {
			return false;
		}
	}
	
	function get_all($user_id){
		global $db;
		$query = "SELECT image_id, user_id, filename, state, title, vote FROM images WHERE user_id = :user_id ORDER BY timestamp DESC LIMIT 0, 25";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			$result = $statement->fetchAll();
			$statement->closeCursor();
			return $result;
		} else {
			return false;
		}
	}
	
	function get_all_next($user_id, $offset){
		global $db;
		$query = "SELECT image_id, user_id, filename, state, title, vote FROM images WHERE user_id = :user_id ORDER BY timestamp DESC LIMIT $offset, 25";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			$result = $statement->fetchAll();
			$statement->closeCursor();
			return $result;
		} else {
			return false;
		}
	}
	
	function get_all_count($user_id){
		global $db;
		$query = "SELECT COUNT(image_id) FROM images WHERE user_id = :user_id ORDER BY timestamp DESC";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		return $statement->fetch();
	}
	
	function get_all_rated($user_id){
		global $db;
		$query = "SELECT * FROM images WHERE user_id = :user_id AND vote = 1 ORDER BY timestamp DESC LIMIT 0, 16";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			$result = $statement->fetchAll();
			$statement->closeCursor();
			return $result;
		} else {
			return false;
		}
	}
	
	function get_all_rated_count($user_id){
		global $db;
		$query = "SELECT COUNT(image_id) FROM images WHERE user_id = :user_id AND vote = 1";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		$result = $statement->fetch();
		$statement->closeCursor();
		return $result;
	}
	
	function get_rated_next($user_id, $offset){
		global $db;
		$query = "SELECT * FROM images WHERE user_id = :user_id AND vote = 1 ORDER BY timestamp DESC LIMIT $offset, 16";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			$result = $statement->fetchAll();
			$statement->closeCursor();
			return $result;
		} else {
			return false;
		}
	}
	
	function set_upload_id($filename, $upload_id){
		global $db;
		$query = "UPDATE images SET upload_id = :upload_id WHERE filename = :filename";
		$statement = $db->prepare($query);
		$statement->bindValue(':upload_id', $upload_id);
		$statement->bindValue(':filename', $filename);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function get_upload_filename($upload_id){
		global $db;
		$query = "SELECT user_id, filename, views, bandwidth FROM images WHERE upload_id = :upload_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':upload_id', $upload_id);
		$statement->execute();
		if($statement->rowCount >= 1){
			return $statement->fetchAll();
		} else {
			return false;
		}
	}
	
	function get_all_other($user_id, $friendstate){
		global $db;
		if(($friendstate == false) || ($friendstate['state'] == 1)){
			$query = "SELECT image_id, user_id, filename, state, title FROM images WHERE user_id = :user_id AND state = 1 ORDER BY timestamp DESC LIMIT 0, 25";
			$statement = $db->prepare($query);
			$statement->bindValue(':user_id', $user_id);
			$statement->execute();
			$result = $statement->fetchAll();
			$statement->closeCursor();
			return $result;
		} else if((($friendstate['state'] == 2) && (($friendstate['permission'] == 2) || ($friendstate['permission'] == 1)))){
			$query = "SELECT image_id, user_id, filename, state, title FROM images WHERE user_id = :user_id AND (state = 1 OR state = 2) ORDER BY timestamp DESC LIMIT 0, 25";
			$statement = $db->prepare($query);
			$statement->bindValue(':user_id', $user_id);
			$statement->execute();
			$result = $statement->fetchAll();
			$statement->closeCursor();
			return $result;
		} else if((($friendstate['state'] == 2) && (($friendstate['permission'] == 2)) || ($friendstate['permission'] == 3))){
			$query = "SELECT image_id, user_id, filename, state, title FROM images WHERE user_id = :user_id AND (state = 2 OR state = 3) ORDER BY timestamp DESC LIMIT 0, 25";
			$statement = $db->prepare($query);
			$statement->bindValue(':user_id', $user_id);
			$statement->execute();
			$result = $statement->fetchAll();
			$statement->closeCursor();
			return $result;
		} else {
			return false;
		}
	}
	
	function get_all_other_next($user_id, $friendstate, $offset){
	global $db;
		if(($friendstate == false) || ($friendstate['state'] == 1)){
			$query = "SELECT image_id, user_id, filename, state, title FROM images WHERE user_id = :user_id AND state = 1 ORDER BY timestamp DESC LIMIT $offset, 25";
			$statement = $db->prepare($query);
			$statement->bindValue(':user_id', $user_id);
			$statement->execute();
			$result = $statement->fetchAll();
			$statement->closeCursor();
			return $result;
		} else if((($friendstate['state'] == 2) && (($friendstate['permission'] == 2) || ($friendstate['permission'] == 1)))){
			$query = "SELECT image_id, user_id, filename, state, title FROM images WHERE user_id = :user_id AND (state = 1 OR state = 2) ORDER BY timestamp DESC LIMIT $offset, 25";
			$statement = $db->prepare($query);
			$statement->bindValue(':user_id', $user_id);
			$statement->execute();
			$result = $statement->fetchAll();
			$statement->closeCursor();
			return $result;
		} else if((($friendstate['state'] == 2) && (($friendstate['permission'] == 2)) || ($friendstate['permission'] == 3))){
			$query = "SELECT image_id, user_id, filename, state, title FROM images WHERE user_id = :user_id ORDER BY timestamp DESC LIMIT $offset, 25";
			$statement = $db->prepare($query);
			$statement->bindValue(':user_id', $user_id);
			$statement->execute();
			$result = $statement->fetchAll();
			$statement->closeCursor();
			return $result;
		} else {
			return false;
		}
	}
	
	function get_all_other_count($user_id, $friendstate){
		global $db;
		if(($friendstate == false) || ($friendstate['state'] == 1)){
			$query = "SELECT COUNT(image_id) FROM images WHERE user_id = :user_id AND state = 1";
			$statement = $db->prepare($query);
			$statement->bindValue(':user_id', $user_id);
			$statement->execute();
			$result = $statement->fetch();
			$statement->closeCursor();
			return $result;
		} else if((($friendstate['state'] == 2) && (($friendstate['permission'] == 2) || ($friendstate['permission'] == 1)))){
			$query = "SELECT COUNT(image_id) FROM images WHERE user_id = :user_id AND (state = 1 OR state = 2)";
			$statement = $db->prepare($query);
			$statement->bindValue(':user_id', $user_id);
			$statement->execute();
			$result = $statement->fetch();
			$statement->closeCursor();
			return $result;
		} else if((($friendstate['state'] == 2) && (($friendstate['permission'] == 2)) || ($friendstate['permission'] == 3))){
			$query = "SELECT COUNT(image_id) FROM images WHERE user_id = :user_id";
			$statement = $db->prepare($query);
			$statement->bindValue(':user_id', $user_id);
			$statement->execute();
			$result = $statement->fetch();
			$statement->closeCursor();
			return $result;
		} else {
			return false;
		}
	}
	
	function insert_has_voted($image_id, $user_id, $votevalue, $ip){
		global $db;
		$query = "INSERT INTO unique_vote(image_id, has_voted, vote_value, ip) VALUES(:image_id, :user_id, :votevalue, :ip)";
		$statement = $db->prepare($query);
		$statement->bindValue(':image_id', $image_id);
		$statement->bindValue(':user_id', $user_id);
		$statement->bindValue(':votevalue', $votevalue);
		$statement->bindValue(':ip', $ip);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function insert_profile_image($user_id, $filename){
		global $db;
		$query = "UPDATE profiles SET profileimg = :filename WHERE user_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':filename', $filename);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function update_image_db($image_id, $votevalue, $votes, $totalscore, $user_id){
		$votes++;
		if($votes == 10){
			$time = date("Y-m-d H:i:s");
			$query = "UPDATE images SET timestamp = :timestamp WHERE image_id = :image_id";
			$statement = $db->prepare($query);
			$statement->bindValue(':image_id', $image_id);
			$statement->bindValue(':timestamp', $time);
			$statement->execute();
			$statement->closeCursor();
		}
		$totalscore = $totalscore + $votevalue;
		$average = $totalscore / $votes;
		$average = round($average, 2);
		global $db;
		$query = "UPDATE images SET numvotes = :votes,  totalscore = :totalscore, average = :average WHERE image_id = :image_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':votes', $votes);
		$statement->bindValue(':totalscore', $totalscore);
		$statement->bindValue(':average', $average);
		$statement->bindValue(':image_id', $image_id);
		$statement->execute();
		$statement->closeCursor();
		$query = "UPDATE profiles SET total_score = total_score + :votevalue WHERE user_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':votevalue', $votevalue);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function check_has_voted($image_id, $user_id, $ip){
		global $db;
		$query = "SELECT image_id FROM unique_vote WHERE image_id = :image_id AND has_voted = :user_id OR image_id = :image_id AND ip = :ip";
		$statement = $db->prepare($query);
		$statement->bindValue(':image_id', $image_id);
		$statement->bindValue(':user_id', $user_id);
		$statement->bindValue(':ip', $ip);
		$statement->execute();
		if($statement->rowCount() >= 1){
			return true;
		} else {
			return false;
		}
	}
	
	function increment_bandwidth_views($image_id, $size, $bandwidth){
		$new_bandwidth = $bandwidth + $size;
		global $db;
		$query = "UPDATE images SET views = views + 1, bandwidth = :bandwidth WHERE image_id = :image_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':bandwidth', $new_bandwidth);
		$statement->bindValue(':image_id', $image_id);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function rate_image($image_id, $title, $category, $subcategory){ //function that checks for filename's category that is requested to be rated (after upload) so that the image is copied to right images/folder.
		global $db;
		$query = "UPDATE images SET vote = 1, title = :title, category = :category, subcategory = :subcategory WHERE image_id = :image_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':title', $title);
		$statement->bindValue(':category', $category);
		$statement->bindValue(':subcategory', $subcategory);
		$statement->bindValue(':image_id', $image_id);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function update_img_description($newImgDescription, $image_id, $newTitle){
		global $db;
		$query = "UPDATE images SET description = :description, title = :newtitle WHERE image_id = :image_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':image_id', $image_id);
		$statement->bindValue(':description', $newImgDescription);
		$statement->bindValue(':newtitle', $newTitle);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function alter_image_state($image_id, $state, $title){
		global $db;
		$query = "UPDATE images SET state = :state, title = :title WHERE image_id = :image_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':state', $state);
		$statement->bindValue(':title', $title);
		$statement->bindValue(':image_id', $image_id);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function get_imgstate($image_id, $username){ //Can maybe remove this one. Not in use atm.
		global $db;
		$query = "SELECT state FROM images WHERE image_id = '$image_id' AND username = '$username'";
		$result = $db->query($query)->fetch();
		return $result;
	}
	
	function get_votestatus($filename){
		global $db;
		$query = "SELECT user_id, vote, state FROM images WHERE filename = :filename";
		$statement = $db->prepare($query);
		$statement->bindValue(':filename', $filename);
		$statement->execute();
		if($statement->rowCount()){
			return $statement->fetch();
		} else {
			return false;
		}
	}
	
	function check_image_guest($filename){
		global $db;
		$query = "SELECT filename FROM images_guest WHERE filename = :filename";
		$statement = $db->prepare($query);
		$statement->bindValue(':filename', $filename);
		$statement->execute();
		if($statement->rowCount() == 1){
			return $statement->fetch();
		} else {
			return false;
		}
	}
	
	function random_filename($alphas){
		$min = 1;
		$max = 25;
		$randnr1 = rand($min, $max);
		$randnr2 = rand($min, $max);
		$randnr3 = rand($min, $max);
		$randletter1 = $alphas[$randnr1];
		$randletter2 = $alphas[$randnr2];
		$randletter3 = $alphas[$randnr3];
		$min = 1;
		$max = 9;
		$randnr1 = rand($min, $max);
		$randnr2 = rand($min, $max);
		$result = $randletter1.$randnr1.$randletter2.$randletter3.$randnr2;
		return $result;
	}
	
	function insertImg_into_db($filename, $filesize, $vote, $user_id){ 
		global $db;
		$today = date("Y-m-d");
		$today2 = date("Y-m-d H:i:s");
		if($vote == 1){
			$query = "INSERT INTO images(filename, size, vote, state, timestamp_upload, user_id, timestamp_2)
			VALUES(:filename, :filesize, 1, 1, :date, :user_id, :timestamp2)";
		} else {
			$query = "INSERT INTO images(filename, size, vote, state, timestamp_upload, user_id, timestamp_2)
			VALUES(:filename, :filesize, 0, 1, :date, :user_id, :timestamp2)";
		}
		$statement = $db->prepare($query);
		$statement->bindValue(':filename', $filename);
		$statement->bindValue(':filesize', $filesize);
		$statement->bindValue(':date', $today);
		$statement->bindValue(':user_id', $user_id);
		$statement->bindValue(':timestamp2', $today2);
		$statement->execute();
		$statement->closeCursor();
		$query = "SELECT LAST_INSERT_ID() FROM images";
		$statement = $db->prepare($query);
		$statement->execute();
		return $statement->fetch();
	}
	
	function insertImg_into_db_guest($filename, $upload_id){
		global $db;
		$query = "INSERT INTO images_guest(filename, upload_id) VALUES(:filename, :upload_id)";
		$statement = $db->prepare($query);
		$statement->bindValue(':filename', $filename);
		$statement->bindValue(':upload_id', $upload_id);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function like_img($filename){
		global $db;
		$query = "UPDATE images SET likes = likes + 1 WHERE filename = :filename";
		$statement = $db->prepare($query);
		$statement->bindValue(':filename', $filename);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function dislike_img($filename){
		global $db;
		$query = "UPDATE images SET dislikes = dislikes + 1 WHERE filename = :filename";
		$statement = $db->prepare($query);
		$statement->bindValue(':filename', $filename);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function insert_favimg($image_id, $user_id){
		global $db;
		$query = "INSERT INTO favourite_images(image_id, user_id) VALUES(:image_id, :user_id)";
		$statement = $db->prepare($query);
		$statement->bindValue(':image_id', $image_id);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		$statement->closeCursor();
		$query = "UPDATE images SET favourites = favourites + 1 WHERE image_id = :image_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':image_id', $image_id);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function get_favimg($user_id){
		global $db;
		$query = "SELECT favourite_images.image_id, images.filename, images.user_id FROM favourite_images LEFT JOIN images ON favourite_images.image_id = images.image_id WHERE favourite_images.user_id = :user_id ORDER BY favourite_images.timestamp DESC LIMIT 0, 36";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			return $statement->fetchAll();
		} else {
			return false;
		}
	}
	
	function get_favimg_next($user_id, $offset){
		global $db;
		$query = "SELECT favourite_images.*, images.filename, images.user_id FROM favourite_images LEFT JOIN images ON favourite_images.image_id = images.image_id WHERE favourite_images.user_id = :user_id ORDER BY timestamp DESC LIMIT $offset, 16";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			return $statement->fetchAll();
		} else {
			return false;
		}
	}
	
	function count_favimg($user_id){
		global $db;
		$query = "SELECT COUNT(image_id) FROM favourite_images WHERE user_id = :user_id ORDER BY timestamp DESC";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			return $statement->fetch();
		} else {
			return false;
		}
	}
	
	function get_favimg_status($user_id){
		global $db;
		$query = "SELECT filename, img_state, image_owner FROM favourite_images WHERE user_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			$result = $statement->fetchAll();
			$statement->closeCursor();
			return $result;
		} else {
			return false;
		}
	}
	
	function check_favourite_status($user_id, $image_id){
		global $db;
		$query = "SELECT COUNT(image_id) FROM favourite_images WHERE user_id = :user_id AND image_id = :image_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->bindValue(':image_id', $image_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			return $statement->fetch();
		} else {
			return false;
		}
	}
	
	function remove_favourite($user_id, $image_id){
		global $db;
		$query = "DELETE FROM favourite_images WHERE user_id = :user_id AND image_id = :image_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->bindValue(':image_id', $image_id);
		$statement->execute();
		$statement->closeCursor();
		$query = "UPDATE images SET favourites = favourites - 1 WHERE image_id = :image_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':image_id', $image_id);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function toplist_info($filename){
		global $db;
		$query = "SELECT filename, average, vote, username, timestamp FROM images WHERE filename = '$filename'";
		$result = $db->query($query)->fetch();
		return $result;
	}
	
	function toplist_fileinfo($filename){
		
	}
	
	function sort_topplist($topplist){
		for($i = 0; $i <= (count($topplist) - 1); $i++){
			$fileinfo = topplist_info($topplist[$i]);
		}
	}

	function time_passed($seconds){
		if((time() - $seconds) < 60){
			$image_time = " just a few moments ago";
		} else if(((time() - $seconds) > 60) && ((time()  - $seconds) < 3600)){
			$image_time = round($seconds / 60);
			$image_time = $image_time . " minute(s) ago";
		} else if(((time() - $seconds) > 3600) && ((time() - $seconds) < 86400)){
			$image_time = round($seconds / 3600);
			$image_time = $image_time . " hour(s) ago.";
		} else if(((time() - $seconds) > 86401) && ((time() - $seconds) < 2629743)){
			$image_time = round($seconds / 86400);
			$image_time = $image_time . " day(s) ago.";
		} else if(((time() - $seconds) > 2629743) && ((time() - $seconds) < 31556926)){
			$image_time = round($seconds / 2629743);
			$image_time = $image_time . " month(s) ago.";
		} else if(((time() - $seconds) > 31556926) && ((time() - $seconds) < time())){
			$image_time = round($seconds / 86400);
			$image_time = $image_time . " year(s) ago.";
		}
		return $image_time;
	}
	
	function total_storage($user_id){
		global $db;
		$query = "SELECT size, bandwidth, likes FROM images WHERE user_id = :user_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $user_id);
		$statement->execute();
		if($statement->rowCount() >= 1){
			$result = $statement->fetchAll();
			$statement->closeCursor();
			$dataArray = array();
			$totalbandwidth = 0;
			$totalsize = 0;
			$totallikes = 0;
			foreach($result as $size){
				$totalsize += $size['size'];
			}
			if($totalsize < 1){
				$totalsize = " < 1 MB";
				array_push($dataArray, $totalsize);
			} else if($totalsize > 1 && $totalsize < 1000){
				$totalsize = round($totalsize, 1) . " MB.";
				array_push($dataArray, $totalsize);
			} else if($totalsize > 1000 && $totalsize < 1000000){
				$totalsize = round($totalsize, 1) . " GB.";
				array_push($dataArray, $totalsize);
			}
			
			foreach($result as $bandwidth){
				$totalbandwidth += $bandwidth['bandwidth'];
			}
			if($totalbandwidth < 1){
				$totalbandwidth = "< 1MB.";
				array_push($dataArray, $totalbandwidth);
			}else if($totalbandwidth > 1 && $totalbandwidth < 1000){
				$totalbandwidth = round($totalbandwidth, 1) . " MB.";
				array_push($dataArray, $totalbandwidth);
			} else if($totalbandwidth > 1000 && $totalbandwidth < 1000000){
				$totalbandwidth = round($totalbandwidth, 1) . " GB.";
				array_push($dataArray, $totalbandwidth);
			}
			
			foreach($result as $likes){
				$totallikes += $likes['likes'];
			}
			
			if($totallikes == "0"){
				array_push($dataArray, 0);
			} else {
				array_push($dataArray, $totallikes);
			}
			return $dataArray;
		} else {
			return null;	
		}
	}
	
	function delete_image($filename, $image_id, $user_id){
		global $db;
		$imagepath2 = 'member/'.$user_id.'/files/'.$filename;
		$imagepath3 = 'member/'.$user_id.'/large/'.$filename;
		$imagepath4 = 'member/'.$user_id.'/thumbnail/'.$filename;
		$imagepath5 = 'member/'.$user_id.'/thumbnail/mini'.$filename;
		unlink($imagepath2); unlink($imagepath3); unlink($imagepath4); unlink($imagepath5);
		$query = "DELETE FROM images WHERE image_id = :image_id";
		$statement = $db->prepare($query);
		$statement->bindValue(':image_id', $image_id);
		$statement->execute();
		$statement->closeCursor();
	}
	
	function image_resize($filename, $user_id, $old_image, $guest){
		($guest == true) ? $new_path = 'g/files/'.$filename : $new_path = 'member/'.$user_id.'/files/'.$filename; 
		$old_width = imagesx($old_image);
		$old_height = imagesy($old_image);
		$width_ratio = $old_width / 585;
		//Create new picture if either width or height ratio is larger then one i.e Picture is to large.
		if($width_ratio > 1 || $old_height > 3000){
			$height_ratio = $old_height / 3000;
			$ratio = max($width_ratio, $height_ratio);
			$new_height = round($old_height / $ratio);
			$new_width = round($old_width / $ratio);
			$new_image = imagecreatetruecolor($new_width, $new_height);
			 
			// Set transparency according to image type
			if ($old_image == IMAGETYPE_GIF) {
				$alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
				imagecolortransparent($new_image, $alpha);
			}
			 
			if ($old_image == IMAGETYPE_PNG || $old_image == IMAGETYPE_GIF) {
				imagealphablending($new_image, false);
				imagesavealpha($new_image, true);
			}
			 
			// Copy old image to new image - this resizes the image
			$new_x = 0;
			$new_y = 0;
			$old_x = 0;
			$old_y = 0;
			imagecopyresampled($new_image, $old_image,
					$new_x, $new_y, $old_x, $old_y,
					$new_width, $new_height, $old_width, $old_height);
			 
			imagejpeg($new_image, $new_path);
			imagedestroy($new_image);
		} else {
			($guest == true) ? $new_path = copy('g/large/'.$filename, $new_path) : copy('member/'.$user_id.'/large/'.$filename, $new_path); 
		}
	}
	
	function image_resizeprofile($user_id, $old_image, $filename){
		$new_path = 'member/'.$user_id.'/files/'.$filename;
		$old_width = imagesx($old_image);
		$old_height = imagesy($old_image);
		$width_ratio = $old_width / 180;
		if($width_ratio > 1 || $old_height > 250){
			$height_ratio = $old_height / 250;
			$ratio = max($width_ratio, $height_ratio);
			$new_height = round($old_height / $ratio);
			$new_width = round($old_width / $ratio);
			$new_image = imagecreatetruecolor($new_width, $new_height);
	
			// Set transparency according to image type
			if ($old_image == IMAGETYPE_GIF) {
				$alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
				imagecolortransparent($new_image, $alpha);
			}
	
			if ($old_image == IMAGETYPE_PNG || $old_image == IMAGETYPE_GIF) {
				imagealphablending($new_image, false);
				imagesavealpha($new_image, true);
			}
	
			// Copy old image to new image - this resizes the image
			$new_x = 0;
			$new_y = 0;
			$old_x = 0;
			$old_y = 0;
			imagecopyresampled($new_image, $old_image,
					$new_x, $new_y, $old_x, $old_y,
					$new_width, $new_height, $old_width, $old_height);
	
			imagejpeg($new_image, $new_path);
			imagedestroy($new_image);
		}
	}
	
	function image_resizeThumbnail($old_image, $filename, $user_id){
		$new_path = 'member/'.$user_id.'/thumbnail/'.$filename;
		$old_width = imagesx($old_image);
		$old_height = imagesy($old_image);
		$width_ratio = $old_width / 185;
		$height_ratio = $old_height / 185;
		if($width_ratio > 1 || $height_ratio > 1){
			$ratio = max($width_ratio, $height_ratio);
			$new_height = round($old_height / $ratio);
			$new_width = round($old_width / $ratio);
			$new_image = imagecreatetruecolor($new_width, $new_height);
	
			// Set transparency according to image type
			if ($old_image == IMAGETYPE_GIF) {
				$alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
				imagecolortransparent($new_image, $alpha);
			}
	
			if ($old_image == IMAGETYPE_PNG || $old_image == IMAGETYPE_GIF) {
				imagealphablending($new_image, false);
				imagesavealpha($new_image, true);
			}
	
			// Copy old image to new image - this resizes the image
			$new_x = 0;
			$new_y = 0;
			$old_x = 0;
			$old_y = 0;
			imagecopyresampled($new_image, $old_image,
					$new_x, $new_y, $old_x, $old_y,
					$new_width, $new_height, $old_width, $old_height);
	
			imagejpeg($new_image, $new_path);
			imagedestroy($new_image);
		}
	}
	
	function image_resizeMini($old_image, $user_id, $filename){
		$userThumbnail = 'member/'.$user_id.'/thumbnail/mini'.$filename;
		$old_width = imagesx($old_image);
		$old_height = imagesy($old_image);
		$width_ratio = $old_width / 80;
		$height_ratio = $old_height / 80;
		//Create new picture if either width or height ratio is larger then one i.e Picture is to large.
		if($width_ratio > 1 || $height_ratio > 1){
			$ratio = max($width_ratio, $height_ratio);
			$new_height = round($old_height / $ratio);
			$new_width = round($old_width / $ratio);
			$new_image = imagecreatetruecolor($new_width, $new_height);
	
			// Set transparency according to image type
			if ($old_image == IMAGETYPE_GIF) {
				$alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
				imagecolortransparent($new_image, $alpha);
			}
	
			if ($old_image == IMAGETYPE_PNG || $old_image == IMAGETYPE_GIF) {
				imagealphablending($new_image, false);
				imagesavealpha($new_image, true);
			}
	
			// Copy old image to new image - this resizes the image
			$new_x = 0;
			$new_y = 0;
			$old_x = 0;
			$old_y = 0;
			imagecopyresampled($new_image, $old_image,
					$new_x, $new_y, $old_x, $old_y,
					$new_width, $new_height, $old_width, $old_height);
	
			imagejpeg($new_image, $userThumbnail);
			imagedestroy($new_image);
		}
	}
	
	function image_resizeMini_guest($old_image, $filename){
		$userThumbnail = 'g/thumbnail/mini'.$filename;
		$old_width = imagesx($old_image);
		$old_height = imagesy($old_image);
		$width_ratio = $old_width / 80;
		$height_ratio = $old_height / 80;
		//Create new picture if either width or height ratio is larger then one i.e Picture is to large.
		if($width_ratio > 1 || $height_ratio > 1){
			$ratio = max($width_ratio, $height_ratio);
			$new_height = round($old_height / $ratio);
			$new_width = round($old_width / $ratio);
			$new_image = imagecreatetruecolor($new_width, $new_height);
	
			// Set transparency according to image type
			if ($old_image == IMAGETYPE_GIF) {
				$alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
				imagecolortransparent($new_image, $alpha);
			}
	
			if ($old_image == IMAGETYPE_PNG || $old_image == IMAGETYPE_GIF) {
				imagealphablending($new_image, false);
				imagesavealpha($new_image, true);
			}
	
			// Copy old image to new image - this resizes the image
			$new_x = 0;
			$new_y = 0;
			$old_x = 0;
			$old_y = 0;
			imagecopyresampled($new_image, $old_image,
			$new_x, $new_y, $old_x, $old_y,
			$new_width, $new_height, $old_width, $old_height);
	
			imagejpeg($new_image, $userThumbnail);
			imagedestroy($new_image);
		}
	}
?>