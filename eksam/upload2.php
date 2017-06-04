<?php
header('Content-Type: text/html; charset=utf-8');

$host = "localhost";
$user = "test";
$pass = "t3st3r123";
$db = "test";

$connection = mysqli_connect($host, $user, $pass, $db);

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$failid = ($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$texFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Kontroll kas tegu on tekstifailiga või mitte
if(isset($_POST["submit"])) {
//    echo $target_dir."<br>";
//    echo $target_file."<br>";
//    echo $texFileType."<br>";
    if ($texFileType != "txt" && $texFileType != "csv"){
        echo "See ei ole tekstifail!"."<br>";
        $uploadOk = 0;
    } else {
        echo "Fail: ".$_FILES["fileToUpload"]["name"]."<br>";
        $uploadOk = 1;
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['submit'])){
                $query3 = "SELECT failid FROM vanporman_failid WHERE failid = '$failid'";
                $result3 = mysqli_query($connection, $query3);
                $value3 = mysqli_fetch_assoc($result3);
                if ($value3['failid'] != $failid){
                    $query = "INSERT INTO vanporman_failid (failid) VALUES ('$failid')";
                    $result = mysqli_query($connection, $query);
                } else {
                    echo "See juba on üles laetud"."<br>";
                }
            }
        }
    }
}
// Kontroll, kas fail juba eksisteerib
if (file_exists($target_file)) {
    echo "See fail on juba üles laetud."."<br>";
    $uploadOk = 0;
}

// Faili suuruse kontroll
if ($_FILES["fileToUpload"]["size"] > 100000) {
    echo "See fail on liiga suur."."<br>";
    $uploadOk = 0;
}

// Allow certain file formats
if($texFileType != "txt" && $texFileType != "csv" ) {
    echo "Ainult tektsifailid (txt ja csv)."."<br>";
    $uploadOk = 0;
}

// Kas uploadOK on saanud v22rtuseks 0
if ($uploadOk == 0) {
    echo "Faili ei laetud üles, esines viga."."<br>";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "Fail ". basename( $_FILES["fileToUpload"]["name"]). " laeti üles."."<br>";
    } else {
        echo "Tekkis viga, faili ei laetud üles."."<br>";
    }
}


?>
    <form action="" method="post">
        Vali tekstifail mida kustutada:
        <input type="text" name="fileToDelete">
        <input type="submit" value="Kustuta fail" name="submit">
    </form>

<?php
if(isset($_POST['submit'])){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['fileToDelete']) && $_POST['fileToDelete'] != "") {
            $failDel = htmlspecialchars(mysqli_real_escape_string($connection, $_POST['fileToDelete']));
        }
    }

    $query4 = "DELETE FROM vanporman_failid WHERE failid = '$failDel'";
    $result4 = mysqli_query($connection, $query4);
    $delFail = $target_dir.$failDel;
    unlink($delFail);
}
?>


<?php

$query2 = "SELECT COUNT(failid) AS failid FROM vanporman_failid";
$result2 = mysqli_query($connection, $query2);
$value = mysqli_fetch_assoc($result2);

echo "Faile on üles laetud: <b>".$value['failid']."</b>!"."<br>";

echo "<a href='http://enos.itcollege.ee/~aporman/eksam/hr8.php'>Tagasi</a>";
?>