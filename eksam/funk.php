<?php
header('Content-Type: text/html; charset=utf-8');

$host = "localhost";
$user = "test";
$pass = "t3st3r123";
$db = "test";
$connection = mysqli_connect($host, $user, $pass, $db);
if(isset($_POST['saada'])){
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['nimi']) && $_POST['nimi'] != ""){
            $nimi = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['nimi']));
        }
        if (isset($_POST['hind']) && $_POST['hind'] != ""){
            $hind = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['hind']));
        }
    }
    if (isset($_POST['nimi']) && $_POST['nimi'] != ""){
        $query = "INSERT INTO vanporman_parimadpakkumised (hind, nimi) VALUES('$hind', '$nimi')";
        $result = mysqli_query($connection, $query) or die("$query - " . mysqli_error($connection));
    } else {
        echo "NIMI PUUDU";
    }
}

$query2 = "SELECT hind, nimi FROM vanporman_parimadpakkumised WHERE hind = (SELECT Max(hind) AS parimpakkumine FROM vanporman_parimadpakkumised)";
$result2 = mysqli_query($connection, $query2) or die("$query2 - " . mysqli_error($connection));
while ($pakkumine = $result2 -> fetch_assoc()){
	echo "<h3>Siin tuuakse välja kõige parema pakkumise teinud isik ja summa</h3>";
	echo "<p>Kõige parema pakkumise on teinud praegu: ".$pakkumine['nimi']."</p>";
    echo "<p>Kasutaja ".$pakkumine['nimi']." pakkumine on <b>".$pakkumine['hind']." eurot.</b></p>";
}
mysqli_close($connection);
?>