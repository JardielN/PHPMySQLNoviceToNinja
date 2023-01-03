<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

$record = [
    'singer_name' => 'Miho Morikawa',
    'singer_date' => '1968-05-05',
    'idauthors' => 4,
    'idcategories' => 3,
    'date_added' => new DateTime()
];
insert($pdo, 'singers', $record);