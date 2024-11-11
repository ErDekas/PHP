<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$usuario = $_SESSION['usuario'];
$rol = $_SESSION['rol'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Protegida</title>
</head>

<body>
    <h1>Bienvenido, <?= htmlspecialchars($usuario) ?>!</h1>

    <?php if ($rol === 'admin'): ?>
        <p>Tienes permisos de administrador.</p>
    <?php else: ?>
        <p>Eres un usuario normal.</p>
    <?php endif; ?>

    <a href="cerrar_sesion.php">Cerrar sesión</a>
</body>

</html>