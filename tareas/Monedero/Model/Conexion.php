<?php

class Conexion {

    private $con;

    public function __construct() {
        $this->con = new mysqli("localhost", "root", "", "monederophp");
        if ($this->con->connect_error) {
            die("Conexión fallida: " . $this->con->connect_error);
        }
    }

    // Obtener todos los registros
    public function getRegistros() {
        $query = $this->con->query("SELECT * FROM registro");
        $registros = [];
        while ($fila = $query->fetch_assoc()) {
            $registros[] = $fila;
        }
        return $registros;
    }

    // Buscar registros por concepto
    public function buscarRegistros($concepto) {
        $stmt = $this->con->prepare("SELECT * FROM registro WHERE Concepto LIKE ?");
        $like = "%" . $concepto . "%";
        $stmt->bind_param("s", $like);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Añadir un nuevo registro
    public function añadirRegistro($concepto, $fecha, $importe) {
        $stmt = $this->con->prepare("INSERT INTO registro (Concepto, Fecha, Importe) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $concepto, $fecha, $importe);
        return $stmt->execute();
    }

    // Editar un registro existente
    public function editarRegistro($ID, $concepto, $fecha, $importe) {
        $stmt = $this->con->prepare("UPDATE registro SET Concepto = ?, Fecha = ?, Importe = ? WHERE ID = ?");
        $stmt->bind_param("ssdi", $concepto, $fecha, $importe, $ID);
        return $stmt->execute();
    }    

    // Borrar un registro
    public function borrarRegistro($ID) {
        $stmt = $this->con->prepare("DELETE FROM registro WHERE ID = ?");
        $stmt->bind_param("i", $ID);
        return $stmt->execute();
    }
}

?>
