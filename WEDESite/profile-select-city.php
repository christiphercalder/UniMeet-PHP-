<?php

require_once('inc/header.php');

checkLoginStatus();
if ($_SESSION['user_type'] == "i") {
 header("Location: profile-edit.php");
}
//preselected variables
$city = "";
if ($_SERVER['REQUEST_METHOD']=="GET") {
  //Data retention for initial page load
  $city = (isset($_COOKIE['search_city_id']))?($_COOKIE['search_city_id']):"";
 
}
//Ensure required checkboxes are checked

//Check if $_POST is set and proceed with validation and results retrieval
if ($_SERVER['REQUEST_METHOD']=="POST") {
  $_SESSION['search_cities'] = $_POST['city_id'] = $city = (isset($_POST['city_id']))?sumCheckBox($_POST['city_id']):"";
     
  //Set Cookie
  if (trim($_POST['city_id']) != "") {
    setcookie("search_city_id", $city, COOKIE_EXPIRE);
  } 
  
  if (!empty($_POST['city_id'])) {    
    header("Location: profile-search.php");
  }else{
    header("Location: profile-select-city.php");
  }    
}
?>
<section class="design" id="design">         
        <div class="row">
          <?php include_once ('inc/side-nav.php'); ?>
          <div class="col-xs-12 col-sm-9 col-md-10 design-content">
            <h1>City Search</h1>
            <p>Select multiple cities or simply click on a city in the map to search individually</p>
            <form class="" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" role="form">               
            <div class="col-xs-4 col-sm-4 col-md-3 search-box">    
              <div class="col-sm-12 text-center" style="padding-top: 8px;">
                <input class="login-btn" type="submit" value="Search"></input>              
              </div>          
              <?php echo buildCheckbox("cities", $city); ?>                            
            </div>
            <div class="col-xs-8 col-sm-8 col-md-9">
              <img src="img/mapGTA.png" alt="Map of Greater Toronto Area" usemap="mapGTA">
              <map name="mapGTA">
                <area shape="poly" coords="406, 214, 440, 214, 441, 265, 432, 269, 419, 270, 414, 268, 409, 269" href="profile-search.php?city=2" alt="Ajax"></area>
                <area shape="poly" coords="441, 206, 475, 206, 475, 266, 467, 267, 463, 266, 449, 263, 443, 265" href="profile-search.php?city=1" alt="Whitby"></area>
                <area shape="poly" coords="292, 231, 368, 231, 368, 254, 379, 269, 345, 289, 329, 292, 324, 296, 321, 301, 305, 307" href="profile-search.php?city=4" alt="Scarborough"></area>
                <area shape="poly" coords="177, 240, 184, 330, 159, 345, 145, 366, 139, 369, 124, 342, 116, 346, 88, 292, 98, 287, 111, 287, 140, 272, 147, 267, 162, 248" href="profile-search.php?city=8" alt="Mississauga"></area>
                <area shape="poly" coords="476, 169, 511, 169, 511, 272, 503, 268, 487, 272, 476, 266" href="profile-search.php?city=16" alt="Oshawa"></area>
                <area shape="poly" coords="369, 168, 440, 168, 440, 213, 406, 214, 407, 268, 400, 268, 396, 266, 385, 266, 380, 268, 370, 254" href="profile-search.php?city=32" alt="Pickering"></area>
                <area shape="poly" coords="512, 183, 651, 183, 653, 291, 623, 285, 608, 286, 587, 276, 572, 277, 564, 274, 545, 280, 513, 272" href="profile-search.php?city=64" alt="Bowmanville"></area>
                <area shape="poly" coords="441, 80, 508, 80, 508, 97, 493, 119, 493, 130, 499, 130, 516, 107, 516, 101, 535, 80, 531, 112, 513, 132, 526, 129, 538, 117, 555, 108, 578, 91, 578, 182, 513, 182, 513, 169, 441, 167" href="profile-search.php?city=128" alt="Port Perry"></area>                
                <area shape="poly" coords="301, 174, 367, 174, 367, 230, 269, 230, 270, 213, 291, 213" href="profile-search.php?city=256" alt="Markham"></area>                
                <area shape="poly" coords="73, 241, 171, 176, 177, 239, 161, 248, 143, 270, 135, 272, 111, 285, 95, 286" href="profile-search.php?city=512" alt="Brampton"></area>                
                <area shape="poly" coords="177, 232, 198, 232, 218, 280, 219, 312, 214, 314, 199, 327, 185, 329" href="profile-search.php?city=1024" alt="Etobicoke"></area>                
                <area shape="poly" coords="441, 169, 475, 169, 475, 205, 441, 205" href="profile-search.php?city=2048" alt="Brooklin"></area>                
                <area shape="poly" coords="38, 87, 163, 89, 170, 175, 72, 240, 7, 109, 28, 95, 31, 98, 38, 92" href="profile-search.php?city=4096" alt="Caledon"></area> 
                <area shape="poly" coords="202, 232, 290, 232, 300, 285, 270, 286, 268, 265, 256, 265, 248, 276, 220, 280" href="profile-search.php?city=8192" alt="York"></area>                
                <area shape="poly" coords="171, 160, 266, 162, 260, 213, 269, 213, 267, 230, 178, 230" href="profile-search.php?city=16384" alt="Vaughn"></area>                
                <area shape="poly" coords="269, 143, 307, 144, 290, 212, 261, 212" href="profile-search.php?city=32768" alt="Richmond Hill"></area>
                <area shape="poly" coords="367, 23, 440, 23, 440, 167, 369, 167" href="profile-search.php?city=65536" alt="Uxbridge"></area>                
                <area shape="poly" coords="310, 93, 367, 94, 367, 172, 301, 172, 309, 137" href="profile-search.php?city=131072" alt="Stouffville"></area>                
                <area shape="poly" coords="220, 281, 249, 277, 257, 266, 267, 266, 269, 288, 301, 286, 305, 307, 296, 314, 284, 315, 267, 324, 254, 333, 249, 333, 245, 329, 244, 319, 226, 312, 220, 312" href="profile-search.php?city=262144" alt="Toronto"></area>                
              </map>
            </div>    
            </form>
          </div>            
        </div>        
      </section>   
      <script type="text/javascript">
        <!--
        /*NOTE: for the following function to work, on your page
            you have to create a checkbox id'ed as city_toggle
              
        <input type="checkbox"  id="city_toggle" onclick="cityToggleAll();" name="city[]" value="0">
            
          and each city checkbox element has to be an named as an 
          array (specifically named "city[]")
          e.g.
            <input type="checkbox" name="city[]" value="1">Ajax
        */
        function cityToggleAll(){
          //alert("In cityToggleAll()");  //alerts used for de-bugging
          var isChecked = document.getElementById("city_toggle").checked;
          var city_checkboxes = document.getElementsByName("city_id[]");
          for (var i in city_checkboxes){
          //SAME AS for ( i = 0; i < city_checkboxes.length; i++){
            city_checkboxes[i].checked = isChecked;
          }   
        }
      </script>   
<?php include_once('inc/footer.php'); ?>