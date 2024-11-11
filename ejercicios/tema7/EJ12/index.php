<?php
session_start();

// Inicializar el carrito si no existe
if (!isset($_SESSION["productosEnCesta"])) {
    $_SESSION["productosEnCesta"] = [];
}

// Procesar el formulario si se envían datos
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["producto"]) && isset($_POST["cantidad"])) {
    $producto = trim($_POST["producto"]);
    $cantidad = intval($_POST["cantidad"]);

    // Validar que los campos no estén vacíos
    if (!empty($producto) && $cantidad > 0) {
        // Añadir o actualizar la cantidad del producto en el carrito
        if (isset($_SESSION["productosEnCesta"][$producto])) {
            $_SESSION["productosEnCesta"][$producto] += $cantidad;
        } else {
            $_SESSION["productosEnCesta"][$producto] = $cantidad;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compra</title>
</head>

<body>
    <h1>Tienda</h1>

    <!-- Formulario para añadir productos al carrito -->
    <form action="" method="POST">
        <label for="producto">Producto:</label>
        <input type="text" id="producto" name="producto" required>
        <br><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" min="1" required>
        <br><br>

        <button type="submit">Añadir a la lista</button>
        <a href="carrito.php"><button type="button">Comprar</button></a>
    </form>
    <br>
    <form action="vaciar_carrito.php" method="POST">
        <button type="submit">Vaciar Carrito</button>
    </form>
</body>

</html>