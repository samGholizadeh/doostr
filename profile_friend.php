<div class="row-fluid">
	<div class="span12">
	
	<?php if((!isset($friends[0][0]['state'])) && (!isset($friends[1][0]['state'])) && (!isset($friends[2][0]['state']))){?>
	
		<p>No contacs, requests or blocked users available</p>
	
	<?php } else {
		
		
			if(isset($friends[0][0]['state'])){
				
			$arrayLengthFriends = count($friends[0]) - 1; ?>
			
			<div class="row-fluid">
				<div class="span12">
	
			<legend class="span11" id="profile-friend-legends"><strong><small>Friends</small></strong></legend>
			
				<div class="span12" id="profile-friend-leftcolumn">
					<table class="table table-condensed table-hover">
						<thead>
							<td><strong><small>Username</small></strong></td>
							<td id="profile-friend-message-icon"></td>
							<td id="profile-friend-message-textarea"></td>
							<td><strong><small>Status</small></strong></td>
							<td><strong><small>Permission&nbsp<i class="icon-question-sign" rel="tooltip" title="Permission for viewing your images."></i></small></strong></td>
						</thead>
				
						<?php for($i = 0; $i <= $arrayLengthFriends; $i++){?>
							
							<tr class="search-result-header relation_id<?php echo $friends[0][$i]['userx_id']; ?>">
								<td id="profile-friends-friends-td">
								
								<p class="display-inline-block" id="profile-friends-content-text"><a href="javascript:void(0);" class="userlink" data-userx_id="<?php echo $friends[0][$i]['userx_id']; ?>"><strong><?php echo $friends[0][$i]['username']; ?></strong></a></p>
								
								</td>
								

									
								<td>
										<p id="profile-friends-content-text"><a href="javascript:void(0);" class="btn btn-mini friend-show-message-box" data-user_id="<?php echo $friends[0][$i]['userx_id']; ?>"><i class="icon-envelope"></i></a></p>
								</td>
								
								<td>
										
									<div class="row-fluid send-message-textarea-container hide-message-box<?php echo $friends[0][$i]['userx_id']; ?>">
										<div class="span12">
										
											<textarea class="message-textarea<?php echo $friends[0][$i]['userx_id']; ?> profile-friend-message-container"></textarea><br>
											<button class="btn btn-mini send-message-friends" data-recipient="<?php echo $friends[0][$i]['userx_id']; ?>" data-usernamex="<?php echo $friends[0][$i]['username']; ?>"><strong>Send message</strong></button>
											&nbsp;<span class="the-dot"> &#8226;</span>&nbsp;&nbsp;<strong><span id="profile-friend-message-counter<?php echo $friends[0][$i]['userx_id']; ?>"></span></strong>
												
										</div>
									</div>
											
									<script type="text/javascript">
										$('.message-textarea<?php echo $friends[0][$i]['userx_id']; ?>').limit('500','#profile-friend-message-counter<?php echo $friends[0][$i]['userx_id']; ?>');
									</script>
									
								</td>
								
							<?php if(($friends[0][$i]['online'] == 1) && ($friends[0][$i]['appearoffline'] == 0)){?>
							
								<td id="profile-friends-friends-td"><p id="profile-friends-content-text">Online</p></td>
								
							<?php } else {?>
							
								<td id="profile-friends-friends-td"><p id="profile-friends-content-text">Offline</p></td>
								
							<?php }?>
							
								<td id="profile-friends-friends-td">
								<?php if($friends[0][$i]['permission'] == 1){?>
								
									<select class="permission" id="profile-friends-permission" data-userx_id="<?php echo $friends[0][$i]['userx_id']; ?>">
										<option value="1" selected="selected">Public</option>
										<option value="2">Friends</option>
										<option value="3">Private</option>
									</select>
								
								<?php } else if($friends[0][$i]['permission'] == 2) { ?>
								
									<select class="permission" id="profile-friends-permission" data-userx_id="<?php echo $friends[0][$i]['userx_id']; ?>">
										<option value="2" selected="selected">Friends</option>
										<option value="1">Public</option>
										<option value="3">Private</option>
									</select>
								
								<?php } else { ?>
								
									<select class="permission" id="profile-friends-permission" data-userx_id="<?php echo $friends[0][$i]['userx_id']; ?>">
										<option value="3" selected="selected">Private</option>
										<option value="1">Public</option>
										<option value="2">Friends</option>
									</select>
									
								<?php }?>
								
								&nbsp&nbsp
								
								<a href="javascript:void(0);" class="profile-friends-remove-friend" data-userx_id="<?php echo $friends[0][$i]['userx_id']; ?>" rel="tooltip" title="Remove friend."><i class="icon-remove-circle"></i></a>
								
								</td>
							
							</tr>

						<?php }?>
					
					</table>	
				</div>
					</div>
				</div>
			<?php }?>
			
				
		<?php if(isset($friends[1][0]['state'])){
		
			$arrayLengthRequests = count($friends[1]); ?>
	
		<legend class="span11" id="profile-friend-legends"><strong><small>Friend requests</small></strong></legend>
		
			<div class="row-fluid">	
				<div class="span12" id="profile-friend-leftcolumn">
					<table class="table table-condensed table-hover">
						<thead>
							<td><strong><small>Username</small></strong></td>
							<td><strong><small>Online</small></strong></td>
							<td><strong><small>Options</small></strong></td>
						</thead>
				
						<?php for($i = 0; $i < $arrayLengthRequests; $i++){?>
						
							
							<tr class="friend-request-color<?php echo $friends[1][$i]['user_id']; ?> remove-request<?php echo $friends[1][$i]['user_id']; ?>">
							
							
								<td>
								
								<?php if(($friends[1][$i]['userx_id'] == $_SESSION['user_id']) && ($friends[1][$i]['affected'] == 1)){?>
								
									<p class="display-inline-block" id="profile-friends-content-text"><a href="javascript:void(0);" class="userlink" data-userx_id="<?php echo $friends[1][$i]['user_id']; ?>"><?php echo $friends[1][$i]['request_username']; ?></a></p>
									
								<?php } else {?>
								
									<p class="display-inline-block" id="profile-friends-content-text"><a href="javascript:void(0);" class="userlink" data-userx_id="<?php echo $friends[1][$i]['user_id']; ?>"><?php echo $friends[1][$i]['request_username']; ?></a></p>
								
								<?php }?>								
								
								</td>
								
							<?php if(($friends[1][$i]['online'] == 1) && ($friends[1][$i]['appearoffline'] == 0)){?>
							
								<td id="profile-friend-request-container"><p id="profile-friends-content-text">Online</p></td>
								
							<?php } else {?>
							
								<td id="profile-friend-request-container"><p id="profile-friends-content-text">Offline</p></td>
								
							<?php }?>
							
							<td id="profile-friend-request-options" class="specific-request<?php echo $friends[1][$i]['user_id']; ?>">
							
							<?php if((($friends[1][$i]['userx_id'] == $_SESSION['user_id']) && ($friends[1][$i]['affected'] == 1))){?>
							
								<a href="#" class="friend-request-option" data-user_id="<?php echo $friends[1][$i]['user_id']; ?>" data-choice="1"><i class="icon-ok-circle" rel="tooltip" title="Accept request"></i></a>&nbsp&nbsp
								<a href="#" class="friend-request-option" data-user_id="<?php echo $friends[1][$i]['user_id']; ?>" data-choice="2"><i class="icon-remove-circle" rel="tooltip" title="Deny request"></i></a>&nbsp&nbsp
								<a href="#" class="friend-request-option" data-user_id="<?php echo $friends[1][$i]['user_id']; ?>" data-choice="3"><i class="icon-ban-circle" rel="tooltip" title="Block user"></i></a>
												
						<?php } else {?>
								
								<a href="#" class="remove_friend_request" data-user_id="<?php echo $friends[1][$i]['user_id']; ?>"><i class="icon-remove-circle" rel="tooltip" title="Remove request"></i></a>
								
						<?php }?>
							</td>
								
							</tr>
						<?php }?>
					</table>
					</div>
				</div>
				
		<?php } if(isset($friends[2][0]['state'])){
		
			$arrayLengthBlocked = count($friends[2]) - 1; ?>
			
		<div class="row-fluid">
			<div class="span12">
	
			<legend class="span11" id="profile-friend-legends"><strong><small>Blocked users</small></strong></legend>
			
				<div class="span6" id="profile-friend-leftcolumn">
					<table class="table table-condensed table-hover">
						<thead>
							<td><strong><small>Username</small></strong></td>
							<td></td>
							<td></td>
						</thead>
				
						<?php for($i = 0; $i <= $arrayLengthBlocked/2; $i++){?>
						
							<tr class="remove-block<?php echo $friends[2][$i]['userx_id']; ?> error">
							
								<td><p id="profile-friends-content-text"><?php echo $friends[2][$i]['username']; ?></p></td>
							
								<td><a href="#" class="profile-friend-remove-block" data-userx_id="<?php echo $friends[2][$i]['userx_id']; ?>"><i class="icon-remove-circle" rel="tooltip" title="Remove block"></i></a></td>
				
							</tr>		
											
						<?php }?>
					
					</table>
				</div>
					
			<?php if($arrayLengthBlocked >= 1){?>
					
				<div class="span6" id="profile-friend-rightcolumn">
					<table class="table table-condensed table-hover">
						<thead>
							<td><strong><small>Username</small></strong></td>
							<td><strong><small>Online</small></strong></td>
							<td><strong><small>Unblock</small></strong></td>
						</thead>
						
							<?php for($i = $arrayLengthBlocked/2; $i <= $arrayLengthBlocked; $i++){?>
							
							<tr>
								<td><p id="profile-friends-blocked-text"><?php echo $friends[2][$i]['username']; ?></p></td>
							
							<td><i class="icon-remove-circle" rel="tooltip" title="Remove block"></i></td>
							
							<td>
							<a href="#" class="profile-friend-remove-block" data-userx_id="<?php echo $friends[2][$i]['userx_id']; ?>"><i class="icon-remove-circle" rel="tooltip" title="Remove block"></i></a>
							</td>
							
							</tr>
							
						<?php }}?>
							</table>
					
						</div>
				</div>
			</div>
			<?php }?>
		<?php }?><!-- Closes else in the top -->
	
			
	</div>
</div>

<script type="text/javascript">
	$('.send-message-textarea-container').hide();
	$('.friend-permission-info').tooltip();
	$('.profile-friends-remove-friend').tooltip();
</script>