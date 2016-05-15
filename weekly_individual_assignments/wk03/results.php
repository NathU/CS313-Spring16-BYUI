<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Week 03</title>
		<link rel="stylesheet" href="./resources/week03styles.css">
		<style>

		</style>
    </head>
    <body>
        <?php		
		// Gather submission input values
		$submission = array(
			"date" => $_POST['date'],
			"ordinance" => $_POST['ordinance'],
			"headCount" => $_POST['headCount'],
			"note" => $_POST['note']
		);
		if ($submission["date"] == "") {
			$auto_date = date("m/d/y");
			//echo "<small> date not selected. <br>assigning auto_date of " . $auto_date . "</small>";
			$submission["date"] = $auto_date;
		}
		$submission["note"] = str_replace(",", "`COMMA`", $submission["note"]);
		$entry = implode(",",$submission);
		
		// Validate submission input values
		
		// write new values to resource file
		$filename = "./resources/all_visits.txt";
		if ($_POST['submit'] == "Log It!") {
			$writefile = fopen( $filename, "a+" );
			   
			if( $writefile == false ) {
				echo ( "<p style=\"color: red;\">Error in opening all_visits.txt...</p>" );
				exit();
			}
				// don't mess with the FRWITE statement below... 
				// its the only way I've found i can put newlines in a file... >:|
			fwrite( $writefile,
''.$entry.'
' );
			fclose( $writefile );
		}
		
		// open resource file and generate results...
        $file = fopen( $filename, "r" );
         
        if( $file == false ) {
           echo ( "Error in opening file" );
           exit();
        }
         
        $filesize = filesize( $filename );
        $filetext = fread( $file, $filesize );
        fclose( $file );
		
		$totalB = 0;
		$totalC = 0;
		$totalW = 0;
		$totalE = 0;
		$totalSC = 0;
		$totalSS= 0;
		
		$all_visits = explode("\n", $filetext);
		for ($x = 0; $x < count($all_visits); $x++) {
			//$all_visits[$x] = explode(",", $all_visits[$x]);
			//$row = array('date','ordinance','quantity'); // testing
			$row = explode(",", $all_visits[$x]); // testing
			$all_visits[$x] = $row;
		}
		for ($x = 0; $x < count($all_visits); $x++) {
			switch ($all_visits[$x][1]) {
				case"Baptism":
					$totalB += $all_visits[$x][2];
					break;
				case"Confirmation":
					$totalC += $all_visits[$x][2];
					break;
				case"Washing & Anointing":
					$totalW += $all_visits[$x][2];
					break;
				case"Endowment":
					$totalE += $all_visits[$x][2];
					break;
				case"Child's Sealing":
					$totalSC += $all_visits[$x][2];;
					break;
				case"Spousal Sealing":
					$totalSS += $all_visits[$x][2];
					break;
			}
		}
		?>
		
		<div id="results_stats" class="report_module" style="font-weight: bold;">
			<div style="text-align: center; font-weight: bold;"><h2>Totals</h2></div>
			<?php 
			
			$sum = $totalB+$totalC+$totalW+$totalE+$totalSC+$totalSS;
			$B = $totalB / $sum * 100;
			$C = $totalC / $sum * 100;
			$W = $totalW / $sum * 100;
			$E = $totalE / $sum * 100;
			$SC = $totalSC / $sum * 100;
			$SS = $totalSS / $sum * 100;
			
			echo "Baptisms<br><div class=\"graphbar\" style=\"width: ".$B."%;background-color: #236bb2;\">".$totalB."</div>";
			echo "Confirmations<br><div class=\"graphbar\" style=\"width: ".$C."%;background-color: #ff471a;\">".$totalC."</div>";
			echo "Washings & Anointings<br><div class=\"graphbar\" style=\"width: ".$W."%;background-color: #b2236b;\">".$totalW."</div>";
			echo "Endowments<br><div class=\"graphbar\" style=\"width: ".$E."%;background-color: #24b223;\">".$totalE."</div>";
			echo "Child's Sealings<br><div class=\"graphbar\" style=\"width: ".$SC."%;background-color: #cca300;\">".$totalSC."</div>";
			echo "Spousal Sealings<br><div class=\"graphbar\" style=\"width: ".$SS."%;background-color: #6a23b2;\">".$totalSS."</div>";
			echo "<br><small>total ordinances: </small>".$sum."";
			?>
		</div>
		
		<div id="results_table" class="report_module">
			<div style="text-align: center;"><h2>Your Visit Log</h2></div>
			<table >
			<tr> <th>Date</th> <th>Ordinance Performed</th> <th>Quantity</th> </tr>
			<?php
			for ($x = 0; $x < count($all_visits); $x++) {
				echo "<tr> <td>".$all_visits[$x][0]."</td> <td>".$all_visits[$x][1]."</td> <td>".$all_visits[$x][2]."</td> </tr>";
			}
			
			?>
			</table>
		</div>
		
		
    </body>
</html>



















