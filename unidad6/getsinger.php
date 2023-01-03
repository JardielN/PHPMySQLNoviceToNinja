<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

$singer1 = getSinger($pdo, 60);
echo $singer1['singer_name'];