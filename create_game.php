<?php
$size = $_POST["size"];

if(!isset($_COOKIE["user"])) {
//    echo -2;
    echo $_COOKIE["user"];
    return;
}

$id = $_COOKIE["user"];

if ($size < 3) {
     echo -1;
     return;
}

try {
    $game_num = random_int(0, time());
} catch (Exception $e) {
    $game_num = time();
}

$filename = "./Games/".(string)$game_num.".json";

$field = array();

for ($i = 0; $i < $size; ++$i) {
    for ($j = 0; $j < $size; ++$j) {
        $field[$i][$j] = 0;
    }
}

$info = array(
    "persons" => array($id),
    "field" => $field,
    "turn" => 0
);

$file = fopen($filename, "w");
fwrite($file, json_encode($info));
fclose($file);

echo $game_num;
