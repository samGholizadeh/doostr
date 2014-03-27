<?php foreach($imagecomments as $imagecomment){?>
		
	<span id="comment<?php echo $imagecomment['commentid']; ?>">
											
		<div class="row-fluid">
			<div class="span12" id="comment-reply">
														
			<div class="span1 reply-indicator">
													
			<?php if($imagecomment['has_replies'] >= 1){?>
				<a href="javascript:void(0);" id="extend-comment<?php echo $imagecomment['commentid']; ?>" class="onclick" data-commentid="<?php echo $imagecomment['commentid']; ?>"><strong>+</strong></a>
			<?php }?>
														
			</div>
														
			<div class="span11" id="comment-inner">
													
			<?php if($imagecomment['display_state'] == 0){?>
														
														

				<small id="comment-font-size"><a href="#signin-register" data-toggle="modal"><strong><?php echo $imagecomment['username']; ?></strong></a>
										
															
															
			<i class="icon-thumbs-up" rel="tooltip" title="<?php echo $imagecomment['comment_likes'];?> likes, <?php echo $imagecomment['comment_dislikes'];?> dislikes"></i>
															
			<strong id="<?php echo $imagecomment['commentid']; ?>-likes"><?php echo $imagecomment['comment_likes'];?></strong>&nbsp;<span class="the-dot"> &#8226;</span>&nbsp;</small>
															
			<?php if($imagecomment['is_reported'] < 50){?>
														
				<b class="<?php echo $imagecomment['commentid']; ?>like">
					<a href="#signin-register" data-toggle="modal"><i class="icon-thumbs-up"></i></a>
					<a href="#signin-register" data-toggle="modal"><i class="icon-thumbs-down"></i></a>
				</b>
														
			<?php } if($imagecomment['is_reported'] >= 1){?>
														
			<a href="javascript:void(0);" class="show-reported-comment reported-message<?php echo $imagecomment['commentid']; ?>" data-commentid="<?php echo $imagecomment['commentid']; ?>"><small>show</small></a>
										
			<span class="hide-reported hide-reported<?php echo $imagecomment['commentid'];?>">
													
				<a href="javascript:void(0);" class="show-hide-reply-comment" data-commentid="<?php echo $imagecomment['commentid']; ?>"><small>reply</small></a>
				<a href="javascript:void(0);" class="hide-comment" data-commentid="<?php echo $imagecomment['commentid']; ?>"><small>hide</small></a>
															
			</span>
													
			<?php } else {?>
								
				<a href="javascript:void(0);" class="show-hide-reply-comment" data-commentid="<?php echo $imagecomment['commentid']; ?>"><small>reply</small></a>
				<a href="#signin-register" data-toggle="modal"><small>report</small></a>
													
			<?php }?>
												
				<br>
											
			<?php if($imagecomment['is_reported'] >= 1 ){?>
												
				<p class="comments-layout reported-message<?php echo $imagecomment['commentid']; ?>">Reported as spam</p>
												
				<p class="comments-layout hide-reported hide-reported<?php echo $imagecomment['commentid']; ?>"><?php echo $imagecomment['comment']; ?></p>
												
			<?php } else {?>
													
				<p class="comments-layout"><?php echo $imagecomment['comment']; ?></p>
													
			<?php }?>
														
				<span class="reply-comment" id="<?php echo $imagecomment['commentid']; ?>">
					<div class="row-fluid">
						<div class="span12">
																	
						<textarea class="<?php echo $imagecomment['commentid']; ?>" id="reply-textarea" placeholder="Comment..."></textarea><br>
						<a href="#signin-register" class="btn btn-mini submit-reply-button" data-toggle="modal"><strong>Submit</strong></a>
						<strong><span id="comment-counter<?php echo $imagecomment['commentid']; ?>"></span></strong>
				
						</div>
					</div>
				</span>
															
				<script type="text/javascript">$('.<?php echo $imagecomment['commentid']; ?>').limit('140','#comment-counter<?php echo $imagecomment['commentid']; ?>');</script>
															
			<?php } else {?>
															
				<p>Deleted</p>
															
			<?php }?>
														
				<span class="<?php echo $imagecomment['commentid']; ?>subcomments">
																
				</span>
															
			</div>
		</div>
	</div>
</span>
<?php }?>
			
<script type="text/javascript">
	$('.icon-thumbs-up').tooltip();
	$('.hide-reported').hide();
	$('.reply-comment').hide();
	$('.imgcomment').limit('140', '#comment-counter');
</script>