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
    $errors = array();
    $usr = '';
    //kasutaja on 'vanporman'
    $psw = '';
    //parool on 'tereLoomaaed'
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['user']) && $_POST['user'] != ''){
            $usr = mysqli_real_escape_string($connection, $_POST['user']);
        } else {
            $errors[] = "Kasutajanimi on puudu!";
        }
        if (isset($_POST['pass']) && $_POST['pass'] != ''){
            $psw = mysqli_real_escape_string($connection, $_POST['pass']);
        } else {
            $errors[] = "Parool on puudu!";
        }
    }
    $loginquery = "SELECT usr, psw FROM vanporman_loomaaed_kylastajad WHERE usr = '$usr' AND psw = SHA1('$psw')";
    $result = mysqli_query($connection, $loginquery);

    $count = mysqli_num_rows($result);

    if ($count == 1){
        $_SESSION['user'] = $usr;
        header("Location: ?page=loomad");
    }
    else if ($_SESSION['user'] != $_POST['user'] || $_SESSION['pass'] != $_POST['pass']) {
        $errors[] = "Vale kasutajanimi või parool!";
    }
//    else if ($count == 1 && $_SESSION['pass'] != $psw && $_SESSION['user'] = $usr) {
//        $errors[] = "Vale kasutajanimi või parool!";
//    }
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
//        print_r($puurid[$puuri_nr][] = $loomarida);
        $puurid[] = $loomarida;
//        echo '<br/>';
//        echo "<img src='http://enos.itcollege.ee/~aporman/prax12/loomaaed/".$loomarida['liik']."' alt='nimi'>
//        - puuris nr ".$loomarida['puur']."<br/>";
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