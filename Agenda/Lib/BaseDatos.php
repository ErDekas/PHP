<?php
namespace Lib;

use PDO;
use PDOException;

class BaseDatos {
    private $conexion;

    public function __construct() {
        try {
            $this->conexion = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
                DB_USER,
                DB_PASS
            );
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function ejecutarConsulta($sql, $params = []) {
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function obtenerResultados($sql, $params = []) {
        return $this->ejecutarConsulta($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ultimoIdInsertado() {
        return $this->conexion->lastInsertId();
    }
}
