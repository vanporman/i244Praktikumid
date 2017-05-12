<?php

function connect_db(){
	global $connection;
	$host="localhost";
	$user="test";
	$pass="t3st3r123";
	$db="test";
	$connection = mysqli_connect($host, $user, $pass, $db) or die("ei saa ühendust mootoriga- ".mysqli_error());
	mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Ei saanud baasi utf-8-sse - ".mysqli_error($connection));
}

function logi(){
	// siia on vaja funktsionaalsust (13. nädalal)
    global $connection;
    $usr = mysqli_real_escape_string($connection, $_POST['user']);
    $psw = mysqli_real_escape_string($connection, $_POST['pass']);
    $query = "SELECT id FROM vanporman_loomaaed_kylastajad WHERE usr = '$usr' AND psw = SHA1('$psw')";
    $result = mysqli_query($connection, $query);
//    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
//    $active = $row['active'];

    $count = mysqli_num_rows($result);

    if ($count == 1){
        $_SESSION['user'] = $usr;
        header("Location: ?page=loomad");
    }
//    else {
//        $error = "Vale kasutajanimi või parool!";
//    }

//    $user_check = $_SESSION['user'];

//    $ses_sql = mysqli_query($connection,"SELECT usr FROM vanporman_loomaaed_kylastajad WHERE usr = '$user_check' ");

//    $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

//    $login_session = $row['usr'];

    include_once('views/login.html');
}

function logout(){
	$_SESSION=array();
	session_destroy();
	header("Location: ?");
}

function kuva_puurid(){
	// siia on vaja funktsionaalsust
    global $connection;
    $puurid = array();
    $puuri_nr = '';
    $query = "SELECT * FROM vanporman_loomaaed2 GROUP BY puur ORDER BY id";
    $result = mysqli_query($connection, $query);
    while ($loomarida = mysqli_fetch_assoc($result)){
//    while ($loomarida = $result -> fetch_assoc()){
//        print_r($puurid[$puuri_nr][] = $loomarida);
        $puurid[] = $loomarida;
//        echo '<br/>';
        echo "<img src='http://enos.itcollege.ee/~aporman/prax12/loomaaed/".$loomarida['liik']."' alt='nimi'>
        - puuris nr ".$loomarida['puur']."<br/>";
    }
    include_once('views/puurid.html');
	
}

function lisa(){
	// siia on vaja funktsionaalsust (13. nädalal)
	
	include_once('views/loomavorm.html');
	
}

function upload($name){
	$allowedExts = array("jpg", "jpeg", "gif", "png");
	$allowedTypes = array("image/gif", "image/jpeg", "image/png","image/pjpeg");
	$extension = end(explode(".", $_FILES[$name]["name"]));

	if ( in_array($_FILES[$name]["type"], $allowedTypes)
		&& ($_FILES[$name]["size"] < 100000)
		&& in_array($extension, $allowedExts)) {
    // fail õiget tüüpi ja suurusega
		if ($_FILES[$name]["error"] > 0) {
			$_SESSION['notices'][]= "Return Code: " . $_FILES[$name]["error"];
			return "";
		} else {
      // vigu ei ole
			if (file_exists("pildid/" . $_FILES[$name]["name"])) {
        // fail olemas ära uuesti lae, tagasta failinimi
				$_SESSION['notices'][]= $_FILES[$name]["name"] . " juba eksisteerib. ";
				return "pildid/" .$_FILES[$name]["name"];
			} else {
        // kõik ok, aseta pilt
				move_uploaded_file($_FILES[$name]["tmp_name"], "pildid/" . $_FILES[$name]["name"]);
				return "pildid/" .$_FILES[$name]["name"];
			}
		}
	} else {
		return "";
	}
}

?>