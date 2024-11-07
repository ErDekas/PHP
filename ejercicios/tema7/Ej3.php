<?php
// Nombre de la cookie para almacenar el idioma
$cookie_name = "idioma_usuario";

// Comprobar si el formulario ha sido enviado
if (isset($_POST['idioma'])) {
    // Obtener el idioma seleccionado del formulario
    $idioma = $_POST['idioma'];
    // Almacenar la selección del idioma en una cookie que dura 30 días
    setcookie($cookie_name, $idioma, time() + (30 * 24 * 60 * 60));
} elseif (isset($_COOKIE[$cookie_name])) {
    // Si la cookie ya existe, usar el idioma almacenado
    $idioma = $_COOKIE[$cookie_name];
} else {
    // Idioma por defecto si no se ha seleccionado previamente
    $idioma = "es"; // Español como idioma por defecto
}

// Mensajes en diferentes idiomas
$mensajes = [
    "es" => "Bienvenido a nuestro sitio web",
    "en" => "Welcome to our website",
    "fr" => "Bienvenue sur notre site web"
];

// Mostrar el mensaje en el idioma seleccionado
echo "<p>" . $mensajes[$idioma] . "</p>";
?>

<!-- Formulario para seleccionar el idioma -->
<form method="post" action="">
    <label for="idioma">Seleccione su idioma:</label>
    <select name="idioma" id="idioma">
        <option value="es" <?php if ($idioma == "es") echo "selected"; ?>>Español</option>
        <option value="en" <?php if ($idioma == "en") echo "selected"; ?>>Inglés</option>
        <option value="fr" <?php if ($idioma == "fr") echo "selected"; ?>>Francés</option>
    </select>
    <button type="submit">Guardar idioma</button>
</form>
