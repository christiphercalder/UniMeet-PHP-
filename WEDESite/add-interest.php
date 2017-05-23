<?php 
session_start();
require_once('inc/constants.php');
require_once('inc/functions.php');
require_once('inc/db.php');
// echo "ADD Interest " . $_GET['user_id'];

$x = addInterest($_SESSION['user_id'], $_GET['user_id']);
if ($x == FALSE) {
	$_SESSION['info_message'] = "Sorry, we were unable to perform the last action";
	$_SESSION['requested_action'] = "error"; 
	header("Location: interests.php");
}else{
	$_SESSION['info_message'] = "You are now inerested in that profile";
	$_SESSION['requested_action'] = "success"; 
	header("Location: interests.php");
}


?>