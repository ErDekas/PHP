<?php
class UsuarioModel {
    public $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'belleza');
        if ($this->db->connect_error) {
            throw new Exception("Error de conexión: " . $this->db->connect_error);
        }
    }

    // Registrar usuario (empleado o admin)
    public function registrarUsuario($nombre, $email, $password, $rol) {
        // Verificar si el email ya existe
        $sqlVerificar = "SELECT id FROM usuarios WHERE email = ?";
        $stmtVerificar = $this->db->prepare($sqlVerificar);
        $stmtVerificar->bind_param('s', $email);
        $stmtVerificar->execute();
        $resultVerificar = $stmtVerificar->get_result();

        if ($resultVerificar->num_rows > 0) {
            return false; // El email ya existe
        }

        // Insertar nuevo usuario
        $sqlInsertar = "INSERT INTO usuarios (nombre, email, password, rol, activo) VALUES (?, ?, ?, ?, 1)";
        $stmtInsertar = $this->db->prepare($sqlInsertar);
        $stmtInsertar->bind_param('ssss', $nombre, $email, $password, $rol);

        return $stmtInsertar->execute();
    }

    // Autenticar usuario
    public function obtenerUsuarioPorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = ? AND activo = 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Actualizar última conexión
    public function actualizarUltimaConexion($usuarioId) {
        $sql = "UPDATE usuarios SET ultima_conexion = NOW() WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $usuarioId);
        $stmt->execute();
    }

    public function obtenerTodosLosUsuarios(){
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function actualizarPasswordUsuario($usuarioId, $nuevaPassword) {
        $sql = "UPDATE usuarios SET password = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('si', $nuevaPassword, $usuarioId);
        return $stmt->execute();
    }

    public function obtenerSiguienteID(){
        $sql = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'belleza' AND TABLE_NAME = 'usuarios'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['AUTO_INCREMENT'];
    }

    public function actualizarEmpleadoID($empleadoId){
        $sql = "UPDATE usuarios SET empleado_id = ? WHERE rol = 'empleado'";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $empleadoId);
        return $stmt->execute();
    }

    public function obtenerTipoDeUsuario($email){
        $sql = "SELECT rol FROM usuarios WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['rol'];
    }

    public function asociarEmpleadoConUsuario($usuario_id, $empleado_id) {
        $sql = "UPDATE empleados SET usuario_id = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ii', $usuario_id, $empleado_id);
        return $stmt->execute();
    }
}
?>