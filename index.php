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
            <label for="x">Broj redaka</label><br />
            <input type="text" name="x" id="x" value="<?php echo $_POST['x'];?>"><br />

            <label for="y">Broj stupaca</label><br />
            <input type="text" name="y" id="y" value="<?php echo $_POST['y'];?>"><br /><br />
            <input type="submit" value="KREIRAJ TABLICU" id="KREIRAJ TABLICU">
        </form>
    </div>
    <div><?php
        $x = $_POST['x'];
        $y = $_POST['y'];

        function cyclicTable($x, $y, $x1=1, $y1=1, $broj=1, $array=[])
        {
            $maxx = $x;
            $maxy = $y;
            $minx = $x1;
            $miny = $y1;

            if($minx === $maxx || $miny === $maxy) {
                if ($minx === $miny) {
                    $array["$miny-$minx"] = $broj;
                    $broj++;
                    if($maxx>$maxy) {
                        $minx+=1;
                    } elseif($maxx<$maxy){
                        $miny+=1;
                    }
                }
                if($minx > $miny){
                    for (; $minx <= $maxx; $minx++) {
                        $array["$miny-$minx"] = $broj;
                        $broj++;
                    }
                } else if($minx < $miny) {
                    for (; $miny <= $maxy; $miny++) {
                        $array["$miny-$minx"] = $broj;
                        $broj++;
                    }
                }
            }

            for(; $minx<$maxx && $y1<$y; $minx++) {
                $array["$miny-$minx"] = $broj;
                $broj++;
            }

            for(; $miny<$maxy && $x1<$x; $miny++) {
                $array["$miny-$maxx"] = $broj;
                $broj++;
            }

            $maxx = $x;
            $maxy = $y;
            $minx = $x1;
            $miny = $y1;

            for(; $minx<$maxx && $y1<$y; $maxx--) {
                $array["$maxy-$maxx"] = $broj;
                $broj++;
            }

            for(; $miny<$maxy && $x1<$x; $maxy--) {
                $array["$maxy-$minx"] = $broj;
                $broj++;
            }

            $nextx  = $x - 1;
            $nexty  = $y - 1;
            $nextx1 = $x1 + 1;
            $nexty1 = $y1 + 1;
            $nextb  = $broj;

            if($nextx < $nextx1 || $nexty < $nexty1) {
                return $array;
            }

            return cyclicTable($nextx, $nexty, $nextx1, $nexty1, $nextb, $array);

        }

        $array = cyclicTable($x,$y);
        print_r($array);
        ?>

    </div>
</body>
</html>