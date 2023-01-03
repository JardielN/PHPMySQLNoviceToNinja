<?php
$pdo = new PDO('mysql:host=localhost;dbname=artists;
charset=utf8; port=3307', 'root', 'root');
$pdo->setAttribute(PDO::ATTR_ERRMODE,
PDO::ERRMODE_EXCEPTION);