<?php

// Whole code is made by me, DID NOT check internet for sources. Was test to see if I can do it alone


// This is a recursive function is taking in 6 parameters, 2 are required and 4 optional
// It will loop through outer cells and columns first and mark their locations as key ("column-row") and save their value
// After the outer is done, it will go deeper till no more cells are unmarked
// Array will be returned with all cells and their values
function cyclicTable($x, $y, $x1 = 1, $y1 = 1, $broj = 1, $array = [[]])
{
    $maxx = $x;
    $maxy = $y;
    $minx = $x1;
    $miny = $y1;

    if ($minx === $maxx || $miny === $maxy) {
        if ($miny === $minx) {
            $array[$minx][$miny] = $broj;
            $broj++;
            if ($maxy > $maxx) {
                $miny += 1;
            } elseif ($maxy < $maxx) {
                $minx += 1;
            }
        }
        if ($miny > $minx) {
            for (; $miny <= $maxy; $miny++) {
                 $array[$minx][$miny] = $broj;
                $broj++;
            }
        } else if ($miny < $minx) {
            for (; $minx <= $maxx; $minx++) {
                 $array[$minx][$miny] = $broj;
                $broj++;
            }
        }
    }

    for (; $miny < $maxy && $x1 < $x; $miny++) {
        $array[$minx][$miny] = $broj;
        $broj++;
    }

    for (; $minx < $maxx && $y1 < $y; $minx++) {
        $array[$minx][$maxy] = $broj;
        $broj++;
    }

    $maxx = $x;
    $maxy = $y;
    $minx = $x1;
    $miny = $y1;

    for (; $miny < $maxy && $x1 < $x; $maxy--) {
        $array[$maxx][$maxy] = $broj;
        $broj++;
    }

    for (; $minx < $maxx && $y1 < $y; $maxx--) {
        $array[$maxx][$miny] = $broj;
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

    return cyclicTable($nextx, $nexty, $nexty1, $nextx1, $nextb, $array);

}


if(isset($_POST['x']) && isset($_POST['y'])):
    $array = cyclicTable($_POST['x'], $_POST['y']);
    function output() {
        echo "<div class='output'>";
            echo "<p class='verticaltext'>OUTPUT</p>";
        echo "</div>";
    };

    // Here we created function that will create the table for us
    // We are checking for previous cell and adding line that will show from which cell previous number came
    // IF statement will go through all 4 possible position the previous cell could come from
    function createTable($x,$y,$array)
    {
        echo "<div>";
            echo "<table class='table'>";
                echo "<tbody>";
                for ($i = 1; $i <= $x; $i++) {
                    echo "<tr>";
                    for ($j = 1; $j <= $y; $j++) {
                        echo "<td class='td ";
                            if($array[$i][($j-1)]-1===$array[$i][$j]){
                                echo ' td1';
                            } else if($array[$i][($j+1)]-1===$array[$i][$j]){
                                echo ' td2';
                            } else if($array[($i-1)][$j]-1===$array[$i][$j]){
                                echo ' td3';
                            } else if($array[($i+1)][$j]-1===$array[$i][$j]){
                                echo ' td4';
                            }
                        echo "'>";
                            echo $array[$i][$j];
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                echo "</tbody>";
            echo "</table>";
        echo "</div>";
    }
endif;
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
                <label for="x">Broj redaka</label><br/>
                <input type="text" name="x" id="x" value="<?php if(isset($_POST['x'])) { echo $_POST['x']; }?>" required><br/><br/>
                <label for="y">Broj stupaca</label><br/>
                <input type="text" name="y" id="y" value="<?php if(isset($_POST['y'])) { echo $_POST['y']; }?>" required><br/><br/>
                <input type="submit" value="KREIRAJ TABLICU" id="submit">
            </form>
        </div><?php
        // If POST method is fired, it will show this code
        if(isset($_POST['x']) && isset($_POST['y'])) {
            output();
            createTable($_POST['x'], $_POST['y'], $array);
        }?>
    </div>
</body>
</html>