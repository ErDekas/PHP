<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Cita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="text-center">Detalles de la Cita</h2>
            </div>
            <div class="card-body">
                <?php
                // Asumiendo que tienes un controlador que pasa $cita
                if ($cita):
                    // Crear instancias de los modelos
                    $clienteModel = new ClienteModel();
                    $empleadoModel = new EmpleadoModel();
                    $servicioModel = new ServicioModel();
                ?>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Información de la Cita</h4>
                            <p><strong>Número de Cita:</strong> <?php echo htmlspecialchars($cita['cita_id']); ?></p>
                            <p><strong>Fecha y Hora:</strong> <?php echo htmlspecialchars(date('d/m/Y H:i', strtotime($cita['fecha_hora']))); ?></p>
                            <p><strong>Estado:</strong>
                                <?php
                                switch ($cita['estado']) {
                                    case 'reservada':
                                        echo '<span class="badge bg-info">Reservada</span>';
                                        break;
                                    case 'completada':
                                        echo '<span class="badge bg-success">Completada</span>';
                                        break;
                                    case 'cancelada':
                                        echo '<span class="badge bg-danger">Cancelada</span>';
                                        break;
                                }
                                ?>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h4>Servicios Contratados</h4>
                            <?php
                            // Obtener los IDs de servicios
                            $servicios_ids = explode(',', $cita['servicios']);
                            $servicios_detalles = [];

                            // Obtener detalles de cada servicio
                            foreach ($servicios_ids as $servicio_id) {
                                $servicio = $servicioModel->obtenerDetallesServicio($servicio_id);
                                if ($servicio) {
                                    $servicios_detalles[] = $servicio;
                                }
                            }
                            ?>
                            <ul class="list-group">
                                <?php
                                $total = 0;
                                foreach ($servicios_detalles as $servicio):
                                    $total += $servicio['precio'];
                                ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?php echo htmlspecialchars($servicio['nombre']); ?>
                                        <span class="badge bg-primary rounded-pill"><?php echo htmlspecialchars($servicio['precio']); ?>€</span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <p class="mt-2"><strong>Total:</strong> <?php echo number_format($total, 2); ?>€</p>
                        </div>
                    </div>

                    <hr>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h4>Información del Cliente</h4>
                            <?php
                            // Obtener detalles del cliente
                            $cliente = $clienteModel->obtenerDetallesCliente($cita['cliente_id']);
                            ?>
                            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($cliente['nombre']); ?></p>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($cliente['correo']); ?></p>
                            <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($cliente['telefono']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h4>Profesional Asignado</h4>
                            <?php
                            // Obtener detalles del empleado
                            // Nota: Añade un método obtenerDetallesEmpleado en tu EmpleadoModel si no existe
                            $empleado = $empleadoModel->obtenerDetallesEmpleado($cita['empleado_id']);
                            ?>
                            <?php if ($empleado): ?>
                                <p><strong>Nombre:</strong> <?php echo htmlspecialchars($empleado['nombre']); ?></p>
                                <p><strong>Especialidad:</strong> <?php echo htmlspecialchars($empleado['especialidad']); ?></p>
                                <p><strong>Contacto:</strong> <?php echo htmlspecialchars($empleado['correo']); ?></p>
                            <?php else: ?>
                                <p class="text-warning">Empleado no encontrado</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-danger" role="alert">
                        No se encontraron detalles para esta cita.
                    </div>
                <?php endif; ?>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <a href="listar_citas" class="btn btn-secondary">Volver a Citas</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>