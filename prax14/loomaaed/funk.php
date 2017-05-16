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
    //kasutaja on 'vanporman' või 's6ber'
    $psw = '';
    //parool on 'tereLoomaaed' või 'tereS6ber'
    $rol = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['username']) && $_POST['username'] != ''){
            $usr = mysqli_real_escape_string($connection, $_POST['username']);
        } else {
            $errors[] = "Kasutajanimi on puudu!";
        }
        if (isset($_POST['pass']) && $_POST['pass'] != ''){
            $psw = mysqli_real_escape_string($connection, $_POST['pass']);
        } else {
            $errors[] = "Parool on puudu!";
        }
    }
    $query = "SELECT usr, psw, role FROM vanporman_loomaaed_kylastajad WHERE usr = '$usr' AND psw = SHA1('$psw')";
    $result = mysqli_query($connection, $query);
    //võtab mysql tabelist ühe rea ja selle väärtuse tulbast role
    $row = mysqli_fetch_assoc($result);
    $rol = $row['role'];



    $count = mysqli_num_rows($result);

    if ($count == 1){
        $_SESSION['user'] = $usr;
        $_SESSION['role'] = $rol;
        header("Location: ?page=loomad");
        //kui kasutaja on puudu, siis annab mõlemat veateadet(kasutaja puudu ja vale kasutaja või parool)
    }
    elseif ($count == 1 && $row['usr'] != $usr || $row['psw'] != $psw) {
        $errors[] = "Vale kasutaja või parool!";
    }

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
    $query = "SELECT id, nimi, puur, liik FROM vanporman_loomaaed2";
    $result = mysqli_query($connection, $query);

    while ($loomarida = mysqli_fetch_assoc($result)){
        $puurid[] = $loomarida;
    }

    include_once('views/puurid.html');

}

function hangi_loom($id){
    global $connection;
    $leitud_loom = array();
    $query = "SELECT id, nimi, puur, liik FROM vanporman_loomaaed2 WHERE id = $id";
    $result = mysqli_query($connection, $query);

    $row = mysqli_fetch_assoc($result);
    $looma_id = $row['id'];

    if ($looma_id == $id){
        array_push($leitud_loom[$row['id']]);
    }
    else {
        header("Location: ?");
    }
}

function muuda(){
    global $connection;
    if (empty($_SESSION['user']) && $_SESSION['role'] != 'admin'){
        header("Location: ?page=login");
    }
    $errors = array();

    //POST ja GET kontroll
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        echo "<p>GET rikuest kontroll - tulid teiselt lehelt</p>";
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['id']) && $_POST['id'] != ''){
            $id = mysqli_real_escape_string($connection, $_POST['id']);
        }
        else {
            header("Location: ?");
        }
    }

    include_once('views/muudavorm.html');
}

function lisa(){
    // siia on vaja funktsionaalsust (13. nädalal)
    global $connection;
    if (empty($_SESSION['user']) && $_SESSION['role'] != 'admin'){
        header("Location: ?page=login");
    }
    $errors = array();

    //POST ja GET kontroll
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        echo "<p>GET rikuest kontroll - tulid teiselt lehelt</p>";
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo "<p>POST rikuest kontroll - oled vormi juba kasutanud</p>";
        if (!empty($_POST)){
            if (empty($_POST['nimi'])){
                $errors[] = "Nimi on puudu";
            }
            if (empty($_POST['puur'])){
                $errors[] = "Puur on puudu";
            }
            if (empty($_FILES['liik']['name'])){
                $errors[] = "Pilt on puudu";
            }
            if (empty($errors)){
                $nimi = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['nimi']));
                $puur = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['puur']));
                $upload_kaust = "pildid/";
                $liik = $upload_kaust.htmlspecialchars(mysqli_real_escape_string($connection, $_FILES['liik']['name']));

                $query = "INSERT INTO vanporman_loomaaed2 ('nimi', 'puur', 'liik') VALUES ('$nimi', '$puur', '$liik')";
                $result = mysqli_query($connection, $query);

                $vastus = mysqli_insert_id($connection);

                if ($vastus > 0){
                    header("Location: ?page=loomad");
                } else {
                    echo "<p style='color: red'>Pilti ei laetud üles!</p>";
                }
            }
        }
    }

    include_once('views/loomavorm.html');

}

function upload($name){
	$allowedExts = array("jpg", "jpeg", "gif", "png");
	$allowedTypes = array("image/gif", "image/jpeg", "image/png","image/pjpeg");
	$extension = end(explode(".", $_FILES[$name]["name"]));
//    $tmp = explode('.', $_FILES[$name]["name"]);
//    $extension = end($tmp);

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