<?php
require_once 'models/UsuarioModel.php';
require_once 'models/EmpleadoModel.php'; // Modelo para la tabla empleados

class EmpleadoAdminController
{
    private $usuarioModel;
    private $empleadoModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
        $this->empleadoModel = new EmpleadoModel(); // Instanciar el modelo de empleados
    }

    // Método de registro para empleados y admins
    public function registrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitizar y validar datos
            $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $rol = filter_input(INPUT_POST, 'rol', FILTER_SANITIZE_STRING);
            $especialidad = filter_input(INPUT_POST, 'especialidad', FILTER_SANITIZE_STRING);
            $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
            $activo = filter_input(INPUT_POST, 'activo', FILTER_SANITIZE_NUMBER_INT);

            // Validaciones
            if (!$email || !$nombre || !$rol || ($rol === 'empleado' && (!$especialidad || !$telefono))) {
                echo "Datos inválidos";
                return;
            }

            try {
                // Generar contraseña automática para empleados
                $password = null;
                if ($rol === 'empleado') {
                    // Obtener el siguiente ID del empleado (simulación)
                    $id = $this->usuarioModel->obtenerSiguienteID();
                    $password = $this->generarPasswordEmpleado($nombre, $especialidad, $id);
                } else {
                    // Los admins deben proporcionar contraseña manualmente
                    $password = $_POST['password'] ?? null;
                    if (!$password) {
                        echo "La contraseña es obligatoria para administradores.";
                        return;
                    }
                }

                // Hashear contraseña
                $password_hash = password_hash($password, PASSWORD_BCRYPT);

                if ($rol === 'empleado') {
                    // Primero, registrar usuario (pero con empleado_id aún no definido)
                    $resultado_usuario = $this->usuarioModel->registrarUsuario($nombre, $email, $password_hash, $rol);

                    if ($resultado_usuario) {
                        // Obtener el ID del usuario recién insertado
                        $usuarioId = $this->usuarioModel->obtenerSiguienteID() - 1;

                        // Registrar empleado con referencia al usuario
                        $resultado_empleado = $this->empleadoModel->registrarEmpleado($nombre, $especialidad, $email, $telefono, $activo, $usuarioId);

                        if ($resultado_empleado) {
                            echo "Registro exitoso para empleado. La contraseña generada es: $password";
                        } else {
                            // Si falla el registro del empleado, eliminar el usuario
                            $this->eliminarUsuario($usuarioId);
                            echo "Error al registrar empleado.";
                        }
                    } else {
                        echo "Error en el registro de usuario.";
                    }
                } else {
                    // Para administradores, registro directo
                    $resultado = $this->usuarioModel->registrarUsuario($nombre, $email, $password_hash, $rol);

                    if ($resultado) {
                        echo "Registro exitoso para administrador.";
                    } else {
                        echo "Error en el registro. El email podría estar en uso.";
                    }
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            // Mostrar formulario de registro
            require 'views/registroEmpleadoAdmin.php';
        }
    }

    // Método auxiliar para eliminar usuario en caso de error
    private function eliminarUsuario($usuarioId)
    {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $this->usuarioModel->db->prepare($sql);
        $stmt->bind_param('i', $usuarioId);
        return $stmt->execute();
    }

    // Método para generar contraseña automática para empleados
    private function generarPasswordEmpleado($nombre, $especialidad, $id)
    {
        $nombreAbrev = substr(preg_replace('/[^A-Za-z]/', '', $nombre), 0, 3); // Primeras 3 letras del nombre
        $especialidadAbrev = substr(preg_replace('/[^A-Za-z]/', '', $especialidad), 0, 3); // Primeras 3 letras de la especialidad
        return ucfirst($nombreAbrev) . ucfirst($especialidadAbrev) . $id; // Formato: PabMas1
    }

    // Método de autenticación para empleados y admins
    public function autenticar($email, $password)
    {
        try {
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->obtenerUsuarioPorEmail($email);

            if ($usuario) {
                // Verificar contraseña con método flexible
                if ($this->verificarPassword($password, $usuario['password'])) {
                    // Iniciar sesión
                    session_start();
                    $_SESSION['usuario_id'] = $usuario['id'];
                    $_SESSION['rol'] = $usuario['rol'];

                    // Actualizar última conexión
                    $usuarioModel->actualizarUltimaConexion($usuario['id']);

                    // Redirigir según el rol
                    switch ($usuario['rol']) {
                        case 'admin':
                            header('Location: admin_dashboard');
                            break;
                        case 'empleado':
                            header('Location: empleado_dashboard');
                            break;
                        default:
                            header('Location: /home');
                    }
                    exit();
                } else {
                    echo "Credenciales incorrectas.";
                }
            } else {
                echo "Usuario no encontrado.";
            }
        } catch (Exception $e) {
            echo "Error de autenticación: " . $e->getMessage();
        }
    }

    // Método para verificar la contraseña con soporte multi-hash
    private function verificarPassword($passwordIngresada, $passwordAlmacenada)
    {
        // Verificar si es un hash bcrypt
        if (password_get_info($passwordAlmacenada)['algo'] === PASSWORD_BCRYPT) {
            return password_verify($passwordIngresada, $passwordAlmacenada);
        }

        // Verificar si es un hash SHA-256 (64 caracteres)
        if (strlen($passwordAlmacenada) === 64) {
            return hash('sha256', $passwordIngresada) === $passwordAlmacenada;
        }

        // Comparación directa como último recurso (no recomendado)
        return $passwordIngresada === $passwordAlmacenada;
    }

    // Método para cerrar sesión
    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: home');
        exit();
    }

    // Verificar si el usuario tiene acceso a una sección específica
    public function verificarAcceso($rolesPermitidos)
    {

        // Si no hay sesión iniciada
        if (!isset($_SESSION['rol'])) {
            header('Location: salon/login');
            exit();
        }

        // Verificar si el rol actual tiene permiso
        if (!in_array($_SESSION['rol'], $rolesPermitidos)) {
            // No tiene permisos
            header('Location: salon/acceso_denegado');
            exit();
        }

        return true;
    }

    // Método para migrar hashes antiguos a bcrypt
    public function migrarHashesAntiguos()
    {
        try {
            $usuarios = $this->usuarioModel->obtenerTodosLosUsuarios();

            foreach ($usuarios as $usuario) {
                // Si el hash no es bcrypt, convertirlo
                if (strlen($usuario['password']) === 64) {
                    $nuevo_hash = password_hash($usuario['password'], PASSWORD_BCRYPT);
                    $this->usuarioModel->actualizarPasswordUsuario($usuario['id'], $nuevo_hash);
                }
            }

            echo "Migración de hashes completada.";
        } catch (Exception $e) {
            echo "Error en la migración: " . $e->getMessage();
        }
    }

    public function seleccionarEmpleadoParaServicio($servicios, $fecha_hora)
    {
        // Validar que $fecha_hora esté definido
        if (empty($fecha_hora)) {
            throw new Exception("La fecha y hora son necesarias para seleccionar un empleado.");
        }

        // Obtener las especialidades requeridas para los servicios
        $servicioModel = new ServicioModel();
        $especialidades = [];

        foreach ($servicios as $servicio_id) {
            $servicio = $servicioModel->obtenerServicioPorId($servicio_id);
            $especialidades[] = $servicio['especialidad'];
        }

        // Eliminar duplicados
        $especialidades = array_unique($especialidades);

        // Buscar empleados disponibles
        $empleadoModel = new EmpleadoModel();
        $empleado = $empleadoModel->buscarEmpleadoParaServicios($especialidades, $fecha_hora);

        // Si no hay empleados disponibles, obtener el primer empleado activo
        if (!$empleado) {
            $empleado = $empleadoModel->obtenerPrimerEmpleadoActivo();
        }

        // Si aún no hay empleados, lanzar excepción
        if (!$empleado) {
            throw new Exception("No hay empleados disponibles para el servicio solicitado.");
        }

        return $empleado;
    }
}
