<?php
try{
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__  . '/../includes/DatabaseFunctions.php';
include __DIR__ . '/../classes/DatabaseTable.php';
$output = 'Connection exitosa';

$singersTable = new DatabaseTable($pdo, 'singers', 'idsingers');
$authorsTable = new DatabaseTable($pdo, 'authors', 'id_author');

/*
$sql = 'SELECT `singers`.`idsingers`, `singer_name`,
`date_added`, `name_author`, `email_author` FROM
`singers` INNER JOIN `authors` ON `idauthors` = `authors`.`id_author`';
$singers = $pdo->query($sql);
*/
/*
$singers = allSingers($pdo);
$totalSingers = totalSingers($pdo);
*/
/*
foreach($result as $row){
    $singers[] = array('idsingers' => $row['idsingers'], 'singer_name' => $row['singer_name']);
}

$singers = $result;

$result = findAll($pdo, 'singers');
$singers = [];

foreach($result as $singer){
    $author = findById($pdo, 'authors', 'id_author', $singer['idauthors']);

    $singers[] = [
        'idsingers' => $singer['idsingers'],
        'singer_name' => $singer['singer_name'],
        'date_added' => $singer['date_added'],
        'name_author' => $author['name_author'],
        'email_author' => $author['email_author']
    ];
}
*/

$result = $singersTable->findAll();

$singers = [];
foreach($result as $singer){
    $author = $authorsTable->findById($singer['idauthors']);
    $singers[] = [
        'idsingers' => $singer['idsingers'],
        'singer_name' => $singer['singer_name'],
        'date_added' => $singer['date_added'],
        'name_author' => $author['name_author'],
        'email_author' => $author['email_author']
    ];
}

$title = 'Singer List';

//$totalSingers = total($pdo, 'singers');
$totalSingers = $singersTable->total();
ob_start();
include __DIR__ . '/../templates/singers.html.php';
$output = ob_get_clean();

}catch(PDOException $e){
    $output = 'Unable to connect to the database server: '
    . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}
include __DIR__ . '/../templates/layout.html.php';