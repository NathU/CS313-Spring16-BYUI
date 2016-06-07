
<?php
session_start();
// if we're somehow here without logging in, reroute and login
if (!isset($_SESSION['user_name'])) {
	$_SESSION['login_err'] = 'Incorrect username or password.';
	header('Location: tt_login.php');
	exit;
}
// upon successful login, load each pertinent data into a session variable
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

$query1 = 'SELECT id FROM users WHERE username = :user_name';
$statement = $db->prepare($query1);
$statement->bindValue(':user_name', $_SESSION['user_name']);
$statement->execute();
$response = $statement->fetch();
$statement->closeCursor();
$userID = $response['id'];

/*
//'<tr>  <td>Date</td>  <td>Ordinance</td>  <td>Quantity</td>  <td>Note</td>  </tr>'
$visits = "";
foreach ( $db->query("SELECT * FROM visits WHERE contributor = $userID") as $row) {
	if (is_array($row)) {
		$visits .= "\<tr\>  \<td\>".$row['visit_date']."\</td\>  \<td\>".$row['ordinance']."\</td\>  \<td\>".$row['quantity']."\</td\> ";
		if ( isset($row['note']) && $row['note'] != "") {
			//$note = str_replace("\"", "_", $row['note']);
			$visits .= " \<td\>".$row['note']."\</td\>  ";
		}
		$visits .= "\</tr\>";
	} else 
		$_SESSION['user_visits'] = $row;
}
$_SESSION['user_visits'] = $visits;
*/


//$visits_JSON = "\"visits\":[";
$visits_JSON = '{ "visits" : [';
$i = 0;
//foreach ( $db->query("SELECT * FROM user_to_visit JOIN visits ON (user_to_visit.visit_id = visits.id) WHERE user_to_visit.user_id = $userID") as $row) {
foreach ( $db->query("SELECT * FROM visits WHERE contributor = $userID") as $row) {
	if (is_array($row)) {
		if ($i > 0) 
			$visits_JSON .= ', '; 
		$visits_JSON .= ' { "id" : "'.$row['id'].'", "ordinance" : "'.$row['ordinance'].'", "date" : "'.$row['visit_date'].'", "quantity" : '.$row['quantity'];
		if ( isset($row['note']) && $row['note'] != "") {
			// find and replace ""s with ''s...
			$note = str_replace("\"", "_", $row['note']);
			$visits_JSON .= ', "note" : "'.$note.'"';
		}
		$visits_JSON .= ' }';
	} else 
		$_SESSION['user_visits'] = $row;
	$i += 1;
}
$visits_JSON .= ']}';
$_SESSION['user_visits'] = $visits_JSON;

// then redirect to home
header('Location: tt_home.php');
exit;
?>








