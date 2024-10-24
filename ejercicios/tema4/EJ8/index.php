<?php
// Inicialización de variables
$mensaje = "";

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $anioNacimiento = intval($_POST['anio']);
    $mesNacimiento = intval($_POST['mes']);
    $diaNacimiento = intval($_POST['dia']);

    // Calcular la edad
    $fechaNacimiento = new DateTime("$anioNacimiento-$mesNacimiento-$diaNacimiento");
    $fechaActual = new DateTime();
    $edad = $fechaActual->diff($fechaNacimiento)->y;

    // Mensajes según la edad
    if ($edad < 18) {
        $mensaje = "¡Eres menor de edad! Ve a casa a dormir.";
    } elseif ($edad > 85) {
        $mensaje = "Eres demasiado mayor para entrar en este local.";
    } else {
        $mensaje = "¡Puedes pasar dentro!";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Edad</title>
</head>
<body>
    <h1>Calculadora de Edad</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="anio">Año de nacimiento: 
            <input type="number" id="anio" name="anio" required>
        </label><br>

        <label for="mes">Mes de nacimiento: 
            <input type="number" id="mes" name="mes" min="1" max="12" required>
        </label><br>

        <label for="dia">Día de nacimiento: 
            <input type="number" id="dia" name="dia" min="1" max="31" required>
        </label><br>

        <input type="submit" value="Calcular Edad">
    </form>

    <?php if ($mensaje): ?>
        <h2><?php echo $mensaje; ?></h2>
    <?php endif; ?>
</body>
</html>
