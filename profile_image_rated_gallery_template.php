	<span class="gallery<?php echo $rated_images[$i]['image_id']; ?>">
		<div class="row-fluid profile-gallery-rated-image-container-outer">
			<div class="span12">
				<div class="row-fluid profile-gallery-rated-image-container-inner all-profile-image-containers nailthumbs-rated<?php echo $rated_images[$i]['image_id']; ?>">
					<div class="span12">
					
					<a href="#rated<?php echo $rated_images[$i]['image_id']; ?>" class="image-tooltip<?php echo $rated_images[$i]['image_id']; ?> generate-rated-modal" data-toggle="modal" rel="tooltip" title="<?php echo $rated_images[$i]['title']; ?>" data-image_id="<?php echo $rated_images[$i]['image_id']; ?>">
						<img src="../member/<?php echo $rated_images[$i]['user_id']; ?>/thumbnail/<?php echo $rated_images[$i]['filename']; ?>" />
					</a>
						<div class="image-options">
								
							<div class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);"><i class="icon-cog icon-white"></i></a>
								<ul class="dropdown-menu">
									<li><a href="?a=goto&image_id=<?php echo $rated_images[$i]['image_id']; ?>">Goto</a></li>
								</ul>
							</div>
							
						</div>
						
						<div class="delete-image">
							<a href="javascript:void(0);" class="delete-image-button" data-filename="<?php echo $rated_images[$i]['filename']; ?>"
								data-image_id="<?php echo $rated_images[$i]['image_id']; ?>"><img src="assets/imgsource/buttons/red-cross-md.png" /></a>
						</div>
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

<script type="text/javascript">
$('.image-tooltip<?php echo $rated_images[$i]['image_id']; ?>').tooltip();
$(".nailthumbs-rated<?php echo $rated_images[$i]['image_id']; ?>").nailthumb();
$('.image-options').hide();
$('.delete-image').hide();
</script>