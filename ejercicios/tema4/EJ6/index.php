<?php
// Inicialización de variables
$nombre = "";
$telefono = "";
$email = "";
$mensaje = "";

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $email = htmlspecialchars($_POST['email']);

    // Generar mensaje
    $mensaje = "¡Buenos días, $nombre!<br>";
    $mensaje .= "Te voy a enviar spam a $email y te llamaré de madrugada a $telefono.<br>";
    $mensaje .= "Enviado desde un iPhone.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Spam</title>
</head>
<body>
    <h1>Formulario de Spam</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="nombre">Nombre: 
            <input type="text" id="nombre" name="nombre" required>
        </label><br>

        <label for="telefono">Teléfono: 
            <input type="tel" id="telefono" name="telefono" required>
        </label><br>

        <label for="email">Email: 
            <input type="email" id="email" name="email" required>
        </label><br>

        <input type="submit" value="Enviar">
    </form>

    <?php if ($mensaje): ?>
        <h2><?php echo $mensaje; ?></h2>
    <?php endif; ?>
</body>
</html>
