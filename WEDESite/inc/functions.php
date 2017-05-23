<?php 
// /*---------------------------------Functions-----------------------------------*/
//     //Function that takes a user input as an argument and uses various built in php functions to sanitize it.

//calculates age of a users
function ageCalculate($var){
  $age = "";
  $now = date('Ymd', time());
  $date = date('Ymd', strtotime($var));
  $age = intval(($now - $date)/10000);
  return $age;
}
//Sanitizes a variable
function sanitize($var){
    $var = trim($var);
    $var = strip_tags($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}
//Sanitizes an array
function arraySanitize($var){
	if(!is_array($var)){
    	
    	$var = sanitize($var);
    }else{
    	foreach($var as $key => $value)
    	{
    		$var[$key] = sanitize($value);
    	}
    }
    return $var;
}
//Profile Image builder
function buildImageBox($path, $num, $userImage){    
  ($num<10)?$num = ("0" . $num): $num;
  $fileName = $_SESSION['user_id'] . "/" . $userImage;  
  // $path = $path . $_SESSION['user_id'] . "-" . $num . ".jpg";
  $path = $path . $userImage;  
  // if (file_exists($image)) {
    $output = "\t\t      <div class=\"col-sm-4\">\n";
    $output .= "\t\t        <div class=\"flat-box\">\n";
    $output .= "\t\t\t  <div class=\"colourway\"><img class=\"img-responsive img-rounded profile-image\" src=\"" . $path . "?".time()."\"/></div>\n"; //the time function ensures that the most updated version is downloaded as opposed to the cache version which may have the same name but not the correct image
    $output .= "\t\t        </div>\n";
    $output .= "\t\t        <p class='bg-primary text-center'>$num <input type='checkbox' name='images[]' value='$fileName'/></p>\n";
    $output .= "\t\t      </div>\n";  
    return $output;
  // }  
}
//builds the pages used within a sliding page element
function buildImagePages($path, $userImages){
  $totalImages = count($userImages);  
  $num = 1;  
  $output = "\t<ul class=\"slides\">";
  for ($a=0; $a < $totalImages/MAX_IMAGE_PER_PAGE; $a++) { 
    $output .= "\n\t\t  <li>\n";
    $output .= "\t\t    <div class=\"col-sm-12 col-md-9\">\n";
    for ($i=0; $i < MAX_IMAGE_PER_PAGE; $i++) { 
      if ($num <= $totalImages) {
        $output .= buildImageBox($path, $num, $userImages[($num-1)]);
        $num++;
      }            
    }  
    $output .= "\t\t    </div>\n";
    $output .= "\t\t  </li>";
  }  
  $output .= "\n\t\t</ul>\n";
  return $output;
}

// Profile Info Box Builder
function buildOutputBox($boxSize, $label, $property){
  /*builds box for displaying user data, size is small, normal, large. $property is information you want to display, 
  most likely using the getProperty function*/
  $output = '<label>' . $label . '</label><div class="output-box-' . $boxSize .'"><p>' . $property . '</p></div>';
  return $output;
}

function createProfilePreview($user_id, $num){
  $user = getUserInfo($user_id);
  $userName = $user['user_id'];
  $school = getProperty($user['school_id'], "schools");
  $match = $user['match_description'];
  
  $output = "<div class=\"col-xs-6 col-sm-3 col-md-2 search-box-results\">\n";
  $output .= "\t\t <a href='profile-display.php?user_id=$userName'><img class=\"img-responsive img-circle\" src=\"img/placeholder-user.png\" alt=\"User Image\"/></a>\n";
  $output .= "\t\t <a href='profile-display.php?user_id=$userName'><h3>$userName</h3></a>\n";
  $output .= "\t\t <p>$school</p>\n";
  $output .= "\t\t <p>$match</p>\n";  
  $output .= "\t\t <p class='bg-primary' style='position: absolute; bottom: 0; left: 5; width: 93%;'>$num</p>\n";
  $output .= "\t\t</div>\n\t      ";
  return $output;
}

function createInterestPreview($user_id, $match){
  $user = getUserInfo($user_id);
  $userName = $user['user_id'];
  $school = getProperty($user['school_id'], "schools");
  $desc = $user['match_description'];
  if ($match == 1) {
    $highlight = "interest-match";
  }else{
    $highlight = "";
  }
  
  $output = "<div class=\"col-xs-12 col-sm-6 col-md-4 interest-box-results $highlight\">\n";
  $output .= "\t\t <a href='profile-display.php?user_id=$userName'><img class=\"img-responsive img-circle\" src=\"img/placeholder-user.png\" alt=\"User Image\"/></a>\n";
  $output .= "\t\t <a href='profile-display.php?user_id=$userName'><h4>$userName</h4></a>\n";
  $output .= "\t\t <p>$school</p>\n"; 
  $output .= "\t\t <a href=\"remove-interest.php?user_id=$userName\" class=\"btn btn-danger btn-xs\" role=\"button\">Remove</a>";  
  $output .= "\t\t</div>\n\t      ";
  return $output;
}

function createTableRowFlagged($offensive_user_id, $reporting_user_id, $report_date, $status ){
  $output = "";
  $output .= "\t<tr>";
  $output .= "\t  <td>$status</td>";
  $output .= "\t  <td><a href=\"profile-display.php?user_id=$offensive_user_id\">$offensive_user_id</a></td>";
  $output .= "\t  <td>$report_date</td>";
  $output .= "\t  <td><a href=\"profile-display.php?user_id=$reporting_user_id\">$reporting_user_id</a></td>";  
  $output .= "\t</tr>";
  return $output;
}

function createTableRowDisabled($user_id, $first_name, $last_name, $email){
  $output = "";
  $output .= "\t<tr>";
  $output .= "\t  <td><a href=\"profile-display.php?user_id=$user_id\">$user_id</a></td>";
  $output .= "\t  <td>disabled</td>";
  $output .= "\t  <td>$first_name</td>";
  $output .= "\t  <td>$last_name</td>";
  $output .= "\t  <td>$email</td>";
  $output .= "\t  <td style=\"text-align: center;\"><a href=\"user-enable.php?user_id=$user_id\" class=\"btn btn-success btn-xs\" role=\"button\">Enable User</a><a href=\"#\" class=\"btn btn-danger btn-xs\" role=\"button\">Delete User</a></td>";
  $output .= "\t</tr>";
  return $output;
}

function checkLoginStatus(){
  //Check if user is logged in
  if ($_SESSION['user_id'] == NULL || $_SESSION['user_type'] == "d") {
    header("Location: user-login.php");   
    exit;
  }
}

function checkPageNum($url){
  $page = substr(strstr($url, "?page"), 6);
  for ($i=0; $i <= 20; $i++) {   
    if ($page == $i) {
      $num = ($page * 10 - 10);
    }
    if ($page == 1 || $page == NULL) {
      $num = 0;
    }  
  }
  return $num;
}

function convert2ID($tableName){
  //Will need to add any additional search elements in the future
  $name = "";
  switch ($tableName) {
    case 'bodies':
      $name =  "body_id";
      break;
    
    case 'cities':
      $name =  "city_id";
      break;
    
    case 'ethnicity':
      $name =  "ethnic_id";
      break;
    
    case 'genders':
      $name =  "gender_id";
      break;

    case 'gender_sought':
      $name = "gender_id";
      break;
    
    case 'hair':
      $name =  "hair_id";
      break;

    case 'languages':
      $name =  "language_id";
      break;
    
    case 'religions':
      $name =  "religion_id";
      break;
    
    case 'schools':
      $name =  "school_id";
      break;

    case 'seeking':
      $name =  "seeking_id";
      break;
    
    case 'status':
      $name =  "status_id";
      break;

    case 'smoker':
      $name =  "smoker_id";
      break;

    default:      
      break;
  }
  return $name;
}

function createMatchDescription($firstName, $lastName, $age, $city, $school, $religion, $seeking){
  $output = "My name is " . $firstName . " " . $lastName . " and I am " . $age . " years old.";
  $output .= " I currently live in " . $city . " and attend " . $school . ".";
  $output .= "My religious belief is " . $religion . " and I a looking for a " . $seeking . ".";
}

function dump($arg){
	echo "<pre>";
	echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";
	echo (is_array($arg))? print_r($arg): $arg;
	echo "</pre>";
}
function displayCopyrightInfo(){ 
  echo "&copy; UniMeet. All rights reserved.";
}

/*
  this function should be passed a integer power of 2, and any 
  decimal number, it will return true (1) if the power of 2 is 
  contain as part of the decimal argument
*/
function isBitSet($power, $decimal) {
  if((pow(2,$power)) & ($decimal)) 
    return 1;
  else
    return 0;
} 

function pagination($totalRecords, $maxItemsPage, $page, $url = '?'){
  $total = $totalRecords;
  $minAdjacents = "4"; 
  $page = substr(strstr($page, "?page"), 6);
  $page = ($page == 0 ? 1 : $page);
  $start = ($page - 1) * $maxItemsPage;               
  $prev = $page - 1;              
  $next = $page + 1;
  $lastpage = ceil($total/$maxItemsPage);
  $lpm1 = $lastpage - 1;
  $pagination = ""; 
  //Textual Page Display
  if ($lastpage <= 1) {
    $pagination .= "<h2 style='margin-bottom: 5px; font-size: 1em; color: #428bca;'>Page $page of $lastpage ($total Matches)</h2>";//displays selected page as text
  }else{
    $pagination .= "<h2 style='margin-bottom: -15px; font-size: 1em; color: #428bca;'>Page $page of $lastpage ($total Matches)</h2>";//displays selected page as text    
  }  
  //Numerical Page Display
  if($lastpage > 1){  
    $pagination .= "<ul class='pagination'>";
    if ($page > 1){ 
      //Previous Button    
      $pagination.= "<li><a href='{$url}page=$prev' aria-label=\"Previous\"><span aria-hidden=\"true\">&laquo;</span></a></li>";
    }else{
      $pagination.= "<li class='disabled'><a aria-label=\"Previous\"><span aria-hidden=\"true\">&laquo;</span></a></li>";
    }  
    //Displaying for 10 pages or less  
    if ($lastpage < 7 + $minAdjacents){  
      for ($counter = 1; $counter <= $lastpage; $counter++){
        if($counter == $page){
          $pagination.= "<li class='current'><a class='btn-primary active'>$counter</a></li>";
        }else{
          if($counter == 1){
            $pagination.= "<li><a href='{$url}'>$counter</a></li>";
          }else{
            $pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";
          }
        }
      }
    }
    // Displaying for more than 10 pages
    elseif($lastpage > 4 + $minAdjacents){
      if($page < 1 + $minAdjacents){
        for ($counter = 1; $counter < 5 + $minAdjacents; $counter++){
          if($counter == $page){
            $pagination.= "<li><a class='btn-primary active'>$counter</a></li>";
          }else{
            if($counter == 1){
              $pagination.= "<li><a href='{$url}'>$counter</a></li>";
            }else{
              $pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";
            }
          }
        }
        $pagination.= "<li class='disabled'><a>...</a></li>";
        $pagination.= "<li><a href='{$url}page=$lpm1'>$lpm1</a></li>";
        $pagination.= "<li><a href='{$url}page=$lastpage'>$lastpage</a></li>";   
      }elseif($lastpage - $minAdjacents > $page && $page > $minAdjacents){
        $pagination.= "<li><a href='{$url}page=1'>1</a></li>";        
        $pagination.= "<li class='disabled'><a>...</a></li>";
        for ($counter = $page - $minAdjacents; $counter <= $page + $minAdjacents; $counter++){
          if($counter == $page){
            $pagination.= "<li><a class='btn-primary active'>$counter</a></li>";
          }else{
            if($counter == 1 || $counter == 2){
              continue;
            }else{
              $pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";
            }
          }
        }
        $pagination.= "<li class='disabled'><a>...</a></li>";
        $pagination.= "<li><a href='{$url}page=$lastpage'>$lastpage</a></li>";   
      }else{
        $pagination.= "<li><a href='{$url}page=1'>1</a></li>";
        $pagination.= "<li><a href='{$url}page=2'>2</a></li>";
        $pagination.= "<li class='disabled'><a>...</a></li>";
        for ($counter = $lastpage - (2 + $minAdjacents); $counter <= $lastpage; $counter++){
          if ($counter == $page){
            $pagination.= "<li><a class='btn-primary active'>$counter</a></li>";
          }else{
            if($counter == 1){
              $pagination.= "<li><a href='{$url}'>$counter</a></li>";
            }else{
              $pagination.= "<li><a href='{$url}page=$counter'>$counter</a></li>";
            }
          }
        }
      }
    }  
    if ($page < $counter - 1){ 
      //Next Button
      $pagination.= "<li><a href='{$url}page=$next' aria-label=\"Next\"><span aria-hidden=\"true\">&raquo;</span></a></li>";
    }else{
      $pagination.= "<li class='disabled'><a aria-label=\"Next\"><span aria-hidden=\"true\">&raquo;</span></a></li>";
    }
    $pagination.= "</ul>\n";    
  }
  return $pagination;
}

function generateRandomPassword() {
  $pass = "";
  srand();
  $characters = "abcdehmnprsuvwxyzABCDEFGHKLMNPRSTUVWXYZ1234567890";
 
  while(strlen($pass) < MAX_PASS) {
      $pass .= substr($characters, rand() % (strlen($characters)),1);
  }
  return $pass;
}

function recursiveDelete($target) {
  if (!file_exists($target)){ //no target, implies nothing to delete, function is done
    return true;
  }
  if (!is_dir($target)) {  //target is a file, not a directory, delete it with unlink() function
    return unlink($target); //will return false is Apache does not have write permissions in $target
  }
  
  $directoryContents = scandir($target); //target is a directory, get a list of files and directories inside the specified path as an array
  
  foreach ($directoryContents as $file) { //loop through the target's files and sub-directories
    echo "<br/>File/folder to be deleted: " . $file;
    if ($file == '..' || $file == '.') { //ignore parent and current diectories in file listing
      continue;
    }
    if (!recursiveDelete($target. "/" . $file)) {  //delete items, and sub-directories recursively
      return false;
    }
  }
  return rmdir($target); //delete the original target, now empty
}

/*Scans a directory returning an array of the files inside*/
function scanUserDirectory($path){
  /*Scan user directory and count number of current images, also removing any non image files*/
  $array = "";
  if (is_dir($path) == TRUE) {
    $array = scandir($path, SCANDIR_SORT_ASCENDING); 
    // if(!empty($array)){
    //   array_shift($array);
    //   array_shift($array);
    //   array_shift($array); /*Must be commented for opentech server*/
    // }
    array_shift($array);
    array_shift($array);
    array_shift($array); /*Must be commented for opentech server*/

  }  
  return $array;
}

//Takes a STRING as $prefix which identifies the cookie and and array 
function setMultipleCookie($prefix, $array){  
  foreach ($array as $key => $value) {
    if (trim($value) != "") {
      setcookie($prefix . "_" . $key, $value, COOKIE_EXPIRE);
      ob_end_flush();
    }    
  }  
}

/*
  this function can be passed an array of numbers 
  (like those submitted as part of a named[] check 
  box array in the $_POST array).
*/
function sumCheckBox($array){
  $num_checks = count($array); 
  $sum = 0;
  for ($i = 0; $i < $num_checks; $i++)
  {
    $sum += $array[$i]; 
  }
  return $sum;
}

//collects cookie data for user_id or displays blank login
function userLogin(){
  $output = "";
  if(isset($_COOKIE['user_id'])){
    $output .= "<input class='userName form-control' type='text' name='user_id' value='" . $_COOKIE['user_id'] . "' required/>\n"; 
    $output .= "\t\t\t\t<input class='password form-control' type='password' name='password' placeholder='Password' autofocus required/>\n";
  }else{ 
    $output .= "<input class='userName form-control' type='text' name='user_id' placeholder='Username' autofocus required/>\n";
    $output .= "\t\t\t\t<input class='password form-control' type='password' name='password' placeholder='Password' required/>\n";  
  }
  return $output;
}


?>