<?php
foreach($images as $image){ ?>

	<?php if($_SESSION['user_id'] != $image['user_id']){?>
		 
		<span class="gallery<?php echo $image['image_id']; ?>">
			<div class="row-fluid all-profile-image-containers profile-gallery-image-container nailthumbs-next<?php echo $current_page; ?>">
			
				<div class="span12">
				
				<a href="#<?php echo $image['image_id']; ?>" class="image-tooltip<?php echo $image['image_id']; ?> generate-modal-comment" data-image_id="<?php echo $image['image_id']; ?>" data-user_id="<?php echo $image['user_id']; ?>" data-filename="<?php echo $image['filename']; ?>" data-toggle="modal" rel="tooltip" title="<?php echo $image['title']; ?>">				
					<img src="member/<?php echo $image['user_id']; ?>/files/<?php echo $image['filename']; ?>" class="profile-gallery-image"/></a>


				
			</div>
		</span>
<?php  } else { ?>
		
		<div class="row-fluid profile-gallery-image-container all-profile-image-containers nailthumbs-next<?php echo $current_page; ?>">
			<div class="span12">
				
			<a href="#<?php echo $image['image_id']; ?>" class="image-tooltip<?php echo $image['image_id']; ?> generate-modal-comment" data-image_id="<?php echo $image['image_id']; ?>" data-user_id="<?php echo $image['user_id']; ?>" data-filename="<?php echo $image['filename']; ?>" data-toggle="modal" rel="tooltip" title="<?php echo $image['title']; ?>">				
				<img src="member/<?php echo $image['user_id']; ?>/thumbnail/<?php echo $image['filename']; ?>" class="profile-gallery-image"/></a>
				
				<?php if($image['vote'] == 1){?>
				
				<div class="image-options">
				
					<div class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog icon-white"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#" class="make-profile-image" data-filename="<?php echo $image['filename']; ?>">Profile image</a></li>
							</ul>
					</div>
										

				</div>			
				
				<?php } else { ?>
		
				<div class="image-options">
		
					<div class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-ok icon-white"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#" class="change-image-state" data-image_state="1" data-image_id="<?php echo $image['image_id']; ?>">Public</a></li>
								<li><a href="#" class="change-image-state" data-image_state="2" data-image_id="<?php echo $image['image_id']; ?>">Friend</a></li>
								<li><a href="#" class="change-image-state" data-image_state="3" data-image_id="<?php echo $image['image_id']; ?>">Private</a></li>
							</ul>
					</div>
				</div>
				
				<div class="image-options2">
										
					<div class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog icon-white"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#" class="make-profile-image" data-filename="<?php echo $image['filename']; ?>">Profile image</a></li>
							</ul>
					</div>
					
				</div>
				
				<?php }?>
				
				<div class="permission-indicator">
					<?php if($image['state'] == 1){?>
						<img class="<?php echo $image['image_id']; ?>" src="assets/green-dot.png" />
					<?php } else if($image['state'] == 2){?>
						<img class="<?php echo $image['image_id']; ?>" src="assets/yellow-dot.png" />
					<?php } else {?>
						<img class="<?php echo $image['image_id']; ?>" src="assets/red-dot.png" />
					<?php }?>
				</div>
										
				<div class="delete-image">
					<a href="#" class="delete-image-button" data-filename="<?php echo $image['filename']; ?>"
						data-image_id="<?php echo $image['image_id']; ?>"><img src="../assets/imgsource/buttons/red-cross-md.png" /></a>
				</div>
			</div>
		</div>
<?php }}?>

<?php foreach($images as $image){?>
  	
<div class="modal hide fade" id="<?php echo $image['image_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="image-modal-label" aria-hidden="true">
		<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove-circle"></i></button>
    			<h4 id="image-modal-label"><?php echo $image['title']; ?></h4>
  		</div>
  								
  		<div class="modal-body">
 		 	<div class="row-fluid">
				<div class="span12">
				
					<div class="span8">
						<div class="row-fluid profile-gallery-image-modal-container">
							<div class="span12">
								<img id="modal_image<?php echo $image['image_id']; ?>" class="profile-modal-image-border" src="" />
							</div>
						</div>
						
					<div class="row-fluid">
						<div class="span12" id="profile-comment-container">
					
						<div class="span10">
							<textarea class="modal-textarea<?php echo $image['image_id']; ?>" placeholder="Comment..."></textarea>
						</div>
						
						<div class="span1" id="profile-submit-counter-container">
						
							<div class="row-fluid" id="submit-button-container">
								<div class="span12">
									<a href="#" class="btn btn-small btn-info modal-comment-submit" data-image_id="<?php echo $image['image_id']; ?>"><strong>Submit</strong></a>
								</div>
							</div>
							
							<div class="row-fluid">
								<div class="span12">
									<input type="checkbox" class="private-comment<?php echo $image['image_id']; ?>" rel="tooltip" title="Private comment" />
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
								<span class="insert-modal-comment<?php echo $image['image_id']; ?>">
								
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
	$(".nailthumbs-next<?php echo $current_page; ?>").nailthumb();
	$('.image-options').hide();
	$('.image-options2').hide();
	$('.delete-image').hide();
	$('.permission-indicator').hide();
</script>