<?php

require_once('inc/header.php');
checkLoginStatus();

if ($_SESSION['user_type'] == "i") {
  header("Location: profile-edit.php");
}
$interests = collectInterests($_SESSION['user_id']);
$profInterested = collectProfilesInterested($_SESSION['user_id']);
dump($interests);
dump($profInterested);
die;
foreach ($interests as $key => $value) {
  $search = array_search($value, $profInterested);
  $search2 = array_search($value, $interests);
  if($search === FALSE){
    continue;
  }else{
    unset($interests[$search2]);    
    unset($profInterested[$search]);    
    array_unshift($interests, $value);    
    array_unshift($profInterested, $value);    
  }  
}
// dump($interests);
// dump($profInterested);

?>
<section class="design" id="design">        
        <div class="row">
          <?php include_once ('inc/side-nav.php'); ?>
          <div class="col-xs-12 col-sm-8 col-md-10" id="content-section">
            <div class="col-xs-6 col-sm-6 col-md-6 interest-box-container"> <!-- Interests --> 
              <h3>My Interests</h3>
              <?php  
                foreach ($interests as $key => $value) {
                  if(array_search($value, $profInterested) === FALSE){
                    $match = 0;
                  }else{
                    $match = 1;  
                  }                  
                  echo createInterestPreview($value, $match);
                }
              ?>   
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 interest-box-container"> <!-- People Interested -->
              <h3>Interested in Me</h3>      
              <?php  
                foreach ($profInterested as $key => $value) {
                  if(array_search($value, $interests) === FALSE){
                    $match = 0;
                  }else{
                    $match = 1;  
                  } 
                  echo createInterestPreview($value, $match);
                }
              ?>    
            </div>   
          </div>
        </div>        
      </section>
      <script>/*SCript for error or success message*/
        <?php           
        if (isset($_SESSION['requested_action'])) {
          $output = "\n\t  toastr.options.closeButton = true;\n";
          $output .= "\t  toastr.options.positionClass = 'toast-screen-center';\n";
          $output .= "\t  toastr.options.timeOut = 3600;\n";
          $output .= "\t  toastr.options.extendedTimeOut = 0;\n";
          if($_SESSION['requested_action'] == "error"){
            $output .= "\t  toastr.error(\"" . $_SESSION['info_message'] . "\", \"Error!!\");\n";          
          }
          if($_SESSION['requested_action'] == "success") {
            $output .= "\t  toastr.success(\"" . $_SESSION['info_message'] . "\", \"Success!!\");\n";
          }
          echo($output);
          unset($_SESSION['info_message']);
          unset($_SESSION['requested_action']); 
        }       
        ?>

      </script>
<?php include_once('inc/footer.php'); ?>