<?php

require_once('inc/header.php');
checkLoginStatus();
$message = "";
if ($_SERVER['REQUEST_METHOD']=="POST") {
	arraySanitize($_POST);
	$validated = false;
	if ($_POST['password'] != $_POST['confirm_password']){
		$validated=false;
	} else {
		$stmt1 = pg_prepare($conn, "user_password_confirm", 'SELECT * FROM users WHERE user_id = $1 AND password = $2');
		$result = pg_execute($conn, "user_password_confirm", array($_SESSION['user_id'],md5($_POST['password'])));
		$rows = pg_num_rows($result);
		if ($rows==1){
			$message = strlen($_POST['new_password']);
			if (strlen($_POST['new_password'])>=6){
				$validated=true;
				$message .= " true";
			} else {
				$validated=false;
				$message .= " false";
			}
		} else {
			$validated = false;
		}
	}
	$message .= " ";
	$message .= $validated;
	if ($validated==true){
		updatePassword(md5($_POST['new_password']), $_SESSION['user_id']);
	}
}
?>

<section class="content">				
<div class="row">
	<?php include_once ('inc/side-nav.php'); ?>
		<div class="col-xs-12 col-sm-8 col-md-9 content wp1">
			<h1>
				Update your password
			</h1>
			<?php //echo $message ?>
			<form class="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" role="form">
				<div class="col-md-6 form-group">
					<input class='password form-control' type='password' name='password' placeholder='Enter your password' required>
					<input class='password form-control' type='password' name='confirm_password' placeholder='Confirm your password' required><br/>
					<input class='password form-control' type='password' name='new_password' placeholder='Enter your new password' required>
				</div>
				
				<div class="col-xs-12 col-sm-12 form-group">
				<input class="login-btn" type="submit" value="Change Password">
				</div>  
			</form>
		</div>
	</div>        
</section>

<?php
if(isset($_POST) && isset($validated) == true){
$output="<script>
	toastr.options.closeButton = true;
	toastr.options.positionClass = 'toast-screen-center';
	toastr.options.timeOut = 0;
	toastr.options.extendedTimeOut = 0;
	toastr.success(\"Password successfully changed!\")
</script>";
echo $output;
}
?>
			
<?php include_once('inc/footer.php'); ?>