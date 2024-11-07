<?php
// Nombre de la cookie para recordar si el usuario aceptó la política de cookies
$cookie_name = "cookies_aceptadas";

// Comprobar si el formulario ha sido enviado
if (isset($_POST['aceptar'])) {
    // Crear la cookie para recordar que el usuario aceptó la política de cookies
    setcookie($cookie_name, "true", time() + (365 * 24 * 60 * 60), "/"); // La cookie dura un año
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Cookies</title>
    <style>
        /* Estilos para el cartel de política de cookies */
        #cookie-banner {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 16px;
            z-index: 1000;
        }

        #cookie-banner button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }

        #cookie-banner button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<?php
// Comprobar si la cookie ya está establecida
if (!isset($_COOKIE[$cookie_name])) {
    // Mostrar el cartel de la política de cookies si no se ha aceptado aún
    echo '
    <div id="cookie-banner">
        <p>Este sitio web usa cookies para mejorar la experiencia de usuario. <a href="#">Leer más</a></p>
        <form method="post" action="">
            <button type="submit" name="aceptar">Aceptar</button>
        </form>
    </div>';
}
?>

<h1>Bienvenido a nuestra página</h1>
<p>Contenido de la página aquí...</p>

</body>
</html>
