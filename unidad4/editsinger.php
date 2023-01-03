<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';
include __DIR__ . '/../classes/DatabaseTable.php';

$singersTable = new DatabaseTable($pdo, 'singers', 'idsingers');

date_default_timezone_set('America/Matamoros');

try{
    if(isset($_POST['singer'])){
        /*
        updateSinger($pdo, $_POST['idsingers'], $_POST['singer_name'], $_POST['singer_date'], 4);
        header('location: singers.php');
        */
        /*
        updateSingerI($pdo, [
            'idsingers' => $_POST['idsingers'],
            'singer_name' => $_POST['singer_name'],
            'singer_date' => $_POST['singer_date'],
            'idauthors' => 4,
            'idcategories' => 3
        ]);
        */
        /*
        
        update($pdo, 'singers', 'idsingers', [
            'idsingers' => $_POST['idsingers'],
            'singer_name' => $_POST['singer_name'],
            'singer_date' => $_POST['singer_date'],
            'idauthors' => 4,
            'idcategories' => 3
        ]);
         */
        $singer = $_POST['singer'];
        $singer['date_added'] = new DateTime();
        $singer['idauthors'] = 4;
        $singer['idcategories'] = 3;
        /*
        save($pdo, 'singers', 'idsingers', [
            'idsingers' => $_POST['idsingers'],
            'singer_name' => $_POST['singer_name'],
            'singer_date' => $_POST['singer_date'],
            'idauthors' => 4,
            'idcategories' => 3,
            'date_added' => new DateTime()
        ]);
        */
        //save($pdo, 'singers', 'idsingers', $singer);
        $singersTable->save($singer);
        header('location: singers.php');
    }else{
        //$singer = getSinger($pdo, $_GET['idsingers']);
        // $singer = findById($pdo, 'singers', 'idsingers', $_GET['idsingers']);
        if(isset($_GET['idsingers'])){
            //$singer = findById($pdo, 'singers', 'idsingers', $_GET['idsingers']);
            $singer = $singersTable->findById($_GET['idsingers']);
        }
        $title = 'Edit Singer';
        ob_start();
        include __DIR__ . '/../templates/editsinger.html.php';
        $output = ob_get_clean();
    }
}catch(PDOException $e){
    $output = 'Unable to connect to the database server: '
    . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}

include __DIR__ . '/../templates/layout.html.php';