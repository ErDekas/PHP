<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sacar Carta</title>
</head>
<body>
    <h1>Sacar una carta</h1>
    <?php if ($carta): ?>
        <img src="assets/<?= $carta ?>.jpg" alt="<?= $carta ?>" style="width:100px;height:auto;">
        <p>Carta sacada: <?= ucfirst(str_replace('_', ' ', $carta)) ?></p>
    <?php else: ?>
        <p>No quedan cartas en la baraja.</p>
    <?php endif; ?>
    <a href="../cartas/">Volver</a>
</body>
</html>
