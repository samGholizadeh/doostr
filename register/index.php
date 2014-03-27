<?php
	include_once('../utility/main.php');
	include_once('../model/DBfunctions.php');
	include_once('../model/fields.php');
	include_once('../model/validate.php');
	
	$validate = new Validate();
	$fields = $validate->getFields();
	$fields->addField('username');
	$fields->addField('password');
	$fields->addField('email', 'Must be a valid email address.');
	
	if(isset($_POST['a'])){
		$action = $_POST['a'];
	} else if(isset($_POST['a'])){
		$action = $_GET['a'];
	} else {
		$action = 'Reset';
	}
	
	if($action == 'Reset'){
		include_once 'registration_view.php';
	} else if($action == 'Register'){
		$user = $_POST['username'];
		$strpass = $_POST['password'];
		$stremail = $_POST['email'];
		
		$validate->text('username', $user);
		$validate->email('email', $stremail);
		
		if ($fields->hasErrors()){
			include_once 'registration_view.php';
		} else {
			include_once 'validate.php';
		}
	}
?>