<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Carvalho's</title>
</head>
<body class="listar">
    <h1>Carvalho's</h1>
    
<?php
$stmt = $pdo->query('SELECT * FROM cliente ORDER BY dtnasc');
$cliente = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($cliente) == 0) {
    echo '<p>Nenhum pedido feito</p>';
} else {
    echo '<table border="1">';
    echo '<thead><tr><th>Nome</th><th>E-mail</th><th>Telefone</th><th>dtnasc</th><th colspan="3">Opções</th></tr></thead>';
    echo '<tbody>';

    foreach ($cliente as $clientes) {
        echo '<tr>';
        echo '<td>' . $clientes['nome'] . '</td>';
        echo '<td>' . $clientes['email'] . '</td>';
        echo '<td>' . $clientes['telefone'] . '</td>';
        echo '<td>' . date('d/m/y', strtotime($clientes['dtnasc'])) . '</td>';
        echo '<td><a style="color:black;" href="atualizar.php?id=' . $clientes['id'] . '">Atualizar</a></td>';
        echo '<td><a style="color:black;" href="deletar.php?id=' . $clientes['id'] . '">Deletar</a></td>';
        echo '<td><a style="color:black;" href="./fruit/indexf.php?id=' . $clientes['id'] . '">Comprar</a></td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
}
?>
<form method="post" action="index.php">
    <button type="submit" >Voltar</button>
</form>

</body>
</html>