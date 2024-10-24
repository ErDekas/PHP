<?php
// Inicialización de variables
$resultado = "";
$error = "";

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Saneamiento de las entradas utilizando filtros de saneamiento
    $numero1 = filter_input(INPUT_POST, 'numero1', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $numero2 = filter_input(INPUT_POST, 'numero2', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $operacion = isset($_POST['operacion']) ? $_POST['operacion'] : '';

    // Verificar que los números sean válidos después del saneamiento
    if ($numero1 !== false && $numero2 !== false && is_numeric($numero1) && is_numeric($numero2)) {
        $numero1 = floatval($numero1);
        $numero2 = floatval($numero2);
    } else {
        $error = "Por favor, ingrese valores numéricos válidos para ambos números.";
    }

    // Validar la operación
    $operaciones_permitidas = ['sumar', 'restar', 'multiplicar', 'dividir'];
    if (empty($error) && in_array($operacion, $operaciones_permitidas)) {
        // Realizar la operación seleccionada
        switch ($operacion) {
            case 'sumar':
                $resultado = $numero1 + $numero2;
                break;
            case 'restar':
                $resultado = $numero1 - $numero2;
                break;
            case 'multiplicar':
                $resultado = $numero1 * $numero2;
                break;
            case 'dividir':
                if ($numero2 != 0) {
                    $resultado = $numero1 / $numero2;
                } else {
                    $error = "No se puede dividir por cero.";
                }
                break;
        }
    } else if (empty($error)) {
        $error = "Operación no válida.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora PHP</title>
</head>
<body>
    <h1>Calculadora Simple</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="numero1">Número 1:
            <input type="number" id="numero1" name="numero1" step="any" required>
        </label><br>

        <label for="numero2">Número 2:
            <input type="number" id="numero2" name="numero2" step="any" required>
        </label><br>

        <input type="submit" name="operacion" value="sumar">
        <input type="submit" name="operacion" value="restar">
        <input type="submit" name="operacion" value="multiplicar">
        <input type="submit" name="operacion" value="dividir">
    </form>

    <?php if ($resultado !== ""): ?>
        <h2>Resultado: <?php echo $resultado; ?></h2>
    <?php endif; ?>

    <?php if ($error): ?>
        <h2 style="color: red;"><?php echo $error; ?></h2>
    <?php endif; ?>
</body>
</html>
