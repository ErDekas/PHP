<?php
// Recoger la longitud de la línea desde la URL
$longitud = $_GET['longitud'] ?? null;

// Verificar que la longitud es válida y está dentro del rango permitido
if ($longitud === null || !is_numeric($longitud) || $longitud < 10 || $longitud > 1000) {
    echo 'Error: La longitud debe ser un número entre 10 y 1000 píxeles.';
    exit;
}

// Generar el SVG con la línea
header('Content-Type: image/svg+xml');
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<svg width="<?= $longitud ?>" height="50" xmlns="http://www.w3.org/2000/svg">
    <line x1="0" y1="25" x2="<?= $longitud ?>" y2="25" stroke="black" stroke-width="2" />
</svg>
