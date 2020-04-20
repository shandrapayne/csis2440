<?php
include_once('includes/dbconnect.php');

### Functions ###

// query database to see if user already exists
function doesUserExist($conn, $usr) {
    $existence = false;
    $sql = "SELECT * FROM accounts";
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
        $existence = true;
    }

    return $existence;
    }
}

// hash & salt password
function encryptPass($pwd)
{
    $hash_default_salt = password_hash(
        $pwd,
        PASSWORD_DEFAULT
    );

    $hash_variable_salt = password_hash(
        $pwd,
        PASSWORD_DEFAULT,
        array('cost' => 9)
    );

    $verified = password_verify(
        $pwd,
        $hash_default_salt
    );

    return $verified;
}

// insert into db if user doesn't exist yet & no errors
function createAccount($usr, $pwd, $code, $verified, $uniqUser) {
    
    
}

// error handling




### Post form ###
if (empty($_POST)) {
    //  display regular version of page because they haven't submitted form yet
} else if (!empty($_POST['username']) && !empty($_POST['pass']) && !empty($_POST['code'])) {
    // all fields have been filled out so  display graphs
    $completedForm = true;

    $username = $_POST['username'];
    $password = $_POST['pass'];
    $code = $_POST['code'];

    // check for existing & if not: insert into database

} else {
    $errors = true;
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

    </div>
</body>

</html>