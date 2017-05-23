<?php
include_once '../inc/constants.php';
include_once '../inc/db.php';
include_once 'names.txt';
include_once 'fieldsOfStudy.txt';
include_once '../inc/functions.php';



//Insert Users table statement

$usersTableStatement = "INSERT INTO users(
	user_id, 
	password, 
	user_type, 
	email_address, 
	first_name, 
	last_name, 
	birth_date, 
	enroll_date, 
	last_access
	) VALUES($1,'5f4dcc3b5aa765d61d8327deb882cf99',$2,$3,$4,$5,$6,$7,NULL)";

//Insert Profiles table statement
$profilesTableStatement = "INSERT INTO profiles(
	user_id, 
	gender_id, 
	gender_sought, 
	city_id, 
	school_id, 
	study_major, 
	images, 
	head_line, 
	self_description,
	match_description, 
	hair_id, 
	body_id, 
	smoker_id, 
	ethnic_id, 
	language_id, 
	status_id,
	seeking_id,
	religion_id, 
	education_id) VALUES($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13,$14,$15,$16,$17,$18,$19)";




/*---------Loop runs and creates the amount of users specified in the ADD_USERS constant------*/

for ($i=0; $i < ADD_USERS; $i++) { 

	/*-------------------------------------Table information-----------------------------------*/
															
						/*------------------------------Table users-----------------------------*/
	//Gender and Name
	$gender_id = rand(1,2);	
	if ($gender_id == 1) {
		//Male first name
		$count = count($male_names);
		$random = rand(0, $count);
		$first_name = ucfirst(strtolower($male_names[$random]));
	}else{
		//Female first name
		$count = count($female_names);
		$random = rand(0, $count);
		$first_name = ucfirst(strtolower($female_names[$random]));
	}

	//Last name
	$count = count($last_names);
	$random = rand(0, $count);
	$last_name = ucfirst(strtolower($last_names[$random]));

	//User ID
	$user_id = strtolower($first_name) . rand(10, 1000); //first name + random number between 10 and 1000

	//User Type
	$typeArray = array( "c", "c", "c", "c", "c", "c", "c", "c", "i", "i", "d",);
	$user_type = $typeArray[mt_rand(0, count($typeArray)-1)];
	
	//Email
	$count = count($email_domains) - 1;
	$random = rand(0, $count);
	$email_address = $user_id . $email_domains[$random]; //user_id@......com

	//Birth Date
	$birth_date = rand(MIN_AGE, MAX_AGE); //Random date between 18 yrs ago and 40 yrs ago
	$birth_date = date('Y-m-d', $birth_date);

	//Enroll Date
	$enroll_date = rand(time(), time() - 60*60*24*30); //Random date between today and 1 month ago
	$enroll_date = date('Y-m-d', $enroll_date);	

										/*--------------------Table profile-------------------------*/ 
	
	/*Numerical values*/

	/*gender_sought , city_id , school_id ,study_major ,images , head_line , self_description ,
	match_description ,hair_id , body_id , smoker_id , ethnic_id , language_id , status_id , seeking_id ,
	religion_id , education_id */

	$body_id = getRandomValue("bodies");
	$city_id = getRandomValue("cities");
	$education_id = getRandomValue("education");// This is probably going to be removed
	$ethnic_id = getRandomValue("ethnicity");
	$gender_sought = getRandomValue("gender_sought");
	$hair_id = getRandomValue("hair");
	$language_id = getRandomValue("languages");//needs to be adjusted for secondary language
	$religion_id = getRandomValue("religions");
	$school_id = getRandomValue("schools");
	$seeking_id = getRandomValue("seeking");
	$status_id = getRandomValue("status");
	$smoker_id = getRandomValue("smoker");
	$images = 0; // default for no images

	

										/*Text values*/
	//Fields of Study
	$key = rand(0, count($fieldsOfStudy) - 1);
	shuffle($fieldsOfStudy);
	$study_major = $fieldsOfStudy[$key];
	//Eventually these will be more detailed 
	$head_line = "This is a Headline";
	$self_description = "I like etc...";
	$match_description = "Hi my name is " . $first_name . " " . $last_name;

	//insert query for users table
	$result = pg_prepare($conn, "", $usersTableStatement);
	$result = pg_execute($conn, "", array($user_id, $user_type, $email_address, $first_name, $last_name, $birth_date, $enroll_date));

	if ($user_type !== "i") {
		//insert query for profiles table
		$result = pg_prepare($conn, "", $profilesTableStatement);
		$result = pg_execute($conn, "", array($user_id, $gender_id, $gender_sought, $city_id, $school_id, $study_major, $images, $head_line, $self_description, $match_description, $hair_id, $body_id, $smoker_id, $ethnic_id, $language_id, $status_id, $seeking_id, $religion_id, $education_id));

	}
	
	/*Uncomment this for testing and comment out the inserts above*/
	// $personArray =array(
	// 	$user_id,
	// 	$user_type, 
	// 	$email_address, 
	// 	$first_name, 
	// 	$last_name, 
	// 	$birth_date, 
	// 	$enroll_date,
	// 	$gender_id, 
	// 	$gender_sought, 
	// 	$city_id, 
	// 	$school_id, 
	// 	$study_major, 
	// 	$images, 
	// 	$head_line, 
	// 	$self_description, 
	// 	$match_description, 
	// 	$hair_id, 
	// 	$body_id, 
	// 	$smoker_id, 
	// 	$ethnic_id, 
	// 	$language_id, 
	// 	$status_id, 
	// 	$seeking_id, 
	// 	$religion_id, 
	// 	$education_id);
	// $testArray[] = $personArray;
	
}
//dump($testArray);
?>