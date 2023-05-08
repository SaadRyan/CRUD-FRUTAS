<?php
include 'dbf.php';
if (!isset($_GET['id'])) {
    header('Location: listarf.php');
    exit;
}
$id = $_GET['id'];

$stmt = $pdo->prepare('SELECT * FROM frutas WHERE id = ?');
$stmt->execute([$id]);
$appointment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$appointment) {
    header('Location: listarf.php');
    exit;   
}
$nome = $appointment['nome'];
$tamanho = $appointment['tamanho'];
$peso = $appointment['peso'];
$quantidade = $appointment['quantidade'];
$preco = $appointment['preco'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>El Carron's Fair - Atualizar</title>
</head>
<body>
    
<h1>Atualizar Compromisso</h1>
<form method="post">
<label for="nome">Nome:</label>
    <input type="text" name="nome" value="<?php echo $nome; ?>" required></br>

    <label for="tamanho">tamanho</label>
    <input type="text" name="tamanho" value="<?php echo $tamanho; ?>" required></br>

    <label for="peso">peso</label>
    <input type="number" name="peso" value="<?php echo $peso; ?>" required></br>

    <label for="quantidade">quantidade</label>
    <input type="number" name="quantidade" value="<?php echo $quantidade; ?>" required></br>

    <label for="preco">preço</label>
    <input type="number" name="preco" value="<?php echo $preco; ?>" required></br>

    <button type="submit">Atualizar</button>
</form>

</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $tamanho = $_POST['tamanho'];
    $peso = $_POST['peso'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];


    //Validação dos dados do formulário aqui
    $stmt = $pdo->prepare('UPDATE frutas SET nome = ?, tamanho = ?, peso = ?, quantidade = ?, preco = ? WHERE id = ?');
    $stmt->execute([$nome, $tamanho, $peso, $quantidade, $preco, $id]);
    header('Location: listarf.php');
    exit;
}
?>