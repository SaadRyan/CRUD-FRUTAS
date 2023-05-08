<?php
include 'dbf.php';

if (!isset($_GET['id'])) {
    header ('Location: listar.php');
    exit;
}
$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM frutas WHERE id = ?');
$stmt->execute ([$id]);
$appointment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$appointment) {
    header('Location: listarf.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare('DELETE FROM frutas WHERE id = ?');
    $stmt->execute([$id]);

    header('Location: listarf.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>El Carron's Fair - Deletar</title>
</head>
<body>
    <h1>Deletar sua conta</h1>
    <p>Tem certeza que deseja deletar a conta <?php echo $appointment ['nome']; ?></p>
    <form method="post">
        <button type="submit">Sim</button>
        <a href="listarf.php">Não</a>
</form>
</body>
</html>