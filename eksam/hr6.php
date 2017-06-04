<?php

session_start();

?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>

<?php
// Set session variables
//echo $_SERVER['REMOTE_ADDR'];
//echo "<br>";
$_SESSION['loendur'] = 1;

if ($_SESSION['loendur'] == 1){
    $myfile = fopen("lehekylastused_ip.txt", "a") or die("Unable to open file!");
    $kord = $_SERVER['REMOTE_ADDR']."\n" ;
    fwrite($myfile, $kord);
    fclose($myfile);
    $myfile2 = fopen("lehekylastused_viimase_ip.txt", "w")  or die("Unable to open file!");
    $aeg = $_SERVER['REMOTE_ADDR'];
    fwrite($myfile2, $aeg);
    fclose($myfile2);
}

$ridu = 0;
$myfile = fopen("lehekylastused_ip.txt", "r") or die("Unable to open file!");
while(!feof($myfile)){
    $rida = fgets($myfile);
    $ridu++;
}
fclose($myfile);
$oige_rida = $ridu - 1;
echo "Lehe külastusi: ".$oige_rida."<br>";
$myfile2 = fopen("lehekylastused_viimase_ip.txt", "r") or die("Unable to open file!");
echo "Sinu IP on: ".fgets($myfile2);
fclose($myfile2);