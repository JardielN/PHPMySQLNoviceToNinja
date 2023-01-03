<?php
include __DIR__ . '/../includes/DatabaseConnection.php';

function totalSingers($pdo){
    $query = $pdo->prepare('SELECT COUNT(*) FROM `singers`');
    $query->execute();
    $row = $query->fetch();
    return $row[0];
}

echo totalSingers($pdo);