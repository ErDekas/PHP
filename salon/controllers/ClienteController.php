<?php
require_once 'models/ClienteModel.php';
require_once 'helpers/MailHelper.php';
class ClienteController
{

    // Registro de cliente
    public function registrarCliente()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            // Creamos el modelo de Cliente y llamamos al método de registro
            $model = new ClienteModel();
            $resultado = $model->registrarCliente($nombre, $correo, $telefono, $fecha_nacimiento, $password);

            if ($resultado) {
                // El registro fue exitoso y se envió el correo de verificación
                echo "Registro exitoso. Por favor, revisa tu correo para confirmar tu cuenta.";
            } else {
                // Error al registrar el cliente
                echo "Error al registrar. Intenta nuevamente.";
            }
        } else {
            require 'views/registroCliente.php'; // Mostramos el formulario de registro
        }
    }

    // Método de autenticación de clientes (inicio de sesión)
    public function autenticar($correo, $password)
    {
        // Verificar las credenciales del cliente en la base de datos
        $clienteModel = new ClienteModel();
        $cliente = $clienteModel->obtenerClientePorCorreo($correo);

        if ($cliente && password_verify($password, $cliente['password'])) {
            session_start();
            $_SESSION['cliente_id'] = $cliente['id'];
            $_SESSION['rol'] = 'cliente';
            $_SESSION['nombre'] = $cliente['nombre'];
            header('Location: /salon/home');
            exit();
        } else {
            echo "Credenciales incorrectas.";
        }        
    }

    // Confirmación de cuenta
    public function confirmarCuenta($token)
    {
        $model = new ClienteModel();
        $resultado = $model->confirmarCuenta($token);
        if ($resultado) {
            header('Location: /salon/confirmacion-exitosa');
            echo "Cuenta confirmada con éxito.";
        } else {
            header('Location: /salon/confirmacion-fallida');
            echo "Token inválido o cuenta ya confirmada.";
        }
        exit();
    }

    // Agendar una cita
    public function agendarCita()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start(); // Iniciar sesión para obtener el cliente_id

            if (!isset($_SESSION['cliente_id'])) {
                echo "Debes estar logueado para agendar una cita.";
                return;
            }

            // Recibimos los datos desde el formulario
            $cliente_id = $_SESSION['cliente_id'];
            $empleado_id = $_POST['empleado_id']; // Empleado asignado
            $servicios = $_POST['servicios']; // Array de servicios seleccionados
            $fecha_hora = $_POST['fecha_hora']; // Fecha y hora seleccionada
            $total = $_POST['total']; // Total de la cita, lo puedes calcular con los precios de los servicios

            // Llamamos al modelo para crear la cita
            $citaModel = new CitaModel();
            $cita_id = $citaModel->crearCita($cliente_id, $empleado_id, $servicios, $fecha_hora, $total);

            if ($cita_id) {
                echo "Cita agendada con éxito. Tu cita ID es: $cita_id.";
            } else {
                echo "Hubo un error al agendar la cita. Intenta nuevamente.";
            }
        } else {
            // Obtener los empleados y servicios disponibles para mostrar en el formulario
            $citaModel = new CitaModel();
            $empleados = $citaModel->obtenerEmpleados();
            $servicios = $citaModel->obtenerServicios(); // Asegúrate de que esta función esté definida en el modelo
            require 'views/agendarCita.php'; // Mostrar el formulario de agendar cita
        }
    }

    // Ver las citas agendadas por el cliente
    public function verCitas()
    {
        session_start(); // Iniciar sesión para obtener el cliente_id

        if (!isset($_SESSION['cliente_id'])) {
            echo "Debes estar logueado para ver tus citas.";
            return;
        }

        $cliente_id = $_SESSION['cliente_id'];
        $citaModel = new CitaModel();
        $citas = $citaModel->obtenerCitasPorCliente($cliente_id);

        require 'views/verCita.php'; // Mostrar las citas agendadas
    }
}
