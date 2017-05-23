<?php

//Establish connection
function db_connect()
{
	$connString = "host=" . DB_HOST . " port=5432 dbname=" . DB_NAME . " user=" . DB_USER . " password=" . DB_PASSWORD;

	$conn = pg_connect($connString);

	if ($conn == FALSE) {
		dump($conn);
		die("Sorry, Couldn't Connect to the Database");
	}
	return $conn;
}
$conn = db_connect();

/*------Statements--------*/
$query1 = pg_prepare($conn, "check_interest", "SELECT * FROM interests WHERE user_id=$1 AND profile_of_interest=$2");
$query2 = pg_prepare($conn, "check_offensives", "SELECT * FROM offensives WHERE offensive_user_id=$1 AND status=$2");
$query3 = pg_prepare($conn, "delete_interest", "DELETE FROM interests WHERE user_id=$1 AND profile_of_interest=$2");
$query4 = pg_prepare($conn, "disabled_users", "SELECT user_id, email_address, first_name, last_name FROM users WHERE user_type=$1");
$query5 = pg_prepare($conn, "flagged_users", "SELECT * FROM offensives WHERE status=$1");
$query6 = pg_prepare($conn, "interested_in_user", "SELECT * FROM interests WHERE profile_of_interest=$1");
$query7 = pg_prepare($conn, "user_interests", "SELECT * FROM interests WHERE user_id=$1");

function addInterest($interestedUser, $userOfInterest){
  global $conn;
  $query = pg_execute($conn, "check_interest", array($interestedUser, $userOfInterest));
  if (pg_num_rows($query) == TRUE) {    
    $_SESSION['info_message'] = "You have already shown interest in this person";
    $_SESSION['requested_action'] = "error"; 
    header("Location: profile-display.php?user_id=$userOfInterest");
  }else{
    $insert = pg_prepare($conn, "add_interest", "INSERT INTO interests(user_id, profile_of_interest) VALUES($1, $2)");
    $insert = pg_execute($conn, "add_interest", array($interestedUser, $userOfInterest));    
    return TRUE;
  }  
}

function checkInterest($interestedUser, $userOfInterest){
  global $conn;
  $result = pg_execute($conn, "check_interest", array($interestedUser, $userOfInterest));
  if (pg_num_rows($result) == 0) {
    return 0;
  }else{
    return 1;
  }  
}

function checkOffensives($flagged_user, $status){
  global $conn;  
  $result = pg_execute($conn, "check_offensives", array($flagged_user, $status));
  if (pg_num_rows($result) == 0) {
    return 0;
  }else{
    return 1;
  }  
}

function removeInterest($interestedUser, $userOfInterest){
  global $conn;
  // $query = pg_prepare($conn, "delete_interest", "DELETE FROM interests WHERE user_id=$1 AND profile_of_interest=$2");
  $delete = pg_execute($conn, "delete_interest", array($interestedUser, $userOfInterest));
  if(!pg_num_rows($delete)){
    return 1;
  }else{
    return 0;
  }  
}
function searchDisabledUsers(){
  global $conn;
  $result = pg_execute($conn, "disabled_users", array(DISABLED_USER));
  $array = pg_fetch_all($result);  
  return $array;
}

function searchFlaggedUsers($status){
  global $conn;
  $result = pg_execute($conn, "flagged_users", array($status));
  $array = pg_fetch_all($result);  
  return $array;
}

function collectInterests($user_id){
  global $conn;
  $result = pg_execute($conn, "user_interests", array($user_id));
  $array = pg_fetch_all($result);
  foreach ($array as $key => $value) {
    $array[$key] = $value['profile_of_interest'];
  } 
  return $array;
}

function collectProfilesInterested($user_id){
  global $conn;
  $result = pg_execute($conn, "interested_in_user", array($user_id));
  $array = pg_fetch_all($result);
  foreach ($array as $key => $value) {
    $array[$key] = $value['user_id'];
  } 
  return $array;
}


//function for form dropdown with $pre_selected as argument for stickiness
function buildDropDown($tableName, $pre_selected)  {
	//query to array

	global $conn;
  
  $result = pg_prepare($conn, "", 'SELECT * FROM ' . $tableName);
  $result = pg_execute($conn, "", array());
  $array = pg_fetch_all($result);
  // Removing the first value of the array witch is the label or placeholder for each table  
  $label = array_shift($array);  
  $label = $label['property'];

  $output = "<option class='selectOptions' value='' selected disabled>" . $label . "</option>";
  if (!empty($result)) {
    //Fill dropdown
    foreach ($array as $entry) {
      $selected = ($pre_selected == $entry['value_id'])?" selected=\"selected\"":"";

      $output .= "\n\t\t\t<option class='selectOptions' id='selects' value='" . $entry['value_id'] . "'" . $selected . ">" . $entry['property'] . "</option>";
    }
    return $output .= "\n";
    $result = "";
  }
}

//function for form radio input with $pre_selected as argument for stickiness
function buildRadio($tableName, $pre_selected = ""){
  //query to array

  global $conn;  
  $result = pg_prepare($conn, "", 'SELECT * FROM ' . $tableName);
  $result = pg_execute($conn, "", array());
  $array = pg_fetch_all($result); 
  //Removing the first value of the array witch is the label or placeholder for each table
  $label = array_shift($array);
  $label = $label['property'];
  $output = "<label>" . $label ."</label>";
  $name = rtrim($tableName, "s") . "_id";
  if ($tableName == "gender_sought") {
    $name = "gender_sought";
  }
  $required = "";
  if ($name == "gender_id" || $name == "gender_sought") {
    $required = "required";
  }
  if (!empty($result)) {
    //Fill dropdown
    foreach ($array as $entry) {
      if (!isset($_POST) and $entry['value_id'] == 1){
        $selected = "checked";
      }else{
        $selected = ($pre_selected == $entry['value_id'])?"checked":"";
        // $selected = "";
      }
      $output .= "\n\t\t\t<input type='radio' name='" . $name . "' value='" . $entry['value_id'] . "' " . $selected . " " . $required . "> " . $entry['property'] . " </input>";
    }    
    return $output .= "\n";
  }
}

//function for form checkbox with $pre_selected as argument for stickiness
function buildCheckbox($tableName, $pre_selected){
  //query to array
  global $conn;  
	$result = pg_prepare($conn, "", 'SELECT * FROM ' . $tableName);
  $result = pg_execute($conn, "", array());  
  $array = pg_fetch_all($result);
  //Removing the first value of the array witch is the label or placeholder for each table
  $label = array_shift($array);
  $label = $label['property'];    
  $important = $required = "";
  
  if ($tableName == "seeking" || $tableName == "gender_sought" || $tableName == "status") {    
    $important = "<span style='color:red;'>* </span>"; 
    // $required = "required";
  }
  $output = "  <div class='col-md-12 text-center'><label>" . $important . $label . "</label></div>";
  $output .= "\n\t\t  <ul>";
  if ($tableName == "cities") {
    $output .= "\n\t\t    <li style='list-style:none;'>";
    $output .= "\n\t\t      <input type=\"checkbox\"  id=\"city_toggle\" onclick=\"cityToggleAll();\" name=\"city[]\" value=\"0\"><span class='text-danger'><b>All Cities</b></span></input>"; 
    $output .= "\n\t\t    </li>";
  }
  if (!empty($result)) {
    $i = 0;
    //Fill dropdown
    $count = count($array);
    $sum = $pre_selected;
    $name = convert2ID($tableName);
    foreach ($array as $entry){ 
      $var = isBitSet($i, $sum);       
      $selected = ($var == TRUE)?" checked=\"checked\"":"";      
      $output .= "\n\t\t    <li style='list-style:none;'>";
      $output .= "\n\t\t      <input type='checkbox' id='" . $name . "' name='" . $name . "[]' value='" . $entry['value_id'] . "' " . $selected . " " . $required . "/>" . $entry['property'] . "";
      $output .= "\n\t\t    </li>";
      $i++;
    }    
    return $output .= "\n\t\t  </ul>\n";
  }
}

//function that ensures user_id has not already been taken
function checkUserName($user_id){
  global $conn;
  $result = pg_prepare($conn, "", 'SELECT * FROM users WHERE user_id = $1');
  $result = pg_execute($conn, "", array($user_id));  
  $rows = pg_num_rows($result);
  if ($rows == 1) {
    return FALSE;
  }else{
    return TRUE;
  }
}

function setUserType($user_id, $user_type){
  global $conn;
  $query = pg_prepare($conn, "enable_user", "UPDATE users SET user_type=$1 WHERE user_id=$2");
  $result = pg_execute($conn, "enable_user", array($user_type, $user_id));
}

function flagUser($user_id, $flagged_user, $time){
  global $conn;
  $result = pg_prepare($conn, "flag_user", "INSERT INTO offensives(offensive_user_id, reporting_user_id, report_date, status) VALUES($1, $2, $3, $4)");
  $result = pg_execute($conn, "flag_user", array($flagged_user, $user_id, $time, UNRESOLVED));

}

//function for displaying user information, boxsizes are small, normal, large.
function getProperty($propertyID, $tableName){
  //query to array
  global $conn;   
	$result = pg_prepare($conn, "", "SELECT property FROM " . $tableName . " WHERE value_id = '" . $propertyID . "'");
  $result = pg_execute($conn, "", array());
  $value = pg_fetch_result($result, 0, 'property');
  
  return $value;
}

//function that returns a random value....used in userGenerator
function getRandomValue($tableName){
  global $conn;
  $result = pg_prepare($conn, "", 'SELECT * FROM ' . $tableName);
  $result = pg_execute($conn, "", array());
  $array = pg_fetch_all($result);
  $removePlaceholder = array_shift($array);
  // Removing the first value of the array witch is the label or placeholder for each table  
  shuffle($array);
  $value = array_shift($array);
  return $value['value_id'];
}

// Takes a user ID and returns their user and profile information as an array
function getUserInfo($user_id){
  global $conn;
  $result = pg_prepare($conn, "", 'SELECT * FROM profiles WHERE user_id = $1');
  $result = pg_execute($conn, "", array($user_id));
  $user = pg_fetch_assoc($result);
  $result = pg_query($conn, "SELECT * FROM users WHERE user_id ='" . $user_id . "'");
  $user = array_merge(pg_fetch_assoc($result), $user);
  return $user;
}

// update a users image count
function imageCountUpdate($num, $user){
  global $conn;
  
  $update = pg_prepare($conn, "profile_image_update", "UPDATE profiles SET images = $1 WHERE user_id = $2");
  $update = pg_execute($conn, "profile_image_update", array($num, $user_id));
}

//lastAccess function that updates the users last_access field
function lastAccess(){
  date_default_timezone_set('America/Toronto');
  $time = date('Y-m-d');  
  // $statement = "UPDATE users SET last_access = " . $time . " WHERE user_id = '" . $_SESSION['user_id'] . "'";
  global $conn;
  $update = pg_prepare($conn, "user_update", "UPDATE users SET last_access = $1 WHERE user_id = $2");
  $update = pg_execute($conn, "user_update", array($time, $_SESSION['user_id']));
}
function updateOffensiveStatus($status, $user_id){
  global $conn;
  $query = pg_prepare($conn, "offensive_update", "UPDATE offensives SET status=$1 WHERE offensive_user_id=$2");
  $result = pg_execute($conn, "offensive_update", array($status, $user_id));
}

/*funtion that collects user search options and searches all site users 
  returning an array of userID's*/
function searchUsers($array){    
  
  $statement1 = "SELECT profiles.user_id FROM profiles, users WHERE 1 = 1";
  $statement2 = " AND profiles.gender_sought= " . $_SESSION['gender_id'];
  foreach ($array as $key => $sum) {
    if(!empty($sum)){
      $statement2 .= " AND (";
      $value = "";      
      for($i=0; $i <= MAX_TABLE_PROPERTIES; $i++) { 
        $var = isBitSet($i, $sum); 
        $value = pow(2, $i);     
        if($var == TRUE){     
          $statement2 .= "profiles." . $key . " = " . $value . " OR ";
        }
      }  
      $statement2 = substr($statement2, 0, (strlen($statement2) - 4));
      $statement2 .= ") ";
    }

  }
  $statement3 = "AND users.user_id = profiles.user_id AND users.user_type <> 'd' AND users.user_id <> '" . $_SESSION['user_id'] . "' ORDER BY users.last_access DESC LIMIT " . MAX_RESULTS;
  $search = $statement1 . $statement2 . $statement3;
  // return $search;//testing the statement
  global $conn;
  $result = pg_query($conn, $search); 
  $matches = pg_fetch_all($result);
  // $matches = pg_num_rows($result);
  $x = 0;
  if (!empty($matches)) {
    foreach ($matches as $key => $value) {
    $match[] = $matches[$key]['user_id'];
    $x++;
    }
  }else{
    $match = FALSE;
  }
  
  return $match;
}

//storeNewUserInfo function that takes any user data input and stores it in the appropriate db tables
function storeNewUserInfo($array){
  global $conn;  
  $insert = pg_prepare($conn, "new_user_insert", "INSERT INTO users VALUES($1, $2, $3, $4, $5, $6, $7, $8, $9)");
  $insert = pg_execute($conn, "new_user_insert", array($array['user_id'], $array['password'], INCOMPLETE_USER, $array['email_address'], $array['first_name'], $array['last_name'], $array['birth_date'], date('Y-m-d'), date('Y-m-d')));
}

//function that takes NEW user data input and stores it in the appropriate db tables
function storeNewProfileInfo($array){
  global $conn;

  $sqlUserUpdate = "";
  $sqlProfileInsert1 = "";
  $sqlProfileInsert2 = "";
  /*Possibly change to an array function that looks for the profiles table fields, and
    pulls them into array2*/
  $array2 = array_splice($array, 5);
  // $i = 1;
 
  foreach($array as $field=>$data){    
    $sqlUserUpdate .= $field . "='" . $data . "', ";
    // $sqlUserUpdate .= $field . "=$" . $i . ", ";
    // $i++; //iterate the number
  }
  foreach($array2 as $field=>$data){   
    $sqlProfileInsert1 .= $field . ", ";
    $sqlProfileInsert2 .= "'" . $data . "', ";  
  }  

  $sqlUserUpdate = substr($sqlUserUpdate, 0, (strlen($sqlUserUpdate) - 2)); //remove trailing comma,
  $sqlProfileInsert1 = substr($sqlProfileInsert1, 0, (strlen($sqlProfileInsert1) - 2)); //remove trailing comma,
  $sqlProfileInsert2 = substr($sqlProfileInsert2, 0, (strlen($sqlProfileInsert2) - 2)); //remove trailing comma,
  $sqlUserUpdate = "UPDATE users SET " . $sqlUserUpdate . " WHERE user_id = '" . $_SESSION['user_id'] . "';";
  $sqlProfileInsert = "INSERT INTO profiles(user_id, " . $sqlProfileInsert1 . ") VALUES('" . $_SESSION['user_id'] . "', " . $sqlProfileInsert2 . ");";
  $update = $sqlUserUpdate . $sqlProfileInsert;
//Testing the statement ouptut
  // return $sqlUserUpdate;
  // return $sqlProfileInsert;  

//Store profile data
  pg_query($conn, $update);
  //update SESSION with new user info
  $_SESSION = array_merge($_SESSION, $array);
  $_SESSION = array_merge($_SESSION, $array2);

  // $update1 = pg_prepare($conn, "update", $sqlUserUpdate);  
  // $update1 = pg_execute($conn, "update", $array);
  // $update2 = pg_prepare($conn, "", "INSERT INTO profiles(user_id, " . $sqlProfileInsert1 . ") VALUES('" . $_SESSION['user_id'] . "', " . $sqlProfileInsert2 . ")");
  // $update2 = pg_execute($conn, "", $array2);
}

//function that takes user data input and updates it in the appropriate db tables
function updateProfileInfo($array){
  global $conn;

  $sqlUserUpdate = "";
  $sqlProfileUpdate = "";  
  /*Possibly change to an array function that looks for the profiles table fields, and
    pulls them into array2*/
  $array2 = array_splice($array, 5);
  
 
  foreach($array as $field=>$data){    
    $sqlUserUpdate .= $field . "='" . $data . "', ";    
  }

  foreach($array2 as $field=>$data){   
    $sqlProfileUpdate .= $field . "='" . $data . "', ";     
  }  

  $sqlUserUpdate = substr($sqlUserUpdate, 0, (strlen($sqlUserUpdate) - 2)); //remove trailing comma,
  $sqlProfileUpdate = substr($sqlProfileUpdate, 0, (strlen($sqlProfileUpdate) - 2)); //remove trailing comma,
  $sqlUserUpdate = "UPDATE users SET " . $sqlUserUpdate . " WHERE user_id = '" . $_SESSION['user_id'] . "';";
  $sqlProfileUpdate = "UPDATE profiles SET " . $sqlProfileUpdate . " WHERE user_id = '" . $_SESSION['user_id'] . "';";
  $update = $sqlUserUpdate . $sqlProfileUpdate;
//Testing the statement ouptut
  // return $sqlUserUpdate;
  // return $sqlProfileUpdate;  
  // return $update;  

//Store profile data
  pg_query($conn, $update);// was having issues with a prepared statement so i chose to use this method instead
  //update SESSION with new user info
  $_SESSION = array_merge($_SESSION, $array);
  $_SESSION = array_merge($_SESSION, $array2);
}

function updateProfileImage($image){
  global $conn;
  $update = "UPDATE profiles SET profile_image='" . $image . "' WHERE user_id = '" . $_SESSION['user_id'] . "';";
  // return $update;
  pg_query($conn, $update);
}

function updateImageCount($count, $user_id){
  global $conn;
  $update = "UPDATE profiles SET images='" . $count . "' WHERE user_id = '" . $user_id . "';";
  // return $update;
  pg_query($conn, $update);
}
 function updatePassword($new_pass, $user_id){
  global $conn;
  $stmtUpdate = pg_prepare($conn, "request_password_update", 'UPDATE users SET password = $1 WHERE user_id = $2');
  $result = pg_execute($conn, "request_password_update", array($new_pass, $user_id));
}

/*FUNCTION FOR TESTING PURPOSES*/
function generateInterests(){
  global $conn;
  $query = pg_prepare($conn, "all_complete_users", "SELECT user_id FROM users WHERE user_type=$1");
  $query = pg_execute($conn, "all_complete_users", array(COMPLETE_USER));
  //more here
  $users = pg_fetch_all($query);
  foreach ($users as $key => $value) {
    $users[$key] = $value['user_id'];
  }  
  $usersTest = $users;
  // $usersTest = array_slice($users, 0, 10);
  $result = array();    
    
  $insert = pg_prepare($conn, "add_interest", "INSERT INTO interests(user_id, profile_of_interest) VALUES($1, $2)");
  $a = 0;//testing
  foreach ($usersTest as $key => $value) {
    $interests = array();
    for ($i=0; $i < 10; $i++) { 
      $userOfInterest = $users[mt_rand(0, count($users)-1)];
      if ($userOfInterest == $value) {
        $userOfInterest = $users[mt_rand(0, count($users)-1)];
      }elseif ($userOfInterest == array_search($userOfInterest, $interests)) {
        $userOfInterest = $users[mt_rand(0, count($users)-1)];
      }
      $interests[$i] = $userOfInterest;      
    }
    for ($i=0; $i < 10; $i++) { 
      /*-------TESTING-------*/
      $insert = pg_execute($conn, "add_interest", array($value, $interests[$i]));
      // $output = $value . " => " . $interests[$i];
      // $result[$a] = $output;
      // $a++;
    }
  }  
  /*-------TESTING-------*/
  // return $result;
  // return $usersTest;
}

?>