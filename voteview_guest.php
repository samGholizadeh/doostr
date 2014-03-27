<?php
	include('view/header.php');
?>
<span class="insert-profile">
	<div class="row-fluid">
		<div class="span12">
		
			<?php if($image_info['category'] == 'meme'){ ?>
				<div class="row-fluid">
					<div class="span12 subcategory-container-outer-outer">
						<div id="meme-slide" class="carousel slide">
					
							<div class="carousel-inner">
							
								<div class="active item">
									<div class="subcategory-container-outer">
									<?php for($i = 0; $i <= 9; $i++){?>
										<div class="subcategory-container nailthumbs">
											<a href="#" class="meme-sub" data-subcategory="<?php echo $DBmeme[$i]; ?>" rel="tooltip" title="<?php echo $subcategoriesmeme[$i];?>">
												<img src="<?php echo $subcategorylinks[$i]; ?>"/></a>
										</div>
									<?php } ?>
									</div>
								</div>
								
								<div class="item">
									<div class="subcategory-container-outer">
									<?php for($i = 10; $i <= 19; $i++){?>
										<div class="subcategory-container nailthumbs">
											<a href="#" class="meme-sub" data-subcategory="<?php echo $DBmeme[$i]; ?>" rel="tooltip" title="<?php echo $subcategoriesmeme[$i];?>">
												<img src="<?php echo $subcategorylinks[$i]; ?>"/></a>
										</div>
									<?php } ?>
									</div>
								</div>
								
							</div>
							
							<a class="carousel-control left" href="#meme-slide" data-slide="prev">&lsaquo;</a>
							
							<a class="carousel-control right" href="#meme-slide" data-slide="next">&rsaquo;</a>
							
						</div>
					</div>
				</div>
			<?php } ?>
		<span id="insert-subcategory">
			<div class="row-fluid">
				<div class="span12">
					<div class="span3" id="leftvotecolumn">
					

						<div class="row-fluid" id="change-upload-button">
							<div class="span12" id="browse-filelist-outer">
								<a href="#add-images-guest" id="add-images-button-voteview" class="btn btn-info" data-toggle="modal"><i class="icon-upload icon-white"></i>&nbsp&nbsp<strong>Upload image</strong></a>
							</div>
						</div>
			

						<div class="row-fluid top10-bar" id="top10-bar-sort">
							<div class="span12">
								<button class="btn btn-small btn-info toplist active"><strong><small>Highest rating</small></strong></button>
								<button class="btn btn-small btn-info most-commented" data-sub="0"><strong><small>Most commented</small></strong></button>
								<button class="btn btn-small btn-info most-favourite" data-sub="0"><strong><small>Most favourited</small></strong></button>
								<button class="btn btn-small btn-info newest" data-sub="0"><strong><small>Newest</small></strong></button>
							</div>
						</div>
					
					<div class="page15">
					
						<div class="row-fluid top10-bar" id="top10-bar">
							<div class="span12">
								<a href="#" class="btn btn-small btn-info active done" id="fckmeright"><strong>1 day</strong></a>
								<a href="#" class="btn btn-small btn-info toplist-average" id="fckmeright" data-toplist="2"><strong>2-5</strong></a>
								<a href="#" class="btn btn-small btn-info toplist-average" id="fckmeright" data-toplist="3"><strong>6-10</strong></a>
								<a href="#" class="btn btn-small btn-info toplist-average" data-toplist="4"><strong>11-30</strong></a>
								<a href="#" class="btn btn-small btn-info toplist-average" data-toplist="5"><strong>31-90</strong></a>
								<a href="#" class="btn btn-small btn-info toplist-average" data-toplist="6"><strong>91 ></strong></a>
							</div>
						</div>
						
						
						<div class="page2">
							<div class="row-fluid" id="top10-list">
								<div class="span12">
								
										<?php if($_SESSION['subcategory']){?>
										
											<?php for($i = 0; $i <= 9; $i++){?>
												<div class="toplist-img-container nailthumbs">
												<a href="javascript:void(0);"><img src="<?php echo $filepaths[1][$i]; ?>" class="toplistimages-sub"/></a>
												</div>
											<?php }?>
											
										<?php } else {?>
										
											<?php for($i = 0; $i <= 9; $i++){?>
												<div class="toplist-img-container nailthumbs">
												<a href="javascript:void(0);"><img src="<?php echo $filepaths[1][$i]; ?>" class="toplistimages"/></a>
												</div>
											<?php }?>
											
										<?php }?>
								
								</div>
							</div>
						</div>
						
						<div class="page2" id="toplist2">
						
						</div>
						
						<div class="page2" id="toplist3">

						</div>
						
												
						<div class="page2" id="toplist4">

						</div>
						
												
						<div class="page2" id="toplist5">

						</div>
						
												
						<div class="page2" id="toplist6">

						</div>
						
				</div>
				
				<div class="page15" id="sort-comments">
				
				</div>
				
				<div class="page15" id="sort-favourites">
				
				</div>
				
				<div class="page15" id="sort-newest">
				
				</div>
					
						
						<div class="span12" id="advertisement-outer">
							<div class="hero-unit" id="advertisement-inner">
								<h5></h5>
							</div>	
						</div>
			</div> <!-- Toplist column ends here -->
			
			<div class="span9" id="rightvotecolumn"> <!-- Left column in voteview begins here -->
				
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
								<a href="#" id="large-image-rated" data-filename="<?php echo $image_info['filename']; ?>"><img class="mainimage" src="<?php echo $random_image; ?>" data-category="<?php echo $image_info['category']; ?>" data-subcategory="<?php echo $image_info['subcategory']; ?>" 
									data-image_id="<?php echo $image_info['image_id']; ?>" data-votes="<?php echo $image_info['numvotes'];?>" data-totalscore="<?php echo $image_info['totalscore']; ?>" 
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
								
									<small id="comment-font-size"><a href="#signin-register" data-toggle="modal"><strong><?php echo $image_info['username']; ?></strong></a>
								
									<span class="the-dot"> &#8226;</span>&nbsp;Views:&nbsp;<strong><?php echo $image_info['views']; ?></strong>&nbsp;<span class="the-dot">&#8226;</span>&nbsp;Bandwidth used: <strong><?php echo $image_info['bandwidth']; ?></strong> MB
									
									
									<span class="the-dot"> &#8226;</span><strong>&nbsp;&nbsp;http://doostr.com/?i=<?php echo $image_info['filename']; ?></strong>
									
									
								</div>
								
								<div class="span2">
									&nbsp;<a href="#" id="large-image-rated" class="btn btn-small btn-info voteview-options-design" rel="tooltip" title="Resize full" data-filename="<?php echo $image_info['filename']; ?>"><i class="icon-resize-full icon-white"></i></a>
								</div>
								
							</div>
						</div>
						
						<!-- <div class="span4">
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
						</div> -->
					</div>
				</div>
	
	
		<div class="row-fluid" id="votenumbers-submit-comment">
			<div class="span12">
			
				<div class="row-fluid" id="vote-numbers-result">						
					<div class="span12">
					
						<div class="span7 button-group">
							<div class="btn-group">
										<a href="#signin-register" class="btn btn-large btn-info" data-toggle="modal"><strong>1</strong></a>
										<a href="#signin-register" class="btn btn-large btn-info" data-toggle="modal"><strong>2</strong></a>
										<a href="#signin-register" class="btn btn-large btn-info" data-toggle="modal"><strong>3</strong></a>
										<a href="#signin-register" class="btn btn-large btn-info" data-toggle="modal"><strong>4</strong></a>
										<a href="#signin-register" class="btn btn-large btn-info" data-toggle="modal"><strong>5</strong></a>
										<a href="#signin-register" class="btn btn-large btn-info" data-toggle="modal"><strong>6</strong></a>
										<a href="#signin-register" class="btn btn-large btn-info" data-toggle="modal"><strong>7</strong></a>
										<a href="#signin-register" class="btn btn-large btn-info" data-toggle="modal"><strong>8</strong></a>
										<a href="#signin-register" class="btn btn-large btn-info" data-toggle="modal"><strong>9</strong></a>
										<a href="#signin-register" class="btn btn-large btn-info" data-toggle="modal"><strong>10</strong></a>
							</div>
						</div>
						
						<div class="span4" id="vote-result">
							<p>Votes: <strong id="vote-increment"><?php echo $image_info['numvotes']; ?></strong> Avg. <strong id="display-average"></strong></p>
						</div>
						
						<div class="span1" id="fav-img">
							<button href="#signin-register" class="btn btn-info" data-toggle="modal"><strong>Fav.</strong></button>
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
									<a href="#signin-register" class="btn btn-small btn-info" id="submit-comment-voteimg" data-toggle="modal"><strong>Submit</strong></a>
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
									
										<span id="comment<?php echo $imagecomments[0][$i]['commentid']; ?>">
											<?php $_SESSION['toplist'.$i] = $imagecomments[0][$i]['commentid'];?>
											
											<div class="row-fluid">
												<div class="span12" id="comment">
														
													<div class="span1 reply-indicator">
													
														<?php if($imagecomments[0][$i]['has_replies'] >= 1){?>
															<a href="javascript:void(0);" id="extend-comment<?php echo $imagecomments[0][$i]['commentid']; ?>" class="onclick" data-commentid="<?php echo $imagecomments[0][$i]['commentid']; ?>"><strong>+</strong></a>
														<?php }?>
														
													</div>
														
													<div class="span11" id="comment-inner">
													
														<?php if($imagecomments[0][$i]['display_state'] == 0){?>
														
														

															<small id="comment-font-size"><a href="#signin-register" data-toggle="modal"><strong><?php echo $imagecomments[0][$i]['username']; ?></strong></a>
										
															
															
															<i class="icon-thumbs-up" rel="tooltip" title="<?php echo $imagecomments[0][$i]['comment_likes'];?> likes, <?php echo $imagecomments[0][$i]['comment_dislikes'];?> dislikes"></i>
															
															<strong id="<?php echo $imagecomments[0][$i]['commentid']; ?>-likes"><?php echo $imagecomments[0][$i]['comment_likes'];?></strong>&nbsp;<span class="the-dot"> &#8226;</span>&nbsp;</small>
															
															<?php if($imagecomments[0][$i]['is_reported'] < 50){?>
														
														<b class="<?php echo $imagecomments[0][$i]['commentid']; ?>like">
															<a href="#signin-register" data-toggle="modal"><i class="icon-thumbs-up"></i></a>
															<a href="#signin-register" data-toggle="modal"><i class="icon-thumbs-down"></i></a>
														</b>
														
														<?php } if($imagecomments[0][$i]['is_reported'] >= 1){?>
														
																	<a href="javascript:void(0);" class="show-reported-comment reported-message<?php echo $imagecomments[0][$i]['commentid']; ?>" data-commentid="<?php echo $imagecomments[0][$i]['commentid']; ?>"><small>show</small></a>
										
																	<span class="hide-reported hide-reported<?php echo $imagecomments[0][$i]['commentid'];?>">
														
																	<a href="javascript:void(0);" class="show-hide-reply-comment" data-commentid="<?php echo $imagecomments[0][$i]['commentid']; ?>"><small>reply</small></a>
																	<a href="javascript:void(0);" class="hide-comment" data-commentid="<?php echo $imagecomments[0][$i]['commentid']; ?>"><small>hide</small></a>
															
																	</span>
													
																		<?php } else {?>
								
																	<a href="javascript:void(0);" class="show-hide-reply-comment" data-commentid="<?php echo $imagecomments[0][$i]['commentid']; ?>"><small>reply</small></a>
																	<a href="#signin-register" data-toggle="modal"><small>report</small></a>
													
															<?php }?>
												
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
																		<a href="#signin-register" class="btn btn-mini submit-reply-button" data-toggle="modal"><strong>Submit</strong></a>
																		<strong><span id="comment-counter<?php echo $imagecomments[0][$i]['commentid']; ?>"></span></strong>
																	</div>
																</div>
															</span>
															
															<script type="text/javascript">$('.<?php echo $imagecomments[0][$i]['commentid']; ?>').limit('140','#comment-counter<?php echo $imagecomments[0][$i]['commentid']; ?>');</script>
															
														<?php } ?>
														
															<span class="<?php echo $imagecomments[0][$i]['commentid']; ?>subcomments">
																
															</span>
															
													</div>
												</div>
											</div>
										</span>
									<?php }}?>
									
								
									<br>
									
									<span id="vote-comment-template">
										
									</span>
							
							<span class="page5">
								
								<?php for($i = 0; $i <= (count($imagecomments[1]) - 1); $i++){
								
									if(($imagecomments[0][0]['commentid'] == $imagecomments[1][$i]['commentid']) || ($imagecomments[0][1]['commentid'] == $imagecomments[1][$i]['commentid']) || ($imagecomments[0][2]['commentid'] == $imagecomments[1][$i]['commentid'])
											|| ($imagecomments[1][$i]['display_state'] == 1)){ continue; } else { ?>
											
									<span id="comment<?php echo $imagecomments[1][$i]['commentid']; ?>">
											
									<div class="row-fluid">
										<div class="span12" id="comment">
											
										<div class="span1 reply-indicator">
											<?php if($imagecomments[1][$i]['has_replies'] >= 1){?>
												<a href="javascript:void(0);" id="extend-comment<?php echo $imagecomments[1][$i]['commentid']; ?>" class="onclick" data-commentid="<?php echo $imagecomments[1][$i]['commentid']; ?>"><strong>+</strong></a>
											<?php }?>
										</div>
											
										<div class="span11" id="comment-inner">
										
										<?php if($imagecomments[1][$i]['display_state'] == 0){?>

												<small id="comment-font-size"><a href="#signin-register" data-toggle="modal"><strong><?php echo $imagecomments[1][$i]['username']; ?></strong></a> 
											
											<i class="icon-thumbs-up" rel="tooltip" title="<?php echo $imagecomments[1][$i]['comment_likes'];?> likes, <?php echo $imagecomments[1][$i]['comment_dislikes'];?> dislikes"></i>
											
											<strong id="<?php echo $imagecomments[1][$i]['commentid']; ?>-likes"><?php echo $imagecomments[1][$i]['comment_likes'];?></strong>&nbsp;<span class="the-dot"> &#8226;</span>&nbsp;</small>
											
											<?php if($imagecomments[1][$i]['is_reported'] < 50){?>
														
													<b class="<?php echo $imagecomments[1][$i]['commentid']; ?>like">
														<a href="#signin-register" data-toggle="modal"><i class="icon-thumbs-up"></i></a>
														<a href="#signin-register" data-toggle="modal"><i class="icon-thumbs-down"></i></a>
													</b>
														
											<?php } if($imagecomments[1][$i]['is_reported'] >= 1){?>
														
														<a href="javascript:void(0);" class="show-reported-comment reported-message<?php echo $imagecomments[1][$i]['commentid']; ?>" data-commentid="<?php echo $imagecomments[1][$i]['commentid']; ?>"><small>show</small></a>
										
															<span class="hide-reported hide-reported<?php echo $imagecomments[1][$i]['commentid'];?>">
														
															<a href="javascript:void(0);" class="show-hide-reply-comment" data-commentid="<?php echo $imagecomments[1][$i]['commentid']; ?>"><small>reply</small></a>
															<a href="javascript:void(0);" class="hide-comment" data-commentid="<?php echo $imagecomments[1][$i]['commentid']; ?>"><small>hide</small></a>
															
															</span>
													
														<?php } else {?>
								
															<a href="javascript:void(0);" class="show-hide-reply-comment" data-commentid="<?php echo $imagecomments[1][$i]['commentid']; ?>"><small>reply</small></a>
															<a href="#signin-register" data-toggle="modal"><small>report</small></a>
													
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
															<a href="#signin-register" class="btn btn-mini submit-reply-button" data-toggle="modal"><strong>Submit</strong></a>
															<strong><span id="comment-counter<?php echo $imagecomments[1][$i]['commentid']; ?>"></span></strong>
																	
														</div>
													</div>
												</span>
												
										
												
												<script type="text/javascript">

													$('.<?php echo $imagecomments[1][$i]['commentid']; ?>').limit('140','#comment-counter<?php echo $imagecomments[1][$i]['commentid']; ?>');

												</script>
												
											<?php } ?>
												
												<span class="<?php echo $imagecomments[1][$i]['commentid']; ?>subcomments">
														
														
												</span>
											</div>
										</div>
									</div>
								</span>
							<?php }}?>
							
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
							<?php }}?>
						</div>
					</div>
					  	
					</div>
				</div>
			</div>
		</span>
		</div>
	</div>
		<div class="modal hide fade" id="signin-register" tabindex="-1" role="dialog" aria-labelledby="image-modal-label" aria-hidden="true">
	
  								
  		<div class="modal-body">
 		 	<div class="row-fluid">
				<div class="span12">
				
				<div class="span6">
					<div class="row-fluid">
						<div class="span12">
						
						<legend><strong><small>Sign in</small></strong></legend>
							
          		    		<input id="login-email" class="input" type="text" placeholder="E-mail"/><span id="input-login-email"></span>
   	
          		   			<input id="login-password" class="input" type="password" placeholder="Password"/><span id="input-login-password"></span>
          		   			<br>	
          		    		<a href="javascript:void(0);" id="submit-login" class="btn btn-small btn-info"><strong>sign in</strong></a>
         		   		
         		   		<br><br>
         		   			
         		   		<legend><strong><small>Register</small></strong></legend>
         		   	
         		   	<strong>OBS! Email used for login and password recovery</strong><br>	
         		   		
					<input id="register-email" type="text" name="email" placeholder="E-mail" /><span id="input-check-email"></span>
					
					<input id="register-password" class="input" type="password" placeholder="Password" /><span id="input-check-password"></span>
					
								
					<input id="register-username" class="input display-inline-block" type="text" placeholder="Username" /><span id="input-check-username"></span>
							
					<br>
								
   					<a href="javascript:void(0);" id="submit-register" class="btn btn-small btn-info"><strong>register</strong></a>
   						
   						
   						
						</div>
					</div>
				</div>
				
				<div class="span6">
				
					<div class="row-fluid">
						<div class="span12">
						
						<div id="register-poster" class="carousel slide">
						
						
							<div class="carousel-inner">
							
							
								<div id="register-poster-container" class="active item nailthumbs">
									<img src="assets/register-poster0.png" />
								</div>
							
								<div id="register-poster-container" class="item nailthumbs">
									<img src="assets/register-poster1.png" />
								</div>
								
								<div id="register-poster-container" class="item nailthumbs">
									<img src="assets/register-poster2.png" />
								</div>
								
								<div id="register-poster-container" class="item nailthumbs">
									<img src="assets/register-poster3.png" />
								</div>
								
							</div>
							
							<a class="carousel-control left" href="#register-poster" data-slide="prev">&lsaquo;</a>
							
							<a class="carousel-control right" href="#register-poster" data-slide="next">&rsaquo;</a>
							
						</div>
						
						</div>
					</div>
					
					<div class="row-fluid">
						<div class="span12">
						
						<p>Register an account and get your own profile</p>
						<p>Upload, rate and comment images</p>
						<p>Meet new people</p>
						
						</div>
					</div>
				</div>
				

				
				</div>
			</div>
    	</div>
  		
  		<div class="modal-footer">
  			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  		</div>
  	</div>
  	
  	<div class="modal hide fade" id="add-images-guest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
							
			<div class="row-fluid">
				<div class="span12" id="browse-filelist">
					<div><a id="browse-files-guest" class="btn btn-small btn-success"><strong>Browse or Drop a file here</strong></a></div>
					<div id="filelist-guest"></div>
				</div>
			</div>
								
		</div>
					  		
		<div class="modal-footer">
			 <button id="close-upload-modal-guest" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		</div>
					  		
	</div>
	
	  <div class="modal hide fade" id="add-images" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			
			<div class="row-fluid">
				<div class="span12" id="browse-filelist">
					<a id="browse-files-voteview" class="btn btn-small btn-success"><strong>Browse or Drop a file here</strong></a>
					
					<div id="filelist-voteview"></div>
				</div>
			</div>
			
  		</div>
  		
  		<div class="modal-footer">
  			<button id="close-upload-modal" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  		</div>
	</div>
	
</span>
<?php include('view/footer.php'); ?>