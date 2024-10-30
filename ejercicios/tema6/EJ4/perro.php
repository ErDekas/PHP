<?php
try {
    if (!file_exists("perro.php")) {
        throw new Exception('Error: El archivo perro.php no existe');
    }
    include "perro.php";
} catch (Exception $e) {
    echo $e->getMessage();
}
if (!class_exists('Perro')) {
    class Perro
    {
        private $tamaño;
        private $raza;
        private $color;
        private $nombre;

        public function __construct($tamaño, $raza, $color, $nombre)
        {
            $this->tamaño = $tamaño;
            $this->raza = $raza;
            $this->color = $color;
            $this->nombre = $nombre;
        }

        public function setTamaño($tamaño)
        {
            if (is_string($tamaño) && !empty($tamaño) && strlen($tamaño) <= 21) {
                $this->tamaño = $tamaño;
                return true;
            } else {
                echo "Error: El tamaño debe ser una cadena no vacía.";
                return false;
            }
        }
        public function setRaza($raza)
        {
            if (is_string($raza) && !empty($raza) && strlen($raza) <= 21) {
                $this->raza = $raza;
                return true;
            } else {
                echo "Error: La raza debe ser una cadena no vacía";
                return false;
            }
        }
        public function setColor($color)
        {
            if (is_string($color) && !empty($color) && strlen($color) <= 21) {
                $this->color = $color;
                return true;
            } else {
                echo "Error: El color debe ser una cadena no vacía";
                return false;
            }
        }
        public function setNombre($nombre)
        {
            if (is_string($nombre) && !empty($nombre) && strlen($nombre) <= 21) {
                $this->nombre = $nombre;
                return true;
            } else {
                echo "Error: El nombre debe ser una cadena no vacía";
                return false;
            }
        }
        public function getTamaño()
        {
            return $this->tamaño;
        }
        public function getRaza()
        {
            return $this->raza;
        }
        public function getColor()
        {
            return $this->color;
        }
        public function getNombre()
        {
            return $this->nombre;
        }
        public function mostrar_propiedades()
        {
            echo "el tamaño del perro es {$this->tamaño}, su color {$this->color}, su raza {$this->raza}, y su nombre: {$this->nombre}";
        }
        public function speak()
        {
            echo "{$this->nombre} dice: Guau Guau";
        }
    }
}
$labrador = new Perro('Grande', 'Labrador', 'Amarillo', 'Max');
$labrador->mostrar_propiedades();
echo "<br>";
$labrador->speak();
echo "<br>";

$caniche = new Perro('Pequeño', 'Caniche', 'Blanco', 'Bella');
$caniche->mostrar_propiedades();
echo "<br>";
$caniche->speak();
echo "<br>";

// Intentar actualizar el nombre del labrador y verificar el mensaje de error si aplica
$perro_error_message = $labrador->setNombre('Luna');
print $perro_error_message ? 'Nombre actualizado correctamente' : 'Nombre no modificado';
echo "<br>";

// Intentar asignar un nombre inválido para probar la validación de la longitud
$perro_error_message = $labrador->setNombre('NombreMuyLargoParaUnPerro');
print $perro_error_message ? 'Nombre acutalizado correctamente' : 'Nombre no modificado';
