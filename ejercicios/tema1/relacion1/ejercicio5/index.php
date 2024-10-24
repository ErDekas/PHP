<?php
$hoy = date("Y-m-d");
echo "Hoy: " . $hoy . "\n";

$ayer = date("Y-m-d", strtotime("-1 day"));
echo "Ayer: " . $ayer . "\n";

$manana = date("Y-m-d", strtotime("+1 day"));
echo "Mañana: " . $manana . "\n";
?>
