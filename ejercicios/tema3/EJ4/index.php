<?php
$valores = [];
$cuadrados = [];
$cubos = [];

// Generar 20 valores aleatorios entre 0 y 100
for ($i = 0; $i < 20; $i++) {
    $valor = rand(0, 100);
    $valores[] = $valor;
    $cuadrados[] = $valor ** 2;
    $cubos[] = $valor ** 3;
}

// Mostrar los tres arrays en columnas
echo "<table border='1'>
<tr>
<th>Valor</th>
<th>Cuadrado</th>
<th>Cubo</th>
</tr>";

for ($i = 0; $i < 20; $i++) {
    echo "<tr>
    <td>{$valores[$i]}</td>
    <td>{$cuadrados[$i]}</td>
    <td>{$cubos[$i]}</td>
    </tr>";
}

echo "</table>";
?>
