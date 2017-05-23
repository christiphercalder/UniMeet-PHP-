<?php
ob_start();
date_default_timezone_set('America/Toronto');
$now = time();
if (isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) {
    // kill session and start a brand new one
    session_unset();
    session_destroy();    
}

// Session is destroyed after 30 mins 
$_SESSION['discard_after'] = $now + 1800;
if (session_id() == "") {
  session_start();
}  

require_once('inc/constants.php');
require_once('inc/functions.php');
require_once('inc/db.php');
$disabled = $disabledTypei = "";
$hidden = "hidden"; // for logged in users
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_type']) || $_SESSION['user_type'] == DISABLED_USER) {
  $disabled = "hidden";
  $hidden = ""; // for non-logged in users
  $editProfile = "Create Profile";
  $contentHeader = "Create";
}elseif ((isset($_SESSION['user_type'])) && $_SESSION['user_type'] == INCOMPLETE_USER) {
  $disabledTypei = "disabled";
  $editProfile = "Create Profile";
  $contentHeader = "Create";
}else{
  $editProfile = "Edit Profile";
  $contentHeader = "Edit";
}
if ((isset($_SESSION['user_type'])) && $_SESSION['user_type'] == ADMIN_USER){
  $dashboard = "admin-dashboard.php";
}else{
  $dashboard = "user-dashboard.php";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />    
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title><?php echo BRAND_NAME; ?></title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/flexslider.css" type="text/css"/>
    <link href="css/styles.css?v=1.6" rel="stylesheet"/>
    <link href="css/queries.css?v=1.6" rel="stylesheet"/>
    <link href="css/jquery.fancybox.css" rel="stylesheet"/>
    <link href="css/main.css" rel="stylesheet"/>    
    <link href="css/toastr.min.css" rel="stylesheet"/>
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'/>
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <script type="text/javascript" src="js/jquery-2.1.4.js"></script>  
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/toastr.min.js"></script>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">            
        <!-- <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2"> -->            
          <nav class="navbar navbar-collapse navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-brand">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <div class="navbar-brand"><a class="brand" href="index.php"><?php echo BRAND_NAME; ?></a></div>
              </div>
              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="navbar-brand">
                <ul class="nav nav-tabs navbar-right">
                  <li class=""><a href="index.php">Home</a></li>
                  <li class="<?php echo $hidden . " " . $disabled; ?>"><a href="user-register.php">Sign Up</a></li>
                  <li class="<?php echo $hidden; ?>"><a href="user-password-request.php">Password Request</a></li>
                  <li class="<?php echo $disabled . ' ' . $disabledTypei; ?>"><a href="<?php echo $dashboard; ?>">Dashboard</a></li>
                  <li class="<?php echo $disabled . ' ' . $disabledTypei; ?>"><a href="profile-display.php">Profile</a></li>
                  <li class="<?php echo $disabled; ?>"><a href="profile-edit.php"><?php echo $editProfile; ?></a></li>
                  <li class="<?php echo $disabled . ' ' . $disabledTypei; ?>"><a href="profile-images.php">Images</a></li>
                  <li class="<?php echo $disabled . ' ' . $disabledTypei; ?>"><a href="profile-select-city.php">Search</a></li>
                  <li class="<?php echo $disabled . ' ' . $disabledTypei; ?>"><a href="profile-search-results.php">Results</a></li>
                  <!-- <li class="disabled"><a href="#">Contact/Support</a></li>                     -->
                  <li class="nav-last">
                  <?php 
                  if (!empty($_SESSION['user_id'])) {
                    echo "<a href='user-logout.php'>Logout</a></li>\n";
                  }else{
                    echo "<a href='user-login.php'>Login</a></li>\n";
                  }
                  ?>
                </ul>
              </div><!-- /.navbar-collapse -->
            </div>
          </nav>
        </div>
      </div>
      