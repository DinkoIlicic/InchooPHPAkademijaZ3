<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <p>Broj redaka</p><br />
            <input type="text" name="x"><br />

            <p>Broj stupaca</p>
            <input type="text" name="y"><br /><br />
            <input type="submit" value="KREIRAJ TABLICU">
        </form>
    </div>
    <div><?php
        $x = $_POST['x'];
        $y = $_POST['y'];
        ?>

    </div>
</body>
</html>