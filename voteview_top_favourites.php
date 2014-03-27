				<div class="row-fluid top10-bar" id="top10-bar-favourite">
						<div class="span12">
							<a href="javascript:void(0);" class="btn btn-small btn-info active done" id="fckmeright"><strong>1 day</strong></a>
							<a href="javascript:void(0);" class="btn btn-small btn-info toplist-favourite" id="fckmeright" data-toplist="1"><strong>2-5</strong></a>
							<a href="javascript:void(0);" class="btn btn-small btn-info toplist-favourite" id="fckmeright" data-toplist="2"><strong>6-10</strong></a>
							<a href="javascript:void(0);" class="btn btn-small btn-info toplist-favourite" data-toplist="3"><strong>11-30</strong></a>
							<a href="javascript:void(0);" class="btn btn-small btn-info toplist-favourite" data-toplist="4"><strong>31-90</strong></a>
							<a href="javascript:void(0);" class="btn btn-small btn-info toplist-favourite" data-toplist="5"><strong>91 ></strong></a>
						</div>
					</div>
					
						<div class="page17">
						
							<div class="row-fluid" id="top10-list">
								<div class="span12">
								
										<?php if($_SESSION['subcategory']){?>
										
											<?php for($i = 0; $i <= 9; $i++){?>
												<div class="toplist-img-container nailthumbs-topswitch-favourite">
													<a href="javascript:void(0);"><img src="<?php echo $filepaths[0][$i]; ?>" class="toplistimages-sub"/></a>
												</div>
											<?php }?>
											
										<?php } else {?>
										
											<?php for($i = 0; $i <= 9; $i++){?>
												<div class="toplist-img-container nailthumbs-topswitch-favourite">
													<a href="javascript:void(0);"><img src="<?php echo $filepaths[0][$i]; ?>" class="toplistimages"/></a>
												</div>
											<?php }?>
											
										<?php }?>
								
								</div>
							</div>
						</div>
						
						<div class="page17" id="toplist-favourite1">

						</div>
						
						<div class="page17" id="toplist-favourite2">

						</div>
						
						<div class="page17" id="toplist-favourite3">

						</div>
						
						<div class="page17" id="toplist-favourite4">

						</div>
						
						<div class="page17" id="toplist-favourite5">

						</div>
						
			<script type="text/javascript">
				$(".nailthumbs-topswitch-favourite").nailthumb();
				$('.page17:gt(0)').hide();
			</script>
