


<span class="page14">

<?php if(!$comments){ ?>

<span class="insert-modal-comment-sent<?php echo $image_id; ?>">
								
	</span>

	<p id="first-comment-modal<?php echo $image_id; ?>">No comments available</p>

<?php } else { ?>
	
	<?php if($comment_count[0] > 7){
							
		$modal_comment_array_length = 7;
								
	} else {

		$modal_comment_array_length = $comment_count[0];
	
	}?>
	
	<div class="row-fluid modal-comment-outer">
		<div class="span12">
	
	
	<span class="insert-modal-comment-sent<?php echo $comments[0]['image_id']; ?>">
								
	</span>
	

	<?php for($i = 0; $i <= ($modal_comment_array_length - 1); $i++){
	
		if(($comments[$i]['private_comment'] == 1) && (($_SESSION['user_true'] != true) && ($_SESSION['user_id'] != $comments[$i][2]))){

			continue;
			
		 } else {?>
	
<span id="comment<?php echo $comments[$i]['commentid']; ?>">
	<div class="row-fluid modal-comment-inner">
		<div class="span12">
	<?php if($_SESSION['user_id'] == $comments[$i][2]){?>
																							
		<small id="comment-font-size"><strong><?php echo $comments[$i]['username']; ?></strong>
																																	
	<?php } else {?>
																															
		<small id="comment-font-size"><a href="javascript:void(0);" class="userlink" data-userx_id="<?php echo $comments[$i][2]; ?>"><strong><?php echo $comments[$i]['username']; ?></strong></a>
																															
	<?php }?>
															
		<i class="icon-thumbs-up" rel="tooltip" title="<?php echo $comments[$i]['comment_likes'];?> likes, <?php echo $comments[$i]['comment_dislikes'];?> dislikes"></i>
															
		<strong id="<?php echo $comments[$i]['commentid']; ?>-likes"><?php echo $comments[$i]['comment_likes'];?></strong>&nbsp;<span class="the-dot"> &#8226;</span>&nbsp;</small>
		
		<?php if(($_SESSION['user_id'] != $comments[$i]['user_id']) && ($_SESSION['user_id'] != $comments[$i][2]) && ($comments[$i]['is_reported'] < 50)){ ?>
														
			<b class="<?php echo $comments[$i]['commentid']; ?>like">
				<a href="javascript:void(0);" class="likecomment" id="likecomment" data-commentid="<?php echo $comments[$i]['commentid']; ?>" data-user_id="<?php echo $comments[$i][2]; ?>"><i class="icon-thumbs-up"></i></a>
				<a href="javascript:void(0);" class="dislikecomment" id="dislikecomment" data-commentid="<?php echo $comments[$i]['commentid']; ?>" data-user_id="<?php echo $comments[$i][2]; ?>"><i class="icon-thumbs-down"></i></a>
			</b>
								
								
			<?php } if($_SESSION['user_id'] == $comments[$i][2]){?>
																
				<a href="javascript:void(0);" class="remove-comment" data-commentid="<?php echo $comments[$i]['commentid'];?>"><small>remove</small></a>
									
			<?php if($comments[$i]['is_reported'] >= 1){?>
														
				<a href="javascript:void(0);" class="show-reported-comment reported-message<?php echo $comments[$i]['commentid']; ?>" data-commentid="<?php echo $comments[$i]['commentid']; ?>"><small>show</small></a>
										
				<span class="hide-reported hide-reported<?php echo $comments[$i]['commentid'];?>">
											
				<a href="javascript:void(0);" class="hide-comment" data-commentid="<?php echo $comments[$i]['commentid']; ?>"><small>hide</small></a>
																
				</span>
													
			<?php }} else { 
													
				if($comments[$i]['is_reported'] >= 1){?>
														
					<a href="javascript:void(0);" class="show-reported-comment reported-message<?php echo $comments[$i]['commentid']; ?>" data-commentid="<?php echo $comments[$i]['commentid']; ?>"><small>show</small></a>
						
										
				<span class="hide-reported hide-reported<?php echo $comments[$i]['commentid'];?>">
														
					
					<a href="javascript:void(0);" class="hide-comment" data-commentid="<?php echo $comments[$i]['commentid']; ?>"><small>hide</small></a>
						
															
				</span>
														
			<?php } else {?>
								
				
				<a href="javascript:void(0);" class="report-comment" data-commentid="<?php echo $comments[$i]['commentid']; ?>"><small>report</small></a>
					
													
			<?php }}?>
				<?php if(($comments[$i]['private_comment'] == 1) && (($_SESSION['user_true'] == true) || ($_SESSION['user_id'] == $comments[$i][2]))){?><small id="comment-modal-font-size">&nbsp&nbsp;private</small><?php }?>						
				<br>
															
			<?php if($comments[$i]['is_reported'] >= 1 ){?>
												
				<p id="comment-modal-font-size2" class="reported-message<?php echo $comments[$i]['commentid']; ?>">Reported as spam</p>
												
				<p id="comment-modal-font-size2" class="hide-reported hide-reported<?php echo $comments[$i]['commentid']; ?>"><?php echo $comments[$i]['comment']; ?></p>
												
			<?php } else {?>
												
				<p id="comment-modal-font-size2" class="comments-layout"><?php echo $comments[$i]['comment']; ?></p>
													
		<?php } ?>
		
			</div>
		</div>
	</span>
	<?php }} ?>
	</div>
</div>
		
	</span>
			
		<?php $modal_comment_pages = $comment_count[0]/7;
							
			if($modal_comment_pages >= 1){
							
			for($i = 2; $i <= ($modal_comment_pages + 1); $i++){?>
								
				<span class="page14">
					<span class="modal-comment-page<?php echo $comments[0]['image_id']; echo $i; ?>">
							
					</span>
				</span>
			<?php } ?>
				<div class="pagination pagination-small pagination-centered">
					<ul class="profile-modal-comments-nav">
						<?php for($i = 1; $i <= ($modal_comment_pages + 1); $i++){ ?>
							<li class="<?php if($i == 1){?>active<?php }?>">
							
							<a href="#" class="profile-modal-comments-next<?php if($i == 1){?> done<?php } ?>" 
								data-current_page="<?php echo $i; ?>" data-image_id="<?php echo $comments[0]['image_id']; ?>"><?php echo $i; ?></a>
							
							</li>
						<?php } ?>
					</ul>
				</div>
		<?php }} ?>
		
<script type="text/javascript">
	$('.hide-reported').hide();
</script>