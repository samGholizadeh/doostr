
<tr>

	<?php if(strlen($reply) >= 54){ ?>
	
		<td id="profile-message-indicator">
		
			<a href="javascript:void(0);" class="extend-message" data-messageid="<?php echo $message_id[0]?>"><strong class="profile-extend-message">+</strong></a>
		
		</td>
		
		<td class="table-data-string">
	
			<span id="substring-message<?php echo $message_id[0]; ?>">
									
				<p><?php echo substr($reply, 0, 54); ?>...</p>
				
			</span>
		
	<?php } else { ?>
	
		<td>
		</td>
		
		<td class="table-data-string">
	
			<span id="substring-message<?php echo $message_id[0]; ?>">
									
				<p><?php echo $reply;?></p>
									
								
			</span>
	<?php }?>
						
		<span class="complete-message-reply" id="complete-message<?php echo $message_id[0]; ?>">
								
			<p><?php echo $reply;?></p>
								
		</span>
								
	</td>
	
	<td>
	
		<a href="javascript:void(0);" class="goto-author" data-author="<?php echo $recipient; ?>"><?php echo $recipient; ?></a>
		
	</td>
	
	<td>
		<p><?php echo $today; ?><a href="javascript:void(0);" class="remove-single-sent-message" data-messageauthor="<?php echo $message_list[1][$i]['author'];?>" data-messageid="<?php echo $message_id[0]; ?>"><i class="icon-remove-circle"></i></a></p>
	</td>
</tr>

<script type="text/javascript">
	$('.complete-message-reply').hide();
</script>