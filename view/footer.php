

	</div>
	<?php if(!$profile_messages){?>
	<script src="assets/jquery-1.8.2.min.js" type="text/javascript"></script>
	<script src="assets/limit.js" type="text/javascript"></script>
	<?php } ?>
	<script src="assets/bootstrap.js" type="text/javascript"></script>
	<script src="assets/homecooked.js" type="text/javascript"></script>
	<script src="assets/jquery.nailthumb.1.1.js" type="text/javascript"></script>
	<script type="text/javascript">
		var file_complete = 0;
		var file_count = 0;
		var permission_state = [ [] ];
		var rate_info = [ [] ];
		var is_rated = [];
		$(document).ready(function(){
		<?php if($profile_messages || $profile_friends){?>
			
		<?php } else {
			
			for($i = 0; $i < ($image_array_length); $i++){ ?>
				$(".modal-textarea<?php echo $images[$i]['image_id']; ?>").limit("120",".comment-counter<?php echo $images[$i]['image_id']; ?>");
				$(".image-tooltip<?php echo $images[$i]['image_id']; ?>").tooltip();
				
			<?php }?>
			
			$('.page:gt(0)').hide();
			
		<?php } ?>
		});
	</script>
	<script src="assets/jquery.showLoading.min.js" type="text/javascript"></script>
	<script src="assets/html5placeholder.jquery.min.js" type="text/javascript"></script>
	<script src="assets/jquery.fineuploader-3.0.min.js" type="text/javascript"></script>
	
</body>
</html>
