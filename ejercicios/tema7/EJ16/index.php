<?php
// Configuración de cookies
$cookie_name = "user_login";
$cookie_password = "user_password";

// Verificar si se envía el formulario de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $remember = isset($_POST["remember"]); // true si la casilla "Recordarme" está marcada

    // Validación básica (aquí deberías incluir la validación contra la base de datos)
    if ($username === "usuario" && $password === "1234") {
        // Si el usuario quiere ser recordado, guardamos las cookies
        if ($remember) {
            setcookie($cookie_name, $username, time() + (86400 * 30), "/"); // Cookie de usuario, expira en 30 días
            setcookie($cookie_password, $password, time() + (86400 * 30), "/"); // Cookie de contraseña (idealmente debería estar cifrada)
        }

        echo "Inicio de sesión exitoso";
        // Aquí puedes redirigir al usuario a la página principal o de bienvenida
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}

// Verificar si ya existe una cookie de usuario
$loggedInUser = isset($_COOKIE[$cookie_name]) ? $_COOKIE[$cookie_name] : "";
$loggedInPassword = isset($_COOKIE[$cookie_password]) ? $_COOKIE[$cookie_password] : "";

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Formulario de Inicio de Sesión</title>
</head>

<body>
    <h2>Iniciar sesión</h2>

    <form method="POST" action="">
        <label for="username">Usuario:</label>
        <input type="text" name="username" id="username"
            value="<?php echo htmlspecialchars($loggedInUser); ?>" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password"
            value="<?php echo $loggedInPassword ? str_repeat('*', strlen($loggedInPassword)) : ''; ?>" required><br><br>

        <input type="checkbox" name="remember" id="remember" <?php echo $loggedInUser ? 'checked' : ''; ?>>
        <label for="remember">Recordarme en este equipo</label><br><br>

        <button type="submit">Iniciar Sesión</button>
    </form>

    <?php if ($loggedInUser): ?>
        <a href="logout.php">Iniciar sesión con otra cuenta</a>
    <?php endif; ?>

</body>

</html>