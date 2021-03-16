<?php

$hostname = 'localhost';
$username = 'root';
$password = 'boot123';
$database = 'dbo';
 
try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username, $password,
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8","SET character_set_connection=utf8","SET character_set_client=utf8","SET character_set_results=utf8"));
    //echo 'Conexao efetuada com sucesso!';
}
catch(PDOException $e){
    echo $e->getMessage();
}	