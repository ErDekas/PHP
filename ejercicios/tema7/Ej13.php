<?php
// Evitar que la página se guarde en caché
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Refrescar automáticamente la página cada 10 segundos
header("Refresh: 10");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabeceras en PHP</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }

        h1 {
            color: red;
        }

        a {
            text-decoration: none;
            color: blue;
        }
    </style>
</head>

<body>
    <?php
    // Mostrar la fecha y hora actual
    $formater = new IntlDateFormatter('es_ES', IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'Europe/Madrid', IntlDateFormatter::GREGORIAN, "EEEE, d 'de' MMMM 'de' yyyy, 'a las' HH:mm:ss");
    echo "<h1>" . $formater->format(new DateTime()) . "</h1>";
    ?>

    <p>Con la función <strong>header()</strong> hemos especificado que esta página no se guarde en la memoria caché, sino que se llame a sí misma desde el servidor cada 10 segundos. Puedes comprobarlo dejando la página sin actualizar durante 10 segundos o pulsando sobre Actualizar.</p>

    <a href="index.php">Actualizar</a>
</body>

</html>