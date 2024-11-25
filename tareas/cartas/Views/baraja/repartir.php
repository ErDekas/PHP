<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reparto de Cartas</title>
</head>
<body>
    <h1>Reparto de Cartas</h1>
    <?php foreach ($reparto as $jugador => $cartas): ?>
        <h2>Jugador <?= $jugador + 1 ?></h2>
        <div>
            <?php foreach ($cartas as $carta): ?>
                <img src="assets/<?= $carta ?>.jpg" alt="<?= $carta ?>" style="width:100px;height:auto;">
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
    <a href="../cartas/">Volver</a>
</body>
</html>
