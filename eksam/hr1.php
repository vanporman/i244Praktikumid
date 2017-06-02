<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>title</title>
</head>
<body>

<div>
	<form action="" method="post">
		<table border="1">
            <tr>
                <th colspan="2">Kommentaar</th>
            </tr>
			<tr>
				<td colspan="2">
					<textarea name="kommentaar" rows="3" style="width: 98%"></textarea>
				</td>
			</tr>
			<tr>
                <td>
                    <label>Nimi</label>
                    <input type="text" name="nimi">
                </td>
				<td>
					<input type="submit" name="saada" value="Kommenteeri">
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
        if (isset($_POST['kommentaar']) && $_POST['kommentaar'] != ""){
            $kommentaarid = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['kommentaar']));
        }
    }

    if (isset($_POST['nimi']) && $_POST['nimi'] != ""){
        $query = "INSERT INTO vanporman_kommentaarid (nimi, kommentaar) VALUES('$nimi', '$kommentaarid')";
        $result = mysqli_query($connection, $query) or die("$query - " . mysqli_error($connection));
    } else {
        echo "NIMI PUUDU";
    }
}

$query2 = "SELECT nimi, kommentaar FROM vanporman_kommentaarid ORDER BY id DESC";
$result2 = mysqli_query($connection, $query2) or die("$query2 - " . mysqli_error($connection));

while ($kommentaarium = $result2 -> fetch_assoc()){
    echo "<p>".$kommentaarium['kommentaar']." - ".$kommentaarium['nimi']."</p>";
}
mysqli_close($connection);
?>

</body>
</html>
