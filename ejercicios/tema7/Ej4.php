<?php
// Nombre de la cookie para almacenar el color de fondo
$cookie_name = "color_fondo";

// Comprobar si el formulario ha sido enviado
if (isset($_POST['color'])) {
    // Obtener el color seleccionado del formulario
    $color = $_POST['color'];
    // Guardar el color seleccionado en una cookie que dura 30 días
    setcookie($cookie_name, $color, time() + (30 * 24 * 60 * 60));
} elseif (isset($_COOKIE[$cookie_name])) {
    // Si la cookie ya existe, usar el color almacenado
    $color = $_COOKIE[$cookie_name];
} else {
    // Color de fondo por defecto si no se ha seleccionado previamente
    $color = "#ffffff"; // Blanco como color de fondo predeterminado
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selecciona el Color de Fondo</title>
</head>
<body style="background-color: <?php echo htmlspecialchars($color); ?>;">

    <h1>Personaliza el Color de Fondo</h1>
    <p>Seleccione un color de fondo para la página:</p>

    <!-- Formulario para seleccionar el color de fondo -->
    <form method="post" action="">
        <label for="color">Elige tu color:</label>
        <input type="color" name="color" id="color" value="<?php echo htmlspecialchars($color); ?>">
        <button type="submit">Guardar color</button>
    </form>

</body>
</html>
