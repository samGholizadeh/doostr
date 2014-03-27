		case 'browse':
			$category = $_POST['category'];
			switch($category){
				case 'art':
					$category = 'art';
					$subcategory = false;
					break;
				case 'anime':
					$category = 'anime';
					$subcategory = false;
					break;
				case 'awww':
					$category = 'awww';
					$subcategory = false;
					break;
				case 'boy':
					$category = 'boy';
					$subcategory = false;
					break;
				case 'girl':
					$category = 'girl';
					$subcategory = false;
					break;
				case 'meme':
					$category = 'meme';
					$subcategories = array('alone', 'asianfather'. 'blackman', 'dweller', 'firstworld', 'freshman',
						'freshman', 'fry', 'ggg', 'keanu', 'morpheus', 'raptor', 'sapenguin', 'scumbagbrain',
						'senior', 'steve', 'suburbanmom', 'success', 'teacher', 'wonka', 'other');
						if(isset($_POST['subcategory'])){
						$subcategory = true;
					} else {
						$subcategory = false;
					}
						$subcategorylinks = glob('../assets/imgsource/buttons/meme/*');
					break;
				case 'wtf':
					$category = 'wtf';
					$subcategory = false;
					break;
					case 'other':
					$category = 'other';
					$subcategory = false;
					break;
			}
			if($subcategory){
				$filepaths = get_toplists_subcategory($category, $_POST['subcategory']);
			} else {
				$filepaths = get_toplists($category);
			}
			$min = 2;
			$max = count($filepaths[0]) - 1;
			if(isset($_POST['votevalue'])){
				$votevalue = $_POST['votevalue'];
				$filepath = $_POST['filepath'];
				$filename = basename($filepath);
				$voted = check_has_voted($filename, $username, $ip);
				if(!$voted){
					insert_has_voted($filename, $username, $votevalue, $ip);
					update_image_db($filename, $votevalue);
					increment_bandwidth_views($filename);
				}
			}
			$random_image = $filepaths[0][rand($min, $max)];
			$filename = basename($random_image);
			$image_info = check_file($filename);
			$favourite = get_favimg_status($username, $filename);
			$imagecomments = get_allimagecomments($filename);
			include_once 'voteview.php';
			break;
			
			
					/*case 'random':
			$randomArray = glob($randomImagePath . );
			$min = 0;
			$max = count($randomArray) - 1;
			if(isset($_POST['votevalue'])){
				$votevalue = $_POST['votevalue'];
				$filename = $_POST['filename'];
				$voted = check_has_voted($filename, $username, $ip);
				if(!$voted){
					insert_has_voted($filename, $username, $votevalue, $ip);
					update_image_db($filename, $votevalue);
					increment_bandwidth_views($filename);
				}
			}
			$randomvalue = rand($min, $max);
			$random_image = $randomArray[$randomvalue];
			$filename = basename($random_image);
			$favourite = get_favimg_status($username, $filename);
			$image_info = check_file($filename);
			$image_time = time_passed(strtotime($image_info['timestamp2']));
			$imagecomments = get_allimagecomments($filename);
			//$hasvoted = check_has_voted($filename, $username);
			include_once 'voteview2.php';
			break;*/
			
			
			
			
			
			
			class="subcategory" href="?category=memesub&subcategory=<?php echo $subcategories[$i];?>"
			
			
			
			
			
								
					<legend id="about-legend"></legend>
					
					<div class="row-fluid">
						<div class="span12">
						
							<div class="span6" id="title-left">
								<strong><h6>Listens to</h6></strong>
							</div>
							
							<div class="span5" id="title-right">
								<strong><h6>Reads</h6></strong>
							</div>
							
						</div>
					</div>
					
					<div class="row-fluid" id="about-box-2">
						<div class="span12">
						
							<textarea id="textarea-about-left" class="listenmusic" cols="100" rows="6" placeholder="I listen too...">
								<?php echo $profile_and_about[0]['music']; ?></textarea>
								
							<textarea id="textarea-about-right" class="readbooks" cols="100" rows="6" placeholder="I read...">
								<?php echo $profile_and_about[0]['books']; ?></textarea>
								
						</div>
					</div>
					
					<div class="row-fluid">
						<div class="span12">
								<div class="span6" id="counter-left">
									<strong><span id="music-counter"></strong> characters left.</span>
								</div>
								<div class="span5" id="counter-right">
									<strong><span id="book-counter"></strong> characters left.</span>
								</div>
						</div>
					</div>
																<!-- !!!!!!!!!!!!!!!!!!!!!!! -->
					
					<legend id="about-legend"></legend>
					
					<div class="row-fluid">
						<div class="span12">
						
							<div class="span6" id="title-left">
								<strong><h6>Favourite food</h6></strong>
							</div>
							
							<div class="span5" id="title-right">
								<strong><h6>Favourite movies/TV-series</h6></strong>
							</div>
							
						</div>
					</div>
					
					<div class="row-fluid">
						<div class="span12">
						
							<textarea id="textarea-about-left" class="food" cols="100" rows="6" placeholder="Favourite food...">
								<?php echo $profile_and_about[0]['food']; ?></textarea>
								
							<textarea id="textarea-about-right" class="movies" cols="100" rows="6" placeholder="Favourite movies/TV-series...">
								<?php echo $profile_and_about[0]['movies']; ?></textarea>
								
						</div>
					</div>
					
					<div class="row-fluid" id="tempid">
						<div class="span12">
						
							<div class="span6" id="counter-left">
								<strong><span id="food-counter"></strong> characters left.</span>
							</div>
							
							<div class="span5" id="counter-right">
								<strong><span id="movies-counter"></strong> characters left.</span>
							</div>
						</div>
					</div>
					
					
						$('.listenmusic').limit('185', '#music-counter');
	$('.readbooks').limit('185', '#book-counter');
	$('.food').limit('185', '#food-counter');
	$('.movies').limit('185', '#movies-counter');
	
	
	
	
										<select id="search-agemin" class="span1" placeholder="min">
										<?php for($i = 13; $i <= 99; $i++){?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
										<?php }?>
									</select>
									
									 - 
									 
									 <select id="search-agemax" class="span1" placeholder="max">
										<?php for($i = 13; $i <= 99; $i++){?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
										<?php }?>
									</select>
									
									
									
		<!-- Below is for next ten replies. The reason its here is because of I could not identify 
		The problem with it. Decided to move it here because its not so important right now. 
		There will never be that many sub replies to one single reply to make it a priority right now.
		
		The functionality is that it check for if it is the first set of replies if so creates a 
		specific link that loads more replies to reply-->							
									
									
			<?php if($i>=10){
				if($firstreplies){?>
				
					<span id="com1">
						<a href="" class="showmore-replies" data-currentpage="1" data-commentid="<?php echo $imagecomments[0]['parent_commentid']; ?>"><small>Show next ten comments</small></a>
					</span>
					
					<span id="<?php echo $imagecomments[0]['parent_commentid']?>1">
							
					</span>
					
				<?php } else {?>
				
					<span id="com<?php echo $currentpage; ?>">
						<a href="#" class="showmore-replies" data-currentpage="<?php echo $currentpage; ?>" data-commentid="<?php echo $imagecomments[0]['parent_commentid']; ?>"><small>Show next ten comments</small></a>
					</span>
					
					<span id="<?php echo $imagecomments[0]['parent_commentid']?><?php echo $currentpage; ?>">
							
					</span>
				<?php }}?>
				
					<table class="table table-hover" id="revolver">
						<thead>
							<td id="profile-message-indicator"></td>
							<td id="profile-message-space">Message</td>
							<td id="profile-message-name-space">To</td>
							<td>Date/Time</td>
						</thead>
				
						<span id="insert-sent-message">
						
						
						</span>
						
						
						<tr>
							
			<table class="table table-hover" id="revolver">
						<thead>
							<td id="profile-message-indicator"></td>
							<td id="profile-message-space">Message</td>
							<td id="profile-message-name-space">To</td>
							<td>Date/Time</td>
						</thead>
				
						<span id="insert-sent-message">
						
						
						</span>
						
						<?php if(isset($message_list[1][0]['message_state'])){?>
						
						<?php for($i = 0; $i < $array_length_send; $i++){ ?>
						
						<tr>
							
							<?php if(strlen($message_list[1][$i]['message']) >= 54){?>
							
								<td id="profile-message-indicator">
								
									<a href="" class="extend-message" data-messageid="<?php echo $message_list[1][$i]['message_id']; ?>"><strong class="profile-extend-message">+</strong></a>
								
								</td>
							
								<td class="table-data-string">
							
								<span id="substring-message<?php echo $message_list[1][$i]['message_id']; ?>">
									
									<p class="comments-layout"><?php echo substr($message_list[1][$i]['message'], 0, 54); ?>...</p>
									
								
								</span>
								
							<?php } else { ?>
							
								<td></td>
							
								<td class="table-data-string">
							
								<span id="substring-message<?php echo $message_list[1][$i]['message_id']; ?>">
									
									<p class="comments-layout"><?php echo $message_list[1][$i]['message']; ?></p>

								</span>
								
							<?php }?>
						
								<span class="complete-message" id="complete-message<?php echo $message_list[1][$i]['message_id']; ?>">
								
									<p class="comments-layout"><?php echo $message_list[1][$i]['message']; ?></p>
								
								</span>
								
							</td>
							
							<td>
							
								<a href="" class="goto-author" data-author="<?php echo $message_list[1][$i]['author']; ?>"><?php echo $message_list[1][$i]['recip']; ?></a>
							
							</td>
							
							<td>
							
								<p><?php echo date("Y-m-d H:i", strtotime($message_list[1][$i]['message_timestamp'])); ?></p>
							
							</td>
						
						</tr>
						
						<?php }} else {?>
						
							<!-- EMPTY NO MESSAGES -->
							
						<?php  }?>
					</table>
					
			<div class="page">

				
				<div class="row-fluid large-profile-img">
						<div class="span12">
							<div class="hero-unit">
								<p>Large image here</p>
							</div>
						</div>
					</div>
					
					<div class="row-fluid">
						<div class="span12">
						
							<div class="span6" id="profile-firstpage">
								<div class="row-fluid">
									<div class="span12">
									<ul>
										<input id="profile-name-lastname" type="text" placeholder="Name..."  />
										<input id="age" type="text" placeholder="Age..." />
										<input id="city" type="text" placeholder="City..." />
										<input id="country" type="text" placeholder="Country..." />
										<input id="skype" type="text" placeholder="Skype" />
										<button class="btn btn-mini btn-info" id="submit-profile"><strong>Submit</strong></button>
									</ul>
									</div>
								</div>
							</div>
							
							<div class="span6" id="profile-firstpage">
								
								<div class="row-fluid">
									<div class="span12">
										<textarea id="textarea-about-left" class="profiledescription" cols="100" rows="6" placeholder="Short description about yourself...">
										<?php echo $profile_and_about[0]['description']?></textarea>
									</div>
								</div>
								
								
								<div class="row-fluid" id="about-box-1">
									<div class="span12">
										<div class="span6" id="counter-left">
											<strong><span id="descr-counter"></strong> characters left.</span>
										</div>
									</div>
								</div>
							</div>
							
							
						</div>
					</div>
					
																<!-- !!!!!!!!!!!!!!!!!!!!!!! -->
					
					<legend id="about-legend"></legend>
					
					<div class="row-fluid" id="btn-saveprofile">
						<div class="span12">
							<button class="btn" id="save-profile">Save</button>
						</div>
					</div>
			</div>
			
			
			
			
			
			case 'profile':
			$_SESSION['user_true'] = true;
			$totalstorage = total_storage($username);
			$profile_and_about = get_profile_about($username);
			if($profile_and_about[0]['appearoffline'] == 1){
				$appearoffline = true;
			} else {
				$appearoffline = false;
			}
			$_SESSION['age'] = $profile_and_about[0]['age'];
			$_SESSION['verified'] = $profile_and_about[0]['verified'];
			$_SESSION['profileimg'] = $profile_and_about[0]['profileimg'];
			if(!empty($profile_and_about[0]['profileimg'])){
				$profileimg = true;
				$profileimagesource = '../member/' . $username . '/files/' . $profile_and_about[0]['profileimg'];
			} else {
				$profileimg = false;
			}
			$friendRequests = check_new_friendRequests($username);
			if($friendRequests){
				$frA = get_friend_requests($username);
			}
			include_once 'profile.php';
			break;
		case 'profile_gallery':
			($_SESSION['user_true'] == false) ? $friendstate = $_SESSION['friendstate'] : $friendstate = false;
			$images = get_all($_POST['username'], $_SESSION['user_true'], $friendstate); /*friendstate includes permission and friendstate*/
			$favourites = get_all_favimg($_POST['username']);
			$array_length = count($favourites) - 1;
			/*$albums = get_album_display($username); Three arguments check for private albums*/
			if($_SESSION['user_true']){
				include_once 'profile_gallery.php';
			} else {
				include_once 'profile_galleryx.php';
			}
			break;
			
					case 'updateprofile':
			if(isset($_POST['name'])){
				$name = $_POST['name'];
			} else {
				$name = "";
			}
				
			if(isset($_POST['lastname'])){
				$lastname = $_POST['lastname'];
			} else {
				$lastname = "";
			}
				
			if(isset($_POST['age'])){					
				$age = $_POST['age'];
			} else {		
				$age = "";
			}					
			if(isset($_POST['city'])){
				$city = $_POST['city'];
			} else {
				$city = "";
			}
				
			if(isset($_POST['country'])){
				$country = $_POST['country'];
			} else {
				$country = "";
			}
				
			if(isset($_POST['skype'])){
				$skype = $_POST['skype'];
			} else {
				$skype = "";
			}
				
			if(isset($_POST['msn'])){
				$msn = $_POST['msn'];
			} else {
				$msn = "";
			}
				
			if(isset($_POST['yahoo'])){
				$yahoo = $_POST['yahoo'];
			} else {
				$yahoo = "";
			}
				
			if(isset($_POST['text'])){
				$text = $_POST['text'];
			} else {
				$text = "";
			}
		
			if(isset($_FILES['file2'])){
				$profileImagePath = '../member/' . $username . '/images/profileimg/';
				//$checkexistsprofileimg = scandir($profileImagePath);
				//if(!glob("/" . $profileImagePath . "/*")){
				//$profileimg = get_profileimg($username);
				//unlink($profileImagePath . 'orignal' . $profileimg['profileimg']);
				//	unlink($profileImagePath . $profileimg['profileimg']);
				//}
				$file = $_FILES['file2']['tmp_name'];
				$filename = $_FILES['file2']['name'];
				$fileExt = pathinfo($filename, PATHINFO_EXTENSION);
				if($fileExt == "jpg" || $fileExt == "jpeg" || $fileExt == "png"){
				$filename = random_filename($alphas) . '.' . $fileExt;
					$destination = $profileImagePath . $filename;
					move_uploaded_file($file, $destination);
					switch($_FILES['file2']['type']){
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
					image_resizeprofile($username, $old_image, $filename);
					insert_profileimg($username, $filename);
				}
			}
			$insertCheck = set_profile($username, $name, $lastname, $age, $country, $city, $skype, $msn, $yahoo);
			$insertProfileDescription = update_profiledescription($username, $text);
			include_once 'editView.php';
			break;
			
			
					case 'updateabout':
			$profiledescr = $_POST['profiledescr'];
			$sparetime = $_POST['sparetime'];
			$listenmusic = $_POST['listenmusic'];
			$readbooks = $_POST['readbooks'];
			$food = $_POST['food'];
			$movies = $_POST['movies'];
			update_profileDescription($username, $profiledescr, $sparetime, $listenmusic, $readbook, $food, $movies);
			break;
			
			
			
			
			
					case 'rateimg':
			$ratedImages = '../images/';
			$imageFileName = $_POST['filename'];	//Have to create a function that takes the AJAX supplied src attribute and extract the filename.
			//$imageFileName = basename($filepathname);
			$category = make_img_rated($imageFileName); 	//copy the image that is to be rated from the member directory to rated image directory.
			$source = '../member/' . $username . '/images/small/' . $imageFileName;
				
			if($category['category'] == 'boys'){
				copy($source, $ratedImages . $category['category'] . '/' . $imageFileName);
			} else if($category['category'] == 'girl'){
				copy($source, $ratedImages . $category['category'] . '/' . $imageFileName);
			} else if($category['category'] == 'anime'){
				copy($source, $ratedImages . $category['category'] . '/' . $imageFileName);
			} else if($category['category'] == 'awww'){
				copy($source, $ratedImages . $category['category'] . '/' . $imageFileName);
			} else if($category['category'] == 'meme'){
				$subcategory = get_subcategory($imageFileName);
				copy($source, $ratedImages . $category['category'] . '/' . $subcategory['subcategory'] . '/' . $imageFileName);
			} else if($category['category'] == 'painting'){
				copy($source, $ratedImages . $category['category'] . '/' . $imageFileName);
			} else if($category['category'] == 'funny'){
				copy($source, $ratedImages . $category['category'] . '/' . $imageFileName);
			} else if($category['category'] == 'gaming'){
				copy($source, $ratedImages . $category['category'] . '/' . $imageFileName);
			} else if($category['category'] == 'wtf'){
				copy($source, $ratedImages . $category['category'] . '/' . $imageFileName);
			}
			break;
			
			
<?php 			
	case 'addimage':
		if(isset($_FILES['file1'])){
			$category = $_POST['category'];
			switch($category){
				case 'awww':
					$category = 'awww';
					break;
				case 'anime':
					$category = 'anime';
					break;
				case 'boy':
					$category = 'boy';
					break;
				case 'funny':
					$category = 'funny';
					break;
				case 'gaming':
					$category = 'gaming';
					break;
				case 'girl';
					$category = 'girl';
				break;
				case 'meme':
					$category = 'meme';
					break;
				case 'painting':
					$category = 'painting';
					break;
				case 'wtf':
					$category = 'wtf';
					break;
			}
			$file = $_FILES['file1']['tmp_name'];
			$filename = $_FILES['file1']['name'];
			$filesize = round(($_FILES['file1']['size'] / 1000000), 2, PHP_ROUND_HALF_UP);
			$fileExt = pathinfo($filename, PATHINFO_EXTENSION);
			if($fileExt == "jpg" || $fileExt == "jpeg" || $fileExt == "png"){
				$filename = random_filename($alphas).'.'.$fileExt;
				$destination = '../member/'.$username.'/large/'.$filename;
				move_uploaded_file($file, $destination);
				$isImage = getimagesize($destination); // checks if the uploaded picture is an image.
				$error_message_status = false;
				switch($_FILES['file1']['type']){
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
				$subcategory = (isset($_POST['subcategory'])) ?  $_POST['subcategory'] : $subcategory = "";
				$title = (isset($_POST['imgtitlenew'])) ? $_POST['imgtitlenew'] : $title = "";
				$vote = (isset($_POST['voteit'])) ? 1 : 0;
				image_resize($filename, $username, $old_image);
				image_resizeThumbnail($old_image, $filename, $username);
				insertImg_into_db($filename, $category, $username, $subcategory, $filesize, $vote);
			}
			/*if(isset($_POST['changedescription']) || isset($_POST['imgtitle'])){
			 $newImgDescription = $_POST['changedescription'];
			$newTitle = $_POST['imgtitle'];
			$filename = $_POST['imagename'];
			update_img_description($newImgDescription, $filename, $newTitle);
			}*/
		}
		break;
		
?>
		
		<ul class="dropdown-menu">
			<div class="row-fluid send-message-textarea-container">
														<div class="span12">
														
															<textarea class="send-message-textarea"></textarea><br>
															<button class="btn btn-mini "><strong>Send message</strong></button>
															<strong><span class="profilex-message-counter"></span></strong>
															
														</div>
													</div>
												</ul>
												
												
												
<ul class="test">
	<li><a href="#" class="test1"></a></li>
</ul>
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
						$search_result_array = array();
						if(!empty($members)){
							foreach($members as $member){
								if(($member['user_id'] == $_SESSION['user_id']) || ($member['anonymous'] == 1) || ($_SESSION['age'] < $member['pref_age_min']) || ($_SESSION['age'] > $member['pref_age_max']) || ($member['appearoffline'] == 1)){
									continue;
								} else if(($member['pref_gender'] == "Female") || ($member['pref_gender'] == "Male")) {
									if($member['pref_gender'] != $_SESSION['gender']){
										continue;
									} else {
										array_push($search_result_array, $member);
									}
								} else {
									array_push($search_result_array, $member);
								}
							}
						}
						break;
					case 'one':
						if(!empty($members)){
							foreach($members as $member){
								if(($member['username'] == $_SESSION['username']) || ($member['anonymous'] == 1) || ($_SESSION['age'] < $member['pref_age_min']) || ($_SESSION['age'] > $member['pref_age_max']) || ($member['appearoffline'] == 1)){
									continue;
								} else if($member['pref_gender'] != "Both") {
									if($member['pref_gender'] != $_SESSION['gender']){
										continue;
									} else {
										$timeoffline = time() - strtotime($member['timestamp']);
										if(($timeoffline < 86400)){
											array_push($search_result_array, $member);
										}
									}
								} else {
									$timeoffline = time() - strtotime($member['timestamp']);
									if(($timeoffline < 86400)){
										array_push($search_result_array, $member['username']);
									}
								}
							}
						}
						break;
					case 'three':
						foreach($members as $member){
							if(($member['username'] == $_SESSION['username']) || ($member['anonymous'] == 1) || ($_SESSION['age'] < $member['pref_age_min']) || ($_SESSION['age'] > $member['pref_age_max']) || ($member['appearoffline'] == 1)){
								continue;
							} else if($member['pref_gender'] != "Both") {
								if($member['pref_gender'] != $_SESSION['gender']){
									continue;
								} else {
									$timeoffline = time() - strtotime($member['timestamp']);
									if(($timeoffline > 86401) && ($timeoffline < 259200)){
										array_push($search_result_array, $member);
									}
								}
							} else {
								$timeoffline = time() - strtotime($member['timestamp']);
								if(($timeoffline > 86401) && ($timeoffline < 259200)){
									array_push($search_result_array, $member);
								}
							}
						}
						break;
					case 'seven':
						foreach($members as $member){
							if(($member['username'] == $_SESSION['username']) || ($member['anonymous'] == 1) || ($_SESSION['age'] < $member['pref_age_min']) || ($_SESSION['age'] > $member['pref_age_max'])){
								continue;
							} else if($member['pref_gender'] != "Both") {
								if($member['pref_gender'] != $_SESSION['gender']){
									continue;
								} else {
									$timeoffline = time() - strtotime($member['timestamp']);
									if(($timeoffline > 259201) && ($timeoffline < 604800)){
										array_push($search_result_array, $member);
									}
								}
							} else {
								$timeoffline = time() - strtotime($member['timestamp']);
								if(($timeoffline > 259201) && ($timeoffline < 604800)){
									array_push($search_result_array, $member);
								}
							}
						}
						break;
					case 'thirty':
						foreach($members as $member){
							if(($member['username'] == $_SESSION['username']) || ($member['anonymous'] == 1) || ($_SESSION['age'] < $member['pref_age_min']) || ($_SESSION['age'] > $member['pref_age_max'])){
								continue;
							} else if($member['pref_gender'] != "Both") {
								if($member['pref_gender'] != $_SESSION['gender']){
									continue;
								} else {
									$timeoffline = time() - strtotime($member['timestamp']);
									if(($timeoffline > 604801) && ($timeoffline < 2592000)){
										array_push($search_result_array, $member);
									}
								}
							} else {
								$timeoffline = time() - strtotime($member['timestamp']);
								if(($timeoffline > 604801) && ($timeoffline < 2592000)){
									array_push($search_result_array, $member);
								}
							}
						}
						break;
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
				
				
											<div class="row-fluid">
								<div class="span12">
								
									<legend class="span11">
									<strong><small>Search function criteria</small></strong>
										<i class="icon-question-sign contact-information" rel="tooltip" title="This will prevent the search functions to include you in the result 
										list if the member that is searching does not meet your criteria e.g if you only want members living in Sweden to find you through the search function you type Sweden in country."></i>
									</legend>
									
									<select class="span2" id="search-criteria-gender">
									
										<?php if(!empty($profile_info['pref_gender'])){
										
											if($profile_info['pref_gender'] == "Female"){ ?>
											
												<option value="<?php echo $profile_info['pref_gender']; ?>" selected="selected"><?php echo $profile_info['pref_gender']; ?></option>
												<option value="Both">Both</option>
												<option value="Male">Male</option>
										
											<?php } else if($profile_info['pref_gender'] == "Male") { ?>
											
												<option value="<?php echo $profile_info['pref_gender']; ?>" selected="selected"><?php echo $profile_info['pref_gender']; ?></option>
												<option value="Both">Both</option>
												<option value="Female">Female</option>
											
											<?php } else if($profile_info['pref_gender'] == "Both") {?>
											
												<option value="<?php echo $profile_info['pref_gender']; ?>" selected="selected">Both</option>
												<option value="Female">Female</option>
												<option value="Male">Male</option>
												
											<?php }} else {?>
											
												<option value="" selected="selected" disabled="disabled">Gender</option>
												<option value="Both">Both</option>
												<option value="Female">Female</option>
												<option value="Male">Male</option>
										
											<?php }?>
									</select>
									
									<select class="span2" id="search-criteria-agemin" class="age-min">
										<?php if(!empty($profile_info['pref_age_min'])){?>
											
											<option value="<?php echo $profile_info['pref_age_min']; ?>" selected="selected" disabled="disabled"><?php echo $profile_info['pref_age_min']; ?></option>
										
										<?php } else { ?>
										
											<option value="" selected="selected" disabled="disabled">Age min</option>
										
										<?php }
										
										for($i = 18; $i <= 99; $i++){?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
										<?php }?>
									</select>
									
									<select class="span2" id="search-criteria-agemax" class="age-max">
										
										<?php if(!empty($profile_info['pref_age_max'])){?>
											
											<option value="<?php echo $profile_info['pref_age_max']; ?>" selected="selected" disabled="disabled"><?php echo $profile_info['pref_age_max']; ?></option>
										
										<?php } else { ?>
										
											<option value="" selected="selected" disabled="disabled">Age max</option>
										
										<?php }?>
										
										<?php for($i = 18; $i <= 99; $i++){?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
										<?php }?>
									</select>
									
									<button class="btn btn-small btn-info pref-buttons-style" id="save-search-criteria" data-username="<?php echo $_SESSION['username']; ?>"><strong>Save</strong></button>
									
								</div>
							</div>