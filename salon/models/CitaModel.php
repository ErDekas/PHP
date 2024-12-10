<?php
class CitaModel
{
    private $db;

    public function __construct()
    {
        $this->db = new mysqli('localhost', 'root', '', 'belleza');
    }

    public function crearCita($cliente_id, $empleado_id, $servicios, $fecha_hora, $total)
    {
        // Añade depuración para verificar los datos de entrada
        error_log(
            "Datos para crear cita: 
        Cliente ID: $cliente_id
        Empleado ID: $empleado_id
        Fecha y Hora: $fecha_hora
        Total: $total
        Servicios: " . print_r($servicios, true)
        );

        $this->db->begin_transaction();
        try {
            // Insertar en la tabla 'citas' sin incluir 'servicio_id'
            $sql = "INSERT INTO citas (cliente_id, empleado_id, fecha_hora, estado, total) VALUES (?, ?, ?, 'reservada', ?)";
            $stmt = $this->db->prepare($sql);

            // Depuración para verificar la preparación de la sentencia
            if (!$stmt) {
                error_log("Error en la preparación de la sentencia SQL: " . $this->db->error);
                throw new Exception("Error en la preparación de la sentencia SQL");
            }

            $stmt->bind_param('iisd', $cliente_id, $empleado_id, $fecha_hora, $total);

            // Depuración para verificar la ejecución
            if (!$stmt->execute()) {
                error_log("Error al ejecutar insert en citas: " . $stmt->error);
                throw new Exception("Error al insertar la cita: " . $stmt->error);
            }

            // Obtener el ID de la cita recién creada
            $cita_id = $stmt->insert_id;

            // Verificar que se haya generado un ID de cita
            if (!$cita_id) {
                error_log("No se generó un ID de cita válido");
                throw new Exception("No se pudo generar el ID de la cita");
            }

            // Insertar los servicios asociados en la tabla 'cita_servicios'
            $sql_servicio = "INSERT INTO cita_servicios (cita_id, servicio_id) VALUES (?, ?)";
            $stmt_servicio = $this->db->prepare($sql_servicio);

            // Depuración para verificar la preparación de la sentencia de servicios
            if (!$stmt_servicio) {
                error_log("Error en la preparación de la sentencia SQL de servicios: " . $this->db->error);
                throw new Exception("Error en la preparación de la sentencia SQL de servicios");
            }

            foreach ($servicios as $servicio_id) {
                $stmt_servicio->bind_param('ii', $cita_id, $servicio_id);

                // Depuración para verificar la ejecución de cada insert de servicio
                if (!$stmt_servicio->execute()) {
                    error_log("Error al insertar servicio $servicio_id para la cita $cita_id: " . $stmt_servicio->error);
                    throw new Exception("Error al insertar servicios: " . $stmt_servicio->error);
                }
            }

            // Confirmar transacción
            $this->db->commit();
            return $cita_id;
        } catch (Exception $e) {
            $this->db->rollback();
            error_log("Excepción al crear cita: " . $e->getMessage());
            throw new Exception("Error al crear la cita: " . $e->getMessage());
        }
    }

    public function obtenerCitasPorCliente($cliente_id)
    {
        // SQL para obtener citas y servicios relacionados, incluso si no hay servicios
        $sql = "
    SELECT 
        c.id AS cita_id, 
        c.fecha_hora, 
        c.estado, 
        c.total AS total_cita,
        COALESCE(GROUP_CONCAT(s.nombre SEPARATOR ', '), 'Sin servicios') AS servicios, 
        COALESCE(SUM(s.precio), 0) AS total_servicios
    FROM 
        citas c
    LEFT JOIN 
        cita_servicios cs ON c.id = cs.cita_id
    LEFT JOIN 
        servicios s ON cs.servicio_id = s.id
    WHERE 
        c.cliente_id = ?
    GROUP BY 
        c.id, c.fecha_hora, c.estado, c.total
    ORDER BY 
        c.fecha_hora DESC
    ";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('i', $cliente_id);

            if (!$stmt->execute()) {
                throw new Exception("Error ejecutando la consulta: " . $stmt->error);
            }

            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            // Añadir un log para depuración
            error_log("Citas encontradas para cliente $cliente_id: " . count($result));

            return $result;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return [];
        }
    }


    public function obtenerCitas($filtros = [])
    {
        // Base SQL with relationships and data selection
        $sql = "
        SELECT 
            c.id AS cita_id, 
            c.fecha_hora, 
            c.estado, 
            c.total, 
            cl.nombre AS nombre_cliente, 
            u.nombre AS nombre_empleado, 
            GROUP_CONCAT(s.nombre SEPARATOR ', ') AS servicios
        FROM 
            citas c
        JOIN 
            clientes cl ON c.cliente_id = cl.id
        LEFT JOIN 
            usuarios u ON c.empleado_id = u.empleado_id
        LEFT JOIN 
            cita_servicios cs ON c.id = cs.cita_id
        LEFT JOIN 
            servicios s ON cs.servicio_id = s.id
        WHERE 
            1=1
        ";

        // Dynamic filter handling
        $whereClauses = [];
        $params = [];
        $types = '';

        // Add filters with type checking and validation
        $filterMappings = [
            'estado' => ['type' => 's', 'column' => 'c.estado'],
            'empleado_id' => ['type' => 'i', 'column' => 'c.empleado_id'],
            'cliente_id' => ['type' => 'i', 'column' => 'c.cliente_id'],
            'fecha_desde' => ['type' => 's', 'column' => 'c.fecha_hora', 'operator' => '>='],
            'fecha_hasta' => ['type' => 's', 'column' => 'c.fecha_hora', 'operator' => '<=']
        ];

        foreach ($filterMappings as $key => $config) {
            if (!empty($filtros[$key])) {
                $operator = $config['operator'] ?? '=';
                $whereClauses[] = "{$config['column']} $operator ?";
                $params[] = $filtros[$key];
                $types .= $config['type'];
            }
        }

        // Add WHERE conditions if any
        if (!empty($whereClauses)) {
            $sql .= " AND " . implode(" AND ", $whereClauses);
        }

        // Grouping and ordering
        $sql .= " GROUP BY c.id ORDER BY c.fecha_hora DESC";

        try {
            // Prepare statement
            $stmt = $this->db->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error preparing query: " . $this->db->error);
            }

            // Bind parameters if present
            if (!empty($params)) {
                $stmt->bind_param($types, ...$params);
            }

            // Execute query
            if (!$stmt->execute()) {
                throw new Exception("Error executing query: " . $stmt->error);
            }

            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            // Log error or handle as appropriate for your application
            error_log($e->getMessage());
            return [];
        }
    }


    public function obtenerCitasEmpleado($empleado_id)
    {
        $sql = "
        SELECT 
            ci.id AS cita_id,
            c.nombre AS cliente,
            ci.fecha_hora AS fecha_cita,
            s.nombre AS servicio,
            ci.estado AS estado
        FROM 
            citas ci
        JOIN 
            clientes c ON ci.cliente_id = c.id
        JOIN 
            cita_servicios cs ON ci.id = cs.cita_id
        JOIN 
            servicios s ON cs.servicio_id = s.id
        JOIN 
            usuarios u ON u.empleado_id = ci.empleado_id -- Relación entre usuarios y citas
        WHERE 
            u.id = ? -- Filtramos por usuario_id
            AND ci.estado = 'reservada'; -- Solo citas reservadas

    ";

        try {
            $stmt = $this->db->prepare($sql);

            // Vincula el parámetro del empleado_id
            $stmt->bind_param('i', $empleado_id);

            if (!$stmt->execute()) {
                throw new Exception("Error ejecutando la consulta: " . $stmt->error);
            }

            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return [];
        }
    }


    // Método para obtener citas sin empleado asignado
    public function obtenerCitasSinEmpleado()
    {
        $sql = "SELECT c.*, cl.nombre AS nombre_cliente 
                FROM citas c
                JOIN clientes cl ON c.cliente_id = cl.id
                WHERE c.empleado_id IS NULL";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerCitaPorId($cita_id)
    {
        $sql = "
    SELECT 
        c.id AS cita_id, 
        c.fecha_hora, 
        c.estado, 
        c.total, 
        c.cliente_id, 
        c.empleado_id,
        GROUP_CONCAT(cs.servicio_id SEPARATOR ',') AS servicios
    FROM 
        citas c
    LEFT JOIN 
        cita_servicios cs ON c.id = cs.cita_id
    WHERE 
        c.id = ?
    GROUP BY 
        c.id
    ";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('i', $cita_id);

            if (!$stmt->execute()) {
                throw new Exception("Error ejecutando la consulta: " . $stmt->error);
            }

            $result = $stmt->get_result()->fetch_assoc();
            return $result;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public function actualizarCita($cita_id, $cliente_id, $empleado_id, $servicios, $fecha_hora, $total)
    {
        // Validar permisos de administrador
        if (!$this->validarPermisoAdmin()) {
            return false;
        }

        // Validar datos de entrada
        if (!$this->validarDatosActualizacion($cliente_id, $empleado_id, $servicios, $fecha_hora, $total)) {
            return false;
        }

        $this->db->begin_transaction();
        try {
            // Actualizar datos principales de la cita
            $this->actualizarDatosCita($cita_id, $cliente_id, $empleado_id, $fecha_hora, $total);

            // Actualizar servicios asociados
            $this->actualizarServiciosCita($cita_id, $servicios);

            // Confirmar transacción
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            // Revertir transacción en caso de error
            $this->db->rollback();
            error_log("Error al actualizar cita: " . $e->getMessage());
            return false;
        }
    }

    private function validarPermisoAdmin()
    {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            error_log("Intento de actualización de cita sin permisos de administrador");
            return false;
        }
        return true;
    }

    private function validarDatosActualizacion($cliente_id, $empleado_id, $servicios, $fecha_hora, $total)
    {
        $errores = [];

        if (empty($cliente_id)) {
            $errores[] = "ID de cliente no válido";
        }

        if (empty($empleado_id)) {
            $errores[] = "ID de empleado no válido";
        }

        if (empty($servicios) || !is_array($servicios)) {
            $errores[] = "Servicios no válidos";
        }

        if (empty($fecha_hora) || !strtotime($fecha_hora)) {
            $errores[] = "Fecha y hora no válidas";
        }

        if ($total <= 0) {
            $errores[] = "Total no válido";
        }

        if (!empty($errores)) {
            // Registrar los errores de validación
            foreach ($errores as $error) {
                error_log($error);
            }
            return false;
        }

        return true;
    }

    private function actualizarDatosCita($cita_id, $cliente_id, $empleado_id, $fecha_hora, $total)
    {
        $sql = "UPDATE citas SET cliente_id = ?, empleado_id = ?, fecha_hora = ?, total = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('iisdi', $cliente_id, $empleado_id, $fecha_hora, $total, $cita_id);

        if (!$stmt->execute()) {
            throw new Exception("Error al actualizar datos de la cita: " . $stmt->error);
        }
    }

    private function actualizarServiciosCita($cita_id, $servicios)
    {
        // Eliminar servicios antiguos
        $sql_delete_servicios = "DELETE FROM cita_servicios WHERE cita_id = ?";
        $stmt_delete = $this->db->prepare($sql_delete_servicios);
        $stmt_delete->bind_param('i', $cita_id);

        if (!$stmt_delete->execute()) {
            throw new Exception("Error al eliminar servicios antiguos: " . $stmt_delete->error);
        }

        // Insertar nuevos servicios
        $sql_servicio = "INSERT INTO cita_servicios (cita_id, servicio_id) VALUES (?, ?)";
        $stmt_servicio = $this->db->prepare($sql_servicio);

        foreach ($servicios as $servicio_id) {
            $stmt_servicio->bind_param('ii', $cita_id, $servicio_id);

            if (!$stmt_servicio->execute()) {
                throw new Exception("Error al insertar servicio: " . $stmt_servicio->error);
            }
        }
    }

    // Método para obtener empleados
    public function obtenerEmpleados()
    {
        $sql = "SELECT id, nombre FROM empleados WHERE activo = 1";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC); // Devolver un array asociativo
        } else {
            return []; // Si no hay empleados, devolver un array vacío
        }
    }

    // Método para asignar empleado a una cita
    public function asignarEmpleadoACita($citaId, $empleadoId)
    {
        // Verificar que los valores no estén vacíos
        if (empty($citaId) || empty($empleadoId)) {
            return false;
        }

        // Actualizar la cita con el nuevo empleado
        $sql = "UPDATE citas SET empleado_id = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ii', $empleadoId, $citaId);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerServicios()
    {
        $sql = "SELECT id, nombre, precio, duracion_minutos FROM servicios";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerServiciosPorCita($cita_id)
    {
        // Consulta para obtener los servicios asociados a una cita específica
        $sql = "
        SELECT 
            s.id AS servicio_id, 
            s.nombre AS servicio_nombre, 
            s.precio AS servicio_precio
        FROM 
            servicios s
        JOIN 
            cita_servicios cs ON s.id = cs.servicio_id
        WHERE 
            cs.cita_id = ?
    ";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('i', $cita_id);  // Vinculamos el ID de la cita
            $stmt->execute();

            // Obtener los resultados y devolverlos como un array
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            return $result;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return [];  // Si ocurre un error, devolvemos un array vacío
        }
    }

    public function eliminarCita($cita_id)
    {
        $sql = "DELETE FROM citas WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $cita_id);
        return $stmt->execute();
    }

    public function cancelarCita($cita_id)
    {
        error_log("Intentando cancelar cita con ID: $cita_id");

        $sql = "
        UPDATE
            citas 
            SET
                estado = 'cancelada' 
            WHERE 
            citas.id = ?
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $cita_id);

        if ($stmt->execute()) {
            error_log("SQL ejecutado: $sql, Filas afectadas: {$stmt->affected_rows}");
            if ($stmt->affected_rows > 0) {
                return true;
            }
        } else {
            error_log("Error ejecutando consulta: " . $stmt->error);
        }
        return false;
    }

    public function actualizarEstadoCitasCompletadas()
    {
        // Consultar todas las citas cuya fecha_hora + duración total de los servicios ya haya pasado
        $sql = "
        SELECT 
            c.id AS cita_id, 
            c.fecha_hora,
            SUM(s.duracion_minutos) AS duracion_total
        FROM 
            citas c
        LEFT JOIN 
            cita_servicios cs ON c.id = cs.cita_id
        LEFT JOIN 
            servicios s ON cs.servicio_id = s.id
        WHERE 
            c.estado = 'reservada'
        GROUP BY 
            c.id, c.fecha_hora
    ";

        try {
            $stmt = $this->db->prepare($sql);

            if (!$stmt->execute()) {
                throw new Exception("Error ejecutando la consulta: " . $stmt->error);
            }

            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

            // Revisar cada cita y si su fecha_hora + duración total ya ha pasado, actualizar a 'completada'
            foreach ($result as $cita) {
                $fecha_fin_cita = strtotime($cita['fecha_hora']) + ($cita['duracion_total'] * 60); // Convertir fecha_hora y sumar la duración

                if ($fecha_fin_cita <= time()) { // Si la cita ha pasado
                    // Actualizar el estado de la cita a 'completada'
                    $sql_update = "UPDATE citas SET estado = 'completada' WHERE id = ?";
                    $stmt_update = $this->db->prepare($sql_update);
                    $stmt_update->bind_param('i', $cita['cita_id']);
                    $stmt_update->execute();
                }
            }
        } catch (Exception $e) {
            error_log("Error al actualizar el estado de las citas: " . $e->getMessage());
        }
    }
}
