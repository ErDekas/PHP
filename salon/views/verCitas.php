<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Citas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <ul class="list-group mt-4">
            <?php foreach ($citas as $cita): ?>
                <li class="list-group-item">
                    <strong>Fecha:</strong> <?php echo $cita['fecha_hora']; ?> <br>
                    <strong>Servicio:</strong> <?php echo $cita['servicios']; ?> <br>
                    <strong>Total:</strong> <?php echo $cita['total_cita']; ?>€
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
