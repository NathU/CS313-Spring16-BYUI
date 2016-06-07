<?php
session_start();

if (!isset($_SESSION['user_name'])) {
   header('Location: tt_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Temple Tracker</title>
		
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Nunito" />
		<link rel="stylesheet" href="./resources/styles/tt_styles.css">

		<script src="./resources/scripts/tt_scripts.js"></script>

    </head>
    <body onload="logView_onload()">
        <div id="content">
			
			<div id="sidebar" style="width: 0px">
				<div id="menu_button" onclick="menuClick()"> </div> 
				<div class="tab_container">
					
					<h1><?php echo $_SESSION['user_name']; ?></h1>
					
					<a href="./tt_login_successful.php"><div class="_tab"> <h2>Log a New Visit</h2> </div></a>
					
					<a href="./tt_logout.php"><div type="submit" class="_tab"> <h2>Log Out</h2> </div></a>
				</div>
			</div>
			
			<div id="tinting" onclick="menuClick()"> </div> 
			
			<div id="logView_tab_container" > 
				<div id="summary_tab" class="logView_tab" onclick="showLogActivity('summary')"> Summary </div> 
				<div id="log_tab" class="logView_tab" onclick="showLogActivity('log')"> Log </div> 
				<div id="stats_tab" class="logView_tab" onclick="showLogActivity('stats')"> ... </div> 
			</div> 

			<div id="logView_body_container">
			
			<div id="note_pop-up_container" > 
				<div id="note_pop-up"> 
					<textarea id="noteView" rows="4" cols="50"></textarea>
					<input id="close_noteView" type="button" value="OK" onclick="noteView_popup()"> </input>
				</div> 
			</div> 
			
			<div id="summary_body" class="logView_body" > </div> 
			<div id="log_body" class="logView_body" > </div> 
			<div id="stats_body" class="logView_body" > <br><br> ... sorry, still working on this. 
			<br> <h3> TODOs:</h3> 
			<ul>
			<li> implement groups (stake, ward, family, etc.)</li>
			<li> sortability for log page (sort by date, qty, ord a-z, etc.)</li>
			<li> animations and improved graphics</li>
			</ul>
			</div> 
			<!-- <img src="./resources/images/bebe.jpg" alt="sad..." height="550" width="366"> -->
			</div> 

		</div>
		
		<div id="visit_data" style="visibility:hidden;"> <?php echo $_SESSION['user_visits']; ?> </div>
		
    </body>
</html>





























