<?php 

##### note: this is just an outline of one way to connect to a database.

    // define constants
    if($_SERVER['HTTP_HOST'] = 'localhost') {
      define("HOST", "localhost");
      define("USER", "");
      define("PASS", "");
      define("BASE", "");
    }
    else {
      
      //  remote 
      define("HOST", "");
      define("USER", "");
      define("PASS", "");
      define("BASE", "");
    }

    // make the connection
    $conn = new mysqli(HOST, USER, PASS, BASE);

    // Check connection
if (mysqli_connect_error()) {
  die("Database connection failed: " . mysqli_connect_error());
} 

?>