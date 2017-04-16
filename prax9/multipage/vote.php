<?php
    require_once ('head.html');

    $picDir = "pildid/*.jpg";
    $images = glob( $picDir );

//  massiivi indeks saab väärtuseks +1
    $new_array = array();
    foreach($images as $key => $value){
        $new_array[$key+1] = $value;
    }
    $images = $new_array;

    echo "<div id=\"wrap\">";
    echo "<h3>Vali oma lemmik :)</h3>";
    echo "<form action=\"tulemus.php\" method=\"GET\">";

    foreach ($images as $key => $image):
        echo "<p>";
        echo "<label for=\"p$key\">";
        echo "<img src='" .$image."' alt=\"nimetu $key\" height='100'/>";
        echo "</label>";
        echo "<input type=\"radio\" value=\"$key\" id=\"p$key\" name=\"pilt\" />";
        echo "</p>";
    endforeach;

    echo "<br/>";
    echo "<input type=\"submit\" value=\"Valin!\"/>";
    echo "</form>";
    echo "</div>";

    require_once ('footer.html');
?>
