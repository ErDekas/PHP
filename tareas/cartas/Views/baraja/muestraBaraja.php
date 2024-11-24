<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baraja de Cartas</title>
</head>

<body>
    <h1>Baraja de Cartas</h1>
    <ul>
        <?php foreach ($cartas as $carta): ?>
            <li><?= $carta ?></li>
        <?php endforeach; ?>
    </ul>
</body>

</html>