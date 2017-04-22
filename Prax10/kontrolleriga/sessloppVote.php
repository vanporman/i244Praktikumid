<?php
session_start(); // ei saa l�petada asja, mida pole alustatud!
var_dump($_SESSION);

// muuda sessiooni k�psis kehtetuks
if(isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '',
        time()-42000, '/');
}
// t�hjenda sessiooni massiiv
$_SESSION = array();
// l�peta sessioon
session_destroy();

header("Location: kontroller.php?mode=vote");

?>