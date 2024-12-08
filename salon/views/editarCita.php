<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cita</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .appointment-form {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-4">Editar Cita</h1>
                
                <!-- Buttons Container -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="m-0">Detalles de la Cita</h2>
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
                
                <form 
                    method="POST" 
                    action="actualizar_cita?id=<?= htmlspecialchars($cita['cita_id']) ?>" 
                    class="appointment-form"
                >
                    <!-- Hidden Input Fields for Maintaining Context -->
                    <div class="d-none">
                        <input 
                            type="hidden" 
                            name="cita_id" 
                            value="<?= htmlspecialchars($cita['cita_id']) ?>"
                        >
                        <input 
                            type="hidden" 
                            name="cliente_id" 
                            value="<?= htmlspecialchars($cita['cliente_id']) ?>"
                        >
                        <input 
                            type="hidden" 
                            name="empleado_id" 
                            value="<?= htmlspecialchars($cita['empleado_id']) ?>"
                        >
                    </div>

                    <!-- Services Selection -->
                    <div class="mb-3">
                        <label for="servicios" class="form-label">Servicios</label>
                        <select 
                            class="form-select" 
                            id="servicios" 
                            name="servicios[]" 
                            multiple 
                            required
                        >
                            <?php foreach ($servicios as $servicio): ?>
                                <option 
                                    value="<?= htmlspecialchars($servicio['id']) ?>"
                                    <?= in_array($servicio['id'], $serviciosCitaIds) ? 'selected' : '' ?>
                                >
                                    <?= 
                                        htmlspecialchars($servicio['nombre']) . 
                                        " - " . 
                                        htmlspecialchars($servicio['precio']) . 
                                        "€" 
                                    ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="form-text text-muted">
                            Mantén presionada la tecla Ctrl (Cmd en Mac) para seleccionar múltiples servicios.
                        </small>
                    </div>

                    <!-- Date and Time -->
                    <div class="mb-3">
                        <label for="fecha_hora" class="form-label">Fecha y Hora</label>
                        <input 
                            type="datetime-local" 
                            class="form-control" 
                            id="fecha_hora" 
                            name="fecha_hora"
                            value="<?= date('Y-m-d\TH:i', strtotime($cita['fecha_hora'])) ?>" 
                            required
                        >
                    </div>

                    <!-- Total Amount -->
                    <div class="mb-3">
                        <label for="total" class="form-label">Total</label>
                        <div class="input-group">
                            <input 
                                type="number" 
                                step="0.01" 
                                class="form-control" 
                                id="total" 
                                name="total"
                                value="<?= htmlspecialchars($cita['total']) ?>" 
                                required
                            >
                            <span class="input-group-text">€</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-primary">
                            Actualizar Cita
                        </button>
                        <a href="index.php" class="btn btn-secondary">
                            Volver
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Optional Total Calculation Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const serviciosSelect = document.getElementById('servicios');
            const totalInput = document.getElementById('total');

            serviciosSelect.addEventListener('change', calcularTotal);

            function calcularTotal() {
                const serviciosSeleccionados = Array.from(serviciosSelect.selectedOptions)
                    .map(option => parseFloat(option.text.split(' - ')[1]));

                const total = serviciosSeleccionados.reduce((sum, precio) => sum + precio, 0);
                totalInput.value = total.toFixed(2);
            }
        });
    </script>
</body>
</html>