<?php
session_start();

// Verificar si el usuario está logueado, si no lo está redirigir a login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Obtener el nombre de usuario desde la sesión
$nombreUsuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página Protegida</title>
</head>
<body>
    <h2>Bienvenido, <?php echo $nombreUsuario; ?>!</h2>
    <p>Ha iniciado sesión como <?php echo $nombreUsuario; ?>.</p>

    <form method="POST" action="cerrar_sesion.php">
        <button type="submit">Cerrar sesión</button>
    </form>
</body>
</html>
