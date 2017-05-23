<?php

require_once('inc/header.php');
//Check if user is logged in
checkLoginStatus();
if ($_SESSION['user_type'] == INCOMPLETE_USER) {
 header("Location: profile-edit.php");
}
// dump(count($_SESSION['search_results']));
// die;
// Check if SESSION['search_results'] has more than 1 result
if (count($_SESSION['search_results']) < 1) {
  header("Location: profile-display.php");
}

$counter = checkPageNum($_SERVER['REQUEST_URI']);

// dump($counter);
// dump(count($_SESSION['search_results']));
?>
      <section class="design" id="design">        
          <div class="row row-top">
            <?php include_once ('inc/side-nav.php'); ?>
            <div class="col-sm-9 col-md-9 design-content">
              <div class="col-xs-12">
                <nav class="text-center">
                  <?php echo pagination(count($_SESSION['search_results']), MAX_PAGE_ITEMS, $_SERVER['REQUEST_URI']); ?>
                </nav>
              </div>
              <!-- Search Results -->              
              <?php 
              for ($i=1; $i <= MAX_PAGE_ITEMS; $i++) { 
                if (!empty($_SESSION['search_results'][$counter])) {
                  echo createProfilePreview($_SESSION['search_results'][$counter], $counter+1);
                  $counter++;
                }                 
              }              
              ?>              
              <div class="col-xs-12">
                <nav class="text-center">
                  <?php echo pagination(count($_SESSION['search_results']), MAX_PAGE_ITEMS, $_SERVER['REQUEST_URI']); ?>                
                </nav>
              </div>
            </div>
          </div>        
      </section>
<?php include_once('inc/footer.php'); ?>