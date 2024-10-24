<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir y mostrar datos del formulario
    $usuario = htmlspecialchars($_POST['usuario']);
    $contrasena = htmlspecialchars($_POST['contrasena']);

    echo "<h2>Datos recibidos:</h2>";
    echo "Usuario: " . $usuario . "<br>";
    echo "Contraseña: " . $contrasena;
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
