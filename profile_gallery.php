<div class="row-fluid" id="image-bar">
	<div class="span12">
				
				<div class="span10">
					<ul class="nav nav-tabs gallery-nav">
						<li class="active"><a href="javascript:void(0);"><strong><small>All</small></strong></a></li>
						<li><a href="javascript:void(0);" class="gallery-nav-rated"><strong><small>Rated</small></strong></a></li>
						<li><a href="javascript:void(0);" class="gallery-nav-album"><strong><small>Albums</small></strong></a></li>
						<li><a href="javascript:void(0);" class="gallery-nav-favourites"><strong><small>Favourites</small></strong></a></li>
						<li><a href="javascript:void(0);" class="gallery-add-image"><strong><small>Add image</small></strong></a></li>
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

			for($i = 0; $i <= ($image_array_length - 1); $i++){ ?>
			
				<span class="gallery<?php echo $images[$i]['image_id']; ?>">
				
					<div class="row-fluid profile-gallery-image-container all-profile-image-containers nailthumbs">
						<div class="span12">
					
						<a href="#<?php echo $images[$i]['image_id']; ?>" class="image-tooltip<?php echo $images[$i]['image_id']; ?> generate-modal-comment" data-user_id="<?php echo $_SESSION['user_id']; ?>" data-image_id="<?php echo $images[$i]['image_id']; ?>" data-filename="<?php echo $images[$i]['filename']; ?>" data-toggle="modal" rel="tooltip" title="<?php echo $images[$i]['title']; ?>">
							<img src="../member/<?php echo $_SESSION['user_id']; ?>/thumbnail/<?php echo $images[$i]['filename']; ?>" class="profile-gallery-image" /></a>
							
						<script type="text/javascript">
							$('.image-tooltip<?php echo $images[$i]['image_id']; ?>').tooltip();
						</script>
						
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
											<li id="remove-rate-option<?php echo $images[$i]['image_id']; ?>"><a href="#" class="rate-image" data-image_id="<?php echo $images[$i]['image_id']; ?>">Rate image</a></li>
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
				<div class="pagination pagination-small pagination-centered">
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
	
	  	<?php for($i = 0; $i <= $image_array_length; $i++){?>
  	
  	 <div class="modal hide fade" id="<?php echo $images[$i]['image_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="image-modal-label" aria-hidden="true">
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
  	
  	
  	<?php }?>
	
	<script type="text/javascript">
	$('.image-options').hide();
	$('.image-options2').hide();
	$('.delete-image').hide();
	$(".permission-indicator").hide();
	$(".nailthumbs").nailthumb();
	$(".image-option-menu").hide();
	$('.page1:gt(0)').hide();
	</script>