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

if(isset($_POST['saadalaike'])){
//    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
//        if (isset($_POST['laik']) && $_POST['laik'] != ""){
//            $laik = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['laik']));
//        }
//    }
//    if ($_POST['laik'] == 1){
        $query = "UPDATE vanporman_laigid SET page_count = page_count + 1";
        $result = mysqli_query($connection, $query);
//    }
}

$query2 = "SELECT page_count FROM vanporman_laigid";
$result2 = mysqli_query($connection, $query2);
$value = mysqli_fetch_assoc($result2);

echo "Tseki juba neid laike: <b>".$value['page_count']."</b>!";

?>
	<form action="" method="post">
<!--        <input type="hidden" name="laik" value="1">-->
	    <input type="submit" name="saadalaike" value="Laigi!">
	</form>
</body>
</html>