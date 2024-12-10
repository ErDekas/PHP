<?php
session_start();

require_once 'controllers/ServicioController.php';
require_once 'controllers/ClienteController.php';
require_once 'controllers/CitaController.php';
require_once 'controllers/EmpleadoAdminController.php';

$action = $_GET['action'] ?? 'home';

// Incluye Bootstrap
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salón de Belleza</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">
        <?php
        switch ($action) {
            case 'home':
        ?>
                <div class="text-center">
                    <h1 class="mb-4">Bienvenido al Salón de Belleza</h1>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="/salon/servicios" class="btn btn-primary">Ver Servicios</a>
                        <?php if (!isset($_SESSION['rol'])) { ?>
                            <a href="/salon/registrarCliente" class="btn btn-secondary">Registrar Cliente</a>
                            <a href="/salon/login" class="btn btn-outline-primary">Iniciar Sesión</a>
                        <?php } else { ?>
                            <?php switch ($_SESSION['rol']) {
                                case 'cliente': ?>
                                    <a href="/salon/verCitas" class="btn btn-info">Ver Citas</a>
                                    <a href="/salon/agendarCita" class="btn btn-success">Agendar Cita</a>
                                <?php break;
                                case 'empleado': ?>
                                    <a href="/salon/empleado_dashboard" class="btn btn-warning">Panel de Empleado</a>
                                    <a href="/salon/agendarCitaEmpleado" class="btn btn-success">Agendar Cita</a>
                                <?php break;
                                case 'admin': ?>
                                    <a href="/salon/admin_dashboard" class="btn btn-danger">Panel de Administración</a>
                            <?php break;
                            } ?>
                            <a href="/salon/cerrarSesion" class="btn btn-dark">Cerrar Sesión</a>
                        <?php } ?>
                    </div>
                </div>
            <?php
                break;

            case 'servicios':
                $controller = new ServicioController();
                $controller->listarServicios();
                break;

            case 'registrarCliente':
                $controller = new ClienteController();
                $controller->registrarCliente();
                break;

            case 'login':
            ?>
                <div class="card mx-auto" style="max-width: 400px;">
                    <div class="card-body">
                        <h1 class="card-title text-center mb-4">Iniciar Sesión</h1>
                        <form method="POST" action="/salon/autenticar">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" name="correo" id="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña:</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                        </form>
                    </div>
                </div>
            <?php
                break;

            case 'autenticar':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $correo = $_POST['correo'];
                    $password = $_POST['password'];

                    // Crear instancia del modelo de Usuario
                    $usuarioModel = new UsuarioModel();

                    // Obtener el tipo de usuario usando el método del modelo
                    $tipo_usuario = $usuarioModel->obtenerTipoDeUsuario($correo);

                    if ($tipo_usuario === null) {
                        http_response_code(400);
                        echo json_encode(['error' => 'Usuario no encontrado']);
                        break;
                    }

                    // Mapa de controladores para cada tipo de usuario
                    $controladores = [
                        'cliente' => ClienteController::class,
                        'empleado' => EmpleadoAdminController::class,
                        'admin' => EmpleadoAdminController::class
                    ];

                    // Validar que el tipo de usuario exista en el mapa
                    if (isset($controladores[$tipo_usuario])) {
                        $controladorClase = $controladores[$tipo_usuario];
                        $controlador = new $controladorClase();

                        // Llamar al método correspondiente
                        if (method_exists($controlador, 'autenticar')) {
                            $controlador->autenticar($correo, $password);
                        } else {
                            // Manejo de error si el método no existe
                            http_response_code(500);
                            echo json_encode(['error' => 'Método autenticar no encontrado en el controlador']);
                        }
                    } else {
                        // Manejo de error para tipo de usuario no válido
                        http_response_code(400);
                        echo json_encode(['error' => 'Tipo de usuario no válido']);
                    }
                }
                break;

            case 'agendarCita':
                // Verificar si el usuario ha iniciado sesión como cliente
                if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'cliente') {
                    header('Location: /salon/login');
                    exit();
                }
            ?>
                <div class="container">
                    <h1 class="text-center mb-4">Agendar Cita</h1>
                    <div class="card">
                        <div class="card-body">
                            <?php
                            $controller = new CitaController();
                            $controller->agendarCita();
                            ?>
                        </div>
                    </div>
                </div>
            <?php
                break;

            case 'verCitas':
                // Verificar si el cliente está autenticado
                if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'cliente') {
                    header('Location: /salon/login');
                    exit();
                }
                $cliente_id = $_GET['cliente_id'] ?? 0;
            ?>
                <div class="container">
                    <h1 class="text-center mb-4">Mis Citas</h1>
                    <div class="table-responsive">
                        <?php
                        $controller = new CitaController();
                        $controller->verCitasCliente($cliente_id);
                        ?>
                    </div>
                </div>
            <?php
                break;

            case 'confirmar':
                $token = $_GET['token'] ?? '';
            ?>
                <div class="container text-center">
                    <h1 class="mb-4">Confirmación de Cuenta</h1>
                    <?php
                    $clienteController = new ClienteController();
                    $clienteController->confirmarCuenta($token);
                    ?>
                </div>
            <?php
                break;

            case 'confirmacion-exitosa':
            ?>
                <div class="container text-center">
                    <h1 class="text-success">¡Cuenta confirmada con éxito!</h1>
                    <p>Ahora puedes iniciar sesión.</p>
                    <a href="/salon/login" class="btn btn-primary">Iniciar Sesión</a>
                </div>
            <?php
                break;

            case 'confirmacion-fallida':
            ?>
                <div class="container text-center">
                    <h1 class="text-danger">Error en la confirmación</h1>
                    <p>El token es inválido o la cuenta ya fue confirmada.</p>
                    <a href="/salon/home" class="btn btn-secondary">Volver al inicio</a>
                </div>
            <?php
                break;

            case 'registrar_empleado_admin':
            ?>
                <div class="container">
                    <h1 class="text-center mb-4">Registrar Empleado/Admin</h1>
                    <div class="card">
                        <div class="card-body">
                            <?php
                            $empleadoAdminController = new EmpleadoAdminController();
                            $empleadoAdminController->registrar();
                            ?>
                        </div>
                    </div>
                    <div class="mt-3"><a href="admin_dashboard" class="btn btn-secondary">Volver</a></div>
                </div>
            <?php
                break;

            case 'listar_citas':
            ?>
                <div class="container">
                    <h1 class="text-center mb-4">Listado de Citas</h1>
                    <div class="card">
                        <div class="card-body">
                            <form method="GET" class="mb-4">
                                <input type="hidden" name="action" value="listar_citas">
                                <div class="row g-2">
                                    <div class="col-md-3">
                                        <label for="estado" class="form-label">Estado:</label>
                                        <select id="estado" name="estado" class="form-select">
                                            <option value="">Todos</option>
                                            <option value="reservada">Reservada</option>
                                            <option value="completada">Completada</option>
                                            <option value="cancelada">Cancelada</option>
                                            <option value="confirmada">Confirmada</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="empleado_id" class="form-label">Empleado:</label>
                                        <input type="text" id="empleado_id" name="empleado_id" class="form-control" placeholder="ID de Empleado">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="fecha_desde" class="form-label">Desde:</label>
                                        <input type="date" id="fecha_desde" name="fecha_desde" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="fecha_hasta" class="form-label">Hasta:</label>
                                        <input type="date" id="fecha_hasta" name="fecha_hasta" class="form-control">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Filtrar</button>
                            </form>
                            <?php
                            $filtros = [];
                            if (isset($_GET['estado'])) $filtros['estado'] = $_GET['estado'];
                            if (isset($_GET['empleado_id'])) $filtros['empleado_id'] = $_GET['empleado_id'];
                            if (isset($_GET['fecha_desde'])) $filtros['fecha_desde'] = $_GET['fecha_desde'];
                            if (isset($_GET['fecha_hasta'])) $filtros['fecha_hasta'] = $_GET['fecha_hasta'];

                            $citaController = new CitaController();
                            $citaController->listarCitas($filtros);
                            ?>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="admin_dashboard" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            <?php
                break;

            case 'asignar_empleado':
            ?>
                <div class="container">
                    <h1 class="text-center mb-4">Asignar / Reasignar Empleado a Cita</h1>
                    <div class="card">
                        <div class="card-body">
                            <?php
                            $citaController = new CitaController();
                            $citaController->asignarEmpleado();
                            ?>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="admin_dashboard" class="btn btn-secondary">Volver</a>
                </div>
            <?php
                break;

            case 'editar_cita':
                if (isset($_GET['id'])) {
                    $cita_id = $_GET['id'];
                    // Crear una instancia del controlador de Citas y pasar el id
                    $controller = new CitaController();
                    $controller->editarCita($cita_id);
                } else {
                    echo "<div class='alert alert-danger text-center'>ID de cita no válido.</div>";
                }
                break;

            case 'actualizar_cita':
                if (isset($_GET['id'])) {
                    $cita_id = $_GET['id'];
                    // Crear una instancia del controlador de Citas y pasar el id
                    $controller = new CitaController();
                    $controller->actualizarCita($cita_id);
                } else {
                    echo "<div class='alert alert-danger text-center'>ID de cita no válido.</div>";
                }
                break;

            case 'eliminar_cita':
                if (isset($_GET['id'])) {
                    $cita_id = $_GET['id'];
                    // Crear una instancia del controlador de Citas y pasar el id
                    $controller = new CitaController();
                    $controller->eliminarCita($cita_id);
                } else{
                    echo "<div class='alert alert-danger text-center'>ID de cita no válido.</div>";
                }
                break;

            case 'detalle_cita':
                if (isset($_GET['id'])) {
                    $cita_id = $_GET['id'];
                    // Crear una instancia del controlador de Citas y pasar el id
                    $controller = new CitaController();
                    $controller->verDetalleCita($cita_id);
                } else{
                    echo "<div class='alert alert-danger text-center'>ID de cita no válido.</div>";
                }
                break;

            case 'cancelar_cita':
                if(isset($_GET['id'])) {
                    $cita_id = $_GET['id'];
                    // Crear una instancia del controlador de Citas y pasar el id
                    $controller = new CitaController();
                    $controller->cancelarCita($cita_id);
                } else {
                    echo "<div class='alert alert-danger text-center'>ID de cita no válido.</div>";
                }
                break;

            case 'admin_dashboard':
                $empleadoAdminController = new EmpleadoAdminController();
                $empleadoAdminController->verificarAcceso(['admin']);
            ?>
                <h1 class="mb-4">Panel de Administración</h1>
                <div class="list-group">
                    <a href="/salon/registrar_empleado_admin" class="list-group-item list-group-item-action">Registrar Empleado/Admin</a>
                    <a href="/salon/listar_citas" class="list-group-item list-group-item-action">Gestionar Citas</a>
                    <a href="/salon/asignar_empleado" class="list-group-item list-group-item-action">Asignar Empleado a Cita</a>
                </div>
                <div class="mt-3">
                    <a href="index.php" class="btn btn-secondary">Volver</a>
                </div>
            <?php
                break;

            case 'empleado_dashboard':
                $empleadoAdminController = new EmpleadoAdminController();
                $empleadoAdminController->verificarAcceso(['empleado']);
            ?>
                <h1 class="mb-4">Panel de Empleado</h1>
                <div>
                    <h2 class="mb-3">Mis Citas</h2>
                    <?php
                    $citaController = new CitaController();
                    $citaController->listarCitasEmpleado($_SESSION['usuario_id']);
                    ?>
                </div>
                <div class="mt-3">
                    <a href="index.php" class="btn btn-secondary">Volver</a>
                </div>
            <?php
                break;

            case 'agendarCitaEmpleado':
                $citaController = new CitaController();
                $citaController->agendarCitaEmpleado();
                break;


            case 'cerrarSesion':
                $empleadoAdminController = new EmpleadoAdminController();
                $empleadoAdminController->logout();

                // Redirigir a la página de inicio con una URL limpia
                header('Location: /salon/index.php');
                exit();
                break;

            default:
            ?>
                <div class="alert alert-danger text-center">
                    <h1>Acción no válida</h1>
                </div>
        <?php
                break;
        }
        ?>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>