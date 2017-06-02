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

$host = "localhost";
$user = "test";
$pass = "t3st3r123";
$db = "test";

$connection = mysqli_connect($host, $user, $pass, $db);

if ($_SESSION['loendur'] == 1){
    $query = "UPDATE vanporman_pageviews SET page_count = page_count + 1";
    $result = mysqli_query($connection, $query);

}

$query2 = "SELECT page_count FROM vanporman_pageviews";
$result2 = mysqli_query($connection, $query2);
$value = mysqli_fetch_assoc($result2);

echo "Seda lehekülge on külastatud: <b>".$value['page_count']."</b> korda";
?>

</body>
</html>
