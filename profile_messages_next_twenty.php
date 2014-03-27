<?php ?>

<table class="table table-hover" id="revolver">
						<thead>
							<td id="profile-message-indicator"></td>
							<td id="profile-message-space">Message</td>
							<td id="profile-message-name-space">From</td>
							<td>Date/Time</td>
						</thead>
						
 		  <?php foreach($message_list as $message){

			if($message['recip_copy'] == 0){
				continue;
							} else {?>
							
							
						<?php if($message['message_state'] == 0){ ?>
							
							<tr class="table-row<?php echo $message['message_id']; ?>">
							
								<td class="extend-new-message" id="<?php echo $message['message_id']; ?>extend-message">
								
									<a href="javascript:void(0);" class="onclickmessage" data-messageid="<?php echo $message['message_id']; ?>"><strong class="profile-extend-message">+</strong></a>
								
								</td>
								
								<td class="table-data-string">
								
									<?php if(strlen($message['message']) >= 54){?>
							
										<span id="substring-message<?php echo $message['message_id']; ?>">
									
											<p class="comments-layout" id="strong<?php echo $message['message_id']; ?>"><strong><?php echo substr($message['message'], 0, 54); ?>...</strong></p>
									
								
										</span>
								
									<?php } else { ?>
							
										<span id="substring-message<?php echo $message['message_id']; ?>">
									
											<p class="comments-layout" id="strong<?php echo $message['message_id']; ?>"><strong><?php echo $message['message']; ?></strong></p>

										</span>
								
									<?php }?>
								
								
							<?php } else { ?>
							
								<td id="profile-message-indicator">
							
									<a href="javascript:void(0);" class="extend-message" data-messageid="<?php echo $message['message_id']; ?>"><strong class="profile-extend-message">+</strong></a>
								
							
								</td>
							
								<td class="table-data-string">
								
									<?php if(strlen($message['message']) >= 54){?>
							
										<span id="substring-message<?php echo $message['message_id']; ?>">
									
											<p class="comments-layout"><?php echo substr($message['message'], 0, 54); ?>...</p>
									
								
										</span>
								
									<?php } else { ?>
							
										<span id="substring-message<?php echo $message['message_id']; ?>">
									
											<p class="comments-layout"><?php echo $message['message']; ?></p>

										</span>
								
									<?php }?>
							
							<?php }?>
							
								<span class="complete-message" id="complete-message<?php echo $message['message_id']; ?>">
								
									<p class="comments-layout"><?php echo $message['message']; ?></p>
									
									<br>
								
								<?php if($message['user_id'] != 23){?>
									
									<textarea class="message-reply-container" id="message-reply-container<?php echo $message['message_id']; ?>"></textarea>

									<br><button class="btn btn-mini submit-message-reply" data-messageid="<?php echo $message['message_id']; ?>" data-recipient="<?php echo $message['author'];?>" 
									data-userx_id="<?php echo $message['user_id']; ?>"><strong>submit</strong></button>
												
									&nbsp;<span class="the-dot"> &#8226;</span>&nbsp; <strong><span id="message-container-counter<?php echo $message['message_id']; ?>"></span></strong>
									
								<?php } ?>
									
								</span>
							
							</td>
							
							<td>
							
								<a href="javascript:void(0);" class="goto-author" data-author="<?php echo $message['author']; ?>"><?php echo$message['author']; ?></a>
							
							</td>
							
							<td>
							
								<p><?php echo date("Y-m-d H:i", strtotime($message['message_timestamp'])); ?>&nbsp <a href="javascript:void(0);" class="remove-single-inbox-message" data-messageid="<?php echo $message['message_id']; ?>"><i class="icon-remove-circle"></i></p></a>
							
							</td>
						
						</tr>
						
						<script type="text/javascript">
							$('#message-reply-container<?php echo $message['message_id']; ?>').limit('500','#message-container-counter<?php echo $message['message_id']; ?>');
						</script>
						
				<?php }} ?>
		</table>
		
		<script type="text/javascript">
		$('.complete-message').hide();
		</script>