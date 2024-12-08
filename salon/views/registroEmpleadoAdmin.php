<?php
// registroEmpleadoAdmin.php
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Registro de Empleados</h1>
        <form action="/salon/registrar_empleado_admin" method="POST" class="mt-4">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="especialidad" class="form-label">Especialidad</label>
                <select class="form-select" id="especialidad" name="especialidad" required>
                    <option value="" disabled selected>Seleccione una especialidad</option>
                    <option value="Peluquero">Peluquero</option>
                    <option value="Maquilladora">Maquilladora</option>
                    <option value="Depilación">Depilación</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" required pattern="[0-9]{9,9}" title="Debe contener entre 10 y 15 dígitos">
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <select class="form-select" id="rol" name="rol" required>
                    <option value="empleado" selected>Empleado</option>
                    <option value="admin">Administrador</option>
                </select>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="activo" name="activo" value="1" checked>
                <label class="form-check-label" for="activo">
                    Activo
                </label>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Registrar</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
