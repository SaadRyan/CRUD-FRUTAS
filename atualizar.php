<?php
include 'db.php';
if (!isset($_GET['id'])) {
    header('Location: listar.php');
    exit;
}
$id = $_GET['id'];

$stmt = $pdo->prepare('SELECT * FROM cliente WHERE id = ?');
$stmt->execute([$id]);
$appointment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$appointment) {
    header('Location: listar.php');
    exit;   
}
$nome = $appointment['nome'];
$email = $appointment['email'];
$telefone = $appointment['telefone'];
$dtnasc = $appointment['dtnasc'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Carvalho's - Atualizar</title>
</head>
<body>
    
<h1>Atualizar Compromisso</h1>
<form method="post">
<label for="nome">Nome:</label>
    <input type="text" name="nome" value="<?php echo $nome; ?>" required></br>

    <label for="email">E-mail:</label>
    <input type="email" name="email" value="<?php echo $email; ?>" required></br>

    <label for="email">Telefone:</label>
    <input type="text" name="telefone" value="<?php echo $telefone; ?>" required></br>

    <label for="dtnasc">dtnasc:</label>
    <input type="date" name="dtnasc" value="<?php echo $dtnasc; ?>" required></br>

    <button type="submit">Atualizar</button>
</form>

</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $dtnasc = $_POST['dtnasc'];

    //Validação dos dados do formulário aqui
    $stmt = $pdo->prepare('UPDATE cliente SET nome = ?, email = ?, telefone = ?, dtnasc = ? WHERE id = ?');
    $stmt->execute([$nome, $email, $telefone, $dtnasc, $id]);
    header('Location: listar.php');
    exit;
}