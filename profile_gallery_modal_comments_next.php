<div class="row-fluid modal-comment-outer">
	<div class="span12">
	
	
<?php foreach($comments as $comment){ 
	
	if(($comment['private_comment'] == 1) && (($_SESSION['user_true'] != true) || ($_SESSION['user_id'] =! $comment[2]))){

			continue;
			
		 } else { ?>
<span id="comment<?php echo $comment['commentid']; ?>">
	<div class="row-fluid modal-comment-inner">
		<div class="span12">
	<?php if($_SESSION['user_id'] == $comment[2]){?>
																							
		<small id="comment-font-size"><strong><?php echo $comment['username']; ?></strong>
																																	
	<?php } else {?>
																															
		<small id="comment-font-size"><a href="javascript:void(0);" class="userlink" data-userx_id="<?php echo $comment[2]; ?>"><strong><?php echo $comment['username']; ?></strong></a>
																															
	<?php }?>
		
	<small id="comment-modal-font-size"><a href="javascript:void(0);" class="userlink2"><strong><?php echo $comment['username']; ?></strong></a>
															
		<i class="icon-thumbs-up" rel="tooltip" title="<?php echo $comment['comment_likes'];?> likes, <?php echo $comment['comment_dislikes'];?> dislikes"></i>
															
			<strong id="<?php echo $comment['commentid']; ?>-likes"><?php echo $comment['comment_likes'];?></strong>&nbsp;<span class="the-dot"> &#8226;</span>&nbsp;</small>
			
			<?php if(($_SESSION['user_id'] != $comment['user_id']) && ($_SESSION['user_id'] != $comment[2]) && ($comment['is_reported'] < 50)){ ?>
														
			<b class="<?php echo $comment['commentid']; ?>like">
				<a href="javascript:void(0);" class="likecomment" id="likecomment" data-commentid="<?php echo $comment['commentid']; ?>" data-user_id="<?php echo $comment[2]; ?>"><i class="icon-thumbs-up"></i></a>
				<a href="javascript:void(0);" class="dislikecomment" id="dislikecomment" data-commentid="<?php echo $comment['commentid']; ?>" data-user_id="<?php echo $comment[2]; ?>"><i class="icon-thumbs-down"></i></a>
			</b>
									
			<?php } if($_SESSION['user_id'] == $comment[2]){?>
																
				<a href="javascript:void(0);" class="remove-comment" data-commentid="<?php echo $comment['commentid'];?>"><small>remove</small></a>
									
			<?php if($comment['is_reported'] >= 1){?>
														
				<a href="javascript:void(0);" class="show-reported-comment reported-message<?php echo $comment['commentid']; ?>" data-commentid="<?php echo $comment['commentid']; ?>"><small>show</small></a>
										
				<span class="hide-reported hide-reported<?php echo $comment['commentid'];?>">
											
				<a href="javascript:void(0);" class="hide-comment" data-commentid="<?php echo $comment['commentid']; ?>"><small>hide</small></a>
																
				</span>
													
			<?php }} else { 
													
				if($comment['is_reported'] >= 1){?>
														
					<a href="javascript:void(0);" class="show-reported-comment reported-message<?php echo $comment['commentid']; ?>" data-commentid="<?php echo $comment['commentid']; ?>"><small>show</small></a>
										
				<span class="hide-reported hide-reported<?php echo $comment['commentid'];?>">
														
					
					<a href="javascript:void(0);" class="hide-comment" data-commentid="<?php echo $comment['commentid']; ?>"><small>hide</small></a>
															
				</span>
														
			<?php } else {?>
								
				
				<a href="javascript:void(0);" class="report-comment" data-commentid="<?php echo $comment['commentid']; ?>"><small>report</small></a>
													
			<?php }}?>
			
				<?php if(($comment['private_comment'] == 1) && (($_SESSION['user_true'] == true) || ($_SESSION['user_id'] == $comments[$i][2]))){?><small id="comment-modal-font-size">&nbsp&nbsp;private</small><?php }?>							
				<br>
															
			<?php if($comment['is_reported'] >= 1 ){?>
												
				<p id="comment-modal-font-size2" class="reported-message<?php echo $comment['commentid']; ?>">Reported as spam</p>
												
				<p id="comment-modal-font-size2" class="hide-reported hide-reported<?php echo $comment['commentid']; ?>"><?php echo $comment['comment']; ?></p>
												
			<?php } else {?>
												
				<p id="comment-modal-font-size2" class="comments-layout"><?php echo $comment['comment']; ?></p>
													
		<?php } ?>
		
			</div>
		</div>
	</span>
<?php }} ?>
</div>
</div>

<script type="text/javascript">
	$('.hide-reported').hide();
</script>