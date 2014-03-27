<?php
	include_once 'utility/main.php';
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <html lang="en">

	<head>
	<link href="assets/bootstrap.css" rel="stylesheet">
	<link href="assets/homecooked.css" rel="stylesheet">
	<link href="assets/jquery.nailthumb.1.1.css" type="text/css" rel="stylesheet">
	<link href="assets/showLoading.css" type="text/css" rel="stylesheet">
	<link href="assets/fineuploader.css" type="text/css" rel="stylesheet">
	<?php if($profile_messages){?>
	<script src="assets/jquery-1.8.2.min.js" type="text/javascript"></script>
	<script src="assets/limit.js" type="text/javascript"></script>
	<?php }?>
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    
	</head>
	
	<body>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<?php if(!isset($_SESSION['user_id'])){?>
	<span class="js-loggedin" id="no"></span>
     <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <span class="brand">doostr</span>
          <div class="nav-collapse collapse" id="image-large-view">
            <ul class="nav">
        	   <li><div href="doostr.com" class="fb-like display-inline-block" data-send="false" data-width="90" data-show-faces="false" data-layout="button_count" data-action="like" ></div></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <?php } else {?>
    <span class="js-loggedin" id="yes"></span>
     <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <span class="brand">doostr</span>
          <div class="nav-collapse collapse" id="image-large-view">
            <ul class="nav">
        	      <li><div href="doostr.com" class="fb-like display-inline-block" data-send="false" data-width="90" data-show-faces="false" data-layout="button_count" data-action="like" ></div></li>
             </ul>
             
             <ul class="nav pull-right">
            
             <span id="insert-friend-indicator">
          		
          			<?php  if(empty($new_friend[0])){
          				
          				} else { ?> 

          					<strong><small id="number-friends"><?php echo $new_friend[0]; ?></small></strong>&nbsp<a href=<?php if($_SESSION['current_view'] == 1){?>"#"<?php } else {?>"?a=profilef"<?php }?><?php if($_SESSION['current_view'] == 1){ ?> class="goto-friends"<?php } ?>><i class="icon-user icon-white"></i></a>
          					
          			<?php }?>
          			
          		
          	</span>
            
            <span id="insert-message-indicator">
            
          			<?php if(empty($new_messages[0])){
          				
          			 } else {?>
          			

          				<strong><small id="number-messages"><?php echo $new_messages[0];?></small></strong>&nbsp<a href=<?php if($_SESSION['current_view'] == 1){?>"#"<?php } else {?>"?a=profilem"<?php }?><?php if($_SESSION['current_view'] == 1){ ?> class="goto-messages"<?php } ?>><i class="icon-envelope icon-white"></i></a>
          				
          			<?php }?>
          			
          	</span>
					
					
          		  	<a class="btn btn-small btn-info" id="header-profile-button" href="?a=profile">&nbsp;<strong><?php echo $_SESSION['username']; ?></strong></a>
           			<a class="btn btn-info" id="logout-button" href="?a=logout"><i class="icon-off icon-white"></i></a>
           			 
            </ul>
         	 </div><!--/.nav-collapse -->
       	 </div>
      </div>
    </div>
   	<?php }?>
    <div class="container">