<div class="row-fluid">
	<div class="span12">
	
	<?php if(!$rated_images){?>
	
	<strong><small>No rated images available</small></strong>
	
	<?php } else {?>
		
		<span class="page12">
		
		<?php if($rated_images_count[0] > 16){
			$rated_images_array_length = 16;
		} else {
			$rated_images_array_length = $rated_images_count[0];
		}
		
	for($i = 0; $i <= $rated_images_array_length - 1; $i++){?>
	
		<span class="gallery<?php echo $rated_images[$i]['image_id']; ?>">
		<div class="row-fluid profile-gallery-rated-image-container-outer">
			<div class="span12">
				<div class="row-fluid profile-gallery-rated-image-container-inner all-profile-image-containers nailthumbs-rated">
					<div class="span12">
					
					<a href="#rated<?php echo $rated_images[$i]['image_id']; ?>" class="image-tooltip<?php echo $rated_images[$i]['image_id']; ?> generate-rated-modal" data-toggle="modal" rel="tooltip" title="<?php echo $rated_images[$i]['title']; ?>" data-image_id="<?php echo $rated_images[$i]['image_id']; ?>">
						<img src="../member/<?php echo $rated_images[$i]['user_id']; ?>/thumbnail/<?php echo $rated_images[$i]['filename']; ?>" />
					</a>
					
					<script type="text/javascript">
						$('.image-tooltip<?php echo $rated_images[$i]['image_id']; ?>').tooltip();
					</script>
						
						<div class="image-options">
								
							<div class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);"><i class="icon-cog icon-white"></i></a>
								<ul class="dropdown-menu">
									<li><a href="?a=goto&image_id=<?php echo $rated_images[$i]['image_id']; ?>">Goto</a></li>
								</ul>
							</div>
							
						</div>
						
					<?php if($_SESSION['user_true']){?>
						
						<div class="delete-image">
							<a href="javascript:void(0);" class="delete-image-button" data-filename="<?php echo $rated_images[$i]['filename']; ?>"
								data-image_id="<?php echo $rated_images[$i]['image_id']; ?>"><img src="../assets/imgsource/buttons/red-cross-md.png" /></a>
						</div>
					
					<?php } else { ?>
							
					<?php } ?>
					</div>
				</div>
				
				
				<div class="row-fluid">
					<div class="span12" id="testvar2">
					
					<span class="gallery-rated-text">Views:&nbsp<?php echo $rated_images[$i]['views']; ?>&nbsp&nbsp&#8226;&nbsp&nbspVotes:&nbsp<?php echo $rated_images[$i]['numvotes']; ?>&nbsp&nbsp&#8226;&nbsp&nbsp<br>Average:&nbsp<?php echo $rated_images[$i]['average']; ?>&nbsp&nbsp&#8226;&nbsp&nbspLikes:&nbsp<?php echo $rated_images[$i]['likes']; ?></span>

					</div>
				</div>
			</div>
		</div>
		</span>
		<?php }?>
		
		</span>
		
		<?php } $rated_image_pages = $rated_images_count[0]/16;
		
		if($rated_image_pages > 1){
			for($i = 2; $i <= ($rated_image_pages + 1); $i++){?>
			
				<span class="page12">
					<span class="rated-image-page<?php echo $i; ?>">
					
					</span>
				</span>
								
				<?php } ?>
					<div class="pagination pagination-mini pagination-centered">
						<ul class="profile-gallery-rated-subnav">
							<?php for($i = 1; $i <= ($rated_image_pages + 1); $i++){ ?>
								<li class="<?php if($i == 1){?>active<?php }?>"><a href="javascript:void(0);" class="profile-gallery-rated-next-page<?php if($i == 1){?> done<?php } ?>" data-current_page="<?php echo $i; ?>"
								data-user_id="<?php echo $rated_images[0]['username']; ?>"><?php echo $i; ?></a></li>
							<?php } ?>
						</ul>
					</div>
				<?php } ?>
				
<?php if($rated_images){

for($i = 0; $i <= $rated_images_array_length; $i++){?>
  	
  	
  	 <div class="modal hide fade" id="rated<?php echo $rated_images[$i]['image_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="image-modal-label" aria-hidden="true">
		
  								
  		<div class="modal-body">
 		 	<div class="row-fluid">
				<div class="span12 insert-rated-modal<?php echo $rated_images[$i]['image_id']; ?>">
				
					
				
				</div>
			</div>
    	</div>
  		
  		<div class="modal-footer">
  			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  		</div>
  	</div>
  	
  	<?php }}?>
  	
  	
  	
	</div>
</div>

<script type="text/javascript">
$(".nailthumbs-rated").nailthumb();
$('.image-options').hide();
$('.delete-image').hide();
</script>