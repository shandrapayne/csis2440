<?php
include_once('includes/dbconnect.php');
$emptyErr = '';
$emptyFields = false;

if ($_POST) {
  if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $getUsr = getUserPassPair();
    list($valid, $errCode) = checkCredentials($username, $password, $getUsr);
    $access = accessCheck($valid);
    $errMess = getErrors($errCode);
  }
  if (empty($_POST['username'])) {
    $emptyFields = true;
    $emptyErr .= '<p class="info">Please fill out your username.</p>';
  }
  if (empty($_POST['password'])) {
    $emptyFields = true;
    $emptyErr .= '<p class="info">Please fill out your password.</p>';
  }
}


function getUserPassPair()
{
  global $conn;
 
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

  
     $conn->close();

  return $userPassPairArr;
}

function checkCredentials($username, $password, $credentialsArr)
{
  $username = $_POST['username'];
  $password = $_POST['password'];
  $validity = false;
  $err = 0;

  foreach ($credentialsArr as $credential) {
    if ($credential['username'] == $username && $credential['password'] == $password) {
      $validity = true;
    }
    if ($credential['username'] == $username && $credential['password'] != $password) {
      $err = 1;
    }
    if ($credential['username'] != $username && $credential['password'] == $password) {
      $err = 2;
    }
  }
  return array($validity, $err);
}


function accessCheck($valid)
{
  if ($valid == true) {
    $confirm = '<p class="granted">Access Granted!</p>';
  } else {
    $confirm = '<p class="denied">Access Denied!</p>';
  }
  return $confirm;
}


function getErrors($err)
{
  switch ($err) {
    case 1:
      $errMessage = '<p class="err-message">The password you entered does not match our records.</p>';
      break;
    case 2:
      $errMessage = '<p class="err-message">The username you entered does not match our records.</p>';
      break;
  }
  return $errMessage;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Less-Insecure</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link type="text/css" rel="stylesheet" href="css/style.css">
</head>

<body>
  <div id="header">
    <h1>Less-Insecure (but still terrible) Login Form</h1>
  </div>
  <div class="container">
    <?php if ($_POST && $valid == true) { ?>
      <div class="login-form hidden">
      <?php } else { ?>
        <div class="login-form">
        <?php } ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="username">Username:</label>
              <input type="text" class="form-control" name="username" id="username" value="<?php echo isset($_POST['username']) ? ($_POST['username']) : ''; ?>">
            </div>
            <div class="form-group col-md-6">
              <label for="password">Password:</label>
              <input type="password" class="form-control" name="password" id="password" value="<?php echo isset($_POST['password']) ? ($_POST['password']) : ''; ?>">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>

        </div> <!-- end of login form -->
        <?php if ($emptyFields || $errMess) { ?>
          <div class="errors">
            <?php if ($emptyErr != '') {
              echo $emptyErr;
            } ?>
            <br />
            <?php if (!$valid) {
              echo $errMess;
              echo $access;
            } ?>
          </div> <!-- end of errors-->
        <?php } else { ?>

          <div class="confirmation">
            <?php echo $access; ?>

          </div><!-- end of confirmation -->
        <?php } ?>
      </div>
</body>

</html>