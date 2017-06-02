<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>title</title>
</head>
<body>
<?php
if(isset($_POST['saadalaike'])) {
    $myfile = fopen("laigid.txt", "a") or die("Unable to open file!");
    $laik = "1\n";
    fwrite($myfile, $laik);
    fclose($myfile);
}

$ridu = 0;
$myfile = fopen("laigid.txt", "r") or die("Unable to open file!");
while(!feof($myfile)){
    $rida = fgets($myfile);
    $ridu++;
}
fclose($myfile);
$oiged_laigid = $ridu - 1;
echo "Lehekülg on meeldinud: <b>".$oiged_laigid."</b> korda.";
?>
<form action="" method="post">
    <!--        <input type="hidden" name="laik" value="1">-->
    <input type="submit" name="saadalaike" value="Laigi!">
</form>
</body>
</html>