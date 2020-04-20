<?php

$urlName = substr($_SERVER['PHP_SELF'], 21);

$urlArr = array("index.php", "palindrome.php", "about.php", "contact.php");

echo '<nav><ul>';
foreach($urlArr as $url){
    echo ($url == $urlName ? '<li><a class="active" href="' : '<li><a href="');
    echo ''.$url.'">';
    echo (substr($url, 0, -4) == "index" ? "home" : substr($url, 0, -4));
    echo '</a></li>';
}
echo  '</ul></nav>';

?>