<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Заполнение лабиринта</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            margin: 20px;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    $height = $_POST['height'];
    $width = $_POST['width'];
    $_SESSION['height'] = $height;
    $_SESSION['width'] = $width;

    if(!is_numeric($height) || !is_numeric($width)){
        echo 'Вы указали нецелочисленное значение!';
        exit();
    }
    if($height == 0 || $width == 0){
        echo 'Лабиринт не может быть с нулевой стороной!';
        exit();
    }

    echo '<form method="post" action="handler.php">';
    echo '<table  ><tbody>';

    $q = 0;
    for($i = 0; $i < $_POST['height']; $i++){
        echo '<tr>';
        for($j = 0; $j <$_POST['width']; $j++){
                echo "<td><input type='text' id='$q' name='$q' value='0'></td>";
                $q++;
        }
        echo '</tr>';
    }
    echo '</tbody></table>';
    echo '<br>
        <p>Номер стартовой клетки: <input type="text" name="st" value="1"/></p>
        <p>Номер финишной клетки: <input type="text" name="fn" value="2"/></p>';
    echo '<p><input type="submit" value="Решение" class="btn btn-primary"/></p>';
    echo '</form>';
    ?>
</body>
</html>