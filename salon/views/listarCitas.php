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
                    <th>Empleado</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($citas as $cita): ?>
                    <tr>
                        <td><?= $cita['cita_id'] ?></td>
                        <td><?= $cita['nombre_cliente'] ?></td>
                        <td><?= $cita['servicios'] ?></td>
                        <td><?= $cita['fecha_hora'] ?></td>
                        <td><?= $cita['nombre_empleado'] ?></td>
                        <td><?= $cita['estado'] ?></td>
                        <td>
                            <!-- Ver detalles de la cita -->
                            <a href="/salon/detalle_cita?id=<?= $cita['cita_id'] ?>" class="btn btn-info btn-sm">Ver Detalle</a>
                            
                            <?php if ($_SESSION['rol'] == 'admin'): ?>
                                <!-- Editar cita -->
                                <a href="/salon/editar_cita?id=<?= $cita['cita_id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <?php endif; ?>
                            <!-- Eliminar cita -->
                            <a href="/salon/eliminar_cita?id=<?= $cita['cita_id'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Incluir Bootstrap JS desde CDN (opcional, para funcionalidades como dropdowns) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
