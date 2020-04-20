<?php
//local
 if($_SERVER['HTTP_HOST'] = 'shandra.local') {
  $host = 'localhost';
  $db = 'fakelogin';
  $user = 'csis2440';
  $pass = 'phpisfun';

}
else {
   //  remote 
   define("HOST", "us-cdbr-iron-east-01.cleardb.net");
   define("USER", "bd7ee90e2e8fb0");
   define("PASS", "39f5d588");
   define("BASE", "heroku_f74f2d48b74cb67");
 
}

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if (mysqli_connect_error()) {
  die("Database connection failed: " . mysqli_connect_error());
} else {
echo "Connected successfully";
}

  $sql = "SELECT * FROM users";
  $result = $conn->query($sql);
  $credentials = array();
  while($row = $result->fetch_assoc()) {
    array_push($credentials, $row);

  }


 foreach ($credentials as $cred) 
     { 
        $usr = $cred['username'];
        $pwd = $cred['password'];
        $item = array(
          'username' => $usr,
          'password' => $pwd
        );
        $userPassPairArr[] = $item;
     }

     var_dump($userPassPairArr);

  $conn->close();
?>