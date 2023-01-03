<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';
include __DIR__ . '/../classes/DatabaseTable.php';

$singersTable = new DatabaseTable($pdo, 'singers', 'idsingers');

// Find the singer with the id `52`
$singer52 = $singersTable->findById(52);
echo $singer52['singer_name'] . '<br><br>';

// Find all the singers
$singers = $singersTable->findAll();
foreach($singers as $singer){
    echo $singer['singer_name'] . '<br>';
}

//$singersTable->delete(118);

/*
$newSinger = [
    'singer_name' =>'Faisy',
    'singer_date' => '1979-09-19',
    'idauthors' => 4,
    'idcategories' => 3,
    'date_added' => new DateTime()
];
$singersTable->save($newSinger);
*/