<?php
// Inicialización de la variable de área
$area = null;

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos usando $_REQUEST
    $base = isset($_REQUEST['base']) ? floatval($_REQUEST['base']) : 0;
    $altura = isset($_REQUEST['altura']) ? floatval($_REQUEST['altura']) : 0;

    // Calcular el área del triángulo
    if ($base > 0 && $altura > 0) {
        $area = ($base * $altura) / 2;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculo de Área del Triángulo</title>
</head>
<body>
    <h1>Cálculo del Área del Triángulo</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="base">Base: 
            <input type="number" id="base" name="base" step="0.01" required>
        </label><br>

        <label for="altura">Altura: 
            <input type="number" id="altura" name="altura" step="0.01" required>
        </label><br>

        <input type="submit" value="Calcular Área">
    </form>

    <?php if ($area !== null): ?>
        <h2>Área del triángulo: <?php echo number_format($area, 2); ?> unidades cuadradas</h2>
    <?php endif; ?>
</body>
</html>
