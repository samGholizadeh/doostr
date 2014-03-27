				<div class="row-fluid">
					<div class="span12">
						<?php if(!$comments){?>
						
								<h5 id="commentContainer-inner">No comments available.</h5>
				
							<?php } else { ?> 
								
								<div class="row-fluid">
									<div class="span11">
										<ul class="nav nav-tabs comments-nav">
											<li class="active"><a href="javascript:void(0);"><strong id="revolver">Most recent</strong></a></li>
											<li><a href="javascript:void(0);" class="profile-comments-likes" data-user_id="<?php echo $comments[0]['user_id']; ?>"><strong id="revolver">Likes</strong></a></li>
										</ul>
									</div>
								</div>
								
							
								
							<div class="page3">
								
								<span class="page6">
									<?php foreach($comments as $comment){
									
										if(($_SESSION['user_true'] != true) && ($comment['state'] >= 2) && ($comment['user_id'] != $_SESSION['user_id'])){

											continue;
											
										 } else { ?>
									<span id="comment<?php echo $comment['commentid']; ?>">
							
									<div class="row-fluid" id="commentContainer-inner">
										<div class="span12">
											
											<div class="span2">
												<div class="comment-image-container nailthumbs-comments">
													<img src="../member/<?php echo $comment['user_id']?>/thumbnail/mini<?php echo $comment['filename'];?>" />
												</div>
											</div>
											
											<div class="span10" id="comment-profile">
												<div class="row-fluid">
													<div class="span12" id="comment">
													
														<span id="parent-comment<?php echo $comment['commentid']; ?>">
														
														</span>	
													
														<div class="span1 reply-indicator-com">
									
																<?php if($comment['has_replies'] >= 1){?>
																	<a href="javascript:void(0);" id="extend-comment-com<?php echo $comment['commentid'];?>" class="get-profile-comments" data-commentid="<?php echo $comment['commentid']?>"><strong>+</strong></a>
																<?php }?>
																
														</div>
																	
																	
														<div class="span11" id="comment-inner">
						
															<small id="comment-font-size"><strong><?php echo $comment['username']; ?></strong>
															
															<i class="icon-thumbs-up" rel="tooltip" title="<?php echo $comment['comment_likes'];?> likes, <?php echo $comment['comment_dislikes'];?> dislikes"></i>
															
															<strong id="<?php echo $comment['commentid']; ?>-likes"><?php echo $comment['comment_likes'];?></strong>&nbsp;<span class="the-dot"> &#8226;</span>&nbsp;</small>
															
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
																			<textarea class="<?php echo $comment['commentid']; ?>" id="reply-textarea" placeholder="Comment..."></textarea><br>
																			<button class="btn btn-mini profile-submit-reply-button" data-commentid="<?php echo $comment['commentid']; ?>" data-image_id="<?php echo $comment['image_id']; ?>" data-arbitrary="0"><strong>Submit</strong></button>
																			<strong><span id="comment-counter<?php echo $comment['commentid']; ?>"></span></strong>
																		</div>
																	</div>
																</span>
																
																<script type="text/javascript">$('.<?php echo $comment['commentid']; ?>').limit('140','#comment-counter<?php echo $comment['commentid']; ?>');</script>
															<?php }?>
															
															<span class="<?php echo $comment['commentid']; ?>subcomments">
														
															
															</span>
															
														</div>
													</div>
												</div>	
											</div>
										</div>
									</div>
								</span>
										
							<?php }}?>
							</span>
							
							<?php
							
							$comment_pages = $count_comments[0]/10;
							
							if($comment_pages >= 1){
							
							for($i = 2; $i <= ($comment_pages + 1); $i++){?>
								
								<span class="page6">
									<span class="comments-page<?php echo $i;?>">
								
									</span>
								</span>
								
							<?php } ?>
								<div class="pagination pagination-mini pagination-centered">
									<ul class="profile-comment-nav">
										<?php for($i = 1; $i <= ($comment_pages + 1); $i++){ ?>
											<li class="<?php if($i == 1){?> active<?php }?>"><a href="javascript:void(0);" class="profile-comment-next-page<?php if($i == 1){?> done<?php } ?>" 
											data-current_page="<?php echo $i; ?>"><?php echo $i; ?></a></li>
										<?php } ?>
									</ul>
								</div>
							<?php } ?>
								
						</div> <!-- First page 3 ends -->
							
							
						<div class="page3 comment-likes">
							
								
						</div>
					<?php }?>
				</div>
			</div>
			
		<script type="text/javascript">
		$('.nailthumbs-comments').nailthumb();
		$('.hide-reported').hide();
		$('.icon-thumbs-up').tooltip();
		$('.reply-comment').hide();
		</script>