<?php
    require_once ('head.html');

    $mode="";
    if (!empty($_GET["mode"])) {
        $mode=$_GET["mode"];
    }

    $picDir = "pildid/*.jpg";
    $images = glob( $picDir );

    $new_array = array();
    foreach($images as $key => $value){
        $new_array[$key+1] = $value;
    }
    $images = $new_array;

    switch($mode){
        case "galerii":
            include("galerii.php");
            break;
        case "vote":
            include ("vote.html");
            break;
        case "tulemus":
            include("tulemus.php");
            break;
        default:
            include("pealeht.php");
            break;
    }

    require_once ('footer.html');


?>