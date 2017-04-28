<!DOCTYPE html>
<html>
<head>
<!--    <meta charset="latin1_swedish_ci">-->
    <meta charset="UTF-8">
    <title>title</title>
</head>
<body>
    <div id="paringud">
        <form action="" method="post">
            <table border="1">
                <tr>
                    <td>
                        <label for="lnp">Vali loom ja sa näed ta nimesid koos puuri numbritega</label>
                        <select name="loomNimiPuur" id="lnp">
                            <option value=""></option>
                            <option value="Ämblik">Ämblik</option>
                            <option value="Koer">Koer</option>
                            <option value="Madu">Madu</option>
                            <option value="Kass">Kass</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="nv">Kas tahad näha kes on noorim ja kes vanim?</label>
                        <select name="noorimVanim" id="nv">
                            <option value=""></option>
                            <option value="Jaa">JAAA</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="vp">Vali puuri number ja näed mitu looma selles on</label>
                        <input type="number" name="puurisLoomi" id="vp">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="sv">Suurenda loomade vanust, soovitavalt ÜHE aasta võrra</label>
                        <input type="number" name="suurendaVanust" id="sv">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Uuri järgi">
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <div>

    <?php
        $host = "localhost";
        $user = "test";
        $pass = "t3st3r123";
        $db = "test";

        $q1 = '';
        $q2 = '';
        $q3 = '';
        $q4 = '';

        if (isset($_POST['loomNimiPuur']) && $_POST['loomNimiPuur'] != ""){
            $q1 = htmlspecialchars($_POST['loomNimiPuur']);
        }
        if (isset($_POST['noorimVanim']) && $_POST['noorimVanim'] != ""){
            $q2 = htmlspecialchars($_POST['noorimVanim']);
        }
        if (isset($_POST['puurisLoomi']) && $_POST['puurisLoomi'] != ""){
            $q3 = htmlspecialchars($_POST['puurisLoomi']);
        }
        if (isset($_POST['suurendaVanust']) && $_POST['suurendaVanust'] != ""){
            $q4 = htmlspecialchars($_POST['suurendaVanust']);
        }

        $connection = mysqli_connect($host, $user, $pass, $db);

        if (!empty($q1) && empty($q2 && $q3 && $q4)){
            $query = "SELECT NIMI as loomanimi, PUUR AS puurinumber FROM  vanporman_loomaaed 
                      WHERE LIIK =  '$q1'";
        } else if (!empty($q2) && empty($q1 && $q3 && $q4)){
            $query = "SELECT * 
                    FROM vanporman_loomaaed AS vl, (
                    SELECT MIN( VANUS ) AS noorimLoom, MAX( VANUS ) AS vanimLoom
                    FROM vanporman_loomaaed
                    ) AS vanused
                    WHERE vanused.noorimLoom = vl.VANUS
                    OR vanused.vanimLoom = vl.VANUS";
        } else if (!empty($q3) && empty($q1 && $q2 && $q4)){
            $query = "SELECT PUUR, COUNT( PUUR ) AS loomiKokku
                    FROM  vanporman_loomaaed 
                    WHERE PUUR =$q3
                    GROUP BY PUUR";
        } else if (!empty($q4) && empty($q1 && $q2 && $q3)){
            $query = "UPDATE vanporman_loomaaed SET VANUS = VANUS +$q4";
        } else {
            $query = "SELECT * FROM  vanporman_loomaaed";
        }
    
        $result = mysqli_query($connection, $query) or die("$query - ".mysqli_error($connection));
        echo $query;

        if (!empty($q3)){
            echo "<table border='1'>
                                <thead>
                                    <tr>
                                        <th>PUUR</th>
                                        <th>loomiKokku</th>
                                    </tr>
                                </thead>
                                <tbody>";
            while ($row = $result -> fetch_assoc()){
                echo "<tr>
                                        <td>". $row['PUUR']."</td>
                                        <td>". $row['loomiKokku']."</td>
                                    </tr>";
            }
            echo "</tbody>
                                  </table>";
        } else if (!empty($q1)){
            echo "<table border='1'>
                                <thead>
                                    <tr>
                                        <th>NIMI</th>
                                        <th>PUUR</th>
                                    </tr>
                                </thead>
                                <tbody>";
            while ($row = $result -> fetch_assoc()){
                echo "<tr>
                                        <td>". $row['loomanimi']."</td>
                                        <td>". $row['puurinumber']."</td>
                                    </tr>";
            }
            echo "</tbody>
                                  </table>";
        } else if (!empty($q4)){
            echo "<p>Uuri järgi, mis loomade vanus nüüd on</p>";
        }
        else {
            echo "<table border='1'>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NIMI</th>
                                        <th>VANUS</th>
                                        <th>LIIK</th>
                                        <th>PUUR</th>
                                    </tr>
                                </thead>
                                <tbody>";
            while ($row = $result -> fetch_assoc()){
                echo "<tr>
                                        <td>". $row['ID']."</td>
                                        <td>". $row['NIMI']."</td>
                                        <td>". $row['VANUS']."</td>
                                        <td>". $row['LIIK']."</td>
                                        <td>". $row['PUUR']."</td>
                                    </tr>";
            }
            echo "</tbody>
                                  </table>";
        }

    
        mysqli_close($connection);
    ?>
    </div>
</body>
</html>