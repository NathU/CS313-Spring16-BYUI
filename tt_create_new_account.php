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

$_SESSION['register_err'] = null;
$redirect_destination = "Location: tt_register.php";
$action = filter_input(INPUT_POST, 'action');

if ($action != NULL && $action != "") {
	// store POST data...
	require 'password.php';
	$user = filter_input(INPUT_POST, 'user');
	$password = filter_input(INPUT_POST, 'password');
	$hash = password_hash($password, PASSWORD_DEFAULT);

	// check username is not already in DB
	$query = "SELECT username FROM users WHERE username = :user";
	$statement = $db->prepare($query);
	$statement->bindValue(':user', $user);
	$statement->execute();
	$response = $statement->fetch();

	if ( strcmp($response['username'], $user) == 0) {
		$_SESSION['register_err'] = "Please choose a different username.";
	} else {
		// we're good
		$query = "INSERT INTO users (username, pass) VALUES (:user, :hash)";
		$statement = $db->prepare($query);
		$statement->bindValue(':user', $user);
		$statement->bindValue(':hash', $hash);
		$statement->execute();
		
		$_SESSION["user_name"] = $user;
		$redirect_destination = "Location: tt_login_successful.php";
	}
	
}
header($redirect_destination);
?>