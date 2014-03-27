
	<span id="comment<?php echo $comment_id[0]; ?>">
		<div class="row-fluid">
		
		<?php if($imagecomment){?>
			<div class="span12" id="comment">
		<?php } else {?>
			<div class="span12" id="comment-reply">
		<?php }?>
				<div class="span1 reply-indicator">
			
				</div>
				
				<div class="span11" id="comment-inner">
				
						<small id="comment-font-size"><strong><?php echo $_SESSION['username']; ?></strong>
						
						<i class="icon-thumbs-up"></i>
						<strong id="<?php echo $comment_id[0]; ?>-likes">0</strong>&nbsp; <span class="the-dot"> &#8226;</span>&nbsp;</small>
					
						<a href="javascript:void(0);" class="remove-comment" data-parent_commentid="<?php echo $parent_commentid; ?>" data-commentid="<?php echo $comment_id[0];?>"><small>remove</small></a>					
						<br><p class="comments-layout"><?php echo $comment; ?></p>
				
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
		
		</script>
	</span>