<div class="row-fluid large-profile-img">
						<div class="span12">
							<div class="hero-unit">
								<p>Large image here</p>
							</div>
						</div>
					</div>
					
					<div class="row-fluid">
						<div class="span12">
						
							<div class="span6" id="profile-firstpage">
								<div class="row-fluid">
									<div class="span12">
									<ul>
										<input id="profile-name-lastname" type="text" placeholder="Name..."  />
										<input id="age" type="text" placeholder="Age..." />
										<input id="city" type="text" placeholder="City..." />
										<input id="country" type="text" placeholder="Country..." />
										<input id="skype" type="text" placeholder="Skype" />
										<button class="btn btn-mini btn-info" id="submit-profile"><strong>Submit</strong></button>
									</ul>
									</div>
								</div>
							</div>
							
							<div class="span6" id="profile-firstpage">
								
								<div class="row-fluid">
									<div class="span12">
										<textarea id="textarea-about-left" class="profiledescription" cols="100" rows="6" placeholder="Short description about yourself...">
										<?php echo $profile_and_about[0]['description']?></textarea>
									</div>
								</div>
								
								
								<div class="row-fluid" id="about-box-1">
									<div class="span12">
										<div class="span6" id="counter-left">
											<strong><span id="descr-counter"></strong> characters left.</span>
										</div>
									</div>
								</div>
							</div>
							
							
						</div>
					</div>
					
																<!-- !!!!!!!!!!!!!!!!!!!!!!! -->
					
					<legend id="about-legend"></legend>
					
					<div class="row-fluid" id="btn-saveprofile">
						<div class="span12">
							<button class="btn" id="save-profile">Save</button>
						</div>
					</div>