<?php 
require_once('inc/header.php'); 
unset($errorMessage);
//Checks if request method was POST and if TRUE begins input sanitation and validation process
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //Sanitize User submissions, removing any possible script injection and assigning each to a variable
 	$userName = pg_escape_string($conn, sanitize($_POST["user_id"]));
 	$userPass = pg_escape_string($conn, sanitize($_POST["password"]));
 	//Hash the password
 	$userPass = md5($userPass);
 	// Prepare query for execution
	$result = pg_prepare($conn, "login_query", 'SELECT * FROM users WHERE user_id = $1 AND password = $2');
	$result = pg_execute($conn, "login_query", array($userName, $userPass));	
	$rows = pg_num_rows($result);	
	
	if ($rows == 1) {
		//collect user data from users table
		$_SESSION = pg_fetch_assoc($result);
		$_SESSION['view_user_id'] = $_SESSION['user_id'];
		//Set cookie for user id expires after 30 days
		setcookie("user_id", $_SESSION['user_id'], COOKIE_EXPIRE);

		if ($_SESSION['user_type'] == DISABLED_USER) {
				header("Location: legal-aup.php");
		}elseif($_SESSION['user_type'] == COMPLETE_USER){
			//collecting user data for SESSION
			$result = pg_prepare($conn, "profile_query", "SELECT * FROM profiles WHERE user_id = $1");
			$result = pg_execute($conn, "profile_query", array($userName));
			$profile = pg_fetch_assoc($result);
			//Removing duplicate user_id key from Array
			$a = array_shift($profile);
			unset($a);								
			$_SESSION = array_merge($_SESSION, $profile);	
			//updating last access time
			lastAccess();
			header("Location: user-dashboard.php");				
		}elseif($_SESSION['user_type'] == ADMIN_USER){			
			//updating last access time
			lastAccess();
			header("Location: admin-dashboard.php");		 
		}else{
			header("Location: user-dashboard.php");
		}				
	}
	else{		
		$errorMessage = "Sorry you have entered an incorrect username and password combination";
	}
	
}
?>				
		<section class="download-now">				
		  <div class="row">
		    <div class="col-md-8 wp1">
		      <h1>
		      Log In
		      </h1>
		      <form class="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" role="form">
		        <div class="form-group">	
		        	<?php echo userLogin(); ?>		        		        	
		          <!-- Error Message Display -->
		        	<?php 
		        		if (isset($errorMessage)) {
		        			echo '<div class="output-box-normal text-center"><p>' . $errorMessage .'</p></div>';
		        		}
		        	?>		
		          <input class="login-btn" type="submit" value="Log In"/>
		        </div>
		      </form>              
		    </div>
		  </div>				
		</section>
			
<?php
require_once('inc/footer.php'); 
?>