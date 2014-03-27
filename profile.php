<?php
	include('view/header.php');
	include('utility/main.php');
?>
<span class="insert-profile">
	<?php if(!$_SESSION['user_true']){?>
		
		<span id="user_id" data-user_id="<?php echo $_SESSION['userx_id']; ?>"></span>
		
<?php } else {?>

		<span id="user_id" data-user_id="<?php echo $_SESSION['user_id']; ?>"></span>
		
	<?php }?>
	<div class="row">
		<div class="span12" id="firstRowProfile">
			<div class="row-fluid">
			
				<div id="sidebar" class="span3">
					<div class="row-fluid">
						
						<div class="span12"  id="temporaryborder1">
							<div class="row-fluid">
													
													
							<div class="row-fluid">
								<div class="span12">
								
									<div class="span8"  id="username">
										<h4><strong><?php echo $profile_info['username']; ?></strong></h4>
									</div>
									<div class="span4 indicator-container">
									
										<?php if($profile_info['appearoffline'] == 0){?>
										
										<p><h6 id="online-indicator" ><strong>Online</strong></h6></p>
										<p><h6 id="offline-indicator" class="online-indicator"><strong>Offline</strong></h6></p>
										
										<?php } else { ?>
										
										<p><h6 id="online-indicator" class="online-indicator" ><strong>Online</strong></h6></p>
										<p><h6 id="offline-indicator"><strong>Offline</strong></h6></p>
										
										<?php }?>
									</div>
									
								</div>
							</div>
								
								
							<div class="row-fluid">	
								<div class="span12" id="profile-image-outer">
									<span id="insert-profile-image">
									
										<?php if(!empty($profile_info['profileimg'])){ ?>
										
											<div id="profile-image-inner">
												<img src="../member/<?php echo $_SESSION['user_id']; ?>/files/<?php echo $profile_info['profileimg']; ?>" />
											</div>
											
										<?php } else { ?>
										
											<div id="profile-image-inner">
												<img src="assets/photo_placeholder.jpg" />
											</div>
											
										<?php }?>
										
									</span>
								</div>
							</div>
							
						</div>
					</div>
						
					<div class="row-fluid">
						<div class="span12" id="memberstats-outer">
							<div class="row-fluid">
								<div class="span12" id="memberstats-inner">
									<strong id="total-likes-design">Total likes: <?php echo $profile_info['total_likes']; ?></strong><br>
									<strong>Total score: <?php echo $profile_info['total_score']; ?></strong><br>
									<strong>Bandwidth used: <?php echo $totalstorage[1]; ?></strong><br>
									<strong>Total storage: <?php echo $totalstorage[0]; ?></strong>
								</div>
							</div>
						</div>
					</div>
						
						<div class="row-fluid">
							<div class="span12" id="browse-filelist-outer">
								
								<div class="row-fluid">
									<div class="span12" >
										<a href="#add-images" id="add-images-button" class="btn btn-success" data-toggle="modal"><strong><i class="icon-plus icon-white"></i>&nbspAdd images</strong></a>
									</div>
								</div>
								
							</div>
						</div>
						
						<div class="span12" id="advertisement-outer">
							<div class="hero-unit" id="advertisement-inner">
								<h5>Placeholder</h5>
							</div>	
						</div>	
					</div>
				</div>
				
	<!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! Profile NavBar !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
	
				<div class="span9" id="mainwindow-outer-nav">
					<div class="row-fluid">
						<div class="span12 mainwindow-header-nav">
							<div class="container">
								<div class="nav-collapse collapse">
									<ul class="nav nav-pills profilenav" id="profilenav">
										<li<?php if(!$profile_messages && !$profile_friends){?> class="active"<?php }?>><a href="javascript:void(0);"<?php if($profile_messages || $profile_friends){?> class="profile-gallery"<?php }?>><strong>Gallery</strong></a></li>
										<li><a href="#" class="profile-comments"><strong>Comments</strong></a></li>
										 <li<?php if($profile_messages){?> class="active"<?php }?>><a href="javascript:void(0);" class="profile-messages<?php if($profile_messages){?> done<?php }?>"><strong>Messages</strong></a></li>
										 <li<?php if($profile_friends){?> class="active"<?php }?>><a href="#" class="profile-friends<?php if($profile_friends){?> done<?php }?>"><strong>Friends</strong></a></li>
										 <li><a href="#" class="profile-search"><strong>Search</strong></a></li>
										 <li><a href="#" class="profile-preferences"><strong>Preferences</strong></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				
	<!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! Navbar ends !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
	
	<div class="span9" id="profilecontent"> <!-- Main container profile -->
		<div class="row-fluid" id="profilecontent-inner1">
			<div class="span12">
			
			<!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! GALLERY STARTS !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
				
			<div class="page">

				<?php if(!$profile_messages && !$profile_friends){?>
				<div class="row-fluid" id="image-bar">
					<div class="span12">
								
								<div class="span11">
									<ul class="nav nav-tabs gallery-nav">
										<li class="active"><a href="javascript:void(0);"><strong><small>All</small></strong></a></li>
										<li><a href="javascript:void(0);" class="gallery-nav-rated"><strong><small>Rated</small></strong></a></li>
										<li><a href="javascript:void(0);" class="gallery-nav-album"><strong><small>Albums</small></strong></a></li>
										<li><a href="javascript:void(0);" class="gallery-nav-favourites"><strong><small>Favourites</small></strong></a></li>
									</ul>
								</div>
								

						</div>
					</div>
			
					<div class="page1">
						<div class="row-fluid" id="image-container">
							<div class="span12">
							
							<span class="page11">
							
							<span id="insert-new-images"></span>
							
							<?php if($image_count[0] > 25){
							
								$image_array_length = 25;
								
							} else {

								$image_array_length = $image_count[0];
							}

							for($i = 0; $i < ($image_array_length); $i++){ ?>
							
								<span class="gallery<?php echo $images[$i]['image_id']; ?>">
								
									<div class="row-fluid profile-gallery-image-container all-profile-image-containers nailthumbs">
										<div class="span12">
									
										<a href="#<?php echo $images[$i]['image_id']; ?>" class="image-tooltip<?php echo $images[$i]['image_id']; ?> generate-modal-comment" data-user_id="<?php echo $_SESSION['user_id']; ?>" data-image_id="<?php echo $images[$i]['image_id']; ?>" data-filename="<?php echo $images[$i]['filename']; ?>" data-toggle="modal" rel="tooltip" title="<?php echo $images[$i]['title']; ?>">
											<img src="../member/<?php echo $_SESSION['user_id']; ?>/thumbnail/<?php echo $images[$i]['filename']; ?>" class="profile-gallery-image" /></a>
											

										
										<?php if($images[$i]['vote'] == 1){?>
											
											<div class="image-options">
											
												<div class="dropdown">
													<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog icon-white"></i></a>
														<ul class="dropdown-menu">
															<li><a href="#" class="make-profile-image" data-filename="<?php echo $images[$i]['filename']; ?>">Profile image</a></li>
														</ul>
												</div>
																	
							
											</div>			
											
											<?php } else { ?>
									
											<div class="image-options">
									
												<div class="dropdown">
													<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-ok icon-white"></i></a>
														<ul class="dropdown-menu">
															<li><a href="#" class="change-image-state" data-image_state="1" data-image_id="<?php echo $images[$i]['image_id']; ?>">Public</a></li>
															<li><a href="#" class="change-image-state" data-image_state="2" data-image_id="<?php echo $images[$i]['image_id']; ?>">Friend</a></li>
															<li><a href="#" class="change-image-state" data-image_state="3" data-image_id="<?php echo $images[$i]['image_id']; ?>">Private</a></li>
														</ul>
												</div>
											</div>
											
											<div class="image-options2">
																	
												<div class="dropdown">
													<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog icon-white"></i></a>
														<ul class="dropdown-menu">
															<li><a href="#" class="make-profile-image" data-filename="<?php echo $images[$i]['filename']; ?>">Profile image</a></li>
														</ul>
												</div>
												
											</div>
											
											<?php }?>
																		
										<div class="permission-indicator">
										
											<?php if($images[$i]['state'] == 1){?>
												<img class="<?php echo $images[$i]['image_id']; ?>" src="assets/green-dot.png" />
											<?php } else if($images[$i]['state'] == 2){?>
												<img class="<?php echo $images[$i]['image_id']; ?>" src="assets/yellow-dot.png" />
											<?php } else {?>
												<img class="<?php echo $images[$i]['image_id']; ?>" src="assets/red-dot.png" />
											<?php }?>
											
										</div>
										
										
										<div class="delete-image">
											<a href="javascript:void(0);" class="delete-image-button" data-filename="<?php echo $images[$i]['filename']; ?>" data-image_id="<?php echo $images[$i]['image_id']; ?>"><img src="../assets/imgsource/buttons/red-cross-md.png" /></a>
										</div>
									</div>
								</div>
								
								</span>
								
								<?php }?>
							</span>
							
							<?php
							
							$image_pages = $image_count[0]/25;
							
							if($image_pages >= 1){
							
							for($i = 2; $i <= ($image_pages + 1); $i++){?>
								
								<span class="page11">
									<span class="image-page<?php echo $i;?>">
								
									</span>
								</span>
								
							<?php } ?>
								<div class="pagination pagination-mini pagination-centered">
									<ul class="profile-gallery-subnav">
										<?php for($i = 1; $i <= ($image_pages + 1); $i++){ ?>
											<li class="<?php if($i == 1){?>active<?php }?>"><a href="javascript:void(0);" class="profile-gallery-next-page-all<?php if($i == 1){?> done<?php } ?>" 
												data-current_page="<?php echo $i; ?>"><?php echo $i; ?></a></li>
										<?php } ?>
									</ul>
								</div>
							<?php } ?>
								
							</div>
						</div>
					</div>
					
					<div class="page1"> <!-- Rated images -->
						<span id="gallery-rated">
							
						</span>
					</div>
					
					<div class="page1">
						<div class="row-fluid">
							<div class="span12">
								Under construction
							</div>
						</div>
					</div>
					
					<div class="page1">
						<span id="gallery-favourites">
							
						</span>
					</div>
					
					<div class="page1">
						<span id="add-image-form">
						
						</span>
					</div>
					
					<?php } else { ?>
					
					<span id="insert-profile-gallery">
					
						
				
					</span>
						
					
					<?php }?>
			</div>
	
			<div class="page">
			
				<span id="comments-content">
				
				</span>
			</div>
	
					
			<div class="page">
			
				<?php if($profile_messages){?>
			
				<span id="message-page-exists" data-messageexists="yes"></span>
					<div class="row-fluid">
						<div class="span12">
											
							<div class="row-fluid">
								<div class="span11">
									<ul class="nav nav-tabs messages-nav">
										<li class="active"><a href="javascript:void(0);"><strong>Inbox</strong></a></li>
										<li><a href="javascript:void(0);"><strong>Sent</strong></a></li>
									</ul>
								</div>
							</div>
													
													
							<div class="page4">
										
								<div class="row-fluid">
									<div class="span12">
									
									<span class="page8">
											<?php if(isset($message_list[0][0]['message_state'])){?>
											
										<table class="table table-hover" id="revolver-inbox">
											<thead>
												<td id="profile-message-indicator"></td>
												<td id="profile-message-space">Message</td>
												<td id="profile-message-name-space">From</td>
												<td>Date/Time</td>
											</thead>
											
										<?php if($array_length_inbox > 17){
					
												$array_length_inbox_iterate = 17;
											
											} else {
												
												$array_length_inbox_iterate = $array_length_inbox;
					
											}
					
											for($i = 0; $i < $array_length_inbox_iterate; $i++){
											
												if($message_list[0][$i]['recip_copy'] == 0){
													continue;
												} else {?>
												
												<tr class="table-row<?php echo $message_list[0][$i]['message_id']; ?>">
												
												<?php if($message_list[0][$i]['message_state'] == 0){ ?>
												
													<td class="extend-new-message" id="<?php echo $message_list[0][$i]['message_id']; ?>extend-message">
													
														<a href="javascript:void(0);" class="onclickmessage" data-messageid="<?php echo $message_list[0][$i]['message_id']; ?>"><strong class="profile-extend-message">+</strong></a>
													
													</td>
													
													<td class="table-data-string">
													
														<?php if(strlen($message_list[0][$i]['message']) >= 54){?>
												
															<span id="substring-message<?php echo $message_list[0][$i]['message_id']; ?>">
														
																<p class="comments-layout" id="strong<?php echo $message_list[0][$i]['message_id']; ?>"><strong><?php echo substr($message_list[0][$i]['message'], 0, 54); ?>...</strong></p>
														
													
															</span>
													
														<?php } else { ?>
												
															<span id="substring-message<?php echo $message_list[0][$i]['message_id']; ?>">
														
																<p class="comments-layout" id="strong<?php echo $message_list[0][$i]['message_id']; ?>"><strong><?php echo $message_list[0][$i]['message']; ?></strong></p>
					
															</span>
													
														<?php }?>
													
													
												<?php } else { ?>
												
													<td id="profile-message-indicator">
												
														<a href="javascript:void(0);" class="extend-message" data-messageid="<?php echo $message_list[0][$i]['message_id']; ?>"><strong class="profile-extend-message">+</strong></a>
													
												
													</td>
												
													<td class="table-data-string">
													
														<?php if(strlen($message_list[0][$i]['message']) >= 54){?>
												
															<span id="substring-message<?php echo $message_list[0][$i]['message_id']; ?>">
														
																<p class="comments-layout"><?php echo substr($message_list[0][$i]['message'], 0, 54); ?>...</p>
														
													
															</span>
													
														<?php } else { ?>
												
															<span id="substring-message<?php echo $message_list[0][$i]['message_id']; ?>">
														
																<p class="comments-layout"><?php echo $message_list[0][$i]['message']; ?></p>
					
															</span>
													
														<?php }?>
												
												<?php }?>
												
													<span class="complete-message" id="complete-message<?php echo $message_list[0][$i]['message_id']; ?>">
													
														<p class="comments-layout"><?php echo $message_list[0][$i]['message']; ?></p>
														
														<br>
													
												<?php if($message_list[0][$i]['user_id'] != 23){?>
												
														<textarea class="message-reply-container" id="message-reply-container<?php echo $message_list[0][$i]['message_id']; ?>"></textarea>
					
														<br><button class="btn btn-mini submit-message-reply" data-messageid="<?php echo $message_list[0][$i]['message_id']; ?>" data-userx_id="<?php echo $message_list[0][$i]['user_id'];?>" 
															data-recipient="<?php echo $message_list[0][$i]['author']; ?>"><strong>submit</strong></button>
																	
														&nbsp;<span class="the-dot"> &#8226;</span>&nbsp; <strong><span id="message-container-counter<?php echo $message_list[0][$i]['message_id']; ?>"></span></strong>
												
												<?php } ?>
														
													</span>
												
												</td>
												
												<td>
												
													<a href="javascript:void(0);" class="userlink" data-userx_id="<?php echo $message_list[0][$i]['user_id']; ?>"><?php echo $message_list[0][$i]['author']; ?></a>
												
												</td>
												
												<td>
												
													<p><?php echo date("Y-m-d H:i", strtotime($message_list[0][$i]['message_timestamp'])); ?>&nbsp
													
													<a href="javascript:void(0);" id="remove-inbox<?php echo $message_list[0][$i]['message_id']; ?>" class="remove-single-inbox-message" data-messageid="<?php echo $message_list[0][$i]['message_id']; ?>" <?php if($message_list[0][$i]['message_state'] == 0){ ?>data-new_message="1"<?php } else { ?>data-new_message="0"<?php }?>><i class="icon-remove-circle"></i></a></p>
												
												</td>
											
											</tr>
											
											<script type="text/javascript">
												$('#message-reply-container<?php echo $message_list[0][$i]['message_id']; ?>').limit('500','#message-container-counter<?php echo $message_list[0][$i]['message_id']; ?>');
											</script>
											
											<?php }} ?>
											</table>
										</span>
									
											
									<?php
											$message_pages = ceil($array_length_inbox/17);
												
												if($message_pages > 1){
												
												for($i = 2; $i <= ($message_pages); $i++){?>
													
													<span class="page8">
														<span class="message-inbox-page<?php echo $i; ?>">
														</span>
													</span>
													
												<?php } ?>
									
													<div class="pagination pagination-mini pagination-centered">
														<ul class="profile-message-nav">
															<?php for($i = 1; $i <= ($message_pages + 1); $i++){ ?>
																<li class="<?php if($i == 1){?>active<?php }?>"><a href="javascript:void(0);" class="profile-message-next-page<?php if($i == 1){?> done<?php } ?>" data-current_page="<?php echo $i?>"><?php echo $i; ?></a></li>
															<?php } ?>
														</ul>
													</div>
											
												<?php }} else {?>
										<table class="table table-hover" id="revolver-sent">
											<thead>
												<td id="profile-message-indicator"></td>
												<td id="profile-message-space">Message</td>
												<td id="profile-message-name-space">To</td>
												<td>Date/Time</td>
											</thead>
											
											<tr></tr>
											
											</table>
											<?php  } ?>
										
									</div>
								</div>					
													
							</div>
							
							
							
							<div class="page4">
							
								<div class="row-fluid">
									<div class="span12">
									
									<span class="page9">
											
											<?php if(isset($message_list[1][0]['message_state'])){?>
											
											<table class="table table-hover" id="revolver-sent">
											<thead>
												<td id="profile-message-indicator"></td>
												<td id="profile-message-space">Message</td>
												<td id="profile-message-name-space">To</td>
												<td>Date/Time</td>
											</thead>
											
											<?php
											
											if($array_length_send > 17){
					
												$array_length_send_iterate = 17;
											
											} else {
					
												$array_length_send_iterate = $array_length_send;
					
											}
											
											 for($i = 0; $i < $array_length_send_iterate; $i++){ 
											
												if($message_list[1][$i]['author_copy'] == 0){
													continue;
												} else {?>
											
											<tr class="table-row<?php echo $message_list[1][$i]['message_id']; ?>">
												
												<?php if(strlen($message_list[1][$i]['message']) >= 54){?>
												
													<td id="profile-message-indicator">
													
														<a href="javascript:void(0);" class="extend-message" data-messageid="<?php echo $message_list[1][$i]['message_id']; ?>"><strong class="profile-extend-message">+</strong></a>
													
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
												
													<a href="javascript:void(0);" class="userlink" data-author="<?php echo $message_list[1][$i]['userx_id']; ?>"><?php echo $message_list[1][$i]['recip']; ?></a>
												
												</td>
												
												<td>
												
													<p><?php echo date("Y-m-d H:i", strtotime($message_list[1][$i]['message_timestamp'])); ?><a href="javascript:void(0);" class="remove-single-sent-message" data-messageid="<?php echo $message_list[1][$i]['message_id']; ?>">&nbsp<i class="icon-remove-circle"></i></a></p>
												
												</td>
											
											</tr>
											<?php }} ?>
											
											</table>
											
											</span>
											
											<?php
											
												$message_sent_pages = ceil($array_length_send/17);
												
												if($message_sent_pages > 1){
												
												for($i = 2; $i <= ($message_sent_pages); $i++){?>
													
													<span class="page9">
														<span class="message-sent-page<?php echo $i;?>">
															<span class="vardump">
															
															</span>
														</span>
													</span>
													
												<?php } ?>
												
													<div class="pagination pagination-mini pagination-centered">
													
														<ul class="profile-message-sent-nav">
															<?php for($i = 1; $i <= ($message_sent_pages + 1); $i++){ ?>
																<li class="<?php if($i == 1){?>active<?php }?>"><a href="javascript:void(0);" class="profile-message-sent-next-page<?php if($i == 1){?> done<?php } ?>" data-current_page="<?php echo $i?>"><?php echo $i; ?></a></li>
															<?php } ?>
														</ul>
														
													</div>
													
												<?php } ?>
					
											<?php } else {?>
											
										<table class="table table-hover" id="revolver-sent">
											<thead>
												<td id="profile-message-indicator"></td>
												<td id="profile-message-space">Message</td>
												<td id="profile-message-name-space">To</td>
												<td>Date/Time</td>
											</thead>
											
											<tr></tr>
											
											</table>
											<?php  }?>
										
									</div>
								</div>		
							
							
							</div>
												
												
						</div>
					</div>
			
			<?php } else {?>
			
				<span id="profile-messages-container">
				
				
				</span>
				
			<?php }?>
				
			</div>
	
				<div class="page">
					<span id="friends-content">
					
					<?php if($profile_friends){?>
					
					<div class="row-fluid">
						<div class="span12">
						
						<?php if((!isset($friends[0][0]['state'])) && (!isset($friends[1][0]['state'])) && (!isset($friends[2][0]['state']))){?>
						
							<p>No contacs, requests or blocked users available</p>
						
						<?php } else {
							
							
								if(isset($friends[0][0]['state'])){
									
								$arrayLengthFriends = count($friends[0]) - 1; ?>
								
								<div class="row-fluid">
									<div class="span12">
						
								<legend class="span11" id="profile-friend-legends"><strong><small>Friends</small></strong></legend>
								
									<div class="span12" id="profile-friend-leftcolumn">
										<table class="table table-condensed table-hover">
											<thead>
												<td><strong><small>Username</small></strong></td>
												<td id="profile-friend-message-icon"></td>
												<td id="profile-friend-message-textarea"></td>
												<td><strong><small>Status</small></strong></td>
												<td><strong><small>Permission&nbsp<i class="icon-question-sign" rel="tooltip" title="Permission for viewing your images."></i></small></strong></td>
											</thead>
									
											<?php for($i = 0; $i <= $arrayLengthFriends; $i++){?>
												
												<tr class="search-result-header relation_id<?php echo $friends[0][$i]['userx_id']; ?>">
													<td id="profile-friends-friends-td">
													
													<p class="display-inline-block" id="profile-friends-content-text"><a href="javascript:void(0);" class="userlink" data-userx_id="<?php echo $friends[0][$i]['userx_id']; ?>"><strong><?php echo $friends[0][$i]['username']; ?></strong></a></p>
													
													</td>
													
					
														
													<td>
															<p id="profile-friends-content-text"><a href="javascript:void(0);" class="btn btn-mini friend-show-message-box" data-user_id="<?php echo $friends[0][$i]['userx_id']; ?>"><i class="icon-envelope"></i></a></p>
													</td>
													
													<td>
															
														<div class="row-fluid send-message-textarea-container hide-message-box<?php echo $friends[0][$i]['userx_id']; ?>">
															<div class="span12">
															
																<textarea class="message-textarea<?php echo $friends[0][$i]['userx_id']; ?> profile-friend-message-container"></textarea><br>
																<button class="btn btn-mini send-message-friends" data-recipient="<?php echo $friends[0][$i]['userx_id']; ?>" data-usernamex="<?php echo $friends[0][$i]['username']; ?>"><strong>Send message</strong></button>
																&nbsp;<span class="the-dot"> &#8226;</span>&nbsp;&nbsp;<strong><span id="profile-friend-message-counter<?php echo $friends[0][$i]['userx_id']; ?>"></span></strong>
																	
															</div>
														</div>
																
														<script type="text/javascript">
															$('.message-textarea<?php echo $friends[0][$i]['userx_id']; ?>').limit('500','#profile-friend-message-counter<?php echo $friends[0][$i]['userx_id']; ?>');
														</script>
														
													</td>
													
												<?php if(($friends[0][$i]['online'] == 1) && ($friends[0][$i]['appearoffline'] == 0)){?>
												
													<td id="profile-friends-friends-td"><p id="profile-friends-content-text">Online</p></td>
													
												<?php } else {?>
												
													<td id="profile-friends-friends-td"><p id="profile-friends-content-text">Offline</p></td>
													
												<?php }?>
												
													<td id="profile-friends-friends-td">
													<?php if($friends[0][$i]['permission'] == 1){?>
													
														<select class="permission" id="profile-friends-permission" data-userx_id="<?php echo $friends[0][$i]['userx_id']; ?>">
															<option value="1" selected="selected">Public</option>
															<option value="2">Friends</option>
															<option value="3">Private</option>
														</select>
													
													<?php } else if($friends[0][$i]['permission'] == 2) { ?>
													
														<select class="permission" id="profile-friends-permission" data-userx_id="<?php echo $friends[0][$i]['userx_id']; ?>">
															<option value="2" selected="selected">Friends</option>
															<option value="1">Public</option>
															<option value="3">Private</option>
														</select>
													
													<?php } else { ?>
													
														<select class="permission" id="profile-friends-permission" data-userx_id="<?php echo $friends[0][$i]['userx_id']; ?>">
															<option value="3" selected="selected">Private</option>
															<option value="1">Public</option>
															<option value="2">Friends</option>
														</select>
														
													<?php }?>
													
													&nbsp&nbsp
													
													<a href="javascript:void(0);" class="profile-friends-remove-friend" data-userx_id="<?php echo $friends[0][$i]['userx_id']; ?>" rel="tooltip" title="Remove friend."><i class="icon-remove-circle"></i></a>
													
													</td>
												
												</tr>
					
											<?php }?>
										
										</table>	
									</div>
										</div>
									</div>
								<?php }?>
								
									
							<?php if(isset($friends[1][0]['state'])){
							
								$arrayLengthRequests = count($friends[1]); ?>
								
								<div class="row-fluid">
									<div class="span12">
						
							<legend class="span11" id="profile-friend-legends"><strong><small>Friend requests</small></strong></legend>
								
									<div class="span6" id="profile-friend-leftcolumn">
										<table class="table table-condensed table-hover">
											<thead>
												<td><strong><small>Username</small></strong></td>
												<td><strong><small>Online</small></strong></td>
												<td><strong><small>Options</small></strong></td>
											</thead>
									
											<?php for($i = 0; $i < $arrayLengthRequests/2; $i++){?>
											
												
												<tr class="friend-request-color<?php echo $friends[1][$i]['user_id']; ?> remove-request<?php echo $friends[1][$i]['user_id']; ?>">
												
												
													<td>
													
													<?php if(($friends[1][$i]['userx_id'] == $_SESSION['user_id']) && ($friends[1][$i]['affected'] == 1)){?>
													
														<p class="display-inline-block" id="profile-friends-content-text"><a href="javascript:void(0);" class="userlink" data-userx_id="<?php echo $friends[1][$i]['user_id']; ?>"><?php echo $friends[1][$i]['request_username']; ?></a></p>
														
													<?php } else {?>
													
														<p class="display-inline-block" id="profile-friends-content-text"><a href="javascript:void(0);" class="userlink" data-userx_id="<?php echo $friends[1][$i]['user_id']; ?>"><?php echo $friends[1][$i]['request_username']; ?></a></p>
													
													<?php }?>								
													
													</td>
													
												<?php if(($friends[1][$i]['online'] == 1) && ($friends[1][$i]['appearoffline'] == 0)){?>
												
													<td id="profile-friend-request-container"><p id="profile-friends-content-text">Online</p></td>
													
												<?php } else {?>
												
													<td id="profile-friend-request-container"><p id="profile-friends-content-text">Offline</p></td>
													
												<?php }?>
												
												<td id="profile-friend-request-options" class="specific-request<?php echo $friends[1][$i]['user_id']; ?>">
												
												<?php if((($friends[1][$i]['userx_id'] == $_SESSION['user_id']) && ($friends[1][$i]['affected'] == 1))){?>
												
													<a href="#" class="friend-request-option" data-user_id="<?php echo $friends[1][$i]['user_id']; ?>" data-choice="1"><i class="icon-ok-circle" rel="tooltip" title="Accept request"></i></a>&nbsp&nbsp
													<a href="#" class="friend-request-option" data-user_id="<?php echo $friends[1][$i]['user_id']; ?>" data-choice="2"><i class="icon-remove-circle" rel="tooltip" title="Deny request"></i></a>&nbsp&nbsp
													<a href="#" class="friend-request-option" data-user_id="<?php echo $friends[1][$i]['user_id']; ?>" data-choice="3"><i class="icon-ban-circle" rel="tooltip" title="Block user"></i></a>
																	
											<?php } else {?>
													
													<a href="#" class="remove_friend_request" data-user_id="<?php echo $friends[1][$i]['user_id']; ?>"><i class="icon-remove-circle" rel="tooltip" title="Remove request"></i></a>
													
											<?php }?>
												</td>
													
												</tr>
											<?php }?>
										</table>
										
									</div>
									
										
									
									<?php if($arrayLengthRequests > 1){?>
									<div class="span6" id="profile-friend-rightcolumn">
										<table class="table table-condensed table-hover">
											<thead>
												<td><strong><small>Username</small></strong></td>
												<td><strong><small>Online</small></strong></td>
												<td><strong><small>Options</small></strong></td>
											</thead>
											
												<?php for($i = $arrayLengthRequests/2; $i < $arrayLengthRequests; $i++){?>
												
												<tr class="friend-request-color<?php echo $friends[1][$i]['user_id']; ?> remove-request<?php echo $friends[1][$i]['user_id']; ?>">
													<td>
													
													<?php if(($friends[1][$i]['userx_id'] == $_SESSION['user_id']) || ($friends[1][$i]['affected'] == 1)){?>
													
														<p class="display-inline-block" id="profile-friends-content-text"><a href="javascript:void(0);" class="userlink" data-user-id="<?php echo $friends[1][$i]['userx_id']; ?>"><?php echo $friends[1][$i]['request_username']; ?></a></p>
														
													<?php } else {?>
													
														<p class="display-inline-block" id="profile-friends-content-text"><a href="javascript:void(0);" class="userlink" data-user-id="<?php echo $friends[1][$i]['user_id']; ?>"><?php echo $friends[1][$i]['request_username']; ?></a></p>
													
													<?php }?>	
													
													
													</td>
													
												<?php if(($friends[1][$i]['online'] == 1) && ($friends[1][$i]['appearoffline'] == 0)){?>
												
													<td id="profile-friend-request-container"><p id="profile-friends-content-text">Online</p></td>
													
												<?php } else {?>
												
													<td id="profile-friend-request-container"><p id="profile-friends-content-text">Offline</p></td>
													
												<?php }?>
												
												
												<td id="profile-friend-request-options" class="specific-request<?php echo $friends[1][$i]['user_id']; ?>">
												
												<?php if((($friends[1][$i]['userx_id'] == $_SESSION['user_id']) && ($friends[1][$i]['affected'] == 1))){?>
												
													<a href="#" class="friend-request-option this<?php echo $friends[1][$i]['user_id']; ?>" data-user_id="<?php echo $friends[1][$i]['user_id']; ?>" data-choice="1"><i class="icon-ok-circle" rel="tooltip" title="Accept request"></i></a>&nbsp&nbsp
													<a href="#" class="friend-request-option this<?php echo $friends[1][$i]['user_id']; ?>" data-user_id="<?php echo $friends[1][$i]['user_id']; ?>" data-choice="2"><i class="icon-remove-circle" rel="tooltip" title="Deny request"></i></a>&nbsp&nbsp
													<a href="#" class="friend-request-option this<?php echo $friends[1][$i]['user_id']; ?>" data-choice="3"><i class="icon-ban-circle" rel="tooltip" title="Block user"></i></a>
																	
												<?php } else {?>
													
													<a href="#" class="remove_friend_request" data-user_id="<?php echo $friends[1][$i]['user_id']; ?>"><i class="icon-remove-circle" rel="tooltip" title="Remove request"></i></a>
													
											<?php }?>
												</td>
												
												</tr>
												
											<?php }?>
											
											
											</table>
										<?php }?>
									
											</div>
										</div>
									</div>
									<?php }?>
									
							<?php if(isset($friends[2][0]['state'])){
							
								$arrayLengthBlocked = count($friends[2]) - 1; ?>
								
							<div class="row-fluid">
								<div class="span12">
						
								<legend class="span11" id="profile-friend-legends"><strong><small>Blocked users</small></strong></legend>
								
									<div class="span6" id="profile-friend-leftcolumn">
										<table class="table table-condensed table-hover">
											<thead>
												<td><strong><small>Username</small></strong></td>
												<td></td>
												<td></td>
											</thead>
									
											<?php for($i = 0; $i <= $arrayLengthBlocked/2; $i++){?>
											
												<tr class="remove-block<?php echo $friends[2][$i]['userx_id']; ?> error">
												
													<td><p id="profile-friends-content-text"><?php echo $friends[2][$i]['username']; ?></p></td>
												
													<td><a href="#" class="profile-friend-remove-block" data-userx_id="<?php echo $friends[2][$i]['userx_id']; ?>"><i class="icon-remove-circle" rel="tooltip" title="Remove block"></i></a></td>
									
												</tr>		
																
											<?php }?>
										
										</table>
									</div>
										
								<?php if($arrayLengthBlocked >= 1){?>
										
									<div class="span6" id="profile-friend-rightcolumn">
										<table class="table table-condensed table-hover">
											<thead>
												<td><strong><small>Username</small></strong></td>
												<td><strong><small>Online</small></strong></td>
												<td><strong><small>Unblock</small></strong></td>
											</thead>
											
												<?php for($i = $arrayLengthBlocked/2; $i <= $arrayLengthBlocked; $i++){?>
												
												<tr>
													<td><p id="profile-friends-blocked-text"><?php echo $friends[2][$i]['username']; ?></p></td>
												
												<td><i class="icon-remove-circle" rel="tooltip" title="Remove block"></i></td>
												
												<td>
												<a href="#" class="profile-friend-remove-block" data-userx_id="<?php echo $friends[2][$i]['userx_id']; ?>"><i class="icon-remove-circle" rel="tooltip" title="Remove block"></i></a>
												</td>
												
												</tr>
												
											<?php }}?>
												</table>
										
											</div>
									</div>
								</div>
								<?php }?>
							<?php }?><!-- Closes else in the top -->
						
								
						</div>
					</div>
					
					<?php }?>
					
					</span>
				</div>
	
	
				<div class="page">
					<span id="search-view">
					
					</span>
				</div>
	
				<div class="page">
					<span id="profile-preferences">
					</span>
				</div>
			
				</div>
			</div>
		</div>
	</div>
</div>
	
	<!-- !!!!!!!!!!!!!!!!!!! START MODAL IMAGE UPLOAD !!!!!!!!!!!!!!!!!!!! -->
	


  	<!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! END! MODAL IMAGE UPLOAD !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
  	
  	<!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! START MODAL CREATE ALBUM !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
  	
  	
  	
  	<div class="modal hide fade" id="add-images" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
		
			<div class="row-fluid">
				<div class="span12" id="browse-filelist">
					<a id="browse-files" class="btn btn-small btn-success"><strong>Browse or Drop a file here</strong></a>
					<div id="filelist"></div>
				</div>
			</div>
			
  		</div>
  		
  		<div class="modal-footer">
  			<button id="close-upload-modal" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  		</div>
  	</div>
  	
  	
  	
  	<!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!! END MODAL CREATE ALBUM !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
  	
  	<!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!! START MODAL CREATE PROFILEIMG !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
  	
  	
  	<?php
  	
  	if(!$profile_messages && !$profile_friends){
  	
  	for($i = 0; $i <= $image_array_length; $i++){?>
  	
  	 <div class="modal hide fade profile-modal" id="<?php echo $images[$i]['image_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="image-modal-label" aria-hidden="true">
		<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove-circle"></i></button>
    			<h4 id="image-modal-label"><?php echo $images[$i]['title']; ?></h4>
  		</div>
  								
  		<div class="modal-body">
 		 	<div class="row-fluid">
				<div class="span12">
				
				<div class="span8">
					<div class="row-fluid profile-gallery-image-modal-container">
						<div class="span12">
							<img id="modal_image<?php echo $images[$i]['image_id']; ?>" class="profile-modal-image-border" src="" />
						</div>
					</div>
						
					<div class="row-fluid">
						<div class="span12" id="profile-comment-container">
					
						<div class="span10">
							<textarea class="modal-textarea<?php echo $images[$i]['image_id']; ?>" placeholder="Comment..."></textarea>
						</div>
						
						<div class="span1" id="profile-submit-counter-container">
						
							<div class="row-fluid" id="submit-button-container">
								<div class="span12">
									<a href="#" class="btn btn-small btn-info modal-comment-submit" data-image_id="<?php echo $images[$i]['image_id']; ?>"><strong>Submit</strong></a>
								</div>
							</div>
							
							<div class="row-fluid">
								<div class="span12">
									<input type="checkbox" class="private-comment<?php echo $images[$i]['image_id']; ?> priv-comment" rel="tooltip" title="Private comment" />
									<strong><span class="comment-counter<?php echo $images[$i]['image_id']; ?>"></span></strong>
								</div>
							</div>
						</div>
						
							</div>					
						</div>
					</div>
				
					<div class="span3 ">
					
						<div class="row-fluid">
							<div class="span12">
								<span class="insert-modal-comment<?php echo $images[$i]['image_id']; ?>">
								
								</span>
							</div>
						</div>
					
					</div>
				
				</div>
			</div>
    	</div>
  		
  		<div class="modal-footer">
  			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  		</div>
  	</div>
  	
  	
  	<?php }}?>
</span>
<?php include('view/footer.php'); ?>
