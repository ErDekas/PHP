<?php
// Establecer la fecha de acceso
$fechaAcceso = date('Y-m-d H:i:s'); // Guarda la fecha y hora actual

// Crear la cookie con la fecha de acceso. La cookie caducará en una hora.
setcookie('fechaAcceso', $fechaAcceso, time() + 3600); // Expira en una hora (3600 segundos)

// Verificar si la cookie existe y mostrar la fecha de acceso
if (isset($_COOKIE['fechaAcceso'])) {
    echo "<p>Último acceso: " . $_COOKIE['fechaAcceso'] . "</p>";
} else {
    echo "<p>No se ha registrado ningún acceso aún.</p>";
}
?>
