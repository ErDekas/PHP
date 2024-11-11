<?php
session_start();

echo "<h1>Carrito de la Compra</h1>";

// Mostrar los productos del carrito
if (!empty($_SESSION["productosEnCesta"])) {
    echo "<ul>";
    foreach ($_SESSION["productosEnCesta"] as $producto => $cantidad) {
        echo "<li><strong>$producto:</strong> $cantidad unidades</li>";
    }
    echo "</ul>";
} else {
    echo "<p>El carrito está vacío.</p>";
}

// Botón para vaciar el carrito
echo '<br><br><form method="POST" action="vaciar_carrito.php"><button type="submit">Vaciar Carrito</button></form>';

// Enlace para volver a la tienda
echo '<br><a href="index.php">Volver a la tienda</a>';
