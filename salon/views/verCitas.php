<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Citas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-body {
            font-size: 1.1rem;
        }
        .card-header {
            background-color: #f8f9fa;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Mis Citas</h1>
        
        <div class="row">
            <?php foreach ($citas as $cita): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-header">
                            Cita: <?php echo $cita['fecha_hora']; ?>
                        </div>
                        <div class="card-body">
                            <p><strong>Servicio:</strong> <?php echo $cita['servicios']; ?></p>
                            <p><strong>Total:</strong> <?php echo $cita['total_cita']; ?>€</p>

                            <?php if ($cita && ($cita['estado'] == 'pendiente' || $cita['estado'] == 'reservada')): ?>
                                <form 
                                    action="cancelar_cita?id=<?= htmlspecialchars($cita['cita_id']) ?>" 
                                    method="POST"
                                >
                                    <input 
                                        type="hidden" 
                                        name="cita_id" 
                                        value="<?= htmlspecialchars($cita['cita_id']) ?>"
                                    >
                                    <button
                                        type="submit"
                                        class="btn btn-danger"
                                        onclick="return confirm('¿Estás seguro de que deseas cancelar esta cita?')"
                                    >
                                        Cancelar Cita
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-secondary">Volver</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
