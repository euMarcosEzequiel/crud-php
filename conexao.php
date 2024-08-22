<?php
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $db = "produtos";

    try{
        $conn = new PDO("mysql:host=$servidor; dbname=$db", $usuario, $senha, array(PDO::ATTR_PERSISTENT => true));
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(Exception $e){
        echo $e->getMessage();
    }  
?>