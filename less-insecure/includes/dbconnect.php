<?php 
// **********************************************
// START Database connection and Configuration
// **********************************************

// set a default environment
$WEBSITE_ENVIRONMENT = "Development";

// detect the URL to determine if it's development or production
if(stristr($_SERVER['HTTP_HOST'], 'shandra.local') === FALSE) $WEBSITE_ENVIRONMENT = "Production";

// value of variables will change depending on if Development vs Production
if ($WEBSITE_ENVIRONMENT =="Development") {
  $host 		= "localhost";
	$user 		= "csis2440";
	$password 	= "phpisfun";
	$database 	= "fakelogin";
	
	define("APP_ENVIRONMENT", "Development");
	define("APP_BASE_URL", "http://shandra.local");
	error_reporting(E_ALL ^ E_NOTICE); // turn ON showing errors

} else {
  $cleardb_url 		= parse_url(getenv("CLEARDB_DATABASE_URL"));
	$host				= $cleardb_url["host"];
	$user 				= $cleardb_url["user"];
	$password			= $cleardb_url["pass"];
	$database 			= substr($cleardb_url["path"],1);

 
  define("APP_ENVIRONMENT", "Production");
	define("APP_BASE_URL", "http://aqueous-oasis-06069.herokuapp.com/less-insecure");
	#error_reporting(0); // turn OFF showing errors
	error_reporting(E_ALL ^ E_NOTICE); // turn ON showing errors			

}


// connect to the database server
$conn = new mysqli($host, $user, $password) or die("Could not connect to database");

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();

}
// **********************************************
// END Database connection and Configuration
// **********************************************
?>