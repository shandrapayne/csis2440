<?php
include_once('process.php');

if (empty($_POST)) {
    //do nothing because they haven't filled out the form
} else if (empty($_POST['phone']) || empty($_POST['email'])) {
    // one or more empty fields
    $emptyFields = true;
    if (empty($_POST['phone'])) {
        $emptyPhone = '<p class="warning">Please fill out your phone number.</p>';
    }
    if (empty($_POST['email'])) {
        $emptyEmail = '<p class="warning">Please fill out your email address.</p>';
    }
} else {
    // filled out both fields, validate data
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $checkEmail = validateEmail($email);
    $checkPhone = validatePhone($phone);

    if ($checkEmail && $checkPhone == true) {
        // form has valid fields and is complete
        $completedForm = true;
    } else {
        $errors = true;
    }
}

?>
<!DOCTYPE html>
<html lang="html">

<head>
    <title>Validation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <h1>Validation Assignment</h1>
    <div class="container">
        <div class="registration-form">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?php echo isset($_POST['email']) ? ($_POST['email']) : ''; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone">Phone:</label>
                        <input type="tel" placeholder="(###)###-####" class="form-control" name="phone" id="phone" value="<?php echo isset($_POST['phone']) ? ($_POST['phone']) : ''; ?>">
                    </div>
                </div>
                <?php if (empty($_POST['phone'])) {
                    echo $emptyPhone;
                }
                if (empty($_POST['email'])) {
                    echo $emptyEmail;
                }
                ?>
                <div class="form-row">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div> <!-- end of registration form -->
        <?php if ($errors == true) { // they've filled out form but there's errors so display errors 
        ?>
            <div class="errors">
                <p><?php echo displayValidationErrorMessage($checkEmail, $checkPhone);
                    ?>

                </p>

            </div> <!-- end of errors-->
        <?php } else if ($completedForm == true) { // they've completed form with valid data so display confirmation 
        ?>
            <div class="confirmation">
                <?php echo showConfirmation();
                ?>

            </div><!-- end of confirmation -->
        <?php } ?>
    </div>
</body>

</html>