<?php
// registro.php
require_once 'config/database.php';
require_once 'includes/funciones.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $conn = $database->getConnection();

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];

    // Por defecto, los nuevos usuarios serán usuarios normales
    $rol = 'usuario';

    try {
        $stmt = $conn->prepare("INSERT INTO usuarios 
            (username, email, password, nombre, apellidos, rol) 
            VALUES (:username, :email, :password, :nombre, :apellidos, :rol)");
        
        $password_hash = hashPassword($password);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password_hash);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':rol', $rol);

        if ($stmt->execute()) {
            mostrarMensaje('Registro exitoso. Inicie sesión.', 'exito');
            header('Location: login.php');
            exit();
        }
    } catch(PDOException $e) {
        mostrarMensaje('Error en el registro: ' . $e->getMessage(), 'error');
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="registro-container">
        <form method="POST">
            <?php imprimirMensaje(); ?>
            <input type="text" name="username" placeholder="Nombre de usuario" required>
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="text" name="apellidos" placeholder="Apellidos" required>
            <button type="submit">Registrarse</button>
            <a href="login.php">Iniciar Sesión</a>
        </form>
    </div>
</body>
</html>