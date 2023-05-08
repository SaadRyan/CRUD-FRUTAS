<?php
require_once 'dbf.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Carvalho's</title>
</head>
<body>
    <section class="container-e">
    <h1>Comprar</h1>
    
    <?php
    if (isset($_POST['submit'])) {
        $nome = $_POST['nome'];
        $tamanho = $_POST['tamanho'];
        $peso = $_POST['peso'];
        $quantidade = $_POST['quantidade'];
        $preco = $_POST['preco'];

        $stmt = $pdo->prepare('SELECT COUNT(*)
        FROM frutas WHERE preco = ?');
        $stmt->execute([$preco]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            $error = 'Já existe um usuário com esse nome.';
        } else {
            
            $stmt = $pdo->prepare('INSERT INTO frutas (nome, tamanho, peso, quantidade, preco) VALUES (:nome, :tamanho, :peso, :quantidade, :preco)');
            $stmt->execute(['nome' => $nome, 'tamanho' => $tamanho, 'peso' => $peso, 'quantidade' => $quantidade, 'preco' => $preco]);

            if ($stmt->rowCount ()) {
                echo '<span>Compra feita com sucesso!</span>';
            } else {
                echo '<span>Erro ao fazer a compra. Tente novamente mais tarde.</span>';
            }
        }
        if (isset($error)) {
            echo '<span>' . $error . '</span>';
        }
    }
    ?>

    <form method="post">

    <label for="nome">Nome:</label>
    <input type="text" name="nome" required></br>

    <label for="tamanho">Tamanho:</label>
    <input type="text" name="tamanho" required></br>

    <label for="peso">Peso:</label>
    <input type="text" name="peso" required></br>

    <label for="quantidade">Quantidade:</label>
    <input type="text" name="quantidade" required></br>

    <label for="preco">Preço:</label>
    <input type="text" name="preco" required></br>
    
    <div>
        <button type="submit" name="submit" value="agendar">COMPRAR</button></br>
        <button><a href="listarf.php">Listar</a></button>
    </div>
    
</form>

</div>
</section>
</body>
</html>