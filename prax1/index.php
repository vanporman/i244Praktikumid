<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="styles/style.css"  type="text/css" />
    <meta charset="UTF-8">
    <title>PraktikumI</title>
  </head>
  <body>
		<?php
			$host = "localhost";
			$user = "test";
			$pass = "t3st3r123";
			$db = "test";
			
			$connection = mysqli_connect($host, $user, $pass, $db);
			$query = "SELECT * FROM vanporman_test";
			$result = mysqli_query($connection, $query) or die("$query - ".mysqli_error($connection));
			//$row = mysqli_fetch_assoc($result);
			while ($row = $result -> fetch_assoc()){
				echo "id: " . $row["id"]." - Isik: " . $row["isik"]." - Vanus: ". $row["vanus"]."<br>";
			}
			mysqli_close($connection);
		?>
       <header id="headers">
            <h1>Praktikum I!</h1>
        </header>
        <hr>
        <div id="mainPage">
            <h3 class="headers">Pildid</h3>
                <img class="picSize" src="https://i.ytimg.com/vi/tntOCGkgt98/maxresdefault.jpg" alt="Cat View">
                <img class="picSize" src="https://www.rover.com/blog/wp-content/uploads/2015/05/dog-candy-junk-food-599x340.jpg" alt="Dog View">
                <img class="picSize" src="http://az616578.vo.msecnd.net/files/2016/03/26/635945609159798563-1876533560_dog%20and%20cat.jpg" alt="Cat and Dog View">
        </div>
      <hr id="bottom">
        <footer id="botFooter">
			<?php
            echo "PHP versioon on: " . phpversion();
            ?>
            <p>:&lt; By Andreas van Porman &copy;</p>
            <p><a href="http://validator.w3.org/check?uri=referer">
                <img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a></p>
        </footer>
  </body>
</html>