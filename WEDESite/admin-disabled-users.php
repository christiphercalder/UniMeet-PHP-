<?php

require_once('inc/header.php');
checkLoginStatus();

if ($_SESSION['user_type'] != ADMIN_USER) {
  header("Location: index.php");
}

$disabledUsers = searchDisabledUsers();
// dump($disabledUsers);
// die;
?>
<section class="design" id="design">        
        <div class="row">
          <?php include_once ('inc/side-nav.php'); ?> 
          <div class="col-xs-12 col-sm-9 col-md-10 filler" style="overflow: scroll;"><br>
          	<h1>Disabled Users</h1>
          	<p>Click on Username to bring up profile</p>
          	<table class="table table-hover">
					    <thead>
					      <tr>
					      	<th>Username</th>
					        <th>Status</th>
					        <th>Firstname</th>
					        <th>Lastname</th>
					        <th>Email</th>
					        <th style="text-align: center;">Action</th>
					      </tr>
					    </thead>
					    <tbody>
					      <?php 					      
					      foreach ($disabledUsers as $key => $value) {
					      	echo createTableRowDisabled($value['user_id'], $value['first_name'], $value['last_name'], $value['email_address']);
					      }
					 			?>
					    </tbody>
					  </table>
          </div>         
        </div>   
      </section>
<?php include_once('inc/footer.php'); ?>