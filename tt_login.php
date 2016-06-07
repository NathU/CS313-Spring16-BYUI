<?php
session_start();
/*
if (session_status() == PHP_SESSION_NONE) {
   session_start();
   $_SESSION['user_name'] = null;
   $_SESSION['login_err'] = "initial value...";
   $_SESSION['register_err'] = null;
   $_SESSION['user_visits'] = null;
} else {
	session_start(); // resume previous session
}*/
if (isset($_SESSION['user_name'])) {
   header('Location: tt_login_successful.php');
   exit();
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Temple Tracker</title>
		<link rel="stylesheet" href="./resources/styles/tt_styles.css">
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Nunito" />
		<script src="./resources/scripts/tt_scripts.js"></script>
		
    </head>
    <body onload="setBackgroundImage_login()">
        <div id="content">
			
			<div id="login_dialogue" class="dialogue"> 
				
				<div class="h_tabContainer"> 
					<form method="post" action="tt_authenticate_login.php">
					<input type="hidden" name="action" value="login"></input>
					<div id="login_input_container" class="h_tab"> 
						
							<br> <br>
							<h3> username:
							<input name="username" class="tt_input"></input> </h3>
							<h3> password:
							<input type="password" name="password" class="tt_input"></input> </h3>
						
					</div>
					
					<div id="login_decor" class="h_tab"> 
						<div style="z-index: 1;height:50%;background-image:url('./resources/images/decoration/vine02.png');background-repeat:no-repeat;background-position: center bottom;">  </div>
						<div style="z-index: 1;height:50%;background-image:url('./resources/images/decoration/vine02b.png');background-repeat:no-repeat;background-position: center top;">  </div>
					</div>
					
					<div id="login_button_container" class="h_tab"> 
						<input type="submit" id="login_button" class="tt_button" name="submit" value="Sign In"> 
					</form>
						<div id="or"> - or - </div>
						<form method="post" action="tt_register.php">
							<input type="submit" id="login2register_button" class="tt_button" name="submit" value="create a new account">
						</form>
					</div>
					
				</div>
				
				<div id="login_err_msg"> 
					<?php 
					if (isset($_SESSION['login_err'])) {
						echo $_SESSION['login_err'];
					} else {
						echo (" ");
					}?>
				</div>
				
			</div>
			
		</div>
    </body>
</html>