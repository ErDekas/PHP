<?php

namespace Models;

class Carta
{
    private int $numero;
    private string $palo;

    public function __construct(int $numero, string $palo)
    {
        $this->numero = $numero;
        $this->palo = $palo;
    }

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function getPalo(): string
    {
        return $this->palo;
    }

    public function setNumero(int $numero): void
    {
        $this->numero = $numero;
    }

    public function setPalo(string $palo): void
    {
        $this->palo = $palo;
    }

    public function __toString(): string
    {
        return "{$this->numero} de {$this->palo}";
    }
}
