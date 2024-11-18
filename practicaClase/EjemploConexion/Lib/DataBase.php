<?php
namespace Lib;
use Mysqli;
class DataBase{
    private Mysqli $conexion;
    public function __construct(
    
        private string $servidor,
        private string $usuario,
        private string $password,
        private string $bd)
    {
        $this->conexion = $this->conectar();
    }
    private function conectar():Mysqli{
        $conexion = new Mysqli($this->servidor, $this->usuario, $this->password, $this->bd);
        if($conexion->connect_error){
            die("La conexion ha fallado: " . $conexion->connect_error);
        }
        return $conexion;
    }

}
?>