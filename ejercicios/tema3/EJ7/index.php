<?php
echo "<table border='1'>
<tr>
<th>Variable</th>
<th>Valor</th>
</tr>";

foreach ($_SERVER as $variable => $valor) {
    echo "<tr>
    <td>{$variable}</td>
    <td>{$valor}</td>
    </tr>";
}

echo "</table>";
?>
