<?php 
function esMatriculaValida($matricula) {
    // Comprobamos que la matrícula sea una cadena y no esté vacía
    if (!is_string($matricula) || empty($matricula)) {
        return false;
    }

    // Expresión regular para validar la matrícula
    $patron = '/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[BCDFGHJKLMNPQRSTVWXYZ])[0-9]{4}[BCDFGHJKLMNPQRSTVWXYZ]{3}$/';

    return preg_match($patron, $matricula) === 1;
}
?>
