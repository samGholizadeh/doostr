		$("#submit-login").click(function(e){
		e.preventDefault();
		var usernameReg = /^[a-zA-Z0-9]+$/;
		var username = $("#login-username").val();
		var password = $("#login-password").val();
		alert(password);
		$.ajax({
			type: 'POST',
			url: '?a=validate',
			data: {
				"username" : username,
				"password" : password
			},

	});