<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

$singers = allSingers($pdo);

echo '<ul>';
foreach($singers as $singer){
    echo '<li>' . $singer['singer_name'] . '</li>';
}
echo '</ul>';