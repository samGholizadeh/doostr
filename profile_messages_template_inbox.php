	
	<?php 

	if(!$new_messages){
		
	} else {
	
	for($i = 0; $i < $array_length; $i++){?>
	<tr class="table-row<?php echo $new_messages[$i]['message_id']; ?>">
	
		<td class="extend-new-message" id="<?php echo $new_messages[$i]['message_id']; ?>extend-message">
		
			<a href="javascript:void(0);" class="onclickmessage" data-messageid="<?php echo $new_messages[$i]['message_id']; ?>"><strong class="profile-extend-message">+</strong></a>
		
		</td>
		
		<td class="table-data-string">
		
			<?php if(strlen($new_messages[$i]['message']) >= 54){?>
	
				<span id="substring-message<?php echo $new_messages[$i]['message_id']; ?>">
			
					<p class="comments-layout" id="strong<?php echo $new_messages[$i]['message_id']; ?>"><strong><?php echo substr($new_messages[$i]['message'], 0, 54); ?>...</strong></p>
			
		
				</span>
		
			<?php } else { ?>
	
				<span id="substring-message<?php echo $new_messages[$i]['message_id']; ?>">
			
					<p class="comments-layout" id="strong<?php echo $new_messages[$i]['message_id']; ?>"><strong><?php echo $new_messages[$i]['message']; ?></strong></p>

				</span>
		
			<?php }?>
	
		<span class="complete-message<?php echo $new_messages[$i]['message_id']; ?>" id="complete-message<?php echo $new_messages[$i]['message_id']; ?>">
		
			<p class="comments-layout"><?php echo $new_messages[$i]['message']; ?></p>
			
			<br>
		
	<?php if($new_messages[$i]['user_id'] != 23){?>
	
			<textarea class="message-reply-container" id="message-reply-container<?php echo $new_messages[$i]['message_id']; ?>"></textarea>

			<br><button class="btn btn-mini submit-message-reply" data-messageid="<?php echo $new_messages[$i]['message_id']; ?>" data-userx_id="<?php echo $new_messages[$i]['user_id'];?>" 
				data-recipient="<?php echo $new_messages[$i]['author']; ?>"><strong>submit</strong></button>
						
			&nbsp;<span class="the-dot"> &#8226;</span>&nbsp; <strong><span id="message-container-counter<?php echo $new_messages[$i]['message_id']; ?>"></span></strong>
	
	<?php } ?>
			
		</span>
	
	</td>
	
	<td>
	
		<a href="javascript:void(0);" class="userlink" data-userx_id="<?php echo $new_messages[$i]['user_id']; ?>"><?php echo $new_messages[$i]['author']; ?></a>
	
	</td>
	
	<td>
	
		<p><?php echo date("Y-m-d H:i", strtotime($new_messages[$i]['message_timestamp'])); ?>&nbsp<a href="javascript:void(0);" class="remove-single-inbox-message" data-messageid="<?php echo $new_messages[$i]['message_id']; ?>" data-new_message="1"><i class="icon-remove-circle"></i></a></p>
	
	</td>

</tr>

	<script type="text/javascript">
		$('#message-reply-container<?php echo $new_messages[$i]['message_id']; ?>').limit('500','#message-container-counter<?php echo $new_messages[$i]['message_id']; ?>');
		$('.complete-message<?php echo $new_messages[$i]['message_id']; ?>').hide();
	</script>
<?php }}?>