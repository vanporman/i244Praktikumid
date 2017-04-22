<?php
    require_once ('head.php');

    $picDir = "pildid/*.jpg";
    $images = glob( $picDir );

    $new_array = array();
    foreach($images as $key => $value){
        $new_array[$key+1] = $value;
    }
    $images = $new_array;

    echo "<div id=\"wrap\">";
    echo " <h3>Fotod</h3>";
    echo "<div id=\"gallery\">";
    foreach ($images as $key => $image):
        echo "<img src='" .$image. "' alt=\"nimetu $key\" />";
    endforeach;
    echo " </div>";
    echo " </div>";

    require_once ('footer.html');
?>

