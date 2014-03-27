
				<div class="row-fluid top10-bar" id="top10-bar-comment">
					<div class="span12">
						<a href="javascript:void(0);" class="btn btn-small btn-info toplist-comment active done" id="fckmeright"><strong>1 day</strong></a>
						<a href="javascript:void(0);" class="btn btn-small btn-info toplist-comment" id="fckmeright" data-toplist="1"><strong>2-5</strong></a>
						<a href="javascript:void(0);" class="btn btn-small btn-info toplist-comment" id="fckmeright" data-toplist="2"><strong>6-10</strong></a>
						<a href="javascript:void(0);" class="btn btn-small btn-info toplist-comment" data-toplist="3"><strong>11-30</strong></a>
						<a href="javascript:void(0);" class="btn btn-small btn-info toplist-comment" data-toplist="4"><strong>31-90</strong></a>
						<a href="javascript:void(0);" class="btn btn-small btn-info toplist-comment" data-toplist="5"><strong>91 ></strong></a>
					</div>
				</div>
					
					<div class="page16">
				
						<div class="row-fluid" id="top10-list">
							<div class="span12">
							
									<?php if($_SESSION['subcategory']){?>
									
										<?php for($i = 0; $i <= 9; $i++){?>
											<div class="toplist-img-container nailthumbs-topswitch-comments">
												<a href="javascript:void(0);"><img src="<?php echo $filepaths[0][$i]; ?>" class="toplistimages-sub"/></a>
											</div>
										<?php }?>
										
									<?php } else {?>
									
										<?php for($i = 0; $i <= 9; $i++){?>
											<div class="toplist-img-container nailthumbs-topswitch-comments">
												<a href="javascript:void(0);"><img src="<?php echo $filepaths[0][$i]; ?>" class="toplistimages"/></a>
											</div>
										<?php }?>
										
									<?php }?>
							
							</div>
						</div>
					</div>
					
					<div class="page16" id="toplist-comment1">

					</div>
					
					<div class="page16" id="toplist-comment2">
					
					</div>
					
					<div class="page16" id="toplist-comment3">
					
					</div>
					
					<div class="page16" id="toplist-comment4">
					
					</div>
					
					<div class="page16" id="toplist-comment5">
					
					</div>
						
			<script type="text/javascript">
				$(".nailthumbs-topswitch-comments").nailthumb();
				$('.page16:gt(0)').hide();
			</script>
