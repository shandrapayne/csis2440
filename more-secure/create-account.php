<?php
include_once('includes/dbconnect.php');



### Functions ###

// query database to see if user already exists
function uniqueUsername($usr)
{
    global $conn;
   
      $isUnique = true;

    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
   
    $existingUsers = array();
    while($row = $result->fetch_assoc()) {
        array_push($existingUsers, $row);
    }

    foreach ($existingUsers as $existingUser) {
        $eu = $existingUser['username'];
        if ($usr == $eu) {
            $isUnique = false;
        }
    }

    $conn->close();
    return $isUnique;
}

// check the secret code 
function codeValid($codeWord)
{
    global $conn;
    $validCode = false;
    $sql = "SELECT * FROM code";
    $result = $conn->query($sql);
  
  $secretCodes = array();
  while($row = $result->fetch_assoc()) {
        array_push($secretCodes, $row);
    }
 
    foreach ($secretCodes as $secretCode) {
        $sc = $secretCode['phrase'];
        if ($codeWord == $sc) {
            $validCode = true;
        }
    }  
    
    $conn->close();

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
function createAccount($usr, $passHash)
{
    global $conn;
    $id = uniqid();
    $accountCreated = false;
    $sql = "INSERT INTO users (id, username, pwd) VALUES ('$id', '$usr', '$passHash')";
    if ($conn->query($sql) === true) {
        $accountCreated = true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    return $accountCreated;
}

// error handling
function errorHandling($uniqUser, $validCode)
{
    $error = "Error: ";

    if ($validCode != true) {
        $error .= "\n The code you entered is incorrect!";
    }

    if ($uniqUser != true) {
        $error .= "\n The username you entered already exists. Please come up with something original.";
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
    $uniqueUser = uniqueUsername($username);
    
    $password = $_POST['pass'];
    $hashedP = encryptPass($password);
   // var_dump($hashedP);

    $code = $_POST['code'];
    $codeValid = codeValid($code);
   

    // if username unique and code valid : insert into database
    if (($uniqueUser == true) && ($codeValid == true)) {
        $createAccount = createAccount($username, $hashedP);
        var_dump($createAccount);
    } else {
        $getErrors = errorHandling($isUniqueUser, $codeValid);
       
    }
} else {
   // not sure what the hell
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
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-row">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="pass">Password</label>
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Password">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="verify-pass">Verify Password</label>
                        <input type="password" class="form-control" id="verify-pass" placeholder="Verify Password">
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
        <?php if ($createAccount == true) { ?>
            <div class="account-created">
                <!-- account created succesfully (only show after account created) -->

                <h3>Your account has been succesfully created. You may now <a href="index.php">login</a></h3>


            </div>
        <?php } ?>
    </div>
</body>

</html>