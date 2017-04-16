<?php
    require_once ('head.html');

    echo "<div id=\"wrap\">";
    //<!--	<h3>Valiku tulemus</h3>-->
    //<!--	<p>Siia tuleb valiku tulemus, mida saab kuvada ainult PHP abil :)</p>-->

    //    $picDir = "pildid/*.jpg";
    //    $images = glob( $picDir );
    //
    //    //  massiivi indeks saab väärtuseks +1
    //    $new_array = array();
    //    foreach($images as $key => $value){
    //        $new_array[$key+1] = $value;
    //    }
    //    $images = $new_array;
    //
        if (!empty($_POST)){
            $errors=array();
            if (!empty($_POST["pilt"])){
                echo "<p>Aitäh, et hääletasid!</p>";
            }else{
                $errors[]="sa ei hääletanud ju ühegi pildi poolt :(";
            }
        } else{
            echo "<p style='color:red'>Aga sa ju ei hääletanud ühegi pildi poolt :(</p>";
        };


    echo "</div>";

require_once ('footer.html');
?>
