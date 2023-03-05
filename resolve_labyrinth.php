<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Решение</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style type="text/css">
        TABLE {
            width: 300px;
            border-collapse: collapse;
        }
        TD, TH {
            padding: 3px;
            border: 1px solid black;
        }
        body {
            margin: 20px;
        }
    </style>
</head>
<body>
    <?php
    include 'GraphHelper.php';
    error_reporting(E_ERROR | E_PARSE);
    session_start();

    $a = array();
    $labyrinth_arr = array();
    $labyrinth_col = $_SESSION['width'];
    $labyrinth_rows = $_SESSION['height'];
    $start = $_POST['st'] - 1;
    $end = $_POST['fn'] - 1;

    if(!is_numeric($labyrinth_col) || !is_numeric($labyrinth_rows) || !is_numeric($start) || !is_numeric($end)){
        echo 'Вы указали нецелочисленное значение!';
        exit();
    }
    for($i = 0; $i < $labyrinth_rows; $i++){
        for($j = 0; $j < $labyrinth_col; $j++){
            if(!is_numeric($_POST[$i * $labyrinth_col + $j])){
                echo 'Вы ввели нечисловое значение!';
                exit();
            }
            $labyrinth_arr[$i][] = $_POST[$i * $labyrinth_col + $j];
        }
    }

    $j = 0;
    $graph_arr = array();
    for($i = 0; $i < sizeof($labyrinth_arr) * sizeof($labyrinth_arr[0]); $i++){
        $y = intdiv($i , $labyrinth_col);
        $x = $i % $labyrinth_col;

        if($labyrinth_arr[$y][$x + 1] != 0 && $labyrinth_arr[$y][$x] != 0 && !in_array([$i, $i + 1], $graph_arr)){
            $graph_arr[$j++] = [$i, $i + 1];
            $graph_arr[$j++] = [$i + 1, $i];
        }
        if($labyrinth_arr[$y][$x - 1] != 0 && $labyrinth_arr[$y][$x] != 0 && !in_array([$i, $i - 1], $graph_arr)){
            $graph_arr[$j++] = [$i, $i - 1];
            $graph_arr[$j++] = [$i - 1, $i];
        }
        if($labyrinth_arr[$y + 1][$x] != 0 && $labyrinth_arr[$y][$x] != 0 && !in_array([$i + $labyrinth_col, $i], $graph_arr)){
            $graph_arr[$j++] = [$i + $labyrinth_col, $i];
            $graph_arr[$j++] = [$i, $i + $labyrinth_col];
        }
        if($labyrinth_arr[$y - 1][$x] != 0 && $labyrinth_arr[$y][$x] != 0 && !in_array([$i - $labyrinth_col, $i], $graph_arr)){
            $graph_arr[$j++] = [$i, $i - $labyrinth_col];
            $graph_arr[$j++] = [$i - $labyrinth_col, $i];
        }
    }

    $pathInfo = GraphHelper::calculate_near($graph_arr);

    $path = GraphHelper::dfs($pathInfo, $start, $end);

    $min_s = 999999;
    $min_ind = 0;
    $s = 0;
    for($i = 0; $i < sizeof($path); $i++){
        for($j = 0; $j < sizeof($path[$i]); $j++){
            $y = intdiv($path[$i][$j], $labyrinth_col);
            $x = $path[$i][$j] % $labyrinth_col;
            $s += $labyrinth_arr[$y][$x];
        }
        if($s < $min_s){
            $min_s = $s;
            $min_ind = $i;
        }
        $s = 0;
    }
    $incr_path = $path[$min_ind];
    for($i = 0; $i < sizeof($incr_path); $i++){
        $incr_path[$i]++;
    }
    try {
        echo 'Самый короткий путь проходит по клеткам с номерами: ' . implode(', ', $incr_path) . '<br>';
        echo 'Расстояние=' . $min_s;
    }catch (TypeError $ex){
        echo 'Лабиринт пройти невозможно! Исправьте входные данные.';
        exit();
    }


    $q = 0;
    echo '<table><tbody>';
    for($i = 0; $i < $labyrinth_rows; $i++){
        echo '<tr>';
        for($j = 0; $j <$labyrinth_col; $j++){
            if(in_array($q, $path[$min_ind])){
                echo '<td BGCOLOR="#adff2f">';
            }else {
                echo '<td>';
            }
            echo $labyrinth_arr[$i][$j];
            $q++;
            echo '</td>';
        }
        echo '</tr>';
    }
    echo '</tbody></table>';
    ?>
</body>
</html>
