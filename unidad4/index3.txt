<?php

function loadTemplate($templateFileName, $variables = []){
    extract($variables);

    ob_start();

    include __DIR__ . '/../templates/' . $templateFileName;

    return ob_get_clean();
}

try{
    
    include __DIR__ . '/../classes/DatabaseTable.php';
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__  . '/../includes/DatabaseFunctions.php';
    $singersTable = new DatabaseTable($pdo, 'singers', 'idsingers');
    $authorsTable = new DatabaseTable($pdo, 'authors', 'id_author');

    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
    
    if($route == strtolower($route)){
        if($route == 'singer/list'){
            include __DIR__ . '/../controllers/SingerController.php';
            $controller = new SingerController($singersTable, $authorsTable);
            $page = $controller->list();
        }elseif ($route == 'singer/home') {
            include __DIR__ . '/../controllers/SingerController.php';
            $controller = new SingerController($singersTable, $authorsTable);
            $page = $controller->home();
        }elseif($route == 'singer/edit'){
            include __DIR__ . '/../controllers/SingerController.php';
            $controller = new SingerController($singersTable, $authorsTable);
            $page = $controller->edit();
        }elseif($route == 'singer/delete'){
            include __DIR__ . '/../controllers/SingerController.php';
            $controller = new SingerController($singersTable, $authorsTable);
            $page = $controller->delete();
        }elseif($route == 'singer/register'){
            include __DIR__ . '/../controllers/RegisterController.php';
            $controller = new RegisterController($authorsTable);
            $page = $controller->showForm();
        }
    }else{
        http_response_code(301);
        header('location: index.php?route=' . strtolower($route));
    }

    $title = $page['title'];

    if(isset($page['variables'])){
        $output = loadTemplate($page['template'],
        $page['variables']);
    }else{
        $output = loadTemplate($page['template']);
    }

   

}catch(PDOException $e){
    $output = 'Unable to connect to the database server: '
    . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}
include __DIR__ . '/../templates/layout.html.php';