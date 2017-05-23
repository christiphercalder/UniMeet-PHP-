<?php
//URL Paths
define("BASE_URL", './');
define("BRAND_LOGO", "img/logo6.png");
define("IMAGE_FOLDER", "UniMeetProfileImages/");


//Constants
define("ADD_USERS", 500);// amount of random users to generate
define("BRAND_NAME", "UniMeet");
define("COOKIE_EXPIRE", time()+ 60*60*24*30);
define("MIN_AGE", time() - 60*60*24*365*18);//user age
define("MAX_AGE", time() - 60*60*24*365*40);//user age
define('MAX_PAGE_ITEMS', 10);//user results displayed per paginated page
define('MAX_IMAGE_PER_PAGE', 9);//profile images displayed per page
define("MIN_PASS", 6);//password length
define("MAX_PASS", 8);//password length
define("MAX_TABLE_PROPERTIES", 15);//maximum count of properties within a search related table
define('MAX_RESULTS', 200);//Maximum search results
define("MIN_USER", 6);//user_id length
define("MAX_USER", 20);//user_id length
define("MAX_USER_IMAGES", 15);//maximum allowed saved images per user
define("PLACEHOLDER", 0);//value_id of the placeholder within a database table
define("INCOMPLETE_USER", "i");
define("COMPLETE_USER", "c");
define("ADMIN_USER", "a");
define("DISABLED_USER", "d");
define("MAX_FILE_SIZE", 500000);
define("RESOLVED", "resolved");
define("UNRESOLVED", "un-resolved");

//add db connect info
define("DB_HOST", "localhost");
define("DB_NAME", "group19_db");
define("DB_USER", "group19_admin");
define("DB_PASSWORD", "wede19");

?>