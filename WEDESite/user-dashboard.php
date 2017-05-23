<?php

require_once('inc/header.php');
checkLoginStatus();

if ($_SESSION['user_type'] == INCOMPLETE_USER) {
  header("Location: profile-edit.php");
}
// dump($_SESSION);
?>
<section class="design" id="design">        
        <div class="row">
          <?php include_once ('inc/side-nav.php'); ?>
          <div class="col-xs-12 col-sm-8 col-md-9" id="content-section">
            <div id="secondSlider">
              <ul class="slides">
                <li>
                  <div class="col-sm-12 col-md-3 design-content">
                    <h1>We thought you might be interested....</h1>
                  </div> 
                  <div class="col-sm-12 col-md-9">
                    <div class="col-sm-4">
                      <div class="flat-box">
                        <div class="colourway"><img class="img-responsive img-circle " src="img/simpsons-young-homer.png"></div>
                        <p class="title">User4</p>
                        <p class="feature-text">University</p>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="flat-box">
                        <div class="colourway"><img class="img-responsive img-circle " src="img/simpsons-ned-flanders.png"></div>
                        <p class="title">User6</p>
                        <p class="feature-text">University</p>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="flat-box">
                        <div class="colourway"><img class="img-responsive img-circle " src="img/simpsons-young-flanders.png"></div>
                        <p class="title">User4</p>
                        <p class="feature-text">University</p>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="flat-box">
                        <div class="colourway"><img class="img-responsive  img-circle " src="img/simpsons-maggie.png"></div>
                        <p class="title">User6</p>
                        <p class="feature-text">University</p>
                      </div>
                    </div>
                  </div>                                       
                </li>
                <li>
                  <div class="col-sm-12 col-md-3 design-content">
                    <h1>You never know right....</h1>
                  </div>
                  <div class="col-sm-12 col-md-9">
                    <div class="col-sm-4">
                      <div class="flat-box">
                        <div class="colourway"><img class="img-responsive img-circle" src="img/simpsons-blue-haired-lawyer.png"></div>
                        <p class="title">User4</p>
                        <p class="feature-text">University</p>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="flat-box">
                        <div class="colourway"><img class="img-responsive img-circle" src="img/simpsons-cowboy-bob.png"></div>
                        <p class="title">User6</p>
                        <p class="feature-text">University</p>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="flat-box">
                        <div class="colourway"><img class="img-responsive img-circle" src="img/simpsons-marge-shorthair.gif"></div>
                        <p class="title">User4</p>
                        <p class="feature-text">University</p>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="flat-box">
                        <div class="colourway">
                          <img class="img-responsive img-circle" src="img/simpsons-doug-cameraman.png">
                        </div>
                        <p class="title">User6</p>
                        <p class="feature-text">University</p>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="flat-box">
                        <div class="colourway"><img class="img-responsive img-circle" src="img/simpsons-kirk-van-houten.png"></div>
                        <p class="title">User6</p>
                        <p class="feature-text">University</p>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="flat-box">
                        <div class="colourway"><img class="img-responsive img-circle" src="img/simpsons-dr-bertano.png"></div>
                        <p class="title">User6</p>
                        <p class="feature-text">University</p>
                      </div>
                    </div>
                  </div>                    
                </li>
              </ul>
            </div>
            <div class="col-md-1 col-md-offset-6 text-right controls">
              <a href="prev" class="prev"><i class="fa fa-angle-left fa-3x"></i></a>
              <a href="next" class="next"><i class="fa fa-angle-right fa-3x"></i></a>
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
        // unset($_SESSION['info_message']);
        // unset($_SESSION['requested_action']);        
        ?>

      </script>
<?php include_once('inc/footer.php'); ?>