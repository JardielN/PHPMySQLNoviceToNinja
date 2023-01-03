<?php

/*
$array = [
    'idsingers' => 30,
    'idauthors' => 4,
];

$query = ' UPDATE `singers` SET';

foreach($array as $key => $value){
    $query .= '`' . $key . '` = :' . $key . ',';
}

$query = rtrim($query, ',');

$query .= ' WHERE `idsingers` = :primaryKey';

echo $query;
*/

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

updateSingerI($pdo,[
    'idsingers' => 100,
    'singer_name' => 'Tito Rodriguez'
] );