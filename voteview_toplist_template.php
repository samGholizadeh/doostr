	<div class="row-fluid" id="top10-list">
		<div class="span12">
			
				<?php if($_SESSION['subcategory']){?>
				
					<?php for($i = 0; $i <= 9; $i++){?>
						<div class="toplist-img-container <?php echo $nailthumb; ?>">
						<a href="#"><img src="<?php echo $toplist[$i]; ?>" class="toplistimages-sub"/></a>
						</div>
					<?php }?>
					
				<?php } else {?>
				
					<?php for($i = 0; $i <= 9; $i++){?>
						<div class="toplist-img-container <?php echo $nailthumb; ?>">
						<a href="#"><img src="<?php echo $toplist[$i]; ?>" class="toplistimages"/></a>
						</div>
					<?php }?>
					
				<?php }?>
			
		</div>
	</div>
	
	<script type="text/javascript">
		$(".<?php echo $nailthumb; ?>").nailthumb();
	</script>