<?php
class EmpleadoConstructor
{
    private $nombre;
    private $apellidos;
    private $sueldo;
    private $telefonos = []; // Array para almacenar los números de teléfono

    // Constructor con valores por defecto
    public function __construct(string $nombre, string $apellidos, float $sueldo = 1000)
    {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->sueldo = $sueldo;
    }

    // Getter para nombre
    public function getNombre(): string
    {
        return $this->nombre;
    }

    // Getter para apellidos
    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    // Getter para sueldo
    public function getSueldo(): float
    {
        return $this->sueldo;
    }

    // Setter para sueldo
    public function setSueldo(float $sueldo): void
    {
        $this->sueldo = $sueldo;
    }

    // Método para obtener el nombre completo
    public function getNombreCompleto(): string
    {
        return $this->nombre . ' ' . $this->apellidos;
    }

    // Método para comprobar si debe pagar impuestos
    public function debePagarImpuestos(): bool
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
