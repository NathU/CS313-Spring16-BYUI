
<?php
session_start();
require 'tt_DB_connector.php';
try
{
	$db = loadDatabase(); 
}
catch (PDOException $ex)
{
    echo "Error!: " . $ex->getMessage();
    die();
}

$ord = filter_input(INPUT_POST, 'ordinance');
$qty = filter_input(INPUT_POST, 'headCount');
$date = filter_input(INPUT_POST, 'date');
$note = filter_input(INPUT_POST, 'note');

// get userID
$query1 = 'SELECT id FROM users WHERE username = :user_name';
$getID = $db->prepare($query1);
$getID->bindValue(':user_name', $_SESSION['user_name']);
$getID->execute();
$response1 = $getID->fetch();
$getID->closeCursor();
$userID = $response1['id'];

// insert new visit
$query2 = 'INSERT INTO visits (contributor, ordinance, visit_date, quantity, note) VALUES (:userID, :ord, :date, :qty, :note)';
$insertVisit = $db->prepare($query2);
$insertVisit->bindValue(':userID', $userID);
$insertVisit->bindValue(':ord', $ord);
$insertVisit->bindValue(':date', $date);
$insertVisit->bindValue(':qty', $qty);
if ( isset($note) && $note != "")
	$insertVisit->bindValue(':note', $note);
else
	$insertVisit->bindValue(':note', "");
$insertVisit->execute();
$response2 = $insertVisit->fetch();
$insertVisit->closeCursor();
//$visitID = $response2['id']; //???

// get visitID
$query3 = 'SELECT id FROM visits WHERE contributor = :user_name';
$getVID = $db->prepare($query3);
$getVID->bindValue(':userID', $userID);
$getVID->execute();
$response3 = $getVID->fetch();
$getVID->closeCursor();
$visitID = $response3['id'];

// insert new userID, visitID pair
$query4 = 'INSERT INTO user_to_visit (user_id, visit_id) VALUES (:userID, :visitID)';
$insertU2V = $db->prepare($query4);
$insertU2V->bindValue(':userID', $userID);
$insertU2V->bindValue(':visitID', $visitID);
$insertU2V->execute();
$insertU2V->closeCursor();

// refresh visit data by reloading home... later we'll implement AJAXness to do that...
header('Location: tt_login_successful.php');
exit;
?>
