	<!-- NOT USED ATM SAVED SINCE IT MIGHT BE USED IN THE FUTURE WHEN AN ABOUT PAGE APPEARS -->
	
					<div class="row-fluid" id="image-bar">
						<div class="span12">
								
								<div class="span10">
									<ul class="nav nav-tabs gallery-nav">
										<li class="active"><a href="#"><strong><small>All</small></strong></a></li>
										<li><a href="#"><strong><small>Rated</small></strong></a></li>
										<li><a href="#" id="goto-album"><strong><small>Albums</small></strong></a></li>
										<li><a href="#"><strong><small>Favourites</small></strong></a></li>
										<li><a href="#"><strong><small>Add image</small></strong></a></li>
									</ul>
								</div>
								
								<div class="span2 add-image">
									<a href="#image-upload" role="button" class="btn btn-small btn-success" data-toggle="modal"
									 rel="tooltip" title="Add image."><i class="icon-plus icon-white"></i></a>
									<a href="#create-album" role="button" class="btn btn-small btn-success" data-toggle="modal" 
									 rel="tooltip" title="Add album."><i class="icon-picture icon-white"></i></a>
								</div>
								
								
							
						</div>
					</div>
					
					<div class="page1">
						<div class="row-fluid" id="image-container">
							<div class="span12">
								<?php foreach($images as $image){ 
								
									if(((($image['state'] == 1) && ($friendstate != 1)) || ($image['state'] == 2))){
										continue;
									 } else {?>
									<div class="profile-gallery-image-container">
										<img src="../member/<?php echo $image['username']; ?>/thumbnail/<?php echo $image['filename']; ?>" id="profile-gallery-image" data-filename="<?php echo $imageNames[$i]; ?>" />
									</div>
								<?php }}?>
							</div>
						</div>
					</div>
					
					<div class="page1"> <!-- Rated images -->
						<div class="row-fluid">
							<div class="span12">
								
							</div>
						</div>
					</div>
					
					<div class="page1">
						<div class="row-fluid">
							<div class="span12">
								testing
							</div>
						</div>
					</div>
					
					<div class="page1">
						<div class="row-fluid">
							<div class="span12">
								<?php if(!$favourites){?>
							
									<h5><strong>You dont have any favourites.</strong></h5>
							
								<?php } else {
								 
									for($i = 0; $i <= $array_length; $i++){ 
									
										if(((($favourites[$i]['img_state'] == 1) && ($friendstate != 1)) || ($images[$i]['state'] == 2))){
											continue;
										 } else {?>
											<div class="profile-gallery-image-container">
												<img src="../member/<?php echo $favourites[$i]['img_owner']; ?>/thumbnail/<?php echo $favourites[$i]['filename']; ?>" />
											</div>
										<?php }}}?>
								</div>
							</div>
						</div>
					
					<div class="page1">
						<div class="row-fluid" id="upload-file">
						<div class="span12">
						<form id="fileupload" method="post" action="?a=profile" enctype="multipart/form-data">
								<input type="file" name="file1"  /><br>
                                <select name="category">
                               		 <option value="art">Art</option>
									<option value="awww">Awww</option>
									<option value="anime">Anime/Manga</option>
									<option value="boy">Boy</option>
									<option value="funny">Funny</option>
									<option value="gaming">Gaming</option>
									<option value="girl">Girl</option>
									<option value="meme">Meme's</option>
									<option value="painting">Painting</option>
									<option value="wtf">WTF</option>
									<option value="world">World</option>
									<option value="other">Other</option>     
           	                    </select><!-- 
           	                    
           	                    MEME's subcategories. Changed name so that I dont have to use arrays
           	                    to create tooltips. Tooltips Instead grabbed directly from DB
           	                    
								<select name="subcategory" >
									<option value="af">Asian Father</option>
									<option value="bd">Butthurt Dweller</option>
									<option value="cf">College Freshman</option>
									<option value="cw">Condenscending Wonka</option>
									<option value="fk">Conspiracy Keanu</option>
									<option value="fp">Firstworld Problems</option>
									<option value="fa">Forever Alone</option>
									<option value="fry">Fry</option>
									<option value="ggg">Good Guy Greg</option>
									<option value="lcs">Lazy College Senior</option>
									<option value="Morpheus">Morphues</option>
									<option value="pr">Philosophoraptor</option>
									<option value="sb">Scumbag Brain</option>
									<option value="ss">Scumbag Steve</option>
									<option value="sap">Socially Awkward Penguin</option>
									<option value="sm">Suburban Mom</option>
									<option value="sk">Success kid</option>
									<option value="sbm">Successful Blackman</option>
									<option value="ut">Unhelpful teacher</option>
									<option value="Other">Other</option>
								</select><br> -->
								
								<!-- 
								<select name="subcategory" >
									<option value="cgi">CGI</option>
									<option value="drawing">Drawing</option>
									<option value="painting">Painting</option>
									<option value="photography">Photography</option>
								</select><br> -->
								
								
                                <br />Image Title<br />
                                <textarea name="imagetitle" cols="40" rows="3"></textarea><br />
                                Rate it: <input type="checkbox" name="voteit" />
                                <input type="submit" value="Upload" />
							</form>
						</div>
					</div>
				</div>