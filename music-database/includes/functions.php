<?php

function checkFormForEmptyFields() {
    $err = 0;
    // they filled out form but missed at least one required field
    $errArr = array();

    if (empty($_POST['shirt'])) {
        $err = 1;
        array_push($errArr, $err);
    }
    if (empty($_POST['color'])) {
        $err = 2;
        array_push($errArr, $err);
    }
    if (empty($_POST['size'])) {
        $err = 3;
        array_push($errArr, $err);
    }
    if (empty($_POST['style'])) {
        $err = 4;
        array_push($errArr, $err);
    }
    if (empty($_POST['first-name'])) {
        $err = 5;
        array_push($errArr, $err);
    }
    if (empty($_POST['last-name'])) {
        $err = 6;
        array_push($errArr, $err);
    }
    if (empty($_POST['address'])) {
        $err = 7;
        array_push($errArr, $err);
    }
    if (empty($_POST['city'])) {
        $err = 8;
        array_push($errArr, $err);
    }
    if (empty($_POST['state'])) {
        $err = 9;
        array_push($errArr, $err);
    }
    if (empty($_POST['zip'])) {
        $err = 10;
        array_push($errArr, $err);
    }
    if (empty($_POST['email'])) {
        $err = 11;
        array_push($errArr, $err);
    }
    if (empty($_POST['phone'])) {
        $err = 12;
        array_push($errArr, $err);
    }

    return $errArr;
}

 function buildErrorInfo($errArr) {
    $errInfo = '<p>Oops! Please fill out: </p><ul>';
    if (in_array(1, $errArr)) {
        $errInfo .= '<li>Shirt Image</li>';
    }
    if (in_array(2, $errArr)) {
        $errInfo .= '<li>Shirt Color</li>';
    }
    if (in_array(3, $errArr)) {
        $errInfo .= '<li>Shirt Size</li>';
    }
    if (in_array(4, $errArr)) {
        $errInfo .= '<li>Shirt Style</li>';
    }
    if (in_array(5, $errArr)) {
        $errInfo .= '<li>First Name</li>';
    }
    if (in_array(6, $errArr)) {
        $errInfo .= '<li>Last Name</li>';
    }
    if (in_array(7, $errArr)) {
        $errInfo .= '<li>Address</li>';
    }
    if (in_array(8, $errArr)) {
        $errInfo .= '<li>City</li>';
    }
    if (in_array(9, $errArr)) {
        $errInfo .= '<li>State</li>';
    }
    if (in_array(10, $errArr)) {
        $errInfo .= '<li>Zipcode</li>';
    }
    if (in_array(11, $errArr)) {
        $errInfo .= '<li>E-mail</li>';
    }
    if (in_array(12, $errArr)) {
        $errInfo .= '<li>Phone</li>';
    }
    $errInfo .= '</ul>';
    
    return $errInfo;

 }

 /* function validateEmail($email) {
    $email = $_POST['email'];
   return filter_var($email, FILTER_VALIDATE_EMAIL) ? true : false;
  } */
  
  function validatePhone($phone) {
   $phone = $_POST['phone'];
   // trim whitespace
   $phone = str_replace(' ', '', $phone);
   $pattern = '/^[(]{0,1}[0-9]{1,4}[)]{0,1}[0-9]{1,4}-[0-9]*$/';
  return preg_match($pattern, $phone) ? true : false;
  }

   function validateEmail($email) {
    $email = $_POST['email'];
    $pattern = '^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$';
    $errMessage = 'Please fill out a valid email address in the format: test@test.com';
    
    if($pattern == $email)  {
    return true;
    } else {
    array_push($errMessageArr, $errMessage);
    return $errMessageArr;
    }
  }
 

?>


