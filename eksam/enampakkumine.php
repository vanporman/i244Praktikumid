<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>title</title>
</head>
<body>

<div>
	<h3>Alghind on 100 eurot!</h3>
	<p>Kuvatakse kõige suuremat pakkumist!</p>
	<form action="" method="post">
		<table border="1">
			<tr>
				<td>
					<label>Sisesta hind</label>
					<input type="number" name="hind" min="100">
				</td>
			</tr>
			<tr>
                <td>
                    <label>Nimi</label>
                    <input type="text" name="nimi">
                </td>
			</tr>
			<tr>
				<td>
					<input type="submit" name="saada" value="Tee oma pakkumine">
				</td>
			</tr>
		</table>
	</form>
</div>

<?php
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
	echo "<p>Siin tuuakse välja kõige parema pakkumise teinud isik ja summa:</p>";
	echo "<p>Kõige parema pakkumise on teinud praegu: ".$pakkumine['nimi']."</p>";
    echo "<p>Kasutaja: ".$pakkumine['nimi']." pakkumine on <b>".$pakkumine['hind']." eurot.</b></p>";
}
mysqli_close($connection);
?>

</body>
</html>