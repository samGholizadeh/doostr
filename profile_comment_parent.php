<div class="row-fluid">
	<div class="span12">
	
		<small><a href="javascript:void(0);" id="comment-username-link" data-username="<?php echo $comment['username']; ?>"><strong><?php echo $comment['username']; ?></strong></a> <i class="icon-thumbs-up"></i>
		<strong id="<?php echo $comment['commentid']; ?>-likes"><?php echo $comment['comment_likes'];?></strong></small>
		
		<!-- 
		
		<a href="javascript:void(0);" class="show-hide-reply-comment" data-commentid="<?php echo $comment['commentid']; ?>"><small>reply</small></a>
		
		<span class="reply-comment" id="<?php echo $comment['commentid']; ?>">
			<div class="row-fluid">
				<div class="span11 offset1">
				
				<textarea class="<?php echo $comment['commentid']; ?>" id="reply-textarea" placeholder="Comment..."></textarea><br>
				<button class="btn btn-mini submit-reply-button" data-commentid="<?php echo $comment['commentid']; ?>"><strong>Submit</strong></button>
				
				</div>
			</div>
		</span>
		
		
		 -->
		<br><?php echo $comment['comment']; ?>
		
	</div>
</div>