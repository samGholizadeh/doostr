		<div class="row-fluid">
			<div class="span12">
			
				<div class="span10" id="title-container">
					<p id="image-title"><strong><?php echo $image_info['title']; ?></strong></p>
				</div>
				
				<div class="span2" id="next-image">
				
				<?php if($_SESSION['subcategory']){?>
	
						<button class="btn btn-info prev-image-sub<?php if($_SESSION['next_image_counter'] == 0){?> active done<?php } ?>"><strong>Prev</strong></button>
				
				<?php } else { ?>
				
						<button class="btn btn-info prev-image<?php if($_SESSION['next_image_counter'] == 0){?> active done<?php } ?>"><strong>Prev</strong></button>
				
				<?php }
	
				if($_SESSION['subcategory']){?>
	
						<button class="btn btn-info next-image-sub"><strong>Next</strong></button>
				
				<?php } else {?>
				
						<button class="btn btn-info next-image"><strong>Next</strong></button>
				
				<?php } ?>
				
				</div>
	
			</div>
		</div>
				
		<div class="row-fluid" id="rate-image-container-outer">			<!-- image row -->
			<div class="span12">
				<div class="row-fluid" id="rate-image-container-inner">
					<div class="span12">
						<a href="#" id="large-image-rated-two"><img class="mainimage" id="align-img" src="<?php echo $random_image; ?>" data-category="<?php echo $image_info['category']; ?>" data-subcategory="<?php echo $image_info['subcategory']; ?>" 
							data-image_id="<?php echo $image_info['image_id']?>" data-votes="<?php echo $image_info['numvotes'];?>" data-totalscore="<?php echo $image_info['totalscore']; ?>" 
							data-size="<?php echo $image_info['size']; ?>" data-bandwidth="<?php echo $image_info['bandwidth']; ?>" data-user_id="<?php echo $image_info['user_id']; ?>" data-filename="<?php echo $image_info['filename']; ?>"/></a>
					</div>
				</div>
			</div>
		</div>
				
		<div class="row-fluid" id="voteimage-info-container">
			<div class="span12">
			
				<div class="span12">
					<div class="row-fluid" id="voteimage-info-inner">
						<div class="span10">
						Uploaded by:
						
						<?php if($_SESSION['user_id'] == $image_info['user_id']){?>

							<small id="comment-font-size"><a href="?a=profile"><strong><?php echo $image_info['username']; ?></strong></a>
								
						<?php } else {?>
						
							<small id="comment-font-size"><a href="javascript:void(0);" class="userlink" data-userx_id="<?php echo $image_info['user_id']; ?>"><strong><?php echo $image_info['username']; ?></strong></a>
						
						<?php }?> 
							
							<span class="the-dot"> &#8226;</span>&nbsp;Views: <strong><?php echo $image_info['views']; ?></strong>&nbsp;<span class="the-dot">&#8226;</span>&nbsp;Bandwidth used: <strong><?php echo $image_info['bandwidth']; ?></strong> MB
							
							<span class="the-dot"> &#8226;</span><strong> http://doostr.com/?i=<?php echo $image_info['filename']; ?></strong>
						</div>
						
						<div class="span2">
							&nbsp;<a href="#" id="large-image-rated" class="btn btn-small btn-info voteview-options-design" rel="tooltip" title="Resize full" data-filename="<?php echo $image_info['filename']; ?>"><i class="icon-resize-full icon-white"></i></a>
						</div>
						
					</div>
				</div>
				
				<!--<div class="span4">
					<div class="row-fluid" id="voteimage-info-likes">
						<div class="span12">
						
							<div class="span6" id="voteimage-like-bar">
								like bar
							</div>
							
							 <div class="span6 image-thumbs" id="image-thumbs">
								<button class="btn" id="like-image-thumb"><strong><i class="icon-thumbs-up"></i></strong></button>
								<button class="btn" id="dislike-image"><strong><i class="icon-thumbs-down"></i></strong></button>
							</div> 
							
						</div>
					</div>
				</div>-->
			</div>
		</div>
	
	
		<div class="row-fluid" id="votenumbers-submit-comment">
			<div class="span12">
			
				<div class="row-fluid" id="vote-numbers-result">						
					<div class="span12">
					
						<div class="span7 button-group">
							<div class="btn-group">
								<button class="btn btn-large btn-info" data-votevalue="1"><strong>1</strong></button>
								<button class="btn btn-large btn-info" data-votevalue="2"><strong>2</strong></button>
								<button class="btn btn-large btn-info" data-votevalue="3"><strong>3</strong></button>
								<button class="btn btn-large btn-info" data-votevalue="4"><strong>4</strong></button>
								<button class="btn btn-large btn-info" data-votevalue="5"><strong>5</strong></button>
								<button class="btn btn-large btn-info" data-votevalue="6"><strong>6</strong></button>
								<button class="btn btn-large btn-info" data-votevalue="7"><strong>7</strong></button>
								<button class="btn btn-large btn-info" data-votevalue="8"><strong>8</strong></button>
								<button class="btn btn-large btn-info" data-votevalue="9"><strong>9</strong></button>
								<button class="btn btn-large btn-info" data-votevalue="10"><strong>10</strong></button>
							</div>
						</div>
						
						<div class="span4" id="vote-result">
							<p>Votes: <strong id="vote-incremenet"><?php echo $image_info['numvotes']; ?></strong> Avg. <strong id="display-average"></strong></p>
						</div>
						
						<div class="span1" id="fav-img">
							<button class="btn btn-info fav-img <?php if(($favourite[0] >= 1) || ($_SESSION['user_id'] == $image_info['user_id'])){ ?>active done<?php }?>"><strong>Fav.</strong></button>
						</div>
						
					</div>										
				</div>
				
			
				<div class="row-fluid">
					<div class="span12" id="vote-comment-container">
					
						<div class="span11">
							<textarea class="imgcomment" placeholder="Comment..."></textarea>
						</div>
						
						<div class="span1" id="submit-counter-container">
						
							<div class="row-fluid" id="submit-button-container">
								<div class="span12">
									<button class="btn btn-small btn-info" id="submit-comment-voteimg"><strong>Submit</strong></button>
								</div>
							</div>
							
							<div class="row-fluid">
								<div class="span12">
									<strong><span id="comment-counter"></span></strong>
								</div>
							</div>
							
						</div>
						
					</div>					
				</div>
				
			</div>
		</div>
				
				
				
				
				<div class="row-fluid comment-container-outer">
					<div class="span12">
						<?php if(!$imagecomments){?>
							<span id="vote-comment-template">
								
							</span>
				
							<?php } else { 
									
									for($i = 0; $i <= 2; $i++){
										
									
										if((empty($imagecomments[0][$i]['comment'])) || ($imagecomments[0][$i]['display_state'] == 1)){

											continue;
									
									} else { ?>
										<?php $_SESSION['toplist'.$i] =  $imagecomments[0][$i]['commentid'];?>
										
										<span id="comment<?php echo $imagecomments[0][$i]['commentid']; ?>">
										
											<div class="row-fluid">
												<div class="span12" id="comment">
												
													<div class="span1 reply-indicator">
													
													
														<?php if($imagecomments[0][$i]['has_replies'] >= 1){?>
															<a href="javascript:void(0);" id="extend-comment<?php echo $imagecomments[0][$i]['commentid']; ?>" class="onclick" data-commentid="<?php echo $imagecomments[0][$i]['commentid']; ?>"><strong>+</strong></a>
														<?php }?>
														
														
													</div>
													
													<div class="span11" id="comment-inner">
													
													<?php if($imagecomments[0][$i]['display_state'] == 0){
														
															if($_SESSION['user_id'] == $imagecomments[0][$i][2]){?>

																	<small id="comment-font-size"><a href="?a=profile"><strong><?php echo $imagecomments[0][$i]['username']; ?></strong></a>
										
															<?php } else {?>
								
																	<small id="comment-font-size"><a href="javascript:void(0);" class="userlink" data-userx_id="<?php echo $imagecomments[0][$i][2]; ?>"><strong><?php echo $imagecomments[0][$i]['username']; ?></strong></a>
								
															<?php }?>  
														
														<i class="icon-thumbs-up" rel="tooltip" title="<?php echo $imagecomments[0][$i]['comment_likes'];?> likes, <?php echo $imagecomments[0][$i]['comment_dislikes'];?> dislikes"></i>
														
														<strong id="<?php echo $imagecomments[0][$i]['commentid']; ?>-likes"><?php echo $imagecomments[0][$i]['comment_likes'];?></strong>&nbsp;<span class="the-dot"> &#8226;</span>&nbsp;</small>
														
														<?php if(($_SESSION['user_id'] != $imagecomments[0][$i]['user_id']) && ($imagecomments[0][$i]['is_reported'] < 50) && ($_SESSION['user_id'] != $imagecomments[0][$i][2])){?>
														
														<b class="<?php echo $imagecomments[0][$i]['commentid']; ?>like">
															<a href="javascript:void(0);" class="likecomment" id="likecomment" data-commentid="<?php echo $imagecomments[0][$i]['commentid']; ?>" data-user_id="<?php echo $imagecomments[0][$i][2]; ?>"><i class="icon-thumbs-up"></i></a>
															<a href="javascript:void(0);" class="dislikecomment" id="dislikecomment" data-commentid="<?php echo $imagecomments[0][$i]['commentid']; ?>" data-user_id="<?php echo $imagecomments[0][$i][2]; ?>"><i class="icon-thumbs-down"></i></a>
														</b>
														
														<?php } 
														
														
														if($_SESSION['user_id'] == $imagecomments[0][$i][2]){?>
															
														<a href="javascript:void(0);" class="remove-comment" data-commentid="<?php echo $imagecomments[0][$i]['commentid'];?>"><small>remove</small></a>
														
															<?php if($imagecomments[0][$i]['is_reported'] >= 1){?>
														
																	<a href="#" class="show-reported-comment reported-message<?php echo $imagecomments[0][$i]['commentid']; ?>" data-commentid="<?php echo $imagecomments[0][$i]['commentid']; ?>"><small>show</small></a>
										
																	<span class="hide-reported hide-reported<?php echo $imagecomments[0][$i]['commentid'];?>">
												
																	<a href="#" class="hide-comment" data-commentid="<?php echo $imagecomments[0][$i]['commentid']; ?>"><small>hide</small></a>
															
																</span>
																
														<?php }} else { 
																
															if($imagecomments[0][$i]['is_reported'] >= 1){?>
																
																<a href="javascript:void(0);" class="show-reported-comment reported-message<?php echo $imagecomments[0][$i]['commentid']; ?>" data-commentid="<?php echo $imagecomments[0][$i]['commentid']; ?>"><small>show</small></a>
																
																
																<span class="hide-reported hide-reported<?php echo $imagecomments[0][$i]['commentid'];?>">
																
																	<a href="javascript:void(0);" class="show-hide-reply-comment" data-commentid="<?php echo $imagecomments[0][$i]['commentid']; ?>"><small>reply</small></a>
																	<a href="javascript:void(0);" class="hide-comment" data-commentid="<?php echo $imagecomments[0][$i]['commentid']; ?>"><small>hide</small></a>
																	
																</span>
															
															<?php } else {?>
															
																	<a href="javascript:void(0);" class="show-hide-reply-comment" data-commentid="<?php echo $imagecomments[0][$i]['commentid']; ?>"><small>reply</small></a>
																	<a href="javascript:void(0);" class="report-comment" data-commentid="<?php echo $imagecomments[0][$i]['commentid']; ?>"><small>report</small></a>
			
																<?php }}?>
														
														<br>
																	
															<?php if($imagecomments[0][$i]['is_reported'] >= 1 ){?>
															
																<p class="comments-layout reported-message<?php echo $imagecomments[0][$i]['commentid']; ?>">Reported as spam</p>
															
																<p class="comments-layout hide-reported hide-reported<?php echo $imagecomments[0][$i]['commentid']; ?>"><?php echo $imagecomments[0][$i]['comment']; ?></p>
															
															<?php } else {?>
															
																<p class="comments-layout"><?php echo $imagecomments[0][$i]['comment']; ?></p>
																
															<?php }?>
															
														<span class="reply-comment" id="<?php echo $imagecomments[0][$i]['commentid']; ?>">
																<div class="row-fluid">
																	<div class="span12">
																	
																	<textarea class="<?php echo $imagecomments[0][$i]['commentid']; ?>" id="reply-textarea" placeholder="Comment..."></textarea><br>
																	<button class="btn btn-mini submit-reply-button" data-commentid="<?php echo $imagecomments[0][$i]['commentid']; ?>"><strong>Submit</strong></button>
																	<strong><span id="comment-counter<?php echo $imagecomments[0][$i]['commentid']; ?>"></span></strong>
																</div>
															</div>
														</span>
														
														<script type="text/javascript">$('.<?php echo $imagecomments[0][$i]['commentid']; ?>').limit('140','#comment-counter<?php echo $imagecomments[0][$i]['commentid']; ?>');</script>
														
														<?php } else { ?>
														
														<?php } ?>
														
														<span class="<?php echo $imagecomments[0][$i]['commentid']; ?>subcomments">
														
														
														</span>
													
													</div>	
												</div>
											</div>
										</span>
									<?php }}?>
									
								
									<br>
									<!-- new user comment goes here -->
									<span id="vote-comment-template">
										
									</span>
									
							<span class="page5">
								
								<?php $x= 0; for($i = 0; $i <= (count($imagecomments[1]) - 1); $i++){
								
									if(($imagecomments[0][0]['commentid'] == $imagecomments[1][$i]['commentid']) || ($imagecomments[0][1]['commentid'] == $imagecomments[1][$i]['commentid']) || ($imagecomments[0][2]['commentid'] == $imagecomments[1][$i]['commentid'])
											|| ($imagecomments[1][$i]['display_state'] == 1)){ continue; } else { ?>
								
								<span id="comment<?php echo $imagecomments[1][$i]['commentid']; ?>">
											
								<div class="row-fluid">
									<div class="span12" id="comment">
											
										<div class="span1 reply-indicator">
										
										
											<?php if($imagecomments[1][$i]['has_replies'] >= 1){?>
												<a href="javascript:void(0);" id="extend-comment<?php echo $imagecomments[1][$i]['commentid']; ?>" class="onclick" data-commentid="<?php echo $imagecomments[1][$i]['commentid']; ?>"><strong>+</strong></a><br>
											<?php }?>
											
											
										</div>
											
										<div class="span11" id="comment-inner">
										
										<?php if($imagecomments[1][$i]['display_state'] == 0){
										
											if($_SESSION['user_id'] == $imagecomments[1][$i][2]){?>

												<small id="comment-font-size"><a href="?a=profile"><strong><?php echo $imagecomments[1][$i]['username']; ?></strong></a>
										
											<?php } else {?>
								
												<small id="comment-font-size"><a href="javascript:void(0);" class="userlink" data-userx_id="<?php echo $imagecomments[1][$i][2]; ?>"><strong><?php echo $imagecomments[1][$i]['username']; ?></strong></a>
								
											<?php }?> 
											
											<i class="icon-thumbs-up" rel="tooltip" title="<?php echo $imagecomments[1][$i]['comment_likes'];?> likes, <?php echo $imagecomments[1][$i]['comment_dislikes'];?> dislikes"></i>
											
											<strong id="<?php echo $imagecomments[1][$i]['commentid']; ?>-likes"><?php echo $imagecomments[1][$i]['comment_likes'];?></strong>&nbsp;<span class="the-dot"> &#8226;</span>&nbsp;</small>
											
											<?php if(($_SESSION['user_id'] != $imagecomments[1][$i]['user_id']) && ($imagecomments[1][$i]['is_reported'] < 1) && ($_SESSION['user_id'] != $imagecomments[1][$i][2])){ ?>

												
													<b class="<?php echo $imagecomments[1][$i]['commentid']; ?>like">
													
														<a href="javascript:void(0);" class="likecomment" id="likecomment" data-commentid="<?php echo $imagecomments[1][$i]['commentid']; ?>" data-user_id="<?php echo $imagecomments[1][$i][2]; ?>"><i class="icon-thumbs-up"></i></a>
														<a href="javascript:void(0);" class="dislikecomment" id="dislikecomment" data-commentid="<?php echo $imagecomments[1][$i]['commentid']; ?>" data-user_id="<?php echo $imagecomments[1][$i][2]; ?>"><i class="icon-thumbs-down"></i></a>
													
													</b>
												
												
											<?php } if($_SESSION['user_id'] == $imagecomments[1][$i][2]){?>
																
												<a href="javascript:void(0);" class="remove-comment" data-commentid="<?php echo $imagecomments[1][$i]['commentid'];?>"><small>remove</small></a>
																
												<?php } else { 
													
													if($imagecomments[1][$i]['is_reported'] >= 1){?>
														
														<a href="javascript:void(0);" class="show-reported-comment reported-message<?php echo $imagecomments[1][$i]['commentid']; ?>" data-commentid="<?php echo $imagecomments[1][$i]['commentid']; ?>"><small>show</small></a>
														
														
														<span class="hide-reported hide-reported<?php echo $imagecomments[1][$i]['commentid'];?>">
														
															<a href="javascript:void(0);" class="show-hide-reply-comment" data-commentid="<?php echo $imagecomments[1][$i]['commentid']; ?>"><small>reply</small></a>
															<a href="javascript:void(0);" class="hide-comment" data-commentid="<?php echo $imagecomments[1][$i]['commentid']; ?>"><small>hide</small></a>
															
														</span>
													
													<?php } else {?>
													
															<a href="javascript:void(0);" class="show-hide-reply-comment" data-commentid="<?php echo $imagecomments[1][$i]['commentid']; ?>"><small>reply</small></a>
															<a href="javascript:void(0);" class="report-comment" data-commentid="<?php echo $imagecomments[1][$i]['commentid']; ?>"><small>report</small></a>
													
													<?php }?>
																
												<?php }?>
												
												<br>
												
												<?php if($imagecomments[1][$i]['is_reported'] >= 1 ){?>
												
													<p class="comments-layout reported-message<?php echo $imagecomments[1][$i]['commentid']; ?>">Reported as spam</p>
												
													<p class="comments-layout hide-reported hide-reported<?php echo $imagecomments[1][$i]['commentid']; ?>"><?php echo $imagecomments[1][$i]['comment']; ?></p>
												
												<?php } else {?>
												
													<p class="comments-layout"><?php echo $imagecomments[1][$i]['comment']; ?></p>
													
												<?php }?>

												
												<span class="reply-comment" id="<?php echo $imagecomments[1][$i]['commentid']; ?>">
													<div class="row-fluid">
														<div class="span12">
																	
															<textarea class="<?php echo $imagecomments[1][$i]['commentid']; ?>" id="reply-textarea" placeholder="Comment..."></textarea><br>
															<button class="btn btn-mini submit-reply-button" data-commentid="<?php echo $imagecomments[1][$i]['commentid']; ?>"><strong>Submit</strong></button>
															<strong><span id="comment-counter<?php echo $imagecomments[1][$i]['commentid']; ?>"></span></strong>
																	
														</div>
													</div>
												</span>
												
										
												
												<script type="text/javascript">

													$('.<?php echo $imagecomments[1][$i]['commentid']; ?>').limit('140','#comment-counter<?php echo $imagecomments[1][$i]['commentid']; ?>');

												</script>
												
											<?php } else {?>
											
											<?php }?>
												
												<span class="<?php echo $imagecomments[1][$i]['commentid']; ?>subcomments">
														
														
												</span>
											</div>
											
											
										</div>
									</div>
								</span>
								
								
								
							<?php $x++; }}?>
							
							</span>
							
							<?php 
							$comment_pages = $count_comments[0]/15;
								
							if($comment_pages >= 1){
									
								for($i = 2; $i <= ($comment_pages + 1); $i++){?>
															
									<span class="page5">
										<span class="comments_page<?php echo $i;?>">
															
										</span>
									</span>
															
							<?php } ?>
							
								<div class="pagination pagination-mini pagination-centered">
									<ul class="comment-nav">
										<?php for($i = 1; $i <= ($comment_pages + 1); $i++){ ?>
											<li class="<?php if($i == 1){?>active<?php }?>"><a href="javascript:void(0);" class="next-page<?php if($i == 1){?> done<?php } ?>" data-current_page="<?php echo $i?>"><?php echo $i; ?></a></li>
										<?php } ?>
									</ul>
								</div>
						<?php }
							
							}?>
						</div>
					</div>
					
					<script type="text/javascript">
					$('.hide-reported').hide();
					$('.reply-comment').hide();
					$('.imgcomment').limit('140', '#comment-counter');
					</script>