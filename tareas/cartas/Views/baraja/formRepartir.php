<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repartir Cartas</title>
</head>
<body>
    <h1>Repartir Cartas</h1>
    <?php
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Saneamiento y validación de los datos
        $jugadores = filter_input(INPUT_POST, 'jugadores', FILTER_SANITIZE_NUMBER_INT);
        $cartas = filter_input(INPUT_POST, 'cartas', FILTER_SANITIZE_NUMBER_INT);

        // Validar número de jugadores
        if (!filter_var($jugadores, FILTER_VALIDATE_INT) || $jugadores < 1 || $jugadores > 10) {
            $error = 'El número de jugadores debe estar entre 1 y 10.';
        }

        // Validar número de cartas por jugador
        if (!filter_var($cartas, FILTER_VALIDATE_INT) || $cartas < 1 || $cartas > 12) {
            $error = 'El número de cartas por jugador debe estar entre 1 y 12.';
        }

        // Validar que hay suficientes cartas en el mazo
        $mazo = $_SESSION['mazo'] ?? [];
        $totalCartasNecesarias = $jugadores * $cartas;
        if (count($mazo) < $totalCartasNecesarias) {
            $error = 'No hay suficientes cartas en el mazo para repartir.';
        }

        // Si no hay errores, redirigir al controlador para procesar el reparto
        if (empty($error)) {
            header("Location: index.php?controller=baraja&action=repartir&jugadores=$jugadores&cartas=$cartas");
            exit();
        }
    }
    ?>

    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="jugadores">Número de jugadores (1-10):</label>
        <input type="number" name="jugadores" id="jugadores" min="1" max="10" required>
        <br><br>

        <label for="cartas">Cartas por jugador (1-12):</label>
        <input type="number" name="cartas" id="cartas" min="1" max="12" required>
        <br><br>

        <button type="submit">Repartir</button>
    </form>
    <a href="../cartas/">Volver</a>
</body>
</html>
