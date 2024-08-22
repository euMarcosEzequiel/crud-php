<?php
    session_start();
    include_once("conexao.php");

    $id = $_GET["id"];

    if($id){
        $query = $conn->prepare("DELETE FROM produto WHERE id = $id");
        if($query->execute()){
            $_SESSION["msg"] = "Produto excluído com sucesso.";
            header("Location: produtos.php");
            exit;
        }
    }
    else{
        header("Location: produtos.php");
    }
?>