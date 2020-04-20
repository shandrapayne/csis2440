<?php
include_once('includes/header.php');
include_once('includes/albums.php');

?>
<!DOCTYPE html>
<html>

<body>
  <div id="header">
    <a href="index.php"><p><span class="back-link">Back</span></p></a>
    <a href="products.php"><p><span class="products-link">Products</span></p></a>
    <h3>Shandra's Top Albums</h3>
  </div>
  <div class="container">
    <div class="row">
      <?php
      foreach ($albumArray as $album) {
        extract($album);
      ?>
        <div class="col">
          <div class="card text-center" style="width: 18rem;">
            <a href="<?php echo $spotifyLink; ?>"><img src="<?php echo $albumImagePath ?>" class="card-img-top" alt="Album Image"></a>
            <div class="card-body">
              <h5 class="card-title"><?php echo $albumName; ?></h5>
              <p><?php echo $artist; ?></p>
            </div>
          </div>
        </div>

      <?php  } ?>

    </div>
  </div>
</body>

</html>