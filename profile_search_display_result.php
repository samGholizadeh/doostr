<span class="page10">
	<span id="search-result">
		
	<?php
	
	if(!empty($search_result_array)) {?>
	
	<table class="table table-condensed table-hover">
	
		<thead id="profile-inner-content-text">
			<td><i class="icon-user"></i></td>
			<td><small><strong>Username</strong></small></td>
			<td><small><strong>Name</strong></small></td>
			<td><small><strong>Lastname</strong></small></td>
			<td><small><strong>Country</strong></small></td>
			<td><small><strong>City</strong></small></td>
		</thead>
		
		<?php $search_result_array_count = count($search_result_array) - 1;

		 if($search_result_array_count > 24){
		
			$search_result_array_first = 24; 

		} else {
			
			$search_result_array_first = $search_result_array_count;

		}?>
		
		<?php for($i = 0; $i <= $search_result_array_first; $i++){ ?>
		
		<tr id="profile-inner-content-text">
			<td><?php if(!empty($search_result_array[$i]['profileimg'])){?><i class="icon-user"></i><?php }?></td>
			<td><a href="javascript:void(0);" class="userlink" data-userx_id="<?php echo $search_result_array[$i]['user_id']; ?>"><strong><?php echo $search_result_array[$i]['username']; ?></strong></a></td>
			<td><?php echo $search_result_array[$i]['name']; ?></td>
			<td><?php echo $search_result_array[$i]['lastname']; ?></td>
			<td><?php echo $search_result_array[$i]['country']; ?></td>
			<td><?php echo $search_result_array[$i]['city']; ?></td>
		</tr>
		<?php }?>
	</table>
	</span>
</span>
		
		<?php $search_result_pages = $search_result_array_count/25;

				if($search_result_pages >= 1){
											
						for($i = 2; $i <= ($search_result_pages + 1); $i++){?>
											
							<span class="page10">
								<span class="search-result<?php echo $i; ?>">
													
								</span>
							</span>
											
					<?php } ?>
					
						<div class="pagination pagination-mini pagination-centered">
							<ul class="profile-search-result-nav">
								<?php for($i = 1; $i <= ($search_result_pages + 1); $i++){?><li>
									<li class="<?php if($i == 1){?>active<?php }?>"><a href="javascript:void(0);" class="profile-search-next-page<?php if($i == 1){?> done<?php }?>" data-current_page="<?php echo $i; ?>"></a></li>
								<?php }?>
							</ul>
						</div>
										
			<?php } else { ?>
									
					<?php }?>
		
	<?php } else { ?>
	
		<h3>Nothing found</h3>
		
	<?php } ?>