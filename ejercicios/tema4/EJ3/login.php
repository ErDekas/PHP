<?php
// Procesar el formulario de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = htmlspecialchars($_POST['usuario']);
    $contrasena = htmlspecialchars($_POST['contrasena']);

    // Comprobación de las credenciales
    if ($usuario === "usuario" && $contrasena === "1234") {
        // Redirigir a la página de bienvenida
        header("Location: index.php");
        exit();
    } else {
        // Redirigir a la página de error
        header("Location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="" method="post">
        <label for="usuario">Usuario: 
            <input type="text" id="usuario" name="usuario" required>
        </label><br>

        <label for="contrasena">Contraseña: 
            <input type="password" id="contrasena" name="contrasena" required>
        </label><br>

        <input type="submit" value="Entrar">
    </form>
</body>
</html>
