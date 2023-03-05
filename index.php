<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Размер лабиринта</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            margin: 20px;
        }
    </style>
</head>
<body>
    <div>
        Введите размеры лабиринта:
    </div><br>

    <form action="input_data.php" method="post">
        <p>Длина: <input type="text" name="width" /></p>
        <p>Высота: <input type="text" name="height" /></p>
        <p><input type="submit" value="Дальше"/></p>
    </form>
</body>
</html>