<form action="" method="post" enctype="multipart/form-data">
    Selecciona un fichero: <input type="file" name="archivo">
    <input type="submit" value="Subir">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_dir = "subidos/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir);
    }
    
    $target_file = $target_dir . basename($_FILES["archivo"]["name"]);
    if ($_FILES["archivo"]["size"] <= 256 * 1024) {
        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $target_file)) {
            echo "El fichero ha sido subido.";
        } else {
            echo "Error al subir el fichero.";
        }
    } else {
        echo "El fichero es demasiado grande.";
    }
}
?>
