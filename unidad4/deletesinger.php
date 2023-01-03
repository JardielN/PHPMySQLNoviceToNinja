<?php
try {
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../includes/DatabaseFunctions.php';
    include __DIR__ . '/../classes/DatabaseTable.php';
    /*
    $sql = 'DELETE FROM `singers` WHERE `idsingers`=:idsingers';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':idsingers', $_POST['idsingers']);
    $stmt->execute();
    */
    //deleteSinger($pdo, $_POST['idsingers']);
    //delete($pdo, 'singers', 'idsingers', $_POST['idsingers']);

    $singersTable = new DatabaseTable($pdo, 'singers', 'idsingers');
    $singersTable->delete($_POST['idsingers']);

    header('location: singers.php');
} catch (PDOException $e) {
    $output = 'Unable to connect to the database server: '
        . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}
include __DIR__ . '/../templates/layout.html.php';
