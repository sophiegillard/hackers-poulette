<?php
$host= "localhost";
$db= "poulette";
$user= "sophro";
$password= "123";
$charset= "utf8mb4";

//Data Source Name
$dsn = "mysql:host=$host; dbname=$db; charset=$charset";

try{
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    throw new PDOException('Erreur : '.$e->getMessage(). " la ligne est". $e->getLine());
}

require_once 'crud.php';
$crud = new crud($pdo);

?>
