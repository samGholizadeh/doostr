<?php 
	include_once 'view/header_large_view.php';
?>

<?php if(!$_SESSION['filenames']){ ?>
	<h3><p>This page is not available</p></h3>
<?php } else { ?>
	<div class="row-fluid">
		<div class="span12">
			<div class="span3" id="leftvotecolumn">
				
				<div class="span12" id="advertisement-outer">
					<div class="hero-unit" id="advertisement-inner">
						<h5></h5>
					</div>	
				</div>	
				&copy;<?php echo Date("Y"); ?>  Sals playground		
			</div> <!-- Toplist column ends here -->

		
			<div class="span9" id="rightvotecolumn"> <!-- Left column in voteview begins here -->
			
			<?php if($array_length >= 1){?>
				<div class="pagination" id="uploaded-images-navbar-design">
					<ul id="uploaded-images-nav">
						<?php for($i = 1; $i <= $array_length; $i++){ ?>
							<li class="<?php if($i == 1){?>active<?php }?>"><a href="#" class="uploaded-images-next-page<?php if($i == 1){?> done<?php } ?>" data-current_page="<?php echo $i; ?>" data-upload_id="<?php echo $upload_id; ?>"><?php echo $i; ?></a></li>
						<?php } ?>
					</ul>
				</div>
			<?php } ?>
				<div class="page19">
				
					<div class="row-fluid" id="rate-image-container-outer">			<!-- image row -->
						<div class="span12">
							<div class="row-fluid" id="rate-image-container-inner">
								<div class="span12">
									<a href="#" id="large-image-rated-two" data-filename="<?php echo $_SESSION[$upload_id][0]; ?>"><img class="mainimage" src="<?php echo $image_link; ?>"></a>
								</div>
							</div>
						</div>
					</div>
				
				
					<div class="row-fluid" id="voteimage-info-container">
						<div class="span12">
						
							<div class="span12">
								<div class="row-fluid" id="voteimage-info-inner">
									<div class="span10">
										
										<span class="the-dot"> &#8226;</span><strong> <?php echo $large_version; ?></strong>
											
									</div>
									
									<div class="span2">
										&nbsp;<a href="#" id="large-image-rated" class="btn btn-small btn-info voteview-options-design" rel="tooltip" title="Resize full" data-filename="<?php echo $_SESSION[$upload_id][0]; ?>"><i class="icon-resize-full icon-white"></i></a>
									</div>
									
								</div>
							</div>
							
							<!-- <div class="span4">
								<div class="row-fluid" id="voteimage-info-likes">
									<div class="span12">
									
										<div class="span6" id="voteimage-like-bar">
											like bar
										</div>
										
										<div class="span6 image-thumbs" id="image-thumbs">
											<button class="btn" id="like-image-thumb"><strong><i class="icon-thumbs-up"></i></strong></button>
											<button class="btn" id="dislike-image"><strong><i class="icon-thumbs-down"></i></strong></button>
										</div>
										
									</div>
								</div>
							</div> -->
							</div>
						</div>
						
					</div>
					
				<?php for($i = 2; $i <= $array_length; $i++){ ?>
									
					<div class="page19" id="uploaded-images-page<?php echo $i; ?>">
					</div>
					
				<?php } ?>
			</div>
		</div>
	</div>
<?php } include_once 'view/footer.php';
?>