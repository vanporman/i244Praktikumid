<!--hr13 v6tab kokku hr 13, 14, 15-->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>title</title>
</head>
<body>
<h3>hr13 v6tab kokku hr 13, 14, 15</h3>

<?php
//V6tab serveri aja
$serverTime = date('H:i:s');
$serverTimeHour = date('H');
$serverTimeMinute = date('i');
$serverTimeSecond = date('s');
//Kontrollib kas kypsise loendur on seatud. Kui ei ole, m22rab loenduri v22rtuseks 1.
//M22rab aja, millal kypsis tekitati
if (!isset($_COOKIE['count'])) {
    echo "Oled lehel esimest korda"."<br>";
    $count = 1;
    setcookie('count', $count);
    setcookie('time', date('Y-m-d H:i:s'));
    echo "Küpsis loodud! ".$_COOKIE['time']."<br>";
}
//Kui loendur on seatud ehk tal on mingi v22rtus, lisatakse talle juurde 1??
//Ja m22ratakse uus loenduri v22rtus
else {
    $count = ++$_COOKIE['count'];
    setcookie('count', $count);
    echo "Oled lehel ".$_COOKIE['count']." korda<br>";
    //N2itab "vana" kypsise loomise aega??
    echo "Viimati külastasid lehte: ".$_COOKIE['time']."<br>";
    //V6tab serveri kellaaja
    echo "Serveri kell on: ".date('Y-m-d H:i:s')."<br>";
}
//M22ratakse uus kypsise tekitamise aeg, kui kasutatakse else klauslit
setcookie('time', date('Y-m-d H:i:s'));
?>

<!--Siit saab lehte juhtida-->
<form action="" method="post">
    <input type="submit" name="refPage" value="Uuenda lehte">
    <input type="submit" name="delCookie" value="Kustuta küpsis">
</form>

<?php
//Siin toimub lehe uuesti laadimine või kypsise kustutamine
if (isset($_POST['refPage'])){
    header("Refresh:?");
}
if (isset($_POST['delCookie'])){
    setcookie('count', "", time() - 3600);
    header("Location:?");
}
?>
<script>
    //Skript, mis võtab kasutaja brauseri? aja
    var currentTime = new Date();
    var hours = currentTime.getHours();
    var minutes = currentTime.getMinutes();
    var seconds = currentTime.getSeconds();
    var seconds2 = currentTime.getSeconds();

    if (minutes < 10) {
        minutes = "0" + minutes;
    }

    if (seconds < 10){
        seconds = "0" + seconds;
    }

    var serverHour = "<?php echo $serverTimeHour?>";
    var serverMinute = "<?php echo $serverTimeMinute?>";
    var serverSecond = "<?php echo $serverTimeSecond?>";

//    var timeDiffHour = serverHour - hours;
//    var timeDiffMinute = serverMinute - minutes;
    if (serverMinute < minutes){
        var timeDiffSecond = 60 + seconds2 - serverSecond + "</b> sekundit!";
    } else {
        var timeDiffSecond = seconds - serverSecond + "</b> sekundit!";
    }

    document.write("Arvuti kell on: " + "<b>" + hours + ":" + minutes + ":" + seconds + "</b><br>");
    document.write("Serveri kell on: " + "<?php echo $serverTime?>" + "<br>");
    document.write("Kellade vahe on: <b>" + timeDiffSecond);
</script>
</body>
</html>
