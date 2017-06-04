<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>title</title>
</head>
<body>

<div>
	<h3>Alghind on 100 eurot!</h3>
	<p>Kui oled oma pakkumise ära teinud, näed kes on teinud kõige suurema pakkumise ja mis on see summa.</p>
	<form action="funk.php" method="post">
		<table border="1">
			<tr>
				<td>
					<label>Sisesta hind</label>
					<input type="number" name="hind" min="100" required>
				</td>
			</tr>
			<tr>
                <td>
                    <label>Nimi</label>
                    <input type="text" name="nimi" required>
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
</body>
</html>