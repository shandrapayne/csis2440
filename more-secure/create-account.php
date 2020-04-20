<?php
include_once('includes/dbconnect.php');

## vars
$errorsExist = false;

### Functions ###

// query database to see if user already exists
function uniqueUsername($usr) {
    global $conn;
    $isUnique = true;
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    $credentials = array();
    while($row = $result->fetch_assoc()) {
      array_push($credentials, $row);
    }
  
    $existingUsers = array();
    foreach($credentials as $cred) {
        array_push($existingUsers, $cred['username']);
    }

    foreach($existingUsers as $eu) {
    if($usr == $eu) {
        $isUnique = false;
    }

    return $isUnique;
    }
}

// check the secret code 
function codeValid($code) {
 global $conn;
  $validCode = false;
  $sql = "SELECT * FROM code";
    $result = $conn->query($sql);
    // does code match?
    if($code == $result) {
        $validCode = true;
    }

    return $validCode;
}

// hash & salt password
function encryptPass($pwd)
{
    $pwdHash = password_hash(
        $pwd,
        PASSWORD_BCRYPT
    );
    return $pwdHash;

}

// insert into db if user doesn't exist yet & no errors
function createAccount($usr, $passHash) {
    global $conn;
    $createAccount = mysqli_query($conn, "INSERT INTO accounts (username, pwd) VALUES ('$usr', '$passHash')");
  
    return $createAccount;
    
}

// error handling
function errorHandling($validCode, $uniqUser) {
    $error = "Error: ";

    if($validCode != true) {
        $error .= "\n The code you entered is incorrect!";
    }

    if($uniqUser != true) {
        $error .= "\n The username you entered already exists. Please create a new one.";
    }
   
    return $error;
}



### Post form ###
if (empty($_POST)) {
    //  display regular version of page because they haven't submitted form yet
} else if (!empty($_POST['username']) && !empty($_POST['pass']) && !empty($_POST['code'])) {
    // all fields have been filled out so  display graphs
    $completedForm = true;

    $username = $_POST['username'];
    $isUniqueUser = uniqueUsername($username);

    $password = $_POST['pass'];
    $hashedP = encryptPass($password);

    $code = $_POST['code'];
    $codeValid = codeValid($code);

    // if username unique and code valid : insert into database
    if(($isUniqueUser == true) && ($codeValid == true)) {
        $accountCreated = createAccount($username, $hashedP);
    } else {
        $getErrors = errorHandling($isUniqueUser, $codeValid);
    }

} else {
    $errorsExist = true;
    // show errors
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>More Secure</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/script.js"></script>
</head>

<body>
    <div id="header">
        <h1>Create Account</h1>
    </div>
    <div class="container">
        <div class="create-account-form">
        <form>
            <div class="form-row">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Email">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="pass">Password</label>
                    <input type="password" class="form-control" id="pass" placeholder="Password">
                </div>
                <div class="form-group col-md-6">
                    <label for="verify-pass">Verify Password</label>
                    <input type="password" class="form-control" id="verify-pass" placeholder="Password">
                </div>
            </div>
    <div class="form-row">
        <div class="form-group">
            <label for="secret-code">Secret Code</label>
            <input type="text" class="form-control" id="secret-code" name="code" placeholder="code">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block">Create Account</button>
            <button type="reset" class="btn btn-secondary btn-lg btn-block">Reset</button>
        </div>
    </div>
    </form>
</div><!-- end of create-account-form-div -->

<div class="account-created"> <!-- account created succesfully -->

   <h3>Your account has been succesfully created. You may now <a href="index.php">login</a></h3>


</div>

    </div>
</body>

</html>