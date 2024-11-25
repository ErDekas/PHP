<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Carta</title>
</head>
<body>
    <h1>Seleccionar una Carta</h1>
    <?php
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Saneamiento y validación de los datos
        $palo = filter_input(INPUT_POST, 'palo', FILTER_SANITIZE_STRING);
        $numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_NUMBER_INT);

        // Validar que el palo sea uno de los valores permitidos
        $palosPermitidos = ['bastos', 'copas', 'espadas', 'oros'];
        if (!in_array($palo, $palosPermitidos)) {
            $error = 'El palo seleccionado no es válido.';
        }

        // Validar el número de la carta (debe ser entre 1 y 12, excluyendo 8 y 9)
        if (!filter_var($numero, FILTER_VALIDATE_INT) || $numero < 1 || $numero > 12) {
            $error = 'El número de carta no es válido.';
        }

        // Si no hay errores, redirigir al controlador para procesar la carta
        if (empty($error)) {
            header("Location: index.php?controller=baraja&action=mostrarCarta&palo=$palo&numero=$numero");
            exit();
        }
    }
    ?>

    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="palo">Selecciona el palo:</label>
        <select name="palo" id="palo" required>
            <option value="">-- Seleccionar --</option>
            <option value="bastos">Bastos</option>
            <option value="copas">Copas</option>
            <option value="espadas">Espadas</option>
            <option value="oros">Oros</option>
        </select>
        <br><br>

        <label for="numero">Selecciona el número:</label>
        <select name="numero" id="numero" required>
            <option value="">-- Seleccionar --</option>
            <?php for ($i = 1; $i <= 12; $i++): ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php endfor; ?>
        </select>
        <br><br>

        <button type="submit">Mostrar Carta</button>
    </form>
    <a href="../cartas/">Volver</a>
</body>
</html>
