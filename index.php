<?php

function cyclicTable($x, $y, $x1 = 1, $y1 = 1, $broj = 1, $array = [])
{
    $maxx = $x;
    $maxy = $y;
    $minx = $x1;
    $miny = $y1;

    if ($minx === $maxx || $miny === $maxy) {
        if ($minx === $miny) {
            $array["$miny-$minx"] = $broj;
            $broj++;
            if ($maxx > $maxy) {
                $minx += 1;
            } elseif ($maxx < $maxy) {
                $miny += 1;
            }
        }
        if ($minx > $miny) {
            for (; $minx <= $maxx; $minx++) {
                $array["$miny-$minx"] = $broj;
                $broj++;
            }
        } else if ($minx < $miny) {
            for (; $miny <= $maxy; $miny++) {
                $array["$miny-$minx"] = $broj;
                $broj++;
            }
        }
    }

    for (; $minx < $maxx && $y1 < $y; $minx++) {
        $array["$miny-$minx"] = $broj;
        $broj++;
    }

    for (; $miny < $maxy && $x1 < $x; $miny++) {
        $array["$miny-$maxx"] = $broj;
        $broj++;
    }

    $maxx = $x;
    $maxy = $y;
    $minx = $x1;
    $miny = $y1;

    for (; $minx < $maxx && $y1 < $y; $maxx--) {
        $array["$maxy-$maxx"] = $broj;
        $broj++;
    }

    for (; $miny < $maxy && $x1 < $x; $maxy--) {
        $array["$maxy-$minx"] = $broj;
        $broj++;
    }

    $nextx = $x - 1;
    $nexty = $y - 1;
    $nextx1 = $x1 + 1;
    $nexty1 = $y1 + 1;
    $nextb = $broj;

    if ($nextx < $nextx1 || $nexty < $nexty1) {
        return $array;
    }

    return cyclicTable($nextx, $nexty, $nextx1, $nexty1, $nextb, $array);

}

if(isset($_POST['x']) && isset($_POST['y'])) {
    $array = cyclicTable($_POST['x'], $_POST['y']);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/mycss.css"
</head>
<body>
    <div class="main">
        <div class="input">
            <p class="verticaltext">INPUT</p>
        </div>
        <div class="form">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <label for="y">Broj redaka</label><br/>
                <input type="text" name="y" id="y" value="<?php echo $_POST['y']; ?>" required><br/><br/>
                <label for="x">Broj stupaca</label><br/>
                <input type="text" name="x" id="x" value="<?php echo $_POST['x']; ?>" required><br/><br/>
                <input type="submit" value="KREIRAJ TABLICU" id="submit">
            </form>
        </div><?php
        if(isset($_POST['x']) && isset($_POST['y'])):   ?>
            <div class="output">
                <p class="verticaltext">OUTPUT</p>
            </div>
            <div>
                <table class="table">
                    <tbody><?php
                    // $i represents rows in table, $j represents columns
                    for ($i = 1; $i <= $_POST['y']; $i++) { ?>
                        <tr><?php
                        for ($j = 1; $j <= $_POST['x']; $j++) {?>
                            <td class="td  <?php
                                $j1 = $j - 1;
                                $j2 = $j + 1;
                                $i1 = $i - 1;
                                $i2 = $i + 1;
                                if($array["$i-$j1"]-1===$array["$i-$j"]){
                                    echo " td1";
                                } else if($array["$i-$j2"]-1===$array["$i-$j"]){
                                    echo " td2";
                                } else if($array["$i1-$j"]-1===$array["$i-$j"]){
                                    echo " td3";
                                } else if($array["$i2-$j"]-1===$array["$i-$j"]){
                                    echo " td4";
                                }
                            ?>
                            "><?php
                                echo $array["$i-$j"]; ?>
                            </td><?php
                        } ?>
                        </tr><?php
                    } ?>
                    </tbody>
                </table>
            </div>
    <?php endif;?>
    </div>
</body>
</html>