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
       <header id="topHeader">
            <h1>Praktikum I!</h1>
        </header>
        <hr>
        <div id="mainPage">
            <h3>Pildid</h3>
            <div id="Pic1">
                <img id="picSize" src="https://i.ytimg.com/vi/tntOCGkgt98/maxresdefault.jpg" alt="Cat View">
            </div>
            <div id="Pic2">
                <img id="picSize" src="https://www.rover.com/blog/wp-content/uploads/2015/05/dog-candy-junk-food-599x340.jpg" alt="Dog View">
            </div>
            <div id="Pic3">
                <img id="picSize" src="http://az616578.vo.msecnd.net/files/2016/03/26/635945609159798563-1876533560_dog%20and%20cat.jpg" alt="Cat and Dog View">
            </div>
        </div>
      <hr id="bottom">
        <footer id="botFooter">
			<?php
            echo "PHP versioon on: " . phpversion();
            ?>
            <p>:&lt; By Andreas van Porman &copy;</p>
        </footer>
  </body>
</html>