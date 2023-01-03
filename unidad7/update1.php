<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';


$record = [
    'idsingers' => 106,
    'singer_name' => 'Miho Morikawa'
];

update($pdo, 'singers', 'idsingers', $record);