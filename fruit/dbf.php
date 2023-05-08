<?php
$host = 'localhost';
$dbname = 'crud_frutas';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;
    charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION);
} catch (PDOExeption $e) {
    echo 'Erro ao conectar ao banco de dados: ' 
    . $e->getMessage();
    exit;
}