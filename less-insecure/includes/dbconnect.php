<?php 

    // define constants
    if($_SERVER['HTTP_HOST'] = 'shandra.local') {
      define("HOST", "shandra.local");
      define("USER", "csis2440");
      define("PASS", "phpisfun");
      define("BASE", "fakelogin");

      $conn = new mysqli(HOST, USER, PASS, BASE);
    }
    else {
      $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
      // new remote
     
      $server = $url["host"];
      $username = $url["user"];
      $password = $url["pass"];
      $db = substr($url["path"], 1);

    $conn = new mysqli($server, $username, $password, $db);
 
    }

    // Check connection
if (mysqli_connect_error()) {
  die("Database connection failed: " . mysqli_connect_error());
}
