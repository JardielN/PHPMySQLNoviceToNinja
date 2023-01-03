<?php
if (isset($_POST['singer_name']) && isset($_POST['singer_date'])) {
    try {
        include __DIR__ . '/../includes/DatabaseConnection.php';
        include __DIR__ . '/../includes/DatabaseFunctions.php';

        /*
        $sql = 'INSERT INTO `singers` SET
            `singer_name` = :singer_name,
            `singer_date` = :singer_date,
            `date_added` = CURDATE()';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':singer_name', $_POST['singer_name']);
        $stmt->bindValue(':singer_date', $_POST['singer_date']);

        $stmt->execute();
        */
        /*
        insertSinger($pdo, $_POST['singer_name'], $_POST['singer_date'], 4, 3);
        */
        /*
        insertSingerI($pdo,[
            'singer_name' => $_POST['singer_name'],
            'singer_date' => $_POST['singer_date'],
            'idauthors' => 4,
            'idcategories' => 3,
            'date_added' => new DateTime()
        ]);
        */
        insert($pdo, 'singers', ['idauthors' => 4, 'idcategories' => 3, 'singer_name' => $_POST['singer_name'], 'singer_date' => $_POST['singer_date'], 'date_added' => new DateTime()]);
        header('location:singers.php');
    } catch (PDOException $e) {
        $output = 'Unable to connect to the database server: '
            . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
    }
} else {
    $title = 'Add a new Singer';
    ob_start();
    include __DIR__ . '/../templates/addsinger.html.php';
    $output = ob_get_clean();
}
include __DIR__ . '/../templates/layout.html.php';
