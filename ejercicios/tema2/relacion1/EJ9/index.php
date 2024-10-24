<?php
function esContrasenaValida($contrasena) {
    // Comprobamos que la contraseña sea una cadena y no esté vacía
    if (!is_string($contrasena) || empty($contrasena)) {
        return false;
    }

    // Expresión regular para validar la contraseña
    $patron = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,15}$/';

    return preg_match($patron, $contrasena) === 1;
}

?>
