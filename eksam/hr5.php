<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>

<?php
$visitor_ip = $_SERVER['REMOTE_ADDR'];

$host = "localhost";
$user = "test";
$pass = "t3st3r123";
$db = "test";

$connection = mysqli_connect($host, $user, $pass, $db);


$query = "INSERT INTO vanporman_kylastajate_ip (ip) VALUES ('$visitor_ip')";
$result = mysqli_query($connection, $query);

$query2 = "SELECT COUNT(DISTINCT ip) AS ip FROM vanporman_kylastajate_ip";
$result2 = mysqli_query($connection, $query2);
$value = mysqli_fetch_assoc($result2);

echo "Seda lehekülge on külastatud <b>".$value['ip']."</b> erineva ip poolt";
?>

</body>
</html>