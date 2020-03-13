<?php

if (!isset($_COOKIE["user"])) {
    echo -2;
    return;
}

$id = $_COOKIE["user"];

$num = $_POST["num"];

$path = "./Games/".(string)$num.".json";

if(file_exists($path)) {
    $file = fopen($path, "r");
} else {
    echo -1;
    return;
}
$arr = array();

$arr = json_decode(fread($file, filesize($path)), true);

fclose($file);

$file1 = fopen($path, "w");

if (count($arr['persons']) < 2) {
    array_push($arr['persons'], $id);
}
else {
    echo -2;
    return;
}

fwrite($file1, json_encode($arr));
fclose($file1);

echo 0;