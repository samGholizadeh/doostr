<?php
	include_once 'model/database.php';
	include_once 'model/DBfunctions.php';
	include_once 'model/album_db.php';
	include_once 'model/profile_db.php';
	include_once 'model/message_db.php';
	include_once 'model/member_db.php';
	include_once 'model/image_db.php';
	include_once 'model/friend_db.php';
	include_once 'model/comments_db.php';
	include_once 'model/toplist_functions.php';
	
	session_start();
	
	if(empty($subcategoriesmeme)){
		$subcategoriesmeme = array('Scumbag Brain', 'Firstworld Problems', 'Forever Alone', 'Socially Awkward Penguin', 'Scumbag Steve', 'Success Kid', 
				'Good Guy Greg', 'Fry', 'Philosophoraptor', 'College Freshman', 'Condescending Wonka', 'Lazy College Senior', 'Morpheus',
				'Successful Blackman', 'Suburban Mom', 'Asian Father', 'Butthurt Dweller', 'Conspiracy Keanu',
				'Unhelpful Teacher', 'other');
		$DBmeme = array('sb', 'fp', 'fa', 'sap', 'ss', 'sk', 'ggg', 'fry', 'pr', 'cf', 'cw', 'lcs', 'Morpheus', 'sbm', 'sm', 'af', 'bd', 'ck', 
				'ut', 'other');
	}
	
	if(empty($subcategoriesart)){
		$subcategoriesart = array('Computer generated imagery', 'Painting', 'Photography');
		$DBart = array('cgi', 'painting', 'photography');
	}
	
	if(empty($alphas)){
		$alphas = range('a', 'z');
	}
	
	if((isset($_POST['i'])) || isset($_GET['i'])){
		if(isset($_SESSION['user_id'])){
			$_SESSION['subcategory'] = false;
			if(isset($_POST['filepath'])){
				$filename = basename($_POST['filepath']);
				$image_info = check_file_filename($filename);
			} else {
				(isset($_POST['i'])) ? $filename = $_POST['i'] : $filename = $_GET['i'];
				$image_info = check_file_filename($filename);
			}
			(isset($_POST['arbitrary'])) ? $modal = true : $modal = false;
			$random_image = 'member/'.$image_info['user_id'].'/files/'.$image_info['filename'];
			$favourite = check_favourite_status($_SESSION['user_id'], $image_info['image_id']);
			$imagecomments = get_imagecomments($image_info['image_id'], $_SESSION['user_id']);
			$count_comments = count_imagecomments($image_info['image_id']);
			if($image_info['category'] == "meme"){
				$subcategorylinks = glob('assets/imgsource/buttons/meme3/*');
			} else if($image_info['category'] == "art"){
				$subcategorylinks = glob('assets/imgsource/buttons/art2/*');
			}
			if(isset($_POST['next'])){
				$filepaths = get_toplists($image_info['category']);
				include_once 'voteview_nextimg.php';
				break;
			} else if($modal){
				include_once 'profile_gallery_rated_modal.php';
				break;
			} else {
				$_SESSION['current_view'] = 0;
				$profile_messages = false;
				$new_messages = check_new_messages($_SESSION['user_id']);
				$new_friend = check_new_friends($_SESSION['user_id']);
				$filepaths = get_toplists($image_info['category']);
				$_SESSION['filepaths'] = $filepaths[0];
				shuffle($_SESSION['filepaths']);
				$_SESSION['image_count'] = count($_SESSION['filepaths']);
				$_SESSION['next_image_counter'] = 0;
				$_SESSION['toplist2'] = $filepaths[2];
				$_SESSION['toplist3'] = $filepaths[3];
				$_SESSION['toplist4'] = $filepaths[4];
				$_SESSION['toplist5'] = $filepaths[5];
				$_SESSION['toplist6'] = $filepaths[6];
				include_once 'voteview.php';
			}
		} else {
			$_SESSION['subcategory'] = false;
			if(isset($_POST['filepath'])){
				$filename = basename($_POST['filepath']);
				$image_info = check_file_filename($filename);
			} else {
				(isset($_POST['i'])) ? $filename = $_POST['i'] : $filename = $_GET['i'];
				$image_info = check_file_filename($filename);
			}
			(isset($_POST['arbitrary'])) ? $modal = true : $modal = false;
			$random_image = 'member/'.$image_info['user_id'].'/files/'.$image_info['filename'];
			$imagecomments = get_imagecomments_guest($image_info['image_id']);
			$count_comments = count_imagecomments($image_info['image_id']);
			if($image_info['category'] == "meme"){
				$subcategorylinks = glob('assets/imgsource/buttons/meme3/*');
			} else if($image_info['category'] == "art"){
				$subcategorylinks = glob('assets/imgsource/buttons/art2/*');
			}
			if(isset($_POST['next'])){
				$filepaths = get_toplists($image_info['category']);
				include_once 'voteview_nextimg_guest.php';
				break;
			} else if($modal){
				include_once 'profile_gallery_rated_modal.php';
				break;
			} else {
				$_SESSION['current_view'] = 0;
				$profile_messages = false;
				$filepaths = get_toplists($image_info['category']);
				$_SESSION['filepaths'] = $filepaths[0];
				shuffle($_SESSION['filepaths']);
				$_SESSION['image_count'] = count($_SESSION['filepaths']);
				$_SESSION['next_image_counter'] = 0;
				$_SESSION['toplist2'] = $filepaths[2];
				$_SESSION['toplist3'] = $filepaths[3];
				$_SESSION['toplist4'] = $filepaths[4];
				$_SESSION['toplist5'] = $filepaths[5];
				$_SESSION['toplist6'] = $filepaths[6];
				$_SESSION['image_infos'] = array();
				$_SESSION['image_comments'] = array();
				$_SESSION['count_comments'] = array();
				include_once 'voteview_guest.php';
			}
		}
	} else if((isset($_POST['x'])) || (isset($_GET['x']))){
		(isset($_POST['x'])) ? $filename = $_POST['x'] : $filename = $_GET['x'];
		$result = get_votestatus($filename);
		$profile_messages = false;
		if(isset($result['user_id'])){
			if(($result['vote'] == 1) || ($result['state'] == 1)){
				$link = "member/".$result['user_id']."/large/".$filename;
			} else {
				$result = false;
			}
		}
		include_once 'voteview_image_large.php';
	} else if((isset($_POST['z'])) || (isset($_GET['z']))){
		(isset($_POST['z'])) ? $filename = $_POST['z'] : $filename = $_GET['z'];
		$result = check_image_guest($filename);
		$profile_messages = false;
		if($result != false){
			$link = "g/large/".$result['filename'];
		}
		include_once 'voteview_image_large_guest.php';
	} else if((isset($_POST['y'])) || (isset($_GET['y']))){
		$upload_id = $_GET['y'];
		if(isset($_SESSION[$_GET['y']])){
			$_SESSION['filenames'] = true;
			$array_length = count($_SESSION[$_GET['y']]);
			($array_length == 1) ? $array_length = 0 : $array_length = count($_SESSION[$_GET['y']]);
			$large_version = "doostr.com/?z=".$_SESSION[$upload_id][0];
			if(isset($_SESSION['user_id'])){
				$new_messages = check_new_messages($_SESSION['user_id']);
				$new_friend = check_new_friends($_SESSION['user_id']);
			}
		} else {
			$_SESSION[$_GET['y']] = array();
			$_SESSION['filenames'] = guest_uploaded_images($_GET['y']);
			$array_length = count($_SESSION['filenames']) - 1;
			if($_SESSION['filenames'] != false){
				for($i = 0; $i <= $array_length; $i++){
					array_push($_SESSION[$_GET['y']], $_SESSION['filenames'][$i][0]);
				}
			}
			($array_length == 1) ? $array_length = 0 : $array_length = (count($_SESSION['filenames']));
			$large_version = "doostr.com/?z=".$_SESSION[$upload_id][0];
			if(isset($_SESSION['user_id'])){
				$new_messages = check_new_messages($_SESSION['user_id']);
				$new_friend = check_new_friends($_SESSION['user_id']);
			}
		}
		$profile_messages = false;
		include_once 'voteview_guest_upload.php';
	} else if((isset($_POST['r'])) || (isset($_GET['r']))){
		if(isset($_SESSION['user_id'])){
			$upload_id = $_GET['r'];
			if(isset($_GET['r'])){
				$_SESSION['filenames'] = true;
				$array_length = count($_SESSION[$_GET['r']]);
				($array_length == 1) ? $array_length = 0 : $array_length = count($_SESSION[$_GET['r']]);
				$new_messages = check_new_messages($_SESSION['user_id']);
				$new_friend = check_new_friends($_SESSION['user_id']);
			} else {
				$_SESSION[$_GET['r']] = array();
				$_SESSION['filenames'] = get_upload_filename($_GET['r']);
				$array_length = count($_SESSION['filenames']) - 1;
				if($_SESSION['filenames'] != false){
					for($i = 0; $i <= $array_length; $i++){
						array_push($_SESSION[$_GET['r']], $_SESSION['filenames'][$i][0]);
					}
				}
				($array_length == 0) ? $array_length = 0 : $array_length = (count($_SESSION['filenames']));
				$new_messages = check_new_messages($_SESSION['user_id']);
				$new_friend = check_new_friends($_SESSION['user_id']);
			}
			$image_link = "member/".$_SESSION['user_id']."/files/".$_SESSION[$upload_id][0];
			$large_version = "http://doostr.com/?x=".$_SESSION[$upload_id][0];
		} else {
			$_SESSION['filename'] = false;
		}
		$profile_messages = false;
		include_once 'voteview_upload.php';
	} else {
		if(isset($_SESSION['user_id'])){
		
		$new_messages = false;
		$new_friend = false;
		
		if(isset($_POST['a'])){
			$action = $_POST['a'];
		} else if(isset($_GET['a'])){
			$action = $_GET['a'];
		} else {
			$action = 'profile';
		}
		
		switch($action){
			case 'profile':
				$_SESSION['image_id_upload'] = array();
				$_SESSION['image_filename_upload'] = array();
				$_SESSION['user_true'] = true;
				$_SESSION['current_view'] = 1;
				$totalstorage = total_storage($_SESSION['user_id']);
				$profile_info = get_profile($_SESSION['user_id']);
				$_SESSION['age'] = $profile_info['age'];
				$_SESSION['verified'] = $profile_info['verified'];
				$_SESSION['profileimg'] = $profile_info['profileimg'];
				$_SESSION['gender'] = $profile_info['gender'];
				$images = get_all($_SESSION['user_id']);
				$image_count = get_all_count($_SESSION['user_id']);
				$new_messages = check_new_messages($_SESSION['user_id']);
				$new_friend = check_new_friends($_SESSION['user_id']);
				$profile_messages = false;
				$profile_friends = false;
				include_once 'profile.php';
				break;
			case 'upload_image':
				$file = $_FILES['qqfile']['tmp_name'];
				$filename = $_FILES['qqfile']['name'];
				$filesize = round(($_FILES['qqfile']['size'] / 1000000), 2, PHP_ROUND_HALF_UP);
				$fileExt = pathinfo($filename, PATHINFO_EXTENSION);
				if($fileExt == "jpg" || $fileExt == "jpeg" || $fileExt == "png" || $fileExt == "gif" || $fileExt == "JPG"){
					$_SESSION['upload_filename'] = random_filename($alphas).'.'.$fileExt;
					$destination = 'member/'.$_SESSION['user_id'].'/large/'.$_SESSION['upload_filename'];
					move_uploaded_file($file, $destination);
					switch($_FILES['qqfile']['type']){
						case 'image/gif':
							$old_image = imagecreatefromgif($destination);
							break;
						case 'image/jpg':
						case 'image/jpeg':
							$old_image = imagecreatefromjpeg($destination);
							break;
						case 'image/png':
							$old_image = imagecreatefrompng($destination);
							break;
					}
					image_resize($_SESSION['upload_filename'], $_SESSION['user_id'], $old_image, false);
					image_resizeThumbnail($old_image, $_SESSION['upload_filename'], $_SESSION['user_id']);
					image_resizeMini($old_image, $_SESSION['user_id'], $_SESSION['upload_filename']);
					$image_id = insertImg_into_db($_SESSION['upload_filename'], $filesize, 0, $_SESSION['user_id']);
					array_push($_SESSION['image_id_upload'], $image_id[0]);
					array_push($_SESSION['image_filename_upload'], $_SESSION['upload_filename']);
				}
				break;
			case 'upload_image2':
				$number_uploaded_images = count($_SESSION['image_id_upload']) - 1;
				$is_rated = array();
				$image_id = array();
				$filename = array();
				$state = array();
				$title = array();
				for($i = 0; $i <= $number_uploaded_images; $i++){
					if($_POST['is_rated'][$i] == 1){
						(isset($_POST['rate_info'][$i][2])) ? : array_push($_POST['rate_info'][$i], "");
						rate_image($_SESSION['image_id_upload'][$i], $_POST['rate_info'][$i][0], $_POST['rate_info'][$i][1], $_POST['rate_info'][$i][2]);
						array_push($is_rated, 1);
						array_push($state, 1);
						array_push($title, htmlspecialchars($_POST['rate_info'][$i][0]));
					} else {
						alter_image_state($_SESSION['image_id_upload'][$i], $_POST['permission_state'][$i][0], $_POST['permission_state'][$i][1]);
						array_push($is_rated, 0);
						array_push($state, $_POST['permission_state'][$i][0]);
						array_push($title, htmlspecialchars($_POST['permission_state'][$i][1]));
					}
					array_push($image_id, $_SESSION['image_id_upload'][$i]);
					array_push($filename, $_SESSION['image_filename_upload'][$i]);
				}
				$array_length = count($image_id);
				include_once 'profile_image_gallery_template.php';
				break;
			case 'upload_id_session':
				$_SESSION['upload_id'] = random_filename($alphas);
				$_SESSION[$_SESSION['upload_id']] = array();
				break;
			case 'upload_add_guest_filename':
				array_push($_SESSION[$_SESSION['upload_id']], $_SESSION['upload_filename']);
				set_upload_id($_SESSION['upload_filename'], $_SESSION['upload_id']);
				break;	
			case 'upload_image2_voteview':
				$number_uploaded_images = count($_SESSION['image_id_upload']) - 1;
				$is_rated = array();
				$image_id = array();
				$filename = array();
				$state = array();
				$title = array();
				for($i = 0; $i <= $number_uploaded_images; $i++){
					if($_POST['is_rated'][$i] == 1){
						(isset($_POST['rate_info'][$i][2])) ? : array_push($_POST['rate_info'][$i], "");
						rate_image($_SESSION['image_id_upload'][$i], $_POST['rate_info'][$i][0], $_POST['rate_info'][$i][1], $_POST['rate_info'][$i][2]);
						array_push($is_rated, 1);
						array_push($state, 1);
						array_push($title, htmlspecialchars($_POST['rate_info'][$i][0]));
					} else {
						alter_image_state($_SESSION['image_id_upload'][$i], $_POST['permission_state'][$i][0], $_POST['permission_state'][$i][1]);
						array_push($is_rated, 0);
						array_push($state, $_POST['permission_state'][$i][0]);
						array_push($title, htmlspecialchars($_POST['permission_state'][$i][1]));
					}
					array_push($image_id, $_SESSION['image_id_upload'][$i]);
					array_push($filename, $_SESSION['image_filename_upload'][$i]);
				}
				$array_length = count($image_id);
				break;
			case 'upload_done':
				$upload = array("upload_id" => $_SESSION['upload_id']);
				echo json_encode($upload);
				break;
			case 'next_uploaded_image':
				$upload_id = $_POST['upload_id'];
				$current_page = $_POST['current_page'] - 1;
				$image_link = "member/".$_SESSION['user_id']."/files/".$_SESSION[$upload_id][$current_page];
				include_once 'voteview_upload_template.php';
				break;
			case 'profile_gallery':
				$images = get_all($_SESSION['user_id']);
				$image_count = get_all_count($_SESSION['user_id']);
				include_once 'profile_gallery.php';
				break;
			case 'profilem':
				$_SESSION['user_true'] = true;
				$_SESSION['current_view'] = 1;
				$totalstorage = total_storage($_SESSION['user_id']);
				$profile_info = get_profile($_SESSION['user_id']);
				$new_messages = check_new_messages($_SESSION['user_id']);
				$new_friend = check_new_friends($_SESSION['user_id']);
				$message_list = get_inboxmessage_list($_SESSION['user_id']);
				$array_length_inbox = count($message_list[0]);
				$array_length_send = count($message_list[1]);
				$profile_messages = true;
				$profile_friends = false;
				include_once 'profile.php';
				break;
			case 'profilef':
				$_SESSION['user_true'] = true;
				$_SESSION['current_view'] = 1;
				$totalstorage = total_storage($_SESSION['user_id']);
				$profile_info = get_profile($_SESSION['user_id']);
				$new_messages = check_new_messages($_SESSION['user_id']);
				$new_friend = check_new_friends($_SESSION['user_id']);
				$friends = get_friends($_SESSION['user_id']);
				$profile_messages = false;
				$profile_friends = true;
				include_once 'profile.php';
				break;
			case 'profile_gallery_next_page_all':
				($_SESSION['user_id'] == $_POST['user_id']) ? $arbitrary = 1 : $arbitrary = 0;
				$offset = ($_POST['current_page'] - 1) * 25;
				if($arbitrary == 1){
					$images = get_all_next($_POST['user_id'], $offset);
				} else {
					$images = get_all_other_next($_POST['user_id'], $_SESSION['friendstate'], $offset);
				}
				$current_page = $_POST['current_page'];
				include_once 'profile_gallery_all_next.php';
				break;
			case 'profile_modal_comment':
				$image_id = $_POST['image_id']; /*Req since no image_id when no comments avail.*/
				$comments = get_modal_comments($_POST['image_id']);
				$comment_count = count_modal_comments($_POST['image_id']);
				include_once 'profile_gallery_modal_comments.php';
				break;
			case 'profile_modal_comments_next':
				$offset = ($_POST['current_page'] - 1) * 7;
				$comments = get_modal_comments_next($_POST['image_id'], $offset);
				include_once 'profile_gallery_modal_comments_next.php';
				break;
			case 'profile_modal_comment_send':
				$comment = $_POST['comment'];
				$comment_id = insert_modal_comment(htmlspecialchars($comment), $_POST['image_id'], $_POST['private'], $_SESSION['user_id'], $_SESSION['username']);
				include_once 'profile_gallery_modal_comment_template.php';
				break;
			case 'profile_gallery_rated':
				($_POST['user_id'] == $_SESSION['user_id']) ? $user_true = true : $user_true = false;
				$rated_images = get_all_rated($_POST['user_id']);
				$rated_images_count = get_all_rated_count($_POST['user_id']);
				include_once 'profile_gallery_rated.php';
				break;
			case 'profile_gallery_rated_next':
				($_POST['user_id'] == $_SESSION['user_id']) ? $user_true = true : $user_true = false;
				$offset = ($_POST['current_page'] - 1) * 16;
				$rated_images = get_rated_next($_POST['user_id'], $offset);
				$current_page = $_POST['current_page'];
				include_once 'profile_gallery_rated_next.php';
				break;
			case 'profile_gallery_favourites':
				($_POST['user_id'] == $_SESSION['user_id']) ? $user_true = true : $user_true = false;
				$favourites = get_favimg($_POST['user_id']);
				$array_length = count_favimg($_POST['user_id']);
				include_once 'profile_gallery_favourites.php';
				break;
			case 'profile_gallery_favourites_next':
				($_POST['user_id'] == $_SESSION['user_id']) ? $user_true = true : $user_true = false;
				$offset = ($_POST['current_page'] - 1) * 36;
				$favourites = get_favimg_next($_POST['user_id'], $offset);
				include_once 'profile_gallery_favourites_next.php';
				break;
			case 'profile_gallery_delete_favourite':
				remove_favourite($_SESSION['user_id'], $_POST['image_id']);
				break;
			case 'profile_add_image_form':
				include_once 'profile_add_image.php';
				break;
			case 'profile_add_image_art':
				include_once 'profile_add_image_subart.php';
				break;
			case 'profile_add_image_meme':
				include_once 'profile_add_image_submeme.php';
				break;
			case 'profile_add_rated_options':
				include_once 'profile_add_rated_options.php';
				break;
			case 'profile_gallery_change_image_state':
				alter_image_state($_POST['image_id'], $_POST['image_state']);
				break;
			case 'profile_comments':
				$comments = get_usercomments($_POST['user_id']); //returns false if does not exist
				$count_comments = count_usercomments($_POST['user_id']);
				include_once 'profile_comments.php';
				break;
			case 'profile_comments_likes':
				$comments_likes = get_usercomments_likes($_POST['user_id']);
				$count_comments_likes = count_usercomments($_POST['user_id']);
				include_once 'profile_comments_likes.php';
				break;
			case 'profile_comments_getreplies':
				$commentid = $_POST['commentid'];
				$comments = get_replies($commentid);
				if(isset($_POST['arbitrary'])){
					include_once 'profile_comments_reply.php';
					break;
				} else {
					include_once 'profile_comments_likes_reply.php';
					break;
				}
				break;
			case 'profile_comments_nexttencomments':
				(isset($_POST['arbitrary'])) ? $arbitrary = 1 : $arbitrary = 0;
				$current_page = ($_POST['current_page'] - 1);
				$offset = $current_page * 10;
				$comments = get_usercomments_next_ten($_POST['user_id'], $offset, $arbitrary);
				if($arbitrary == 1){
					include_once 'profile_comments_next_ten.php';
				} else {
					include_once 'profile_comments_next_ten_likes.php';
				}
				break;
			case 'show_parent_comment':
				$commentid = $_POST['parent_commentid'];
				$comment = get_parent_comment($commentid);
				include_once 'profile_comment_parent.php';
				break;
			case 'profile_messages':
				$message_list = get_inboxmessage_list($_SESSION['user_id']);
				$array_length_inbox = count($message_list[0]);
				$array_length_send = count($message_list[1]);
				include_once 'profile_messages.php';
				break;
			case 'profile_message_read':
				update_message_status($_POST['messageid'], $_SESSION['user_id']);
				break;
			case 'profile_message_reply_check':
				$result = check_message_friend_only($_POST['userx_id']);
				$result2 = check_relationship($_SESSION['user_id'], $_POST['userx_id']);
				if($result){
					if(!$result2){
						$export = array("send_message" => false);
						echo json_encode($export);
					} else if($result2['state'] == 2) {
						$export = array("send_message" => true);
						echo json_encode($export);
					}
				} else {
					$export = array("send_message" => true);
					echo json_encode($export);
				}
				break;
			case 'profile_message_reply':
				$parent_message_id = $_POST['messageid'];
				$reply = $_POST['reply'];
				$recipient = $_POST['recipient'];
				$today = date("Y-m-d H:i");
				$message_id = insert_message_reply($parent_message_id, $_SESSION['user_id'], $_POST['userx_id'], $recipient, htmlspecialchars($reply), $_SESSION['username']);
				include_once 'profile_messages_template_sent.php';
				break;
			case 'send_message':
				$message = $_POST['message'];
				send_message($_SESSION['user_id'], $_SESSION['username'], $_POST['userx_id'], $_POST['message'], $_POST['usernamex']);
				break;
			case 'profile_message_inbox_next':
				$offset = ($_POST['current_page'] - 1) * 17;
				$message_list = get_next_twenty_messages($_SESSION['user_id'], $offset);
				include_once 'profile_messages_next_twenty.php';
				break;
			case 'profile_message_sent_next':
				$offset = ($_POST['current_page'] - 1) * 17;
				$message_list = get_next_twenty_sent_messages($_SESSION['user_id'], $offset);
				include_once 'profile_messages_next_twenty_sent.php';
				break;
			case 'profile_message_delete':
				(isset($_POST['arbitrary'])) ? $arbitrary = 1 : $arbitrary = 0;
				delete_message($_POST['messageid'], $arbitrary);
				break;
			case 'check_new_messages':
				$new_messages = check_new_messages($_SESSION['user_id']);
				if(empty($new_messages[0])){
					$new_messages = array("value" => false);
				} else {
					$new_messages = array("value" => $new_messages[0], "current_view" => $_SESSION['current_view']);
				}
				echo json_encode($new_messages);
				break;
			case 'collect_new_messages':
				$new_messages = collect_new_messages($_SESSION['user_id']);
				if(!$new_messages){
					include_once 'profile_messages_template_inbox.php';
					break;
				} else {
					$array_length = count($new_messages);
					include_once 'profile_messages_template_inbox.php';
					break;
				}
			case 'profile_friends':
				$friends = get_friends($_SESSION['user_id']);
				include_once 'profile_friend.php';
				break;
			case 'profile_friend_remove':
				drop_friend($_SESSION['user_id'], $_POST['userx_id']);
				break;
			case 'profile_friend_request_choice':
				update_friendrequest($_POST['user_id'], $_SESSION['user_id'], $_POST['choice']);
				break;
			case 'profile_friend_remove_block':
				remove_block($_SESSION['user_id'], $_POST['userx_id']);
				break;
			case 'profile_friend_permission':
				alter_permission($_SESSION['user_id'], $_POST['userx_id'], $_POST['permission']);
				break;
			case 'profile_friend_request':
				insert_friendreq($_SESSION['user_id'], $_POST['userx_id'], $_SESSION['username'], $_POST['username']);
				break;
			case 'check_new_friends':
				$new_friends = check_new_friends($_SESSION['user_id']);
				if(empty($new_friends[0])){
					$new_friends = array("value" => false);
				} else {
					$new_friends = array("value" => $new_friends[0], "current_view" => $_SESSION['current_view']);
				}
				echo json_encode($new_friends);
				break;
			case 'get_modal_comment_container':
				$image_id = $_POST['image_id'];
				include_once 'profile_modal_comment_container.php';
				break;
			case 'profile_search_view':
				include_once 'profile_search_view.php';
				break;
			case 'profile_preferences':
				$profile_info = get_profile($_SESSION['user_id']);
				include_once 'profile_preferences.php';
				break;
			case 'make_profile_image':
				$filename = $_POST['filename'];
				insert_profile_image($_SESSION['user_id'], $_POST['filename']);
				include_once 'profile_image_template.php';
				break;
			case 'profile.':
				$_SESSION['user_true'] = false;
				$_SESSION['userx_id'] = $_POST['userx_id'];
				$_SESSION['friendstate'] = check_relationship($_SESSION['userx_id'], $_SESSION['user_id']);
				if($_SESSION['friendstate']['state'] == 3){
					include_once 'profile_blocked.php';
					break;
				}
				$profilex = get_profile($_SESSION['userx_id']);
				if((($profilex['profilevisibility'] == 2) && ($_SESSION['friendstate']['state'] != 2)) || ($_SESSION['userx_id'] == 14)){
					include_once 'profile_denied.php';
					break;
				} else if($profilex['profilevisibility'] == 3){
					include_once 'profile_denied.php';
					break;
				} else {
					$totalstorage = total_storage($_SESSION['userx_id']);
					$images = get_all_other($_SESSION['userx_id'], $_SESSION['friendstate']); /*friendstate includes permission and friendstate*/
					$image_count = get_all_other_count($_SESSION['userx_id'], $_SESSION['friendstate']);
					include_once 'profilex.php';
					break;
				}
			case 'search':
				(isset($_POST['username'])) ? $otheruser = $_POST['username'] : $otheruser = null;
				(isset($_POST['name'])) ? $name = $_POST['name'] : $name = null;
				(isset($_POST['lastname'])) ? $lastname = $_POST['lastname'] : $lastname = null;
				(isset($_POST['city'])) ? $city = $_POST['city'] : $city = null;
				(isset($_POST['country'])) ? $country = $_POST['country'] : $country = null;
				(isset($_POST['gender'])) ? $gender = $_POST['gender'] : $gender = null;
				/*(isset($_POST['agemin'])) ? $ageMin = $_POST['agemin'] : $ageMin = null;
					(isset($_POST['agemax'])) ? $ageMax = $_POST['agemax'] : $ageMax = null;*/
				$lastseen = $_POST['lastseen'];
				(isset($_POST['arbitrary'])) ? $arbitrary = 1 : $arbitrary = 0;
				if($arbitrary == 0){
					$offset = ($_POST['current_page'] - 1) * 25;
				} else {
					$offset = "";
				}
				$members = search_members($otheruser, $name, $lastname, $country, $city, $lastseen, $gender, $arbitrary, $offset);
				$search_result_array = array();
				switch($lastseen){
					case 'online':
						if(!empty($members)){
							foreach($members as $member){
								if(($member['user_id'] == $_SESSION['user_id']) || ($member['online'] == 0) || ($member['anonymous'] == 1) || ($member['appearoffline'] == 1) || ($member['user_id'] == 14) || ($member['user_id'] == 23)){
									continue;
								} else {
									array_push($search_result_array, $member);
								}
							}
						}
						break;
					case 'one':
						if(!empty($members)){
							foreach($members as $member){
								if(($member['user_id'] == $_SESSION['user_id']) || ($member['online'] == 1) || ($member['anonymous'] == 1) || ($member['appearoffline'] == 1) || ($member['user_id'] == 14) || ($member['user_id'] == 23)){
									continue;
								} else {
									$timeoffline = time() - strtotime($member['timestamp']);
									if(($timeoffline < 86400)){
										array_push($search_result_array, $member);
									}
								}
							}
						}
						break;
					case 'three':
						if(!empty($members)){
						foreach($members as $member){
							if(($member['user_id'] == $_SESSION['user_id']) || ($member['online'] == 1) || ($member['anonymous'] == 1) || ($member['appearoffline'] == 1) || ($member['user_id'] == 14) || ($member['user_id'] == 23)){
								continue;
							} else {
									$timeoffline = time() - strtotime($member['timestamp']);
									if(($timeoffline > 86401) && ($timeoffline < 259200)){
										array_push($search_result_array, $member);
									}
								}
							}
						}
						break;
					case 'seven':
						if(!empty($members)){
						foreach($members as $member){
							if(($member['user_id'] == $_SESSION['user_id']) || ($member['online'] == 1) || ($member['anonymous'] == 1) || ($member['appearoffline'] == 1) || ($member['user_id'] == 14) || ($member['user_id'] == 23)){
								continue;
							} else {
									$timeoffline = time() - strtotime($member['timestamp']);
									if(($timeoffline > 259201) && ($timeoffline < 604800)){
										array_push($search_result_array, $member);
									}
								}
							}
						}
						break;
					case 'thirty':
						if(!empty($members)){
						foreach($members as $member){
							if(($member['user_id'] == $_SESSION['user_id']) || ($member['online'] == 1) || ($member['anonymous'] == 1) || ($member['appearoffline'] == 1) || ($member['user_id'] == 14) || ($member['user_id'] == 23)){
								continue;
							} else {
								$timeoffline = time() - strtotime($member['timestamp']);
								if(($timeoffline > 604801) && ($timeoffline < 2592000)){
									array_push($search_result_array, $member);
									}
								}
							}
						break;
					}
				}
		
				if($arbitrary == 1){
					include_once 'profile_search_display_result.php';
				} else {
					include_once 'profile_search_display_result_next.php';
				}
				break;
			case 'update_search_criteria':
				(isset($_POST['age_min'])) ? $age_min = $_POST['age_min'] : $age_min = null;
				(isset($_POST['age_max'])) ? $age_max = $_POST['age_max'] : $age_max = null;
				(isset($_POST['gender'])) ? $gender = $_POST['gender'] : $gender = null;
				if(isset($_POST['verified'])){
					$verified = 1;
				} else {
					$verified = 0;
				}
				insert_preference($_SESSION['user_id'], $age_min, $age_max, $verified, $gender);
				include_once 'vardump.php';
				break;
			case 'update_contact_info':
				(isset($_POST['name'])) ? $name = $_POST['name'] : $name = null;
				(isset($_POST['lastname'])) ? $lastname = $_POST['lastname'] : $lastname = null;
				(isset($_POST['age'])) ? $_SESSION['age'] = $_POST['age'] : $_SESSION['age'] = null;
				(isset($_POST['country'])) ? $country = $_POST['country'] : $country = null;
				(isset($_POST['city'])) ? $city = $_POST['city'] : $city = null;
				(isset($_POST['gender'])) ? $_SESSION['gender'] = $_POST['gender'] : $_SESSION['gender'] = null;
				set_profile($_SESSION['user_id'], $name, $lastname, $_SESSION['age'], $country, $city, $_SESSION['gender']);
				break;
			case 'deleteaccount':
				delete_member($_SESSION['user_id']);
				session_destroy();
				header('location:index.php');
				exit();
				break;
					
					
					
					
			case 'art':
				$_SESSION['subcategory'] = false;
				if(isset($_POST['next'])){
					$_SESSION['next_image_counter']++;
					if($_SESSION['next_image_counter'] == $_SESSION['image_count']){
						shuffle($_SESSION['filepaths']);
						$_SESSION['next_image_counter'] = 0;
					}
				} else if (isset($_POST['prev'])){
					$_SESSION['next_image_counter']--;
				} else {
					$filepaths = get_toplists('art');
					$_SESSION['filepaths'] = $filepaths[0];
					shuffle($_SESSION['filepaths']);
					$_SESSION['image_count'] = count($_SESSION['filepaths']);
					$_SESSION['next_image_counter'] = 0;
					$_SESSION['toplist2'] = $filepaths[2];
					$_SESSION['toplist3'] = $filepaths[3];
					$_SESSION['toplist4'] = $filepaths[4];
					$_SESSION['toplist5'] = $filepaths[5];
					$_SESSION['toplist6'] = $filepaths[6];
					$_SESSION['image_infos'] = array();
					$_SESSION['image_comments'] = array();
					$_SESSION['image_favourite'] = array();
					$_SESSION['count_comments'] = array();
					
				}
				$random_image = $_SESSION['filepaths'][$_SESSION['next_image_counter']];
				if(isset($_POST['prev'])){
					$image_info = $_SESSION['image_infos'][$_SESSION['next_image_counter']];
					$favourite = $_SESSION['image_favourite'][$_SESSION['next_image_counter']];
					$imagecomments = $_SESSION['image_comments'][$_SESSION['next_image_counter']];
					$count_comments = $_SESSION['count_comments'][$_SESSION['next_image_counter']];
				} else {
					$filename = basename($random_image);
					$image_info = check_file_filename($filename);
					$favourite = check_favourite_status($_SESSION['user_id'], $image_info['image_id']);
					$imagecomments = get_imagecomments($image_info['image_id'], $_SESSION['user_id']);
					$count_comments = count_imagecomments($image_info['image_id']); /*Counting all comments since need for pagination*/
					array_push($_SESSION['image_infos'], $image_info);
					array_push($_SESSION['image_comments'], $imagecomments);
					array_push($_SESSION['image_favourite'], $favourite);
					array_push($_SESSION['count_comments'], $count_comments);
					if($_SESSION['user_id'] != $image_info['user_id']){
						increment_bandwidth_views($image_info['image_id'], $image_info['size'], $image_info['bandwidth']);
					}
				}
				if((isset($_POST['next'])) || (isset($_POST['prev']))){
					include_once 'voteview_nextimg.php';
					break;
				} else {
					$_SESSION['current_view'] = 0;
					$profile_messages = false;
					$subcategorylinks = glob('assets/imgsource/buttons/art2/*');
					$new_messages = check_new_messages($_SESSION['user_id']);
					$new_friend = check_new_friends($_SESSION['user_id']);
					include_once 'voteview.php';
					break;
				}
			case 'artsub':
				$_SESSION['subcategory'] = true;
				$subcategory = $_POST['subcategory'];
				if(isset($_POST['next'])){
					$_SESSION['next_image_counter']++;
					if($_SESSION['next_image_counter'] == $_SESSION['image_count']){
						shuffle($_SESSION['filepaths']);
						$_SESSION['next_image_counter'] = 0;
					}
				} else if (isset($_POST['prev'])){
					$_SESSION['next_image_counter']--;
				} else {
					$filepaths = get_toplists_subcategory('art', $subcategory);
					$_SESSION['filepaths'] = $filepaths[0];
					shuffle($_SESSION['filepaths']);
					$_SESSION['image_count'] = count($_SESSION['filepaths']) - 1;
					$_SESSION['next_image_counter'] = 0;
					$_SESSION['toplist2'] = $filepaths[2];
					$_SESSION['toplist3'] = $filepaths[3];
					$_SESSION['toplist4'] = $filepaths[4];
					$_SESSION['toplist5'] = $filepaths[5];
					$_SESSION['toplist6'] = $filepaths[6];
					$_SESSION['image_infos'] = array();
					$_SESSION['image_comments'] = array();
					$_SESSION['image_favourite'] = array();
					$_SESSION['count_comments'] = array();
				}
				$random_image = $_SESSION['filepaths'][$_SESSION['next_image_counter']];
				if(isset($_POST['prev'])){
					$image_info = $_SESSION['image_infos'][$_SESSION['next_image_counter']];
					$favourite = $_SESSION['image_favourite'][$_SESSION['next_image_counter']];
					$imagecomments = $_SESSION['image_comments'][$_SESSION['next_image_counter']];
					$count_comments = $_SESSION['count_comments'][$_SESSION['next_image_counter']];
				} else {
					$filename = basename($random_image);
					$image_info = check_file_filename($filename);
					$favourite = check_favourite_status($_SESSION['user_id'], $image_info['image_id']);
					$imagecomments = get_imagecomments($image_info['image_id'], $_SESSION['user_id'], $_SESSION['user_id']);
					$count_comments = count_imagecomments($image_info['image_id']); /*Counting all comments since need for pagination*/
					array_push($_SESSION['image_infos'], $image_info);
					array_push($_SESSION['image_comments'], $imagecomments);
					array_push($_SESSION['image_favourite'], $favourite);
					array_push($_SESSION['count_comments'], $count_comments);
					if($_SESSION['user_id'] != $image_info['user_id']){
						increment_bandwidth_views($image_info['image_id'], $image_info['size'], $image_info['bandwidth']);
					}
				}
				if((isset($_POST['next'])) || (isset($_POST['prev']))){
					include_once 'voteview_nextimg.php';
					break;
				} else {
					$new_messages = check_new_messages($_SESSION['user_id']);
					$new_friend = check_new_friends($_SESSION['user_id']);
					include_once 'voteview_subcategory.php';
					break;
				}
			case 'awww':
				$_SESSION['subcategory'] = false;
				if(isset($_POST['next'])){
					$_SESSION['next_image_counter']++;
					if($_SESSION['next_image_counter'] == $_SESSION['image_count']){
						shuffle($_SESSION['filepaths']);
						$_SESSION['next_image_counter'] = 0;
					}
				} else if (isset($_POST['prev'])){
					$_SESSION['next_image_counter']--; 
				} else {
					$filepaths = get_toplists('awww');
					$_SESSION['filepaths'] = $filepaths[0];
					shuffle($_SESSION['filepaths']);
					$_SESSION['image_count'] = count($_SESSION['filepaths']);
					$_SESSION['next_image_counter'] = 0;
					$_SESSION['toplist2'] = $filepaths[2];
					$_SESSION['toplist3'] = $filepaths[3];
					$_SESSION['toplist4'] = $filepaths[4];
					$_SESSION['toplist5'] = $filepaths[5];
					$_SESSION['toplist6'] = $filepaths[6];
					$_SESSION['image_infos'] = array();
					$_SESSION['image_comments'] = array();
					$_SESSION['image_favourite'] = array();
					$_SESSION['count_comments'] = array();
				}
				$random_image = $_SESSION['filepaths'][$_SESSION['next_image_counter']];
				if(isset($_POST['prev'])){
					$image_info = $_SESSION['image_infos'][$_SESSION['next_image_counter']];
					$favourite = $_SESSION['image_favourite'][$_SESSION['next_image_counter']];
					$imagecomments = $_SESSION['image_comments'][$_SESSION['next_image_counter']];
					$count_comments = $_SESSION['count_comments'][$_SESSION['next_image_counter']];
				} else {
					$filename = basename($random_image);
					$image_info = check_file_filename($filename);
					$favourite = check_favourite_status($_SESSION['user_id'], $image_info['image_id']);
					$imagecomments = get_imagecomments($image_info['image_id'], $_SESSION['user_id']);
					$count_comments = count_imagecomments($image_info['image_id']); /*Counting all comments since need for pagination*/
					array_push($_SESSION['image_infos'], $image_info);
					array_push($_SESSION['image_comments'], $imagecomments);
					array_push($_SESSION['image_favourite'], $favourite);
					array_push($_SESSION['count_comments'], $count_comments);
					if($_SESSION['user_id'] != $image_info['user_id']){
						increment_bandwidth_views($image_info['image_id'], $image_info['size'], $image_info['bandwidth']);
					}
				}
				if((isset($_POST['next'])) || (isset($_POST['prev']))){
					include_once 'voteview_nextimg.php';
					break;
				} else {
					$_SESSION['current_view'] = 0;
					$profile_messages = false;
					$new_messages = check_new_messages($_SESSION['user_id']);
					$new_friend = check_new_friends($_SESSION['user_id']);
					include_once 'voteview.php';
					break;
				}
			case 'boy':
				$_SESSION['subcategory'] = false;
				if(isset($_POST['next'])){
					$_SESSION['next_image_counter']++;
					if($_SESSION['next_image_counter'] == $_SESSION['image_count']){
						shuffle($_SESSION['filepaths']);
						$_SESSION['next_image_counter'] = 0;
					}
				} else if(isset($_POST['prev'])){ 
					$_SESSION['next_image_counter']--;
				} else {
					$filepaths = get_toplists('boy');
					$_SESSION['filepaths'] = $filepaths[0];
					shuffle($_SESSION['filepaths']);
					$_SESSION['image_count'] = count($_SESSION['filepaths']);
					$_SESSION['next_image_counter'] = 0;
					$_SESSION['toplist2'] = $filepaths[2];
					$_SESSION['toplist3'] = $filepaths[3];
					$_SESSION['toplist4'] = $filepaths[4];
					$_SESSION['toplist5'] = $filepaths[5];
					$_SESSION['toplist6'] = $filepaths[6];
					$_SESSION['image_infos'] = array();
					$_SESSION['image_comments'] = array();
					$_SESSION['image_favourite'] = array();
					$_SESSION['count_comments'] = array();
				}
				$random_image = $_SESSION['filepaths'][$_SESSION['next_image_counter']];
				if(isset($_POST['prev'])){
					$image_info = $_SESSION['image_infos'][$_SESSION['next_image_counter']];
					$favourite = $_SESSION['image_favourite'][$_SESSION['next_image_counter']];
					$imagecomments = $_SESSION['image_comments'][$_SESSION['next_image_counter']];
					$count_comments = $_SESSION['count_comments'][$_SESSION['next_image_counter']];
				} else {
					$filename = basename($random_image);
					$image_info = check_file_filename($filename);
					$favourite = check_favourite_status($_SESSION['user_id'], $image_info['image_id']);
					$imagecomments = get_imagecomments($image_info['image_id'], $_SESSION['user_id']);
					$count_comments = count_imagecomments($image_info['image_id']); /*Counting all comments since need for pagination*/
					array_push($_SESSION['image_infos'], $image_info);
					array_push($_SESSION['image_comments'], $imagecomments);
					array_push($_SESSION['image_favourite'], $favourite);
					array_push($_SESSION['count_comments'], $count_comments);
					if($_SESSION['user_id'] != $image_info['user_id']){
						increment_bandwidth_views($image_info['image_id'], $image_info['size'], $image_info['bandwidth']);
					}
				}
				if((isset($_POST['next'])) || (isset($_POST['prev']))){
					include_once 'voteview_nextimg.php';
					break;
				} else {
					$_SESSION['current_view'] = 0;
					$profile_messages = false;
					$new_messages = check_new_messages($_SESSION['user_id']);
					$new_friend = check_new_friends($_SESSION['user_id']);
					include_once 'voteview.php';
					break;
				}
			case 'girl':
				$_SESSION['subcategory'] = false;
				if(isset($_POST['next'])){
					$_SESSION['next_image_counter']++;
					if($_SESSION['next_image_counter'] == $_SESSION['image_count']){
						shuffle($_SESSION['filepaths']);
						$_SESSION['next_image_counter'] = 0;
					}
				} else if(isset($_POST['prev'])){
					 $_SESSION['next_image_counter']--;
				} else {
					$filepaths = get_toplists('girl');
					$_SESSION['filepaths'] = $filepaths[0];
					shuffle($_SESSION['filepaths']);
					$_SESSION['image_count'] = count($_SESSION['filepaths']);
					$_SESSION['next_image_counter'] = 0;
					$_SESSION['toplist2'] = $filepaths[2];
					$_SESSION['toplist3'] = $filepaths[3];
					$_SESSION['toplist4'] = $filepaths[4];
					$_SESSION['toplist5'] = $filepaths[5];
					$_SESSION['toplist6'] = $filepaths[6];
					$_SESSION['image_infos'] = array();
					$_SESSION['image_comments'] = array();
					$_SESSION['image_favourite'] = array();
					$_SESSION['count_comments'] = array();
				}
				$random_image = $_SESSION['filepaths'][$_SESSION['next_image_counter']];
				if(isset($_POST['prev'])){
					$image_info = $_SESSION['image_infos'][$_SESSION['next_image_counter']];
					$favourite = $_SESSION['image_favourite'][$_SESSION['next_image_counter']];
					$imagecomments = $_SESSION['image_comments'][$_SESSION['next_image_counter']];
					$count_comments = $_SESSION['count_comments'][$_SESSION['next_image_counter']];
				} else {
					$filename = basename($random_image);
					$image_info = check_file_filename($filename);
					$favourite = check_favourite_status($_SESSION['user_id'], $image_info['image_id']);
					$imagecomments = get_imagecomments($image_info['image_id'], $_SESSION['user_id']);
					$count_comments = count_imagecomments($image_info['image_id']); /*Counting all comments since need for pagination*/
					array_push($_SESSION['image_infos'], $image_info);
					array_push($_SESSION['image_comments'], $imagecomments);
					array_push($_SESSION['image_favourite'], $favourite);
					array_push($_SESSION['count_comments'], $count_comments);
					if($_SESSION['user_id'] != $image_info['user_id']){
						increment_bandwidth_views($image_info['image_id'], $image_info['size'], $image_info['bandwidth']);
					}
				}
				if((isset($_POST['next'])) || (isset($_POST['prev']))){
					include_once 'voteview_nextimg.php';
					break;
				} else {
					$_SESSION['current_view'] = 0;
					$profile_messages = false;
					$new_messages = check_new_messages($_SESSION['user_id']);
					$new_friend = check_new_friends($_SESSION['user_id']);
					include_once 'voteview.php';
					break;
				}
			case 'gif':
				$_SESSION['subcategory'] = false;
				if(isset($_POST['next'])){
					$_SESSION['next_image_counter']++;
					if($_SESSION['next_image_counter'] == $_SESSION['image_count']){
						shuffle($_SESSION['filepaths']);
						$_SESSION['next_image_counter'] = 0;
					}
				} else if(isset($_POST['prev'])){
					 $_SESSION['next_image_counter']--;
				} else {
					$filepaths = get_toplists('gif');
					$_SESSION['filepaths'] = $filepaths[0];
					shuffle($_SESSION['filepaths']);
					$_SESSION['image_count'] = count($_SESSION['filepaths']);
					$_SESSION['next_image_counter'] = 0;
					$_SESSION['toplist2'] = $filepaths[2];
					$_SESSION['toplist3'] = $filepaths[3];
					$_SESSION['toplist4'] = $filepaths[4];
					$_SESSION['toplist5'] = $filepaths[5];
					$_SESSION['toplist6'] = $filepaths[6];
					$_SESSION['image_infos'] = array();
					$_SESSION['image_comments'] = array();
					$_SESSION['image_favourite'] = array();
					$_SESSION['count_comments'] = array();
				}
				$random_image = $_SESSION['filepaths'][$_SESSION['next_image_counter']];
				if(isset($_POST['prev'])){
					$image_info = $_SESSION['image_infos'][$_SESSION['next_image_counter']];
					$favourite = $_SESSION['image_favourite'][$_SESSION['next_image_counter']];
					$imagecomments = $_SESSION['image_comments'][$_SESSION['next_image_counter']];
					$count_comments = $_SESSION['count_comments'][$_SESSION['next_image_counter']];
				} else {
					$filename = basename($random_image);
					$image_info = check_file_filename($filename);
					$favourite = check_favourite_status($_SESSION['user_id'], $image_info['image_id']);
					$imagecomments = get_imagecomments($image_info['image_id'], $_SESSION['user_id']);
					$count_comments = count_imagecomments($image_info['image_id']); /*Counting all comments since need for pagination*/
					array_push($_SESSION['image_infos'], $image_info);
					array_push($_SESSION['image_comments'], $imagecomments);
					array_push($_SESSION['image_favourite'], $favourite);
					array_push($_SESSION['count_comments'], $count_comments);
					if($_SESSION['user_id'] != $image_info['user_id']){
						increment_bandwidth_views($image_info['image_id'], $image_info['size'], $image_info['bandwidth']);
					}
				}
				if((isset($_POST['next'])) || (isset($_POST['prev']))){
					include_once 'voteview_nextimg.php';
					break;
				} else {
					$_SESSION['current_view'] = 0;
					$profile_messages = false;
					$new_messages = check_new_messages($_SESSION['user_id']);
					$new_friend = check_new_friends($_SESSION['user_id']);
					include_once 'voteview.php';
					break;
				}
			case 'meme':
				$_SESSION['subcategory'] = false;
				if(isset($_POST['next'])){
					$_SESSION['next_image_counter']++;
					if($_SESSION['next_image_counter'] == $_SESSION['image_count']){
						shuffle($_SESSION['filepaths']);
						$_SESSION['next_image_counter'] = 0;
					}
				} else if(isset($_POST['prev'])){ 
					$_SESSION['next_image_counter']--; 
				} else {
					$filepaths = get_toplists('meme');
					$_SESSION['filepaths'] = $filepaths[0];
					shuffle($_SESSION['filepaths']);
					$_SESSION['image_count'] = count($_SESSION['filepaths']);
					$_SESSION['next_image_counter'] = 0;
					$_SESSION['toplist2'] = $filepaths[2];
					$_SESSION['toplist3'] = $filepaths[3];
					$_SESSION['toplist4'] = $filepaths[4];
					$_SESSION['toplist5'] = $filepaths[5];
					$_SESSION['toplist6'] = $filepaths[6];
					$_SESSION['image_infos'] = array();
					$_SESSION['image_comments'] = array();
					$_SESSION['image_favourite'] = array();
					$_SESSION['count_comments'] = array();
				}
				$random_image = $_SESSION['filepaths'][$_SESSION['next_image_counter']];
				if(isset($_POST['prev'])){
					$image_info = $_SESSION['image_infos'][$_SESSION['next_image_counter']];
					$favourite = $_SESSION['image_favourite'][$_SESSION['next_image_counter']];
					$imagecomments = $_SESSION['image_comments'][$_SESSION['next_image_counter']];
					$count_comments = $_SESSION['count_comments'][$_SESSION['next_image_counter']];
				} else {
					$filename = basename($random_image);
					$image_info = check_file_filename($filename);
					$favourite = check_favourite_status($_SESSION['user_id'], $image_info['image_id']);
					$imagecomments = get_imagecomments($image_info['image_id'], $_SESSION['user_id']);
					$count_comments = count_imagecomments($image_info['image_id']); /*Counting all comments since need for pagination*/
					array_push($_SESSION['image_infos'], $image_info);
					array_push($_SESSION['image_comments'], $imagecomments);
					array_push($_SESSION['image_favourite'], $favourite);
					array_push($_SESSION['count_comments'], $count_comments);
					if($_SESSION['user_id'] != $image_info['user_id']){
						increment_bandwidth_views($image_info['image_id'], $image_info['size'], $image_info['bandwidth']);
					}
				}
				if((isset($_POST['next'])) || (isset($_POST['prev']))){
					include_once 'voteview_nextimg.php';
					break;
				} else {
					$_SESSION['current_view'] = 0;
					$profile_messages = false;
					$subcategorylinks = glob('assets/imgsource/buttons/meme3/*');
					$new_messages = check_new_messages($_SESSION['user_id']);
					$new_friend = check_new_friends($_SESSION['user_id']);
					include_once 'voteview.php';
					break;
				}
			case 'memesub':
				$_SESSION['subcategory'] = true;
				$subcategory = $_POST['subcategory'];
				if(isset($_POST['next'])){
					$_SESSION['next_image_counter']++;
					if($_SESSION['next_image_counter'] == $_SESSION['image_count']){
						shuffle($_SESSION['filepaths']);
						$_SESSION['next_image_counter'] = 0;
					}
				} else if(isset($_POST['prev'])){ 
					$_SESSION['next_image_counter']--;  
				} else {
					$filepaths = get_toplists_subcategory('meme', $subcategory);
					$_SESSION['filepaths'] = $filepaths[0];
					shuffle($_SESSION['filepaths']);
					$_SESSION['image_count'] = count($_SESSION['filepaths']);
					$_SESSION['next_image_counter'] = 0;
					$_SESSION['toplist2'] = $filepaths[2];
					$_SESSION['toplist3'] = $filepaths[3];
					$_SESSION['toplist4'] = $filepaths[4];
					$_SESSION['toplist5'] = $filepaths[5];
					$_SESSION['toplist6'] = $filepaths[6];
					$_SESSION['image_infos'] = array();
					$_SESSION['image_comments'] = array();
					$_SESSION['image_favourite'] = array();
					$_SESSION['count_comments'] = array();
				}
				$random_image = $_SESSION['filepaths'][$_SESSION['next_image_counter']];
				if(isset($_POST['prev'])){
					$image_info = $_SESSION['image_infos'][$_SESSION['next_image_counter']];
					$favourite = $_SESSION['image_favourite'][$_SESSION['next_image_counter']];
					$imagecomments = $_SESSION['image_comments'][$_SESSION['next_image_counter']];
					$count_comments = $_SESSION['count_comments'][$_SESSION['next_image_counter']];
				} else {
					$filename = basename($random_image);
					$image_info = check_file_filename($filename);
					$favourite = check_favourite_status($_SESSION['user_id'], $image_info['image_id']);
					$imagecomments = get_imagecomments($image_info['image_id'], $_SESSION['user_id']);
					$count_comments = count_imagecomments($image_info['image_id']); /*Counting all comments since need for pagination*/
					array_push($_SESSION['image_infos'], $image_info);
					array_push($_SESSION['image_comments'], $imagecomments);
					array_push($_SESSION['image_favourite'], $favourite);
					array_push($_SESSION['count_comments'], $count_comments);
					if($_SESSION['user_id'] != $image_info['user_id']){
						increment_bandwidth_views($image_info['image_id'], $image_info['size'], $image_info['bandwidth']);
					}
				}
				if((isset($_POST['next'])) || (isset($_POST['prev']))){
					include_once 'voteview_nextimg.php';
					break;
				} else {
					include_once 'voteview_subcategory.php';
					break;
				}
			case 'funny':
				$_SESSION['subcategory'] = false;
				if(isset($_POST['next'])){
					$_SESSION['next_image_counter']++;
					if($_SESSION['next_image_counter'] == $_SESSION['image_count']){
						shuffle($_SESSION['filepaths']);
						$_SESSION['next_image_counter'] = 0;
					}
				} else if(isset($_POST['prev'])){ 
					$_SESSION['next_image_counter']--;
				} else {
					$_SESSION['current_view'] = 0;
					$filepaths = get_toplists('funny');
					$_SESSION['filepaths'] = $filepaths[0];
					shuffle($_SESSION['filepaths']);
					$_SESSION['image_count'] = count($_SESSION['filepaths']);
					$_SESSION['next_image_counter'] = 0;
					$_SESSION['toplist2'] = $filepaths[2];
					$_SESSION['toplist3'] = $filepaths[3];
					$_SESSION['toplist4'] = $filepaths[4];
					$_SESSION['toplist5'] = $filepaths[5];
					$_SESSION['toplist6'] = $filepaths[6];
					$_SESSION['image_infos'] = array();
					$_SESSION['image_comments'] = array();
					$_SESSION['image_favourite'] = array();
					$_SESSION['count_comments'] = array();
				}
				$random_image = $_SESSION['filepaths'][$_SESSION['next_image_counter']];
				if(isset($_POST['prev'])){
					$image_info = $_SESSION['image_infos'][$_SESSION['next_image_counter']];
					$favourite = $_SESSION['image_favourite'][$_SESSION['next_image_counter']];
					$imagecomments = $_SESSION['image_comments'][$_SESSION['next_image_counter']];
					$count_comments = $_SESSION['count_comments'][$_SESSION['next_image_counter']];
				} else {
					$filename = basename($random_image);
					$image_info = check_file_filename($filename);
					$favourite = check_favourite_status($_SESSION['user_id'], $image_info['image_id']);
					$imagecomments = get_imagecomments($image_info['image_id'], $_SESSION['user_id']);
					$count_comments = count_imagecomments($image_info['image_id']); /*Counting all comments since need for pagination*/
					array_push($_SESSION['image_infos'], $image_info);
					array_push($_SESSION['image_comments'], $imagecomments);
					array_push($_SESSION['image_favourite'], $favourite);
					array_push($_SESSION['count_comments'], $count_comments);
					if($_SESSION['user_id'] != $image_info['user_id']){
						increment_bandwidth_views($image_info['image_id'], $image_info['size'], $image_info['bandwidth']);
					}
				}
				if((isset($_POST['next'])) || (isset($_POST['prev']))){
					include_once 'voteview_nextimg.php';
					break;
				} else {
					$_SESSION['current_view'] = 0;
					$profile_messages = false;
					$new_messages = check_new_messages($_SESSION['user_id']);
					$new_friend = check_new_friends($_SESSION['user_id']);
					include_once 'voteview.php';
					break;
				}
			case 'gaming':
				$_SESSION['subcategory'] = false;
				if(isset($_POST['next'])){
					$_SESSION['next_image_counter']++;
					if($_SESSION['next_image_counter'] == $_SESSION['image_count']){
						shuffle($_SESSION['filepaths']);
						$_SESSION['next_image_counter'] = 0;
					}
				} else if(isset($_POST['prev'])){ 
					$_SESSION['next_image_counter']--; 
				} else {
					$filepaths = get_toplists('gaming');
					$_SESSION['filepaths'] = $filepaths[0];
					shuffle($_SESSION['filepaths']);
					$_SESSION['image_count'] = count($_SESSION['filepaths']);
					$_SESSION['next_image_counter'] = 0;
					$_SESSION['toplist2'] = $filepaths[2];
					$_SESSION['toplist3'] = $filepaths[3];
					$_SESSION['toplist4'] = $filepaths[4];
					$_SESSION['toplist5'] = $filepaths[5];
					$_SESSION['toplist6'] = $filepaths[6];
					$_SESSION['image_infos'] = array();
					$_SESSION['image_comments'] = array();
					$_SESSION['image_favourite'] = array();
					$_SESSION['count_comments'] = array();
				}
				$random_image = $_SESSION['filepaths'][$_SESSION['next_image_counter']];
				if(isset($_POST['prev'])){
					$image_info = $_SESSION['image_infos'][$_SESSION['next_image_counter']];
					$favourite = $_SESSION['image_favourite'][$_SESSION['next_image_counter']];
					$imagecomments = $_SESSION['image_comments'][$_SESSION['next_image_counter']];
					$count_comments = $_SESSION['count_comments'][$_SESSION['next_image_counter']];
				} else {
					$filename = basename($random_image);
					$image_info = check_file_filename($filename);
					$favourite = check_favourite_status($_SESSION['user_id'], $image_info['image_id']);
					$imagecomments = get_imagecomments($image_info['image_id'], $_SESSION['user_id']);
					$count_comments = count_imagecomments($image_info['image_id']); /*Counting all comments since need for pagination*/
					array_push($_SESSION['image_infos'], $image_info);
					array_push($_SESSION['image_comments'], $imagecomments);
					array_push($_SESSION['image_favourite'], $favourite);
					array_push($_SESSION['count_comments'], $count_comments);
					if($_SESSION['user_id'] != $image_info['user_id']){
						increment_bandwidth_views($image_info['image_id'], $image_info['size'], $image_info['bandwidth']);
					}
				}
				if((isset($_POST['next'])) || (isset($_POST['prev']))){
					include_once 'voteview_nextimg.php';
					break;
				} else {
					$_SESSION['current_view'] = 0;
					$profile_messages = false;
					$new_messages = check_new_messages($_SESSION['user_id']);
					$new_friend = check_new_friends($_SESSION['user_id']);
					include_once 'voteview.php';
					break;
				}
			case 'wtf':
				$_SESSION['subcategory'] = false;
				if(isset($_POST['next'])){
					$_SESSION['next_image_counter']++;
					if($_SESSION['next_image_counter'] == $_SESSION['image_count']){
						shuffle($_SESSION['filepaths']);
						$_SESSION['next_image_counter'] = 0;
					}
				} else if(isset($_POST['prev'])){ 
					$_SESSION['next_image_counter']--;  
				} else {
					$filepaths = get_toplists('wtf');
					$_SESSION['filepaths'] = $filepaths[0];
					shuffle($_SESSION['filepaths']);
					$_SESSION['image_count'] = count($_SESSION['filepaths']);
					$_SESSION['next_image_counter'] = 0;
					$_SESSION['toplist2'] = $filepaths[2];
					$_SESSION['toplist3'] = $filepaths[3];
					$_SESSION['toplist4'] = $filepaths[4];
					$_SESSION['toplist5'] = $filepaths[5];
					$_SESSION['toplist6'] = $filepaths[6];
					$_SESSION['image_infos'] = array();
					$_SESSION['image_comments'] = array();
					$_SESSION['image_favourite'] = array();
					$_SESSION['count_comments'] = array();
				}
				$random_image = $_SESSION['filepaths'][$_SESSION['next_image_counter']];
				if(isset($_POST['prev'])){
					$image_info = $_SESSION['image_infos'][$_SESSION['next_image_counter']];
					$favourite = $_SESSION['image_favourite'][$_SESSION['next_image_counter']];
					$imagecomments = $_SESSION['image_comments'][$_SESSION['next_image_counter']];
					$count_comments = $_SESSION['count_comments'][$_SESSION['next_image_counter']];
				} else {
					$filename = basename($random_image);
					$image_info = check_file_filename($filename);
					$favourite = check_favourite_status($_SESSION['user_id'], $image_info['image_id']);
					$imagecomments = get_imagecomments($image_info['image_id'], $_SESSION['user_id']);
					$count_comments = count_imagecomments($image_info['image_id']); /*Counting all comments since need for pagination*/
					array_push($_SESSION['image_infos'], $image_info);
					array_push($_SESSION['image_comments'], $imagecomments);
					array_push($_SESSION['image_favourite'], $favourite);
					array_push($_SESSION['count_comments'], $count_comments);
					if($_SESSION['user_id'] != $image_info['user_id']){
						increment_bandwidth_views($image_info['image_id'], $image_info['size'], $image_info['bandwidth']);
					}
				}
				if((isset($_POST['next'])) || (isset($_POST['prev']))){
					include_once 'voteview_nextimg.php';
					break;
				} else {
					$_SESSION['current_view'] = 0;
					$profile_messages = false;
					$new_messages = check_new_messages($_SESSION['user_id']);
					$new_friend = check_new_friends($_SESSION['user_id']);
					include_once 'voteview.php';
					break;
				}
			case 'other':
				$_SESSION['subcategory'] = false;
				if(isset($_POST['next'])){
					$_SESSION['next_image_counter']++;
					if($_SESSION['next_image_counter'] == $_SESSION['image_count']){
						shuffle($_SESSION['filepaths']);
						$_SESSION['next_image_counter'] = 0;
					}
				} else if(isset($_POST['prev'])){ 
					$_SESSION['next_image_counter']--;   
				} else {
					$filepaths = get_toplists('other');
					$_SESSION['filepaths'] = $filepaths[0];
					shuffle($_SESSION['filepaths']);
					$_SESSION['image_count'] = count($_SESSION['filepaths']);
					$_SESSION['next_image_counter'] = 0;
					$_SESSION['toplist2'] = $filepaths[2];
					$_SESSION['toplist3'] = $filepaths[3];
					$_SESSION['toplist4'] = $filepaths[4];
					$_SESSION['toplist5'] = $filepaths[5];
					$_SESSION['toplist6'] = $filepaths[6];
				}
				$random_image = $_SESSION['filepaths'][$_SESSION['next_image_counter']];
				if(isset($_POST['prev'])){
					$image_info = $_SESSION['image_infos'][$_SESSION['next_image_counter']];
					$favourite = $_SESSION['image_favourite'][$_SESSION['next_image_counter']];
					$imagecomments = $_SESSION['image_comments'][$_SESSION['next_image_counter']];
					$count_comments = $_SESSION['count_comments'][$_SESSION['next_image_counter']];
				} else {
					$filename = basename($random_image);
					$image_info = check_file_filename($filename);
					$favourite = check_favourite_status($_SESSION['user_id'], $image_info['image_id']);
					$imagecomments = get_imagecomments($image_info['image_id'], $_SESSION['user_id']);
					$count_comments = count_imagecomments($image_info['image_id']); /*Counting all comments since need for pagination*/
					array_push($_SESSION['image_infos'], $image_info);
					array_push($_SESSION['image_comments'], $imagecomments);
					array_push($_SESSION['image_favourite'], $favourite);
					array_push($_SESSION['count_comments'], $count_comments);
					if($_SESSION['user_id'] != $image_info['user_id']){
						increment_bandwidth_views($image_info['image_id'], $image_info['size'], $image_info['bandwidth']);
					}
				}
				if((isset($_POST['next'])) || (isset($_POST['prev']))){
					include_once 'voteview_nextimg.php';
					break;
				} else {
					$_SESSION['current_view'] = 0;
					$profile_messages = false;
					$new_messages = check_new_messages($_SESSION['user_id']);
					$new_friend = check_new_friends($_SESSION['user_id']);
					include_once 'voteview.php';
					break;
				}
			case 'goto':
				$_SESSION['subcategory'] = false;
				if(isset($_POST['filepath'])){
					$filename = basename($_POST['filepath']);
					$image_info = check_file_filename($filename);
				} else {
					(isset($_POST['image_id'])) ? $image_id = $_POST['image_id'] : $image_id = $_GET['image_id'];
					$image_info = check_file($image_id);
				}
				(isset($_POST['arbitrary'])) ? $modal = true : $modal = false;
				$random_image = 'member/'.$image_info['user_id'].'/files/'.$image_info['filename'];
				$favourite = check_favourite_status($_SESSION['user_id'], $image_info['image_id']);
				$imagecomments = get_imagecomments($image_info['image_id'], $_SESSION['user_id']);
				$count_comments = count_imagecomments($image_info['image_id']);
				if($image_info['category'] == "meme"){
					$subcategorylinks = glob('assets/imgsource/buttons/meme3/*');
				} else if($image_info['category'] == "art"){
					$subcategorylinks = glob('assets/imgsource/buttons/art2/*');
				}
				if(isset($_POST['next'])){
					include_once 'voteview_nextimg.php';
					break;
				} else if($modal){
					include_once 'profile_gallery_rated_modal.php';
					break;
				} else {
					$_SESSION['current_view'] = 0;
					$profile_messages = false;
					$new_messages = check_new_messages($_SESSION['user_id']);
					$new_friend = check_new_friends($_SESSION['user_id']);
					$filepaths = get_toplists($image_info['category']);
					$_SESSION['filepaths'] = $filepaths[0];
					shuffle($_SESSION['filepaths']);
					$_SESSION['image_count'] = count($_SESSION['filepaths']);
					$_SESSION['next_image_counter'] = 0;
					$_SESSION['toplist2'] = $filepaths[2];
					$_SESSION['toplist3'] = $filepaths[3];
					$_SESSION['toplist4'] = $filepaths[4];
					$_SESSION['toplist5'] = $filepaths[5];
					$_SESSION['toplist6'] = $filepaths[6];
					include_once 'voteview.php';
					break;
				}
			case 'goto-sub':
				$_SESSION['subcategory'] = true;
				if(isset($_POST['filepath'])){
					$filename = basename($_POST['filepath']);
					$image_info = check_file_filename($filename);
				} else {
					(isset($_POST['image_id'])) ? $image_id = $_POST['image_id'] : $image_id = $_GET['image_id'];
					$image_info = check_file($image_id);
				}
				$count_comments = count_imagecomments($image_info['image_id']);
				$random_image = 'member/'.$image_info['user_id'].'/files/'.$image_info['filename'];
				$favourite = check_favourite_status($_SESSION['user_id'], $image_info['image_id']);
				$imagecomments = get_imagecomments($image_info['image_id'], $_SESSION['user_id']);
				$filepaths = get_toplists_subcategory($image_info['category'], $image_info['subcategory']);
				if(isset($_POST['next'])){
					include_once 'voteview_nextimg.php';
					break;
				} else {
					$new_messages = check_new_messages($_SESSION['user_id']);
					$new_friend = check_new_friends($_SESSION['user_id']);
					include_once 'voteview_subcategory.php';
					break;
				}
			case 'vote':
				$votes = $_POST['votes'];
				$totalscore = $_POST['totalscore'];
				$votevalue = $_POST['votevalue'];
				$voted = check_has_voted($_POST['image_id'], $_SESSION['user_id'], $_SESSION['ip']);
				if(!$voted){
					insert_has_voted($_POST['image_id'], $_SESSION['user_id'], $_POST['votevalue'], $_SESSION['ip']);
					update_image_db($_POST['image_id'], $_POST['votevalue'], $_POST['votes'], $_POST['totalscore'], $_POST['userx_id']);
				}
				break;
			case 'change_toplist_comments':
				$filepaths = get_toplists_sort_comments($_POST['category'], $_POST['subcategory']);
				$_SESSION['toplist_comment1'] = $filepaths[1];
				$_SESSION['toplist_comment2'] = $filepaths[2];
				$_SESSION['toplist_comment3'] = $filepaths[3];
				$_SESSION['toplist_comment4'] = $filepaths[4];
				$_SESSION['toplist_comment5'] = $filepaths[5];
				include_once 'voteview_most_commented.php';
				break;
			case 'change_toplist_favourite':
				$filepaths = get_toplists_sort_favourite($_POST['category'], $_POST['subcategory']);
				$_SESSION['toplist_favourite1'] = $filepaths[1];
				$_SESSION['toplist_favourite2'] = $filepaths[2];
				$_SESSION['toplist_favourite3'] = $filepaths[3];
				$_SESSION['toplist_favourite4'] = $filepaths[4];
				$_SESSION['toplist_favourite5'] = $filepaths[5];
				include_once 'voteview_top_favourites.php';
				break;
			case 'change_toplist_newest':
				$filepaths = get_toplists_sort_newest($_POST['category'], $_POST['subcategory']);
				$_SESSION['toplist_newest1'] = $filepaths[1];
				$_SESSION['toplist_newest2'] = $filepaths[2];
				$_SESSION['toplist_newest3'] = $filepaths[3];
				$_SESSION['toplist_newest4'] = $filepaths[4];
				$_SESSION['toplist_newest5'] = $filepaths[5];
				include_once 'voteview_top_newest.php';
				break;
			case 'get_toplist':
				if($_POST['sort_choice'] == 1){
					$toplist_nr = $_POST['toplist'];
					$toplist = $_SESSION['toplist'.$_POST['toplist']];
					$nailthumb = "average-nailthumbs".$_POST['toplist'];
				} else if($_POST['sort_choice'] == 2){
					$toplist_nr = $_POST['toplist'];
					$toplist = $_SESSION['toplist_comment'.$_POST['toplist']];
					$nailthumb = "comment-nailthumbs".$_POST['toplist'];
				} else if($_POST['sort_choice'] == 3){
					$toplist_nr = $_POST['toplist'];
					$toplist = $_SESSION['toplist_favourite'.$_POST['toplist']];
					$nailthumb = "favourite-nailthumbs".$_POST['toplist'];
				} else {
					$toplist_nr = $_POST['toplist'];
					$toplist = $_SESSION['toplist_newest'.$_POST['toplist']];
					$nailthumb = "newest-nailthumbs".$_POST['toplist'];
				}
				include_once 'voteview_toplist_template.php';
				break;
			case 'add_favimg':
				insert_favimg($_POST['image_id'], $_SESSION['user_id']);
				break;
			case 'like_img':
				$filename = $_POST['filename'];
				like_img($filename);
				break;
			case 'dislike_img':
				$filename = $_POST['filename'];
				dislike_img($filename);
				break;
			case 'addimgcomment':
				$imagecomment = true;
				$comment = $_POST['img_comment'];
				$comment_id = insert_image_comment($_POST['image_id'], htmlspecialchars($comment), $_SESSION['username'], $_SESSION['user_id']);
				include_once 'comment_template.php';
				break;
			case 'addcommentreply':
				$imagecomment = false;
				$comment = $_POST['imgcomment'];
				$comment_id = insert_comment_reply($_POST['image_id'], $_SESSION['username'], $_SESSION['user_id'], htmlspecialchars($comment), $_POST['commentid']);
				include_once 'comment_template.php';
				break;
			case 'nexttencomments':
				$offset = ($_POST['current_page'] - 1) * 15;
				$imagecomments = get_next_ten_comments($_POST['image_id'], $offset);
				include_once 'comment_next_ten.php';
				break;
			case 'getreplies':
				$firstreplies = true; /* ables you to use one php file */
				$commentid = $_POST['commentid'];
				$imagecomments = get_replies($commentid);
				$i = 0;
				include_once 'comment_reply_next_ten.php';
				break;
			case 'nexttenreplies':
				$firstreplies = false; /* ables you to use one php file */
				$currentpage = $_POST['commentid'];
				$parent_commentid = $_POST['commentid'];
				$offset = $currentpage * 10;
				$imagecomments = get_next_ten_replies($parent_commentid, $offset);
				$currentpage++;
				$i = 0;
				include_once 'comment_reply_next_ten.php';
				break;
			case 'reportcomment':
				$commentid = $_POST['commentid'];
				report_comment($commentid);
				break;
			case 'removecomment':
				(isset($_POST['parent_commentid'])) ? $parent_commentid = $_POST['parent_commentid'] : $parent_commentid = "";
				remove_comment($_POST['commentid'], $parent_commentid);
				break;
			case 'likecomment':
				like_comment($_POST['commentid'], $_POST['user_id'], $_SESSION['user_id']);
				break;
			case 'dislikecomment':
				dislike_comment($_POST['commentid'], $_SESSION['user_id']);
				break;
			case 'anonymous':
				anonymous($_SESSION['user_id']);
				break;
			case 'remove_anonymous':
				remove_anonymous($_SESSION['user_id']);
				break;
			case 'appearonline':
				appearonline($_SESSION['user_id']);
				break;
			case 'appearoffline':
				appearoffline($_SESSION['user_id']);
				break;
			case 'message_preference_all':
				message_preference_all($_SESSION['user_id']);
				break;
			case 'message_preference_friend':
				message_preference_friends($_SESSION['user_id']);
				break;
			case 'profile_visibility_public':
				profilevisibility_public($_SESSION['user_id']);
				break;
			case 'profile_visibility_friends':
				profilevisibility_friends($_SESSION['user_id']);
				break;
			case 'profile_visibility_private':
				profilevisibility_private($_SESSION['user_id']);
				break;
			case 'display_friends':
				display_friends($_POST['user_id'], $_POST['display']);
			case 'block_user':
				block_user($_SESSION['user_id'], $_POST['userx_id']);
				break;
			case 'block_friend':
				block_friend($_SESSION['user_id'], $_POST['userx_id']);
				break;
			case 'delete_image':
				delete_image($_POST['filename'], $_POST['image_id'], $_SESSION['user_id']);
				break;
			case 'sal':
				include_once 'sals.php';
				break;
			case 'logout':
				offline($_SESSION['user_id']);
				session_destroy();
				header('location:index.php');
				exit();
				break;
		}
		
	} else {
		
		if(isset($_POST['a'])){
			$action = $_POST['a'];
		} else if(isset($_GET['a'])){
			$action = $_GET['a'];
		} else {
			if(!isset($_SESSION['category_array'])){
				$_SESSION['category_array'] = array('art', 'awww', 'gif');
				$rand = rand(0, 2);
				$action = $_SESSION['category_array'][$rand];
			} else {
				$rand = rand(0, 2);
				$action = $_SESSION['category_array'][$rand];
			}
		}
		
		$new_friend = false;
		$new_messages = false;
		
		switch($action){
			case 'upload_image_guest':
				$file = $_FILES['qqfile']['tmp_name'];
				$filename = $_FILES['qqfile']['name'];
				$filesize = round(($_FILES['qqfile']['size'] / 1000000), 2, PHP_ROUND_HALF_UP);
				$fileExt = pathinfo($filename, PATHINFO_EXTENSION);
				if($fileExt == "jpg" || $fileExt == "jpeg" || $fileExt == "png" || $fileExt == "gif" || $fileExt == "JPG"){
					$_SESSION['upload_filename'] = random_filename($alphas).'.'.$fileExt;
					$destination = 'g/large/'.$_SESSION['upload_filename'];
					move_uploaded_file($file, $destination);
					switch($_FILES['qqfile']['type']){
						case 'image/gif':
							$old_image = imagecreatefromgif($destination);
							break;
						case 'image/jpg':
						case 'image/jpeg':
							$old_image = imagecreatefromjpeg($destination);
							break;
						case 'image/png':
							$old_image = imagecreatefrompng($destination);
							break;
					}
					image_resize($_SESSION['upload_filename'], 0, $old_image, true);
				}
				break;
			case 'upload_id_session':
				$_SESSION['upload_id'] = random_filename($alphas);
				$_SESSION[$_SESSION['upload_id']] = array();
				break;
			case 'upload_add_guest_filename':
				array_push($_SESSION[$_SESSION['upload_id']], $_SESSION['upload_filename']);
				insertImg_into_db_guest($_SESSION['upload_filename'], $_SESSION['upload_id']);
				break;
			case 'upload_done':
				$upload = array("upload_id" => $_SESSION['upload_id']);
				echo json_encode($upload);
				break;
			case 'next_uploaded_image':
				$upload_id = $_POST['upload_id'];
				$current_page = $_POST['current_page'] - 1;
				include_once 'voteview_guest_upload_template.php';
				break;
			case 'art':
				$_SESSION['subcategory'] = false;
				if(isset($_POST['next'])){
					$_SESSION['next_image_counter']++;
					if($_SESSION['next_image_counter'] == $_SESSION['image_count']){
						shuffle($_SESSION['filepaths']);
						$_SESSION['next_image_counter'] = 0;
					}
				} else if(isset($_POST['prev'])){
					$_SESSION['next_image_counter']--;
				} else {
					$filepaths = get_toplists('art');
					$_SESSION['filepaths'] = $filepaths[0];
					shuffle($_SESSION['filepaths']);
					$_SESSION['image_count'] = count($_SESSION['filepaths']);
					$_SESSION['next_image_counter'] = 0;
					$_SESSION['toplist2'] = $filepaths[2];
					$_SESSION['toplist3'] = $filepaths[3];
					$_SESSION['toplist4'] = $filepaths[4];
					$_SESSION['toplist5'] = $filepaths[5];
					$_SESSION['toplist6'] = $filepaths[6];
					$_SESSION['image_infos'] = array();
					$_SESSION['image_comments'] = array();
					$_SESSION['count_comments'] = array();
				}
				$random_image = $_SESSION['filepaths'][$_SESSION['next_image_counter']];
				if(isset($_POST['prev'])){
					$image_info = $_SESSION['image_infos'][$_SESSION['next_image_counter']];
					$imagecomments = $_SESSION['image_comments'][$_SESSION['next_image_counter']];
					$count_comments = $_SESSION['count_comments'][$_SESSION['next_image_counter']];
				} else {
					$filename = basename($random_image);
					$image_info = check_file_filename($filename);
					$imagecomments = get_imagecomments_guest($image_info['image_id']);
					$count_comments = count_imagecomments($image_info['image_id']); /*Counting all comments since need for pagination*/
					array_push($_SESSION['image_infos'], $image_info);
					array_push($_SESSION['image_comments'], $imagecomments);
					array_push($_SESSION['count_comments'], $count_comments);
					increment_bandwidth_views($image_info['image_id'], $image_info['size'], $image_info['bandwidth']);
				}
				if((isset($_POST['next'])) || (isset($_POST['prev']))){
					include_once 'voteview_nextimg_guest.php';
					break;
				} else {
					$subcategorylinks = glob('assets/imgsource/buttons/art2/*');
					$profile_messages = false;
					include_once 'voteview_guest.php';
					break;
				}
			case 'artsub':
				$_SESSION['subcategory'] = true;
				$subcategory = $_POST['subcategory'];
				if(isset($_POST['next'])){
					$_SESSION['next_image_counter']++;
					if($_SESSION['next_image_counter'] == $_SESSION['image_count']){
						shuffle($_SESSION['filepaths']);
						$_SESSION['next_image_counter'] = 0;
					}
				} else if(isset($_POST['prev'])){
					$_SESSION['next_image_counter']--;
				} else {
					$filepaths = get_toplists_subcategory('art', $subcategory);
					$_SESSION['filepaths'] = $filepaths[0];
					shuffle($_SESSION['filepaths']);
					$_SESSION['image_count'] = count($_SESSION['filepaths']);
					$_SESSION['next_image_counter'] = 0;
					$_SESSION['toplist2'] = $filepaths[2];
					$_SESSION['toplist3'] = $filepaths[3];
					$_SESSION['toplist4'] = $filepaths[4];
					$_SESSION['toplist5'] = $filepaths[5];
					$_SESSION['toplist6'] = $filepaths[6];
					$_SESSION['image_infos'] = array();
					$_SESSION['image_comments'] = array();
					$_SESSION['count_comments'] = array();
				}
				$random_image = $_SESSION['filepaths'][$_SESSION['next_image_counter']];
				if(isset($_POST['prev'])){
					$image_info = $_SESSION['image_infos'][$_SESSION['next_image_counter']];
					$imagecomments = $_SESSION['image_comments'][$_SESSION['next_image_counter']];
					$count_comments = $_SESSION['count_comments'][$_SESSION['next_image_counter']];
				} else {
					$filename = basename($random_image);
					$image_info = check_file_filename($filename);
					$imagecomments = get_imagecomments_guest($image_info['image_id']);
					$count_comments = count_imagecomments($image_info['image_id']); /*Counting all comments since need for pagination*/
					array_push($_SESSION['image_infos'], $image_info);
					array_push($_SESSION['image_comments'], $imagecomments);
					array_push($_SESSION['count_comments'], $count_comments);
					increment_bandwidth_views($image_info['image_id'], $image_info['size'], $image_info['bandwidth']);
				}
				if((isset($_POST['next'])) || (isset($_POST['prev']))){
					include_once 'voteview_nextimg_guest.php';
					break;
				} else {
					include_once 'voteview_subcategory_guest.php';
					break;
				}
			case 'awww':
				$_SESSION['subcategory'] = false;
				if(isset($_POST['next'])){
					$_SESSION['next_image_counter']++;
					if($_SESSION['next_image_counter'] == $_SESSION['image_count']){
						shuffle($_SESSION['filepaths']);
						$_SESSION['next_image_counter'] = 0;
					}
				} else if(isset($_POST['prev'])){
					$_SESSION['next_image_counter']--; 
				} else {
					$filepaths = get_toplists('awww');
					$_SESSION['filepaths'] = $filepaths[0];
					shuffle($_SESSION['filepaths']);
					$_SESSION['image_count'] = count($_SESSION['filepaths']);
					$_SESSION['next_image_counter'] = 0;
					$_SESSION['toplist2'] = $filepaths[2];
					$_SESSION['toplist3'] = $filepaths[3];
					$_SESSION['toplist4'] = $filepaths[4];
					$_SESSION['toplist5'] = $filepaths[5];
					$_SESSION['toplist6'] = $filepaths[6];
					$_SESSION['image_infos'] = array();
					$_SESSION['image_comments'] = array();
					$_SESSION['count_comments'] = array();
				}
				$random_image = $_SESSION['filepaths'][$_SESSION['next_image_counter']];
				if(isset($_POST['prev'])){
					$image_info = $_SESSION['image_infos'][$_SESSION['next_image_counter']];
					$imagecomments = $_SESSION['image_comments'][$_SESSION['next_image_counter']];
					$count_comments = $_SESSION['count_comments'][$_SESSION['next_image_counter']];
				} else {
					$filename = basename($random_image);
					$image_info = check_file_filename($filename);
					$imagecomments = get_imagecomments_guest($image_info['image_id']);
					$count_comments = count_imagecomments($image_info['image_id']); /*Counting all comments since need for pagination*/
					array_push($_SESSION['image_infos'], $image_info);
					array_push($_SESSION['image_comments'], $imagecomments);
					array_push($_SESSION['count_comments'], $count_comments);
					increment_bandwidth_views($image_info['image_id'], $image_info['size'], $image_info['bandwidth']);
				}
				if((isset($_POST['next'])) ||(isset($_POST['prev']))){
					include_once 'voteview_nextimg_guest.php';
					break;
				} else {
					$profile_messages = false;
					include_once 'voteview_guest.php';
					break;
				}
			case 'boy':
				$_SESSION['subcategory'] = false;
				if(isset($_POST['next'])){
					$_SESSION['next_image_counter']++;
					if($_SESSION['next_image_counter'] == $_SESSION['image_count']){
						shuffle($_SESSION['filepaths']);
						$_SESSION['next_image_counter'] = 0;
					}
				} else if(isset($_POST['prev'])){
					$_SESSION['next_image_counter']--; 
				} else {
					$filepaths = get_toplists('boy');
					$_SESSION['filepaths'] = $filepaths[0];
					shuffle($_SESSION['filepaths']);
					$_SESSION['image_count'] = count($_SESSION['filepaths']);
					$_SESSION['next_image_counter'] = 0;
					$_SESSION['toplist2'] = $filepaths[2];
					$_SESSION['toplist3'] = $filepaths[3];
					$_SESSION['toplist4'] = $filepaths[4];
					$_SESSION['toplist5'] = $filepaths[5];
					$_SESSION['toplist6'] = $filepaths[6];
					$_SESSION['image_infos'] = array();
					$_SESSION['image_comments'] = array();
					$_SESSION['count_comments'] = array();
				}
				$random_image = $_SESSION['filepaths'][$_SESSION['next_image_counter']];
				if(isset($_POST['prev'])){
					$image_info = $_SESSION['image_infos'][$_SESSION['next_image_counter']];
					$imagecomments = $_SESSION['image_comments'][$_SESSION['next_image_counter']];
					$count_comments = $_SESSION['count_comments'][$_SESSION['next_image_counter']];
				} else {
					$filename = basename($random_image);
					$image_info = check_file_filename($filename);
					$imagecomments = get_imagecomments_guest($image_info['image_id']);
					$count_comments = count_imagecomments($image_info['image_id']); /*Counting all comments since need for pagination*/
					array_push($_SESSION['image_infos'], $image_info);
					array_push($_SESSION['image_comments'], $imagecomments);
					array_push($_SESSION['count_comments'], $count_comments);
					increment_bandwidth_views($image_info['image_id'], $image_info['size'], $image_info['bandwidth']);
				}
				if((isset($_POST['next'])) ||(isset($_POST['prev']))){
					include_once 'voteview_nextimg_guest.php';
					break;
				} else {
					$profile_messages = false;
					include_once 'voteview_guest.php';
					break;
				}
			case 'girl':
				$_SESSION['subcategory'] = false;
				if(isset($_POST['next'])){
					$_SESSION['next_image_counter']++;
					if($_SESSION['next_image_counter'] == $_SESSION['image_count']){
						shuffle($_SESSION['filepaths']);
						$_SESSION['next_image_counter'] = 0;
					}
				} else if(isset($_POST['prev'])){
					$_SESSION['next_image_counter']--; 
				} else {
					$filepaths = get_toplists('girl');
					$_SESSION['filepaths'] = $filepaths[0];
					shuffle($_SESSION['filepaths']);
					$_SESSION['image_count'] = count($_SESSION['filepaths']);
					$_SESSION['next_image_counter'] = 0;
					$_SESSION['toplist2'] = $filepaths[2];
					$_SESSION['toplist3'] = $filepaths[3];
					$_SESSION['toplist4'] = $filepaths[4];
					$_SESSION['toplist5'] = $filepaths[5];
					$_SESSION['toplist6'] = $filepaths[6];
					$_SESSION['image_infos'] = array();
					$_SESSION['image_comments'] = array();
					$_SESSION['count_comments'] = array();
				}
				$random_image = $_SESSION['filepaths'][$_SESSION['next_image_counter']];
				if(isset($_POST['prev'])){
					$image_info = $_SESSION['image_infos'][$_SESSION['next_image_counter']];
					$imagecomments = $_SESSION['image_comments'][$_SESSION['next_image_counter']];
					$count_comments = $_SESSION['count_comments'][$_SESSION['next_image_counter']];
				} else {
					$filename = basename($random_image);
					$image_info = check_file_filename($filename);
					$imagecomments = get_imagecomments_guest($image_info['image_id']);
					$count_comments = count_imagecomments($image_info['image_id']); /*Counting all comments since need for pagination*/
					array_push($_SESSION['image_infos'], $image_info);
					array_push($_SESSION['image_comments'], $imagecomments);
					array_push($_SESSION['count_comments'], $count_comments);
					increment_bandwidth_views($image_info['image_id'], $image_info['size'], $image_info['bandwidth']);
				}
				if((isset($_POST['next'])) ||(isset($_POST['prev']))){
					include_once 'voteview_nextimg_guest.php';
					break;
				} else {
					$profile_messages = false;
					include_once 'voteview_guest.php';
					break;
				}
			case 'gif':
				$_SESSION['subcategory'] = false;
				if(isset($_POST['next'])){
					$_SESSION['next_image_counter']++;
					if($_SESSION['next_image_counter'] == $_SESSION['image_count']){
						shuffle($_SESSION['filepaths']);
						$_SESSION['next_image_counter'] = 0;
					}
				} else if(isset($_POST['prev'])){
					$_SESSION['next_image_counter']--;
				} else {
					$filepaths = get_toplists('gif');
					$_SESSION['filepaths'] = $filepaths[0];
					shuffle($_SESSION['filepaths']);
					$_SESSION['image_count'] = count($_SESSION['filepaths']);
					$_SESSION['next_image_counter'] = 0;
					$_SESSION['toplist2'] = $filepaths[2];
					$_SESSION['toplist3'] = $filepaths[3];
					$_SESSION['toplist4'] = $filepaths[4];
					$_SESSION['toplist5'] = $filepaths[5];
					$_SESSION['toplist6'] = $filepaths[6];
					$_SESSION['image_infos'] = array();
					$_SESSION['image_comments'] = array();
					$_SESSION['count_comments'] = array();
				}
				$random_image = $_SESSION['filepaths'][$_SESSION['next_image_counter']];
				if(isset($_POST['prev'])){
					$image_info = $_SESSION['image_infos'][$_SESSION['next_image_counter']];
					$imagecomments = $_SESSION['image_comments'][$_SESSION['next_image_counter']];
					$count_comments = $_SESSION['count_comments'][$_SESSION['next_image_counter']];
				} else {
					$filename = basename($random_image);
					$image_info = check_file_filename($filename);
					$imagecomments = get_imagecomments_guest($image_info['image_id']);
					$count_comments = count_imagecomments($image_info['image_id']); /*Counting all comments since need for pagination*/
					array_push($_SESSION['image_infos'], $image_info);
					array_push($_SESSION['image_comments'], $imagecomments);
					array_push($_SESSION['count_comments'], $count_comments);
					increment_bandwidth_views($image_info['image_id'], $image_info['size'], $image_info['bandwidth']);
				}
				if((isset($_POST['next'])) ||(isset($_POST['prev']))){
					include_once 'voteview_nextimg_guest.php';
					break;
				} else {
					$profile_messages = false;
					include_once 'voteview_guest.php';
					break;
				}
			case 'meme':
				$_SESSION['subcategory'] = false;
				if(isset($_POST['next'])){
					$_SESSION['next_image_counter']++;
					if($_SESSION['next_image_counter'] == $_SESSION['image_count']){
						shuffle($_SESSION['filepaths']);
						$_SESSION['next_image_counter'] = 0;
					}
				}  else if(isset($_POST['prev'])){
					$_SESSION['next_image_counter']--;
				} else {
					$filepaths = get_toplists('meme');
					$_SESSION['filepaths'] = $filepaths[0];
					shuffle($_SESSION['filepaths']);
					$_SESSION['image_count'] = count($_SESSION['filepaths']);
					$_SESSION['next_image_counter'] = 0;
					$_SESSION['toplist2'] = $filepaths[2];
					$_SESSION['toplist3'] = $filepaths[3];
					$_SESSION['toplist4'] = $filepaths[4];
					$_SESSION['toplist5'] = $filepaths[5];
					$_SESSION['toplist6'] = $filepaths[6];
					$_SESSION['image_infos'] = array();
					$_SESSION['image_comments'] = array();
					$_SESSION['count_comments'] = array();
				}
				$random_image = $_SESSION['filepaths'][$_SESSION['next_image_counter']];
				if(isset($_POST['prev'])){
					$image_info = $_SESSION['image_infos'][$_SESSION['next_image_counter']];
					$imagecomments = $_SESSION['image_comments'][$_SESSION['next_image_counter']];
					$count_comments = $_SESSION['count_comments'][$_SESSION['next_image_counter']];
				} else {
					$filename = basename($random_image);
					$image_info = check_file_filename($filename);
					$imagecomments = get_imagecomments_guest($image_info['image_id']);
					$count_comments = count_imagecomments($image_info['image_id']); /*Counting all comments since need for pagination*/
					array_push($_SESSION['image_infos'], $image_info);
					array_push($_SESSION['image_comments'], $imagecomments);
					array_push($_SESSION['count_comments'], $count_comments);
					increment_bandwidth_views($image_info['image_id'], $image_info['size'], $image_info['bandwidth']);
				}
				if((isset($_POST['next'])) ||(isset($_POST['prev']))){
					include_once 'voteview_nextimg_guest.php';
					break;
				} else {
					$profile_messages = false;
					$subcategorylinks = glob('assets/imgsource/buttons/meme3/*');
					include_once 'voteview_guest.php';
					break;
				}
			case 'memesub':
				$_SESSION['subcategory'] = true;
				$subcategory = $_POST['subcategory'];
				if(isset($_POST['next'])){
					$_SESSION['next_image_counter']++;
					if($_SESSION['next_image_counter'] == $_SESSION['image_count']){
						shuffle($_SESSION['filepaths']);
						$_SESSION['next_image_counter'] = 0;
					}
				} else if(isset($_POST['prev'])){
					$_SESSION['next_image_counter']--;
				} else {
					$filepaths = get_toplists_subcategory('meme', $subcategory);
					$_SESSION['filepaths'] = $filepaths[0];
					shuffle($_SESSION['filepaths']);
					$_SESSION['image_count'] = count($_SESSION['filepaths']);
					$_SESSION['next_image_counter'] = 0;
					$_SESSION['toplist2'] = $filepaths[2];
					$_SESSION['toplist3'] = $filepaths[3];
					$_SESSION['toplist4'] = $filepaths[4];
					$_SESSION['toplist5'] = $filepaths[5];
					$_SESSION['toplist6'] = $filepaths[6];
					$_SESSION['image_infos'] = array();
					$_SESSION['image_comments'] = array();
					$_SESSION['count_comments'] = array();
				}
				$random_image = $_SESSION['filepaths'][$_SESSION['next_image_counter']];
				if(isset($_POST['prev'])){
					$image_info = $_SESSION['image_infos'][$_SESSION['next_image_counter']];
					$imagecomments = $_SESSION['image_comments'][$_SESSION['next_image_counter']];
					$count_comments = $_SESSION['count_comments'][$_SESSION['next_image_counter']];
				} else {
					$filename = basename($random_image);
					$image_info = check_file_filename($filename);
					$imagecomments = get_imagecomments_guest($image_info['image_id']);
					$count_comments = count_imagecomments($image_info['image_id']); /*Counting all comments since need for pagination*/
					array_push($_SESSION['image_infos'], $image_info);
					array_push($_SESSION['image_comments'], $imagecomments);
					array_push($_SESSION['count_comments'], $count_comments);
					increment_bandwidth_views($image_info['image_id'], $image_info['size'], $image_info['bandwidth']);
				}
				if((isset($_POST['next'])) ||(isset($_POST['prev']))){
					include_once 'voteview_nextimg_guest.php';
					break;
				} else {
					include_once 'voteview_subcategory_guest.php';
					break;
				}
			case 'funny':
				$_SESSION['subcategory'] = false;
				if(isset($_POST['next'])){
					$_SESSION['next_image_counter']++;
					if($_SESSION['next_image_counter'] == $_SESSION['image_count']){
						shuffle($_SESSION['filepaths']);
						$_SESSION['next_image_counter'] = 0;
					}
				} else if(isset($_POST['prev'])){
					$_SESSION['next_image_counter']--;
				} else {
					$filepaths = get_toplists('funny');
					$_SESSION['filepaths'] = $filepaths[0];
					shuffle($_SESSION['filepaths']);
					$_SESSION['image_count'] = count($_SESSION['filepaths']);
					$_SESSION['next_image_counter'] = 0;
					$_SESSION['toplist2'] = $filepaths[2];
					$_SESSION['toplist3'] = $filepaths[3];
					$_SESSION['toplist4'] = $filepaths[4];
					$_SESSION['toplist5'] = $filepaths[5];
					$_SESSION['toplist6'] = $filepaths[6];
					$_SESSION['image_infos'] = array();
					$_SESSION['image_comments'] = array();
					$_SESSION['count_comments'] = array();
				}
				$random_image = $_SESSION['filepaths'][$_SESSION['next_image_counter']];
				if(isset($_POST['prev'])){
					$image_info = $_SESSION['image_infos'][$_SESSION['next_image_counter']];
					$imagecomments = $_SESSION['image_comments'][$_SESSION['next_image_counter']];
					$count_comments = $_SESSION['count_comments'][$_SESSION['next_image_counter']];
				} else {
					$filename = basename($random_image);
					$image_info = check_file_filename($filename);
					$imagecomments = get_imagecomments_guest($image_info['image_id']);
					$count_comments = count_imagecomments($image_info['image_id']); /*Counting all comments since need for pagination*/
					array_push($_SESSION['image_infos'], $image_info);
					array_push($_SESSION['image_comments'], $imagecomments);
					array_push($_SESSION['count_comments'], $count_comments);
					increment_bandwidth_views($image_info['image_id'], $image_info['size'], $image_info['bandwidth']);
				}
				if((isset($_POST['next'])) ||(isset($_POST['prev']))){
					include_once 'voteview_nextimg_guest.php';
					break;
				} else {
					$profile_messages = false;
					include_once 'voteview_guest.php';
					break;
				}
			case 'gaming':
				$_SESSION['subcategory'] = false;
				if(isset($_POST['next'])){
					$_SESSION['next_image_counter']++;
					if($_SESSION['next_image_counter'] == $_SESSION['image_count']){
						shuffle($_SESSION['filepaths']);
						$_SESSION['next_image_counter'] = 0;
					}
				} else if(isset($_POST['prev'])){
					$_SESSION['next_image_counter']--;
				} else {
					$filepaths = get_toplists('gaming');
					$_SESSION['filepaths'] = $filepaths[0];
					shuffle($_SESSION['filepaths']);
					$_SESSION['image_count'] = count($_SESSION['filepaths']);
					$_SESSION['next_image_counter'] = 0;
					$_SESSION['toplist2'] = $filepaths[2];
					$_SESSION['toplist3'] = $filepaths[3];
					$_SESSION['toplist4'] = $filepaths[4];
					$_SESSION['toplist5'] = $filepaths[5];
					$_SESSION['toplist6'] = $filepaths[6];
					$_SESSION['image_infos'] = array();
					$_SESSION['image_comments'] = array();
					$_SESSION['count_comments'] = array();
				}
				$random_image = $_SESSION['filepaths'][$_SESSION['next_image_counter']];
				if(isset($_POST['prev'])){
					$image_info = $_SESSION['image_infos'][$_SESSION['next_image_counter']];
					$imagecomments = $_SESSION['image_comments'][$_SESSION['next_image_counter']];
					$count_comments = $_SESSION['count_comments'][$_SESSION['next_image_counter']];
				} else {
					$filename = basename($random_image);
					$image_info = check_file_filename($filename);
					$imagecomments = get_imagecomments_guest($image_info['image_id']);
					$count_comments = count_imagecomments($image_info['image_id']); /*Counting all comments since need for pagination*/
					array_push($_SESSION['image_infos'], $image_info);
					array_push($_SESSION['image_comments'], $imagecomments);
					array_push($_SESSION['count_comments'], $count_comments);
					increment_bandwidth_views($image_info['image_id'], $image_info['size'], $image_info['bandwidth']);
				}
				if((isset($_POST['next'])) ||(isset($_POST['prev']))){
					include_once 'voteview_nextimg_guest.php';
					break;
				} else {
					$profile_messages = false;
					include_once 'voteview_guest.php';
					break;
				}
			case 'wtf':
				$_SESSION['subcategory'] = false;
				if(isset($_POST['next'])){
					$_SESSION['next_image_counter']++;
					if($_SESSION['next_image_counter'] == $_SESSION['image_count']){
						shuffle($_SESSION['filepaths']);
						$_SESSION['next_image_counter'] = 0;
					}
				} else if(isset($_POST['prev'])){
					$_SESSION['next_image_counter']--;
				} else {
					$filepaths = get_toplists('wtf');
					$_SESSION['filepaths'] = $filepaths[0];
					shuffle($_SESSION['filepaths']);
					$_SESSION['image_count'] = count($_SESSION['filepaths']);
					$_SESSION['next_image_counter'] = 0;
					$_SESSION['toplist2'] = $filepaths[2];
					$_SESSION['toplist3'] = $filepaths[3];
					$_SESSION['toplist4'] = $filepaths[4];
					$_SESSION['toplist5'] = $filepaths[5];
					$_SESSION['toplist6'] = $filepaths[6];
					$_SESSION['image_infos'] = array();
					$_SESSION['image_comments'] = array();
					$_SESSION['count_comments'] = array();
				}
				$random_image = $_SESSION['filepaths'][$_SESSION['next_image_counter']];
				if(isset($_POST['prev'])){
					$image_info = $_SESSION['image_infos'][$_SESSION['next_image_counter']];
					$imagecomments = $_SESSION['image_comments'][$_SESSION['next_image_counter']];
					$count_comments = $_SESSION['count_comments'][$_SESSION['next_image_counter']];
				} else {
					$filename = basename($random_image);
					$image_info = check_file_filename($filename);
					$imagecomments = get_imagecomments_guest($image_info['image_id']);
					$count_comments = count_imagecomments($image_info['image_id']); /*Counting all comments since need for pagination*/
					array_push($_SESSION['image_infos'], $image_info);
					array_push($_SESSION['image_comments'], $imagecomments);
					array_push($_SESSION['count_comments'], $count_comments);
					increment_bandwidth_views($image_info['image_id'], $image_info['size'], $image_info['bandwidth']);
				}
				if((isset($_POST['next'])) ||(isset($_POST['prev']))){
					include_once 'voteview_nextimg_guest.php';
					break;
				} else {
					$profile_messages = false;
					include_once 'voteview_guest.php';
					break;
				}
			case 'other':
				$_SESSION['subcategory'] = false;
				if(isset($_POST['next'])){
					$_SESSION['next_image_counter']++;
					if($_SESSION['next_image_counter'] == $_SESSION['image_count']){
						shuffle($_SESSION['filepaths']);
						$_SESSION['next_image_counter'] = 0;
					}
				} else if(isset($_POST['prev'])){
					$_SESSION['next_image_counter']--;
				} else {
					$filepaths = get_toplists('other');
					$_SESSION['filepaths'] = $filepaths[0];
					shuffle($_SESSION['filepaths']);
					$_SESSION['image_count'] = count($_SESSION['filepaths']);
					$_SESSION['next_image_counter'] = 0;
					$_SESSION['toplist2'] = $filepaths[2];
					$_SESSION['toplist3'] = $filepaths[3];
					$_SESSION['toplist4'] = $filepaths[4];
					$_SESSION['toplist5'] = $filepaths[5];
					$_SESSION['toplist6'] = $filepaths[6];
					$_SESSION['image_infos'] = array();
					$_SESSION['image_comments'] = array();
					$_SESSION['count_comments'] = array();
				}
				$random_image = $_SESSION['filepaths'][$_SESSION['next_image_counter']];
				if(isset($_POST['prev'])){
					$image_info = $_SESSION['image_infos'][$_SESSION['next_image_counter']];
					$imagecomments = $_SESSION['image_comments'][$_SESSION['next_image_counter']];
					$count_comments = $_SESSION['count_comments'][$_SESSION['next_image_counter']];
				} else {
					$filename = basename($random_image);
					$image_info = check_file_filename($filename);
					$imagecomments = get_imagecomments_guest($image_info['image_id']);
					$count_comments = count_imagecomments($image_info['image_id']); /*Counting all comments since need for pagination*/
					array_push($_SESSION['image_infos'], $image_info);
					array_push($_SESSION['image_comments'], $imagecomments);
					array_push($_SESSION['count_comments'], $count_comments);
					increment_bandwidth_views($image_info['image_id'], $image_info['size'], $image_info['bandwidth']);
				}
				if((isset($_POST['next'])) ||(isset($_POST['prev']))){
					include_once 'voteview_nextimg_guest.php';
					break;
				} else {
					$profile_messages = false;
					include_once 'voteview_guest.php';
					break;
				}
			case 'goto':
				$_SESSION['subcategory'] = false;
				if(isset($_POST['filepath'])){
					$filename = basename($_POST['filepath']);
					$image_info = check_file_filename($filename);
				} else {
					(isset($_POST['image_id'])) ? $image_id = $_POST['image_id'] : $image_id = $_GET['image_id'];
					$image_info = check_file($image_id);
				}
				(isset($_POST['arbitrary'])) ? $modal = true : $modal = false;
				$random_image = 'member/'.$image_info['user_id'].'/files/'.$image_info['filename'];
				$imagecomments = get_imagecomments_guest($image_info['image_id']);
				$count_comments = count_imagecomments($image_info['image_id']);
				if($image_info['category'] == "meme"){
					$subcategorylinks = glob('assets/imgsource/buttons/meme3/*');
				} else if($image_info['category'] == "art"){
					$subcategorylinks = glob('assets/imgsource/buttons/art2/*');
				}
				if(isset($_POST['next'])){
					include_once 'voteview_nextimg_guest.php';
					break;
				} else if($modal){
					include_once 'profile_gallery_rated_modal.php';
					break;
				} else {
					$_SESSION['current_view'] = 0;
					$profile_messages = false;
					$filepaths = get_toplists($image_info['category']);
					$_SESSION['filepaths'] = $filepaths[0];
					shuffle($_SESSION['filepaths']);
					$_SESSION['image_count'] = count($_SESSION['filepaths']);
					$_SESSION['next_image_counter'] = 0;
					$_SESSION['toplist2'] = $filepaths[2];
					$_SESSION['toplist3'] = $filepaths[3];
					$_SESSION['toplist4'] = $filepaths[4];
					$_SESSION['toplist5'] = $filepaths[5];
					$_SESSION['toplist6'] = $filepaths[6];
					$_SESSION['image_infos'] = array();
					$_SESSION['image_comments'] = array();
					$_SESSION['count_comments'] = array();
					include_once 'voteview_guest.php';
					break;
				}
			case 'goto-sub':
				$_SESSION['subcategory'] = true;
				if(isset($_POST['filepath'])){
					$filename = basename($_POST['filepath']);
					$image_info = check_file_filename($filename);
				} else {
					(isset($_POST['image_id'])) ? $image_id = $_POST['image_id'] : $image_id = $_GET['image_id'];
					$image_info = check_file($image_id);
				}
				$count_comments = count_imagecomments($image_info['image_id']);
				$random_image = 'member/'.$image_info['user_id'].'/files/'.$image_info['filename'];
				$imagecomments = get_imagecomments_guest($image_info['image_id']);
				$filepaths = get_toplists_subcategory($image_info['category'], $image_info['subcategory']);
				if(isset($_POST['next'])){
					include_once 'voteview_nextimg_guest.php';
					break;
				} else {
					$profile_messages = false;
					include_once 'voteview_guest.php';
					break;
				}
			case 'nexttencomments':
				$offset = ($_POST['current_page'] - 1) * 15;
				$imagecomments = get_next_ten_comments($_POST['image_id'], $offset);
				include_once 'comment_next_ten_guest.php';
				break;
			case 'getreplies':
				$firstreplies = true; /* ables you to use one php file */
				$commentid = $_POST['commentid'];
				$imagecomments = get_replies($commentid);
				$i = 0;
				include_once 'comment_reply_next_ten_guest.php';
				break;
			case 'validate':
				$password = sanitizeString($_POST['password']);
				$valid = validatelogin($_POST['email'], $password);
				if(!$valid){
					$result = array("valid" => $valid);
					echo json_encode($result);
					break;
				} else {
					$_SESSION['username'] = $valid['username'];
					$result = array("valid" => $valid['user_id'], "username" => $valid['username']);
					echo json_encode($result);
					break;
				}
			case 'change_toplist_comments':
				$filepaths = get_toplists_sort_comments($_POST['category'], $_POST['subcategory']);
				$_SESSION['toplist_comment1'] = $filepaths[1];
				$_SESSION['toplist_comment2'] = $filepaths[2];
				$_SESSION['toplist_comment3'] = $filepaths[3];
				$_SESSION['toplist_comment4'] = $filepaths[4];
				$_SESSION['toplist_comment5'] = $filepaths[5];
				include_once 'voteview_most_commented.php';
				break;
			case 'change_toplist_favourite':
				$filepaths = get_toplists_sort_favourite($_POST['category'], $_POST['subcategory']);
				$_SESSION['toplist_favourite1'] = $filepaths[1];
				$_SESSION['toplist_favourite2'] = $filepaths[2];
				$_SESSION['toplist_favourite3'] = $filepaths[3];
				$_SESSION['toplist_favourite4'] = $filepaths[4];
				$_SESSION['toplist_favourite5'] = $filepaths[5];
				include_once 'voteview_top_favourites.php';
				break;
			case 'change_toplist_newest':
				$filepaths = get_toplists_sort_newest($_POST['category'], $_POST['subcategory']);
				$_SESSION['toplist_newest1'] = $filepaths[1];
				$_SESSION['toplist_newest2'] = $filepaths[2];
				$_SESSION['toplist_newest3'] = $filepaths[3];
				$_SESSION['toplist_newest4'] = $filepaths[4];
				$_SESSION['toplist_newest5'] = $filepaths[5];
				include_once 'voteview_top_newest.php';
				break;
			case 'get_toplist':
				if($_POST['sort_choice'] == 1){
					$toplist_nr = $_POST['toplist'];
					$toplist = $_SESSION['toplist'.$_POST['toplist']];
					$nailthumb = "average-nailthumbs".$_POST['toplist'];
				} else if($_POST['sort_choice'] == 2){
					$toplist_nr = $_POST['toplist'];
					$toplist = $_SESSION['toplist_comment'.$_POST['toplist']];
					$nailthumb = "comment-nailthumbs".$_POST['toplist'];
				} else if($_POST['sort_choice'] == 3){
					$toplist_nr = $_POST['toplist'];
					$toplist = $_SESSION['toplist_favourite'.$_POST['toplist']];
					$nailthumb = "favourite-nailthumbs".$_POST['toplist'];
				} else {
					$toplist_nr = $_POST['toplist'];
					$toplist = $_SESSION['toplist_newest'.$_POST['toplist']];
					$nailthumb = "newest-nailthumbs".$_POST['toplist'];
				}
				include_once 'voteview_toplist_template.php';
				break;
			case 'validate_redirect':
				$_SESSION['timer'] = time();
				$lifetime = 60 * 24;
				session_set_cookie_params($lifetime);
				$_SESSION['user_id'] = $_POST['user_id'];
				$profile_info = get_profile($_SESSION['user_id']);
				$_SESSION['ip'] = get_current_ip();
				update_ip($_SESSION['ip'], $_SESSION['user_id']);
				online($_SESSION['user_id']);
				$_SESSION['user_true'] = true;
				$_SESSION['age'] = $profile_info['age'];
				$_SESSION['verified'] = $profile_info['verified'];
				$_SESSION['profileimg'] = $profile_info['profileimg'];
				$_SESSION['gender'] = $profile_info['gender'];
				$_SESSION['subcategory'] = false;
				$_SESSION['current_view'] = 0;
				$image_info = check_file($_POST['image_id']);
				$random_image = 'member/'.$image_info['user_id'].'/files/'.$image_info['filename'];
				$favourite = check_favourite_status($_SESSION['user_id'], $image_info['image_id']);
				$imagecomments = get_imagecomments($image_info['image_id'], $_SESSION['user_id']);
				$count_comments = count_imagecomments($image_info['image_id']);
				include_once 'voteview_nextimg.php';
				break;
			case 'register':
				$_SESSION['timer'] = time();
				$_SESSION['ip'] = get_current_ip();
				$user_id = add_user($_POST['username'], $_POST['password'], $_POST['email'], $_SESSION['ip']);
				$_SESSION['user_id'] = $user_id[0];
				$_SESSION['username'] = $_POST['username'];
				$pathname = 'member/'.$_SESSION['user_id'];
				mkdir($pathname);
				$pathname = 'member/'.$_SESSION['user_id'].'/files';
				mkdir($pathname);
				$pathname = 'member/'.$_SESSION['user_id'].'/thumbnail';
				mkdir($pathname);
				$pathname = 'member/'.$_SESSION['user_id'].'/large';
				mkdir($pathname);
				insert_user($_SESSION['user_id'], $_SESSION['username']);
				online($_SESSION['username']);
				$lifetime = 60 * 24;
				session_set_cookie_params($lifetime);
				online($_SESSION['user_id']);
				$_SESSION['subcategory'] = false;
				$_SESSION['current_view'] = 0;
				$message = "Hi and welcome to friends and family beta version of doostr. I've up until now only focused on functionality rather then design hence the unfinished look. Test the site and message me about any bugs that you find or give me feedback. I'm the only developer right now so changes will come relatively slow, but I'm working diligently to improve the site so visit it from time to time. /Sal";
				$image_info = check_file($_POST['image_id']);
				$random_image = 'member/'.$image_info['user_id'].'/files/'.$image_info['filename'];
				send_message(11, "Sal", $_SESSION['user_id'], $message, $_SESSION['username']);
				$favourite = check_favourite_status($_SESSION['user_id'], $image_info['image_id']);
				$imagecomments = get_imagecomments($image_info['image_id'], $_SESSION['user_id']);
				$count_comments = count_imagecomments($image_info['image_id']);
				copy('assets/minih5uv2.jpg', 'member/'.$_SESSION['user_id'].'/thumbnail/minih5uv2.jpg');
				copy('assets/h5uv2x.jpg', 'member/'.$_SESSION['user_id'].'/thumbnail/h5uv2.jpg');
				copy('assets/h5uv2y.jpg', 'member/'.$_SESSION['user_id'].'/large/h5uv2.jpg');
				copy('assets/h5uv2y.jpg', 'member/'.$_SESSION['user_id'].'/files/h5uv2.jpg');
				copy('assets/minit8vz6.jpg', 'member/'.$_SESSION['user_id'].'/thumbnail/minit8vz6.jpg');
				copy('assets/t8vz6x.jpg', 'member/'.$_SESSION['user_id'].'/thumbnail/t8vz6.jpg');
				copy('assets/t8vz6y.jpg', 'member/'.$_SESSION['user_id'].'/large/t8vz6.jpg');
				copy('assets/t8vz6y.jpg', 'member/'.$_SESSION['user_id'].'/files/t8vz6.jpg');
				insertImg_into_db("h5uv2.jpg", 0.5, 0, $_SESSION['user_id']);
				insertImg_into_db("t8vz6.jpg", 0.5, 0, $_SESSION['user_id']);
				include_once 'voteview_nextimg.php';
				break;
			case 'check_username_available':
				$result = check_username_available($_POST['username']);
				$result = array("available" => $result);
				echo json_encode($result);
				break;
			case 'sal':
				include_once 'sals.php';
				break;
		}
		
	}}
