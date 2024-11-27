<?php
namespace Models;

use Lib\BaseDatos;

class Contacto {
    private $db;

    public function __construct() {
        $this->db = new BaseDatos();
    }

    public function getAll() {
        return $this->db->obtenerResultados("SELECT * FROM contactos");
    }

    public function create($nombre, $telefono, $email, $direccion) {
        $this->db->ejecutarConsulta(
            "INSERT INTO contactos (nombre, telefono, email, direccion) VALUES (?, ?, ?, ?)",
            [$nombre, $telefono, $email, $direccion]
        );
        return $this->db->ultimoIdInsertado();
    }

    public function delete($id) {
        $this->db->ejecutarConsulta("DELETE FROM contactos WHERE id = ?", [$id]);
    }
}
