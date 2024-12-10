<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar/Reasignar Empleado</title>

    <!-- Agregar los enlaces de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Asignar/Reasignar Empleado a Cita</h1>
        <form method="POST" action="/salon/asignar_empleado">
            <div class="mb-3">
                <label for="cita_id" class="form-label">Cita:</label>
                <select name="cita_id" id="cita_id" class="form-select">
                    <?php if (empty($citas)): ?>
                        <option value="">No hay citas disponibles</option>
                    <?php else: ?>
                        <?php foreach ($citas as $cita): ?>
                            <option value="<?= isset($cita['cita_id']) ? $cita['cita_id'] : '' ?>">
                                <?= isset($cita['cita_id']) ? $cita['cita_id'] : 'Cita no disponible' ?> -
                                <?= isset($cita['nombre_cliente']) ? $cita['nombre_cliente'] : 'Cliente desconocido' ?> -
                                <?= isset($cita['fecha_hora']) ? $cita['fecha_hora'] : 'Fecha no disponible' ?> -
                                (Empleado asignado: <?= isset($cita['nombre_empleado']) ? $cita['nombre_empleado'] : 'Ninguno' ?>)
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="empleado_id" class="form-label">Empleado:</label>
                <select name="empleado_id" id="empleado_id" class="form-select">
                    <?php foreach ($empleados as $empleado): ?>
                        <?php if (isset($empleado['id']) && isset($empleado['nombre'])): ?>
                            <option value="<?= $empleado['id'] ?>">
                                <?= $empleado['nombre'] ?>
                            </option>
                        <?php else: ?>
                            <option value="">Empleado no disponible</option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Asignar/Reasignar</button>
        </form>
    </div>

    <!-- Agregar el script de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>