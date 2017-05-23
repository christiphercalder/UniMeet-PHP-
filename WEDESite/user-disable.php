<?php
session_start();
require_once('inc/constants.php');
require_once('inc/functions.php');
require_once('inc/db.php');
if (isset($_GET['user_id']) && $_SESSION['user_type'] == ADMIN_USER) {
	setUserType($_GET['user_id'], DISABLED_USER);
	updateOffensiveStatus(RESOLVED, $_GET['user_id']);
	$user = $_GET['user_id'];
	header("Location: profile-display.php?user_id=$user");
}else{
	header("Location: user-login.php");
}
?>