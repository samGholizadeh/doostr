<?php
	include_once 'View/header.php';
?>
	
	<div class="row">
		<div class="span12">
			<div class="row-fluid">
				<div class="span7" id="designbox">
					<div class="hero-unit" id="hero1">
						<h2>Doost</h2>
						<h4>Meet new people.</h4>
					</div>
				</div>
				
				
				<div class="span5" id="designbox">
					<form action="" method="POST" id="register_form">
							<legend>Registration</legend>
							
							<label>Username:*</label><input type="text" name="username" placeholder="Username" />
							
							<label>Password:*</label><input type="password" name="password" placeholder="Password" />
							
							<label>Email:*</label><input type="text" name="email" placeholder="E-mail" /><br>
        			       	<input type="submit" name="a" value="Register"/>
				    </form>
				</div>
			
			
			
			
			</div>
		
		
		
		</div>
	</div>
	
	
	
	
		<div class="row-fluid">
			<div class="span12">
			
				<div class="row-fluid">
					<div class="span7" id="designbox2">
						<div class="hero-unit" id="hero2">
							Upload images here.
						</div>
					</div>
					
					<div class="span5" id="designbox2">
						<?php for($i = 0; $i <= 15; $i++){?>
							<img src="<?php echo $testimages[$i];?>" id="frontimages" />
						<?php } ?>
					</div>
				</div>
				
				
			</div>
		</div>
	
  	 <div class="modal hide fade" id="signin-register" tabindex="-1" role="dialog" aria-labelledby="image-modal-label" aria-hidden="true">
	
  								
  		<div class="modal-body">
 		 	<div class="row-fluid">
				<div class="span12">
				
				<div class="span6">
					<div class="row-fluid">
						<div class="span12">
						
							<legend>Sign in</legend>
							
							<form class="navbar-form pull-right" method="POST" action="login/">
          					  <input type="hidden" name="a" value="validate" />
          		    			<input class="input-small" type="text" placeholder="Username" name="username">
          		   				<input class="input-small" type="password" placeholder="Password" name="password">
          		    			<button class="btn btn-small btn-info" type="submit" class="btn2"><strong>sign in</strong></button>
         		   			</form>
         		   			
         		   			<legend>Register</legend>
							
							
							<form action="" method="POST" id="register_form">
							
								<label>Username:*</label><input class="input-small" type="text" name="username" placeholder="Username" />
							
								<label>Password:*</label><input class="input-small" type="password" name="password" placeholder="Password" />
							
								<label>Email:*</label><input type="text" name="email" placeholder="E-mail" /><br>
        			    	   	<input type="submit" name="a" value="Register"/>
        			    	   	
				  			 </form>
						
						</div>
					</div>
				</div>
				
				<div class="span6">
					<div class="row-fluid">
						<div class="span12">
				
							
						</div>
					</div>
				</div>
				

				
				</div>
			</div>
    	</div>
  		
  		<div class="modal-footer">
  			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  		</div>
  	</div>
<?php include_once('View/footer.php'); ?>