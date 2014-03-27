<span id="message-page-exists" data-messageexists="yes"></span>
<div class="row-fluid">
	<div class="span12">
						
		<span id="vardump"></span>
						
		<div class="row-fluid">
			<div class="span11">
				<ul class="nav nav-tabs messages-nav">
					<li class="active"><a href="javascript:void(0);"><strong>Inbox</strong></a></li>
					<li><a href="javascript:void(0);"><strong>Sent</strong></a></li>
				</ul>
			</div>
		</div>
								
								
		<div class="page4">
					
			<div class="row-fluid">
				<div class="span12">
				
				<span class="page8">
						<?php if(isset($message_list[0][0]['message_state'])){?>
						
					<table class="table table-hover" id="revolver-inbox">
						<thead>
							<td id="profile-message-indicator"></td>
							<td id="profile-message-space">Message</td>
							<td id="profile-message-name-space">From</td>
							<td>Date/Time</td>
						</thead>
						
					<?php if($array_length_inbox > 17){

							$array_length_inbox_iterate = 17;
						
						} else {
							
							$array_length_inbox_iterate = $array_length_inbox;

						}

						for($i = 0; $i < $array_length_inbox_iterate; $i++){
						
							if($message_list[0][$i]['recip_copy'] == 0){
								continue;
							} else {?>
							
							<tr class="table-row<?php echo $message_list[0][$i]['message_id']; ?>">
							
							<?php if($message_list[0][$i]['message_state'] == 0){ ?>
							
								<td class="extend-new-message" id="<?php echo $message_list[0][$i]['message_id']; ?>extend-message">
								
									<a href="javascript:void(0);" class="onclickmessage" data-messageid="<?php echo $message_list[0][$i]['message_id']; ?>"><strong class="profile-extend-message">+</strong></a>
								
								</td>
								
								<td class="table-data-string">
								
									<?php if(strlen($message_list[0][$i]['message']) >= 54){?>
							
										<span id="substring-message<?php echo $message_list[0][$i]['message_id']; ?>">
									
											<p class="comments-layout" id="strong<?php echo $message_list[0][$i]['message_id']; ?>"><strong><?php echo substr($message_list[0][$i]['message'], 0, 54); ?>...</strong></p>
									
								
										</span>
								
									<?php } else { ?>
							
										<span id="substring-message<?php echo $message_list[0][$i]['message_id']; ?>">
									
											<p class="comments-layout" id="strong<?php echo $message_list[0][$i]['message_id']; ?>"><strong><?php echo $message_list[0][$i]['message']; ?></strong></p>

										</span>
								
									<?php }?>
								
								
							<?php } else { ?>
							
								<td id="profile-message-indicator">
							
									<a href="javascript:void(0);" class="extend-message" data-messageid="<?php echo $message_list[0][$i]['message_id']; ?>"><strong class="profile-extend-message">+</strong></a>
								
							
								</td>
							
								<td class="table-data-string">
								
									<?php if(strlen($message_list[0][$i]['message']) >= 54){?>
							
										<span id="substring-message<?php echo $message_list[0][$i]['message_id']; ?>">
									
											<p class="comments-layout"><?php echo substr($message_list[0][$i]['message'], 0, 54); ?>...</p>
									
								
										</span>
								
									<?php } else { ?>
							
										<span id="substring-message<?php echo $message_list[0][$i]['message_id']; ?>">
									
											<p class="comments-layout"><?php echo $message_list[0][$i]['message']; ?></p>

										</span>
								
									<?php }?>
							
							<?php }?>
							
								<span class="complete-message" id="complete-message<?php echo $message_list[0][$i]['message_id']; ?>">
								
									<p class="comments-layout"><?php echo $message_list[0][$i]['message']; ?></p>
									
									<br>
								
							<?php if($message_list[0][$i]['user_id'] != 23){?>
							
									<textarea class="message-reply-container" id="message-reply-container<?php echo $message_list[0][$i]['message_id']; ?>"></textarea>

									<br><button class="btn btn-mini submit-message-reply" data-messageid="<?php echo $message_list[0][$i]['message_id']; ?>" data-userx_id="<?php echo $message_list[0][$i]['user_id'];?>" 
										data-recipient="<?php echo $message_list[0][$i]['author']; ?>"><strong>submit</strong></button>
												
									&nbsp;<span class="the-dot"> &#8226;</span>&nbsp; <strong><span id="message-container-counter<?php echo $message_list[0][$i]['message_id']; ?>"></span></strong>
							
							<?php } ?>
									
								</span>
							
							</td>
							
							<td>
							
								<a href="javascript:void(0);" class="userlink" data-userx_id="<?php echo $message_list[0][$i]['user_id']; ?>"><?php echo $message_list[0][$i]['author']; ?></a>
							
							</td>
							
							<td>
							
								<p><?php echo date("Y-m-d H:i", strtotime($message_list[0][$i]['message_timestamp'])); ?>&nbsp
								
								<a href="javascript:void(0);" id="remove-inbox<?php echo $message_list[0][$i]['message_id']; ?>" class="remove-single-inbox-message" data-messageid="<?php echo $message_list[0][$i]['message_id']; ?>" <?php if($message_list[0][$i]['message_state'] == 0){ ?>data-new_message="1"<?php } else { ?>data-new_message="0"<?php }?>><i class="icon-remove-circle"></i></a></p>
							
							</td>
						
						</tr>
						
						<script type="text/javascript">
							$('#message-reply-container<?php echo $message_list[0][$i]['message_id']; ?>').limit('500','#message-container-counter<?php echo $message_list[0][$i]['message_id']; ?>');
						</script>
						
						<?php }} ?>
						</table>
					</span>
				
						
				<?php
							$message_pages = ceil($array_length_inbox/17);
							
							if($message_pages > 1){
							
							for($i = 2; $i <= ($message_pages); $i++){?>
								
								<span class="page8">
									<span class="message-inbox-page<?php echo $i; ?>">
									</span>
								</span>
								
							<?php } ?>
				
								<div class="pagination pagination-mini pagination-centered">
									<ul class="profile-message-nav">
										<?php for($i = 1; $i <= ($message_pages + 1); $i++){ ?>
											<li class="<?php if($i == 1){?>active<?php }?>"><a href="javascript:void(0);" class="profile-message-next-page<?php if($i == 1){?> done<?php } ?>" data-current_page="<?php echo $i?>"><?php echo $i; ?></a></li>
										<?php } ?>
									</ul>
								</div>
						
							<?php }} else {?>
					<table class="table table-hover" id="revolver-sent">
						<thead>
							<td id="profile-message-indicator"></td>
							<td id="profile-message-space">Message</td>
							<td id="profile-message-name-space">To</td>
							<td>Date/Time</td>
						</thead>
						
						<tr></tr>
						
						</table>
						<?php  } ?>
					
				</div>
			</div>					
								
		</div>
		
		
		
		<div class="page4">
		
			<div class="row-fluid">
				<div class="span12">
				
				<span class="page9">
						
						<?php if(isset($message_list[1][0]['message_state'])){?>
						
						<table class="table table-hover" id="revolver-sent">
						<thead>
							<td id="profile-message-indicator"></td>
							<td id="profile-message-space">Message</td>
							<td id="profile-message-name-space">To</td>
							<td>Date/Time</td>
						</thead>
						
						<?php
						
						if($array_length_send > 17){

							$array_length_send_iterate = 17;
						
						} else {

							$array_length_send_iterate = $array_length_send;

						}
						
						 for($i = 0; $i < $array_length_send_iterate; $i++){ 
						
							if($message_list[1][$i]['author_copy'] == 0){
								continue;
							} else {?>
						
						<tr class="table-row<?php echo $message_list[1][$i]['message_id']; ?>">
							
							<?php if(strlen($message_list[1][$i]['message']) >= 54){?>
							
								<td id="profile-message-indicator">
								
									<a href="javascript:void(0);" class="extend-message" data-messageid="<?php echo $message_list[1][$i]['message_id']; ?>"><strong class="profile-extend-message">+</strong></a>
								
								</td>
							
								<td class="table-data-string">
							
								<span id="substring-message<?php echo $message_list[1][$i]['message_id']; ?>">
									
									<p class="comments-layout"><?php echo substr($message_list[1][$i]['message'], 0, 54); ?>...</p>
									
								
								</span>
								
							<?php } else { ?>
							
								<td></td>
							
								<td class="table-data-string">
							
								<span id="substring-message<?php echo $message_list[1][$i]['message_id']; ?>">
									
									<p class="comments-layout"><?php echo $message_list[1][$i]['message']; ?></p>

								</span>
								
							<?php }?>
						
								<span class="complete-message" id="complete-message<?php echo $message_list[1][$i]['message_id']; ?>">
								
									<p class="comments-layout"><?php echo $message_list[1][$i]['message']; ?></p>
								
								</span>
								
							</td>
							
							<td>
							
								<a href="javascript:void(0);" class="userlink" data-author="<?php echo $message_list[1][$i]['userx_id']; ?>"><?php echo $message_list[1][$i]['recip']; ?></a>
							
							</td>
							
							<td>
							
								<p><?php echo date("Y-m-d H:i", strtotime($message_list[1][$i]['message_timestamp'])); ?><a href="javascript:void(0);" class="remove-single-sent-message" data-messageid="<?php echo $message_list[1][$i]['message_id']; ?>">&nbsp<i class="icon-remove-circle"></i></a></p>
							
							</td>
						
						</tr>
						<?php }} ?>
						
						</table>
						
						</span>
						
						<?php
						
							$message_sent_pages = ceil($array_length_send/17);
							
							if($message_sent_pages > 1){
							
							for($i = 2; $i <= ($message_sent_pages); $i++){?>
								
								<span class="page9">
									<span class="message-sent-page<?php echo $i;?>">
										<span class="vardump">
										
										</span>
									</span>
								</span>
								
							<?php } ?>
							
								<div class="pagination pagination-mini pagination-centered">
								
									<ul class="profile-message-sent-nav">
										<?php for($i = 1; $i <= ($message_sent_pages + 1); $i++){ ?>
											<li class="<?php if($i == 1){?>active<?php }?>"><a href="javascript:void(0);" class="profile-message-sent-next-page<?php if($i == 1){?> done<?php } ?>" data-current_page="<?php echo $i?>"><?php echo $i; ?></a></li>
										<?php } ?>
									</ul>
									
								</div>
								
							<?php } ?>

						<?php } else {?>
						
					<table class="table table-hover" id="revolver-sent">
						<thead>
							<td id="profile-message-indicator"></td>
							<td id="profile-message-space">Message</td>
							<td id="profile-message-name-space">To</td>
							<td>Date/Time</td>
						</thead>
						
						<tr></tr>
						
						</table>
						<?php  }?>
					
				</div>
			</div>		
		
		
		</div>
							
							
	</div>
</div>

<script type="text/javascript">
	$('.complete-message').hide();
	$('.page4:gt(0)').hide();
</script>