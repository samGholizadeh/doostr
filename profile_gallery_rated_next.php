<?php foreach($rated_images as $image){?>
	<span class="gallery<?php echo $image['image_id']; ?>">
		<div class="row-fluid profile-gallery-rated-image-container-outer">
			<div class="span12">
				<div class="row-fluid profile-gallery-rated-image-container-inner all-profile-image-containers nailthumbs<?php echo $current_page; ?>">
					<div class="span12">
					
						<a href="#rated<?php echo $image['image_id']; ?>" class="image-tooltip<?php echo $image['image_id']; ?> generate-rated-modal" data-toggle="modal" rel="tooltip" title="<?php echo $image['title']; ?>" data-image_id="<?php echo $image['image_id']; ?>">
						<img src="../member/<?php echo $image['user_id']; ?>/thumbnail/<?php echo $image['filename']; ?>" />
					</a>
					
					<script type="text/javascript">
						$('.image-tooltip<?php echo $image['image_id']; ?>').tooltip();
					</script>
					
					<div class="image-options">
								
							<div class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);"><i class="icon-cog icon-white"></i></a>
								<ul class="dropdown-menu">
									<li><a href="?a=goto&image_id=<?php echo $image['image_id']; ?>">Goto</a></li>
								</ul>
							</div>
							
						</div>
						
					<?php if($_SESSION['user_true']){?>
						
						<div class="delete-image">
							<a href="javascript:void(0);" class="delete-image-button" data-filename="<?php echo $image['filename']; ?>"
								data-image_id="<?php echo $image[$i]['image_id']; ?>"><img src="assets/imgsource/buttons/red-cross-md.png" /></a>
						</div>
					
					<?php } else { ?>
					
					<?php } ?>
					</div>
				</div>
				
				
				<div class="row-fluid" id="testvar2">
					<div class="span12">
					
						<span class="gallery-rated-text">Views:&nbsp<?php echo $image['views']; ?>&nbsp&nbsp&#8226;&nbsp&nbspVotes:&nbsp<?php echo $image['numvotes']; ?><br>Average:&nbsp<?php echo $image['average']; ?>&nbsp&nbsp&#8226;&nbsp&nbspLikes:&nbsp<?php echo $image['likes']; ?></span>
				
					</div>
				</div>
			</div>
		</div>
	</span>
<?php }?>
	
	
<?php foreach($rated_images as $image){?>
  	
  	
  	 <div class="modal hide fade" id="rated<?php echo $image['image_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="image-modal-label" aria-hidden="true">

  								
  		<div class="modal-body">
 		 	<div class="row-fluid">
				<div class="span12 insert-rated-modal<?php echo $image['image_id']; ?>">
				
			
				
				</div>
			</div>
    	</div>
  		
  		<div class="modal-footer">
  			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  		</div>
  	</div>
  	
  	<?php }?>
<script type="text/javascript">
$(".nailthumbs<?php echo $current_page; ?>").nailthumb();
$('.image-options').hide();
$('.delete-image').hide();
</script>