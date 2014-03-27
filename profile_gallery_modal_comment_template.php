
<span id="comment<?php echo $comment_id[0]; ?>">

<div class="row-fluid modal-comment-inner">
	<div class="span12">

	<div class="row-fluid">
		<div class="span12 modal-comment">
		
			<small id="comment-modal-font-size"><strong><?php echo $_SESSION['username']; ?></strong>
						
				<i class="icon-thumbs-up"></i>
				<strong id="<?php echo $comment_id[0]; ?>-likes">0</strong>&nbsp; <span class="the-dot"> &#8226;</span>&nbsp;</small>
					
				<a href="javascript:void(0);" class="remove-comment" data-commentid="<?php echo $comment_id[0];?>"><small>remove</small></a>					
			<br><p id="comment-modal-font-size2" class="comments-layout"><?php echo $comment; ?></p>
			
		</div>
	</div>
</div>
</div>

</span>