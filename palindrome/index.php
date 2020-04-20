<?php
include_once('includes/variables.php');
include_once('includes/functions.php');
list($wvalue, $pcvalue, $ecvalue) = createVariables();

?>

<!doctype html>
<html lang="en">

<?php include_once('includes/header.php'); ?>

<body>
  <?php include_once('includes/navbar.php'); ?>
  <h1 class="main-heading">The World of Palindromes</h1>
  
  <div class="form-wrapper">
    <form method="POST" action="palindrome.php">
      <input type="text" placeholder="Enter a search word" name='search-word' value="<?php echo $wvalue; ?>">
      <?php echo createPalSelect($pcvalue, $allowedPals); ?>
      <div class="spacer"></div>
      <input type="reset">
      <input type="submit">
    </form>

    <?php 
    if($_GET['ec']) echo displayErrors($ecvalue); ?>
  </div>
</body>

</html>