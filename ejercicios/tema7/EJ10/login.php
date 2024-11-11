<?php
session_start();

// Verificar si el usuario ya está logueado
if (isset($_SESSION['usuario'])) {
    header("Location: protegido.php");
    exit();
}

// Datos de usuarios y contraseñas
$usuarios = [
    "usuario" => "1234",
    "admin" => "1234"
];

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    // Validar si el usuario existe y la contraseña es correcta
    if (array_key_exists($usuario, $usuarios) && $usuarios[$usuario] === $contraseña) {
        $_SESSION['usuario'] = $usuario;  // Crear la sesión
        $_SESSION['rol'] = ($usuario === 'admin') ? 'admin' : 'usuario'; // Asignar rol
        header("Location: protegido.php");  // Redirigir a la página protegida
        sleep(1);
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f0f0f0;
        }

        form {
            padding: 20px;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }

        button {
            padding: 10px;
            width: 100%;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h2>Iniciar sesión</h2>

    <?php if (isset($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" required>

        <label for="contraseña">Contraseña:</label>
        <input type="password" name="contraseña" id="contraseña" required>

        <button type="submit">Iniciar sesión</button>
    </form>
</body>

</html>