<?php
    session_start();
    include_once("../conexao.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="shortcut icon" href="../assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/menu.css">
    <link rel="stylesheet" href="../assets/css/produtos.css">

    <title>CRUD com PHP</title>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            <?php
                if(isset($_SESSION["msg"])){
            ?>
                    alert("<?php echo $_SESSION["msg"]; ?>");
            <?php
                    unset($_SESSION["msg"]);
                }
            ?>
        });
    </script>

</head>
<body>
    <header class="menu">
        <nav class="navigation">
            <ul class="nav-navigation">
                <li class="nav-item">
                    <a href="../index.html" class="nav-link">Home</a>
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
        <table>
            <thead>
                <tr>
                    <th class="table-id">ID</th>
                    <th class='table-nome'>NOME</th>
                    <th class='table-categoria'>CATEGORIA</th>
                    <th class='table-acao'>AÇÃO</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query = $conn->prepare("SELECT * FROM produto");
                    $query->execute();

                    if($query->rowCount() == 0 ){
                        echo "
                            <tr>
                                <td colspan='4'>Nenhum produto cadastrado</td>
                            </tr>
                        ";
                    }
                    else{
                        $linha = $query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_FIRST);
                        do{
                            echo "  
                                <tr>
                                    <td class='table-id'>".$linha[0]."</td>
                                    <td class='table-nome'>".$linha[1]."</td>
                                    <td class='table-categoria'>".$linha[2]."</td>
                                    <td class='table-acao'>
                                        <a class='btn-action btn-alterar' href='../actions/alterar.php?id=".$linha[0]."' title='Alterar'><i class='bx bx-transfer-alt'></i></a>
                                        <a class='btn-action btn-excluir' href='../actions/excluir.php?id=".$linha[0]."' title='Excluir' onclick='return confirm(\"Deseja excluir esse registro?\")'><i class='bx bx-trash'></i></a>
                                    </td>
                                </tr>
                            ";
                        }while($linha = $query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_FIRST));
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>