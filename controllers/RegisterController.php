<?php

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__  . '/../includes/DatabaseFunctions.php';
include __DIR__ . '/../classes/DatabaseTable.php';

class RegisterController{
    private $authorsTable;

    public function __construct(DatabaseTable $authorsTable)
    {
        $this->$authorsTable = $authorsTable;
    }

    public function showForm(){
        
    }
}