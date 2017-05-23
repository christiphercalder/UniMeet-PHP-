<?php 
session_start();
require_once('inc/constants.php');
require_once('inc/functions.php');
require_once('inc/db.php');
date_default_timezone_set('America/Toronto');
if (isset($_GET['user_id']) && isset($_SESSION['user_id'])) {
	$time = date('M j \, Y h:i a ');
	$flagged_user = $_GET['user_id'];
	$user = $_SESSION['user_id'];
	// echo "Issuing User: " . $user;
	// echo "<br>Flagged User: " . $flagged_user;
	// echo "<br>Time: " . $time;
	flagUser($user, $flagged_user, $time);
	// $check = checkOffensives($flagged_user, "incomplete");
	// echo "<br>Check: " . $check;
	// header("Location: profile-search-results.php");
	header("Location: profile-display.php?user_id=$flagged_user");
}else{
	header("Location: user-login.php");
}


?>