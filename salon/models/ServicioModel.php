<?php
class ServicioModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'belleza');
    }

    // Obtener un servicio por su ID
    public function obtenerServicioPorId($servicio_id) {
        $sql = "SELECT id, nombre, precio FROM servicios WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $servicio_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Método para obtener todos los servicios
    public function obtenerServicios() {
        $sql = "SELECT id, nombre, precio FROM servicios";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerDetallesServicio($servicio_id) {
        $sql = "SELECT id, nombre, precio, duracion_minutos FROM servicios WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $servicio_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}

?>
