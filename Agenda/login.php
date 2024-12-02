<?php
// login.php
require_once 'config/database.php';
require_once 'includes/funciones.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $conn = $database->getConnection();

    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = :username AND activo = 1");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && validarPassword($password, $usuario['password'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['username'] = $usuario['username'];
            $_SESSION['rol'] = $usuario['rol'];

            // Actualizar última conexión
            $stmt = $conn->prepare("UPDATE usuarios SET ultima_conexion = NOW() WHERE id = :id");
            $stmt->bindParam(':id', $usuario['id']);
            $stmt->execute();

            header('Location: dashboard.php');
            exit();
        } else {
            mostrarMensaje('Credenciales incorrectas', 'error');
        }
    } catch(PDOException $e) {
        mostrarMensaje('Error en el sistema: ' . $e->getMessage(), 'error');
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="login-container">
        <form method="POST">
            <?php imprimirMensaje(); ?>
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Iniciar Sesión</button>
            <a href="registro.php">Registrarse</a>
        </form>
    </div>
</body>
</html>