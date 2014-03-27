<?php foreach($favourites as $favourite){?>
	<span class="gallery-favourite<?php echo $favourite['image_id']; ?>">
	<div class="profile-gallery-image-container all-profile-image-containers nailthumbs-favourites-next">
				
		<img src="../member/<?php echo $favourite['user_id']; ?>/files/<?php echo $favourite['filename']; ?>" />
				
		<?php if($_SESSION['user_true']){?>
			
			<div class="delete-image">
				<a href="javascript:void(0);" class="delete-favourite-button" data-image_id="<?php echo $favourite[$i]['image_id']; ?>"><img src="../assets/imgsource/buttons/red-cross-md.png" /></a>
			</div>
				
		</div>
	</span>
<?php }}?>

<script type="text/javascript">
	$(".nailthumbs-favourites-next").nailthumb();
	$('.delete-image').hide();
</script>