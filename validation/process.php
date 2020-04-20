<?php
$completedForm = false;
$errors = false;

function validateEmail($email) {
  $email = $_POST['email'];
 return filter_var($email, FILTER_VALIDATE_EMAIL) ? true : false;
}

function validatePhone($phone) {
 $phone = $_POST['phone'];
 // trim whitespace
 $phone = str_replace(' ', '', $phone);
 $pattern = '/^[(]{0,1}[0-9]{1,4}[)]{0,1}[0-9]{1,4}-[0-9]*$/';
return preg_match($pattern, $phone) ? true : false;
}

function showConfirmation() {
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $confirm = "<p>Thank you! Your registration has been confirmed with the email address: ".$email." and the phone number: ".$phone."</p>";
  return $confirm;
}

function displayValidationErrorMessage($emErr, $phErr) {
 if($phErr == false) {
   echo '<p>Please fill out a phone number in this format only: (123)123-1234 </p>';
 } else {
   echo '';
 }
 if($emErr == false) {
   echo '<p>Please fill out an email address in this format only: test@test.com </p>';
 } else {
   echo '';
 }

}
