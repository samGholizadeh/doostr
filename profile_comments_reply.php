		<?php foreach($comments as $comment){?>
									
				<span id="comment<?php echo $comment['commentid']; ?>">
							
					<div class="row-fluid">
						<div class="span12">
													
							<span id="parent-comment<?php echo $comment['commentid']; ?>">
														
							</span>	
													
								<div class="span1 reply-indicator-com">
									
									<?php if($comment['has_replies'] >= 1){?>
										<a href="javascript:void(0);" id="extend-comment-com<?php echo $comment['commentid'];?>" class="get-profile-comments" data-commentid="<?php echo $comment['commentid']; ?>"><strong>+</strong></a>
									<?php }?>
																
								</div>
																	
																	
							<div class="span11" id="comment-inner">
										
								<?php if($comment['display_state'] == 0){
								
									if($_SESSION['user_id'] == $comment[2]){?>

										<small id="comment-font-size"><strong><?php echo $comment['username']; ?></strong>
										
									<?php } else {?>
								
										<small id="comment-font-size"><a href="javascript:void(0);" class="userlink" data-userx_id="<?php echo $comment[2]; ?>"><strong><?php echo $comment['username']; ?></strong></a>
								
									<?php }?> 
								
								<i class="icon-thumbs-up" rel="tooltip" title="<?php echo $comment['comment_likes'];?> likes, <?php echo $comment['comment_dislikes'];?> dislikes"></i>
								
								<strong id="<?php echo $comment['commentid']; ?>-likes"><?php echo $comment['comment_likes'];?></strong>&nbsp;<span class="the-dot"> &#8226;</span>&nbsp;</small>
											
								<?php if(($_SESSION['user_id'] != $comment['user_id']) && ($comment['is_reported'] < 1) && ($_SESSION['user_id'] != $comment[2])){?>
												
									<b class="<?php echo $comment['commentid']; ?>like">
													
									<a href="javascript:void(0);" class="likecomment" id="likecomment" data-commentid="<?php echo $comment['commentid']; ?>" data-user_id="<?php echo $comment[2]; ?>"><i class="icon-thumbs-up"></i></a>
									<a href="javascript:void(0);" class="dislikecomment" id="dislikecomment" data-commentid="<?php echo $comment['commentid']; ?>" data-user_id="<?php echo $comment[2]; ?>"><i class="icon-thumbs-down"></i></a>
													
									</b>
												
												
								<?php } 
								
								if($_SESSION['user_id'] == $comment[2]){?>
																
									<a href="javascript:void(0);" class="remove-comment" data-commentid="<?php echo $comment['commentid'];?>"><small>remove</small></a>
									
										<?php if($comment['is_reported'] >= 1){?>
														
											<a href="javascript:void(0);" class="show-reported-comment reported-message<?php echo $comment['commentid']; ?>" data-commentid="<?php echo $comment['commentid']; ?>"><small>show</small></a>
										
											<span class="hide-reported<?php echo $comment['commentid'];?>">
											
											<a href="javascript:void(0);" class="hide-comment" data-commentid="<?php echo $comment['commentid']; ?>"><small>hide</small></a>
															
											</span>
																
								<?php }} else { 
													
									if($comment['is_reported'] >= 1){?>
														
										<a href="javascript:void(0);" class="show-reported-comment reported-message<?php echo $comment['commentid']; ?>" data-commentid="<?php echo $comment['commentid']; ?>"><small>show</small></a>
										
										<span class="hide-reported<?php echo $comment['commentid'];?>">
														
											<a href="javascript:void(0);" class="show-hide-reply-comment" data-commentid="<?php echo $comment['commentid']; ?>"><small>reply</small></a>
											<a href="javascript:void(0);" class="hide-comment" data-commentid="<?php echo $comment['commentid']; ?>"><small>hide</small></a>
															
										</span>
													
								<?php } else {?>
								
										<a href="javascript:void(0);" class="show-hide-reply-comment" data-commentid="<?php echo $comment['commentid']; ?>"><small>reply</small></a>
										<a href="javascript:void(0);" class="report-comment" data-commentid="<?php echo $comment['commentid']; ?>"><small>report</small></a>
													
									<?php }?>
																
								<?php }?>
												
								<br>
												
								<?php if($comment['is_reported'] >= 1 ){?>
												
									<p class="comments-layout reported-message<?php echo $comment['commentid']; ?>">Reported as spam</p>
												
									<p class="comments-layout hide-reported<?php echo $comment['commentid']; ?>"><?php echo $comment['comment']; ?></p>
									
									<script text="text/javascript">$('.hide-reported<?php echo $comment['commentid']; ?>').hide();</script>
												
								<?php } else {?>
												
									<p class="comments-layout"><?php echo $comment['comment']; ?></p>
													
								<?php }?>

												
									<span class="reply-comment" id="<?php echo $comment['commentid']; ?>">
										<div class="row-fluid">
											<div class="span12">
																	
												<textarea class="<?php echo $comment['commentid']; ?>" id="reply-textarea" placeholder="Comment..."></textarea><br>
												<button class="btn btn-mini profile-submit-reply-button" data-commentid="<?php echo $comment['commentid']; ?>" data-image_id="<?php echo $comment['image_id']; ?>" data-arbitrary="0"><strong>Submit</strong></button>
												<strong><span id="comment-counter<?php echo $comment['commentid']; ?>"></span></strong>
																	
											</div>
										</div>
									</span>
												
									<script type="text/javascript">
									$('.<?php echo $comment['commentid']; ?>').limit('140','#comment-counter<?php echo $comment['commentid']; ?>');
									</script>
												
									<?php } else {?>
												
										<p>Deleted</p>
											
									<?php }?>
												
									<span class="<?php echo $comment['commentid']; ?>subcomments">
														
														
									</span>
							</div>
														
						</div>
								
					</div>
				</span>
								
			<?php }?>
								
	<script type="text/javascript">
		$('.icon-thumbs-up').tooltip();
		$('.reply-comment').hide();
	</script>