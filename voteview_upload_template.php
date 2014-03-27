	<div class="row-fluid" id="rate-image-container-outer">			<!-- image row -->
		<div class="span12">
			<div class="row-fluid" id="rate-image-container-inner">
				<div class="span12">
					<a href="#" id="large-image-rated" data-filename="<?php echo $_SESSION[$upload_id][0]; ?>"><img class="mainimage" src="<?php echo $image_link; ?>"></a>
				</div>
			</div>
		</div>
	</div>


	<div class="row-fluid" id="voteimage-info-container">
		<div class="span12">
		
			<div class="span12">
				<div class="row-fluid" id="voteimage-info-inner">
					<div class="span10">
						
						<span class="the-dot"> &#8226;</span><strong>&nbspdoostr.com/?z=<?php echo $_SESSION[$upload_id][$current_page]; ?></strong>
							
					</div>
					
					<div class="span2">
						&nbsp;<a href="#" id="large-image-rated" class="btn btn-small btn-info voteview-options-design" rel="tooltip" title="Resize full" data-filename="<?php echo $_SESSION[$upload_id][$current_page]; ?>"><i class="icon-resize-full icon-white"></i></a>
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