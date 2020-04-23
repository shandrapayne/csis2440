<?php 

    // define constants
    if($_SERVER['HTTP_HOST'] = 'shandra.local') {
      define("HOST", "shandra.local");
      define("USER", "csis2440");
      define("PASS", "phpisfun");
      define("BASE", "fakelogin");
    }
    else {
      // new remote
      define("HOST", "us-cdbr-iron-east-01.cleardb.net");
      define("USER", "b8398e9ff06a1e");
     define("PASS", "25d52e09");
     define("BASE", "heroku_cea6671c481383f");
      //  old remote 
     // define("HOST", "us-cdbr-iron-east-01.cleardb.net");
    //  define("USER", "bd7ee90e2e8fb0");
    //  define("PASS", "39f5d588");
     // define("BASE", "heroku_f74f2d48b74cb67");
    }

    // make the connection
    $conn = new mysqli(HOST, USER, PASS, BASE);

    // Check connection
if (mysqli_connect_error()) {
  die("Database connection failed: " . mysqli_connect_error());
} 

?>