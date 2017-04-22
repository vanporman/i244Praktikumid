<?php
    require_once ('head.php');

    echo "<div id=\"wrap\">";

//    $voted_for = $_POST["pilt"];

    if (!empty($_POST['pilt'])){
        echo "<p>Aitäh, et hääletasid pildi nr ".$_POST['pilt']." poolt!</p>";
        echo '<img src="pildid/nameless'.$_POST['pilt'].'.jpg" alt="nimetu '.$_POST['pilt'].'" height="100" />';
        $_SESSION['$voted_for'] = $_POST["pilt"];
    }
    else if (!empty($_SESSION)){
        echo "<p>Sa oled juba hääletanud pildi nr ".$_SESSION['$voted_for']." poolt!</p>";
            echo '<img src="pildid/nameless'.$_SESSION['$voted_for'].'.jpg" alt="nimetu '.$_SESSION['$voted_for'].'" height="100" />';
    } else{
        echo "<p style='color:red'>Aga sa ju ei hääletanud ühegi pildi poolt :(</p>";
    };

    echo "<p><a href=\"sessloppVote.php\">tühista sess</a></p>";

    echo "</div>";

require_once ('footer.html');
?>
