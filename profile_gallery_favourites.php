	<div class="row-fluid">
		<div class="span12">
			<?php if(!$favourites){?>
							
				<h5><strong>You dont have any favourites.</strong></h5>
							
			<?php } else { ?>
			
			<span class="page13">
			
				<?php if($array_length[0] > 36){
					$favourites_array_length = 36;
				} else {
					$favourites_array_length = $array_length[0];
				}
								 
			for($i = 0; $i <= $favourites_array_length - 1; $i++){?>
			
			<span class="gallery-favourite<?php echo $favourites[$i]['image_id']; ?>">
			
				<div class="profile-gallery-image-container all-profile-image-containers nailthumbs-favourites">
				
					<img src="../member/<?php echo $favourites[$i]['user_id']; ?>/files/<?php echo $favourites[$i]['filename']; ?>" />
				
				<?php if($_SESSION['user_true']){?>
			
					<div class="delete-image">
						<a href="javascript:void(0);" class="delete-favourite-button" data-image_id="<?php echo $favourites[$i]['image_id']; ?>"><img src="../assets/imgsource/buttons/red-cross-md.png" /></a>
					</div>
				
				</div>
				
			</span>
			<?php }}?>
			
			</span>
			<?php 
				
				$favourite_pages = $array_length[0]/36;
				
				if($favourite_pages >= 1){
					for($i = 2; $i <= ($favourite_pages + 1); $i++){?>
					<span class="page13">
						<span class="favourite-page<?php echo $i; ?>">
							
						</span>
					</span>
				<?php } ?>
					
					<div class="pagination pagination-mini pagination-centered">
						<ul class="profile-gallery-favourites-subnav">
							<?php for($i = 1; $i <= ($favourite_pages + 1); $i++){?>
								<li class="<?php if($i == 1){?>active<?php }?>"><a href="javascript:void(0);" class="profile-gallery-favourites-next-page<?php if($i == 1){?> done<?php } ?>" data-current_page="<?php echo $i; ?>"
								data-user_id="<?php echo $favourites[0]['username']; ?>"><?php echo $i; ?></a></li>
							<?php }?>
						</ul>
					</div>
					
				<?php }
	
				}?>
			
		</div>
	</div>
	
	<script type="text/javascript">
		$(".nailthumbs-favourites").nailthumb();
		$('.delete-image').hide();
	</script>
	