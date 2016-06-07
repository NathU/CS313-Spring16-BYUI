
<?php 
session_start();
$status = session_status();
if (isset($_SESSION['user_name'])) {
	$_SESSION = array();
	session_destroy();
}

header('Location: tt_login.php');
exit();
?>