<?php
	include_once('../View/Header.php');
	include_once('../View/sidebarMember.php');
	include_once('../utility/main.php');
?>	

	<div id="content">
	<h2><?php echo $username; ?>'s Profile</h2>
	<br />
	<?php foreach($userProfile as $userProfile) {
		echo $userProfile ?><br/>
	<?php }?>
	
	<textarea name="textarea" cols="40" rows="3" ><?php if($textAvail){ echo $text; }?></textarea><br />
	<form method="POST" action="";>
		<input type="hidden" action="action" value="sendMessage" />
		<h3>Send a message to <?php echo $username; ?></h3><p>
		<input type="text" size="40" name="message" />
		<input type="submit" value="Submit" /></p>
	</form>
	
	</div>

<?php include_once('../View/footer.php'); ?>