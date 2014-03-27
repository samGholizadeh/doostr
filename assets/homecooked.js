var file_complete_guest = 0;
var file_count_guest = 0;
var file_complete_voteview = 0;
var file_count_voteview = 0;
var permission_state_voteview = [ [] ];
var rate_info_voteview = [ [] ];
var is_rated_voteview = [];
$(document).ready(function(){

	$('.page1:gt(0)').hide();
	$('.page2:gt(0)').hide(); /* TOPLIST */
	$('.page3:gt(0)').hide();
	$('.page4:gt(0)').hide();
	$('.complete-message').hide();
	$('.reply-comment').hide();
	$('.hide-reported').hide();
	$('.online-indicator').hide();
	$('.image-options').hide();
	$('.image-options2').hide();
	$('.delete-image').hide();
	$(".permission-indicator").hide();
	$(".nailthumbs").nailthumb();
	$("#sub-meme").hide();
	$(".carousel").carousel('pause');
	$(".image-option-menu").hide();
	$("input[placeholder]").placeholder();
	$('.send-message-textarea-container').hide();
	$('.friend-permission-info').tooltip();
	$('.profile-friends-remove-friend').tooltip();
	$("#large-image-rated").tooltip();
	
	$("#register-username").blur(function(e){
		e.preventDefault();
		var usernameReg = /^[a-zA-Z0-9]+$/;
		var username = $(this).val();
		if(username == ""){
			$("#input-check-username").html("");
			return false;
		} else if(!usernameReg.test(username)) {
			$("#input-check-username").html("<span id='check-user-avail' class='label label-important' data-username_available='0'><i class='icon-ban-circle icon-white'></i></span>");
		} else {
		$.ajax({
			type: 'POST',
			url: '?a=check_username_available',
			data: {
				"username" : username
			},
			success: function(data){
				var	imported = $.parseJSON(data);
				if(imported.available == true){
					$("#input-check-username").html("<span id='check-user-avail' class='label label-important' data-username_available='0'><i class='icon-ban-circle icon-white'></i></span>");
				} else {
					$("#input-check-username").html("<span id='check-user-avail' class='label label-success' data-username_available='1'><i class='icon-ok icon-white'></i></span>");
				}
			}
		});
		}
	});
	
		$("#submit-register").click(function(e){
		e.preventDefault();
		var usernameReg = /^[a-zA-Z0-9]+$/;
		var username_available = $("#check-user-avail").data("username_available");
		var username_length = $("#register-username").val().length;
		var password_length = $("#register-password").val().length;
		var email_length = $("#register-email").val().length;
		var username = $("#register-username").val();
		var password = $("#register-password").val();
		var email = $("#register-email").val();
		var image_id = $(".mainimage").data("image_id");
		if((username_length < 3) || (username_length > 18)){
			$("#input-check-username").html("<strong><small>3-13 characters req.</small></strong>");
			return false;
		} else if((password_length <= 6) || (password_length >= 25)){
			$("#input-check-password").html("<strong><small>7-24 characters req.</small></strong>");
			return false;
		} else if(username_available == 0){
			$("#input-check-username").html("<strong><small>Username not available.</small></strong>");
			return false;
		} else if(email_length == 0){
			$("#input-check-email").html("<strong><small>Please enter an email.</small></strong>");
			return false;
		} else if(!isValidEmailAddress(email)) {
			$("#input-check-email").html("<strong><small>Please enter a valid email.</small></strong>");
			return false;
		} else if(!usernameReg.test(username)){
			$("#input-check-username").html("<strong><small>A-Z, a-z, 0-9 only.</small></strong>");
			return false;
		} else if(!usernameReg.test(password)){
			$("#input-check-password").html("<strong><small>A-Z, a-z, 0-9 only.</small></strong>");
			return false;
		} else {
			$.ajax({
				type: 'POST',
				url: '?a=register',
				data: {
					"username" : username,
					"password" : password,
					"email" : email,
					"image_id" : image_id
				},
				success: function(data){
					$(".js-loggedin").attr("id", "yes");
					$("#signin-register").modal('hide');
					$("#signin-register").on('hidden',function(){
					$("#rightvotecolumn").html(data);
					$("#after-login2").html("<a class='btn btn-small btn-success' id='header-profile-button' href='?a=profile'>&nbsp;<strong>"+username+"</strong></a>&nbsp;<a class='btn btn-inverse' id='logout-button' href='?a=logout'><i class='icon-off icon-white'></i></a>");
					}); // end on hidden
					$("#insert-message-indicator").html("<strong><small id='number-messages'>1</small></strong>&nbsp;<a href='?a=profilem'><i class='icon-envelope icon-white' rel='tooltip' title='New messages available'></i></a>");
					$("#change-upload-button").html("<div class='span12' id='browse-filelist-outer'><a href='#add-images-guest' id='add-images-button-voteview' class='btn btn-info' data-toggle='modal'><i class='icon-upload icon-white'</i>&nbsp&nbsp<strong>Upload image</strong></a></div>");
				}
			}); // end ajax
		}
	}); // end submit register
	
		$("#submit-login").click(function(e){
		e.preventDefault();
		var usernameReg = /^[a-zA-Z0-9]+$/;
		var email = $("#login-email").val();
		var password = $("#login-password").val();
		if(!usernameReg.test(password)){
			$("#input-login-password").html("<span id='check-user-avail' class='label label-important'><i class='icon-ban-circle icon-white'></i></span>");
			return false;
		} else if(!isValidEmailAddress(email)){
			$("#input-login-email").html("<span id='check-user-avail' class='label label-important'><i class='icon-ban-circle icon-white'></i></span>");
			return false;
		} else if((email == "") || (password == "")){
			$("#input-login-email").html("<strong><small>Empty field(s)</small></strong>");
			return false;
		} else {
			$.ajax({
				type: 'POST',
				url: '?a=validate',
				data: {
					"password" : password,
					"email" : email
				},
				success: function(data){
					var imported = $.parseJSON(data);
					if(imported.valid == false){
						$("#input-login-email").html("<strong><small>Login failed.</small></strong>");
					} else {
						var user_id = imported.valid;
						var username = imported.username;
						var image_id = $(".mainimage").data("image_id");
						$("#signin-register").modal('hide');
						$("#change-upload-button").html("<div class='span12' id='browse-filelist-outer'><a href='#add-images' id='add-images-button-voteview' class='btn btn-info' data-toggle='modal'><i class='icon-upload icon-white'></i>&nbsp&nbsp<strong>Upload image</strong></a></div>");
						$.ajax({
							type: 'POST',
							url: '?a=validate_redirect',
							data: {
								"user_id" : user_id,
								"image_id" : image_id
							},
							success: function(data){
								$(".js-loggedin").attr("id", "yes");
								$("#rightvotecolumn").html(data);
								$("#after-login2").html("<a class='btn btn-small btn-success' id='header-profile-button' href='?a=profile'>&nbsp;<strong>"+username+"</strong></a>&nbsp;<a class='btn btn-inverse' id='logout-button' href='?a=logout'><i class='icon-off icon-white'></i></a>");
								$.ajax({
									type: 'POST',
									url: '?a=check_new_messages',
									success: function(data){
										var imported = $.parseJSON(data);
										if(imported.value == false){
											$("#insert-message-indicator").html("");
										} else {
											$("#insert-message-indicator").html("<strong><small id='number-messages'>"+imported.value+"</small></strong>&nbsp;<a href='?a=profilem'><i class='icon-envelope icon-white' rel='tooltip' title='New messages available'></i></a>");
										}
									}
								});
								$.ajax({
									type: 'POST',
									url: '?a=check_new_friends',
									success: function(data){
										var imported = $.parseJSON(data);
										if(imported.value == false){
											$("#insert-friend-indicator").html("");
										} else {
											$("#insert-friend-indicator").html("<strong><small id='number-messages'>"+imported.value+"</small></strong>&nbsp;<a href='?a=profilef'><i class='icon-user icon-white' rel='Friendrequests available'></i></a>");
										}
									}
								});
							}
						}); //end ajax after hidden
					}
				}
			});
		}
	});
	
			function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};
	
	setInterval(function(){
		var check = $(".js-loggedin").attr("id");
		if(check == "yes"){
		$.ajax({
			type: 'POST',
			url: '?a=check_new_messages',
			success: function(data){
				var imported = $.parseJSON(data);
				if(imported.value == false){
					$("#insert-message-indicator").html("");
				} else {
					if(imported.current_view == 1){
					$("#insert-message-indicator").html("<strong><small id='number-messages'>"+imported.value+"</small></strong>&nbsp;<a href='#' class='goto-messages'><i class='icon-envelope icon-white' rel='tooltip' title='New messages available'></i></a>");
					} else {
					$("#insert-message-indicator").html("<strong><small id='number-messages'>"+imported.value+"</small></strong>&nbsp;<a href='?a=profilem'><i class='icon-envelope icon-white' rel='tooltip' title='New messages available'></i></a>");
					}
				}
			}
			});
		} else {
		}
	}, 15000);
	
	
	setInterval(function(){
		var check2 = $("#message-page-exists").data("messageexists");
		if(check2 == "yes"){
			$.ajax({
				type: 'POST',
				url: '?a=collect_new_messages',
				success: function(data){
					$("#revolver-inbox tr:first").after(data);
				}
				});
			} else {
			}
		}, 15000);
	
	setInterval(function(){
		var check = $(".js-loggedin").attr("id");
		if(check == "yes"){
		$.ajax({
			type: 'POST',
			url: '?a=check_new_friends',
			success: function(data){
				var imported = $.parseJSON(data);
				if(imported.value == false){
					$("#insert-friend-indicator").html("");
				} else {
					if(imported.current_view == 1){
						$("#insert-friend-indicator").html("<strong><small>"+imported.value+"</small></strong>&nbsp;<a href='#' class='goto-friends'><i class='icon-user icon-white' rel='Friendrequests available'></i></a>");
					} else {
					}
					$("#insert-friend-indicator").html("<strong><small>"+imported.value+"</small></strong>&nbsp;<a href='?a=profilef'><i class='icon-user icon-white' rel='Friendrequests available'></i></a>");
				}
			}
			});
		} else {
		}
	}, 20000);
	
	$(document).on("click","#sals-playground",function(){
		$.ajax({
			type: 'POST',
			url: '?a=sal',
			success: function(data){
				$(".insert-profile").html(data);
			}
		});
		return false;
	});
	
	$(document).on("click",".goto-messages:not(done)", function(e){
		e.preventDefault();
		var message_page_exists = $("#message-page-exists").data("messageexists");
		if(message_page_exists == "yes"){
			$(".page").hide().eq("2").show();
			$(".profilenav li").removeClass("active").eq("2").addClass("active");
		} else {
			$.ajax({
				type: 'POST',
				url: '?a=profile_messages',
				success: function(data){
					$(".profile-messages").addClass("done");
					$("#profile-messages-container").html(data);
					$(".page").hide().eq("2").show();
					$(".profilenav li").removeClass("active").eq("2").addClass("active");
				}
			});
		}
	});
	
	$(document).on("click",".goto-friends:not(done)", function(e){
		e.preventDefault();
		if(!($("#profile-friend-legends").length)){
			$.ajax({
				type: 'POST',
				url: '?a=profile_friends',
				success: function(data){
					$(".profile-friends").addClass("done");
					$("#friends-content").html(data);
					$(".page").hide().eq("3").show();
					$(".profilenav li").removeClass("active").eq("3").addClass("active");
				}
			});
		} else {
			$(".page").hide().eq("3").show();
			$(".profilenav li").removeClass("active").eq("3").addClass("active");
		}
	});

	
	/////////////////////////////////////////////////////// start voteview js.
	
	$(document).on("click","#top10-bar a",function(e){
		e.preventDefault();
		$('.page2').hide().eq($(this).index()).show();
		$(this).addClass('active').siblings().removeClass('active');
		return false;
	});
	
	$(document).on("click",".toplist-average:not(.done)",function(e){
		e.preventDefault();
		var sort_choice = 1;
		var toplist = $(this).data("toplist");
		$(this).addClass("done");
		$.ajax({
			type: 'POST',
			url: '?a=get_toplist',
			data: {
				"sort_choice" : sort_choice,
				"toplist" : toplist
			},
			success: function(data){
				$("#toplist"+toplist).append(data);
			}
		});
		
	});
	
		$(document).on("click",".toplist-comment:not(.done)",function(e){
		e.preventDefault();
		var sort_choice = 2;
		var toplist = $(this).data("toplist");
		$(this).addClass("done");
		$.ajax({
			type: 'POST',
			url: '?a=get_toplist',
			data: {
				"sort_choice" : sort_choice,
				"toplist" : toplist
			},
			success: function(data){
				$("#toplist-comment"+toplist).append(data);
			}
		});
		
	});
	
	$(document).on("click",".toplist-favourite:not(.done)",function(e){
		e.preventDefault();
		var sort_choice = 3;
		var toplist = $(this).data("toplist");
		$(this).addClass("done");
		$.ajax({
			type: 'POST',
			url: '?a=get_toplist',
			data: {
				"sort_choice" : sort_choice,
				"toplist" : toplist
			},
			success: function(data){
				$("#toplist-favourite"+toplist).append(data);
			}
		});
		
	});
	
	$(document).on("click",".toplist-newest:not(.done)",function(e){
		e.preventDefault();
		var sort_choice = 4;
		var toplist = $(this).data("toplist");
		$(this).addClass("done");
		$.ajax({
			type: 'POST',
			url: '?a=get_toplist',
			data: {
				"sort_choice" : sort_choice,
				"toplist" : toplist
			},
			success: function(data){
				$("#toplist-newest"+toplist).append(data);
			}
		});
		
	});
	
	$(document).on("click","#top10-bar-sort button",function(){
		$('.page15').hide().eq($(this).index()).show();
		$(this).addClass('active').siblings().removeClass('active');
		return false;
	});
	
	$(document).on("click","#top10-bar-comment a",function(){
		$('.page16').hide().eq($(this).index()).show();
		$(this).addClass('active').siblings().removeClass('active');
		return false;
	});
	
	$(document).on("click","#top10-bar-favourite a",function(){
		$('.page17').hide().eq($(this).index()).show();
		$(this).addClass('active').siblings().removeClass('active');
		return false;
	});
	
	
	$(document).on("click","#top10-bar-newest a",function(){
		$('.page18').hide().eq($(this).index()).show();
		$(this).addClass('active').siblings().removeClass('active');
		return false;
	});
	
	$(document).on("click","ul#uploaded-images-nav li",function(){
		$(".page19").hide().eq($(this).index()).show();
		$(this).addClass("active").siblings().removeClass("active");
		return false;
	});
	
	$(document).on("click",".uploaded-images-next-page:not(.done)",function(e){
		e.preventDefault();
		$(this).addClass("done");
		var upload_id = $(this).data("upload_id");
		var current_page = $(this).data("current_page");
		$.ajax({
			type: 'POST',
			url: '?a=next_uploaded_image',
			data: {
				"current_page" : current_page,
				"upload_id" : upload_id
			},
			success: function(data){
				$("#uploaded-images-page"+current_page).html(data);
			}
		})
	});
	
	$(document).on("click",".most-commented:not(.done)",function(e){
		e.preventDefault();
		$(this).addClass("done");
		var is_subcategory = $(this).data("sub");
		var subcategory = (is_subcategory == "1") ? $(".mainimage").data("subcategory") : "";
		var category = $(".mainimage").data("category");
		$.ajax({
			type: 'POST',
			url: '?a=change_toplist_comments',
		data: {
				"category" : category,
				"subcategory" : subcategory
			},
			success: function(data){
				$("#sort-comments").html(data);
			}
		});
	});
	
	$(document).on("click",".most-favourite:not(.done)", function(e){
		e.preventDefault(); 
		var is_subcategory = $(this).data("sub");
		var subcategory = (is_subcategory == "1") ? $(".mainimage").data("subcategory") : "";
		var category = $(".mainimage").data("category");
		$(this).addClass("done");
		$.ajax({
			type: 'POST',
			url: '?a=change_toplist_favourite',
		data: {
				"category" : category,
				"subcategory" : subcategory
			},
			success: function(data){
				$("#sort-favourites").html(data);
			}
		});
	});
	
	$(document).on("click",".newest:not(.done)", function(e){
		e.preventDefault();
		var is_subcategory = $(this).data("sub");
		var subcategory = (is_subcategory == "1") ? $(".mainimage").data("subcategory") : "";
		var category = $(".mainimage").data("category");
		$(this).addClass("done");
		$.ajax({
			type: 'POST',
			url: '?a=change_toplist_newest',
		data: {
				"category" : category,
				"subcategory" : subcategory
			},
			success: function(data){
				$("#sort-newest").html(data);
			}
		});
	});
	
	$('.subcategory-container').tooltip();
	
	$(document).on("click",".toplistimages",function(e){
			e.preventDefault();
			var next = "next";
			var filepath = $(this).attr('src');
			$.ajax({
				type: 'POST',
				url: '?a=goto',
				data: {
					"filepath" : filepath,
					"next" : next
				},
				success: function(data){
					$('#rightvotecolumn').html(data);
				}
		});
	});
	
	$(document).on("click",".toplistimages-sub",function(e){
		e.preventDefault();
		var filepath = $(this).attr('src');
		var next = "next"
		e.preventDefault();
			$.ajax({
				type: 'POST',
				url: 'index.php/?a=goto-sub',
				data: {
					"filepath" : filepath,
					"next" : next
				},
				success: function(data){
					$('#rightvotecolumn').html(data);
				}
			});
	});
	
	$(document).on("click","#large-image-rated", function(){
		var filename = $(this).data('filename');
		window.open("http://doostr.com/?x="+filename);
		return false;
	});
	
	$(document).on("click","#large-image-rated-two", function(){
		var image_id = $('.mainimage').data('image_id');
		window.open("http://doostr.com/?x="+image_id);
		return false;
	});
	
		$(document).on("click","#large-image-guest", function(){
		var filename = $(this).data('filename');
		window.open("http://doostr.com/?z="+filename);
		return false;
	});
		
	$(document).on('click','.button-group button:not(.done)', function(e){
			e.preventDefault();
			$(this).addClass('active');
			var votevalue = $(this).data('votevalue');
			var userx_id = $(".mainimage").data("user_id");
			var image_id = $('.mainimage').data('image_id');
			var votes = $('.mainimage').data('votes');
			var totalscore = $('.mainimage').data('totalscore');
			var size = $(".mainimage").data("size");
			var bandwidth = $(".mainimage").data("bandwidth");
			var temp_votes = votes;
			var votes = parseInt(votes, 10);
			temp_votes++;
			var average = Math.round(((parseInt(totalscore, 10) + parseInt(votevalue, 10)) / temp_votes)).toFixed(2);
				$.ajax({
					type: 'POST',
					url: '?a=vote',
					data: {
						"userx_id" : userx_id,
						"votes" : votes,
						"totalscore" : totalscore,
						"votevalue" : votevalue,
						"image_id" : image_id,
						"size" : size,
						"bandwidth" : bandwidth
					},
					success: function(data){
						$('#vote-increment').html(temp_votes);
						$('#display-average').html(average);
						$('#display-average').show();
						$('.button-group button').addClass('done');
					}
			}); // end ajax
	});	// end click
	
		$(document).on('click','.modal-rate:not(.done)', function(e){
			e.preventDefault();
			$(this).addClass('active');
			var userx_id = $("#user_id").data("user_id");
			var image_id = $(this).data("image_id");
			var votevalue = $(this).data('votevalue');
			var votes = $('.mainimage'+image_id).data('votes');
			var totalscore = $('.mainimage'+image_id).data('totalscore');
			var size = $(".mainimage"+image_id).data("size");
			var bandwidth = $(".mainimage"+image_id).data("bandwidth");
			var votes = parseInt(votes, 10);			votes++;
			var average = Math.round(((parseInt(totalscore, 10) + parseInt(votevalue, 10)) / votes)).toFixed(1);
				$.ajax({
					type: 'POST',
					url: '?a=vote',
					data: {
						"userx_id" : userx_id,
						"votes" : votes,
						"totalscore" : totalscore,
						"votevalue" : votevalue,
						"image_id" : image_id,
						"size" : size,
						"bandwidth" : bandwidth
					},
					success: function(data){
						$('#vote-increment'+image_id).html(votes);
						$('#display-average'+image_id).html(average);
						$('#display-average'+image_id).show();
						$('.rate-done'+image_id+' button').addClass('done');
					}
			}); // end ajax
	});	// end click
	
	$(document).on('click','.fav-img:not(.done)', function(e){
			e.preventDefault();
			$(this).addClass("active done");
			var image_id = $(".mainimage").data("image_id");
			$.ajax({
				type: 'POST',
				url: '?a=add_favimg',
				data: {
					"image_id" : image_id
				}
			});
		});
		
	$(document).on('click','.fav-img-modal:not(.done)', function(e){
			e.preventDefault();
			$(this).addClass("active done");
			var image_id = $(this).data("image_id");
			$.ajax({
				type: 'POST',
				url: '?a=add_favimg',
				data: {
					"image_id" : image_id
				}
			});
		});
	
	$(document).on("keyup",".imgcomment",function(e){
		$(".imgcomment").limit("140","#comment-counter");
	});
	
	$(document).on('click','button.next-image-sub', function(e){
		e.preventDefault();
		var category = $('.mainimage').data('category');
		var subcategory = $('.mainimage').data('subcategory');
		var next = "next";
		$.ajax({
			type: 'POST',
			url: '?a=' + category + 'sub',
			data: {
				"subcategory" : subcategory,
				"next" : next
			},
			success: function(data){
				$('#rightvotecolumn').html(data);
			}
		});
	});
	
	$(document).on('click','button.next-image', function(e){
		e.preventDefault();
		var category = $('.mainimage').data('category');
		var next = "next";
		$.ajax({
			type: 'POST',
			url: '?a=' + category,
			data: {
				"next" : next
			},
			success: function(data){
				$('#rightvotecolumn').html(data);
			}
		});
	});
	
	$(document).on('click','button.prev-image-sub:not(.done)', function(e){
		e.preventDefault();
		var category = $('.mainimage').data('category');
		var subcategory = $('.mainimage').data('subcategory');
		var prev = "prev";
		$.ajax({
			type: 'POST',
			url: '?a=' + category + 'sub',
			data: {
				"subcategory" : subcategory,
				"prev" : prev
			},
			success: function(data){
				$('#rightvotecolumn').html(data);
			}
		});
	});
	
	$(document).on('click','button.prev-image:not(.done)', function(e){
		e.preventDefault();
		var category = $('.mainimage').data('category');
		var prev = "prev";
		$.ajax({
			type: 'POST',
			url: '?a=' + category,
			data: {
				"prev" : prev
			},
			success: function(data){
				$('#rightvotecolumn').html(data);
			}
		});
	});
	
	$(document).on("click",".art-sub",function(e){
		e.preventDefault();
		var subcategory = $(this).data("subcategory");
		$.ajax({
			type: 'POST',
			url: '?a=artsub',
			data: {
				"subcategory" : subcategory
			},
			success: function(data){
				$("#insert-subcategory").html(data);
			}
		});
	});
	
	$(document).on("click",".meme-sub",function(e){
		e.preventDefault();
		var subcategory = $(this).data("subcategory");
		$.ajax({
			type: 'POST',
			url: '?a=memesub',
			data: {
				"subcategory" : subcategory
			},
			success: function(data){
				$("#insert-subcategory").html(data);
			}
		});
	});
	
	$(document).on('click','#dislike-image', function(e){
		e.preventDefault();
		$(this).addClass('active');
		var filename = $('.mainimage').data('filename');
		$.ajax({
			type: 'POST',
			url: 'a=dislike_img',
			data: {
				"filename" : filename
			},
			success: function(){
				$('.image-thumbs button').each(function(){
					$(this).unbind('click');
				});
			}
		});
		return false;
	});
	
	$(document).on('click','#submit-comment-voteimg', function(e){
		e.preventDefault();
		var image_id = $('.mainimage').data('image_id');
		var img_comment = $('.imgcomment').val();
		if(img_comment == ""){
			return false;
		}
		$.ajax({
			type: 'POST',
			url: '?a=addimgcomment',
			data: {
				"image_id" : image_id,
				"img_comment" : img_comment
			},
			success: function(data){
				$('#vote-comment-template').prepend(data);
				$('.imgcomment').val("");
				$('#remove-when-comment').remove();
			}
		});
	});
	
	$(document).on('click','#submit-comment-voteimg-modal', function(e){
		e.preventDefault();
		var image_id = $(this).data('image_id');
		var img_comment = $('.modal-rate-comment'+image_id).val();
		if(img_comment == ""){
			return false;
		}
		$.ajax({
			type: 'POST',
			url: '?a=addimgcomment',
			data: {
				"image_id" : image_id,
				"img_comment" : img_comment
			},
			success: function(data){
				$('#vote-comment-template'+image_id).prepend(data);
				$('.modal-rate-comment'+image_id).val("");
				$('#remove-when-comment'+image_id).remove();
			}
		});
	});
	
	$(document).on('click','.submit-reply-button', function(e){
			e.preventDefault();
			var commentid =	$(this).data('commentid');
			var reply = $('textarea.'+commentid).val();
			var image_id = $(".mainimage").data('image_id');
			if(reply == ""){
				return false;
			}
			$.ajax({
				type: 'POST',
				url: '?a=addcommentreply',
				data: {
					"commentid" : commentid,
					"imgcomment" : reply,
					"image_id" : image_id
				},
				success: function(data){
					$('textarea.'+commentid).val("");
					$('.'+commentid+'subcomments').prepend(data);
					$('#'+commentid).hide();
					$("#remove-when-comment").remove();
				}
			});
	});
	
		$(document).on('click','.submit-reply-button-modal', function(e){
			e.preventDefault();
			var commentid =	$(this).data('commentid');
			var reply = $('textarea.'+commentid).val();
			var image_id = $(this).data('image_id');
			if(reply == ""){
				return false;
			}
			$.ajax({
				type: 'POST',
				url: '?a=addcommentreply',
				data: {
					"commentid" : commentid,
					"imgcomment" : reply,
					"image_id" : image_id
				},
				success: function(data){
					$('textarea.'+commentid).val("");
					$('.'+commentid+'subcomments').prepend(data);
					$('#'+commentid).hide();
					$("#remove-when-comment").remove();
				}
			});
	});
	
	$(document).on('click','.submit-reply-button-modal', function(e){
			e.preventDefault();
			var commentid =	$(this).data('commentid');
			var reply = $('textarea.'+commentid).val();
			var image_id = $(this).data('image_id');
			if(reply == ""){
				return false;
			}
			$.ajax({
				type: 'POST',
				url: '?a=addcommentreply',
				data: {
					"commentid" : commentid,
					"imgcomment" : reply,
					"image_id" : image_id
				},
				success: function(data){
					$('textarea.'+commentid).val("");
					$('.'+commentid+'subcomments').prepend(data);
					$('#'+commentid).hide();
				}
			});
		return false;
	});
	
	$(document).on('click','.profile-submit-reply-button', function(e){
			e.preventDefault();
			var commentid =	$(this).data('commentid');
			var reply = $('textarea.'+commentid).val();
			if(reply == ""){
				return false;
			}
			var image_id = $(this).data('image_id');
			var arbitrary = $(this).data('arbitrary');
			$.ajax({
				type: 'POST',
				url: '?a=addcommentreply',
				data: {
					"commentid" : commentid,
					"imgcomment" : reply,
					"image_id" : image_id
				},
				success: function(data){
					$('textarea.'+commentid).val("");
					if(arbitrary == "0"){
						$('.'+commentid+'subcomments').prepend(data);
					} else {
						$('.'+commentid+'subcomments-bylikes').prepend(data);
					}
					$('#'+commentid).hide();
				}
			});
		return false;
	});
	
	$(document).on('click','.likecomment:not(.done)', function(e){
			e.preventDefault();
			var user_id = $(this).data("user_id");
			var commentid = $(this).data('commentid');
			$('.'+commentid+'like').hide();
			$.ajax({
				type: 'POST',
				url: '?a=likecomment',
				data: {
					"commentid" : commentid,
					"user_id" : user_id
				},
				success: function(){
					var likes = $('#'+commentid+'-likes').text();
					likes++;
					$('#'+commentid+'-likes').html(likes);
				}
			});
		return false;
	});
	
	$(document).on('click','.dislikecomment:not(.done)', function(e){
			e.preventDefault();
			var commentid = $(this).data('commentid');
			$('.'+commentid+'like').hide();
			$.ajax({
				type: 'POST',
				url: '?a=dislikecomment',
				data: {
					"commentid" : commentid
				},
				success: function(){
					var dislikes = $('#'+commentid+'-dislikes').text();
					dislikes++;
					$('#'+commentid+'-dislikes').html(dislikes);
				}
			});
		return false;
	});
	
	$(document).on('click','a.onclick:not(.done)', function(e){
		e.preventDefault();
		$(this).addClass("done");
		var commentid =	$(this).data('commentid');
		$.ajax({
			type: 'POST',
			url: '?a=getreplies',
			data:{
				"commentid" : commentid
			},
			success: function(data){
				$('.'+commentid+'subcomments').append(data);
				$('a#extend-comment'+commentid).click(function(e){
					e.preventDefault();
					$('.'+commentid+'subcomments').toggle();
				});
			}
		});
	});
	
	$(document).on('click','.showmore-replies', function(e){
		e.preventDefault();
		var commentid = $(this).data('commentid');
		var currentpage = $(this).data('currentpage');
		$.ajax({
			type: 'POST',
			url: '?a=nexttenreplies',
			data: {
				"commentid" : commentid,
				"currentpage" : currentpage
			},
			success: function(data){
				$('#'+commentid+currentpage).html(data);
				$('#com'+currentpage).hide();
			}
		});
		return false;
	}); //end on()
	
	$(document).on('click','.show-hide-reply-comment', function(e){
			e.preventDefault();
			var commentid = $(this).data('commentid');
			$('#'+commentid).toggle();
	});
	
	$(document).on('click','.show-hide-reply-comment-like', function(e){
			e.preventDefault();
			var commentid = $(this).data('commentid');
			$('#like'+commentid).toggle();
	});
	
	$(document).on('click','.report-comment', function(e){
		e.preventDefault();
		var commentid = $(this).data('commentid');
		$.ajax({
			type: 'POST',
			url: '?a=reportcomment',
			data: {
				"commentid" : commentid
			},
			success: function(){
				$('#comment'+commentid).hide();
			}
		});
	});
	
	$(document).on('click','.show-reported-comment', function(e){
		e.preventDefault();
		var commentid = $(this).data('commentid');
		$('.reported-message'+commentid).toggle();
		$('.hide-reported'+commentid).toggle();
	});
	
	$(document).on('click','.hide-comment', function(e){
		e.preventDefault();
		var commentid = $(this).data('commentid');
		$('.hide-reported'+commentid).toggle();
		$('.reported-message'+commentid).toggle();
	});
	
	$(document).on('keyup','.reply-comment textarea', function(e){
		e.preventDefault();
		var commentid = $(this).attr('class');
		$('textarea.'+commentid).limit('140','#comment-counter'+commentid);
	});
	
	$(document).on('click','a.remove-comment', function(e){
		e.preventDefault();
		var commentid = $(this).data('commentid');
		var parent_commentid = $(this).data('parent_commentid');
		$.ajax({
			type: 'POST',
			url: '?a=removecomment',
			data: {
				"commentid" : commentid,
				"parent_commentid" : parent_commentid
			},
			success: function(){
				$('#comment'+commentid).hide();
			}
		});
	});
	
	$(document).on("click",".next-page:not(.done)",function(e){
		e.preventDefault();
		var image_id = $('.mainimage').data('image_id');
		var current_page = $(this).data("current_page");
		$(this).addClass("done");
		$.ajax({
			type: 'POST',
			url: '?a=nexttencomments',
			data: {
				"image_id" : image_id,
				"current_page" : current_page
			},
			success: function(data){
				$(".comments_page"+current_page).append(data);
			}
		});
	});
	
	$(document).on("click",".next-page-modal-rate:not(.done)",function(e){
		e.preventDefault();
		var image_id = $(this).data('image_id');
		var current_page = $(this).data("current_page");
		$(this).addClass("done");
		$.ajax({
			type: 'POST',
			url: '?a=nexttencomments',
			data: {
				"image_id" : image_id,
				"current_page" : current_page
			},
			success: function(data){
				$(".modal-rate-comments-page"+image_id+current_page).append(data);
			}
		});
	});
	
	$(document).on("click","ul.comment-nav li",function(e){
		e.preventDefault();
		$(".page5").hide().eq($(this).index()).show();
		$(this).addClass("active").siblings().removeClass("active");
	});
	
	///////////////////////////////////////////////////////////////// start profile js.
	
	$(document).on("click",".make-profile-image", function(e){
		e.preventDefault();
		var filename = $(this).data("filename");
		$.ajax({
			type: 'POST',
			url: '?a=make_profile_image',
			data: {
				"filename" : filename
			},
			success: function(data) {
				$("#insert-profile-image").html(data);
			}
		});
	});
	
	$(document).on('click','ul.profilenav li', function(e){
		e.stopPropagation();
		$('.page').hide().eq($(this).index()).show();
		$('ul.profilenav li').removeClass("active");
		$(this).addClass("active");
	}); //end click
	
	$(document).on('click','#gallery', function(e){
		e.preventDefault();
		var username = $(this).data('username');
		$.ajax({
			type: 'POST',
			url: '?a=profile_gallery',
			data: {
				"username" : username
			},
			success: function(data){
				$('#profile-gallery').html(data);
				$('.page1:gt(0)').hide();
				$('#gallery').unbind('click');
			}
		});
	});
	
	$(document).on("click",'ul.gallery-nav li',function(e){
		e.stopPropagation();
		$('.page1').hide().eq($(this).index()).show();
		$('ul.gallery-nav li').removeClass("active");
		$(this).addClass("active");
	}); // end click
	
	$(document).on("click","ul.profile-gallery-subnav li",function(e){
		e.preventDefault();
		$(".page11").hide().eq($(this).index()).show();
		$(this).addClass("active").siblings().removeClass("active");
	});
	
	$(document).on("click",".image-option-toggle", function(e){
		e.preventDefault();
		$("image-option-menu").toggle();
	});
	
	$(document).on("click",".generate-modal-comment:not(.done)", function(e){
		e.preventDefault();
		var user_id = $(this).data("user_id");
		var filename = $(this).data("filename");
		var image_id = $(this).data("image_id");
		$(this).addClass("done");
		$.ajax({
			type: 'POST',
			url: '?a=profile_modal_comment',
			data: {
				"image_id" : image_id
			},
			success: function(data){
				$("#modal_image"+image_id).attr('src', 'member/'+user_id+'/files/'+filename);
				$(".insert-modal-comment"+image_id).append(data);
			}
		});
	});
	
	$(document).on("click","ul.profile-modal-comments-nav li", function(e){
		e.preventDefault();
		$(".page14").hide().eq($(this).index()).show();
		$(this).addClass("active").siblings().removeClass("active");
	});
	
	$(document).on("click",".modal-comment-submit",function(e){
		e.preventDefault();
		var image_id = $(this).data("image_id");
		var comment = $("textarea.modal-textarea"+image_id).val();
		if(comment == ""){
			return false;
		}
			var private = $(".private-comment"+image_id).prop("checked");
			if(private){
				private = 1;
			} else {
				private = 0;
			}
			$.ajax({
				type: 'POST',
				url: '?a=profile_modal_comment_send',
				data: {
					"image_id" : image_id,
					"comment" : comment,
					"private": private
				},
			success: function(data){
				$("#first-comment-modal"+image_id).remove();
				$("textarea.modal-textarea"+image_id).val("");
				$(".insert-modal-comment-sent"+image_id).prepend(data);
				}
			});
	});
	
	$(document).on("click",".profile-modal-comments-next:not(.done)", function(e){
		e.preventDefault();
		$(this).addClass("done");
		var image_id = $(this).data("image_id");
		var current_page = $(this).data("current_page");
		$.ajax({
			type: 'POST',
			url: '?a=profile_modal_comments_next',
			data: {
				"image_id" : image_id,
				"current_page" : current_page
			},
			success: function(data){
				$(".modal-comment-page"+image_id+current_page).html(data);
			}
		});
	});
	
	$(document).on("click", ".change-image-state", function(e){
		e.preventDefault();
		var image_id = $(this).data("image_id");
		var image_state = $(this).data("image_state");
		$.ajax({
			type: 'POST',
			url: '?a=profile_gallery_change_image_state',
			data: {
				"image_id" : image_id,
				"image_state" : image_state
			},
			success: function(){
				if(image_state == "1"){
					$(".permission-indicator img."+image_id).attr('src', '../assets/green-dot.png');
				} else if (image_state == "2"){
					$(".permission-indicator img."+image_id).attr('src', '../assets/yellow-dot.png');
				} else {
					$(".permission-indicator img."+image_id).attr('src', '../assets/red-dot.png');
				}
			}
		});
	});
	
	$(document).on("click","a.profile-gallery-next-page-all:not(.done)",function(e){
		e.preventDefault();
		$(this).addClass("done");
		var user_id = $("#user_id").data("user_id");
		var current_page = $(this).data("current_page");
		$.ajax({
			type: 'POST',
			url: '?a=profile_gallery_next_page_all',
			data: {
				"user_id" : user_id,
				"current_page" : current_page
			},
			success: function(data){
				$(".image-page"+current_page).html(data);
			}
		});
	});
	
	$(document).on('click','a.gallery-nav-rated:not(.done)', function(e){
		var user_id = $("#user_id").data("user_id");
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '?a=profile_gallery_rated',
			data: {
				"user_id" : user_id
			},
			success: function(data){
				$('#gallery-rated').append(data);
				$('.gallery-nav-rated').addClass('done');
			}
		});
	});
	
	$(document).on("click","ul.profile-gallery-rated-subnav li", function(e){
		e.preventDefault();
		$(".page12").hide().eq($(this).index()).show();
		$(this).addClass("active").siblings().removeClass("active");
	});
	
	$(document).on("click",".generate-rated-modal:not(.done)",function(e){
		e.preventDefault();
		$(this).addClass("done");
		var image_id = $(this).data("image_id");
		var arbitrary = "arbitrary"
		$.ajax({
			type: 'POST',
			url: '?a=goto',
			data: {
				"image_id" : image_id,
				"arbitrary" : arbitrary
			},
			success: function(data){
				$(".insert-rated-modal"+image_id).append(data);
			}
		});
	});
	
	$(document).on("click",".profile-gallery-rated-next-page:not(.done)", function(e){
		e.preventDefault();
		var user_id = $("#user_id").data("user_id");
		var current_page = $(this).data("current_page");
		$(this).addClass("done");
		$.ajax({
			type: 'POST',
			url: '?a=profile_gallery_rated_next',
			data: {
				"user_id" : user_id,
				"current_page" : current_page
			},
			success: function(data){
				$(".rated-image-page"+current_page).html(data);
			}
		});
	});
	
	$(document).on('click','a.gallery-nav-favourites:not(.done)', function(e){
		e.preventDefault();
		var user_id = $("#user_id").data("user_id");
		$.ajax({
			type: 'POST',
			url: '?a=profile_gallery_favourites',
			data:{
				"user_id" : user_id
			},
			success: function(data){
				$('#gallery-favourites').append(data);
				$('.gallery-nav-favourites').addClass('done');
			}
		})
	});
	
	$(document).on("click","ul.profile-gallery-favourites-subnav li", function(e){
		e.preventDefault();
		$(".page13").hide().eq($(this).index()).show();
		$(this).addClass("active").siblings().removeClass("active");
	});
	
	$(document).on("click","a.profile-gallery-favourites-next-page:not(.done)", function(e){
		e.preventDefault();
		$(this).addClass("done");
		var current_page = $(this).data("current_page");
		var user_id = $("#user_id").data("user_id");
		$.ajax({
			type: 'POST',
			url: '?a=profile_gallery_favourites_next',
			data: {
				"current_page" : current_page,
				"user_id" : user_id
			},
			success: function(data){
				$(".favourite-page"+current_page).html(data);
			}
		});
	});
	
	$(document).on("click","a.gallery-add-image:not(.done)",function(e){
		e.preventDefault();
		$(this).addClass("done");
		$.ajax({
			type: 'POST',
			url: '?a=profile_add_image_form',
			success: function(data){
				$("#add-image-form").html(data);
			}
		});
	});
	
	$(document).on("click",".profile-gallery:not(.done)",function(e){
		e.preventDefault();
		$(this).addClass("done");
		$.ajax({
			type: 'POST',
			url: '?a=profile_gallery',
			success: function(data){
				$("#insert-profile-gallery").html(data);
			}
		});
	});
	
	$(document).on('click','.delete-image-button', function(e){
		e.preventDefault();
		var image_id = $(this).data("image_id");
		var filename = $(this).data('filename');
		$.ajax({
			type: 'POST',
			url: '?a=delete_image',
			data: {
				"image_id" : image_id,
				"filename" : filename
			},
			success: function(){
				$('.gallery'+image_id).remove();
			}
		});
	});
	
	$(document).on('click','.delete-favourite-button', function(e){
		e.preventDefault();
		var image_id = $(this).data("image_id");
		$.ajax({
			type: 'POST',
			url: '?a=profile_gallery_delete_favourite',
			data: {
				"image_id" : image_id
			},
			success: function(){
				$('.gallery-favourite'+image_id).hide();
			}
		});
	});
	
	$(document).on({
		mouseenter: function(){
			$('.delete-image', this).show();
			$('.image-options', this).show();
			$('.image-options2', this).show();
			$(".permission-indicator", this).show();
		},
		mouseleave: function(){
			$('.delete-image', this).hide();
			$('.image-options', this).hide();
			$('.image-options2', this).hide();
			$(".permission-indicator", this).hide();
		}
	}, '.all-profile-image-containers');
		
	
	$(document).on('click','.profile-comments:not(.done)', function(e){
		e.preventDefault();
		var user_id = $("#user_id").data("user_id");
		$.ajax({
			type: 'POST',
			url: '?a=profile_comments',
			data: {
				"user_id" : user_id
			},
			success: function(data){
				$('#comments-content').html(data);
				$('.profile-comments').addClass('done');
			}
		});
	});
	
	$(document).on('click','ul.comments-nav li',function(e){
		e.preventDefault();
		$('.page3').hide().eq($(this).index()).show();
		$(this).addClass('active').siblings().removeClass('active');
	}); // end on
	
	$(document).on("click",".profile-comments-likes:not(.done)", function(e){
		e.preventDefault();
		var user_id = $("#user_id").data("user_id");
		$.ajax({
			type: 'POST',
			url: '?a=profile_comments_likes',
			data: {
				"user_id" : user_id	
			},
			success: function(data){
				$(".profile-comments-likes").addClass("done");
				$(".comment-likes").append(data);
			}
		});
	});
	
	$(document).on("click","ul.profile-comment-nav li", function(e){
		e.preventDefault();
		$(".page6").hide().eq($(this).index()).show();
		$(this).addClass("active").siblings().removeClass("active");
	});
	
	$(document).on("click",".profile-comment-next-page:not(.done)", function(e){
		e.preventDefault();
		$(this).addClass("done");
		var user_id = $("#user_id").data("user_id");
		var current_page = $(this).data("current_page");
		var arbitrary = "arbitrary"
		$.ajax({
			type: 'POST',
			url: '?a=profile_comments_nexttencomments',
			data: {
				"user_id" : user_id,
				"current_page" : current_page,
				"arbitrary" : arbitrary
			},
			success: function(data){
				$(".comments-page"+current_page).html(data);
			}
		});
	});
	
	$(document).on("click","ul.profile-comment-likes-nav li", function(e){
		e.preventDefault();
		$(".page7").hide().eq($(this).index()).show();
		$(this).addClass("active").siblings().removeClass("active");
	});
	
	$(document).on("click",".profile-comment-next-likes-page:not(.done)", function(e){
		e.preventDefault();
		$(this).addClass("done");
		var user_id = $("#user_id").data("user_id");
		var current_page = $(this).data("current_page");
		$.ajax({
			type: 'POST',
			url: '?a=profile_comments_nexttencomments',
			data: {
				"user_id" : user_id,
				"current_page" : current_page
			},
			success: function(data){
				$(".comments-likes-page"+current_page).html(data);
			}
		});
	});
	
	$(document).on('click','.reply-indicator-com a.get-profile-comments:not(.done)', function(e){
		e.preventDefault();
		$(this).addClass("done");
		var commentid =	$(this).data('commentid');
		var arbitrary = "profilecomment";
		$.ajax({
			type: 'POST',
			url: '?a=profile_comments_getreplies',
			data:{
				"commentid" : commentid,
				"arbitrary" : arbitrary
			},
			success: function(data){
				$('.'+commentid+'subcomments').append(data);
				$('#extend-comment-com'+commentid).click(function(e){
					e.preventDefault();
					$('.'+commentid+'subcomments').toggle();
				});
			}
		});
	});
	
	$(document).on('click','.reply-indicator-com-likes a.get-profile-comments-likes:not(.done)', function(e){
		e.preventDefault();
		$(this).addClass("done");
		var commentid =	$(this).data('commentid');
		$.ajax({
			type: 'POST',
			url: '?a=profile_comments_getreplies',
			data:{
				"commentid" : commentid
			},
			success: function(data){
				$('.'+commentid+'subcomments-bylikes').html(data);
				$('#extend-comment-com-likes'+commentid).click(function(e){
					e.preventDefault();
					$('.'+commentid+'subcomments-bylikes').toggle();
				});
			}
		});
	});
	
	$(document).on('click','.show-parent-comment', function(e){
		e.preventDefault();
		var parent_commentid = $(this).data('parentcommentid');
		var commentid = $(this).data('commentid');
		$.ajax({
			type: 'POST',
			url: '?a=show_parent_comment',
			data: {
				"commentid" : commentid,
				"parent_commentid" : parent_commentid
			},
			success: function(data){
				$('#parent-comment'+commentid).html(data);
				
			}
		}); // end ajax
		return false;
	}); //end on
	
						////// MESSAGES START ///////////////////////
						
	$(document).on('click','.send-message', function(e){
		e.preventDefault();
		var userx_id = $("#user_id").data("user_id");
		var message = $('.message-textarea'+userx_id).val();
		if(message == ""){
			return false;
		} else {
		var usernamex = $(this).data("usernamex");
		$.ajax({
			type: 'POST',
			url: '?a=profile_message_reply_check',
			data: {
				"userx_id" : userx_id
			},
			success: function(data){
				var imported = $.parseJSON(data);
				if(imported.send_message == true){
						$.ajax({
						type: 'POST',
						url: '?a=send_message',
						data: {
							"usernamex" : usernamex,
							"userx_id" : userx_id,
							"message" : message
						},
						success: function(data){
							$('.message-textarea'+userx_id).val("");
						}
					});
				} else {
					$('.message-textarea'+userx_id).val("This member only accept messages from friends");
				}
			}
		});
		}
	});
	
	$(document).on('click','.send-message-friends', function(e){
		e.preventDefault();
		var recipient = $(this).data('recipient');
		var message = $('.message-textarea'+recipient).val();
		if(message == ""){
			return false;
		} else {
		var usernamex = $(this).data("usernamex");
		$.ajax({
			type: 'POST',
			url: '?a=send_message',
			data: {
				"usernamex" : usernamex,
				"recipient" : recipient,
				"message" : message
			},
			success: function(){
				$('.message-textarea'+recipient).val("");
			}
		});
		}
	});
	
	$(document).on("click", ".friend-show-message-box", function(e){
		e.preventDefault();
		var user_id = $(this).data("user_id");
		$(".hide-message-box"+user_id).toggle();
	});
	
	$(document).on("click", ".profilex-show-message-box", function(e){
		e.preventDefault();
		$(".hide-message-box").toggle();
	});
	
	$(document).on("mouseup", "body", function(e){
		var container = $(".hide-message-box");	
		if (container.has(e.target).length === 0){
			container.hide();
		}
	});
	
	$(document).on('click','.profile-messages:not(.done)', function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '?a=profile_messages',
			success: function(data){
				$('#profile-messages-container').html(data);
				$('.profile-messages').addClass('done');
			}
		}); // end ajax
	}); // end click
	
	$(document).on('click','ul.messages-nav li', function(e){
		e.preventDefault();
		$('.page4').hide().eq($(this).index()).show();
		$(this).addClass('active').siblings().removeClass('active');
		return false;
	});
	
	$(document).on('click','.extend-new-message a.onclickmessage',function(e){
		e.preventDefault();
		var messageid = $(this).data('messageid');
		var text = $("#strong"+messageid).text();
		var messages = parseInt($("#number-messages").text(), 10);
		messages--;
		$.ajax({
			type: 'POST',
			url: '?a=profile_message_read',
			data: {
				"messageid" : messageid
			},
			success: function(){
				if(messages == 0){
					$("#insert-message-indicator").html("");
				} else {
					$("#insert-message-indicator").html("<strong><small>"+messages+"</small></strong>&nbsp;<i class='icon-envelope icon-white' rel='tooltip' title='New messages available'></i>");
				}
				$("#remove-inbox"+messageid).data("new_message", "0");
				$('#substring-message'+messageid).toggle();
				$('#complete-message'+messageid).toggle();
				$('#'+messageid+'extend-message a').removeClass('onclickmessage');
				$('#'+messageid+'extend-message a').click(function(e){
					e.preventDefault();
					$('#substring-message'+messageid).toggle();
					$('#complete-message'+messageid).toggle();
					return false;
				});
				$("#strong"+messageid+" strong").remove();
				$("#strong"+messageid).html(text);
			}
		});
	});
	
	$(document).on('click','.extend-message',function(e){
		e.preventDefault();
		var messageid = $(this).data('messageid');
		$('#substring-message'+messageid).toggle();
		$('#complete-message'+messageid).toggle();
		return false;
	});
	
	$(document).on('click','.submit-message-reply',function(e){
		e.preventDefault();
		var messageid = $(this).data('messageid');
		var reply = $('#message-reply-container'+messageid).val();
		if(reply == ""){
			return false;
		} else {
		var recipient = $(this).data('recipient');
		var userx_id = $(this).data("userx_id");
		$.ajax({
			type: 'POST',
			url: '?a=profile_message_reply_check',
			data: {
				"userx_id" : userx_id
			},
			success: function(data){
				var imported = $.parseJSON(data);
				if(imported.send_message == true){
						$.ajax({
						type: 'POST',
						url: '?a=profile_message_reply',
						data: {
							"userx_id" : userx_id,
							"messageid" : messageid,
							"reply" : reply,
							"recipient" : recipient
						},
						success: function(data){
							$('#message-reply-container'+messageid).val("");
							$('#revolver-sent tr:first').after(data);
							$('#strong'+messageid).children().first().unwrap();
						}
					});
				} else {
					$('#message-reply-container'+messageid).val("This member only accept messages from friends");
				}
			}
		});
		}
	});
	
	$(document).on('click','.remove-single-inbox-message', function(e){
		e.preventDefault();
		var messageid = $(this).data('messageid');
		var new_message = parseInt($(this).data("new_message"), 10);
		if(new_message == 1){
			var messages = parseInt($("#number-messages").text(), 10);
			messages--;
		}
		$.ajax({
			type: 'POST',
			url: '?a=profile_message_delete',
			data: {
				"messageid" : messageid
			},
			success: function(){
				$('.table-row'+messageid).hide();
				if(new_message == 1){
					if(messages == 0){
						$("#insert-message-indicator").html("");
					} else {
						$("#insert-message-indicator").html("<strong><small id='number-messages'>"+messages+"</small></strong>&nbsp;<i class='icon-envelope icon-white' rel='tooltip' title='New messages available'></i>");
					}
				}
			}
		});
	});
	
	$(document).on('click','.remove-single-sent-message', function(e){
		e.preventDefault();
		var messageid = $(this).data('messageid');
		var arbitrary = "arbitrary";
		$.ajax({
			type: 'POST',
			url: '?a=profile_message_delete',
			data: {
				"messageid" : messageid,
				"arbitrary" : arbitrary
			},
			success: function(){
				$('.table-row'+messageid).remove();
			}
		});
	});
	
	$(document).on("click","ul.profile-message-nav li", function(e){
		e.preventDefault();
		$(".page8").hide().eq($(this).index()).show();
		$(this).addClass("active").siblings().removeClass("active");
	});
	
	$(document).on("click",".profile-message-next-page:not(.done)", function(e){
		e.preventDefault();
		$(this).addClass("done");
		var current_page = $(this).data("current_page");
		$.ajax({
			type: 'POST',
			url: '?a=profile_message_inbox_next',
			data: {
				"current_page" : current_page
			},
			success: function(data){
				$(".message-inbox-page"+current_page).html(data);
			}
		});
	});
	
	$(document).on("click","ul.profile-message-sent-nav li", function(e){
		e.preventDefault();
		$(".page9").hide().eq($(this).index()).show();
		$(this).addClass("active").siblings().removeClass("active");
	});
	
	$(document).on("click",".profile-message-sent-next-page:not(.done)", function(e){
		e.preventDefault();
		$(this).addClass("done");
		var current_page = $(this).data("current_page");
		$.ajax({
			type: 'POST',
			url: '?a=profile_message_sent_next',
			data: {
				"current_page" : current_page
			},
			success: function(data){
				$(".message-sent-page"+current_page).html(data);
			}
		});
	});
	
	//////////////////////////// PROFILE-CONTACTS /////////////////////////////
	
	
	$(document).on('click','.profile-friends:not(.done)', function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '?a=profile_friends',
			success: function(data){
				$('#friends-content').html(data);
				$('.profile-friends').addClass('done');
			}
		});
	});
	
	$(document).on('click','.profile-friends-remove-friend',function(e){
		e.preventDefault();
		var userx_id = $(this).data('userx_id');
		$.ajax({
			type: 'POST',
			url: '?a=profile_friend_remove',
			data: {
				"userx_id" : userx_id
			},
			success: function(){
				$('.relation_id'+userx_id).hide();
			}
		});
	});
	
	$(document).on('click','.friend-request-option:not(.done)',function(e){
		e.preventDefault();
		var user_id = $(this).data('user_id');
		var choice = $(this).data('choice');
		var number_friends = parseInt($("#number-friends").text(), 10);
		number_friends--;
		$.ajax({
			type: 'POST',
			url: '?a=profile_friend_request_choice',
			data: {
				"user_id" : user_id,
				"choice" : choice
			},
			success: function(){
				if(number_friends == 0){
					$("#insert-friend-indicator").html("");
				} else {
					$("#insert-friend-indicator").html("<strong><small id='number-friends'>"+number_friends+"</small></strong>&nbsp;<i class='icon-user icon-white' rel='Friendrequests available'></i>");
				}
				$(".specific-request"+user_id+" a").addClass('done');
				var color = (choice == '1') ? 'success' : 'error';
				$('.friend-request-color'+user_id).addClass(color);
			}
		});
	});
	
	$(document).on("click",".remove_friend_request",function(e){
		e.preventDefault();
		var userx_id = $(this).data("user_id");
		$.ajax({
			type: 'POST',
			url: '?a=profile_friend_remove',
			data: {
				"userx_id" : userx_id
			},
			success: function(){
				$('.remove-request'+userx_id).remove();
			}
		});
	});
	
	$(document).on('click','.profile-friend-remove-block', function(e){
		e.preventDefault();
		var userx_id = $(this).data("userx_id");
		$.ajax({
			type: 'POST',
			url: "?a=profile_friend_remove_block",
			data: {
				"userx_id" : userx_id
			},
			success: function(){
				$(".remove-block"+userx_id).hide();
			}
		});
	});
	
	$(document).on("change",".permission", function(e){
		e.preventDefault();
		var userx_id = $(this).data("userx_id");
		var permission = $(this).val();
		$.ajax({
			type: 'POST',
			url: '?a=profile_friend_permission',
			data: {
				"userx_id" : userx_id,
				"permission" : permission
			},
			success: function(data){
				$("#testvar").append(data);
			}
		});
	});
	
	$(document).on("click",".profilex-block-user:not(.done)",function(e){
		e.preventDefault();
		var userx_id = $("#user_id").data("user_id");
		$.ajax({
			type: 'POST',
			url: '?a=block_user',
			data:{
				"userx_id" : userx_id
			},
			success: function(){
				$(".profilex-block-user").addClass("done active");
				$(".add-friend").addClass("done active");
			}
		});
	});
	
	$(document).on("click",".profilex-block-user-pending:not(.done)",function(e){
		e.preventDefault();
		var userx_id = $("#user_id").data("user_id");
		$.ajax({
			type: 'POST',
			url: '?a=block_friend',
			data:{
				"userx_id" : userx_id
			},
			success: function(){
				$(".profilex-block-user-pending").addClass("done active");
				$(".add-friend").addClass("done active");
			}
		});
	});
	/////////////////////////// PROFILE DISPLAY SEARCH //////////////////////////
	
	$(document).on('click','.profile-search:not(.done)',function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '?a=profile_search_view',
			success: function(data){
				$('#search-view').prepend(data);
				$(".profile-search").addClass("done");
			}
		});
	});
	
	$(document).on('click','.userlink',function(){
		var user_id = $("#user_id").data("user_id");
		var userx_id = $(this).data('userx_id');
		var number_friends = parseInt($("#number-friends").text(), 10);
		var number_messages = parseInt($("#number-messages").text(), 10);
		if(user_id == userx_id){
			var profile = 'profile';
		} else {
			var profile = 'profile.';
		}
		$.ajax({
			type: 'POST',
			url: '?a='+profile,
			data: {
				"userx_id" : userx_id
			},
			success: function(data){
				$('.insert-profile').html(data);
				if(number_messages >= 1){
				$("#insert-message-indicator").html("<strong><small id='number-messages'>"+number_messages+"</small></strong>&nbsp;<a href='?a=profilem'><i class='icon-envelope icon-white' rel='tooltip' title='New messages available'></i></a>");
				} else if(number_friends >= 1){
				$("#insert-friend-indicator").html("<strong><small id='number-friends'>"+number_friends+"</small></strong>&nbsp;<a href='?a=profilef'><i class='icon-user icon-white' rel='Friendrequests available'></i></a>");
				} else {
				}
			}
		});
	});
	
	$(document).on('click','.userlink2',function(){
		$.ajax({
			type: 'POST',
			url: '?a=profile',
			success: function(data){
				$('.insert-profile').html(data);
			}
		});
	});
	
	$(document).on("click","ul.profile-search-result-nav", function(e){
		e.preventDefault();
		$(".page10").hide().eq($(this).index()).show();
		$(this).addClass("active").siblings().removeClass("active");
	});
	
	$(document).on("click",".profile-search-next-page:not(.done)", function(e){
		e.preventDefault();
		$(this).addClass(".done");
		var current_page = $(this).data("current_page");
		var username = $('#search-username').val();
		var name = $('#search-name').val();
		var lastname = $('#search-lastname').val();
		var city = $('#search-city').val();
		var country = $('#search-country').val();
		var minage = $('#search-agemin').val();
		var maxage = $('#search-agemax').val();
		var gender = $('#gender').val();
		var lastseen = $('#lastseen').val();
		$.ajax({
			type: 'POST',
			url: '?a=profile_search_next_page',
			data: {
				"current_page" : current_page,
				"username" : username,
				"name" : name,
				"lastname" : lastname,
				"city" : city,
				"country" : country,
				"minage" : minage,
				"maxage" : maxage,
				"gender" : gender,
				"lastseen" : lastseen
			},
			success: function(data){
				$('#search-username').val(username);
				$('#search-name').val(name);
				$('#search-lastname').val(lastname);
				$('#search-city').val(city);
				$('#search-country').val(country);
				$('#search-agemin').val(minage);
				$('#search-agemax').val(maxage);
				$('#gender').val(gender);
				$('#lastseen').val(lastseen);
				$(".search-result"+current_page).html(data);
			}
		});
	});
	
	$(document).on("click","#member-search-button", function(e){
		e.preventDefault();
		var usernameReg = /^[a-zA-Z0-9]+$/;
		var arbitrary = "arbitrary";
		var username = $('#search-username').val();
		var name = $('#search-name').val();
		var lastname = $('#search-lastname').val();
		var city = $('#search-city').val();
		var country = $('#search-country').val();
		var minage = $('#search-agemin').val();
		var maxage = $('#search-agemax').val();
		var gender = $('#gender').val();
		var lastseen = $('#lastseen').val();
		$.ajax({
			type: 'POST',
			url: '?a=search',
			data: {
				"arbitrary" : arbitrary,
				"username" : username,
				"name" : name,
				"lastname" : lastname,
				"city" : city,
				"country" : country,
				"minage" : minage,
				"maxage" : maxage,
				"gender" : gender,
				"lastseen" : lastseen
			},
			success: function(data){
				$('#search-username').val(username);
				$('#search-name').val(name);
				$('#search-lastname').val(lastname);
				$('#search-city').val(city);
				$('#search-country').val(country);
				$('#search-agemin').val(minage);
				$('#search-agemax').val(maxage);
				$('#gender').val(gender);
				$('#lastseen').val(lastseen);
				$('#search-result').html(data);
			}
		});
	});
	
	/////////////////// PROFILE PREFERENCES //////////////////////////////
	
	$(document).on('click','.profile-preferences:not(.done)', function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '?a=profile_preferences',
			success: function(data){
				$('#profile-preferences').html(data);
				$('.profile-preferences').addClass('done');
			}
		});
	});
	
	///////////////////////// END PROFILE MESSAGE ////////////////////////////

	$('.profile-images-goto').each(function(){
		$(this).click(function(){
			var filename = $(this).data(filename);
			$.ajax({
				type: 'POST',
				url: 'index.php'
			});
		}); //end this click
	}); // end each
	
	$(document).on('click','.anonymous:not(.done)', function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '?a=anonymous',
			success: function(){
				$('.anonymous-option').hide();
				$('.anonymous').addClass('done');
				$(".remove-anonymous").removeClass('done');
			}
		});
	});//end makeSearchable
	
	$(document).on('click','.remove-anonymous:not(.done)', function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '?a=remove_anonymous',
			success: function(){
				$('.anonymous-option').show();
				$(".remove-anonymous").addClass("done");
				$(".anonymous").removeClass("done");
			}
		});
	});
	
	$(document).on('click','.appearonline:not(.done)', function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '?a=appearonline',
			success: function(){
				$('#online-indicator').toggle();
				$('#offline-indicator').toggle();
				$('.appearonline').addClass('done');
				$('.appearoffline').removeClass('done');
			}
		});
	});
	
	$(document).on('click','.appearoffline:not(.done)', function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '?a=appearoffline',
			success: function(){
				$('#online-indicator').toggle();
				$('#offline-indicator').toggle();
				$('.appearonline').removeClass('done');
				$('.appearoffline').addClass('done');
			}
		});
	});
	
	$(document).on('click','.message-preference-all:not(.done)', function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '?a=message_preference_all',
			success: function(){
				$('.message-preference-all').addClass('done');
				$('.message-preference-friend').removeClass('done');
			}
		});
	});
	
	$(document).on('click','.message-preference-friend:not(.done)', function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '?a=message_preference_friend',
			success: function(){
				$('.message-preference-all').removeClass('done');
				$('.message-preference-friend').addClass('done');
			}
		});
	});
	
	$(document).on('click','.profile_visibility_public:not(.done)', function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '?a=profile_visibility_public',
			success: function(){
				$(".profile_visibility_public").addClass("done");
				$(".profile_visibility_friends").removeClass("done");
				$(".profile_visibility_private").removeClass("done");
			}
		});
	});
	
	$(document).on('click','.profile_visibility_friends:not(.done)', function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '?a=profile_visibility_friends',
			success: function(){
				$(".profile_visibility_public").removeClass("done");
				$(".profile_visibility_friends").addClass("done");
				$(".profile_visibility_private").removeClass("done");
			}
		});
	});
	
	$(document).on('click','.profile_visibility_private:not(.done)', function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '?a=profile_visibility_private',
			success: function(){
				$(".profile_visibility_public").removeClass("done");
				$(".profile_visibility_friends").removeClass("done");
				$(".profile_visibility_private").addClass("done");
			}
		});
	});
	
	$(document).on('click','#save-contact-info',function(e){
		var name = $('#contact-info-name').val();
		var lastname = $('#contact-info-lastname').val();
		var age = $('#contact-info-age').val();
		var country = $('#contact-info-country').val();
		var city = $('#contact-info-city').val();
		var gender = $('#contact-info-gender').val();
		$.ajax({
			type: 'POST',
			url: '?a=update_contact_info',
			data: {
				"name" : name,
				"lastname" : lastname,
				"city" : city,
				"country" : country,
				"age" : age,
				"gender" : gender
			}
		});
	});
	
	$(document).on('click','#save-search-criteria',function(e){
		e.preventDefault();
		var age_min = $('#search-criteria-agemin').val();
		var age_max = $('#search-criteria-agemax').val();
		var gender = $('#search-criteria-gender').val();
		$.ajax({
			type: 'POST',
			url: '?a=update_search_criteria',
			data: {
				"age_min" : age_min,
				"age_max" : age_max,
				"gender" : gender
			},
			success: function(){
				$('#contact-info-age').val(age);
				$('#contact-info-gender').val(gender);
			}
		});
	});
	
	$(document).on("click",".delete-account", function(){
		$.ajax({
			type: 'POST',
			url: '?a=deleteaccount'
		});
	}); // end click
	
	$('#logoutimg').click(function(){
		$.ajax({
			type: 'POST',
			url: '?a=logout'
		});
	});
	
	//////////////////////////////////////// Gallery NAV //////////
	
	///////////////////////////////////////// ABOUT ////////////////
	$('#btn-saveprofile .btn').click(function(){
		var profiledescr = $('textarea.profiledescription').val();
		var sparetime = $('textarea.sparetime').val();
		var listenmusic = $('textarea.listenmusic').val();
		var readbooks = $('textarea.readbooks').val();
		var food = $('textarea.food').val();
		var movies = $('textarea.movies').val();
		$.ajax({
			type: 'POST',
			url: 'index.php/?a=updateabout',
			data: {
				"profiledescr" : profiledescr,
				"sparetime" : sparetime,
				"listenmusic" : listenmusic,
				"readbooks" : readbooks,
				"food" : food,
				"movies" : movies
			},
			success: function(){
				$('textarea.profiledescription').val(profiledescr);
				$('textarea.sparetime').val(sparetime);
				$('textarea.listenmusic').val(listenmusic);
				$('textarea.readbooks').val(readbooks);
				$('textarea.food').val(food);
				$('textarea.movies').val(movies);
			}
		}); // end ajax
	}); // end click
	
	$('#submit-profile').click(function(){
		var name = $('#profile-name-lastname').val();
		var age = $('#age').val();
		var city = $('#city').val();
		var country = $('#country').val();
		var skype = $('#skype').val();
		$.ajax({
			type: 'POST',
			url: '?a=updateabout2',
			data: {
				"name" : name,
				"age" : age,
				"city" : city,
				"country" : country,
				"skype" : skype
			},
			success: function(){
				$('#profile-name-lastname').val(name);
				$('#age').val(age);
				$('#city').val(city);
				$('#country').val(country);
				$('#skype').val(skype);
			}
		});
	});
	
	
	/////////////////////////////////////////// END ABOUT //////////////////////
	
	///////////////////////////////////////////////////////////// end profile js.
	
	///////////////////////////////////////////////////////////// otherusers profile js.
	
	$(document).on('click','.add-friend:not(.done)', function(e){
		e.preventDefault();
		var username = $(this).data("username");
		var userx_id = $('#user_id').data('user_id');
		$.ajax({
			type: 'POST',
			url: '?a=profile_friend_request',
			data: {
				"username" : username,
				"userx_id" : userx_id
			},
			success: function(data){
				$('.add-friend').addClass('active done');
				$(".profilex-block-user").addClass("active done");
			}
		});
	});
	
	$('img.block').click(function(){
		var otheruser = $(this).data('otheruser');
		$.ajax({
			type: 'POST',
			url: 'index.php/?a=block',
			data: {
				"otheruser" : otheruser
			}
		});
	});
	
	$('img.unblock').click(function(){
		var otheruser = $(this).data('otheruser');
		$.ajax({
			type: 'POST',
			url: 'index.php/?a=unblock',
			data: {
				"otheruser" : otheruser
			}
		});
	});
	
	$('img.otherimages').click(function(){
		var otheruser = $(this).data('otheruser');
		$.ajax({
			type: 'POST',
			url: 'index.php/?a=gallery.',
			data: {
				"otheruser" : otheruser
			}
		});
	});
	
	//////////////////////////////////////////////////////////////////// end otherusers profile js.
	
	$('img.unrateimg').each(function(){
		$(this).click(function(){
		var filename = $(this).data('filename');
		$.ajax({
			type: 'POST',
			url: 'index.php/?a=unrateimg',
			data: {
				"filename" : filename
			},
			success: function(){
				$('.imgstats').remove();
			}
		});
		});
	});
	
	$('img.makeprofileimg').each(function(){
		$(this).click(function(){
		var filename = $(this).data('filename');
		$.ajax({
			type: 'POST',
			url: 'index.php/?a=makeprofileimg',
			data: {
				"filename" : filename
			}
			});
		});
	});
	
	$('img.deleteimg').each(function(){
		$(this).click(function(){
			var filename = $(this).data('filename');
			
			$.ajax({
				type: 'POST',
				url: 'index.php/?a=deleteimg',
				data: {
					"filename" : filename,
				}
			});
		});
	});
	
	///////////// ALBUM CREATION
	
	$('.createalbum').click(function(){
		var imageArray = [];
		var albumname = $('#albumname');
		$('.imagesselected').each(function(){
			var isChecked = $(this).attr('checked');
			if(isChecked){
				var imagePath = $(this).data('imagesource');
				imageArray.push(imagePath);
			}
		}); // end each imageSelected
		$.ajax({
			type: 'POST',
			url: '?a=createalbum',
			data: {
				"imageArray" : imageArray,
				"albumname" : albumname
			}
		}); //end Ajax
	});// end click
	
	////////////////// FAVOURITES TAB
	
	$('img.showfavimg').click(function(){
		$.ajax({
			type: 'POST',
			url: '?a=favimg'
		});
	});
	
	///////////////// Galleryx i.e otheruser
	
	$('img.favimgbutton').each(function(){
		$(this).click(function(){
			var filename = $(this).data('filename');
			var imgowner = $(this).data('imgowner');
			var imgstate = $(this).data('imgstate');
			$.ajax({
				type: 'POST',
				url: 'index.php/?a=favimgGalleryx',
				data: {
					"filename" : filename,
					"imgowner" : imgowner,
					"imgstate" : imgstate
				}
			});
			$('img.favimgbutton').remove();
		});
	});
	
	
	$('img.dropfriend').each(function(){
		$(this).click(function(){
			var friend = $(this).data('friend');
			$.ajax({
				type: 'POST',
				url: 'index.php/?a=dropfriend',
				data: {
					"friend" : friend
				}
			});
			$('#.' + friend).remove();
		});
	});
	
	$('#createalbum').click(function(){
		var imageArray = [];
		var albumname = $('#albumname');
		$('.imagesselected').each(function(){
			var isChecked = $(this).attr('checked')?true:false;
			if(isChecked){
				var imagePath = $(this).data('imagesource');
				imageArray.push(imagePath);
			}
		}); // end each imageSelected
		$.ajax({
			type: 'POST',
			url: '?a=createalbum',
			data: {
				"imageArray" : imageArray,
				"albumname" : albumname
			}
		}); //end Ajax
	});// end click

			$manual_uploader = $("#browse-files");
			var uploader = new qq.FineUploaderBasic({
				button: $manual_uploader[0],
				autoUpload: false,
				maxConnections: 1,
				listElement: $("#filelist"),
				request: {
					endpoint: '?a=upload_image',
					forceMultipart: true
				},
				validation: {
					sizeLimit: 5242880,
					minSizeLimit: 5120,
					allowedExtensions: ["jpg", "JPG", "jpeg", "png", "gif", "bmp"]
				},
				text: {
					cancelButton: 'cancel',
					failUpload: 'Upload failed'
				},
				callbacks: {
					onSubmit: function(id, fileName){
						if(file_count >= 5){
							return false;
						} else {
						file_count++;
						if(fileName.length > 35){
							fileName = (fileName.substring(0,35));
							$("#filelist").append("<span id='listedfile"+id+"'><div><small>"+fileName+"...</small>&nbsp;&nbsp;<a href='#' id='removeListedFile' data-fileid='"+id+"'>cancel</a></div></span>");
						} else {
							$("#filelist").append("<span id='listedfile"+id+"'><div><small>"+fileName+"</small>&nbsp;&nbsp;<a href='#' id='removeListedFile' data-fileid='"+id+"'>cancel</a></div></span>");
						}
						if(file_count == 1){
							$("#close-upload-modal").after("<a id='upload-images' class='btn btn-success'><i class='icon-upload icon-white'></i>&nbsp;<strong> Start upload</strong></a>");
						}
						if(file_count >= 5){
							$("#browse-files").hide();
						}
						if(file_count == 1){
							if(fileName.length > 20){
								fileName = (fileName.substring(0,20))+"...";
							}
							$("#filelist").after(" \
							<br id='arbitrary'> \
							<table id='filelist-settings' class='table-condensed'> \
								<thead> \
									<td><strong><small>Filename</small></strong></td> \
									<td id='rate-input'><strong><small>Rate</small></strong>&nbsp<i class='icon-question-sign' rel='tooltip' title='Rating an image will make it available for visitors to rate and comment. Choose an appropriate category.'></i></td>\
									<td id='state-category'><strong><small>Image status</small></strong></td> \
									<td id='subcategory'></td> \
									<td><strong><small>Title</small></strong></td> \
								</thead> \
								<tr><td id='listedfile"+id+"'><small>"+fileName+"</small></td> \
								 \
								<td><input id='voteit' type='checkbox' name='voteit"+id+"' data-voteit='"+id+"' /></td> \
								<td id='state-category"+id+"'> \
									<select id='permission-level' class='permission-level"+id+"' data-fileid='"+id+"'> \
										<option value='1'>Public</option> \
										<option value='2'>Friends</option> \
										<option value='3'>Private</option> \
										\
									</select> \
								</td>\
									\
								<td id='subcategory"+id+"'></td> \
								<td><textarea id='title-textarea"+id+"' class='title-textarea' data-textarea_id='"+id+"'></textarea></td> \
								<td><strong><small><span id='title-counter"+id+"'></span></small></strong></td> \
								</tr>\
							</table>\
							");
						} else {
							if(fileName.length > 20){
								fileName = (fileName.substring(0,20))+"...";
							}
							$("#filelist-settings tr:last").after(" \
							<tr id='tr"+id+"'> \
							\
							<td><small>"+fileName+"</small></td> \
							\
							<td id='listedfile"+id+"'> \
							\
								<input id='voteit' type='checkbox' name='voteit"+id+"' data-voteit='"+id+"' />\
							\
							</td> \
							\
							<td id='state-category"+id+"'> \
								<select id='permission-level' class='permission-level"+id+"' data-fileid='"+id+"'> \
									<option value='1'>Public</option> \
									<option value='2'>Friends</option> \
									<option value='3'>Private</option> \
								\
								</select>\
							\
							</td> \
							\
							<td id='subcategory"+id+"'></td> \
							\
							<td><textarea id='title-textarea"+id+"' class='title-textarea' data-textarea_id='"+id+"'></textarea></td> \
							<td><strong><small><span id='title-counter"+id+"'></span></small></strong></td> \
							</tr> \
							");
						}
						}
					},
					onUpload: function(id, fileName){
						$("#arbitrary").remove();
						$("#upload-images").remove();
						$("#filelist-settings").hide();
						$("#listedfile"+id+" a").replaceWith("<img id='loading-gif' src='assets/loading-fineuploader.gif' alt='Initializing. Pleasehold.' />");
					},
					onProgress: function(id, fileName, loaded, total){
						if(loaded < total){
							progress = Math.round(loaded / total * 100) + '% of ' + Math.round(total / 1024) + ' kB';
							$("#listedfile"+id+" img").append("&nbsp;"+progress);
						}
					},
					onCancel: function(id, fileName){
						file_count--;
						$("#listedfile"+id).remove();
						if(file_count == 0){
							$("#arbitrary").remove();
							$("#upload-images").remove();
							$("#filelist-settings").remove();
						} else {
							$("#tr"+id).remove();
						}
						if(file_count == 4){
							$("#browse-files").show();
						}
					},
					onComplete: function(id, fileName, responseJSON) {
						file_complete++;
						if($("input[name=voteit"+id+"]").prop("checked")){
							rate_info[file_complete - 1] = [];
							is_rated.push(1);
							rate_info[file_complete - 1].push($("#title-textarea"+id).val());
							rate_info[file_complete - 1].push($("select[name=category"+id+"]").val());
							rate_info[file_complete - 1].push($("select[name=subcategory"+id+"]").val());
						} else {
							permission_state[file_complete - 1] = [];
							is_rated.push(0);
							permission_state[file_complete - 1].push($(".permission-level"+id).val());
							permission_state[file_complete - 1].push($("#title-textarea"+id).val());
						}
						$("#listedfile"+id).remove();
						if(file_complete == file_count){
							$.ajax({
								type: 'POST',
								url: '?a=upload_image2',
								data: {
									"is_rated" : is_rated,
									"rate_info" : rate_info,
									"permission_state" : permission_state
								},
								success: function(data){
									$('#add-images').modal('hide');
									$("#browse-files").show();
									file_count = 0;
									file_complete = 0;
									permission_state = [ [] ];
									rate_info = [ [] ];
									is_rated = [];
									uploader.reset();
									if(!($("#image-bar").length)){
									} else {
									$(".page").hide().eq(0).show();
									$("#insert-new-images").prepend(data);
									$("ul.gallery-nav li").removeClass("active").eq(0).addClass("active");
									$("ul.profilenav li").removeClass("active").eq(0).addClass("active");
									}
								}
							});
						}
					}
				},
				debug: true
			});
			
			$manual_uploader_voteview = $("#browse-files-voteview");
			var uploader_voteview = new qq.FineUploaderBasic({
				button: $manual_uploader_voteview[0],
				autoUpload: false,
				maxConnections: 1,
				listElement: $("#filelist-voteview"),
				request: {
					endpoint: '?a=upload_image',
					forceMultipart: true
				},
				validation: {
					sizeLimit: 5242880,
					minSizeLimit: 5120,
					allowedExtensions: ["jpg", "JPG", "jpeg", "png", "gif", "bmp"]
				},
				text: {
					cancelButton: 'cancel',
					failUpload: 'Upload failed'
				},
				callbacks: {
					onSubmit: function(id, fileName){
						if(file_count_voteview >= 5){
							return false;
						} else {
						file_count_voteview++;
						if(fileName.length > 35){
							fileName = (fileName.substring(0,35));
							$("#filelist-voteview").append("<span id='listedfile"+id+"'><div><small>"+fileName+"...</small>&nbsp;&nbsp;<a href='#' id='removeListedFile-voteview' data-fileid='"+id+"'>cancel</a></div></span>");
						} else {
							$("#filelist-voteview").append("<span id='listedfile"+id+"'><div><small>"+fileName+"</small>&nbsp;&nbsp;<a href='#' id='removeListedFile-voteview' data-fileid='"+id+"'>cancel</a></div></span>");
						}
						if(file_count_voteview == 1){
							$("#close-upload-modal").after("<a id='upload-images-voteview' class='btn btn-success'><i class='icon-upload icon-white'></i>&nbsp;<strong> Start upload</strong></a>");
						}
						if(file_count_voteview >= 5){
							$("#browse-files").hide();
						}
						if(file_count_voteview == 1){
							if(fileName.length > 20){
								fileName = (fileName.substring(0,20))+"...";
							}
							$("#filelist-voteview").after(" \
							<br id='arbitrary'> \
							<table id='filelist-settings' class='table-condensed'> \
								<thead> \
									<td><strong><small>Filename</small></strong></td> \
									<td id='rate-input'><strong><small>Rate</small></strong>&nbsp<i class='icon-question-sign' rel='tooltip' title='Rating an image will make it available for visitors to rate and comment. Choose an appropriate category.'></i></td>\
									<td id='state-category'><strong><small>Image status</small></strong></td> \
									<td id='subcategory'></td> \
									<td><strong><small>Title</small></strong></td> \
								</thead> \
								<tr><td id='listedfile"+id+"'><small>"+fileName+"</small></td> \
								 \
								<td><input id='voteit' type='checkbox' name='voteit"+id+"' data-voteit='"+id+"' /></td> \
								<td id='state-category"+id+"'> \
									<select id='permission-level' class='permission-level"+id+"' data-fileid='"+id+"'> \
										<option value='1'>Public</option> \
										<option value='2'>Friends</option> \
										<option value='3'>Private</option> \
										\
									</select> \
								</td>\
									\
								<td id='subcategory"+id+"'></td> \
								<td><textarea id='title-textarea"+id+"' class='title-textarea' data-textarea_id='"+id+"'></textarea></td> \
								<td><strong><small><span id='title-counter"+id+"'></span></small></strong></td> \
								</tr>\
							</table>\
							");
						} else {
							if(fileName.length > 20){
								fileName = (fileName.substring(0,20))+"...";
							}
							$("#filelist-settings tr:last").after(" \
							<tr id='tr"+id+"'> \
							\
							<td><small>"+fileName+"</small></td> \
							\
							<td id='listedfile"+id+"'> \
							\
								<input id='voteit' type='checkbox' name='voteit"+id+"' data-voteit='"+id+"' />\
							\
							</td> \
							\
							<td id='state-category"+id+"'> \
								<select id='permission-level' class='permission-level"+id+"' data-fileid='"+id+"'> \
									<option value='1'>Public</option> \
									<option value='2'>Friends</option> \
									<option value='3'>Private</option> \
								\
								</select>\
							\
							</td> \
							\
							<td id='subcategory"+id+"'></td> \
							\
							<td><textarea id='title-textarea"+id+"' class='title-textarea' data-textarea_id='"+id+"'></textarea></td> \
							<td><strong><small><span id='title-counter"+id+"'></span></small></strong></td> \
							</tr> \
							");
						}
						}
					},
					onUpload: function(id, fileName){
						$("#arbitrary").remove();
						$("#upload-images-voteview").remove();
						$("#filelist-settings").hide();
						$("#listedfile"+id+" a").replaceWith("<img id='loading-gif' src='assets/loading-fineuploader.gif' alt='Initializing. Pleasehold.' />");
					},
					onProgress: function(id, fileName, loaded, total){
						if(loaded < total){
							progress = Math.round(loaded / total * 100) + '% of ' + Math.round(total / 1024) + ' kB';
							$("#listedfile"+id+" img").append("&nbsp;"+progress);
						}
					},
					onCancel: function(id, fileName){
						file_count_voteview--;
						$("#listedfile"+id).remove();
						if(file_count_voteview == 0){
							$("#arbitrary").remove();
							$("#upload-images-voteview").remove();
							$("#filelist-settings").remove();
						} else {
							$("#tr"+id).remove();
						}
						if(file_count_voteview == 4){
							$("#browse-files").show();
						}
					},
					onComplete: function(id, fileName, responseJSON) {
						file_complete_voteview++;
						if($("input[name=voteit"+id+"]").prop("checked")){
							rate_info_voteview[file_complete_voteview - 1] = [];
							is_rated_voteview.push(1);
							rate_info_voteview[file_complete_voteview - 1].push($("#title-textarea"+id).val());
							rate_info_voteview[file_complete_voteview - 1].push($("select[name=category"+id+"]").val());
							rate_info_voteview[file_complete_voteview - 1].push($("select[name=subcategory"+id+"]").val());
						} else {
							permission_state_voteview[file_complete_voteview - 1] = [];
							is_rated_voteview.push(0);
							permission_state_voteview[file_complete_voteview - 1].push($(".permission-level"+id).val());
							permission_state_voteview[file_complete_voteview - 1].push($("#title-textarea"+id).val());
						}
						if(file_complete_voteview == 1){
							$.ajax({
								type: 'POST',
								url: '?a=upload_id_session'
							});
						}
						$.ajax({
							type: 'POST',
							url: '?a=upload_add_guest_filename'
						});
						$("#listedfile"+id).remove();
						if(file_complete_voteview == file_count_voteview){
							$.ajax({
								type: 'POST',
								url: '?a=upload_image2_voteview',
								data: {
									"is_rated" : is_rated_voteview,
									"rate_info" : rate_info_voteview,
									"permission_state" : permission_state_voteview
								},
								success: function(){
									$.ajax({
										type: 'POST',
										url: '?a=upload_done',
										success: function(data){
											var imported = $.parseJSON(data);
											$('#add-images').modal('hide');
											$("#browse-files").show();
											file_count_voteview = 0;
											file_complete_voteview = 0;
											permission_state_voteview = [ [] ];
											rate_info_voteview = [ [] ];
											is_rated_voteview = [];
											uploader_voteview.reset();
											window.open("?r="+imported.upload_id, "_self");
										}
									});
								}
							});
						}
					}
				},
				debug: true
			});

			$manual_uploader_guest = $("#browse-files-guest");
			var uploader_guest = new qq.FineUploaderBasic({
				button: $manual_uploader_guest[0],
				autoUpload: false,
				maxConnections: 1,
				listElement: $("#filelist-guest"),
				request: {
					endpoint: '?a=upload_image_guest',
					forceMultipart: true
				},
				validation: {
					sizeLimit: 5242880,
					minSizeLimit: 5120,
					allowedExtensions: ["jpg", "JPG", "jpeg", "png", "gif", "bmp"]
				},
				text: {
					cancelButton: 'cancel',
					failUpload: 'Upload failed'
				},
				callbacks: {
					onSubmit: function(id, fileName){
						if(file_count_guest >= 5){
							return false;
						} else {
						file_count_guest++;
						if(fileName.length > 35){
							fileName = (fileName.substring(0,35));
							$("#filelist-guest").append("<span id='listedfile"+id+"'><div><small>"+fileName+"...</small>&nbsp;&nbsp;<a href='#' id='removeListedFile-guest' data-fileid='"+id+"'>cancel</a></div></span>");
						} else {
							$("#filelist-guest").append("<span id='listedfile"+id+"'><div><small>"+fileName+"</small>&nbsp;&nbsp;<a href='#' id='removeListedFile-guest' data-fileid='"+id+"'>cancel</a></div></span>");
						}
						if(file_count_guest == 1){
							$("#close-upload-modal-guest").after("<a id='upload-images-guest' class='btn btn-success'><i class='icon-upload icon-white'></i>&nbsp;<strong> Start upload</strong></a>");
						}
						if(file_count_guest >= 5){
							$("#browse-files-guest").hide();
						}
						}
					},
					onUpload: function(id, fileName){
						$("#upload-images-guest").remove();
						$("#listedfile"+id+" a").replaceWith("<img id='loading-gif' src='assets/loading-fineuploader.gif' alt='Initializing. Pleasehold.' />");
					},
					onProgress: function(id, fileName, loaded, total){
						if(loaded < total){
							progress = Math.round(loaded / total * 100) + '% of ' + Math.round(total / 1024) + ' kB';
							$("#listedfile"+id+" img").append("&nbsp;"+progress);
						}
					},
					onCancel: function(id, fileName){
						file_count_guest--;
						$("#listedfile"+id).remove();
						if(file_count_guest == 0){
							$("#upload-images-guest").remove();
						}
						if(file_count_guest == 4){
							$("#browse-files-guest").show();
						}
					},
					onComplete: function(id, fileName, responseJSON) {
						file_complete_guest++;
						if(file_complete_guest == 1){
							$.ajax({
								type: 'POST',
								url: '?a=upload_id_session'
							});
						}
						$.ajax({
							type: 'POST',
							url: '?a=upload_add_guest_filename'
						});
						$("#listedfile"+id).remove();
						if(file_complete_guest == file_count_guest){
							$.ajax({
								type: 'POST',
								url: '?a=upload_done',
								success: function(data){
									var imported = $.parseJSON(data);
									$('#add-images-guest').modal('hide');
									$("#browse-files-guest").show();
									file_count_guest = 0;
									file_complete_guest = 0;
									uploader_guest.reset();
									window.open("?y="+imported.upload_id, "_self");
								}
							});
						}
					}
				},
				debug: true
			});
			
			$(document).on("keyup",".title-textarea",function(){
				var textarea_id = $(this).data("textarea_id");
				$("#title-textarea"+textarea_id).limit("120", "#title-counter"+textarea_id);
			});
			
			$(document).on("change","#voteit",function(){
				var voteit = $(this).data("voteit");
				if($(this).prop("checked")){
					$("#state-category").html("<strong><small>Category</small></strong");
					$("#subcategory").html("<strong><small>Subcategory</small></strong");
					$("#state-category"+voteit).children().remove();
					$("#state-category"+voteit).html(" \
						 <select id='image-category' name='category"+voteit+"' data-voteit='"+voteit+"'> \
						    	<option value='art'>Art</option> \
								<option value='awww'>Awww</option> \
								<option value='boy'>Boy</option> \
								<option value='funny'>Funny</option> \
								<option value='gaming'>Gaming</option> \
								<option value='gif'>Gif</option> \
								<option value='girl'>Girl</option> \
								<option value='meme'>Meme</option> \
								<option value='wtf'>WTF</option> \
								<option value='other'>Other</option> \
						     </select> \
						     ");
				     $("#subcategory"+voteit).html(" \
							<select id='image-subcategory' name='subcategory"+voteit+"'> \
								<option value='cgi'>CGI</option> \
								<option value='drawing'>Drawing</option> \
								<option value='painting'>Painting</option> \
								<option value='photography'>Photography</option> \
							</select> \
						");
				} else {
					$("#state-category").html("<strong><small>Image status</small></strong");
					$("#subcategory").html("");
					$("#subcategory"+voteit).children().remove();
					$("#state-category"+voteit).children().remove();
					$("#state-category"+voteit).append(
							"<select id='permission-level' name='state"+voteit+"'>\
								<option value='1'>Public</option>\
								<option value='2'>Friend</option>\
								<option value='3'>Private</option>\
							</select>"
						);
				}
			});
			
			$(document).on("change","#image-category",function(e){
				e.preventDefault();
				var voteit = $(this).data("voteit");
				var category = $(this).val();
				if(category == "art"){
					$("#subcategory"+voteit).html(" \
						<select id='image-subcategory' name='subcategory"+voteit+"'> \
							<option value='cgi'>CGI</option> \
							<option value='drawing'>Drawing</option> \
							<option value='painting'>Painting</option> \
							<option value='photography'>Photography</option> \
						</select> \
					");
				} else if(category == "meme"){
					$("#subcategory"+voteit).html(" \
						<select id='image-subcategory-meme' name='subcategory"+voteit+"' > \
							<option value='af'>Asian Father</option> \
							<option value='bd'>Butthurt Dweller</option> \
							<option value='cf'>College Freshman</option> \
							<option value='cw'>Condenscending Wonka</option> \
							<option value='fk'>Conspiracy Keanu</option> \
							<option value='fp'>Firstworld Problems</option> \
							<option value='fa'>Forever Alone</option> \
							<option value='fry'>Fry</option> \
							<option value='ggg'>Good Guy Greg</option> \
							<option value='lcs'>Lazy College Senior</option> \
							<option value='Morpheus'>Morphues</option> \
							<option value='pr'>Philosophoraptor</option> \
							<option value='sb'>Scumbag Brain</option> \
							<option value='ss'>Scumbag Steve</option> \
							<option value='sap'>Socially Awkward Penguin</option> \
							<option value='sm'>Suburban Mom</option> \
							<option value='sk'>Success kid</option> \
							<option value='sbm'>Successful Blackman</option> \
							<option value='ut'>Unhelpful teacher</option> \
							<option value='Other'>Other</option> \
						</select> \
					");
				} else {
					$("#subcategory"+voteit).html("");
				}
			});
			
			$(document).on("click","#removeListedFile",function(e){
				e.preventDefault();
				var id = $(this).data("fileid");
				uploader.cancel(id);;
			});
			
			$(document).on("click","#removeListedFile-guest",function(e){
				e.preventDefault();
				var id = $(this).data("fileid");
				uploader_guest.cancel(id);
			});
			
			$(document).on("click","#removeListedFile-voteview",function(e){
				e.preventDefault();
				var id = $(this).data("fileid");
				uploader_voteview.cancel(id);
			});
			
			$(document).on("click","#upload-images:not(.done)", function(e){
				e.preventDefault();
				uploader.uploadStoredFiles();
			});
			
			$(document).on("click","#upload-images-voteview:not(.done)", function(e){
				e.preventDefault();
				uploader_voteview.uploadStoredFiles();
			});
			
			$(document).on("click","#upload-images-guest:not(.done)", function(e){
				e.preventDefault();
				uploader_guest.uploadStoredFiles();
			});
			
			$("#sub-meme").hide();
			$(".image-title").limit("140", "#image-title-counter");
}); //end ready