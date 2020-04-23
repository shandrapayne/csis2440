<?php 
    // define constants
    define("HOST", "shandra.local");
    define("USER", "root");
    define("PASS", "pass");
    define("BASE", "palindromes");


    // make the connection
    $conn = mysqli_connect(HOST, USER, PASS, BASE) or die("Cannot connect: " .mysqli_connect_error());

    // write the query
    $sql = "SELECT * FROM palindrome;";

    // run command
    $results = mysqli_query($conn, $sql);

    // display data using a loop
   while($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
      echo $row['phrase'];
   }
    
    //close the connection
  mysqli_close($conn);
?>