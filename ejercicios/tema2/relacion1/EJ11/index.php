<?php
function factorial($n) {
    if ($n < 0) {
        throw new InvalidArgumentException("El número debe ser no negativo.");
    }
    if ($n === 0) {
        return 1;
    }
    return $n * factorial($n - 1);
}

// Programa para probar
try {
    echo factorial(-5);
} catch (InvalidArgumentException $e) {
    echo $e->getMessage();
}
?>
