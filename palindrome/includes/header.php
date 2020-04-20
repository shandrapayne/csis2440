<?php
$url = substr($_SERVER['PHP_SELF'], 21, -4);

if($url == "index"){
  $title = "Home Page";
} else {
$title = ucfirst($url) . " Page";
}

echo '<head>
  <title>'.$title.'</title>
  <link type="text/css" rel="stylesheet" href="css/style.css">
</head>';


?>