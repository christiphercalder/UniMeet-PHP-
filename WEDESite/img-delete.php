<?php
session_start();
require_once 'inc/constants.php';
require_once 'inc/db.php';
require_once 'inc/functions.php';
echo "You've reached the delete image page";
/*Redirect for unauthorized action*/
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
	header("Location: user-login.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	// $path = IMAGE_FOLDER . "arthur631/arthur631-20.jpg";
	// dump($path);
	foreach ($_POST['images'] as $key => $value) {
		$path = IMAGE_FOLDER . $value;
		if (file_exists($path)) {
			echo "<br>File Exists - " . $path;
			unlink($path);
			$auth = TRUE;
		}else{
			echo "<br>File Not Found - " . $path;
			$_SESSION['info_message'] = "Sorry couldn't delete your image(s), please try again.";
			$_SESSION['requested_action'] = "error";
		}
	}
	if ($auth == TRUE) {
		$_SESSION['info_message'] = "Images Deleted.";
		$_SESSION['requested_action'] = "success";
	}
	//The last action to be executed will be the redirect back to profile-images.php
	$directory = IMAGE_FOLDER . $_SESSION['user_id'];
	dump(count(scanUserDirectory($directory)));
	if (count(scanUserDirectory($directory)) == 0) {
		// echo count(scanUserDirectory($directory));		
		recursiveDelete($directory);
		updateImageCount(0, $_SESSION['user_id']);
	}
	header("Location: profile-images.php");
}
?>