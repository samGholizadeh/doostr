<table class="table table-hover" id="revolver-sent">
						<thead>
							<td id="profile-message-indicator"></td>
							<td id="profile-message-space">Message</td>
							<td id="profile-message-name-space">To</td>
							<td>Date/Time</td>
						</thead>
						
						<?php
						
						 foreach($message_list as $message){ 
						
							if($message['author_copy'] == 0){
								continue;
							} else {?>
						
						<tr class="table-row<?php echo $message['message_id']; ?>">
							
							<?php if(strlen($message['message']) >= 54){?>
							
								<td id="profile-message-indicator">
								
									<a href="javascript:void(0);" class="extend-message" data-messageid="<?php echo $message['message_id']; ?>"><strong class="profile-extend-message">+</strong></a>
								
								</td>
							
								<td class="table-data-string">
							
								<span id="substring-message<?php echo $message['message_id']; ?>">
									
									<p class="comments-layout"><?php echo substr($message['message'], 0, 54); ?>...</p>
									
								
								</span>
								
							<?php } else { ?>
							
								<td></td>
							
								<td class="table-data-string">
							
								<span id="substring-message<?php echo $message['message_id']; ?>">
									
									<p class="comments-layout"><?php echo $message['message']; ?></p>

								</span>
								
							<?php }?>
						
								<span class="complete-message" id="complete-message<?php echo $message['message_id']; ?>">
								
									<p class="comments-layout"><?php echo $message['message']; ?></p>
								
								</span>
								
							</td>
							
							<td>
							
								<a href="javascript:void(0);" class="userlink" data-userx_id="<?php echo $message['userx_id']; ?>"><?php echo $message['recip']; ?></a>
							
							</td>
							
							<td>
							
								<p><?php echo date("Y-m-d H:i", strtotime($message['message_timestamp'])); ?><a href="javascript:void(0);" class="remove-single-sent-message" data-messageauthor="<?php echo $message['author'];?>" data-messageid="<?php echo $message['message_id']; ?>">&nbsp<i class="icon-remove-circle"></i></a></p>
							
							</td>
						
						</tr>
						<?php }} ?>
						
						</table>
						
		<script type="text/javascript">
		$('.complete-message').hide();
		</script>