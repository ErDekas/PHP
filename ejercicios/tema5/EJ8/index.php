<form action="" method="post" enctype="multipart/form-data">
    Selecciona una imagen: <input type="file" name="imagen">
    <input type="submit" value="Subir">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_dir = "images/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir);
    }
    
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
        echo "La imagen ha sido subida.";
        
        // Mostrar imágenes
        $archivos = scandir($target_dir);
        foreach ($archivos as $archivo) {
            if ($archivo != "." && $archivo != "..") {
                echo "<img src='$target_dir$archivo' style='width:100px;'><br>";
            }
        }
    } else {
        echo "Error al subir la imagen.";
    }
}
?>
