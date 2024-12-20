<?php
require_once 'models/CitaModel.php';
require_once 'models/ServicioModel.php';

class CitaController
{
    public function agendarCita()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['cliente_id'])) {
                echo "Error: No se ha iniciado sesión como cliente.";
                return;
            }

            $cliente_id = $_SESSION['cliente_id'];
            $fecha_hora = $_POST['fecha_hora'];
            $servicios = isset($_POST['servicios']) ? array_map('intval', $_POST['servicios']) : [];

            if (empty($fecha_hora) || empty($servicios)) {
                echo "Por favor completa todos los campos obligatorios.";
                return;
            }

            if (!strtotime($fecha_hora)) {
                echo "El formato de fecha y hora es inválido.";
                return;
            }

            // Validar los servicios y obtener total
            $servicioModel = new ServicioModel();
            $especialidades = [];
            $total = 0;

            foreach ($servicios as $servicio_id) {
                $servicio = $servicioModel->obtenerServicioPorId($servicio_id);
                if (!$servicio) {
                    echo "Uno o más servicios seleccionados no existen.";
                    return;
                }
                $total += $servicio['precio'];
                $especialidades[] = $servicio['especialidad'];
            }

            // Eliminar duplicados de especialidades
            $especialidades = array_unique($especialidades);

            // Seleccionar empleado disponible
            try {
                $empleadoModel = new EmpleadoModel();
                $empleado = $empleadoModel->buscarEmpleadoParaServicios($especialidades, $fecha_hora);

                // Si no hay empleados disponibles, intentar obtener el primer empleado activo
                if (!$empleado) {
                    $empleado = $empleadoModel->obtenerPrimerEmpleadoActivo();
                }

                if (!$empleado) {
                    echo "No hay empleados disponibles para los servicios solicitados.";
                    return;
                }

                $empleado_id = $empleado['id'];

                // Crear la cita
                $citaModel = new CitaModel();
                $resultado = $citaModel->crearCita($cliente_id, $empleado_id, $servicios, $fecha_hora, $total);

                if ($resultado) {
                    echo "Cita agendada con éxito. Número de cita: {$resultado}";
                    echo "<br>Empleado asignado: {$empleado['nombre']} ({$empleado['especialidad']})";
                    echo "<br><a href='index.php' class='btn btn-secondary'>Volver</a>";
                } else {
                    echo "Hubo un problema al agendar la cita. Intenta nuevamente.";
                    echo "<br><a href='index.php' class='btn btn-secondary'>Volver</a>";
                }
            } catch (Exception $e) {
                echo "Error al procesar la solicitud: " . $e->getMessage();
                echo "<br><a href='index.php' class='btn btn-secondary'>Volver</a>";
            }
        } else {
            // Código para mostrar el formulario de cita
            $servicioModel = new ServicioModel();
            $servicios = $servicioModel->obtenerServicios();
            require 'views/agendarCita.php';
        }
    }

    // Método auxiliar para determinar especialidad
    private function determinarEspecialidad($nombreServicio)
    {
        $nombreServicio = strtolower($nombreServicio);

        if (
            strpos($nombreServicio, 'corte') !== false ||
            strpos($nombreServicio, 'peinado') !== false ||
            strpos($nombreServicio, 'styling') !== false
        ) {
            return 'estilista';
        }

        if (
            strpos($nombreServicio, 'manicura') !== false ||
            strpos($nombreServicio, 'uña') !== false
        ) {
            return 'manicura';
        }

        if (strpos($nombreServicio, 'masaje') !== false) {
            return 'masajista';
        }

        return 'otro';
    }


    public function verCitasCliente($cliente_id)
    {
        // Validate client ID
        if ($cliente_id <= 0) {
            // Log the invalid client ID
            error_log("ID de cliente inválido: " . $cliente_id);

            // Optionally, use the client ID from the session
            $cliente_id = $_SESSION['cliente_id'] ?? 0;
        }

        $model = new CitaModel();

        // Log the client ID being queried
        error_log("Buscando citas para cliente ID: " . $cliente_id);

        // Obtenemos todas las citas asociadas al cliente
        $citas = $model->obtenerCitasPorCliente($cliente_id);

        // Log the number of appointments found
        error_log("Número de citas encontradas: " . count($citas));

        require 'views/verCitas.php';
    }

    // Método para listar todas las citas (para admin y empleados)
    public function listarCitas($filtros = [])
    {
        $model = new CitaModel();

        // Obtener citas con filtros opcionales
        $citas = $model->obtenerCitas($filtros);

        require 'views/listarCitas.php';
    }
    public function listarCitasEmpleado($empleado_id)
    {
        $model = new CitaModel();
        $citas = $model->obtenerCitasEmpleado($empleado_id);
        require 'views/listarCitasEmpleado.php';
    }

    public function asignarEmpleado()
    {
        // Verificar que solo un admin puede asignar empleados
        $empleadoAdminController = new EmpleadoAdminController();
        if (!$empleadoAdminController->verificarAcceso(['admin'])) {
            // Si no es admin, redirigir o mostrar error
            header('Location: /salon/access_denied');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Imprimir los datos de POST para depuración
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";

            $citaId = $_POST['cita_id'];
            $empleadoId = $_POST['empleado_id'];

            // Verificar que los datos no estén vacíos
            if (empty($citaId) || empty($empleadoId)) {
                echo "Faltan datos de cita o empleado.";
                exit();
            }

            // Llamar al modelo para asignar el empleado a la cita
            $model = new CitaModel();
            $resultado = $model->asignarEmpleadoACita($citaId, $empleadoId);

            // Redirigir dependiendo del resultado
            if ($resultado) {
                $_SESSION['mensaje'] = 'Empleado asignado exitosamente.';
            } else {
                $_SESSION['mensaje'] = 'Hubo un error al asignar el empleado.';
            }

            header('Location: /salon/admin_dashboard');
            exit();
        } else {
            // Mostrar formulario de asignación o reasignación
            $model = new CitaModel();
            $citas = $model->obtenerCitas();
            $empleados = $model->obtenerEmpleados();
            require 'views/asignarEmpleado.php';
        }
    }

    public function editarCita($cita_id)
    {
        $model = new CitaModel();
        $servicioModel = new ServicioModel();

        // Obtener el ID de la cita (en caso de que se pase por GET)
        $cita_id = isset($_GET['id']) ? $_GET['id'] : $cita_id;

        // Obtener la cita
        $cita = $model->obtenerCitaPorId($cita_id);

        if (!$cita) {
            echo "Cita no encontrada.";
            return;
        }

        // Obtener todos los servicios disponibles
        $servicios = $servicioModel->obtenerServicios();

        // Obtener los servicios de esta cita específica
        $serviciosCita = $model->obtenerServiciosPorCita($cita_id);

        // Convertir los servicios de la cita a un array de IDs para preseleccionar
        $serviciosCitaIds = array_column($serviciosCita, 'servicio_id');

        require 'views/editarCita.php';
    }

    public function actualizarCita()
    {
        // Verificar si la sesión está iniciada y si el usuario tiene el rol 'admin'
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            echo "Error: No tienes permisos para modificar citas.";
            return; // No continuar si no es un administrador
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recoger los datos del formulario
            $cita_id = $_POST['cita_id'];
            $cliente_id = $_POST['cliente_id'];
            $empleado_id = $_POST['empleado_id'];
            $fecha_hora = $_POST['fecha_hora'];
            $servicios = isset($_POST['servicios']) ? array_map('intval', $_POST['servicios']) : [];
            $total = $_POST['total'];  // Este valor puede venir del formulario o calcularse
            $notas = isset($_POST['notas']) ? $_POST['notas'] : ''; // Agregar campo para notas

            // Validaciones
            if (empty($cita_id) || empty($cliente_id) || empty($empleado_id) || empty($fecha_hora) || empty($servicios)) {
                echo "Por favor completa todos los campos obligatorios.";
                return;
            }

            if (!strtotime($fecha_hora)) {
                echo "El formato de fecha y hora es inválido.";
                return;
            }

            // Instanciar el modelo de Cita
            $citaModel = new CitaModel();
            $resultado = $citaModel->actualizarCita($cita_id, $cliente_id, $empleado_id, $servicios, $fecha_hora, $total);

            if ($resultado) {
                // Actualizar el historial para cada servicio de la cita
                $historialExitoso = true;
                foreach ($servicios as $servicio_id) {
                    $resultadoHistorial = $citaModel->actualizarHistorial($cita_id, $cliente_id, $servicio_id, $fecha_hora, $notas);

                    if (!$resultadoHistorial) {
                        $historialExitoso = false;
                        break;
                    }
                }

                // Llamar a la función que actualiza el estado de las citas completadas
                $citaModel->actualizarEstadoCitasCompletadas();

                if ($historialExitoso) {
                    echo "Cita actualizada con éxito y registrada en el historial.";
                } else {
                    echo "Cita actualizada, pero hubo un problema al registrar el historial.";
                }

                echo "<br><a href='listar_citas' class='btn btn-secondary'>Volver</a>";
            } else {
                echo "Hubo un problema al actualizar la cita. Intenta nuevamente.";
                echo "<br><a href='listar_citas' class='btn btn-secondary'>Volver</a>";
            }
        } else {
            // Si la solicitud no es POST, se supone que es GET, cargar la vista de la cita
            if (isset($_GET['cita_id'])) {
                $cita_id = $_GET['cita_id'];
                $citaModel = new CitaModel();
                $cita = $citaModel->obtenerCitaPorId($cita_id);

                if (!$cita) {
                    echo "Cita no encontrada.";
                    return;
                }

                // Obtener todos los servicios disponibles
                $servicioModel = new ServicioModel();
                $servicios = $servicioModel->obtenerServicios();

                // Obtener los servicios de esta cita específica
                $serviciosCita = $citaModel->obtenerServiciosPorCita($cita_id);

                // Convertir los servicios de la cita a un array de IDs para preseleccionar
                $serviciosCitaIds = array_column($serviciosCita, 'servicio_id');

                // Pasar los datos a la vista
                require 'views/editarCita.php';
            }
        }
    }

    // Método para eliminar una cita
    public function eliminarCita()
    {
        if (isset($_GET['id'])) {
            $cita_id = $_GET['id'];
            $citaModel = new CitaModel();
            $citaModel->eliminarCita($cita_id);
            echo "Cita eliminada con éxito.";
            echo "<br><a href='listar_citas' class='btn btn-secondary'>Volver</a>";
        }
    }

    // Método para ver los detalles de una cita
    public function verDetalleCita()
    {
        if (isset($_GET['id'])) {
            $cita_id = $_GET['id'];
            $citaModel = new CitaModel();
            $cita = $citaModel->obtenerCitaPorId($cita_id);
            require 'views/detalleCita.php';
        }
    }

    // Método para cancelar una cita
    public function cancelarCita()
    {
        if (isset($_POST['cita_id'])) {
            $cita_id = $_POST['cita_id'];
            $citaModel = new CitaModel();
            $citaModel->cancelarCita($cita_id);
            echo "Cita cancelada con éxito.";
            if ($_SESSION['rol'] == 'cliente') {
                echo "<br><a href='verCitas' class='btn btn-secondary'>Volver</a>";
            } else {
                echo "<br><a href='listar_citas' class='btn btn-secondary'>Volver</a>";
            }
        }
    }

    // Método para que un empleado puea agendar la cita a un cliente
    public function agendarCitaEmpleado()
    {
        // Verificar que solo empleados autorizados puedan agendar citas
        $empleadoAdminController = new EmpleadoAdminController();
        $empleadoAdminController->verificarAcceso(['empleado', 'admin']);

        // Validar que el usuario actual esté logueado y sea empleado
        if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'empleado') {
            echo "Error: No se ha iniciado sesión como empleado.";
            return;
        }
        $usuario_id = $_SESSION['usuario_id'];

        // TEMPORAL: Buscar el primer empleado si no hay asociación
        $empleadoModel = new EmpleadoModel();
        $empleado = $empleadoModel->obtenerPrimerEmpleado();

        if (!$empleado) {
            echo "Error: No hay empleados registrados.";
            return;
        }

        $empleado_id = $empleado['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recoger los datos enviados desde el formulario
            $cliente_id = $_POST['cliente'];
            $fecha_hora = $_POST['fecha_hora'];
            $servicios = isset($_POST['servicios']) ? array_map('intval', $_POST['servicios']) : [];

            // Validaciones básicas
            if (empty($cliente_id) || empty($fecha_hora) || empty($servicios)) {
                echo "Por favor completa todos los campos obligatorios.";
                return;
            }

            // Validar que el cliente exista
            $clienteModel = new ClienteModel();
            $cliente = $clienteModel->obtenerClientes($cliente_id);
            if (!$cliente) {
                echo "El cliente seleccionado no existe.";
                return;
            }

            // Validar el formato de la fecha y hora
            if (!strtotime($fecha_hora)) {
                echo "El formato de fecha y hora es inválido.";
                return;
            }

            // Verificar y calcular el total de los servicios seleccionados
            $servicioModel = new ServicioModel();
            $total = 0;
            foreach ($servicios as $servicio_id) {
                $servicio = $servicioModel->obtenerServicioPorId($servicio_id);
                if (!$servicio) {
                    echo "Uno o más servicios seleccionados no existen.";
                    return;
                }
                $total += $servicio['precio'];
            }

            // Crear la cita
            $citaModel = new CitaModel();
            try {
                $resultado = $citaModel->crearCita($cliente_id, $empleado_id, $servicios, $fecha_hora, $total);
                if ($resultado) {
                    // Redirigir con un mensaje de éxito
                    $_SESSION['mensaje'] = "Cita agendada con éxito. Número de cita: {$resultado}.";
                    header('Location: index.php');
                    exit();
                } else {
                    // Redirigir con un mensaje de error
                    $_SESSION['error'] = "Hubo un problema al agendar la cita. Intenta nuevamente.";
                    header('Location: index.php');
                    exit();
                }
            } catch (Exception $e) {
                // Redirigir con un mensaje de error
                $_SESSION['error'] = "Error al procesar la solicitud: " . $e->getMessage();
                header('Location: index.php');
                exit();
            }
        } else {
            // Método GET: cargar la lista de clientes y servicios
            $clienteModel = new ClienteModel();
            $servicioModel = new ServicioModel();

            // Obtener todos los clientes
            $clientes = $clienteModel->obtenerClientes();

            // Obtener todos los servicios
            $servicios = $servicioModel->obtenerServicios();

            // Cargar la vista
            require 'views/agendarCitaEmpleado.php';
        }
    }

    // Método para manejar la selección de cliente cuando hay múltiples resultados
    public function seleccionarCliente()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cliente_id'])) {
            $cliente_id = $_POST['cliente_id'];

            // Recuperar datos de la sesión
            if (!isset($_SESSION['datos_cita'])) {
                echo "Error: Sesión expirada.";
                return;
            }

            $datos_cita = $_SESSION['datos_cita'];

            // Crear la cita
            $citaModel = new CitaModel();
            try {
                $resultado = $citaModel->crearCita(
                    $cliente_id,
                    $datos_cita['empleado_id'],
                    $datos_cita['servicios'],
                    $datos_cita['fecha_hora'],
                    0 // El total se calcula en el método anterior
                );

                if ($resultado) {
                    // Limpiar datos de sesión
                    unset($_SESSION['datos_cita']);

                    echo "Cita agendada con éxito. Número de cita: {$resultado}.";
                    echo "<br><a href='index.php' class='btn btn-secondary'>Volver</a>";
                } else {
                    echo "Hubo un problema al agendar la cita. Intenta nuevamente.";
                    echo "<br><a href='index.php' class='btn btn-secondary'>Volver</a>";
                }
            } catch (Exception $e) {
                echo "Error al procesar la solicitud: " . $e->getMessage();
            }
        }
    }
}
