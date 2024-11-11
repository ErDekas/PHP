<?php
session_start();

// Valores por defecto de las preferencias
$idioma = $_SESSION['idioma'] ?? 'español';
$perfil_publico = $_SESSION['perfil_publico'] ?? 'sí';
$zona_horaria = $_SESSION['zona_horaria'] ?? 'GMT';

// Si se ha enviado el formulario, actualizar las preferencias en la sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['idioma'] = $_POST['idioma'];
    $_SESSION['perfil_publico'] = $_POST['perfil_publico'];
    $_SESSION['zona_horaria'] = $_POST['zona_horaria'];
    $mensaje = "Información guardada en la sesión.";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preferencias de Usuario</title>
</head>

<body>
    <h2>Establecer Preferencias</h2>

    <?php if (isset($mensaje)): ?>
        <p style="color: green;"><?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="idioma">Idioma:</label>
        <select name="idioma" id="idioma" required>
            <option value="español" <?= $idioma === 'español' ? 'selected' : '' ?>>Español</option>
            <option value="inglés" <?= $idioma === 'inglés' ? 'selected' : '' ?>>Inglés</option>
        </select>
        <br><br>

        <label for="perfil_publico">Perfil Público:</label>
        <select name="perfil_publico" id="perfil_publico" required>
            <option value="sí" <?= $perfil_publico === 'sí' ? 'selected' : '' ?>>Sí</option>
            <option value="no" <?= $perfil_publico === 'no' ? 'selected' : '' ?>>No</option>
        </select>
        <br><br>

        <label for="zona_horaria">Zona Horaria:</label>
        <select name="zona_horaria" id="zona_horaria" required>
            <option value="GMT-2" <?= $zona_horaria === 'GMT-2' ? 'selected' : '' ?>>GMT-2</option>
            <option value="GMT-1" <?= $zona_horaria === 'GMT-1' ? 'selected' : '' ?>>GMT-1</option>
            <option value="GMT" <?= $zona_horaria === 'GMT' ? 'selected' : '' ?>>GMT</option>
            <option value="GMT+1" <?= $zona_horaria === 'GMT+1' ? 'selected' : '' ?>>GMT+1</option>
            <option value="GMT+2" <?= $zona_horaria === 'GMT+2' ? 'selected' : '' ?>>GMT+2</option>
        </select>
        <br><br>

        <button type="submit">Establecer preferencias</button>
    </form>

    <br>
    <a href="mostrar.php">Mostrar preferencias</a>
</body>

</html>