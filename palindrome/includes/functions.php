<?php

/****** INDEX FUNCTIONS ********/
function createVariables()
{
    if (isset($_GET['w'])) $wval = $_GET['w'];
    else $wval = "";
    if (isset($_GET['pc'])) $pcval = $_GET['pc'];
    else $pcval = 0;
    if (isset($_GET['ec'])) $pcval = $_GET['ec'];
    else $ecval = 0;

    return array($wval, $pcval, $ecval);
}

function createPalSelect($pcval, $allowedPal)
{
    $palSelect = '<select id="palindrome-option" name="pal-count">';
    $palSelect .= '<option ';
    if (!$pcval) $palSelect .= 'selected';
    $palSelect .= ' disabled>How many palindromes?</option>';

    for ($x = 1; $x <= $allowedPal; $x++) {
        $palSelect .= '<option ';
        $x == $pcval ? $palSelect .= 'selected' : $palSelect .= '';
        $palSelect .= ' value="' . $x . '">' . $x . ' Palindrome' . ($x > 1 ? "s" : "") . ' </option>';
    }
    $palSelect .= '</select>';

    return $palSelect;
}

function displayErrors($ecval)
{
    $errMessage = '';
    $errMessage .= '<p>You have missing fields in the form.</p>';
    switch ($ecval) {
        case 3:
            $errMessage .= "<p class='warning'>Please choose a search word.</p>";
        case 2:
            $errMessage .= "<p class='warning'>Please choose number of palindromes.</p>";
            break;
        case 1:
            $errMessage .= "<p class='warning'>Please choose a search word.</p>";
            break;
    }
    return $errMessage;
}

/**** PALINDROME FUNCTIONS ******/

function checkErrors()
{
    $sw = '';
    $pc = 0;
    $ec = 0;
    if (!empty($_POST['search-word'])) $sw = $_POST['search-word'];
    else $ec += 1;
    if (!empty($_POST['pal-count'])) $pc = $_POST['pal-count'];
    else $ec += 2;
    if ($ec) header('location: index.php?w=' . $sw . '&pc=' . $pc . '&ec=' . $ec);

    return array($sw, $pc, $ec);
}

function displayPalindromeForm($wordToFind, $palCount) {
    if (empty($_POST['pals'])) {
        $retValue = '';

        $retValue .= '<form action="" class="form-wrapper" method="post">';
        $retValue .=  '<input type="hidden" name="search-word" value="' . $wordToFind . '">';
        $retValue .=  '<input type="hidden" name="pal-count" value="' . $palCount . '">';
        for ($x = 0; $x < $palCount; $x++) 
          $retValue .=  '<input type="text" name="pals[]">';
        $retValue .=  '<input type="reset">';
        $retValue .=   '<input type="submit">';
        $retValue .=  '</form>';
        return $retValue;
      } else {
    
        $palindromes = $_POST['pals'];
    
       return display($palindromes, $wordToFind);
      }
}
function display($phrases, $searchWord)
{
    global $wordCount;
    $ret = '';
    $ret .= "<div class='wrapper'>";
    for ($i = 0; $i < sizeOf($phrases); $i++) {
        $ret .= "<div class='facts'>";
        $ret .= "<h1>Facts about $phrases[$i]: </h1>";
        $ret .= "<ul>";
        $ret .= "<li>It has " . strlen($phrases[$i]) . " characters. </li>";
        $ret .= "<li>Word count is " . str_word_count($phrases[$i]) . "</li>";
        $ret .= "<li>Palindrome status: " . (isPalindrome($phrases[$i]) ? "<span class='true'>TRUE</span>" : "<span class='false'>FALSE</span>") . "</li>";
        $ret .= "</ul>";
        $ret .= "</div>";

        if (strpos(cleanWord($phrases[$i]), cleanWord($searchWord)) >  -1) $wordCount++;   
    }
    $ret .= "</div>";
    $ret .= "<div class='wordFinderArea'><p>The number of palindromes with at least one instance of the word: \"$searchWord\" : $wordCount </p></div>";
    return $ret;
}

function cleanWord($w) {
    return strtolower(preg_replace ("/(\w*)(\W*)/" , "$1", $w));
}

function isPalindrome($p)
{
    $w = strtolower($p);
    $pattern = '/^((.)(?1)*\2|.?)$/';

    if (preg_match($pattern, $p))
        return true;
    else
        return false;
}
