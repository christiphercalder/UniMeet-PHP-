<?php

require_once('inc/header.php');

checkLoginStatus();
if ($_SESSION['user_type'] == INCOMPLETE_USER) {
 header("Location: profile-edit.php");
}

//preselected variables
$city = $body = $genders = $ethnicity = $hair = $language = $religion = $school =  $seeking = $smoker = $status = "";
if ($_SERVER['REQUEST_METHOD']=="GET") {
  $_SESSION['info_message'] = "";
  $auth = TRUE;
  //Data retention for initial page load
  $genders = (isset($_COOKIE['search_gender_id']))?($_COOKIE['search_gender_id']):$_SESSION['gender_sought'];
  $seeking = (isset($_COOKIE['search_seeking_id']))?($_COOKIE['search_seeking_id']):"";
  $status = (isset($_COOKIE['search_status_id']))?($_COOKIE['search_status_id']):"";
  $smoker = (isset($_COOKIE['search_smoker_id']))?($_COOKIE['search_smoker_id']):"";
  $bodies = (isset($_COOKIE['search_body_id']))?($_COOKIE['search_body_id']):"";
  $hair = (isset($_COOKIE['search_hair_id']))?($_COOKIE['search_hair_id']):"";
  $schools = (isset($_COOKIE['search_school_id']))?($_COOKIE['search_school_id']):"";
  $ethnicity = (isset($_COOKIE['search_ethnic_id']))?($_COOKIE['search_ethnic_id']):"";
  $languages = (isset($_COOKIE['search_language_id']))?($_COOKIE['search_language_id']):"";
  $religions = (isset($_COOKIE['search_religion_id']))?($_COOKIE['search_religion_id']):"";
  if (isset($_GET['city'])) {
    $_SESSION['search_cities'] = $_GET['city'];
  }
}
//Ensure required checkboxes are checked

//Check if $_POST is set and proceed with validation and results retrieval
if ($_SERVER['REQUEST_METHOD']=="POST") {  

  $_POST['city_id'] = $_SESSION['search_cities'];
  $_POST['gender_id'] = $genders = (isset($_POST['gender_id']))?sumCheckBox($_POST['gender_id']):$_SESSION['gender_sought'];
  $_POST['seeking_id'] = $seeking = (isset($_POST['seeking_id']))?sumCheckBox($_POST['seeking_id']):"";
  $_POST['status_id'] = $status = (isset($_POST['status_id']))?sumCheckBox($_POST['status_id']):"";
  $_POST['smoker_id'] = $smoker = (isset($_POST['smoker_id']))?sumCheckBox($_POST['smoker_id']):"";
  $_POST['body_id'] = $bodies = (isset($_POST['body_id']))?sumCheckBox($_POST['body_id']):"";
  $_POST['hair_id'] = $hair = (isset($_POST['hair_id']))?sumCheckBox($_POST['hair_id']):"";
  $_POST['school_id'] = $schools = (isset($_POST['school_id']))?sumCheckBox($_POST['school_id']):"";
  $_POST['ethnic_id'] = $ethnicity = (isset($_POST['ethnic_id']))?sumCheckBox($_POST['ethnic_id']):"";
  $_POST['language_id'] = $languages = (isset($_POST['language_id']))?sumCheckBox($_POST['language_id']):"";
  $_POST['religion_id'] = $religions = (isset($_POST['religion_id']))?sumCheckBox($_POST['religion_id']):"";
    
  //Set Cookie
  setcookie("search_gender_id", $genders, COOKIE_EXPIRE);
  setcookie("search_seeking_id", $seeking, COOKIE_EXPIRE);
  setcookie("search_status_id", $status, COOKIE_EXPIRE);
  setcookie("search_smoker_id", $smoker, COOKIE_EXPIRE);
  setcookie("search_body_id", $bodies, COOKIE_EXPIRE);
  setcookie("search_hair_id", $hair, COOKIE_EXPIRE);
  setcookie("search_school_id", $schools, COOKIE_EXPIRE);
  setcookie("search_ethnic_id", $ethnicity, COOKIE_EXPIRE);
  setcookie("search_language_id", $languages, COOKIE_EXPIRE);
  setcookie("search_religion_id", $religions, COOKIE_EXPIRE);
  
  // setMultipleCookie("search", $_POST);  
  // dump($_POST); 
  // die;   //TESTING
  // dump($_COOKIE);    //TESTING
  if($_POST['gender_id'] >= 0 && $_POST['seeking_id'] != "" && $_POST['status_id'] != ""){
    $_SESSION['search_results'] = searchUsers($_POST);
    // dump(searchUsers($_POST));    //TESTING
    // dump($_SESSION['search_results'][0]);    //TESTING
    //dump($_SESSION['search_results']);    //TESTING
    //die;
    if(!empty(searchUsers($_POST)) && count(searchUsers($_POST)) == 1) {
      $_SESSION['view_user_id'] = $_SESSION['search_results'][0];
      header("Location: profile-display.php");//needs to be passed result user id
    }elseif(!empty(searchUsers($_POST)) && count(searchUsers($_POST)) > 1) {
      header("Location: profile-search-results.php");
    }else{
      $auth = FALSE;
      $_SESSION['info_message'] = "Sorry, We couldn't find any matches.";
    }   
  }else{
    $auth = FALSE;
    $_SESSION['info_message'] = "Please Fill out all required fields.";
  }
}
// dump($_SESSION['search_cities']);    //TESTING
?>
<section class="design" id="design">         
        <div class="row">
          <?php include_once ('inc/side-nav.php'); ?>
          <div class="col-xs-12 col-sm-9 col-md-10 design-content">
            <h1>Profile Search</h1>
            <p>Fill in the checkboxes to search profiles matching the selected criteria. Required fields are highlighted <span style="color: red;">*</span></p>
            <form class="" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" role="form">   
            <!-- <form class="" method="POST" action="test.php" role="form">    -->
            <div class="col-xs-6 col-sm-4 col-md-3 search-box">
              <?php echo buildCheckbox("gender_sought", $genders); ?>
              <?php echo buildCheckbox("seeking", $seeking); ?>
              <?php echo buildCheckbox("status", $status); ?>
              <?php echo buildCheckbox("smoker", $smoker); ?>
            </div>    
            <div class="col-xs-6 col-sm-4 col-md-3 search-box">               
              <?php echo buildCheckbox("bodies", $bodies); ?> 
              <?php echo buildCheckbox("hair", $hair); ?>                
            </div>            
            <div class="col-xs-6 col-sm-4 col-md-3 search-box">
              <?php echo buildCheckbox("schools", $schools); ?>
              <?php echo buildCheckbox("ethnicity", $ethnicity); ?>              
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 search-box">
              <?php echo buildCheckbox("languages", $languages); ?>              
              <?php echo buildCheckbox("religions", $religions); ?>              
            </div>            
            <div class="col-sm-12 text-center">
              <input class="login-btn" type="submit" value="Search"></input>              
            </div>
            </form>
          </div>            
        </div>        
      </section>
      <script>
      <?php
      $output = "toastr.options.closeButton = true;\n";
        $output .= "\t  toastr.options.positionClass = 'toast-screen-center';\n";
        $output .= "\t  toastr.options.timeOut = 0;\n";
        $output .= "\t  toastr.options.extendedTimeOut = 0;\n";
        if($auth == FALSE){
          $output .= "\t  toastr.error(\"" . $_SESSION['info_message'] . "\", \"Error!!\")";          
        }
        echo($output);        
      ?>
      </script>
<?php include_once('inc/footer.php'); ?>