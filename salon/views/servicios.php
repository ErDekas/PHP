<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Servicios Disponibles</h1>
        <ul class="list-group mt-4">
            <?php foreach ($servicios as $servicio): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo $servicio['nombre']; ?>
                    <span class="badge bg-primary rounded-pill">
                        <?php echo $servicio['precio']; ?>€
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="mt-3">
            <a href="index.php" class="btn btn-secondary">Volver</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
