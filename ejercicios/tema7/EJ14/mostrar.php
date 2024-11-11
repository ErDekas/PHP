<?php
session_start();

// Comprobar si hay preferencias en la sesión
$idioma = $_SESSION['idioma'] ?? null;
$perfil_publico = $_SESSION['perfil_publico'] ?? null;
$zona_horaria = $_SESSION['zona_horaria'] ?? null;
$mensaje = "";

// Si se ha pulsado el botón para borrar las preferencias
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_unset();
    $mensaje = "Información de la sesión eliminada.";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Preferencias</title>
</head>

<body>
    <h2>Preferencias del Usuario</h2>

    <?php if ($mensaje): ?>
        <p style="color: red;"><?= htmlspecialchars($mensaje) ?></p>
    <?php else: ?>
        <?php if ($idioma && $perfil_publico && $zona_horaria): ?>
            <ul>
                <li><strong>Idioma:</strong> <?= htmlspecialchars($idioma) ?></li>
                <li><strong>Perfil Público:</strong> <?= htmlspecialchars($perfil_publico) ?></li>
                <li><strong>Zona Horaria:</strong> <?= htmlspecialchars($zona_horaria) ?></li>
            </ul>
        <?php else: ?>
            <p>No se han establecido preferencias.</p>
        <?php endif; ?>
    <?php endif; ?>

    <form method="POST" action="">
        <button type="submit">Borrar preferencias</button>
    </form>

    <br>
    <a href="preferencias.php">Establecer preferencias</a>
</body>

</html>