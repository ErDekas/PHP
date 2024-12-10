<?php
class EmpleadoModel
{
    private $db;

    public function __construct()
    {
        $this->db = new mysqli('localhost', 'root', '', 'belleza');
        if ($this->db->connect_error) {
            throw new Exception("Error de conexión: " . $this->db->connect_error);
        }
    }

    public function registrarEmpleado($nombre, $especialidad, $correo, $telefono, $activo, $usuario_id)
    {
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

    public function actualizarEmpleadoId($usuarioId, $empleadoId)
    {
        $sql = "UPDATE usuarios SET empleado_id = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ii', $empleadoId, $usuarioId);
        return $stmt->execute();
    }

    public function buscarEmpleadoParaServicios($especialidades, $fecha_hora)
    {
        // Primero, buscar por especialidad coincidente
        foreach ($especialidades as $especialidad) {
            $empleado = $this->buscarEmpleadoDisponiblePorEspecialidad($especialidad, $fecha_hora);
            if ($empleado) {
                return $empleado;
            }
        }

        // Si no se encuentra por especialidad, buscar cualquier empleado disponible
        return $this->buscarEmpleadoDisponibleGeneral($fecha_hora);
    }

    private function buscarEmpleadoDisponiblePorEspecialidad($especialidad, $fecha_hora)
    {
        $query = "SELECT e.id, e.nombre, e.especialidad
                FROM empleados e
                WHERE e.activo = 1
                AND e.especialidad = ?
                AND NOT EXISTS (
                    SELECT 1
                    FROM citas c
                    JOIN cita_servicios cs ON c.id = cs.cita_id
                    JOIN servicios s ON cs.servicio_id = s.id
                    WHERE c.empleado_id = e.id
                    AND (
                        (c.fecha_hora <= ? AND DATE_ADD(c.fecha_hora, INTERVAL s.duracion_minutos MINUTE) > ?)
                    OR 
                        (c.fecha_hora >= ? AND c.fecha_hora < DATE_ADD(?, INTERVAL (SELECT MAX(duracion_minutos) FROM servicios) MINUTE))
                    )
                )
ORDER BY RAND()
LIMIT 1";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssss', $especialidad, $fecha_hora, $fecha_hora, $fecha_hora, $fecha_hora);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    private function buscarEmpleadoDisponibleGeneral($fecha_hora)
    {
        $query = "SELECT e.id, e.nombre, e.especialidad
            FROM empleados e
            WHERE e.activo = 1 
                AND NOT EXISTS (
                    SELECT 1
                    FROM citas c
                    JOIN cita_servicios cs ON c.id = cs.cita_id
                    JOIN servicios s ON cs.servicio_id = s.id
                    WHERE c.empleado_id = e.id
                        AND (
                            (c.fecha_hora <= ? AND DATE_ADD(c.fecha_hora, INTERVAL s.duracion_minutos MINUTE) > ?)
                        OR 
                            (c.fecha_hora >= ? AND c.fecha_hora < DATE_ADD(?, INTERVAL (SELECT MAX(duracion_minutos) FROM servicios) MINUTE))
                        )
                    AND c.estado = 'reservada' -- Solo se consideran citas reservadas
                    )
                    ORDER BY RAND()
                    LIMIT 1";


        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssss', $fecha_hora, $fecha_hora, $fecha_hora, $fecha_hora);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    // Fallback method if no available employees
    public function obtenerPrimerEmpleadoActivo()
    {
        $query = "SELECT id, nombre, especialidad FROM empleados WHERE activo = 1 LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0 ? $result->fetch_assoc() : null;
    }

    public function obtenerDetallesEmpleado($id_empleado)
    {
        $sql = "SELECT id, nombre, especialidad, correo FROM empleados WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id_empleado);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function obtenerEmpleadoPorUsuarioId($usuario_id)
    {
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

    public function obtenerPrimerEmpleado()
    {
        $sql = "SELECT * FROM empleados LIMIT 1";
        $resultado = $this->db->query($sql);
        return $resultado->fetch_assoc();
    }
}
