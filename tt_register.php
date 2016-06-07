<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Temple Tracker</title>
		<link rel="stylesheet" href="./resources/styles/tt_styles.css">
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Nunito" />
		<script src="./resources/scripts/tt_scripts.js"></script>
		
    </head>
    <body onload="setBackgroundImage_register()">
        <div id="content">
			
			<div id="register_dialogue" class="dialogue"> 
				<div class="dialogue_header"><h3>Create your new Temple Tracker account</h3></div>
				
				<div class="h_tabContainer"> 
					<form method="post" action="tt_create_new_account.php">
					<input type="hidden" name="action" value="register">
					
					<div id="register_input_container" class="h_tab"> 
						
						<br> 
						<h3> username:
						<input class="tt_input" id="user_input" type="text" name="user" onkeypress="checkReturn(event)" onfocus="enableSubmit()"></input> </h3>
						
						<h3> password:
						<div id="p1div" class="ast"> </div> <input class="tt_input" id="pass_input1" type="password" name="password" onkeypress="checkReturn(event)" onfocus="enableSubmit()"></input>  </h3>
						
						<h3> confirm password:
						<div id="p2div" class="ast"> </div> <input class="tt_input" id="pass_input2" type="password" onkeypress="checkReturn(event)" onfocus="enableSubmit()"></input> </h3>
						
					</div>
					
					<div id="reg_button_container" class="h_tab"> 
						<input id="create_account_button" class="tt_button" type="submit" name="submit" value="Create Account" onmousedown="beforeYouClick()">
					</div>
					
					</form>
					
				</div>
				
				<div id="login_err_msg" >
					<div id="err_msg1" style="color:black; font-size:18px;"> 
					<?php 
						session_start();
						if( isset($_SESSION['register_err']) ) echo $_SESSION['register_err']."<br>"; ?></div>
				</div>
				
			</div>
			
		</div>
    </body>
</html>