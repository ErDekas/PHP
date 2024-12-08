<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Citas</title>
    <!-- Incluir Bootstrap desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h1 class="mb-4 text-center">Panel de Citas</h1>

        <!-- Tabla con clases de Bootstrap -->
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Servicio</th>
                    <th>Fecha y Hora</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($citas)): ?>
                    <tr>
                        <td colspan="5" class="text-center">No hay citas disponibles</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($citas as $cita): ?>
                        <tr>
                            <td><?= htmlspecialchars($cita['cita_id']) ?></td>
                            <td><?= htmlspecialchars($cita['cliente']) ?></td>
                            <td><?= htmlspecialchars($cita['servicio']) ?></td>
                            <td><?= htmlspecialchars($cita['fecha_cita']) ?></td>
                            <td><?= htmlspecialchars($cita['estado']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>

        </table>
    </div>
    <!-- Incluir Bootstrap JS desde CDN (opcional, para funcionalidades como dropdowns) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>