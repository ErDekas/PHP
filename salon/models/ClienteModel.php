<?php
class ClienteModel
{
    private $db;

    public function __construct()
    {
        $this->db = new mysqli('localhost', 'root', '', 'belleza');
    }

    // Registrar cliente con token y en la tabla usuarios
    public function registrarCliente($nombre, $correo, $telefono, $fecha_nacimiento, $password)
    {
        // Generamos un token de verificación
        $token = bin2hex(random_bytes(16));

        // Ingresar datos en la tabla clientes
        $sql = "INSERT INTO clientes (nombre, correo, telefono, fecha_nacimiento, password, token_verificacion) 
            VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssssss', $nombre, $correo, $telefono, $fecha_nacimiento, $password, $token);

        if ($stmt->execute()) {
            // Obtener el ID del cliente recién insertado
            $cliente_id = $this->db->insert_id;

            // Insertar también en la tabla usuarios
            $usuarioSql = "INSERT INTO usuarios (email, password, nombre, rol, cliente_id) 
                       VALUES (?, ?, ?, 'cliente', ?)";
            $usuarioStmt = $this->db->prepare($usuarioSql);
            $usuarioStmt->bind_param('sssi', $correo, $password, $nombre, $cliente_id);

            if ($usuarioStmt->execute()) {
                // Enviar correo de verificación al cliente
                MailHelper::enviarCorreoVerificacion($correo, $token);
                return true;
            }
        }
        return false;
    }


    // Obtener cliente por correo
    public function obtenerClientePorCorreo($correo)
    {
        $sql = "SELECT * FROM clientes WHERE correo = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s', $correo);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Confirmar cuenta y verificar email mediante token
    public function confirmarCuenta($token)
    {
        $sql = "UPDATE clientes SET email_verificado = 1 WHERE token_verificacion = ? AND email_verificado = 0";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s', $token);
        return $stmt->execute() && $stmt->affected_rows > 0;
    }

    public function obtenerDetallesCliente($id_cliente) {
        $sql = "SELECT * FROM clientes WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id_cliente);
        $stmt->execute();    
        return $stmt->get_result()->fetch_assoc();
    }
    
    public function obtenerClientes($filtro = null) {
        // Si no se proporciona filtro, devolver todos los clientes
        if ($filtro === null) {
            $sql = "SELECT id, nombre, correo, telefono FROM clientes";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }
    
        // Si el filtro es un número, buscar por ID
        if (is_numeric($filtro)) {
            $sql = "SELECT * FROM clientes WHERE id = ?";    
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('i', $filtro);
            $stmt->execute();    
            return $stmt->get_result()->fetch_assoc();
        }
    
        // Si el filtro es un string, buscar por nombre o correo
        if (is_string($filtro)) {
            $busqueda = "%{$filtro}%";
            $sql = "SELECT id, nombre, correo, telefono FROM clientes 
                    WHERE nombre LIKE ? OR correo LIKE ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('ss', $busqueda, $busqueda);
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }
    
        // Si no coincide con ningún caso, devolver un array vacío
        return [];
    }

    public function historialCliente($id_cliente) {
        $sql = "SELECT * FROM historial_servicios WHERE cliente_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $id_cliente);
        $stmt->execute();    
        return $stmt->get_result()->fetch_assoc();
    }
}