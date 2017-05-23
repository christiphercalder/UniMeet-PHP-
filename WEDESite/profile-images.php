<?php

require_once('inc/header.php');
checkLoginStatus();

if ($_SESSION['user_type'] == "i") {
  header("Location: profile-edit.php");
}
$path = IMAGE_FOLDER . $_SESSION['user_id'] . "/";
if (scanUserDirectory($path) == FALSE) {
  $userImages = 0;
  $countUserImages = 0;
}else{
  $userImages = scanUserDirectory($path);// scanUserDirectory must be altered for non-windows server, see function for the changes required.
  $countUserImages = count($userImages);
}

// dump($userImages);
// dump($countUserImages);
// dump($_SESSION);
// die;
?>
<section class="design" id="design">        
        <div class="row">
          <?php include_once ('inc/side-nav.php'); ?>
          <div class="col-xs-12 col-sm-8 col-md-9" id="content-section">
            <div class="col-xs-12 col-sm-12 col-md-12" style="margin-bottom: 20px; ">
              <div class="col-xs-6 col-sm-6 col-md-6">
                <H1 style="">Profile Images</H1>
              </div>  
              <div class="col-xs-6 col-sm-6 col-md-6" style=" padding-right: 0px;">
                <button class="btn btn-success" data-toggle="modal" data-target="#uploadModal" style="float: right; ">Upload</button>
                <button type="submit" class="btn btn-danger" onclick="submitForm1('img-delete.php')" style="float: right;  margin-right: 5px;">Delete</button>
                <button type="submit" class="btn btn-info" onclick="submitForm1('img-update-profile.php')" style="float: right;  margin-right: 5px;">Profile Pic</button>
              </div>                          
            </div>    
            <form id="image_form" name="image_form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" role="Image Gallery Adjustment">        
              <div class="col-xs-1 col-sm-1 col-md-1 controls">
                <?php if ($countUserImages > 0) { echo "<a href=\"prev\" class=\"prev\"><i class=\"fa fa-angle-left fa-3x\"></i></a>"; } ?>
              </div>
              <div class="col-xs-10 col-sm-10 col-md-10" id="secondSlider">
              <?php 
              if ($countUserImages > 0) {
                echo buildImagePages($path, $userImages); 
              }
              // echo buildImagePages($path, $userImages); 
              if ($countUserImages < 1) {
                echo "<br><br><br><br><br>";
                echo "<div class='col-md-12 text-center text-info' style='margin-bottom: 300px;'><h1 id='no-image-message'>NO IMAGES</h1><p>Click the <span style='color: #5cb85c; font-weight: bold;'>Upload Button</span> at the top right corner to add an image.</p></div>";
              }
              ?>
              </div>
              <div class="col-xs-1 col-sm-1 col-md-1 controls">
                <?php if ($countUserImages > 0) { echo "<a href=\"next\" class=\"next\"><i class=\"fa fa-angle-right fa-3x\"></i></a>"; } ?>
              </div>
            </form>      

            <!----------------UPLOAD IMAGE MODAL-------------------------->
            <div class="modal fade" id="uploadModal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form id="upload_form" name="upload_form" method="POST" enctype="multipart/form-data" role="image_upload">
                    <div class="modal-header">
                      <button class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <h4>Upload Images</h4>
                    </div>
                    <div class="modal-body">
                      <div id="messages"></div>
                      <input type="file" name="upload_img" id="upload_form">
                    </div>
                    <div>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary" onclick="submitForm2('img-upload.php')">Save</button>
                    </div>
                  </form>                  
                </div>
              </div>
            </div>        
          </div>
        </div>        
      </section>
      <script type="text/javascript">/*Script for deciding which action to execute on form submission*/
        function submitForm1(action){
          document.getElementById('image_form').action = action;
          document.getElementById('image_form').submit();
        }
        function submitForm2(action){
          document.getElementById('upload_form').action = action;
          document.getElementById('upload_form').submit();
        }
      </script>
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