
<?php if($_SESSION['user_true']){?>
		
		<span id="user_id" data-user_id="<?php echo $_SESSION['user_id']; ?>"></span>
		
<?php } else {?>

		<span id="user_id" data-user_id="<?php echo $_SESSION['userx_id']; ?>"></span>
		
	<?php } ?>
	
	<div class="row">
		<div class="span12" id="firstRowProfile">
			<div class="row-fluid">
			
				<div id="sidebar" class="span3">
					<div class="row-fluid">
						
						<div class="span12"  id="temporaryborder1">
							<div class="row-fluid">								
								<div class="span12">
									<div class="span8"  id="username">
										<h4><strong><?php echo $profilex['username']; ?></strong></h4>
									</div>
									<div class="span4 indicator-container">
									
										<?php if(($profilex['online'] == 0) || ($profilex['appearoffline'] == 1)){?>
										
											<h6 id="offline-indicator"><strong><p>Offline</p></strong></h6>
										
										<?php } else { ?>
										
											<h6 id="online-indicator"><strong><p>Online</p></strong></h6>
										
										<?php }?>
									</div>
								</div>
								
				
								<div class="span12" id="profile-image-outer">
										
											<?php if(!empty($profilex['profileimg'])){ ?>
											
												<div id="profile-image-inner">
													<img src="../member/<?php echo $_SESSION['userx_id']; ?>/files/<?php echo $profilex['profileimg']; ?>" />
												</div>
												
											<?php } else { ?>
											
												<div id="profile-image-inner">
													<img src="assets/photo_placeholder.jpg" />
												</div>
												
											<?php }?>
									</div>
								
							</div>
						</div>
						
						<div class="span12" id="memberstats-outer">
							<div class="row-fluid">
								<div class="span12" id="memberstats-inner">
									<strong>Total likes: <?php echo $profilex['total_likes']; ?></strong><br>
									<strong>Total score: <?php echo $profilex['total_score']; ?></strong><br>
									<strong>Bandwidth used: <?php echo $totalstorage[1]; ?></strong><br>
									<strong>Total storage: <?php echo $totalstorage[0]; ?></strong>
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
								<div class="span3">

								<div class="nav-collapse collapse">
								
									<ul class="nav nav-pills profilenav" id="profilenav">
									
										<li class="active"><a href="javascript:void(0);" id="revolver"><strong id="revolver">Gallery</strong></a></li>
										<li><a href="javascript:void(0);" class="profile-comments"><strong id="revolver">Comments</strong></a></li>
										
										
									</ul>
									
								</div>
							</div>
								
								<div class="span6 profilex-mainnav-bar">
									
								<?php if((($profilex['message_preference'] == 1) && ($_SESSION['friendstate']['state'] == 2)) || ($profilex['message_preference'] == 0)){?>
								
									<a href="javascript:void(0);" class="btn btn-mini profilex-show-message-box" data-user_id="<?php echo $_SESSION['userx_id'];?>"><i class="icon-envelope"></i>&nbsp<span class="caret"></span></a>
										
										
										<div class="row-fluid send-message-textarea-container hide-message-box">
											<div class="span12">
											
												<textarea id="profilex-textarea" class="message-textarea<?php echo $_SESSION['userx_id']; ?>"></textarea><br>
												<button class="btn btn-mini btn-success send-message" data-user_id="<?php echo $_SESSION['userx_id']; ?>" data-usernamex="<?php echo $profilex['username']; ?>"><strong>Send message</strong></button>
												<strong><span class="profilex-message-counter"></span></strong>
											
											</div>
										</div>
										
									<?php } else { ?>
									
									<?php }?>
									
								
									</div>
								
									<div class="span2 profilex-mainnav-bar">
									
										<?php if(($_SESSION['friendstate']['state'] == 1) || ($_SESSION['friendstate']['state'] == 2) || ($_SESSION['friendstate']['state'] == 3)){?>
											<a class="btn btn-mini add-friend active done" rel="tooltip" title="This member is either already your friend, blocked or friend request is pending."><i class="icon-plus"></i><i class="icon-user"></i></a>
										<?php } else {?>
											<a class="btn btn-mini add-friend" rel="tooltip" title="Send friendrequest" data-username="<?php echo $profilex['username']; ?>"><i class="icon-plus"></i><i class="icon-user"></i></a>
										<?php }?>
								
										<?php if(empty($_SESSION['friendstate']['state'])){?>
											<a class="btn btn-mini btn-danger profilex-block-user" rel="tooltip" title="Block this member."><i class="icon-ban-circle"></i></a>
										<?php } else if(($_SESSION['friendstate']['state'] == 1) || ($_SESSION['friendstate']['state'] == 2)) {?>
											
										<?php } else {?>
											<a class="btn btn-mini btn-danger profilex-block-user active done" rel="tooltip" title="Already blocked. Block can only be removed from your friends tab."><i class="icon-ban-circle"></i></a>
										<?php }?>
										
									</div>
							
						</div>
					</div>
				</div>
				
	<!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! Navbar ends !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
	
	<div class="span9" id="profilecontent"> <!-- Main container profile -->
		<div class="row-fluid" id="profilecontent-inner1">
			<div class="span12">
			
			<!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! Gallery STARTS !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
				
			<div class="page">
					<div class="row-fluid" id="image-bar">
						<div class="span12">
								
								<div class="span10">
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
							
							<?php if($image_count[0] > 25){
							
								$image_array_length = 25;
								
							} else {

								$image_array_length = $image_count[0];
							}
							
								 for($i = 0; $i <= ($image_array_length - 1); $i++){?>
									 
									<div class="row-fluid profile-gallery-image-container all-profile-image-containers nailthumbs" id="gallery-all<?php echo $images[$i]['image_id']; ?>">
										<div class="span12">
											<a href="#<?php echo $images[$i]['image_id']; ?>" class="image-tooltip<?php echo $images[$i]['image_id']; ?> generate-modal-comment" data-image_id="<?php echo $images[$i]['image_id']; ?>" data-filename="<?php echo $images[$i]['filename']; ?>" data-user_id="<?php echo $images[$i]['user_id']; ?>" data-toggle="modal" rel="tooltip" title="<?php echo $images[$i]['title']; ?>">
												<img src="../member/<?php echo $_SESSION['userx_id']; ?>/thumbnail/<?php echo $images[$i]['filename']; ?>" class="profile-gallery-image"/></a>
												
											<script type="text/javascript">
												$('.image-tooltip<?php echo $images[$i]['image_id']; ?>').tooltip();
											</script>
											

											
										</div>
									</div>
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
											<li class="<?php if($i == 1){?>active<?php }?>">
											
											<a href="javascript:void(0);" class="profile-gallery-next-page-all<?php if($i == 1){?> done<?php } ?>" 
												data-current_page="<?php echo $i;?>"><?php echo $i; ?></a>
												
											</li>
										<?php } ?>
									</ul>
								</div>
								
							<?php } ?>
							</div>
						</div>
					</div>
					
					<div class="page1">
						<span id="gallery-rated">
						
						</span>
					</div>
					
					<div class="page1"> <!-- Rated images -->
						<span id="gallery-albums">
						
						</span>
					</div>
					
					<div class="page1">
						<span id="gallery-favourites">
						
						</span>
					</div>
					
					<div class="page1">
					</div>
			</div>
	<!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! GALLERY ENDS HERE !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
	
		
	
	<!-- !!!!!!!!!!!!!!!!!!!!! COMMENTS START !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
	
			<div class="page">
				<span id="comments-content">
				
				</span>
			</div>
	
	<!-- !!!!!!!!!!!!!!!!!!!!! COMMENTS ENDS !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
					
					</div>	 <!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!! END PROFILE NAVBAR !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
				</div>
			</div>
		</div>
	</div>
</div>

<?php for($i = 0; $i <= ($image_array_length - 1); $i++){?>
  	
  	 <div class="modal hide fade" id="<?php echo $images[$i]['image_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="image-modal-label" aria-hidden="true">
		<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove-circle"></i></button>
    			<h4 id="image-modal-label"><?php echo $images[$i]['title']; ?></h4>
  		</div>
  								
  		<div class="modal-body">
 		 	<div class="row-fluid">
				<div class="span12">
				
					<div class="span8">
						<div class="row-fluid profile-gallery-image-modal-container nailthumbs">
							<div class="span12">
								<img id="modal_image<?php echo $images[$i]['image_id']; ?>" src="" />
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
									<input type="checkbox" class="private-comment<?php echo $images[$i]['image_id']; ?>" rel="tooltip" title="Private comment" />
									<strong><small><span id="comment-counter"></span></small></strong>
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
  	
  	<?php }?>
  	
  <script type="text/javascript">
  $('.send-message-textarea-container').hide();
  $('.add-friend').tooltip();
  $('.page1:gt(0)').hide();
  $('.nailthumbs').nailthumb();
  $('.image-options').hide();
  $('.message-textarea<?php echo $_SESSION['userx_id']; ?>').limit('500','.profilex-message-counter');
  </script>
