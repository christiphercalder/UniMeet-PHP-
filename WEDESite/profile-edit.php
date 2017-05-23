<?php

require_once('inc/header.php');
checkLoginStatus();

if($_SERVER['REQUEST_METHOD']=="GET")
{
    
  $bodyType = (isset($_SESSION['body_id'])?$_SESSION['body_id']:""); 
  $birthDate = (isset($_SESSION['birth_date'])?$_SESSION['birth_date']:"");  
  $city = (isset($_SESSION['city_id'])?$_SESSION['city_id']:"");
  $ethnicity = (isset($_SESSION['ethnic_id'])?$_SESSION['ethnic_id']:"");
  $education = (isset($_SESSION['education_id'])?$_SESSION['education_id']:"");
  $gender = (isset($_SESSION['gender_id'])?$_SESSION['gender_id']:"");
  $genderSought = (isset($_SESSION['gender_sought'])?$_SESSION['gender_sought']:"");  
  $email = (isset($_SESSION['email_address'])?$_SESSION['email_address']:"");  
  $fieldOfStudy = (isset($_SESSION['study_major'])?$_SESSION['study_major']:"");
  $firstName = (isset($_SESSION['first_name'])?$_SESSION['first_name']:"");
  $hairColour = (isset($_SESSION['hair_id'])?$_SESSION['hair_id']:"");
  $lastName = (isset($_SESSION['last_name'])?$_SESSION['last_name']:"");
  $language = (isset($_SESSION['language_id'])?$_SESSION['language_id']:"");
  $religion = (isset($_SESSION['religion_id'])?$_SESSION['religion_id']:"");
  $school = (isset($_SESSION['school_id'])?$_SESSION['school_id']:"");
  $seeking = (isset($_SESSION['seeking_id'])?$_SESSION['seeking_id']:"");
  $smoker = (isset($_SESSION['smoker_id'])?$_SESSION['smoker_id']:"");
  $status = (isset($_SESSION['status_id'])?$_SESSION['status_id']:"");
  $selfDescription = (isset($_SESSION['self_description'])?$_SESSION['self_description']:"");
}
else{
  
}
if ($_SERVER['REQUEST_METHOD']=="POST") {
  unset($_SESSION['info_message']);
  unset($_SESSION['requested_action']);  
  arraySanitize($_POST);
  //fix the session variables so that Null is passed if nothing is entered
  $bodyType = (isset($_POST['body_id']) AND !empty($_POST['body_id']))?$_POST['body_id']:"";
  $birthDate = (isset($_POST['birth_date']) AND !empty($_POST['birth_date']))?$_POST['birth_date']:"";
  $city = (isset($_POST['city_id']) AND !empty($_POST['city_id']))?$_POST['city_id']:"";
  $ethnicity = (isset($_POST['ethnic_id']) AND !empty($_POST['ethnic_id']))?$_POST['ethnic_id']:"";
  $education = (isset($_POST['education_id'])AND !empty($_POST['education_id']))?$_POST['education_id']:"";
  $gender = (isset($_POST['gender_id']) AND !empty($_POST['gender_id']))?$_POST['gender_id']:"";
  $genderSought = (isset($_POST['gender_sought'])AND !empty($_POST['gender_sought']))?$_POST['gender_sought']:"";
  $email = (isset($_POST['email_address']) AND !empty($_POST['email_address']))?$_POST['email_address']:"";
  $fieldOfStudy = (isset($_POST['study_major']) AND !empty($_POST['study_major']))?$_POST['study_major']:"";
  $firstName = (isset($_POST['first_name']) AND !empty($_POST['first_name']))?$_POST['first_name']:"";
  $lastName = (isset($_POST['last_name']) AND !empty($_POST['last_name']))?$_POST['last_name']:"";
  $hairColour = (isset($_POST['hair_id']) AND !empty($_POST['hair_id']))?$_POST['hair_id']:"";
  $language = (isset($_POST['language_id']) AND !empty($_POST['language_id']))?$_POST['language_id']:"";
  $religion = (isset($_POST['religion_id']) AND !empty($_POST['religion_id']))?$_POST['religion_id']:"";
  $school = (isset($_POST['school_id']) AND !empty($_POST['school_id']))?$_POST['school_id']:"";
  $seeking = (isset($_POST['seeking_id']) AND !empty($_POST['seeking_id']))?$_POST['seeking_id']:"";
  $smoker = (isset($_POST['smoker_id']) AND !empty($_POST['smoker_id']))?$_POST['smoker_id']:"";
  $status = (isset($_POST['status_id']) AND !empty($_POST['status_id']))?$_POST['status_id']:"";
  $selfDescription = (isset($_POST['self_description']) AND !empty($_POST['self_description']))?$_POST['self_description']:"";
  if ($_SESSION['user_type'] == INCOMPLETE_USER) {
    storeNewProfileInfo($_POST);
    $_SESSION['requested_action'] = "success";
    $_SESSION['info_message'] = "Profile Created";
    header("Location: user-dashboard.php");
  }else{
    updateProfileInfo($_POST);
    // $auth = TRUE;
    $_SESSION['requested_action'] = "success";
    $_SESSION['info_message'] = "Profile Updated";
    // header("Location: profile-display.php");
  }  
}
// if post is set update the profile in the database
?>
<section class="content">				
        <div class="row">
          <?php include_once ('inc/side-nav.php'); ?>
          <div class="col-xs-12 col-sm-8 col-md-9 content wp1">
            <div class="row">
              <div class="col-xs-12 col-sm-6">
                <h1>
                <?php echo $contentHeader; ?> Your Profile
                </h1>
                <p>Enter your information below to update your profile. Required fields are highlighted <span style="color:red"><b>red!!</b></span></p>
              </div> 
            </div>
            <form class="form" id="edit-profile" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" role="form">
            <!-- <form class="form" method="POST" action="test.php" role="form"> -->
            <div class="row">
              <div class="col-md-6 form-group">
                <input class="hidden" type="text" name="user_type" value="c"/>
                <input class="name form-control" type="text" name="first_name" value="<?php echo $firstName; ?>" placeholder="First Name"/>
                <input class="name form-control" type="text" name="last_name" value="<?php echo $lastName; ?>" placeholder="Last Name"/>
                <input class="name form-control" type="email" name="email_address" value="<?php echo $email; ?>" placeholder="Email"/>
                <input class="name form-control" type="date" name="birth_date" value="<?php echo $birthDate; ?>"/>
                <div class="output-box-normal required">
                  <?php echo buildRadio("genders", $gender); ?>
                </div>
                <div class="output-box-normal required">
                  <?php echo buildRadio("gender_sought", $genderSought) ?>
                </div>
                <select class="dropdown-large form-control " id="status_id" name="status_id" >
                  <?php echo buildDropDown("status", $status); ?>                   
                </select>
                <select class="dropdown-large form-control " id="seeking_id" name="seeking_id" >
                  <?php echo buildDropDown("seeking", $seeking); ?>                
                </select>
                <select class="dropdown-large form-control " id="hair_id" name="hair_id" >
                  <?php echo buildDropDown("hair", $hairColour); ?>                
                </select>
                <select class="dropdown-large form-control" id="body_id" name="body_id">
                  <?php echo buildDropDown("bodies", $bodyType); ?>
                </select>  
                                              
              </div>
              <div class="col-md-6 form-group">
                <input class="hidden" type="text" name="head_line" value="head_line"/>                
                <input class="hidden" type="text" name="match_description" value="match_description"/>
                <select class="dropdown-large form-control required" id="city_id" name="city_id" required>
                  <?php echo buildDropDown("cities", $city); ?>
                </select>
                <select class="dropdown-large form-control" id="education_id" name="education_id" >
                  <?php echo buildDropDown("education", $education); ?>
                </select>
                <select class="dropdown-large form-control required" id="school_id" name="school_id" required>
                  <?php echo buildDropDown("schools", $school); ?>
                </select>
                <input class="form-control" type="text" name="study_major" value="<?php echo $fieldOfStudy; ?>" placeholder="Field Of Study">               
                <select class="dropdown-large form-control" id="ethnic_id" name="ethnic_id">
                  <?php echo buildDropDown("ethnicity", $ethnicity); ?>
                </select>
                <select class="dropdown-large form-control" id="language_id" name="language_id">
                  <?php echo buildDropDown("languages", $language); ?>
                </select>
                <select class="dropdown-large form-control" id="religion_id" name="religion_id">
                  <?php echo buildDropDown("religions", $religion); ?>
                </select>  
                <select class="dropdown-large form-control" id="smoker_id" name="smoker_id">
                  <?php echo buildDropDown("smoker", $smoker); ?>
                </select>        
                <textarea form="edit-profile" class="form-control" type="text" name="self_description" value="<?php echo $selfDescription; ?>" placeholder="About Me"></textarea>
              </div>  
              <div class="col-xs-12 col-sm-12 form-group">
                <input class="login-btn" type="submit" value="Update">
              </div>
            </div>                
            </form>              
          </div>
        </div>        
     </section>
      <script>/*SCript for error or success message*/
        <?php          
            
        $output = "\n\t  toastr.options.closeButton = true;\n";
        $output .= "\t  toastr.options.positionClass = 'toast-screen-center';\n";
        $output .= "\t  toastr.options.timeOut = 0;\n";
        $output .= "\t  toastr.options.extendedTimeOut = 0;\n";
        if(isset($_SESSION['requested_action']) && $_SESSION['requested_action'] == "error"){
          $output .= "\t  toastr.error(\"" . $_SESSION['info_message'] . "\", \"Error!!\");\n";          
        }
        if(isset($_SESSION['requested_action']) && $_SESSION['requested_action'] == "success") {
          $output .= "\t  toastr.success(\"" . $_SESSION['info_message'] . "\", \"Success!!\");\n";
        }
        echo($output);
        // unset($_SESSION['info_message']);
        // unset($_SESSION['requested_action']);        
        ?>

      </script>

<?php include_once('inc/footer.php'); ?>