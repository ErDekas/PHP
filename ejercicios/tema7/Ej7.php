<?php
// Verificamos si la cookie "visitas" ya existe
if (isset($_COOKIE['visitas'])) {
    // Recuperamos las visitas de la cookie y las separamos en un array
    $visitas = explode(',', $_COOKIE['visitas']);
} else {
    // Si la cookie no existe, inicializamos el array vacío
    $visitas = [];
}

// Acción de recargar: agregar una nueva visita al array
if (isset($_POST['recargar'])) {
    $visitas[] = date('Y-m-d H:i:s'); // Se guarda la fecha de la visita
    // Convertimos el array de visitas a una cadena separada por comas y la guardamos en la cookie
    setcookie('visitas', implode(',', $visitas), time() + 3600 * 24 * 30); // Expira en 30 días
    // Redirigimos para recargar la página y actualizar el historial
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Acción de eliminar: borrar la cookie
if (isset($_POST['eliminar'])) {
    // Eliminamos la cookie estableciendo una fecha de expiración en el pasado
    setcookie('visitas', '', time() - 3600); // Expira en el pasado
    // Redirigimos para recargar la página después de eliminar la cookie
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Mostrar el historial de visitas en orden cronológico (última a primera)
echo "<h2>Últimas visitas:</h2>";
if (count($visitas) > 0) {
    echo "<ul>";
    // Mostramos las visitas en orden cronológico (última a primera)
    foreach (array_reverse($visitas) as $fecha) {
        echo "<li>" . $fecha . "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No hay visitas registradas.</p>";
}
?>

<!-- Formulario para eliminar las cookies y recargar -->
<form method="POST">
    <button type="submit" name="eliminar">Eliminar historial de visitas</button>
    <button type="submit" name="recargar">Recargar</button>
</form>
