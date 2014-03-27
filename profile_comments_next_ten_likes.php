<?php foreach($comments as $comment){
	
	if(($_SESSION['user_true'] != true) && ($comment['state'] >= 2) && ($comment['user_id'] != $_SESSION['user_id'])){

		continue;
											
	 } else { ?>
									
			<span id="comment<?php echo $comment['commentid']; ?>">
							
				<div class="row-fluid" id="commentContainer-inner">
					<div class="span12">
											
						<div class="span2">
							<div class="comment-image-container nailthumbs-likes<?php echo $current_page; ?>">
								<img src="../member/<?php echo $comment['user_id']?>/thumbnail/mini<?php echo $comment['filename'];?>" />
							</div>
						</div>
											
						<div class="span10" id="comment-profile">
							<div class="row-fluid">
								<div class="span12" id="comment">
													
									<span id="parent-comment<?php echo $comment['commentid']; ?>">
														
									</span>	
													
								<div class="span1 reply-indicator-com-likes">
									
									<?php if($comment['has_replies'] >= 1){?>
										<a href="javascript:void(0);" id="extend-comment-com-likes<?php echo $comment['commentid']; ?>" class="get-profile-comments-likes" data-commentid="<?php echo $comment['commentid']; ?>"><strong>+</strong></a>
									<?php }?>
																
								</div>
																	
																	
								<div class="span11" id="comment-inner">
						
									<small id="comment-font-size"><strong><?php echo $comment['username']; ?></strong>
									
									<i class="icon-thumbs-up"></i>
									
									<strong id="<?php echo $comment['commentid']; ?>-likes"><?php echo $comment['comment_likes'];?></strong> &nbsp;<span class="the-dot"> &#8226;</span>&nbsp;</small>
									
								<?php 

								if($_SESSION['user_id'] == $comment[2]){?>
																
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
														
											<a href="javascript:void(0);" class="show-hide-reply-comment" data-commentid="<?php echo $comment['commentid']; ?>"><small>reply</small></a>
											<a href="javascript:void(0);" class="hide-comment" data-commentid="<?php echo $comment['commentid']; ?>"><small>hide</small></a>
															
										</span>
														
								<?php } else {?>
								
									<a href="javascript:void(0);" class="show-hide-reply-comment" data-commentid="<?php echo $comment['commentid']; ?>"><small>reply</small></a>
									<a href="javascript:void(0);" class="report-comment" data-commentid="<?php echo $comment['commentid']; ?>"><small>report</small></a>
													
								<?php }}?>
												
								<br>
															
								<?php if($comment['is_reported'] >= 1 ){?>
												
									<p class="comments-layout reported-message<?php echo $comment['commentid']; ?>">Reported as spam</p>
												
									<p class="comments-layout hide-reported hide-reported<?php echo $comment['commentid']; ?>"><?php echo $comment['comment']; ?></p>
												
								<?php } else {?>
												
									<p class="comments-layout"><?php echo $comment['comment']; ?></p>
													
								<?php }?>
													
								<?php if($_SESSION['user_id'] != $comment[2]){?>
																
									<span class="reply-comment" id="<?php echo $comment['commentid']; ?>">
										<div class="row-fluid">
											<div class="span12">
												<textarea class="<?php echo $comment['commentid']; ?> like<?php echo $comment['commentid']; ?>" id="reply-textarea" placeholder="Comment..."></textarea><br>
												<button class="btn btn-mini profile-submit-reply-button" data-commentid="<?php echo $comment['commentid']; ?>" data-image_id="<?php echo $comment['image_id']; ?>" data-arbitrary="1"><strong>Submit</strong></button>
												<strong><span id="comment-counter-like<?php echo $comment['commentid']; ?>"></span></strong>
											</div>
										</div>
									</span>
																
									<script type="text/javascript">
									
										$('.like<?php echo $comment['commentid']; ?>').limit('140','#comment-counter-like<?php echo $comment['commentid']; ?>');
										
									</script>
							
								<?php }?>
													
								<span class="<?php echo $comment['commentid']; ?>subcomments-bylikes">
														
															
								</span>
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</span>
										
	<?php }}?>
	
<script type="text/javascript">
$('.nailthumbs-likes<?php echo $current_page; ?>').nailthumb();
$('.hide-reported').hide();
$('.icon-thumbs-up').tooltip();
$('.reply-comment').hide();
</script>