<?php
    session_start();
    include_once("conexao.php");

    $id = $_GET["id"];

    if($id){
        $query =  $conn->prepare("SELECT * FROM produto WHERE id = $id");
        $query->execute();

        $linha = $query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_FIRST);
    }
    else{
        header("Location: produtos.php");
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $id_produto = $_POST["id"];
        $nome = $_POST["nome"];
        $categoria = $_POST["categoria"];

        if(empty($nome) || empty($categoria)){
            $_SESSION["msg"] = "Preencha todos os campos.";
            header("Location: alterar.php?id=".$id);
            exit;
        }
        else{
            $query = $conn->prepare("UPDATE produto SET nome = '$nome', categoria = '$categoria' WHERE id = $id");
            
            if($query->execute()){
                $_SESSION["msg"] = "Produto alterado com sucesso.";
                header("Location: produtos.php");
                exit;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/menu.css">
    <link rel="stylesheet" href="assets/css/form.css">

    <title>CRUD com PHP</title>
</head>
<body>
    <header class="menu">
        <nav class="navigation">
            <ul class="nav-navigation">
                <li class="nav-item">
                    <a href="index.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="cadastrar.php" class="nav-link">Cadastrar</a>
                </li>
                <li class="nav-item">
                    <a href="produtos.php" class="nav-link">Produtos</a>
                </li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="form-box">
            <form action="" method="post">
                <h3>Alterar</h3>

                <div class="input-box">
                    <label for="id">ID:</label>
                    <input type="text" name="id" id="id" value="<?php echo $linha[0]; ?>" disabled>
                </div>

                <div class="input-box">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" value="<?php echo $linha[1]; ?>" required>
                </div>

                <div class="input-box">
                    <label for="categoria">Categoria:</label>
                    <select name="categoria" id="categoria">
                        <option value="">Selecionar</option>
                        <option value="Alimento">Alimento</option>
                        <option value="Bebida">Bebida</option>
                    </select>
                </div>

                <div class="message-box">
                    <?php
                        if(isset($_SESSION["msg"])){
                            echo $_SESSION["msg"];
                            unset($_SESSION["msg"]);
                        }
                    ?>
                </div>

                <div class="btn-box">
                    <button class="btn" type="submit">Alterar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>