<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Praktikum  - Ülesanne</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div id="header">
    <ul>
        <li><a href="?mode=pealeht">Pealeht</a></li>
        <li><a href="?mode=galerii">Galerii</a></li>
        <?php
        if (!empty($_SESSION) || !empty($_POST)){
        echo '<li><a href="?mode=tulemus">Hääletamine</a></li>';
        } else {
        echo '<li><a href="?mode=vote">Hääletamine</a></li>';
        }
        ?>

    </ul>
</div>
<div id="banner">
    <img src="banner1.jpg" alt="banner">
</div>
