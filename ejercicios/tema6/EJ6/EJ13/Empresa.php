<?php
require_once 'Empleado.php'; // Asegúrate de que este archivo está en la misma carpeta.
require_once 'Gerente.php'; // Asegúrate de que este archivo está en la misma carpeta, si existe.

class Empresa
{
    private string $nombre;
    private string $direccion;
    private array $trabajadores = [];

    public function __construct(string $nombre, string $direccion)
    {
        $this->nombre = $nombre;
        $this->direccion = $direccion;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getDireccion(): string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): void
    {
        $this->direccion = $direccion;
    }

    public function anyadirTrabajador(Persona $trabajador): void
    {
        $this->trabajadores[] = $trabajador;
    }

    public function listarTrabajadoresHtml(): string
    {
        $html = "<h2>Trabajadores de la Empresa " . $this->getNombre() . "</h2>";
        $html .= "<ul>";
        foreach ($this->trabajadores as $trabajador) {
            $html .= "<li>" . $trabajador::toHtml($trabajador) . "</li>";
        }
        $html .= "</ul>";
        return $html;
    }

    public function getCosteNominas(): float
    {
        $costeTotal = 0.0;
        foreach ($this->trabajadores as $trabajador) {
            if ($trabajador instanceof Empleado) {
                $costeTotal += $trabajador->getSueldo();
            }
            // Aquí puedes añadir lógica si también quieres incluir el sueldo de los Gerentes
            // Por ejemplo, si Gerente tiene un método `getSueldo()`.
        }
        return $costeTotal;
    }
}
