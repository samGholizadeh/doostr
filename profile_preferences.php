
					<div class="row-fluid pref">
						<div class="span12">
						
							<div class="span2">
								<div class="" data-toggle="buttons-radio">
									Messages<i class="icon-question-sign anonymous-info" rel="tooltip" title="Who should be able to message you?"></i><br>
									
									<div class="btn-group">
										<?php if($profile_info['message_preference'] == 0){?>
											<button type="button" class="btn btn-small btn-primary message-preference-all active done" data-message_preference="0">All</button>
										<?php } else {?>
											<button type="button" class="btn btn-small btn-primary message-preference-all" data-message_preference="0">All</button>
										<?php }?>
										
										<?php if($profile_info['message_preference'] == 1){?>
											<button type="button" class="btn btn-small btn-primary message-preference-friend active done" data-message_preference="1">Friends</button>
										<?php } else {?>
											<button type="button" class="btn btn-small btn-primary message-preference-friend" data-message_preference="1">Friends</button>
										<?php }?>
									</div>
									
								</div>
							</div>
							
							<div class="span4" id="pref-visibility">
								<div class="" data-toggle="buttons-radio">
									Profile Visibility&nbsp;<br>
									
								<div class="btn-group">
									<?php if($profile_info['profilevisibility'] == 0){?>
										<button type="button" class="btn btn-small btn-primary profile_visibility_public active done">Public</button>
									<?php } else {?>
										<button type="button" class="btn btn-small btn-primary profile_visibility_public">Public</button>
									<?php }?>
									
									<?php if($profile_info['profilevisibility'] == 1){?>
										<button type="button" class="btn btn-small btn-primary profile_visibility_friends active done">Friends</button>
									<?php } else {?>
										<button type="button" class="btn btn-small btn-primary profile_visibility_friends">Friends</button>
									<?php }?>
									
									<?php if($profile_info['profilevisibility'] == 2){?>
										<button type="button" class="btn btn-small btn-primary profile_visibility_private active done">Private</button>
									<?php } else {?>
										<button type="button" class="btn btn-small btn-primary profile_visibility_private">Private</button>
									<?php }?>
								</div>
									
								</div>
							</div>
							
							<div class="span2 appear-offline" id="pref-offline">
									Appear Offline <i class="icon-question-sign anonymous-info" rel="tooltip" title="Really?"></i><br>
								<div class="" data-toggle="buttons-radio">
									<div class="btn-group">
									<?php if($profile_info['appearoffline'] == 0){?>
										<button type="button" class="btn btn-small btn-primary appearoffline">True</button>
									<?php } else { ?>
										<button type="button" class="btn btn-small btn-primary active appearoffline">True</button>
									<?php }?>
									
									<?php if($profile_info['appearoffline'] == 1){ ?>
										<button type="button" class="btn btn-small btn-primary appearonline">False</button>
									<?php } else { ?>
										<button type="button" class="btn btn-small btn-primary active appearonline">False</button>
									<?php } ?>
									</div>
									
								</div>
							</div>
							
							<div class="span2" id="pref">
								<div class="" data-toggle="buttons-radio">
									Anonymous <i class="icon-question-sign anonymous-info" rel="tooltip" title="You will not be included in the search function when you're anonymous."></i><br>
									
									<div class="btn-group">
									<?php if($profile_info['anonymous'] == 1){ ?>
										<button type="button" class="btn btn-small btn-primary anonymous active">True</button>
									<?php } else {?>
										<button type="button" class="btn btn-small btn-primary anonymous">True</button>
									<?php } ?>
									
									<?php if($profile_info['anonymous'] == 0){ ?>
										<button type="button" class="btn btn-small btn-primary remove-anonymous active">False</button>
									<?php } else {?>
										<button type="button" class="btn btn-small btn-primary remove-anonymous">False</button>
									<?php } ?>
									</div>
									
								</div>
							</div>
							
							<div class="span2" id="pref-delete-account">
								<button type="button" class="btn btn-small btn-danger delete-account">Delete Account</button>
							</div>
						</div>
					</div>
					
					
				<?php if($profile_info['anonymous'] == 1){?>
					<div class="row-fluid anonymous-option" id="hide-anonymous-option">
				<?php } else { ?>
					<div class="row-fluid anonymous-option">
						<?php }?>
						
						<div class="span12">
							
							<legend class="span11"><strong><small>Contant information</small></strong>
							<i class="icon-question-sign contact-information" rel="tooltip" title="This information will be used in the search member function."></i></legend>
							
								
								<div class="row-fluid">
									<div class="span12">
										<input type="hidden" name="a" value="search" />
										<input type="text" id="contact-info-name" class="span4" placeholder="Name..." value="<?php if(!empty($profile_info['name'])){ echo $profile_info['name']; }?>" />
										<input type="text" id="contact-info-lastname" class="span4" placeholder="Lastname..." value="<?php if(!empty($profile_info['lastname'])){ echo $profile_info['lastname']; }?>" />

									</div>
								</div>
									
							<div class="row-fluid">
								<div class="span12">
								
																	
									<input type="text" id="contact-info-country" class="span3" placeholder="Country..." value="<?php if(!empty($profile_info['country'])){ echo $profile_info['country']; } ?>" />
									<input type="text" id="contact-info-city" class="span3" placeholder="City..." value="<?php if(!empty($profile_info['city'])){ echo $profile_info['city']; } ?>" />
									
									<select class="span1" id="contact-info-age">
										
											<?php if(!empty($profile_info['age'])){?>
												
												<option selected="selected" value="<?php echo $profile_info['age']; ?>" ><?php echo $profile_info['age']; ?></option>
												
											<?php } else { ?>
											
												<option value="" selected="selected" disabled="disabled">Age</option>
												
											<?php }?> 
											
											<?php for($i = 18; $i <= 99; $i++){?>
												<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
											<?php }?>
											
										</select>
									
									<select class="span2" id="contact-info-gender">
									
									<?php if(!empty($profile_info['gender'])){
									
										if($profile_info['gender'] == "Male"){?>
											<option value="<?php echo $profile_info['gender']; ?>" selected="selected"><?php echo $profile_info['gender']; ?></option>
											<option value="Female">Female</option>
										<?php } else { ?>
											<option value="<?php echo $profile_info['gender']; ?>" selected="selected"><?php echo $profile_info['gender']; ?></option>
											<option value="Male">Male</option>
										<?php }} else { ?>
									
										<option value="" selected="selected" disabled="disabled">Gender</option>
										<option value="Female">Female</option>
										<option value="Male">Male</option>
									
									<?php }?>
									</select>
									
									<button class="btn btn-small btn-info pref-buttons-style" id="save-contact-info" data-username="<?php echo $_SESSION['username']; ?>"><strong>Save</strong></button>
									
								</div>
							</div>
							
							<div class="row-fluid">
								<div class="span12" id="search-result">
									
								</div>
							</div>
									
						</div>
					</div>
					
					<script type="text/javascript">
					$('.contact-information').tooltip();
					$('#hide-anonymous-option').hide();
					$('.anonymous-info').tooltip();
					$("input[placeholder]").placeholder();
					</script>
					
					
				</div>
