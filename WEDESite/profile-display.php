
<?php

require_once('inc/header.php');
checkLoginStatus();
if ($_SESSION['user_type'] == "i") {
 header("Location: profile-edit.php");
}
$interested = "";
$disabled3 = "";
if (isset($_GET['user_id'])) {
  $user = getUserInfo($_GET['user_id']);
  $interested = checkInterest($_SESSION['user_id'], $_GET['user_id']);
  $hidden = "";
  if ($interested == 1) {
    $disabled1 = "disabled = \"disabled\"";    
    $disabled2 = "";    
  }else{    
    $disabled1 = "";
    $disabled2 = "disabled = \"disabled\"";
  }
  $flagged = checkOffensives($_GET['user_id'], UNRESOLVED);
  // dump($flagged);
  if ($flagged == 1) {
    $disabled3 = "disabled = \"disabled\"";
    $btnlbl = "Already Reported";
  }else{
    $disabled3 = "";
    $btnlbl = "Report User";
  }
}else{
  $user = $_SESSION;
  $hidden = "hidden";
}
if ($_SESSION['user_type'] == ADMIN_USER) {
  $hidden = "hidden";
  $admin = "";
  if ($user['user_type'] == COMPLETE_USER || $user['user_type'] == INCOMPLETE_USER || $user['user_type'] == ADMIN_USER) {
    $disabled1 = "disabled = \"disabled\"";    
    $disabled2 = "";    
  }else{    
    $disabled1 = "";
    $disabled2 = "disabled = \"disabled\"";
  }
}else{
  $admin = "hidden";
}
?>
			<section class="content">				
        <div class="row row-top">
        	<?php include_once ('inc/side-nav.php'); ?>
          <div class="col-xs-12 col-sm-9 col-md-9" id="content-section">
            <div class="row" id="content-header">               
              <div class=" col-xs-2 col-sm-2 col-md-2">
                <img class="img-responsive img-circle" src="img/placeholder-user.png">
              </div> 
              <div class="col-xs-4 col-sm-4 col-md-4">
                <h1>Profile<span class="text-primary"><?php echo " " . $user['user_id']; ?></span></h1>
              </div>   
              <div class="col-xs-6 col-sm-6 col-md-6" style=" padding-right: 0px;">
                <a href="flag-user.php?user_id=<?php echo $_GET['user_id']; ?>" class="btn btn-danger <?php echo $hidden; ?>" type="button" style="float: right;" <?php echo $disabled3; ?>><?php echo $btnlbl; ?></a>
                <a href="user-disable.php?user_id=<?php echo $_GET['user_id']; ?>" class="btn btn-danger <?php echo $admin; ?>" type="button" style="float: right;" <?php echo $disabled2; ?>>Disable</a>
                <a href="remove-interest.php?user_id=<?php echo $_GET['user_id']; ?>" class="btn btn-warning <?php echo $hidden; ?>" type="button" style="float: right; margin-right: 5px;" <?php echo $disabled2; ?>>Not Interested</a>                
                <a href="add-interest.php?user_id=<?php echo $_GET['user_id']; ?>" class="btn btn-success <?php echo $hidden; ?>" type="button" style="float: right; margin-right: 5px;" <?php echo $disabled1; ?>>Interested</a>
                <a href="user-enable.php?user_id=<?php echo $_GET['user_id']; ?>" class="btn btn-success <?php echo $admin; ?>" type="button" style="float: right; margin-right: 5px;" <?php echo $disabled1; ?>>Enable</a>
              </div>              
            </div>            
            <div class="row">
              <div class="col-sm-6 col-md-6">  
                <?php echo buildOutputBox("small", getProperty(PLACEHOLDER, "genders"),getProperty($user['gender_id'], "genders")); ?>             
                <?php echo buildOutputBox("normal",  "First Name:", $user['first_name']); ?>
                <?php echo buildOutputBox("normal", "Last Name:", $user['last_name']); ?>                
                <?php echo buildOutputBox("small", getProperty(PLACEHOLDER, "gender_sought"), getProperty($user['gender_sought'], "gender_sought")); ?>
                <?php echo buildOutputBox("normal", getProperty(PLACEHOLDER, "status"), getProperty($user['status_id'], "status"));?>
                <?php echo buildOutputBox("normal", getProperty(PLACEHOLDER, "seeking"), getProperty($user['seeking_id'], "seeking"));?>                
                <?php echo buildOutputBox("small", "Birth Date:", $user['birth_date']); ?>                
                <?php echo buildOutputBox("normal", getProperty(PLACEHOLDER, "hair"), getProperty($user['hair_id'], "hair"));?>
                <?php echo buildOutputBox("normal", getProperty(PLACEHOLDER, "bodies"), getProperty($user['body_id'], "bodies"));?>
                <?php echo buildOutputBox("normal", getProperty(PLACEHOLDER, "smoker"), getProperty($user['smoker_id'], "smoker"));?>                                                                
              </div>
              <div class="col-sm-6 col-md-6">
                <?php echo buildOutputBox("normal", getProperty(PLACEHOLDER, "cities"), getProperty($user['city_id'], "cities"));?>
                <?php echo buildOutputBox("normal", getProperty(PLACEHOLDER, "education"), getProperty($user['education_id'], "education"));?>
                <?php echo buildOutputBox("normal", getProperty(PLACEHOLDER, "schools"), getProperty($user['school_id'], "schools"));?>
                <?php echo buildOutputBox("normal", "Field of Study:", $user['study_major']); ?>
                <?php echo buildOutputBox("normal", getProperty(PLACEHOLDER, "ethnicity"), getProperty($user['ethnic_id'], "ethnicity"));?>
                <?php echo buildOutputBox("normal", getProperty(PLACEHOLDER, "languages"), getProperty($user['language_id'], "languages"));?>
                <?php echo buildOutputBox("normal", getProperty(PLACEHOLDER, "religions"), getProperty($user['religion_id'], "religions"));?>                
                <?php echo buildOutputBox("large", "About Me:", $user['self_description']); ?>
              </div>                  
            </div>    
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
        if (isset($_SESSION['requested_action'])) {
          unset($_SESSION['info_message']);
          unset($_SESSION['requested_action']);
        }
        ?>

      </script>


<?php include_once('inc/footer.php'); ?>