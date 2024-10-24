<?php
$censoPoblacion = [
    'España' => 47450795,
    'Portugal' => 10196709,
    'Francia' => 65273511,
    'Italia' => 60244639,
    'Grecia' => 10423054,
];

// Mostrar el censo de población
echo "<table border='1'>
<tr>
<th>País</th>
<th>Población</th>
</tr>";

foreach ($censoPoblacion as $pais => $poblacion) {
    echo "<tr>
    <td>{$pais}</td>
    <td>{$poblacion}</td>
    </tr>";
}

echo "</table>";
?>
