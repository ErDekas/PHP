<?php
session_start();

// Verificar si el usuario ya está logueado
if (isset($_SESSION['usuario'])) {
    header("Location: protegido.php");
    exit();
}

// Datos de usuario y contraseña
$usuario_correcto = "admin";
$contraseña_correcta = "1234";

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    // Validar las credenciales
    if ($usuario == $usuario_correcto && $contraseña == $contraseña_correcta) {
        $_SESSION['usuario'] = $usuario;  // Crear la sesión
        header("Location: protegido.php");  // Redirigir a la página protegida
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Iniciar sesión</h2>

    <?php
    // Mostrar mensaje de error si las credenciales son incorrectas
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>

    <form method="POST" action="">
        <label for="usuario">Usuario:</label><br>
        <input type="text" name="usuario" required><br><br>

        <label for="contraseña">Contraseña:</label><br>
        <input type="password" name="contraseña" required><br><br>

        <button type="submit">Iniciar sesión</button>
    </form>
</body>
</html>
