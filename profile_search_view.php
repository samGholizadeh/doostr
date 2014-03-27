				<div class="row-fluid">
						<div class="span12">
							
							<legend class="span11"><strong><small>Search</small></strong></legend>
								
								<div class="row-fluid">
									<div class="span12">
										<input type="hidden" name="a" value="search" />
										<input type="text" id="search-username" class="span3" placeholder="Username..." />
										<input type="text" id="search-name" class="span3" placeholder="Name..." />
										<input type="text" id="search-lastname" class="span3" placeholder="Lastname..." />
									</div>
								</div>
									
							<div class="row-fluid">
								<div class="span12">
								
																	
									<input type="text" id="search-country" class="span3" placeholder="Country..." >
								
									<input type="text" id="search-city" class="span3" placeholder="City..." >
									
									<select class="span2" id="gender">
										<option value="" selected="selected" disabled="disabled">Gender:</option>
										<option value="Female">Female</option>
										<option value="Male">Male</option>
										<option value="Both">Both</option>
									</select>
									
									<select class="span2" id="lastseen">
										<option value="online">Online</option>
										<option value="one">< One day</option>
										<option value="three">< Three days</option>
										<option value="seven">< One week</option>			
										<option value="thrity">< One month</option>
									</select>
									
									<button class="btn btn-small btn-info pref-buttons-style" id="member-search-button"><strong>Search</strong></button>
									
								</div>
							</div>
							
							<div class="row-fluid">
								<div class="span12">
								
									<span class="page10">
										<span id="search-result">
										
										
										</span>
									</span>
									
								</div>
							</div>
									
						</div>
					</div>
					
					
					
				<script type="text/javascript">
					$("input[placeholder]").placeholder();
				</script>