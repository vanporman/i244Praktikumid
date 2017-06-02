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
$_SESSION['loendur'] = 1;

if ($_SESSION['loendur'] == 1){
    $myfile = fopen("lehekylastused.txt", "a") or die("Unable to open file!");
    $kord = date("Y.m.d H:m:s")."\n" ;
    fwrite($myfile, $kord);
    fclose($myfile);
    $myfile2 = fopen("lehekylastused_aeg.txt", "w")  or die("Unable to open file!");
    $aeg = date("Y.m.d H:m:s");
    fwrite($myfile2, $aeg);
    fclose($myfile2);
}

$ridu = 0;
$myfile = fopen("lehekylastused.txt", "r") or die("Unable to open file!");
while(!feof($myfile)){
    $rida = fgets($myfile);
    $ridu++;
}
fclose($myfile);
$oige_rida = $ridu - 1;
echo "Lehe külastusi: ".$oige_rida."<br>";
$myfile2 = fopen("lehekylastused_aeg.txt", "r") or die("Unable to open file!");
echo "Viimati külastati lehte: ".fgets($myfile2);
fclose($myfile2);
