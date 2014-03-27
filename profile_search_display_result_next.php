<?php if(!empty($search_result_array)) {?>
	
	<table class="table table-condensed table-hover">
	
		<thead id="profile-inner-content-text">
			<td><i class="icon-user"></i></td>
			<td><small><strong>Username</strong></small></td>
			<td><small><strong>Name</strong></small></td>
			<td><small><strong>Lastname</strong></small></td>
			<td><small><strong>Country</strong></small></td>
			<td><small><strong>City</strong></small></td>
		</thead>
		
		<?php foreach($search_result_array as $result_set){ ?>
		
		<tr id="profile-inner-content-text">
			<td><?php if(!empty($result_set['profileimg'])){?><i class="icon-user"></i><?php }?></td>
			<td><a href="javascript:void(0);" class="userlink" data-userx_id="<?php echo $result_set['user_id']; ?>"><strong><?php echo $result_set['username']; ?></strong></a></td>
			<td><?php echo $result_set['name']; ?></td>
			<td><?php echo $result_set['lastname']; ?></td>
			<td><?php echo $result_set['country']; ?></td>
			<td><?php echo $result_set['city']; ?></td>
		</tr>
		</table>
	<?php }}?>