<?php 
session_start();
require_once('inc/constants.php');
require_once('inc/functions.php');
require_once('inc/db.php');
// echo "Remove Interest for " . $_GET['user_id'];

$x = removeInterest($_SESSION['user_id'], $_GET['user_id']);
// dump($x);
// die;
if ($x == 0) {
	echo $_SESSION['info_message'] = "Sorry, we were unable to perform the last action";
	$_SESSION['requested_action'] = "error"; 
	header("Location: interests.php");
}elseif($x == 1){
	echo $_SESSION['info_message'] = "You are no longer inerested in that profile";
	$_SESSION['requested_action'] = "success"; 
	header("Location: interests.php");
}
?>