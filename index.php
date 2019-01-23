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

        function cyclicTable($x, $y, $x1=1, $y1=1, $broj=1)
        {
            $array = [];
            $maxx = $x;
            $maxy = $y;
            $minx = $x1;
            $miny = $y1;

            for($minx; $minx<$maxx && $y1<$y; $minx++) {
                $array["$miny-$minx"] = $broj;
                $broj++;
            }

            for($miny; $miny<$maxy && $x1<$x; $miny++) {
                $array["$miny-$maxx"] = $broj;
                $broj++;
            }

        }
        ?>

    </div>
</body>
</html>