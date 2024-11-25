<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mostrar Cartas</title>
</head>
<body>
    <h1>Cartas de la Baraja Española</h1>
    <div>
        <?php foreach ($cartas as $carta): ?>
            <img src="assets/<?= $carta ?>.jpg" alt="<?= $carta ?>" style="width:100px;height:auto;">
        <?php endforeach; ?>
    </div>
    <a href="../cartas/">Volver</a>
</body>
</html>
