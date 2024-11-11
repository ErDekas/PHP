<?php
// Cargar la clase Dado antes de iniciar la sesión
require_once 'Dado.php';
session_start();

// Inicializar la sesión y los objetos
if (!isset($_SESSION['dados'])) {
    $_SESSION['dados'] = [new Dado(), new Dado(), new Dado(), new Dado(), new Dado()];
    $_SESSION['tiradas'] = 0;
    $_SESSION['resultado'] = [];
}

// Si se hace clic en el botón "Tirar dados"
if (isset($_POST['tirar'])) {
    $_SESSION['resultado'] = [];
    foreach ($_SESSION['dados'] as $dado) {
        $dado->tira();
        $_SESSION['resultado'][] = $dado->nombreFigura();
    }
    $_SESSION['tiradas']++;
}

// Si se hace clic en el botón "Reiniciar"
if (isset($_POST['reiniciar'])) {
    session_unset();
    header("Location: index.php");
    exit();
}

// Ruta de las imágenes
function obtenerRutaImagen($figura) {
    return "assets/{$figura}.png";
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poker de Dados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f0f0f0;
        }

        .dados {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .dado img {
            width: 80px;
            height: 80px;
        }

        button {
            padding: 10px 20px;
            margin-top: 20px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>Poker de Dados</h1>

    <div class="dados">
        <?php if (!empty($_SESSION['resultado'])): ?>
            <?php foreach ($_SESSION['resultado'] as $figura): ?>
                <div class="dado">
                    <img src="<?= obtenerRutaImagen($figura) ?>" alt="<?= $figura ?>">
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Tira los dados para comenzar.</p>
        <?php endif; ?>
    </div>

    <p>Tiradas totales: <?= $_SESSION['tiradas'] ?></p>

    <form method="POST">
        <button type="submit" name="tirar">Tirar dados</button>
        <button type="submit" name="reiniciar">Reiniciar juego</button>
    </form>
</body>

</html>