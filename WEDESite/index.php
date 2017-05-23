<?php 

require_once('inc/constants.php');
include_once ('inc/functions.php');

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
    <link href="css/toastr.min.css" rel="stylesheet"/>
    <link href="css/main.css" rel="stylesheet"/>
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'/>
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/toastr.min.js"></script>   
  </head>
  <body>
    <div class="container-fluid">
      <section class="navigation"><h2 class="hidden">Main Navigation</h2>
          <div class="row">
            <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2">
              <nav class="pull">
                <ul class="top-nav">
                  <li><a href="index.php">Home<span class="indicator"><i class="fa fa-angle-right"></i></span></a></li>
                  <li><a href="user-register.php">Get Started/Sign Up <span class="indicator"><i class="fa fa-angle-right"></i></span></a></li>
                  <li><a href="#media">Testimonials <span class="indicator"><i class="fa fa-angle-right"></i></span></a></li>
                  <li><a href="#contact">Contact/Support <span class="indicator"><i class="fa fa-angle-right"></i></span></a></li>
                  <li class="nav-last"><a href="user-login.php">Log In<span class="indicator"><i class="fa fa-angle-right"></i></span></a></li>
                </ul>
              </nav>
            </div>
          </div>        
      </section>
      <section class="hero" id="hero"><h2 class="hidden">Home Page</h2>
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-right">
              <a href="#"><i class="fa fa-navicon fa-2x nav_slide_button"></i></a>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5 col-md-offset-7 text-center" id="welcome-title">
              <img class="animated bounceInDown" id="welcome-title-img" src="<?php echo BASE_URL . BRAND_LOGO ?>" alt="UniMeet Logo"/>
              <p class="animated fadeInUpDelay">Looking for someone to blow classes with? We think we can help!</p>
            </div>            
          </div>
          <div class="row row-no-padding">
            <div class="col-xs-12 text-center" id="hide4phone">
              <a href="user-register.php" class="login-btn">Sign Up</a>
              <a href="user-login.php" class="login-btn">Log In</a>
            </div>            
          </div>          
        </div>
      </section>
      <section class="download-now" id="getstarted">
        <div class="container">
          <div class="row">
            <div class="col-md-8 wp1">
              <h1>
              Go to the movies with someone awesome!!
              </h1>
              <p>Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

            </div>
          </div>
        </div>
      </section>
      <section class="testimonials" id="media">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center">
              <div id="firstSlider">
                <ul class="slides">
                  <li>
                    <div class="avatar"><img src="img/av-blaz.png" alt="User Image"/></div>
                    <h1>I couldn't possibly imagine having to do homework alone again, thanks UniMeet.</h1>
                  </li>
                  <li>
                    <div class="avatar"><img src="img/av-pete.png" alt="User Image"/></div>
                    <h1>I found the girl of my dreams</h1>
                  </li>
                  <li>
                    <div class="avatar"><img src="img/av-doge.png" alt="User Image"/></div>
                    <h1>Even I found someone!!!!</h1>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php include 'inc/footer.php'; ?>