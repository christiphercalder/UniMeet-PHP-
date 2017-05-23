<?php 

include 'inc/header.php'; 

//Setting placeholders and values for data retention
if($_SERVER['REQUEST_METHOD']=="GET")
{
  $bodyType = $city = $ethnicity = $education = $gender = $genderSought = $hairColour = $language = $religion = $school = $seeking = $smoker = $status = "";
  $fieldOfStudy = "Field of Study";
  $firstName = "First Name";  
  $lastName = "Last Name";
  
}else{
   $bodyType = (isset($_POST['body_id']))?$_POST['body_id']:"";
   $city = (isset($_POST['city_id']))?$_POST['city_id']:"";
   $ethnicity = (isset($_POST['ethnicity_id']))?$_POST['ethnicity_id']:"";
   $education = (isset($_POST['education_id']))?$_POST['education_id']:"";
   $gender = (isset($_POST['gender_id']))?$_POST['gender_id']:"";
   $genderSought = (isset($_POST['gender_sought']))?$_POST['gender_sought']:"";
   $fieldOfStudy = (isset($_POST['study_major']) AND !empty($_POST['study_major']))?$_POST['study_major']:"Field of Study";
   $hairColour = (isset($_POST['hair_id']))?$_POST['hair_id']:"";
   $language = (isset($_POST['language_id']))?$_POST['language_id']:"";
   $religion = (isset($_POST['religion_id']))?$_POST['religion_id']:"";
   $school = (isset($_POST['school_id']))?$_POST['school_id']:"";
   $seeking = (isset($_POST['seeking_id']))?$_POST['seeking_id']:"";
   $smoker = (isset($_POST['smoker_id']))?$_POST['smoker_id']:"";
   $status = (isset($_POST['status_id']))?$_POST['status_id']:"";

}
/*if user decides to fill out profile now, validate data and store in db if not set their 
  user_type to "i" and return them to the login page*/ 
// if (!isset($_POST)) {

//   header("Location: user-login.php");
//  } 
?>
      <section class="download-now" id="profile-create">        
        <div class="row row-top">
          <div class="col-md-8 wp1">
            <h1>Create Your Profile</h1>
            <p>Enter your information below to create a profile or you may skip this step and update it later.</p>              
            <form class="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" role="form">
            <div class="row">
              <div class="col-md-6 form-group">                
                <div class="output-box-normal">
                  <?php echo buildRadio("genders", $gender); ?>
                </div>
                <div class="output-box-normal">
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
                <select class="dropdown-large form-control" id="smoker_id" name="smoker_id">
                  <?php echo buildDropDown("smoker", $smoker); ?>
                </select>                                               
              </div>
              <div class="col-md-6 form-group">
                <select class="dropdown-large form-control" id="city_id" name="city_id" required>
                  <?php echo buildDropDown("cities", $city); ?>
                </select>
                <select class="dropdown-large form-control" id="education_id" name="education_id" >
                  <?php echo buildDropDown("education", $education); ?>
                </select>
                <select class="dropdown-large form-control" id="school_id" name="school_id" required>
                  <?php echo buildDropDown("schools", $school); ?>
                </select>
                <input class="form-control" type="text" name="study_major" placeholder="<?php echo $fieldOfStudy; ?>">               
                <select class="dropdown-large form-control" id="ethnicity_id" name="ethnicity_id">
                  <?php echo buildDropDown("ethnicity", $ethnicity); ?>
                </select>
                <select class="dropdown-large form-control" id="language_id" name="language_id">
                  <?php echo buildDropDown("languages", $language); ?>
                </select>
                <select class="dropdown-large form-control" id="religion_id" name="religion_id">
                  <?php echo buildDropDown("religions", $religion); ?>
                </select>  
                               
              </div>  
              <div class="col-xs-12 col-sm-12 form-group">
                <input class="login-btn" type="submit" value="Create Profile">
               <!--  <form class="form" method="POST" action="user-login.php" role="skip profile and return to login">
                  <input class="login-btn" type="submit" value="Skip Profile">
                </form> -->
                <div class="login-btn"><a>Skip Profile</a></div>
              </div>
            </div>                
            </form>              
          </div>
        </div>        
      </section>    
      <script>
        toastr.options.closeButton = true;
        toastr.options.positionClass = 'toast-screen-center';
        toastr.options.timeOut = 0;
        toastr.options.extendedTimeOut = 0;
        toastr.success("Thank You for becoming a member, you may proceed with your profile or skip this step and check out the site.", "Successfull Registration!!")

          // "closeButton": true,
          // "debug": false,
          // "newestOnTop": false,
          // "progressBar": false,
          // "positionClass": "toast-top-center",
          // "preventDuplicates": false,
          // "onclick": null,
          // "showDuration": "300",
          // "hideDuration": "1000",
          // "timeOut": "5000",
          // "extendedTimeOut": "1000",
          // "showEasing": "swing",
          // "hideEasing": "linear",
          // "showMethod": "fadeIn",
          // "hideMethod": "fadeOut"
      </script>

      <?php include 'inc/footer.php'; ?>
         