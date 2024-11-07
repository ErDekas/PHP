<?php
// Verificamos si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recogemos el nombre de usuario y el tiempo para la cookie
    $usuario = $_POST['usuario'];
    $tiempo = $_POST['tiempo'];
    
    // Establecemos la cookie con el tiempo ingresado por el usuario
    setcookie("usuario", $usuario, time() + $tiempo);
}

// Verificamos si la cookie existe
if (isset($_COOKIE['usuario'])) {
    $usuario = $_COOKIE['usuario'];
    echo "La cookie usuario tiene valor $usuario.";
} else {
    echo "!No hay ninguna cookie almacenada!";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cookie con tiempo establecido</title>
</head>
<body>
    <h2>Crear una cookie con un tiempo determinado</h2>
    <form method="post" action="">
        <label for="usuario">Nombre de usuario:</label>
        <input type="text" id="usuario" name="usuario" required><br><br>

        <label for="tiempo">Tiempo de expiración de la cookie (segundos):</label>
        <input type="number" id="tiempo" name="tiempo" min="1" max="60" required><br><br>

        <button type="submit">Establecer Cookie</button>
    </form>
</body>
</html>
