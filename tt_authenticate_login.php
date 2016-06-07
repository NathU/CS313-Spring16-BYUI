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

require 'password.php';
$redirect_dest = "Location: tt_login.php";
$user_name = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');

if ($user_name != NULL && $user_name != "" && $password != NULL && $password != "") {
	$query = 'SELECT pass FROM users WHERE username = :user_name';
	$statement = $db->prepare($query);
	$statement->bindValue(':user_name', $user_name);
	$statement->execute();
	$response = $statement->fetch();
	$statement->closeCursor();
	$passwordHash = $response['pass'];

	// response should only be NULL if user_name doesn't exist in DB
	if ($response != NULL && $response != "" && (password_verify($password, $passwordHash))) {
		$_SESSION['user_name'] = $user_name;
		$redirect_dest = "Location: tt_login_successful.php";
	} else {
		$_SESSION['login_err'] = 'Incorrect username or password.';
	}
} else {
	$_SESSION['login_err'] = 'Incorrect username or password.';
}

header($redirect_dest);

?>