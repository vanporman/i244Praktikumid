<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

    <?php

        $sona = $_POST["sone"];
        $forwards = str_split($sona, 1);
        $backwards = '';

        for ($i = sizeof($forwards)-1; $i >= 0 ; $i--) {
            $backwards = $backwards.$forwards[$i];
        }
        echo "<h3>Vastus on: ".$backwards."</h3>";
    ?>

</body>
</html>