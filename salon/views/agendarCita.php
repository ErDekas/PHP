<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Cita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Agendar una Cita</h1>
        <form method="POST" action="" class="mt-4">
            <!-- Selección de Empleado -->
            <!-- <div class="mb-3">
                <label for="empleado" class="form-label">Empleado</label>
                <select class="form-select" id="empleado" name="empleado" required>
                    <?php foreach ($empleados as $empleado): ?>
                        <option value="<?php echo $empleado['id']; ?>">
                            <?php echo htmlspecialchars($empleado['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div> -->
            <!-- Selección de Servicios -->
            <div class="mb-3">
                <label for="servicios" class="form-label">Servicios</label>
                <select class="form-select" id="servicios" name="servicios[]" multiple required>
                    <?php foreach ($servicios as $servicio): ?>
                        <option value="<?php echo $servicio['id']; ?>">
                            <?php echo htmlspecialchars($servicio['nombre']) . " - " . htmlspecialchars($servicio['precio']) . "€"; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <small class="form-text text-muted">Mantén presionada la tecla Ctrl (Cmd en Mac) para seleccionar múltiples servicios.</small>
            </div>

            <!-- Fecha y Hora -->
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha y Hora</label>
                <input type="datetime-local" class="form-control" id="fecha" name="fecha_hora" required>
            </div>

            <!-- Botón de envío -->
            <button type="submit" class="btn btn-primary">Agendar</button>
        </form>

        <!-- Botón para regresar -->
        <div class="mt-3">
            <a href="index.php" class="btn btn-secondary">Volver</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
