				<div class="row-fluid top10-bar" id="top10-bar-newest">
					<div class="span12">
						<a href="#" class="btn btn-small btn-info active done" id="fckmeright"><strong>1-10</strong></a>
						<a href="#" class="btn btn-small btn-info toplist-newest" id="fckmeright" data-toplist="1"><strong>11-20</strong></a>
						<a href="#" class="btn btn-small btn-info toplist-newest" id="fckmeright" data-toplist="2"><strong>21-30</strong></a>
						<a href="#" class="btn btn-small btn-info toplist-newest" data-toplist="3"><strong>31-40</strong></a>
						<a href="#" class="btn btn-small btn-info toplist-newest" data-toplist="4"><strong>41-50</strong></a>
						<a href="#" class="btn btn-small btn-info toplist-newest" data-toplist="5"><strong>51-60</strong></a>
					</div>
				</div>
					
					<div class="page18">
				
						<div class="row-fluid" id="top10-list">
							<div class="span12">
							
									<?php if($_SESSION['subcategory']){?>
									
										<?php for($i = 0; $i <= 9; $i++){?>
											<div class="toplist-img-container nailthumbs-topswitch-newest">
												<a href="#"><img src="<?php echo $filepaths[0][$i]; ?>" class="toplistimages-sub"/></a>
											</div>
										<?php }?>
										
									<?php } else {?>
									
										<?php for($i = 0; $i <= 9; $i++){?>
											<div class="toplist-img-container nailthumbs-topswitch-newest">
												<a href="#"><img src="<?php echo $filepaths[0][$i]; ?>" class="toplistimages"/></a>
											</div>
										<?php }?>
										
									<?php }?>
							
							</div>
						</div>
					
					</div>
							
							
					<div class="page18" id="toplist-newest1">

					</div>
					
					<div class="page18" id="toplist-newest2">
					
					</div>
					
					<div class="page18" id="toplist-newest3">
					
					</div>
					
					<div class="page18" id="toplist-newest4">
					
					</div>
					
					<div class="page18" id="toplist-newest5">
					
					</div>
							
			<script type="text/javascript">
				$(".nailthumbs-topswitch-newest").nailthumb();
				$('.page18:gt(0)').hide();
			</script>