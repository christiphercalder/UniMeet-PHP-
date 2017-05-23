<?php
session_start();
require_once 'inc/constants.php';
require_once 'inc/db.php';
require_once 'inc/functions.php';
echo "You've reached the profile image update page";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	dump($_POST);
	if (count($_POST['images']) > 1) {
		$_SESSION['info_message'] = "Sorry please select only one image.";
		$_SESSION['requested_action'] = "error";		
		header("Location: profile-images.php");
	}else{
		$image = strstr($_POST['images'][0], "-");
		$image = trim($image,".jpg");
		$image = trim($image, "-");
		dump($image);		
		updateProfileImage($image);
		// die;
		$_SESSION['profile_image'] = $image;
		$_SESSION['info_message'] = "Profile Image Updated.";
		$_SESSION['requested_action'] = "success";
		header("Location: profile-images.php");
	}
	
	
}


//The last action to be executed will be the redirect back to profile-images.php

// header("Location: profile-images.php");
?>