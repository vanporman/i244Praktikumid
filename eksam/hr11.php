<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<script>
		var clicks = 0;
		function clickME() {
			clicks += 1;
			document.getElementById("clicks").innerHTML = clicks;
		}
	</script>
    <title>title</title>
</head>
<body>
<?php
//$host = "localhost";
//$user = "test";
//$pass = "t3st3r123";
//$db = "test";

//$connection = mysqli_connect($host, $user, $pass, $db);
//$laiks = '';
//$laiks = $_POST['laigid'];
  
//$query = "INSERT INTO vanporman_laigid (laik) VALUES('$laiks')";

//$result = mysqli_query($connection, $query) or die("$query - " . mysqli_error($connection));


//mysqli_close($connection);

?>
	<form action="" method="post">
	<input type="hidden" name="laigid" value=1>
	<input type="button" onClick="clickME()" value="Laigid">
	<!--<input type="submit" value="Laigid">-->
	</form>
	
	<p>Clicks: <a id="clicks">0</a></p>
</body>
</head>