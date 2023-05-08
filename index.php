<?php
require_once 'db.php';
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
    <h1>Cadastro</h1>
    
    <?php
    if (isset($_POST['submit'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $dtnasc = $_POST['dtnasc'];

        $stmt = $pdo->prepare('SELECT COUNT(*)
        FROM cliente WHERE dtnasc = ?');
        $stmt->execute([$dtnasc]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            $error = 'Já existe um usuário com esse nome.';
        } else {
            
            $stmt = $pdo->prepare('INSERT INTO cliente (nome, email, telefone, dtnasc) VALUES (:nome, :email, :telefone, :dtnasc)');
            $stmt->execute(['nome' => $nome, 'email' => $email, 'telefone' => $telefone, 'dtnasc' => $dtnasc]);

            if ($stmt->rowCount ()) {
                echo '<span>Conta criada com sucesso!</span>';
            } else {
                echo '<span>Erro ao criar a conta. Tente novamente mais tarde.</span>';
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

    <label for="email">E-mail:</label>
    <input type="email" name="email" required></br>

    <label for="email">Telefone:</label>
    <input type="text" name="telefone" required></br>

    <label for="dtnasc">Data Nascimento:</label>
    <input type="date" name="dtnasc" required></br>
    
    <div>
        <button type="submit" name="submit" value="agendar">CRIAR</button></br>
        <button><a href="listar.php">Listar</a></button>
    </div>
    
</form>

</div>
</section>
</body>
</html>