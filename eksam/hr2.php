<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<script></script>
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
    if (isset($_POST['saada'])){
        $myfile = fopen("comment.txt", "a") or die("Unable to open file!");
        $name = "Nimi: ".$_POST['nimi']."\n";
        fwrite($myfile, $name);
        $comment = "Kommentaar: ".$_POST['kommentaar']."\n";
        fwrite($myfile, $comment);
        fclose($myfile);
    }

$myfile = fopen("comment.txt", "r") or die("Unable to open file!");
while(!feof($myfile)) {
    echo fgets($myfile) . "<br>";
}
fclose($myfile);


?>

</body>
</html>