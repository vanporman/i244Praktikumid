<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>title</title>
</head>
<body>
<?php
if(isset($_POST['saadahinne'])) {
    $myfile = fopen("hinne.txt", "a") or die("Unable to open file!");
    $hinne = $_POST['hinda']."\n";
    fwrite($myfile, $hinne);
    fclose($myfile);
}
$hindeid = 0;
$myfile = fopen("hinne.txt", "r") or die("Unable to open file!");
while(!feof($myfile)){
    $hindeidkokku = fgets($myfile);
    $hindeid++;
}

$hinnetesumma = 0;
$myfile = fopen("hinne.txt", "r") or die("Unable to open file!");
while(!feof($myfile)){
    $hindedsumma = fgets($myfile);
    $hinnetesumma = $hinnetesumma + $hinnetesumma;
}

fclose($myfile);
$oiged_hinded = $hindeid - 1;
$keskmine_hinne = $hinnetesumma/$oiged_hinded;
echo "Keskmine hinne: ".$keskmine_hinne."<br>";

?>

<div>
    <form action="" method="post">
        <input type="radio" name="hinda" value="1">1<br>
        <input type="radio" name="hinda" value="2">2<br>
        <input type="radio" name="hinda" value="3">3<br>
        <input type="radio" name="hinda" value="4">4<br>
        <input type="radio" name="hinda" value="5">5<br>
        <input type="submit" name="saadahinne" value="Hinda">
    </form>
</div>