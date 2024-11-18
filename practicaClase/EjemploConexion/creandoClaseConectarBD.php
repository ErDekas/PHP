<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexion a la BD</title>
</head>
<body>
    <?php
        require_once 'autoloader.php';
        use Lib\DataBase;

        error_reporting(0);
        mysqli_report(MYSQLI_REPORT_OFF);

        require_once 'config.php';
        $conexion = new DataBase(SERVERNAME,USERNAME,PASSWORD,DBNAME);
        var_dump($conexion);

    ?>
    <h2>Conexion a la BD</h2>
</body>
</html>