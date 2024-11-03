<?php
class EmpleadoTelefonos
{
    private $nombre;
    private $apellidos;
    private $sueldo;
    private $telefonos = []; // Array para almacenar los números de teléfono

    // Constructor
    public function __construct($nombre, $apellidos, $sueldo)
    {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->sueldo = $sueldo;
    }

    // Getter para nombre
    public function getNombre()
    {
        return $this->nombre;
    }

    // Setter para nombre
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    // Getter para apellidos
    public function getApellidos()
    {
        return $this->apellidos;
    }

    // Setter para apellidos
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    // Getter para sueldo
    public function getSueldo()
    {
        return $this->sueldo;
    }

    // Setter para sueldo
    public function setSueldo($sueldo)
    {
        $this->sueldo = $sueldo;
    }

    // Método para obtener el nombre completo
    public function getNombreCompleto()
    {
        return $this->nombre . ' ' . $this->apellidos;
    }

    // Método para comprobar si debe pagar impuestos
    public function debePagarImpuestos()
    {
        return $this->sueldo > 3333;
    }

    // Método para añadir un teléfono al array
    public function anyadirTelefono(int $telefono): void
    {
        $this->telefonos[] = $telefono;
    }

    // Método para listar los teléfonos separados por comas
    public function listarTelefonos(): string
    {
        return implode(', ', $this->telefonos);
    }

    // Método para vaciar el array de teléfonos
    public function vaciarTelefonos(): void
    {
        $this->telefonos = [];
    }
}
