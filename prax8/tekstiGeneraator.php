<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>title</title>
</head>
<body>
<?php
$textChanger = '';
$backgroundColor = '';
$textColor = '';
$borderThick = '';
$borderType = '';
$borderColor = '';
$borderRadius = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(empty($_POST['textToChange'])){
        $textChanger;
    } else{
        $textChanger = htmlspecialchars($_POST['textToChange']);
    }
    if (empty($_POST['backgroundColor'])){
        $backgroundColor;
    } else{
        $backgroundColor = htmlspecialchars($_POST['backgroundColor']);
    }
    if (empty($_POST['textColor'])){
        $textColor;
    } else {
        $textColor = htmlspecialchars($_POST['textColor']);
    }
    if (empty($_POST['borderThickness'])){
        $borderThick;
    } else {
        $borderThick = htmlspecialchars($_POST['borderThickness']);
    }
    if (empty($_POST['borderType'])){
        $borderType;
    } else {
        $borderType = htmlspecialchars($_POST['borderType']);
    }
    if (empty($_POST['borderColor'])){
        $borderColo;
    } else {
        $borderColor = htmlspecialchars($_POST['borderColor']);
    }
    if (empty($_POST['borderRadius'])){
        $borderRadius;
    } else {
        $borderRadius = htmlspecialchars($_POST['borderRadius']);
    }
}

echo '<div style="
                width: 380px;
                height: 100px;
                background-color:'.$backgroundColor.'; 
                color:'.$textColor.';
                border:'.$borderThick.'px '.$borderType. ' '.$borderColor.';
                border-radius:'.$borderRadius.'px;
    "><span style="left: 20px; top: 20px; position: relative;">'.$textChanger.'</span></div>';
?>
    <div>
        <form action="" method="post">
            <table border="1">
                <tr>
                    <td colspan="2">
                        <textarea name="textToChange" rows="3" cols="50"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="color" name="backgroundColor" value="#1a1a1a"> : Vali taustavärvus
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="color" name="textColor" value="#00ccff"> : Vali tekstivärvus
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="number" name="borderThickness" value="4" min="0" max="20"> : Vali piirjoone laius (max 20px)
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name="borderType">
                            <option value="none">no border</option>
                            <option value="solid" selected>solid</option>
                            <option value="double">double</option>
                            <option value="dashed">dashed</option>
                            <option value="dotted">dotted</option>
                        </select>
                        <label> : Piirjoone stiil</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="color" name="borderColor" value="#ff0000"> : Vali joonevärvus
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="number" name="borderRadius" value="15" min="0" max="100"> : Vali piirjoone raadius nurkades (max 100px)
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
