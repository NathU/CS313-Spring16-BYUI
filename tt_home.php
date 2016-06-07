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
		<link rel="stylesheet" href="./resources/CalendarView-master/stylesheets/calendarview.css">
		<link rel="stylesheet" href="./resources/styles/tt_styles.css">

		<script src="./resources/CalendarView-master/javascripts/prototype.js"></script>
		<script src="./resources/CalendarView-master/javascripts/calendarview.js"></script>
		<script src="./resources/scripts/tt_scripts.js"></script>
		<script type="text/javascript"> 
			
			function setupCalendars() {
				Calendar.setup(
				{
					dateField: 'summaryDate',
					triggerElement: 'summaryDate',
					viewLocation: 'add_note_button'
				})
			}

		</script>
    </head>
    <body onload="setupCalendars()">
        <div id="content">
			<div id="male" class="personButton" onclick="personButtonClick('male')"> </div>
			<div id="female" class="personButton" onclick="personButtonClick('female')"> </div>
			<div id="whoIsDead" > </div>
			
			<div id="sidebar" style="width: 0px">
				<div id="menu_button" onclick="menuClick()"> </div> 
				<div class="tab_container">
					
					<h1><?php echo $_SESSION['user_name']; ?></h1>
					
					<a href="./tt_view_visitLog.php"><div class="_tab"> <h2>My Visits</h2> </div></a>
					
					<a href="./tt_logout.php"><div type="submit" class="_tab"> <h2>Log Out</h2> </div></a>
					
				</div>
			</div>
			
			<div id="tinting" onclick="menuClick()"> </div> 
			
			<div id="visit_dialogue" class="dialogue">
				
				<h3 class="dialogue_header">Log a Temple Visit</h3>
				
				<div id="ordinance_container"> 
					<div class="ord_cont"> <img id="B-image" src="./resources/images/ordinances/waves.png" height="64" width="64" onclick="picClick('B')"></div>
					<div class="ord_cont"> <img id="C-image" src="./resources/images/ordinances/flame.png"  height="64" width="64" onclick="picClick('C')"></div>
					<div class="ord_cont"> <img id="W-image" src="./resources/images/ordinances/oil.png" height="64" width="64" onclick="picClick('W')"></div>
					<div class="ord_cont"> <img id="E-image" src="./resources/images/ordinances/altar.png" height="64" width="64" onclick="picClick('E')"></div>
					<div class="ord_cont"> <img id="SC-image" src="./resources/images/ordinances/child_parent4.png"  height="64" width="64" onclick="picClick('SC')"></div>
					<div class="ord_cont"> <img id="SS-image" src="./resources/images/ordinances/wedding1.png" height="64" width="64" onclick="picClick('SS')"></div>
				</div>
				
				<form method="post" action="tt_new_visit.php">
				<div id="ordinances" style="visibility: hidden; position: absolute;">
					<input type="radio" id="B" name="ordinance" value="Baptism">
					<input type="radio" id="C" name="ordinance" value="Confirmation">
					<input type="radio" id="W" name="ordinance" value="Initiatory">
					<input type="radio" id="E" name="ordinance" value="Endowment">
					<input type="radio" id="SC" name="ordinance" value="Child's Sealing">
					<input type="radio" id="SS" name="ordinance" value="Spousal Sealing">
				</div>
				
				<div id="headCount_container"> 
					X<input id ="headCount" type="number" name="headCount" min="1" max="15" value="1" onclick="setHeadCount()">
				</div>
				
				<div id="visit_summary"> 
					<div id="summaryText" class="visit_info"></div>
					<div id="summaryDate" class="visit_info" onchange="update_date()"></div> <!-- do not add an onclick listener for this element! -->
				</div> 
				
				<input type="text" id="date_container" name="date" style="visibility: hidden; position: absolute;"></input>
				
				<div id="add_note_button" class="tt_button" onclick="addNoteClick()">Add a note</div>
				<textarea id="note" name="note" placeholder="optional: enter any notes about your visit" rows="4" cols="82"></textarea> 
				
				<div id="clear_button" class="tt_button" onclick="resetForm()">Cancel</div>
				
				
					<input type="submit" id="logit_button" class="tt_button" name="submit" value="Log this Visit"></input> 
				</form>
			</div>
		</div>
		
		<div id="visit_data" style="visibility:hidden;"> <?php echo $_SESSION['user_visits']; ?> </div> 
		
    </body>
</html>





























