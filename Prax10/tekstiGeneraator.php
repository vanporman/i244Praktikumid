<?php
session_start();
$textChanger = '';
$backgroundColor = '';
$text_Color = '';
$borderThick = '';
$borderType = '';
$borderColor = '';
$borderRadius = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['textToChange']) && $_POST['textToChange'] != ""){
        $_SESSION['$textChanger'] = htmlspecialchars($_POST['textToChange']);
    }
    if (isset($_POST['backgroundColor']) && $_POST['backgroundColor'] != ""){
        $_SESSION['$backgroundColor'] = htmlspecialchars($_POST['backgroundColor']);
    }
    if (isset($_POST['textColor']) && $_POST['textColor'] != ""){
        $_SESSION['$text_Color'] = htmlspecialchars($_POST['textColor']);
    }
    if (isset($_POST['borderThickness']) && $_POST['borderThickness'] != ""){
        $_SESSION['$borderThick'] = htmlspecialchars($_POST['borderThickness']);
    }
    if (isset($_POST['borderType']) && $_POST['borderType'] != ""){
        $_SESSION['$borderType'] = htmlspecialchars($_POST['borderType']);
    }
    if (isset($_POST['borderColor']) && $_POST['borderColor'] != ""){
        $_SESSION['$borderColor'] = htmlspecialchars($_POST['borderColor']);
    }
    if (isset($_POST['borderRadius']) && $_POST['borderRadius'] != ""){
        $_SESSION['$borderRadius'] = htmlspecialchars($_POST['borderRadius']);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>title</title>
</head>
<body>
<?php
echo '<div style="
                width: 380px;
                height: 100px;
                background-color:'.$_SESSION['$backgroundColor'].'; 
                color:'.$_SESSION['$text_Color'].';
                border:'.$_SESSION['$borderThick'].'px '.$_SESSION['$borderType']. ' '.$_SESSION['$borderColor'].';
                border-radius:'.$_SESSION['$borderRadius'].'px;
    "><span style="left: 20px; top: 20px; position: relative;">'.$_SESSION['$textChanger'].'</span></div>';
?>
<div>
    <form action="" method="post">
        <table border="1">
            <tr>
                <td colspan="2">
                    <textarea name="textToChange" rows="3" cols="50"><?php echo $_SESSION['$textChanger']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="color" name="backgroundColor" value="<?php echo $_SESSION['$backgroundColor']; ?>"> : Vali taustavärvus
                </td>
            </tr>
            <tr>
                <td>
                    <input type="color" name="textColor" value="<?php echo $_SESSION['$text_Color']; ?>"> : Vali tekstivärvus
                </td>
            </tr>
            <tr>
                <td>
                    <input type="number" name="borderThickness" value="<?php echo $_SESSION['$borderThick']; ?>" min="0" max="20"> : Vali piirjoone laius (max 20px)
                </td>
            </tr>
            <tr>
                <td>
                    <select name="borderType">
                        <option value="none" <?php if($_SESSION['$borderType'] == "none") echo 'selected' ?>>no border</option>
                        <option value="solid" <?php if($_SESSION['$borderType'] == "solid") echo 'selected' ?>>solid</option>
                        <option value="double" <?php if($_SESSION['$borderType'] == "double") echo 'selected' ?>>double</option>
                        <option value="dashed" <?php if($_SESSION['$borderType'] == "dashed") echo 'selected' ?>>dashed</option>
                        <option value="dotted" <?php if($_SESSION['$borderType'] == "dotted") echo 'selected' ?>>dotted</option>
                    </select>
                    <label> : Piirjoone stiil</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="color" name="borderColor" value="<?php echo $_SESSION['$borderColor']; ?>"> : Vali joonevärvus
                </td>
            </tr>
            <tr>
                <td>
                    <input type="number" name="borderRadius" value="<?php echo $_SESSION['$borderRadius']; ?>" min="0" max="100"> : Vali piirjoone raadius nurkades (max 100px)
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Punch it, Chewie!">
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>
