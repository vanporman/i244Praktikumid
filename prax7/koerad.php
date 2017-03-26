<?php
/**
 * Created by PhpStorm.
 * User: vanporman
 * Date: 27.03.17
 * Time: 0:36
 */
    $koerad = array(
        array('nimi'=>'Pontu', 'vanus'=>2, 'varvus'=>'must', 'lemmiktegevus'=>'söömine'),
        array('nimi'=>'Laika', 'vanus'=>4, 'varvus'=>'valge', 'lemmiktegevus'=>'jooksmine'),
        array('nimi'=>'Tyyp', 'vanus'=>1, 'varvus'=>'kirju', 'lemmiktegevus'=>'närimine'),
        array('nimi'=>'Valvur', 'vanus'=>7, 'varvus'=>'hallikas', 'lemmiktegevus'=>'haukumine'),
    );

    echo "<table width='500' border= '1'>
                <tr>
                    <th>Nimi</th>
                    <th>Vanus</th>
                    <th>Värvus</th>
                    <th>Lemmiktegevus</th>
                </tr>";
    foreach ($koerad as $vaiksedSobrad){
                echo "<tr>
                    <td align='center'>".$vaiksedSobrad['nimi']."</td>
                    <td align='center'>".$vaiksedSobrad['vanus']."</td>
                    <td align='center'>".$vaiksedSobrad['varvus']."</td>
                    <td align='center'>".$vaiksedSobrad['lemmiktegevus']."</td>
                </tr>";
    };
    echo "</table>";