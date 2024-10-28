<?php
// Definir la carpeta donde se guardarán las fotos
define('UPLOAD_DIR', 'imagenes/');
if (!is_dir(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0777, true);
}

// Definir el archivo XML donde se guardarán los datos
define('DATA_FILE', 'viviendas.xml');

// Verificar si el archivo XML existe, si no, crear uno vacío
if (!file_exists(DATA_FILE)) {
    $xml = new SimpleXMLElement('<viviendas></viviendas>');
    $xml->asXML(DATA_FILE);
}


// Sanitizar y validar los datos del formulario
$tipoVivienda = filter_input(INPUT_POST, 'tipoVivienda', FILTER_SANITIZE_NUMBER_INT);
$zonaVivienda = filter_input(INPUT_POST, 'zonaVivienda', FILTER_SANITIZE_NUMBER_INT);
$direccionVivienda = htmlspecialchars(trim($_POST['direccionVivienda'] ?? ''), ENT_QUOTES, 'UTF-8');
$dormitorios = filter_input(INPUT_POST, 'dormitorios', FILTER_SANITIZE_NUMBER_INT);
$precioVivienda = filter_input(INPUT_POST, 'precioVivienda', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$tamanoVivienda = filter_input(INPUT_POST, 'tamanoVivienda', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$extras = $_POST['extras'] ?? [];
$observacion = htmlspecialchars(trim($_POST['observacion'] ?? ''), ENT_QUOTES, 'UTF-8');

// Validación de campos
$errores = [];

// Validar tipo de vivienda
if (empty($tipoVivienda) || !filter_var($tipoVivienda, FILTER_VALIDATE_INT)) {
    $errores[] = "Debe seleccionar un tipo de vivienda válido.";
}

// Validar zona de vivienda
if (empty($zonaVivienda) || !filter_var($zonaVivienda, FILTER_VALIDATE_INT)) {
    $errores[] = "Debe seleccionar una zona válida.";
}

// Validar dirección
if (empty($direccionVivienda)) {
    $errores[] = "La dirección es obligatoria.";
} elseif (strlen($direccionVivienda) < 5 || strlen($direccionVivienda) > 100) {
    $errores[] = "La dirección debe tener entre 5 y 100 caracteres.";
}

// Validar número de dormitorios
if (empty($dormitorios) || !filter_var($dormitorios, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
    $errores[] = "Debe seleccionar un número de dormitorios válido.";
}

// Validar precio
if (empty($precioVivienda) || !filter_var($precioVivienda, FILTER_VALIDATE_FLOAT) || $precioVivienda <= 0) {
    $errores[] = "El precio debe ser un número positivo.";
}

// Validar tamaño
if (empty($tamanoVivienda) || !filter_var($tamanoVivienda, FILTER_VALIDATE_FLOAT) || $tamanoVivienda <= 0) {
    $errores[] = "El tamaño debe ser un número positivo.";
}

// Validar foto
$foto = '';
if (!empty($_FILES['fotosVivienda']['name'])) {
    $foto = UPLOAD_DIR . basename($_FILES['fotosVivienda']['name']);
    $fotoSize = $_FILES['fotosVivienda']['size'];
    $fotoTmp = $_FILES['fotosVivienda']['tmp_name'];
    $fotoExt = strtolower(pathinfo($foto, PATHINFO_EXTENSION));

    // Validar tamaño y tipo de archivo
    if ($fotoSize > 100000) {
        $errores[] = "La foto no debe exceder de 100 KB.";
    }
    if (!in_array($fotoExt, ['jpg', 'jpeg', 'png', 'gif'])) {
        $errores[] = "El formato de la foto no es válido. Solo se permiten JPG, JPEG, PNG o GIF.";
    }

    // Verificar errores de la carga del archivo
    if ($_FILES['fotosVivienda']['error'] !== UPLOAD_ERR_OK) {
        $errores[] = "Error al subir la foto. Código de error: " . $_FILES['fotosVivienda']['error'];
    }

    // Si no hay errores, mover la foto a la carpeta
    if (empty($errores) && !move_uploaded_file($fotoTmp, $foto)) {
        $errores[] = "Error al mover la foto al directorio de destino.";
    }
}

// Validar el array de extras (opcional, si se requiere validación específica)
if (!is_array($extras)) {
    $errores[] = "Los extras deben ser un formato válido.";
}

// Si hay errores, mostrarlos y detener la ejecución
if (!empty($errores)) {
    echo "<h3>Errores en el formulario:</h3><ul>";
    foreach ($errores as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
    echo '<button onclick="window.history.back()">Volver al formulario</button>';
    exit;
}

// Calcular las ganancias basadas en la zona y tamaño
$ganancia = calcularGanancia($zonaVivienda, $tamanoVivienda, $precioVivienda);

// Crear el documento XML si no existe
if (!file_exists(DATA_FILE)) {
    $xml = new SimpleXMLElement('<viviendas/>');
} else {
    $xml = simplexml_load_file(DATA_FILE);
}

// Añadir la nueva vivienda al XML
$vivienda = $xml->addChild('vivienda');
$vivienda->addChild('tipoVivienda', $tipoVivienda);
$vivienda->addChild('zonaVivienda', $zonaVivienda);
$vivienda->addChild('direccionVivienda', $direccionVivienda);
$vivienda->addChild('dormitorios', $dormitorios);
$vivienda->addChild('precioVivienda', $precioVivienda);
$vivienda->addChild('tamanoVivienda', $tamanoVivienda);
$vivienda->addChild('extras', implode(', ', array_map('htmlspecialchars', (array)$extras)));
$vivienda->addChild('foto', $foto);
$vivienda->addChild('observacion', $observacion);
$vivienda->addChild('ganancia', $ganancia);

// Guardar el XML actualizado
$xml->asXML(DATA_FILE);

// Función para calcular la ganancia
function calcularGanancia($zona, $tamano, $precio) {
    $porcentaje = 0;
    if ($tamano < 100) {
        switch ($zona) {
            case '1': $porcentaje = 0.30; break;
            case '2': $porcentaje = 0.25; break;
            case '3': $porcentaje = 0.22; break;
            case '4': $porcentaje = 0.20; break;
            case '5': $porcentaje = 0.22; break;
            case '6': $porcentaje = 0.25; break;
        }
    } else {
        switch ($zona) {
            case '1': $porcentaje = 0.35; break;
            case '2': $porcentaje = 0.28; break;
            case '3': $porcentaje = 0.25; break;
            case '4': $porcentaje = 0.35; break;
            case '5': $porcentaje = 0.25; break;
            case '6': $porcentaje = 0.28; break;
        }
    }
    return $precio * $porcentaje;
}

// Mostrar la información insertada
echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Datos de la Vivienda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 20px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h3 {
            color: #333;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .data-table th, .data-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .data-table th {
            background-color: #f2f2f2;
            text-align: left;
        }
        img {
            max-width: 300px;
            height: auto;
        }
        button {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>";

echo "<h3>Datos de la vivienda insertados correctamente:</h3>";
echo "<table class='data-table'>
        <tr><th>Tipo de Vivienda</th><td>$tipoVivienda</td></tr>
        <tr><th>Zona</th><td>$zonaVivienda</td></tr>
        <tr><th>Dirección</th><td>" . htmlspecialchars($direccionVivienda) . "</td></tr>
        <tr><th>Número de Dormitorios</th><td>$dormitorios</td></tr>
        <tr><th>Precio</th><td>€$precioVivienda</td></tr>
        <tr><th>Tamaño</th><td>$tamanoVivienda m²</td></tr>
        <tr><th>Extras</th><td>" . implode(', ', array_map('htmlspecialchars', (array)$extras)) . "</td></tr>
        <tr><th>Observaciones</th><td>" . htmlspecialchars($observacion) . "</td></tr>
        <tr><th>Ganancia</th><td>€$ganancia</td></tr>
    </table>";

if ($foto && file_exists($foto)) {
    echo "<h4>Foto:</h4><img src='$foto' alt='Foto de la vivienda' />";
}

echo '<br><button onclick="window.location.href=\'formulario.html\'">Volver al formulario</button>';
echo "</body></html>";
?>
