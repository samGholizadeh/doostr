<?php
	include_once('model/DBfunctions.php');
	include_once('utility/main.php');
	Include_once('model/profile_db.php');
	
	$usernameCheck = checkUsername($user);
	$emailCheck = checkEmail($stremail);
	
	if($usernameCheck == 1 || $emailCheck == 1){
		include_once('fail.php');
	} else {
		session_start();
		$_SESSION['ip'] = get_current_ip();
		$user_id = add_user($user, $strpass, $stremail, $_SESSION['ip']);
		$_SESSION['user_id'] = $user_id[0];
		$_SESSION['username'] = $user;
		$pathname = 'member/'.$_SESSION['user_id'];
		mkdir($pathname);
		$pathname = 'member/'.$_SESSION['user_id'].'/files';
		mkdir($pathname);
		$pathname = 'member/'.$_SESSION['user_id'].'/thumbnail';
		mkdir($pathname);
		$pathname = 'member/'.$_SESSION['user_id'].'/large';
		mkdir($pathname);
		insert_user($_SESSION['user_id'], $_SESSION['username']);
		online($_SESSION['username']);
		include_once 'success.php';
	}
?>