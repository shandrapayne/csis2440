<?php
include_once 'includes/variables.php';
include_once 'includes/functions.php';

list($wordToFind, $palCount, $ec) = checkErrors();

?>
<!doctype html>
<html lang="en">

<?php include_once('includes/header.php'); ?>

<body>
  <?php include_once('includes/navbar.php'); ?>
  <h1 class="main-heading"><a href='index.php'>The World of Palindromes</a></h1>
  <?php
   echo displayPalindromeForm($wordToFind, $palCount);

  ?>
</body>

</html>