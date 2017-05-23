<!-- ACCEPTABLE USE POLICY -->
<?php
require_once('inc/header.php');
$body = file_get_contents('Legal/AUPHTML.html');
?>
<section id="content-section">        
        <div class="row">
        	<div class="col-sm-8 col-sm-offset-2"><?php echo $body; ?></div>
        </div>
      </section>
<?php include_once('inc/footer.php'); ?><!-- Acceptable Use Policy --><!-- Taken from OkCupid -->