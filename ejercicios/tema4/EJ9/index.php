<?php
// Inicialización de variables
$nombre = "";
$telefono = "";
$email = "";
$mensaje = "";
$errores = [];

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar y limpiar los datos
    $nombre = stripslashes(trim($_POST['nombre']));
    $telefono = stripslashes(trim($_POST['telefono']));
    $email = stripslashes(trim($_POST['email']));

    // Validaciones
    if (empty($nombre) || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $nombre)) {
        $errores[] = "El nombre es inválido. Solo se permiten letras.";
    }

    if (empty($telefono) || !preg_match("/^\d{9}$/", $telefono)) {
        $errores[] = "El teléfono debe tener exactamente 9 dígitos.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo electrónico no es válido.";
    }

    // Si no hay errores, mostrar los datos
    if (empty($errores)) {
        $mensaje = "Nombre: $nombre<br>Teléfono: $telefono<br>Email: $email";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Amigos</title>
</head>
<body>
    <h1>Formulario de Amigos</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="nombre">Nombre: 
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
        </label><br>

        <label for="telefono">Teléfono: 
            <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($telefono); ?>" required>
        </label><br>

        <label for="email">Email: 
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        </label><br>

        <input type="submit" value="Enviar">
    </form>

    <?php if (!empty($errores)): ?>
        <h2>Errores:</h2>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if ($mensaje): ?>
        <h2>Datos Validados:</h2>
        <p><?php echo $mensaje; ?></p>
    <?php endif; ?>
</body>
</html>
