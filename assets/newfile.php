	$("#submit-login").click(function(e){
		e.preventDefault();
		var username = $("#login-username").val();
		var password = $("#login-password").val();
		if(!usernameReg.test(username)){
			$("#input-login-username").html("";
			return false;
		} else if(!usernameReg.test(password)){
			$("#input-login-password").html("");
			return false;
		} else if((username == "") || (password = "")){
			$("#input-login-username").html("<strong><small>Empty field(s)</small></strong>");
			return false;
		} else {
			$.ajax({
				type: 'POST',
				url: '?a=validate',
				data: {
					"username" : username,
					"password" : password
				},
				success: function(data){
					var imported = $.parseJSON(data);
					if(imported.valid == false){
						$("#input-login-username").html("");
					} else {
						$("#signin-register").modal('hide');
						$("#signin-register").on("hidden", function(){
						$.ajax({
							type: 'POST',
							url: '?a=validate_redirect'
							});
						});
					}
				}
			});
		}
	});
	
	case 'validate':
	$username = sanitizeString($_POST['username']);
	$password = sanitizeString($_POST['password']);
	$valid = validatelogin($username, $password);
	if(!$valid){
		$result = array("valid" => $valid);
		echo json_encode($result);
		break;
	} else {
		$lifetime = 60 * 60 * 24 * 4;
		session_set_cookie_params($lifetime);
		$_SESSION['user_id'] = $valid['user_id'];
		$_SESSION['username'] = $username;
		$_SESSION['ip'] = get_current_ip();
		$result = array("valid" => $valid);
		echo json_encode($result);
		break;
	}
	case 'validate_redirect':
		...
		header('location:index.php');
		exit();
		break;