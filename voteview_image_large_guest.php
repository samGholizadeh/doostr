<?php
include ('view/header_large_view.php');
include ('utility/main.php');

	if(!$result){ ?>
	
		<div class="row-fluid">
			<div class="span12" id="large-image-container">
	
				<h3><p>This image does not exist. But there are plenty of other images in the links above :)</p></h3>
	
			</div>
		</div>
		
	<?php } else {?>
	
		<div class="row-fluid">
			<div class="span12" id="large-image-container">
				<img id="large-image" src=<?php echo $link; ?> />
			</div>
		</div>
		
<?php }

include ('view/footer.php'); ?>