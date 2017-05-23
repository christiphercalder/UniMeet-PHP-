<?php

require_once('inc/header.php');
checkLoginStatus();

if ($_SESSION['user_type'] != ADMIN_USER) {
  header("Location: index.php");
}

$flaggedUsers =  searchFlaggedUsers(UNRESOLVED);
// dump($flaggedUsers);
?>
<section class="design" id="design">        
        <div class="row">
          <?php include_once ('inc/side-nav.php'); ?> 
          <div class="col-xs-12 col-sm-9 col-md-10 filler"><br>
          	<h1>Flagged Users</h1>
          	<p>Click on Username to bring up profile</p>
          	<table class="table table-hover"> <!-- Paginate -->
					    <thead>
					      <tr>
					        <th>Status</th>
					      	<th>Username</th>					        
					        <th>Date</th>
					        <th>Offended User</th>
					      </tr>
					    </thead>
					    <tbody>
					      <?php 					      
					      foreach ($flaggedUsers as $key => $value) {					      	
					      	echo createTableRowflagged($value['offensive_user_id'], $value['reporting_user_id'], $value['report_date'], $value['status']);
					      }
					 			?>
					    </tbody>
					  </table>
          </div>         
        </div>   
      </section>
<?php include_once('inc/footer.php'); ?>