<?php

namespace Models;

class Barajaes
{
    private array $cartas = [];

    public function __construct()
    {
        $palos = ['Corazones', 'Diamantes', 'Tréboles', 'Picas'];
        for ($i = 1; $i <= 13; $i++) {
            foreach ($palos as $palo) {
                $this->cartas[] = new Carta($i, $palo);
            }
        }
    }

    public function getCartas(): array
    {
        return $this->cartas;
    }

    public function barajar(): void
    {
        shuffle($this->cartas);
    }
}
