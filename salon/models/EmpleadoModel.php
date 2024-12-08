<?php
class EmpleadoModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'belleza');
        if ($this->db->connect_error) {
            throw new Exception("Error de conexión: " . $this->db->connect_error);
        }
    }

    public function registrarEmpleado($nombre, $especialidad, $correo, $telefono, $activo, $usuario_id) {
        $sql = "INSERT INTO empleados (nombre, especialidad, correo, telefono, activo) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssssi', $nombre, $especialidad, $correo, $telefono, $activo);
        
        if ($stmt->execute()) {
            // Relacionar al empleado con el usuario en la tabla `usuarios`
            $empleado_id = $this->db->insert_id;
            $this->actualizarEmpleadoId($usuario_id, $empleado_id);
            return true;
        }
        return false;
    }

    public function actualizarEmpleadoId($usuarioId, $empleadoId) {
        $sql = "UPDATE usuarios SET empleado_id = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ii', $empleadoId, $usuarioId);
        return $stmt->execute();
    }

    public function buscarEmpleadoDisponible($especialidad = null, $fecha_hora = null) {
        $sql = "SELECT e.* FROM empleados e 
                WHERE e.activo = 1";
        
        $params = [];
        $types = '';
    
        if ($especialidad) {
            $sql .= " AND e.especialidad = ?";
            $params[] = $especialidad;
            $types .= 's';
        }
    
        if ($fecha_hora) {
            $sql .= " AND e.id NOT IN (
                SELECT DISTINCT empleado_id FROM citas 
                WHERE fecha_hora = ?
            )";
            $params[] = $fecha_hora;
            $types .= 's';
        }
    
        $sql .= " LIMIT 1";
    
        $stmt = $this->db->prepare($sql);
        
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_assoc();
    }  

    public function obtenerDetallesEmpleado($id_empleado) {
        $sql = "SELECT id, nombre, especialidad, correo FROM empleados WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id_empleado);
        $stmt->execute();    
        return $stmt->get_result()->fetch_assoc();
    }

    public function obtenerEmpleadoPorUsuarioId($usuario_id) {
        // Primero, log de depuración
        error_log("Buscando empleado para usuario ID: $usuario_id");
    
        // Verificar los usuarios existentes
        $sql_usuarios = "SELECT * FROM usuarios WHERE id = ?";
        $stmt_usuarios = $this->db->prepare($sql_usuarios);
        $stmt_usuarios->bind_param('i', $usuario_id);
        $stmt_usuarios->execute();
        $resultado_usuario = $stmt_usuarios->get_result();
        $usuario = $resultado_usuario->fetch_assoc();
        
        // Log del usuario encontrado
        error_log("Usuario encontrado: " . print_r($usuario, true));
    
        // Listar todos los empleados para verificar
        $sql_empleados = "SELECT * FROM empleados";
        $resultado_empleados = $this->db->query($sql_empleados);
        $empleados = [];
        while ($empleado = $resultado_empleados->fetch_assoc()) {
            $empleados[] = $empleado;
        }
        
        // Log de todos los empleados
        error_log("Empleados existentes: " . print_r($empleados, true));
    
        // Búsqueda del empleado
        $sql = "SELECT * FROM empleados WHERE usuario_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $usuario_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $empleado = $result->fetch_assoc();
    
        // Log del resultado final
        error_log("Empleado encontrado: " . print_r($empleado, true));
    
        return $empleado;
    }

    public function obtenerPrimerEmpleado() {
        $sql = "SELECT * FROM empleados LIMIT 1";
        $resultado = $this->db->query($sql);
        return $resultado->fetch_assoc();
    }
}
?>
