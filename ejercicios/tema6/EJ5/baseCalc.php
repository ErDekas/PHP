<?php

class BaseCalc
{
    private $num1;
    private $num2;

    public function __construct($num1, $num2)
    {
        $this->num1 = $num1;
        $this->num2 = $num2;
    }

    public function getNum1()
    {
        return $this->num1;
    }
    public function getNum2()
    {
        return $this->num2;
    }

    public function setNum1($num1)
    {
        $this->num1 = $num1;
    }
    public function setNum2($num2)
    {
        $this->num2 = $num2;
    }

    public function calculate()
    {
        echo "Numero 1 : {$this->num1}, Numero 2: {$this->num2}";
    }
}

class AddCalc extends BaseCalc
{
    public function calculate()
    {
        $resultado = $this->getNum1() + $this->getNum2();
        echo "La suma de {$this->getNum1()} + {$this->getNum2()} es: $resultado";
    }
}

class SubCalc extends BaseCalc
{
    public function calculate()
    {
        $resultado = $this->getNum1() - $this->getNum2();
        echo "La resta de {$this->getNum1()} + {$this->getNum2()} es: $resultado";
    }
}

class MulCalc extends BaseCalc
{
    public function calcultate()
    {
        $resultado = $this->getNum1() * $this->getNum2();
        echo "La multiplicacion de {$this->getNum1()} x {$this->getNum1()} es: $resultado";
    }
}

class DivCalc extends BaseCalc
{
    public function calculate()
    {
        if ($this->getNum2() == 0) {
            echo "Error: Division por cero no permitida";
        } else {
            $resultado = $this->getNum1() / $this->getNum2();
            echo "La division de {$this->getNum1()} / {$this->getNum2()} es: $resultado";
        }
    }
}

echo "<br>";
$add = new AddCalc(10, 5);
$add->calculate();

echo "<br>";
$sub = new SubCalc(10, 5);
$sub->calculate();

echo "<br>";
$mul = new MulCalc(10, 5);
$mul->calculate();

echo "<br>";
$div = new DivCalc(10, 5);
$div->calculate();

echo "<br>";
// Prueba de división por cero
$divCero = new DivCalc(10, 0);
$divCero->calculate();