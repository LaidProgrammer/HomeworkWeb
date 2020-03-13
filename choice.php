<?php


$x = $_POST["x"];
$y = $_POST["y"];

$num = $_POST["game"];

$path = "./Games/".(string)$num.".json";

//echo "/home/george/PhpstormProjects/Homework_web/Games/".(string)$num.".json";
//return;

$file = 0;

try {
    $file = fopen($path, "r");
} catch (Exception $e) {
    echo -2;
    return;
}

if (!isset($_COOKIE["user"])) {
    echo -10;
    return;
}

$arr = json_decode(fread($file, filesize($path)), true);
fclose($file);

//if ((string)$_COOKIE["user"] != (string)$arr["persons"][(int)$arr["turn"]]){
//    echo -2;
//    return;
//}

//echo 123213;
//return;

$field = $arr["field"];

$count = count($field);

$row = 0;

if ($count == 3) {
    $row = 3;
}
else if ($count == 4 || $count == 5) {
    $row = 4;
} else {
    $row = 5;
}

$my_x = $_POST["x"];
$my_y = $_POST["y"];

if ($field[$my_x][$my_y] != 0) {
    return -2;
}

$field[$my_x][$my_y] = 1 + (int)($_COOKIE['user'] == $arr["persons"][0]);

$file1 = fopen($path, "w");

fwrite($file1, json_encode($arr));

fclose($file1);

$max = -1;

for ($x = 0; $x < $count; ++$x) {
    for ($y = 0; $y < $count; ++$y) {
        $c = 1;
        for ($i = 1; $i < $count; ++$i) {
            if ($field[$x][$i - 1] == $field[$x][$i] && $field[$x][$i] != 0) {
                ++$c;
                $max = max($max, $c);
            } else {
                $c = 1;
            }
        }

        $c = 1;

        for ($i = 1; $i < $count; ++$i) {
            if ($field[$i - 1][$y] == $field[$i][$y] && $field[$i][$y] != 0) {
                ++$c;
                $max = max($max, $c);
            } else {
                $c = 1;
            }
        }

        if ($x >= $y) {
            $xs = $x - $y;
            $ys = 0;
        } else {
            $ys = $y - $x;
            $xs = 0;
        }

        $c = 1;

        for ($i = 1; ($i + $ys) < $count && ($i + $xs) < $count; ++$i) {
            if ($field[$xs + $i - 1][$ys + $i - 1] == $field[$xs + $i][$ys + $i] && $field[$xs + $i][$ys + $i] != 0) {
                ++$c;
                $max = max($max, $c);
            } else {
                $c = 1;
            }
        }

        if ($x >= $count - 1 - $y) {
            $ys = $count - 1;
            $xs = $x - ($count - 1 - $y);
        } else {
            $xs = $count - 1;
            $ys = ($count - 1 - $y) - $x;
        }

        $c = 1;

        for ($i = 1; ($xs + $i) < $count && ($ys - $i) >= 0; ++$i) {
            if ($field[$xs + $i - 1][$ys - $i + 1] == $field[$xs + $i][$ys - $i] && $field[$xs + $i][$ys - $i] != 0) {
                ++$c;
                $max = max($max, $c);
            } else {
                $c = 1;
            }
        }
    }

}

if ($max >= $row){
    return $arr["persons"][0] == $_COOKIE["user"];
}

$zeros = 0;

for ($i = 0; $i < $count; ++$i){
    for ($j = 0; $j < $count; ++$j){
        if ($field[$i][$j] == 0){
            $zeros = 1;
        }
    }
}

if ($zeros == 0){
    return -1;
}
