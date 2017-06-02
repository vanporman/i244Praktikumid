<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>title</title>
</head>
<body>
<?php
$host = "localhost";
$user = "test";
$pass = "t3st3r123";
$db = "test";

$connection = mysqli_connect($host, $user, $pass, $db);

if(isset($_POST['saadahinne'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['hinda']) && $_POST['hinda'] != "") {
            $hinne = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['hinda']));
        }
    }

    $query = "INSERT INTO vanporman_hinded (hinne) VALUES ('$hinne')";
    $result = mysqli_query($connection, $query);
}

$query2 = "SELECT ROUND(AVG(hinne),2) AS KeskmineHinne FROM vanporman_hinded";
$result2 = mysqli_query($connection, $query2);

$value = mysqli_fetch_assoc($result2);

echo "Lehekülje keskmine hinne on: <b>".$value['KeskmineHinne'];

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