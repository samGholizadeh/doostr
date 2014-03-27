<?php for($i = 0; $i < $array_length; $i++){ ?>
<span class="gallery<?php echo $image_id[$i]; ?>">
								
	<div class="row-fluid profile-gallery-image-container all-profile-image-containers nailthumbs<?php echo $image_id[$i]; ?>">
		<div class="span12">
	
		<a href="#<?php echo $image_id[$i]; ?>" class="image-tooltip<?php echo $image_id[$i]; ?> generate-modal-comment" data-user_id="<?php echo $_SESSION['user_id']; ?>" data-image_id="<?php echo $image_id[$i]; ?>" data-filename="<?php echo $filename[$i]; ?>" data-toggle="modal" rel="tooltip" title="<?php echo $title[$i]; ?>">
			<img src="member/<?php echo $_SESSION['user_id']; ?>/thumbnail/<?php echo $filename[$i]; ?>" class="profile-gallery-image" /></a>
			
		<?php if($is_rated[$i] == 0){?>
	
			<div class="image-options">
	
				<div class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-ok icon-white"></i></a>
						<ul class="dropdown-menu">
							<li><a href="#" class="change-image-state" data-image_state="1" data-image_id="<?php echo $image_id[$i]; ?>">Public</a></li>
							<li><a href="#" class="change-image-state" data-image_state="2" data-image_id="<?php echo $image_id[$i]; ?>">Friend</a></li>
							<li><a href="#" class="change-image-state" data-image_state="3" data-image_id="<?php echo $image_id[$i]; ?>">Private</a></li>
						</ul>
				</div>
			</div>
			
			<div class="image-options2">
									
				<div class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog icon-white"></i></a>
						<ul class="dropdown-menu">
							<li><a href="#" class="make-profile-image" data-filename="<?php echo $filename[$i]; ?>">Profile image</a></li>
						</ul>
				</div>
				
			</div>
			
		<?php } else { ?>
		
			<div class="image-options">
									
				<div class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cog icon-white"></i></a>
						<ul class="dropdown-menu">
							<li><a href="#" class="make-profile-image" data-filename="<?php echo $filename[$i]; ?>">Profile image</a></li>
						</ul>
				</div>
				
			</div>
			
		<?php }?>
										
		<div class="permission-indicator">
		
			<?php if($state[$i] == 1){?>
				<img class="<?php echo $image_id[$i]; ?>" src="assets/green-dot.png" />
			<?php } else if($state[$i] == 2){?>
				<img class="<?php echo $image_id[$i]; ?>" src="assets/yellow-dot.png" />
			<?php } else {?>
				<img class="<?php echo $image_id[$i]; ?>" src="assets/red-dot.png" />
			<?php }?>
			
		</div>
		
		
		<div class="delete-image">
			<a href="javascript:void(0);" class="delete-image-button" data-filename="<?php echo $filename[$i]; ?>" data-image_id="<?php echo $image_id[$i]; ?>"><img src="../assets/imgsource/buttons/red-cross-md.png" /></a>
		</div>
	</div>
</div>

</span>

  	 <div class="modal hide fade profile-modal" id="<?php echo $image_id[$i]; ?>" tabindex="-1" role="dialog" aria-labelledby="image-modal-label" aria-hidden="true">
		<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove-circle"></i></button>
    			<h4 id="image-modal-label"><?php echo $title[$i]; ?></h4>
  		</div>
  								
  		<div class="modal-body">
 		 	<div class="row-fluid">
				<div class="span12">
				
				<div class="span8">
					<div class="row-fluid profile-gallery-image-modal-container">
						<div class="span12">
							<img id="modal_image<?php echo $image_id[$i]; ?>" class="profile-modal-image-border" src="" />
						</div>
					</div>
						
					<div class="row-fluid">
						<div class="span12" id="profile-comment-container">
					
						<div class="span10">
							<textarea class="modal-textarea<?php echo $image_id[$i]; ?>" placeholder="Comment..."></textarea>
						</div>
						
						<div class="span1" id="profile-submit-counter-container">
						
							<div class="row-fluid" id="submit-button-container">
								<div class="span12">
									<a href="#" class="btn btn-small btn-info modal-comment-submit" data-image_id="<?php echo $image_id[$i]; ?>"><strong>Submit</strong></a>
								</div>
							</div>
							
							<div class="row-fluid">
								<div class="span12">
									<input type="checkbox" class="private-comment<?php echo $image_id[$i]; ?> priv-comment" rel="tooltip" title="Private comment" />
									<strong><span class="comment-counter<?php echo $image_id[$i]; ?>"></span></strong>
								</div>
							</div>
						</div>
						
							</div>					
						</div>
					</div>
				
					<div class="span3 ">
					
						<div class="row-fluid">
							<div class="span12">
								<span class="insert-modal-comment<?php echo $image_id[$i]; ?>">
								
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
  	
  	<script type="text/javascript">
  		$(".nailthumbs<?php echo $image_id[$i]; ?>").nailthumb();
		$(".modal-textarea<?php echo $image_id[$i]; ?>").limit("120",".comment-counter<?php echo $image_id[$i]; ?>");
  	</script>
  	
  	<?php } $_SESSION['image_id_upload'] = array(); $_SESSION['image_filename_upload'] = array(); ?>
  	
  	<script type="text/javascript">
	$('.image-options').hide();
	$('.image-options2').hide();
	$('.delete-image').hide();
	$(".permission-indicator").hide();
  	</script>